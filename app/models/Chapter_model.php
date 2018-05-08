<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Chapter_model extends CI_model
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
        $query = $this->db->get('chapters');
        return $query->result_array();
    }

    public function getChaptersBySubjectId($id)
    {
        $query = $this->db->select('*')->from('chapters')->where('subject_id', $id)->get();
        return $query->result_array();
    }

    public function getById($id)
    {
        $query = $this->db->select('*')->from('chapters')->where('id', $id)->get();
        return $query->result_array();
    }

    public function add($data)
    {
        return $this->db->insert('chapters', $data);
    }

    public function delete($id)
    {
        return $this->db->delete('chapters', array('id' => $id));
    }

    public function update($id, $data)
    {
        return $this->db->update('chapters', $data, array('id' => $id));
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
