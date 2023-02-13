<?php
class KelurahanModel extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->data['table_name'] = 'subdistricts';
        $this->data['primary_key'] = 'subdis_id';
    }

    public function get_kelurahan_by_kecamatan($id = null)
    {
        $this->db->select('*');
        $this->db->from('subdistricts');
        $this->db->where('dis_id', $id);
        return $this->db->get()->result();
    }
}
