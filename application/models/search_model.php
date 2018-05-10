<?php

class Search_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    public function search_cms() {

        $key = trim($this->input->post('key', true));
        $this->db->select('*');
        $this->db->from('cms');
        $this->db->like('title', $key);
        $res = $this->db->get();
        return $res->result();
    }

    public function search_services() {

        $key = trim($this->input->post('key', true));
        $this->db->select('*');
        $this->db->from('services');
        $this->db->like('title', $key);
        $res = $this->db->get();
        return $res->result();
    }

    public function search_news() {
        $key = trim($this->input->post('key', true));
        $this->db->select('*');
        $this->db->from('news');
        $this->db->like('title', $key);
        $res = $this->db->get();
        return $res->result();
    }

    public function search_mangement() {
        $key = trim($this->input->post('key', true));

        $this->db->select('*');

        $this->db->from('mangment_team');

        $this->db->like('name', $key);

        $res = $this->db->get();

        return $res->result();
    }

}
