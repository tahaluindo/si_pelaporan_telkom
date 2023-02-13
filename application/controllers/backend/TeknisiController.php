<?php
class TeknisiController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TeknisiModel');
        $this->data['token'] = $this->session->userdata('token');
        if (empty($this->data['token'])) {
            $this->flashmsg('Anda harus login dulu!', 'danger');
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Teknisi';
        $data['data_teknisi'] = $this->TeknisiModel->get();
        $this->render('backend/teknisi/data-teknisi', $data);
    }

    public function create()
    {
        if (isset($_POST['submit'])) {
            $this->db->trans_start();
            $this->TeknisiModel->insert(
                [
                    'teknisi_id' => $this->POST('teknisi_id'),
                    'teknisi_telepon' => $this->POST('teknisi_telepon'),
                    'teknisi_nama' => $this->POST('teknisi_nama')
                ]
            );
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->flashmsg('Gagal menambah data', 'danger');
                redirect('teknisi');
            } else {
                $this->flashmsg('Sukses menambah data', 'success');
                redirect('teknisi');
            }
        } else {
            $data['title'] = "Tambah teknisi";
            $this->render('backend/teknisi/create-teknisi', $data);
        }
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            $this->db->trans_start();
            $insert = $this->TeknisiModel->update(
                $this->POST('teknisi_id_old'),
                [
                    'teknisi_id' => $this->POST('teknisi_id'),
                    'teknisi_telepon' => $this->POST('teknisi_telepon'),
                    'teknisi_nama' => $this->POST('teknisi_nama')
                ]
            );
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->flashmsg('Gagal mengubah data', 'danger');
                redirect('teknisi');
            } else {
                $this->flashmsg('Sukses mengubah data', 'success');
                redirect('teknisi');
            }
        } else {
            $data['title'] = 'Update teknisi';
            $data['data_teknisi'] = $this->TeknisiModel->get(['teknisi_id' => $id]);
            $this->render('backend/teknisi/create-teknisi', $data);
        }
    }

    public function destroy($id)
    {
        $this->db->trans_start();
        $delete = $this->TeknisiModel->delete($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->flashmsg('Gagal menghapus data', 'danger');
            redirect('teknisi');
        } else {
            $this->flashmsg('Sukses menghapus data', 'success');
            redirect('teknisi');
        }
    }
}
