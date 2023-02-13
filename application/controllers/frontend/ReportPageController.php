<?php
class ReportPageController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('ReportModel');
        $this->load->model('PelangganModel');
        $this->load->model('ReportHistoryModel');
    }
    public function index()
    {
        $data = [];
        $this->renders('report', $data);
    }

    public function create()
    {
        if (isset($_POST['submit'])) {
            $pelanggan = $this->PelangganModel->get(['pelanggan_id' => $this->POST('pelanggan_id')]);
            if (!$pelanggan) {
                echo 'Forbidden access!';
                exit;
            }
            $this->db->trans_start();
            $id = $this->ReportModel->insertID(['laporan_pelanggan' => $this->POST('pelanggan_id'), 'laporan_text' => $this->POST('laporan_text'), 'laporan_status' => 'Menunggu']);
            $this->ReportHistoryModel->insert(['laporan_id' => $id, 'actor' => 'Pelanggan', 'teknisi_id' => NULL, 'text' => $this->POST('laporan_text'), 'created_at' => date("Y-m-d H:i:s")]);
            $this->db->trans_complete();
            if ($this->db->trans_status() === FALSE) {
                $this->flashmsg('Laporan gagal', 'danger');
                redirect('report');
            } else {
                $params = [
                    'type' => '1',
                    'pelanggan_telepon' => $pelanggan[0]->pelanggan_telepon,
                    'pelanggan_nama' => $pelanggan[0]->pelanggan_nama
                ];
                $this->send_wa($params);
                $this->flashmsg('Laporan berhasil dikirim', 'success');
                redirect('report');
            }
        }
    }

    public function get_pelanggan($pelanggan_id = "")
    {
        try {
            $data = $this->PelangganModel->get(['pelanggan_id' => $pelanggan_id]);
            if (count($data) > 0) {
                $status = 'Success';
                $message = 'Data Found';
            } else {
                $status = 'Failed';
                $message = 'Data Not Found';
                $data[0] = [];
            }
        } catch (Exception $e) {
            $status = 'Failed';
            $message = $e->getMessage();
            $data[0] = [];
        }

        $res = [
            'status' => $status,
            'message' => $message,
            'data' => $data[0]
        ];
        echo json_encode($res);
    }
}
