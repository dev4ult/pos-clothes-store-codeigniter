<?php

namespace App\Controllers;

use App\Models\Product_Model;
use App\Models\Stock_Model;
use App\Models\Category_Model;
use App\Models\Size_Model;

class Product extends BaseController {

    protected $data;
    protected $product_model;
    protected $stock_model;
    protected $category_model;
    protected $size_model;

    public function __construct() {
        $this->product_model = new Product_Model();
        $this->stock_model = new Stock_Model();
        $this->category_model = new Category_Model();
        $this->size_model = new Size_Model();
    }

    public function index() {
        $this->data['page_title'] = 'Produk';

        $this->data['products'] = $this->product_model->select('id_produk, nama_baju, harga, gambar_baju, kategori.nama_kategori')->join('kategori', 'kategori.id_kategori = produk_baju.id_kategori')->get()->getResult();

        $this->data['sizes'] = $this->size_model->select('*')->get()->getResult();

        $this->data['product_stock'] = $this->stock_model->select('id_stok, stok_produk.id_produk, ukuran.jenis_ukuran, stok')
            ->join('produk_baju', 'stok_produk.id_produk = produk_baju.id_produk')
            ->join('ukuran', 'stok_produk.id_ukuran = ukuran.id_ukuran')->get()->getResult();

        $this->data['categories'] = $this->category_model->select('*')->get()->getResult();

        echo view('templates/header');
        echo view('templates/aside', $this->data);
        echo view('product/index', $this->data);
        echo view('product/transaction_aside', $this->data);
        echo view('templates/footer');
    }

    public function table_list() {
        $this->data['page_title'] = 'Produk';

        $this->data['products'] = $this->product_model->select('*')->join('kategori', 'kategori.id_kategori = produk_baju.id_kategori')->get()->getResult();

        $this->data['sizes'] = $this->size_model->select('*')->get()->getResult();

        $this->data['product_stock'] = $this->stock_model->select('id_stok, stok_produk.id_produk, ukuran.jenis_ukuran, stok')
            ->join('produk_baju', 'stok_produk.id_produk = produk_baju.id_produk')
            ->join('ukuran', 'stok_produk.id_ukuran = ukuran.id_ukuran')->get()->getResult();

        $this->data['categories'] = $this->category_model->select('*')->get()->getResult();

        echo view('templates/header');
        echo view('templates/aside', $this->data);
        echo view('product/table_list', $this->data);
        echo view('templates/footer');
    }

    public function detail($product_id = '') {
        if (empty($product_id)) {
            return redirect()->route('produk/list_tabel');
        }

        $this->data['page_title'] = 'Produk';

        $this->data['product'] = $this->product_model->select('*')->join('kategori', 'kategori.id_kategori = produk_baju.id_kategori')->where(['id_produk' => $product_id])->get()->getResult();

        if (empty($this->data['product'])) {
            return redirect()->route('produk/list_tabel');
        }

        $this->data['product'] = $this->data['product'][0];

        $this->data['sizes'] = $this->size_model->select('*')->get()->getResult();

        $this->data['product_stock'] = $this->stock_model->select('id_stok, ukuran.id_ukuran, stok_produk.id_produk, ukuran.jenis_ukuran, stok')
            ->join('produk_baju', 'stok_produk.id_produk = produk_baju.id_produk')
            ->join('ukuran', 'stok_produk.id_ukuran = ukuran.id_ukuran')->where(['stok_produk.id_produk' => $product_id])->get()->getResult();

        $this->data['categories'] = $this->category_model->select('*')->get()->getResult();


        echo view('templates/header');
        echo view('templates/aside', $this->data);
        echo view('product/detail', $this->data);
        echo view('modals/edit_product_form', $this->data);
        echo view('templates/footer');
    }

    public function save_product() {

        $validationRule = [
            'product-img' => [
                'label' => 'Image File',
                'rules' => [
                    'mime_in[product-img,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                ],
            ],
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->route('produk');
        }

        $image_data = $this->request->getFile('product-img');
        $image_data = file_get_contents($image_data->getTempName());

        $insert_product = [
            'id_kategori' => $this->request->getPost('product-category'),
            'nama_baju' => $this->request->getPost('product-name'),
            'harga' => $this->request->getPost('product-price'),
            'deskripsi' => $this->request->getPost('product-desc'),
            'gambar_baju' => $image_data
        ];

        if (!empty($this->request->getPost('product-id'))) {
            return redirect()->route("produk/list_tabel");
        } else {
            $save_product = $this->product_model->insert($insert_product);

            $product_id = $this->product_model->getInsertID();
        }

        $insert_product_stock = [
            'id_produk' => $product_id,
            'id_ukuran' => $this->request->getPost('product-size'),
            'stok' => $this->request->getPost('product-stock'),
        ];

        $save_product_stock = $this->stock_model->insert($insert_product_stock);

        if ($save_product && $save_product_stock) {
            return redirect()->route('produk');
        }
    }

    function save_product_stock() {
        $insert_product_stock = [
            'id_produk' => $this->request->getPost('product-id'),
            'id_ukuran' => $this->request->getPost('product-size'),
            'stok' => $this->request->getPost('product-stock'),
        ];

        $save_product_stock = $this->stock_model->insert($insert_product_stock);

        if ($save_product_stock) {
            return redirect()->route('produk/detail/' . $insert_product_stock['id_produk']);
        }
    }
}
