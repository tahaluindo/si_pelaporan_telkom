<?php
class KecamatanModel extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->data['table_name'] = 'districts';
        $this->data['primary_key'] = 'dis_id';
    }
}
