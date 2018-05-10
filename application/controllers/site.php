<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Site extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model("data_model");
        $this->load->model("search_model");
        $this->load->helper(array('form', 'url', 'file'));
    }

    public function index() {
        $data['services'] = $this->data_model->get_name_services();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $data['sliders'] = $this->data_model->get_sider();
        $data['social_media'] = $this->data_model->get_social_media();
        $data['why'] = $this->data_model->get_cms(6);
        $data['what'] = $this->data_model->get_cms(7);
        $data['news'] = $this->data_model->get_news();
        $data['city'] = $this->data_model->get_city();
        $this->load->view('header', $data);
        $this->load->view('index');
        $this->load->view('footer');
    }

    /**
     * news
     */
    public function news() {

        $data['social_media'] = $this->data_model->get_social_media();
        $data['services'] = $this->data_model->get_name_services();
        $data['news'] = $this->data_model->get_news();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $this->load->view('header', $data);
        $this->load->view('all_news');
        $this->load->view('footer');
    }

    /**
     * Awards& Recognitions
     */
    public function awards() {
        $data['services'] = $this->data_model->get_name_services();
        $data['awards'] = $this->data_model->get_awards();
        $data['social_media'] = $this->data_model->get_social_media();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $this->load->view('header', $data);
        $this->load->view('awards');
        $this->load->view('footer');
    }

    /**
     * mangement team
     */
    public function mangement_team() {
        $data['services'] = $this->data_model->get_name_services();
        $data['mangement'] = $this->data_model->get_mangement();
        $data['social_media'] = $this->data_model->get_social_media();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $this->load->view('header', $data);
        $this->load->view('mangement');
        $this->load->view('footer');
    }

    /**
     * search
     */
    public function search() {
        $data['search_cms'] = $this->search_model->search_cms();
        $data['services_solutions'] = $this->search_model->search_services();
        $data['search_news'] = $this->search_model->search_news();
        $data['search_mangement'] = $this->search_model->search_mangement();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $data['services'] = $this->data_model->get_name_services();
        $data['social_media'] = $this->data_model->get_social_media();
        $data['page'] = $this->data_model->get_des_page(14);
        $this->load->view('header', $data);
        $this->load->view('search');
        $this->load->view('footer');
    }

    function check_method() {
        $class = $this->class;
        if (class_exists($class)) {
            if (!in_array('_remap', array_map('strtolower', get_class_methods($class)))                     // <-- Allows me to use the _remap function in my controllers without throwing a 404 error 
                    && !in_array(strtolower($this->method), array_map('strtolower', get_class_methods($class)))) {
                $this->class = $this->error_controller;
                $this->method = $this->error_method_404;
                include(APPPATH . 'controllers/' . $this->fetch_directory() . $this->error_controller . EXT);
            }
        }
    }

}

/* End of file welcome.php */
      
/* Location: ./application/controllers/welcome.php */