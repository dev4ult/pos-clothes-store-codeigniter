<?php

namespace App\Controllers;


use App\Models\Transaction_Model;
use App\Models\DetailTransaction_Model;
use App\Models\Stock_Model;
use App\Models\Member_Model;

use Dompdf\Dompdf;


class Transaction extends BaseController {

    protected $transaction_model;
    protected $detail_transaction_model;
    protected $stock_model;
    protected $member_model;

    protected $data;

    public function __construct() {
        $this->transaction_model = new Transaction_Model();
        $this->detail_transaction_model = new DetailTransaction_Model();
        $this->stock_model = new Stock_Model();
        $this->member_model = new Member_Model();
    }

    public function index() {
        $this->data['page_title'] = 'Transaksi';

        $this->data['transactions'] = $this->transaction_model->select('id_transaksi, member.nama_lengkap as nama_member, kasir.nama_lengkap as nama_kasir, status')->join('member', 'member.id_member = transaksi.id_member', 'left')->join('kasir', 'kasir.id_kasir = transaksi.id_kasir')->get()->getResult();

        $this->data['detail_prices'] = $this->detail_transaction_model->select('id_transaksi, produk_baju.harga as harga, jumlah_produk')->join('stok_produk', 'stok_produk.id_stok = detail_transaksi.id_stok')->join('produk_baju', 'stok_produk.id_produk = produk_baju.id_produk')->get()->getResult();

        echo view('templates/header', $this->data);
        echo view('templates/aside', $this->data);
        echo view('transaction/index', $this->data);
        echo view('templates/footer');
    }

    public function search_transaction() {
        $keyword = $this->request->getPost('keyword');

        $this->data['transactions'] = $this->transaction_model->select('id_transaksi, member.nama_lengkap as nama_member, kasir.nama_lengkap as nama_kasir, status')->join('member', 'member.id_member = transaksi.id_member', 'left')->join('kasir', 'kasir.id_kasir = transaksi.id_kasir')->like('member.nama_lengkap', $keyword)->orLike('kasir.nama_lengkap', $keyword)->orLike('status', $keyword)->get()->getResult();

        $this->data['detail_prices'] = $this->detail_transaction_model->select('id_transaksi, produk_baju.harga as harga, jumlah_produk')->join('stok_produk', 'stok_produk.id_stok = detail_transaksi.id_stok')->join('produk_baju', 'stok_produk.id_produk = produk_baju.id_produk')->get()->getResult();

        return view('transaction/search_item', $this->data);
    }

    public function detail($transaction_id = "") {
        if (empty($transaction_id) || !$this->transaction_model->where(['id_transaksi' => $transaction_id])->first()) {
            session()->setFlashdata("error", "ID Transaksi tidak diketahui");
            return redirect()->route('transaksi');
        }

        $this->data['page_title'] = "Transaksi";

        $this->data['transaction'] = $this->transaction_model->select('id_transaksi, member.nama_lengkap as nama_member, kasir.nama_lengkap as nama_kasir, status')->join('member', 'member.id_member = transaksi.id_member', 'left')->join('kasir', 'kasir.id_kasir = transaksi.id_kasir')->where(['id_transaksi' => $transaction_id])->get()->getResult()[0];

        $this->data['transaction_details'] = $this->detail_transaction_model->select('*')->join('stok_produk', 'stok_produk.id_stok = detail_transaksi.id_stok')->join('produk_baju', 'stok_produk.id_produk = produk_baju.id_produk')->where(['id_transaksi' => $transaction_id])->get()->getResult();


        echo view('templates/header', $this->data);
        echo view('templates/aside', $this->data);
        echo view('transaction/detail', $this->data);
        echo view('modals/edit_transaction_status_form', $this->data);
        echo view('templates/footer');
    }

    public function save_transaction() {
        $transaction_id = $this->request->getPost('transaction-id');
        $total_order = $this->request->getPost('total-product-saved');

        if ($total_order == 0 || session()->get('role') == 'admin') {
            return redirect()->route('transaksi');
        }

        if (empty($transaction_id)) {
            $transaction_id = $this->insert_transaction("Tertunda", $total_order);
            session()->setFlashdata("success", "Transaksi baru berhasil disimpan");
        } else {
            $this->update_transaction("Tertunda", $total_order, $transaction_id);
            session()->setFlashdata("warning", "Transaksi berhasil diubah");
        }

        return redirect()->to('/transaksi/detail/' . $transaction_id);
    }

    public function finish_transaction() {
        $transaction_id = $this->request->getPost('transaction-id');
        $total_order = $this->request->getPost('total-product-saved');

        if ($total_order == 0 || session()->get('role') == 'admin') {
            return redirect()->route('transaksi');
        }

        if (empty($transaction_id)) {
            $transaction_id = $this->insert_transaction("Berhasil", $total_order);
        } else {
            $this->update_transaction("Berhasil", $total_order, $transaction_id);
        }

        session()->setFlashdata("success", "Transaksi terbayarkan");
        return redirect()->to('/transaksi/detail/' . $transaction_id);
    }

    private function insert_transaction($status = "Berhasil", $total_order = 0) {
        $transaction_data = [
            "id_kasir" => session()->get('user_id'),
            "status" => $status
        ];

        $member_id = $this->request->getPost('member-id');
        if (!empty($member_id)) {
            $transaction_data['id_member'] = $member_id;

            if (!$this->member_model->where(['id_member' => $member_id])->first()) {
                session()->setFlashdata("error", "ID Member tidak diketahui");
                return redirect()->route('produk');
            }
        }


        $this->transaction_model->insert($transaction_data);
        $transaction_id = $this->transaction_model->getInsertID();

        // deal with transaction detail
        for ($i = 1; $i <= (int) $total_order; $i++) {
            $transaction_detail_data  = [
                "id_transaksi" => $transaction_id,
                "id_stok" => $this->request->getPost($i . "-stock-id"),
                "jumlah_produk" => $this->request->getPost($i . "-stock-needed-to-buy"),
            ];

            $this->detail_transaction_model->insert($transaction_detail_data);

            $max_stock = (int) $this->request->getPost($i . '-max-stock');

            $total_product = (int) $transaction_detail_data['jumlah_produk'];

            $this->stock_model->where(['id_stok' => $transaction_detail_data['id_stok']])->set(['stok' => $max_stock - $total_product])->update();
        }

        return $transaction_id;
    }

    private function update_transaction($status = "Berhasil", $total_order = 0, $transaction_id) {
        if (!$this->transaction_model->where(['id_transaksi' => $transaction_id])->first()) {
            return;
        }

        // if ($total_order == 0) {
        //     foreach ($all_transaction_details as $detail) {
        //         $this->stock_model->where(['id_stok' => $detail->id_stok])->set(['stok' => $detail->jumlah_produk + $detail->stok])->update();
        //     }

        //     $this->transaction_model->where(['id_transaksi' => $transaction_id])->delete();
        // }

        $this->transaction_model->where(['id_transaksi' => $transaction_id])->set(['status' => $status])->update();

        $stock_transaction_ids = [];

        for ($i = 1; $i <= $total_order; $i++) {
            $insert_detail  = [
                "id_transaksi" => $transaction_id,
                "id_stok" => $this->request->getPost($i . "-stock-id"),
                "jumlah_produk" => $this->request->getPost($i . "-stock-needed-to-buy"),
            ];

            $where_detail = [
                "id_transaksi" => $transaction_id,
                "id_stok" => $this->request->getPost($i . "-stock-id"),
            ];

            array_push($stock_transaction_ids, $where_detail);

            $max_stock = (int) $this->request->getPost($i . '-max-stock');
            $total_product = (int) $insert_detail['jumlah_produk'];

            if (!$this->detail_transaction_model->where($where_detail)->first()) {
                $this->detail_transaction_model->insert($insert_detail);
            } else {
                $this->detail_transaction_model->where($where_detail)->set(['jumlah_produk' => $total_product])->update();
            }

            $this->stock_model->where(['id_stok' => $insert_detail['id_stok']])->set(['stok' => $max_stock - $total_product])->update();
        }

        $all_transaction_details = $this->detail_transaction_model->select("id_transaksi, detail_transaksi.id_stok, jumlah_produk, stok_produk.stok")->join('stok_produk', 'stok_produk.id_stok = detail_transaksi.id_stok')->where(['id_transaksi' => $transaction_id])->get()->getResult();

        foreach ($all_transaction_details as $detail) {
            $delete = true;
            foreach ($stock_transaction_ids as $id) {
                if ($detail->id_transaksi == $id['id_transaksi'] && $detail->id_stok == $id['id_stok']) {
                    $delete = false;
                }
            }
            if ($delete) {
                $this->detail_transaction_model->where(["id_transaksi" => $detail->id_transaksi, "id_stok" => $detail->id_stok])->delete();

                $this->stock_model->where(['id_stok' => $detail->id_stok])->set(['stok' => $detail->jumlah_produk + $detail->stok]);
            }
        }
    }

    public function change_status() {
        $transaction_id = $this->request->getPost('transaction-id');
        $transaction_status = $this->request->getPost('transaction-status');

        if (empty($transaction_status)) {
            session()->setFlashdata("error", "Silahkan pilih status terlebih dahulu");
            return redirect()->to('/transaksi/detail/' . $transaction_id);
        }

        $this->transaction_model->where(['id_transaksi' => $transaction_id])->set(['status' => $transaction_status])->update();

        if ($transaction_status == "gagal") {
            $all_transaction_details = $this->detail_transaction_model->select("detail_transaksi.id_stok, jumlah_produk, stok_produk.stok")->join('stok_produk', 'stok_produk.id_stok = detail_transaksi.id_stok')->where(['id_transaksi' => $transaction_id])->get()->getResult();

            foreach ($all_transaction_details as $detail) {
                $this->stock_model->where(['id_stok' => $detail->id_stok])->set(['stok' => $detail->jumlah_produk + $detail->stok]);
            }
        }

        session()->setFlashdata("warning", "Transaksi berhasil diubah statusnya");
        return redirect()->to('/transaksi/detail/' . $transaction_id);
    }

    public function print_pdf() {
        $dompdf = new Dompdf();

        $this->data['transactions'] = $this->transaction_model->select('id_transaksi, member.nama_lengkap as nama_member, kasir.nama_lengkap as nama_kasir, status')->join('member', 'member.id_member = transaksi.id_member', 'left')->join('kasir', 'kasir.id_kasir = transaksi.id_kasir')->get()->getResult();

        $this->data['detail_prices'] = $this->detail_transaction_model->select('id_transaksi, produk_baju.harga as harga, jumlah_produk')->join('stok_produk', 'stok_produk.id_stok = detail_transaksi.id_stok')->join('produk_baju', 'stok_produk.id_produk = produk_baju.id_produk')->get()->getResult();


        $html = view("transaction/pdf_table", $this->data);

        $dompdf->loadHtml($html);

        $dompdf->setPaper("A4", "Landscape");
        $dompdf->render();
        $dompdf->stream();

        return redirect()->route('transaksi');
    }
}
