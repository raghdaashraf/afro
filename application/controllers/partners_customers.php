<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Partners_customers extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model("data_model");
        $this->load->model("search_model");
        $this->load->helper(array('form', 'url', 'file'));
    }

    /**
     * partners
     */
    public function partners() {
        $data['services'] = $this->data_model->get_name_services();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $data['partners'] = $this->data_model->get_partners();
        $data['social_media'] = $this->data_model->get_social_media();
        $this->load->view('header', $data);
        $this->load->view('partners');
        $this->load->view('footer');
    }

    /**
     * customers
     */
    public function customers() {
        $data['services'] = $this->data_model->get_name_services();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $data['customers'] = $this->data_model->get_customer();
        $data['social_media'] = $this->data_model->get_social_media();
        $this->load->view('header', $data);
        $this->load->view('client');
        $this->load->view('footer');
    }

}

/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */
