<?php

namespace App\Controllers;


use App\Models\Transaction_Model;
use App\Models\DetailTransaction_Model;
use App\Models\Stock_Model;

class Transaction extends BaseController {

    protected $transaction_model;
    protected $detail_transaction_model;
    protected $stock_model;

    protected $data;

    public function __construct() {
        $this->transaction_model = new Transaction_Model();
        $this->detail_transaction_model = new DetailTransaction_Model();
        $this->stock_model = new Stock_Model();
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

    public function detail($transaction_id = "") {
        if (empty($transaction_id) || !$this->transaction_model->where(['id_transaksi' => $transaction_id])->first()) {
            return redirect()->route('transaksi');
        }

        $this->data['page_title'] = "Transaksi";

        $this->data['transaction'] = $this->transaction_model->select('id_transaksi, member.nama_lengkap as nama_member, kasir.nama_lengkap as nama_kasir, status')->join('member', 'member.id_member = transaksi.id_member', 'left')->join('kasir', 'kasir.id_kasir = transaksi.id_kasir')->where(['id_transaksi' => $transaction_id])->get()->getResult()[0];

        $this->data['transaction_details'] = $this->detail_transaction_model->select('*')->join('stok_produk', 'stok_produk.id_stok = detail_transaksi.id_stok')->join('produk_baju', 'stok_produk.id_produk = produk_baju.id_produk')->where(['id_transaksi' => $transaction_id])->get()->getResult();

        echo view('templates/header', $this->data);
        echo view('templates/aside', $this->data);
        echo view('transaction/detail', $this->data);
        echo view('templates/footer');
    }

    public function save_transaction() {
        $total_order = $this->request->getPost('total-product-saved');

        if ($total_order == 0) {
            return redirect()->route('transaksi');
        }

        if (session()->get('role') == 'admin') {
            return redirect()->route('dashboard');
        }

        $this->insert_transaction("Tertunda", $total_order);
        return redirect()->route('transaksi');
    }

    public function finish_transaction() {
        $total_order = $this->request->getPost('total-product-saved');

        if ($total_order == 0) {
            return redirect()->route('transaksi');
        }

        if (session()->get('role') == 'admin') {
            return redirect()->route('dashboard');
        }

        $this->insert_transaction("Berhasil", $total_order);
        return redirect()->route('transaksi');
    }

    private function insert_transaction($status = "Berhasil", $total_order = 0) {

        $transaction_data = [
            "id_kasir" => session()->get('user_id'),
            "status" => $status
        ];

        $member_id = $this->request->getPost('member-id');
        if (!empty($member_id)) {
            $transaction_data['id_member'] = $member_id;
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

            if ($total_product < $max_stock) {
                $this->stock_model->where(['id_stok' => $transaction_detail_data['id_stok']])->set(['stok' => $max_stock - $total_product])->update();
            } else {
                $this->stock_model->where(['id_stok' => $transaction_detail_data['id_stok']])->delete();
            }
        }
    }
}
