<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model("data_model");
        $this->load->model("search_model");
        $this->load->helper(array('form', 'url', 'file'));
    }

    /**
     * Chairman Message
     */
    public function chairman() {
        $data['services'] = $this->data_model->get_name_services();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $data['chairman'] = $this->data_model->get_cms(1);
        $data['social_media'] = $this->data_model->get_social_media();
        $this->load->view('header', $data);
        $this->load->view('chairman');
        $this->load->view('footer');
    }

    /**
     * profile company
     */
    public function download($name_file) {
        $this->load->helper('download');
        $data = file_get_contents("includes/upload/pdf/" . $name_file . ""); // Read the file's contents
        $name = '' . $name_file . '';
        force_download($name, $data);
    }

    public function company_profile() {
        $data['services'] = $this->data_model->get_name_services();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $data['profile'] = $this->data_model->get_cms(2);
        $data['social_media'] = $this->data_model->get_social_media();
        $data['pdf'] = $this->data_model->get_profile();
        $this->load->view('header', $data);
        $this->load->view('profile');
        $this->load->view('footer');
    }

    /**
     * vision & mission
     */
    public function vision_mission() {
        $data['services'] = $this->data_model->get_name_services();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $data['vision'] = $this->data_model->get_cms(3);
        $data['social_media'] = $this->data_model->get_social_media();
        $this->load->view('header', $data);
        $this->load->view('vision_mission');
        $this->load->view('footer');
    }

    /**
     * Core Values
     */
    public function core_value() {
        $data['services'] = $this->data_model->get_name_services();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $data['core'] = $this->data_model->get_cms(4);
        $data['social_media'] = $this->data_model->get_social_media();
        $this->load->view('header', $data);
        $this->load->view('core');
        $this->load->view('footer');
    }

    /**
     * factsheet
     */
    public function factsheet() {
        $data['services'] = $this->data_model->get_name_services();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $data['factsheet'] = $this->data_model->get_cms(5);
        $data['social_media'] = $this->data_model->get_social_media();
        $this->load->view('header', $data);
        $this->load->view('factsheet');
        $this->load->view('footer');
    }

}

/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */