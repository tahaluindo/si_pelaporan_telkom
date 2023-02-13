<?php
class AdminController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('AdminModel');
        $this->load->model('LevelModel');
        $this->data['token'] = $this->session->userdata('token');
        if (empty($this->data['token'])) {
            $this->flashmsg('Anda harus login dulu!', 'danger');
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Admin';
        $data['data_user'] = $this->AdminModel->get_all_user();
        $this->render('backend/admin/data-admin', $data);
    }

    public function create()
    {
        if (isset($_POST['submit'])) {
            $options = [
                'cost' => 10,
            ];
            $data = [
                'nip' => $this->post('nip'),
                'nama' => $this->post('nama'),
                'kontak' => $this->post('kontak'),
                'level_user' => $this->post('level'),
                'password' => password_hash($this->post('password'), PASSWORD_DEFAULT, $options),
                'original_pass' => $this->post('password')

            ];
            $this->db->trans_start();
            $insert = $this->AdminModel->insert($data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->flashmsg('Gagal menambah data', 'danger');
                redirect('admin');
            } else {
                $this->flashmsg('Sukses menambah data', 'success');
                redirect('admin');
            }
        } else {
            $data['title'] = 'Tambah Data Admin';
            $data['level'] = $this->LevelModel->get();
            $this->render('backend/admin/create-admin', $data);
        }
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            $options = [
                'cost' => 10,
            ];
            $data = [
                'nip' => $this->post('nip'),
                'nama' => $this->post('nama'),
                'kontak' => $this->post('kontak'),
                'level_user' => $this->post('level'),
                'password' => password_hash($this->post('password'), PASSWORD_DEFAULT, $options),
                'original_pass' => $this->post('password')
            ];
            $this->db->trans_start();
            $insert = $this->AdminModel->update($this->POST('id_user'), $data);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->flashmsg('Gagal mengubah data', 'danger');
                redirect('admin');
            } else {
                $this->flashmsg('Sukses mengubah data', 'success');
                redirect('admin');
            }
        } else {
            $data['title'] = 'Tambah Data Admin';
            $data['level'] = $this->LevelModel->get();
            $data['user'] = $this->AdminModel->get(['id_user' => $id]);
            $this->render('backend/admin/create-admin', $data);
        }
    }

    public function destroy($id)
    {
        $this->db->trans_start();
        $delete = $this->AdminModel->delete($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->flashmsg('Gagal menghapus data', 'danger');
            redirect('admin');
        } else {
            $this->flashmsg('Sukses menghapus data', 'success');
            redirect('admin');
        }
    }
}
