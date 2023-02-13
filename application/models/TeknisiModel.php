<?php
class TeknisiModel extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->data['table_name'] = 'teknisi';
        $this->data['primary_key'] = 'teknisi_id';
    }
}
