<?php

namespace App\Controllers;

use App\Models\CashierEmployee_Model;
use App\Models\Admin_Model;

class Auth extends BaseController {

    protected $cashier_employee_model;
    protected $admin_model;

    protected $data;

    public function __construct() {
        $this->cashier_employee_model = new CashierEmployee_Model();
        $this->admin_model = new Admin_Model();
    }

    public function index() {
        $this->data['page_title'] = 'Login';
        echo view('templates/header', $this->data);
        echo view('auth/login');
        echo view('templates/footer');
    }

    public function login() {
        $where = [
            "email" => $this->request->getPost('email'),
        ];

        $password = (string) $this->request->getPost('password');

        $user_admin = $this->admin_model->where($where)->first();
        $user_cashier = $this->cashier_employee_model->where($where)->first();

        if ($user_admin && password_verify($password, $user_admin['password'])) {
            session()->set([
                'user_id' => $user_admin->id_admin,
                'username' => $user_admin->username,
                'role' => 'admin',
                'logged_in' => TRUE
            ]);
            return redirect()->route('dashboard');
        }


        if ($user_cashier && password_verify($password, $user_cashier['password'])) {
            session()->set([
                'user_id' => $user_cashier->id_admin,
                'username' => $user_cashier->username,
                'role' => 'cashier',
                'logged_in' => TRUE
            ]);
            return redirect()->route('dashboard');
        }

        session()->setFlashdata('error', 'Email / Password Salah');
        return redirect()->back();
    }

    public function logout() {
        session()->destroy();
        return redirect()->route('auth');
    }
}
