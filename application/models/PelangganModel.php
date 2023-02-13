<?php
class PelangganModel extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->data['table_name'] = 'pelanggan';
        $this->data['primary_key'] = 'pelanggan_id';
    }
}
