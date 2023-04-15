<?php

class AdminSettingModel extends CI_Model
{
    protected $table = 'settings';
    protected $key = 'setting_id';

    public function getSetting($column, $value)
    {
        $this->db->where($column, $value);
        $this->db->where('status', 1);
        $result = $this->db->get('settings');
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : $this->emptyObject('settings');
    }

    public function getSettingsByCategory($category)
    {
        $this->db->where('category', $category);
        $this->db->order_by('setting_id', 'ASC');
        $this->db->from($this->table);
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function updateSetting($data)
    {
        foreach ($data as $k => $d) {
            $d = removeUselessLineBreaks($d);
            $this->db->where('key', $k);
            $this->db->update('settings', array('value' => $d));
        }
    }

}