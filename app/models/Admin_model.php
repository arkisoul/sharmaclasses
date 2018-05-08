<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function __destruct()
    {
        $this->db->close();
    }

    public function login($data)
    {
        $sql   = "SELECT * FROM admin WHERE email = ? AND password = ?";
        $query = $this->db->query($sql, array($data['username'], $data['password']));
        if ($query->num_rows() == 1) {
            return true;
        } else {
            return false;
        }
    }

    public function read_user($username)
    {
        $sql   = "SELECT * FROM admin WHERE email = ?";
        $query = $this->db->query($sql, $username);
        if ($query->num_rows() == 1) {
            return $query->result();
        } else {
            return false;
        }
    }

    public function fcmIds()
    {
        $query = $this->db->select('fcm_id')->from('users')->get();
        return $query->result_array();
    }
}
