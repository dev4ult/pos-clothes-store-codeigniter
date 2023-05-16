<?php

namespace App\Controllers;


use App\Models\CashierEmployee_Model;

class CashierEmployee extends BaseController {

    protected $cashier_employee_model;

    protected $data;

    public function __construct() {
        $this->cashier_employee_model = new CashierEmployee_Model();
    }

    public function index() {
        $this->data['page_title'] = 'Pegawai Kasir';

        $this->data['cashiers'] = $this->cashier_employee_model->select('*')->get()->getResult();

        echo view('templates/header', $this->data);
        echo view('templates/aside');
        echo view('cashier/index', $this->data);
        echo view('modals/new_cashier_form');
        echo view('templates/footer');
    }

    public function save_cashier_employee() {

        $validationRule = [
            'employee-photo' => [
                'label' => 'Image File',
                'rules' => [
                    'mime_in[employee-photo,image/jpg,image/jpeg,image/gif,image/png,image/webp]',
                ],
            ],
        ];

        if (!$this->validate($validationRule)) {
            return redirect()->route('kasir');
        }

        $update_cashier = [
            'username' => $this->request->getPost(''),
            'email' => $this->request->getPost(''),
            'password' => $this->request->getPost(''),
            'nama_lengkap' => $this->request->getPost(''),
            'nik' => $this->request->getPost(''),
            'no_telepon' => $this->request->getPost(''),
            'alamat' => $this->request->getPost(''),
        ];

        $image_data = $this->request->getFile('employee-photo');
        if (($image_data)->isValid()) {
            $image_data = file_get_contents($image_data->getTempName());
            $update_cashier['foto_profil'] = $image_data;
        }

        $insert_cashier = [
            'username' => $this->request->getPost(''),
            'email' => $this->request->getPost(''),
            'password' => $this->request->getPost(''),
            'nama_lengkap' => $this->request->getPost(''),
            'nik' => $this->request->getPost(''),
            'no_telepon' => $this->request->getPost(''),
            'alamat' => $this->request->getPost(''),
            'foto_profil' => $image_data,
        ];

        $cashier_id = $this->request->getPost('cashier-id');
        if (!empty($cashier_id)) {
            $update = $this->cashier_employee_model->where(['id_kasir' => $cashier_id])->set($update_cashier)->update();

            if ($update) {
                return redirect()->route('kasir');
            }
        }

        $save = $this->cashier_employee_model->insert($insert_cashier);

        if ($save) {
            return redirect()->route('kasir');
        }
    }

    public function delete_cashier_employee($cashier_id = "") {
        if (empty($cashier_id) || count($this->cashier_employee_model->select('*')->where(['id_kasir' => $cashier_id])->get()->getResult()) == 0) {
            return redirect()->route('kasir');
        }

        $this->cashier_employee_model->where(['id_kasir' => $cashier_id])->delete();

        return redirect()->route('kasir');
    }
}
