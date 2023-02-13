<?php
class AdminModel extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->data['table_name'] = 'user';
        $this->data['primary_key'] = 'id_user';
    }

    public function get_all_user()
    {
        $this->db->select('*');
        $this->db->from('user');
        $this->db->join('level', 'level.id_level=user.level_user');
        return $this->db->get()->result();
    }
}
