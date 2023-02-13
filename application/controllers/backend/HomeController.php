<?php
class HomeController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->data['token'] = $this->session->userdata('token');
        $this->load->model('AdminModel');
        if (!isset($this->data['token'])) {
            $this->flashmsg('Anda harus login untuk mengakses halaman tersebut', 'warning');
            redirect('login');
            exit;
        }
    }
    public function index()
    {
        $data['title'] = 'Dashboard';
        $data['masuk'] = [];
        $data['keluar'] = [];
        $data['disposisi'] = [];
        $data['user'] = $this->AdminModel->get();
        $this->render('backend/dashboard', $data);
    }
}
