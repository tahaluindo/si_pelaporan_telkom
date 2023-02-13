<?php
class LevelController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('LevelModel');
        $this->data['token'] = $this->session->userdata('token');
        if (empty($this->data['token'])) {
            $this->flashmsg('Anda harus login dulu!', 'danger');
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Level User';
        $data['level'] = $this->LevelModel->get();
        $this->render('backend/level/data-level', $data);
    }

    public function create()
    {
        if (isset($_POST['submit'])) {
            $this->db->trans_start();
            $this->LevelModel->insert(['nama_level' => $this->POST('nama_level')]);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->flashmsg('Gagal menambah data', 'danger');
                redirect('level');
            } else {
                $this->flashmsg('Sukses menambah data', 'success');
                redirect('level');
            }
        } else {
            $data['title'] = "Tambah Level";
            $this->render('backend/level/create-level', $data);
        }
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            $this->db->trans_start();
            $insert = $this->LevelModel->update($this->POST('id_level'), ['nama_level' => $this->post('nama_level')]);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->flashmsg('Gagal mengubah data', 'danger');
                redirect('level');
            } else {
                $this->flashmsg('Sukses mengubah data', 'success');
                redirect('level');
            }
        } else {
            $data['title'] = 'Update Level';
            $data['level'] = $this->LevelModel->get(['id_level' => $id]);
            $this->render('backend/level/create-level', $data);
        }
    }

    public function destroy($id)
    {
        $this->db->trans_start();
        $delete = $this->LevelModel->delete($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->flashmsg('Gagal menghapus data', 'danger');
            redirect('level');
        } else {
            $this->flashmsg('Sukses menghapus data', 'success');
            redirect('level');
        }
    }
}
