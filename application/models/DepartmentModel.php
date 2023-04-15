<?php

class DepartmentModel extends CI_Model
{
    protected $table = 'departments';
    protected $key = 'department_id';

    public function getDepartment($column, $value)
    {
        $this->db->where($column, $value);
        $result = $this->db->get('departments');
        return ($result->num_rows() == 1) ? $result->row(0) : $this->emptyObject('departments');
    }

    public function getAll($active = true, $limit = 6)
    {
        if ($active) {
            $this->db->where('status', 1);
        }
        $this->db->from($this->table);
        $this->db->limit($limit, 0);
        $query = $this->db->get();
        return objToArr($query->result());
    }
}