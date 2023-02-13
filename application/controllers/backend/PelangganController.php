<?php
class PelangganController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('PelangganModel');
        $this->data['token'] = $this->session->userdata('token');
        if (empty($this->data['token'])) {
            $this->flashmsg('Anda harus login dulu!', 'danger');
            redirect('login');
        }
    }

    public function index()
    {
        $data['title'] = 'Data Pelanggan';
        $data['data_pelanggan'] = $this->PelangganModel->get();
        $this->render('backend/pelanggan/data-pelanggan', $data);
    }

    public function create()
    {
        if (isset($_POST['submit'])) {
            $this->db->trans_start();
            $this->PelangganModel->insert(
                [
                    'pelanggan_id' => $this->POST('pelanggan_id'),
                    'pelanggan_telepon' => $this->POST('pelanggan_telepon'),
                    'pelanggan_nama' => $this->POST('pelanggan_nama'),
                    'pelanggan_alamat' => $this->POST('pelanggan_alamat')
                ]
            );
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->flashmsg('Gagal menambah data', 'danger');
                redirect('pelanggan');
            } else {
                $this->flashmsg('Sukses menambah data', 'success');
                redirect('pelanggan');
            }
        } else {
            $data['title'] = "Tambah Pelanggan";
            $this->render('backend/pelanggan/create-pelanggan', $data);
        }
    }

    public function edit($id)
    {
        if (isset($_POST['submit'])) {
            $this->db->trans_start();
            $insert = $this->PelangganModel->update(
                $this->POST('pelanggan_id_old'),
                [
                    'pelanggan_id' => $this->POST('pelanggan_id'),
                    'pelanggan_telepon' => $this->POST('pelanggan_telepon'),
                    'pelanggan_nama' => $this->POST('pelanggan_nama'),
                    'pelanggan_alamat' => $this->POST('pelanggan_alamat')
                ]
            );
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->flashmsg('Gagal mengubah data', 'danger');
                redirect('pelanggan');
            } else {
                $this->flashmsg('Sukses mengubah data', 'success');
                redirect('pelanggan');
            }
        } else {
            $data['title'] = 'Update Pelanggan';
            $data['data_pelanggan'] = $this->PelangganModel->get(['pelanggan_id' => $id]);
            $this->render('backend/pelanggan/create-pelanggan', $data);
        }
    }

    public function destroy($id)
    {
        $this->db->trans_start();
        $delete = $this->PelangganModel->delete($id);
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->flashmsg('Gagal menghapus data', 'danger');
            redirect('pelanggan');
        } else {
            $this->flashmsg('Sukses menghapus data', 'success');
            redirect('pelanggan');
        }
    }
}
