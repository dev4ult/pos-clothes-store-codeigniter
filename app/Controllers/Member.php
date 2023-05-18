<?php

namespace App\Controllers;


use App\Models\Member_Model;

class Member extends BaseController {

    protected $member_model;

    protected $data;

    public function __construct() {
        $this->member_model = new Member_Model();
    }

    private function get_unique_id() {
        $length = 16;
        $better_token = md5(uniqid(rand(), true));
        $rem = strlen($better_token) - $length;
        $unique_code = substr($better_token, 0, -$rem);

        return strtoupper($unique_code);
    }

    public function index() {
        $this->data['page_title'] = 'Member';

        $this->data['members'] = $this->member_model->select('*')->get()->getResult();

        echo view('templates/header', $this->data);
        echo view('templates/aside');
        echo view('member/index', $this->data);
        echo view('modals/new_member_form');
        echo view('templates/footer');
    }

    public function save_member() {
        $insert_data = [
            'nama_lengkap' => $this->request->getPost('full-name'),
            'no_telepon' => $this->request->getPost('phone-number'),
        ];

        $member_id = $this->request->getPost('member-id');
        if (!empty($member_id)) {

            $this->member_model->where(['id_member' => $member_id])->set($insert_data)->update();

            return redirect()->route('member');
        }

        $insert_data['id_member'] = $this->get_unique_id();
        $is_exist = count($this->member_model->select('*')->where(['id_member' => $insert_data['id_member']])->get()->getResult());

        while ($is_exist > 0) {
            $insert_data['id_member'] = $this->get_unique_id();
            $is_exist = count($this->member_model->select('*')->where(['id_member' => $insert_data['id_member']])->get()->getResult());
        }
        $this->member_model->insert($insert_data);


        return redirect()->route('member');
    }

    public function delete_member($member_id = "") {
        $this->deny_cashier_entry();

        if (empty($member_id)) {
            return redirect()->route('member');
        }

        $is_exist = count($this->member_model->select('*')->where(['id_member' => $member_id])->get()->getResult());

        if (!$is_exist) {
            return redirect()->route('member');
        }

        $this->member_model->where(['id_member' => $member_id])->delete();

        return redirect()->route('member');
    }

    private function deny_cashier_entry() {
        if (session()->get('role') == "cashier") {
            return redirect()->route('dashboard');
        }
    }
}