<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Services_solutions extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model("data_model");
        $this->load->model("search_model");
        $this->load->helper(array('form', 'url', 'file'));
    }

    /**
     * services
     */
    public function services($id) {
        $data['desc'] = $this->data_model->get_des_services($id);
        $data['social_media'] = $this->data_model->get_social_media();
        $data['services'] = $this->data_model->get_name_services();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        if ($data['desc']) {
            //$data['services']=$this->data_model->get_services();
            //$data['sub_services']=$this->data_model->get_subservices();

            $data['content'] = $this->data_model->get_content($id);
            $data['success'] = $this->data_model->get_success($id);

            $this->load->view('header', $data);
            $this->load->view('enterprise_solutions');
            $this->load->view('footer');
        } else {
            redirect(site);
        }
    }

}

/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */