<?php

class BlogModel extends CI_Model
{
    protected $table = 'blogs';
    protected $key = 'blog_id';

    public function getBlog($column, $value)
    {
        $this->db->where($column, $value);
        $this->db->where('status', 1);
        $result = $this->db->get('blogs');
        return ($result->num_rows() == 1) ? objToArr($result->row(0)) : $this->emptyObject('blogs');
    }

    public function getPostsHome()
    {
        $this->db->where('status', 1);
        $this->db->order_by('created_at', 'DESC');
        $this->db->from($this->table);
        $this->db->limit(6, 0);
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function getAll($page, $search, $categories, $limit)
    {
        $offset = $page > 1 ? (($page-1)*$limit) : 0;

        if ($search) {
            $this->db->group_start()->like('title', $search)->or_like('description', $search)->group_end();
        }
        if ($categories) {
            $this->db->where_in('blogs.blog_category_id', $this->sortForSearch($categories));
        }
        $this->db->where('status', 1);
        $this->db->order_by('created_at', 'DESC');
        $this->db->from($this->table);
        $this->db->limit($limit, $offset);
        $query = $this->db->get();
        return objToArr($query->result());
    }

    public function getTotal($search, $categories)
    {
        if ($search) {
            $this->db->group_start()->like('title', $search)->or_like('description', $search)->group_end();
        }
        if ($categories) {
            $this->db->where_in('blogs.blog_category_id', $this->sortForSearch($categories));
        }
        $this->db->where('status', 1);
        $this->db->from($this->table);
        $this->db->group_by('blogs.blog_id');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getCategories($active = true)
    {
        if ($active) {
            $this->db->where('status', 1);
        }
        $this->db->from('blog_categories');
        $query = $this->db->get();
        return objToArr($query->result());
    }

    private function sortForSearch($data)
    {
        $return = array();
        $array = explode(',', $data);
        foreach ($array as $value) {
            if ($value) {
                $return[] = decode($value);
            }
        }
        return $return;
    }

}