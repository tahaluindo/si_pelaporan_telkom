<?php
class LaporanHistoryModel extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->data['table_name'] = 'laporan_history';
        $this->data['primary_key'] = 'id';
    }
}
