<?php

namespace App\Controllers;

use App\Models\Product_Model;
use App\Models\Stock_Model;
use App\Models\Category_Model;

class Product extends BaseController {

    protected $data;
    protected $product_model;
    protected $stock_model;
    protected $category_model;

    public function __construct() {
        $this->product_model = new Product_Model();
        $this->stock_model = new Stock_Model();
        $this->category_model = new Category_Model();
    }

    public function index() {
        $this->data['page_title'] = 'Produk';

        $this->data['products'] = $this->product_model->select('id_produk, nama_baju, gambar_baju, kategori.nama_kategori')->join('kategori', 'kategori.id_kategori = produk_baju.id_kategori')->get()->getResult();

        $this->data['product_stock'] = $this->stock_model->select('stok_produk.id_produk, ukuran.jenis_ukuran, stok')
            ->join('produk_baju', 'stok_produk.id_produk = produk_baju.id_produk')
            ->join('ukuran', 'stok_produk.id_ukuran = ukuran.id_ukuran')->get()->getResult();

        $this->data['categories'] = $this->category_model->select('*')->get()->getResult();

        echo view('templates/header');
        echo view('templates/aside', $this->data);
        echo view('product/index', $this->data);
        echo view('product/transaction_aside', $this->data);
        echo view('templates/footer');
    }
}