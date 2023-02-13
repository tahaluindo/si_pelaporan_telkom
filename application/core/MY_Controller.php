<?php
class MY_Controller extends CI_Controller
{
    protected function sendingemail($to, $subject, $message)
    {
        $config = [
            'mailtype'   => 'text',
            'charset'    => 'iso-8859-1',
            'protocol'   => 'smptp',
            'smptp_host' => 'ssl://smtp.googlemail.com',
            'smtp_user'  => 'testingemailcodeku@gmail.com',
            'smtp_pass'  => '123yusron,./',
            'smtp_port'  => 465

        ];
        $this->load->library('email', $config);
        $this->email->initialize($config);

        $this->email->from('testingemailcodeku@gmail.com');
        $this->email->to($to);
        $this->email->subject($subject);
        $this->email->message($message);
        $send = $this->email->send();
        if ($send) {
            echo 'success';
        } else {
            show_error($this->email->print_debugger());
        }
    }

    public function do_upload($directory = null)
    {
        $path = APPPATH . 'upload/' . $directory;
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }
        $config['upload_path']          = $path;
        $config['allowed_types']        = 'pdf';
        $config['max_size']             = 10000;
        $this->load->library('upload', $config);
        if (!$this->upload->do_upload('userfile')) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('upload_form', $error);
        } else {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('upload_success', $data);
        }
    }

    protected function text_to_voice($to, $message)
    {
        $userkey = 'gnb6d0';
        $passkey = '18831kyv0o';
        $telepon = $to;
        $message = $message;
        $url = 'https://console.zenziva.net/voice/api/sendvoice/';
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $userkey,
            'passkey' => $passkey,
            'to' => $telepon,
            'message' => $message
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);
    }
    protected function send_sms($params)
    {
        $userkey = 'gnb6d0';
        $passkey = '18831kyv0o';
        $telepon = $params['pelanggan_telepon'];
        if ($params['type'] == '1') {
            $messages = 'Salam Hormat, untuk Bapak/Ibu' . $params['pelanggan_nama'] . '. Laporan anda telah diproses. Mohon untuk menunggu terkait proses laporan yang sudah anda kirimkan. Terima kasih, Salam hormat.';
        } else {
            echo 'Failed!';
            exit;
        }
        $message = $messages;
        $url = 'https://console.zenziva.net/reguler/api/sendsms/';
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $userkey,
            'passkey' => $passkey,
            'to' => $telepon,
            'message' => $message
        ));
        $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);
    }

    protected function send_wa($params)
    {
        
        
        $userkey = 'gnb6d0';
        $passkey = '18831kyv0o';
        $telepon = $params['pelanggan_telepon'];
        if ($params['type'] == '1') {
            $messages = 'Salam Hormat, untuk Bapak/Ibu ' . $params['pelanggan_nama'] . '. Terima kasih telah menggunakan layanan Pelaporan Kerusakan secara Online. Laporan anda telah kami terima. Mohon untuk menunggu terkait proses laporan yang sudah anda kirimkan dalam 1 x 24 jam. Ini adalah pesan otomatis yang dikirim dari sistem kami. Jadi mohon untuk tidak membalas pesan ini. Terima kasih, Salam hormat.';
        } else if ($params['type'] == '2') {
            $messages = 'Salam Hormat, untuk Bapak/Ibu ' . $params['pelanggan_nama'] . '. Terima kasih telah menggunakan layanan Pelaporan Kerusakan secara Online. Laporan anda telah kami proses. Mohon untuk menunggu teknisi yang sudah kami kirimkan kepada anda dalam 2 x 24 jam dan teknisi kami akan akan menghubungi anda melalui nomor yang sudah terdaftar pada sistem kami. Ini adalah pesan otomatis yang dikirim dari sistem kami. Jadi mohon untuk tidak membalas pesan ini. Terima kasih, Salam hormat.';
        } else if ($params['type'] == '3') {
            $messages = 'Salam Hormat, untuk Bapak/Ibu ' . $params['pelanggan_nama'] . '. Terima kasih telah menggunakan layanan Pelaporan Kerusakan secara Online. Laporan anda telah kami ubah setatusnya menjadi selesai karena informasi dari teknisi kami bahwa permasalahan sudah diselesaikan. Ini adalah pesan otomatis yang dikirim dari sistem kami. Jadi mohon untuk tidak membalas pesan ini. Terima kasih, Salam hormat.';
        } else if ($params['type'] == '4') {
            $messages = 'Salam Hormat, untuk Bapak/Ibu ' . $params['pelanggan_nama'] . '. Terima kasih telah menggunakan layanan Pelaporan Kerusakan secara Online. Laporan anda untuk sementara kami tolak. Silahkan ajukan kembali laporan dan akan kami tinjau kembali. Ini adalah pesan otomatis yang dikirim dari sistem kami. Jadi mohon untuk tidak membalas pesan ini. Terima kasih, Salam hormat.';
        } else if($params['type'] == '5'){
            $messages = 'Salam Hormat, untuk Bapak ' . $params['pelanggan_nama'] . '. Anda menerima tugas untuk melakukan perbaikan pelanggan atas nama '.$params['nama_pelanggan'].'. Dengan nomor telepon '.$params['telepon_pelanggan'].'. Di '.$params['alamat_pelanggan'].'. Mohon untuk ditindak lanjuti! Apabila perbaikan telah selesai dilakukan, mohon untuk melakukan konfirmasi dan upload bukti disini : '.$params['url'].'  . Terima kasih.';
        }else {
            echo 'Failed!';
            exit;
        }
        $message = $messages;
        $url = 'https://console.zenziva.net/wareguler/api/sendWA/';
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT, 30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS, array(
            'userkey' => $userkey,
            'passkey' => $passkey,
            'to' => $telepon,
            'message' => $message
        ));
        return $results = json_decode(curl_exec($curlHandle), true);
        curl_close($curlHandle);
    }
    protected function arr_bulan($id)
    {
        $arrNamaBulan = array("01" => "Januari", "02" => "Februari", "03" => "Maret", "04" => "April", "05" => "Mei", "06" => "Juni", "07" => "Juli", "08" => "Agustus", "09" => "September", "10" => "Oktober", "11" => "November", "12" => "Desember");
        return $arrNamaBulan[$id];
    }
    protected function POST($name)
    {
        return $this->input->post($name);
    }
    protected function dump($var)
    {
        echo '<pre>';
        var_dump($var);
        echo '</pre>';
    }
    protected function __generate_random_string($length = 5)
    {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $string = '';
        for ($i = 0; $i < $length; $i++) {
            $string .= $characters[mt_rand(0, strlen($characters) - 1)];
        }
        return $string;
    }

    protected function render($view, $data = '')
    {
        $this->load->view('backend/template/header', $data);
        $this->load->view($view, $data);
        $this->load->view('backend/template/footer');
    }
    protected function renders($view, $data = '')
    {
        $this->load->view('frontend/layouts/header', $data);
        $this->load->view('frontend/layouts/nav', $data);
        $this->load->view('frontend/' . $view, $data);
        $this->load->view('frontend/layouts/footer');
    }
    protected function flashmsg($msg, $type = 'success', $name = 'msg')
    {
        return $this->session->set_flashdata($name, '<div class="alert alert-' . $type . ' alert-dismissable" role="alert">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    ' . $msg . '
                  </div>');
    }
}
