<?php
class JalanModel extends MY_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->data['table_name'] = 'jalan';
        $this->data['primary_key'] = 'id';
    }

    public function get_all_pembangunan()
    {
        $this->db->select('*');
        $this->db->from('jalan');
        $this->db->join('provinces', 'provinces.prov_id=jalan.prov_id');
        $this->db->join('cities', 'cities.city_id=jalan.city_id');
        $this->db->join('districts', 'districts.dis_id=jalan.dis_id', ' left outer');
        $this->db->join('subdistricts', 'subdistricts.subdis_id=jalan.subdis_id', ' left outer');
        return $this->db->get()->result();
    }

    public function get_pembangunan_by_filter($filter = [])
    {
        $this->db->select('*');
        $this->db->from('jalan');
        $this->db->join('provinces', 'provinces.prov_id=jalan.prov_id');
        $this->db->join('cities', 'cities.city_id=jalan.city_id');
        $this->db->join('districts', 'districts.dis_id=jalan.dis_id', ' left outer');
        $this->db->join('subdistricts', 'subdistricts.subdis_id=jalan.subdis_id', ' left outer');
        $this->db->group_start();
        if ($filter['dis_id'] != '0') {
            $this->db->where('jalan.dis_id', $filter['dis_id']);
        }
        $this->db->where('tahun', $filter['tahun']);
        if ($filter['subdis_id'] != '0') {
            $this->db->where('jalan.subdis_id', $filter['subdis_id']);
        }
        $this->db->group_end();
        return $this->db->get()->result();
    }

    public function get_grafik_pembangunan($tahun = null)
    {
        return $this->get_count();
    }

    private function get_count()
    {
        $this->db->select('dis_name, COALESCE(SUM(jalan.panjang_jalan), 0) AS panjang');
        $this->db->from('districts');
        $this->db->join('jalan', 'districts.dis_id=jalan.dis_id', ' left outer');
        $this->db->group_by('districts.dis_id');
        return $this->db->get()->result();
    }

    private function dd($data)
    {
        echo '<pre>';
        var_dump($data);
        echo '</pre>';
    }
}
