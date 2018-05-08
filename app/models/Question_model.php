<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Question_model extends CI_model
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
        $query = $this->db->get('questions');
        return $query->result_array();
    }

    public function getQueByTestId($id)
    {
        $query = $this->db->select('*')->from('questions')->where('test_id', $id)->get();
        return $query->result_array();
    }

    public function getById($id)
    {
        $query = $this->db->select('*')->from('questions')->where('id', $id)->get();
        return $query->result_array();
    }

    public function add($data)
    {
        return $this->db->insert('questions', $data);
    }

    public function addBatch($data)
    {
        return $this->db->insert_batch('questions', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('questions', array('id' => $id));
    }

    public function update($id, $data)
    {
        return $this->db->update('questions', $data, array('id' => $id));
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
