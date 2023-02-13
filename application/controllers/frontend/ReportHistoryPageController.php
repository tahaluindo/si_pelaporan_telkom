<?php
class ReportHistoryPageController extends MY_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('TeknisiModel');
        $this->load->model('ReportModel');
        $this->load->model('PelangganModel');
        $this->load->model('ReportHistoryModel');
    }
    public function index()
    {
        $data = [];
        if(isset($_POST['search'])){
            $laporan = $this->ReportModel->get_data_join(['pelanggan'], ['pelanggan.pelanggan_id='.$this->POST('pelanggan_id')]);
            $data['laporan']=$laporan;
        }
        $this->renders('report-history', $data);
    }

    public function get_history_laporan_pelanggan($pelanggan_id = "")
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
