<?php
class ReportController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ReportModel');
        $this->load->model('PelangganModel');
        $this->load->model('TeknisiModel');
        $this->load->model('LaporanHistoryModel');
    }
    public function index()
    {
        $this->loginValidator();
        $data['title'] = 'Data Laporan';
        $data['laporan'] = $this->ReportModel->get_laporan();
        $this->render('backend/laporan/data-laporan', $data);
    }

    public function proses($id = null)
    {
        $this->loginValidator();
        if (isset($_POST['submit'])) {
            $pelanggan = $this->ReportModel->get_data_join(['pelanggan'], ['pelanggan.pelanggan_id=laporan.laporan_pelanggan']);
            $teknisi = $this->TeknisiModel->get(['teknisi_id'=>$this->POST('laporan_teknisi')]);

            if (!$pelanggan) {
                echo 'Forbidden access!';
                exit;
            }
            $this->db->trans_start();
            $insert = $this->ReportModel->update($this->POST('laporan_id'), ['laporan_status' => 'Proses']);
            $this->LaporanHistoryModel->insert(['laporan_id' => $id, 'actor' => 'Teknisi', 'teknisi_id' => $this->POST('laporan_teknisi'), 'text' =>$this->POST('laporan_text'), 'created_at' => date("Y-m-d H:i:s")]);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->flashmsg('Gagal mengubah data', 'danger');
                redirect('laporan');
            } else {
                $params = [
                    'type' => '2',
                    'pelanggan_telepon' => $pelanggan[0]->pelanggan_telepon,
                    'pelanggan_nama' => $pelanggan[0]->pelanggan_nama
                ];
                $this->send_wa($params);
                $teknisi = [
                    'type'=> '5',
                    'pelanggan_telepon'=>$teknisi[0]->teknisi_telepon,
                    'pelanggan_nama'=>$teknisi[0]->teknisi_nama,
                    'nama_pelanggan'=>$pelanggan[0]->pelanggan_nama,
                    'telepon_pelanggan'=>$pelanggan[0]->pelanggan_telepon,
                    'alamat_pelanggan'=>$pelanggan[0]->pelanggan_alamat,
                    'url'=> site_url().'laporan/done/'.$this->POST('laporan_id')
                    
                ];
                $this->send_wa($teknisi);
                $this->flashmsg('Sukses mengubah data', 'success');
                redirect('laporan');
            }
        } else {
            $data['title'] = 'Proses Laporan';
            $data['data_laporan'] = $this->ReportModel->get_laporan_by_id($id);
            $data['data_teknisi'] = $this->TeknisiModel->get($id);
            $this->render('backend/laporan/proses-laporan', $data);
        }
    }

    public function reject($id = null)
    {
        $this->loginValidator();
        $pelanggan = $this->ReportModel->get_data_join(['pelanggan'], ['pelanggan.pelanggan_id=laporan.laporan_pelanggan']);
        if (!$pelanggan) {
            echo 'Forbidden access!';
            exit;
        }
        $this->db->trans_start();
        $this->ReportModel->update($id, ['laporan_status' => 'Ditolak']);
        $this->LaporanHistoryModel->insert(
            [
                'laporan_id' => $id,
                'actor' => 'Admin',
                'text' => 'Laporan Ditolak',
                'created_at' => date("Y-m-d H:i:s")
            ]
        );
        $this->db->trans_complete();
        if ($this->db->trans_status() === FALSE) {
            $this->flashmsg('Gagal menolak laporan', 'danger');
            redirect('laporan');
        } else {
            $params = [
                'type' => '4',
                'pelanggan_telepon' => $pelanggan[0]->pelanggan_telepon,
                'pelanggan_nama' => $pelanggan[0]->pelanggan_nama
            ];
            $this->send_wa($params);
            $this->flashmsg('Sukses menolak laporan ', 'success');
            redirect('laporan');
        }
    }

    public function done($id=null){
        if (isset($_POST['submit'])) {
            $pelanggan = $this->ReportModel->get_data_join(['pelanggan'], ['pelanggan.pelanggan_id=laporan.laporan_pelanggan']);
            $teknisi = $this->TeknisiModel->get(['teknisi_id'=>$this->POST('laporan_teknisi')]);

            if (!$pelanggan) {
                echo 'Forbidden access!';
                exit;
            }
            $this->db->trans_start();
            $insert = $this->ReportModel->update($id, ['laporan_status' => 'Selesai']);
            $this->LaporanHistoryModel->insert(['laporan_id' => $id, 'actor' => 'Admin', 'teknisi_id' => $this->POST('laporan_teknisi'), 'text' =>'Selesai - '.$this->POST('hasil_pemeriksaan'), 'created_at' => date("Y-m-d H:i:s")]);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->flashmsg('Gagal mengubah data', 'danger');
                redirect('laporan');
            } else {
                $params = [
                    'type' => '3',
                    'pelanggan_telepon' => $pelanggan[0]->pelanggan_telepon,
                    'pelanggan_nama' => $pelanggan[0]->pelanggan_nama
                ];
                $this->send_wa($params);
                $this->flashmsg('Sukses mengubah data', 'success');
                redirect('home');
            }
        }else{
            $data['laporan'] = $this->ReportModel->get_detail_laporan($id);
            $data['title'] = 'Laporan Hasil Tindakan';
            $this->renders('konfirmasi', $data);
        }
    }

    private function loginValidator(){
        $this->data['token'] = $this->session->userdata('token');
        if (empty($this->data['token'])) {
            $this->flashmsg('Anda harus login dulu!', 'danger');
            redirect('login');
        }
    }
}
