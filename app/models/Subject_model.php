<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Subject_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function getAll()
    {
        $query = $this->db->get('subjects');
        return $query->result_array();
    }

    public function getById($id)
    {
        $query = $this->db->select('*')->from('subjects')->where('id', $id)->get();
        return $query->result_array();
    }

    public function add($data)
    {
        return $this->db->insert('subjects', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('subjects', array('id' => $id));
    }

    public function update($id, $data)
    {
        return $this->db->update('subjects', $data, array('id' => $id));
    }

    public function testSubjects()
    {
        $query = $this->db->select('*')->from('subjects')->where('for_test', '1')->get();
        return $query->result_array();
    }

    public function studySubjects()
    {
        $query = $this->db->select('*')->from('subjects')->where('for_study', '1')->get();
        return $query->result_array();
    }

    public function getInsertId()
    {
        return $this->db->insert_id();
    }

    public function getRows()
    {
        return $this->db->affected_rows();
    }
}
