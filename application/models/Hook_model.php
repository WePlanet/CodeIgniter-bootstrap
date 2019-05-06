<?php if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Hook_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

    public function get()
    {
        $response = array();
        
        // Select record
        $this->db->select('*');
        $this->db->order_by('id', 'DESC');
        $this->db->limit(100);
        $q = $this->db->get('');
        $response = $q->result_array();
        return $response;
    }

    public function create($data)
    {
        return $this->db->insert('', $data);
    }

    public function delete(array $key)
    {
        return $this->db->delete('', $key);
    }

    public function update(array $key, array $data)
    {
        $this->db->where($key);
        $this->db->update('', $data);
        return ($this->db->affected_rows() > 0) ? true : false;
    }
}
