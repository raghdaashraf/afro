<?php

class Data_model extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_sider() {

        $query = $this->db->get('slider');
        return $query->result();
    }

    function get_social_media() {
        $first_db = $this->load->database('default', TRUE);
        $query = $first_db->get('social_media');
        return $query->result();
    }

    function get_news() {
        $first_db = $this->load->database('default', TRUE);
        $query = $first_db->query("SELECT * FROM news WHERE status='publish'  ORDER BY date DESC");

        return $query->result();
    }

    function get_partners() {
        $query = $this->db->get('partners');
        return $query->result();
    }

    function get_customer() {
        $query = $this->db->get('customers');
        return $query->result();
    }

    function get_cms($id) {
        $query = $this->db->get_where('cms', array('id' => $id));
        return $query->row();
    }

    function get_profile() {
        $query = $this->db->get('company_profile');
        return $query->row();
    }

    public function get_awards() {
        $query = $this->db->get('awards');
        return $query->result();
    }

    function get_mangement() {
        $query = $this->db->get('mangment_team');
        return $query->result();
    }

    function get_name_services() {
        $first_db = $this->load->database('default', TRUE);

        $query = $first_db->query('SELECT services.title, services.id, group_concat( services_sub.id_sub ) AS id_sub, group_concat( services_sub.name ) AS sub_name
FROM services
LEFT JOIN services_sub ON services.id = services_sub.id_services
GROUP BY services.title
ORDER BY services.id');
        return $query->result();
    }

    function get_city() {
        $two_db = $this->load->database('two', TRUE);
        $query = $two_db->query("SELECT * FROM city ");
        return $query->result();
    }

    function get_services() {
        $query = $this->db->get('services');
        return $query->result();
    }

    function get_des_services($id) {
        $query = $this->db->get_where('services', array('id' => $id));
        return $query->row();
    }

    function get_subservices() {
        $this->db->select('*');
        $this->db->from('services');
        $this->db->join('services_sub', 'services.id = services_sub.id_services');

        $query = $this->db->get();
        return $query->result();
    }

    function get_content($id) {
        $query = $this->db->get_where('services_sub', array('id_services' => $id));
        return $query->result();
    }

    function get_success($id) {
        $query = $this->db->get_where('success_stories', array('id_services' => $id));
        return $query->result();
    }

    function get_cotact() {
        $query = $this->db->get('contact_us');
        return $query->result();
    }

    function get_contact_egypt() {
        $query = $this->db->query("SELECT * FROM `contact_us` where country='Egypt'");
        return $query->row();
    }

    public function insert_contact($data) {


        $this->db->insert("contact_form", $data);
    }

    public function get_contact_map($id) {
        $query = $this->db->query("SELECT * FROM `contact_map` where id ='$id'");
        return $query->row();
    }

    public function get_career() {
        $query = $this->db->get('careers');
        return $query->result();
    }

    public function insert_careers($data) {
        $this->db->insert("careers_form", $data);
    }

    public function get_des_page($id) {
        $query = $this->db->get_where('pages', array('id' => $id));

        return $query->row();
    }

}
