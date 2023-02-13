<?php
class LevelModel extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->data['table_name'] = 'level';
        $this->data['primary_key'] = 'id_level';
    }
}
