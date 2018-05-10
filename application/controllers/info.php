<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Info extends CI_Controller {

    public function __construct() {

        parent::__construct();

        $this->load->model("data_model");
        $this->load->model("search_model");
        $this->load->helper(array('form', 'url', 'file'));
    }

    /**
     * contact us page
     */
    public function contact_us() {
        $data['services'] = $this->data_model->get_name_services();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $data['contact_us'] = $this->data_model->get_cotact();
        $data['social_media'] = $this->data_model->get_social_media();
        $data['contac_egppt'] = $this->data_model->get_contact_map(1);
        $data['contac_malawi'] = $this->data_model->get_contact_map(2);
        $data['contac_zambia'] = $this->data_model->get_contact_map(3);
        $data['contac_kenya'] = $this->data_model->get_contact_map(4);
        $data['contac_madagascar'] = $this->data_model->get_contact_map(5);

        //print_r($data['contac_map']);die;
        if (!$this->input->post()) {

            $this->load->view('header', $data);

            $this->load->view('contact');

            $this->load->view('footer');
        } else {





            $this->load->library('form_validation');


            $this->form_validation->set_rules('name', 'Your Name', 'trim|required');

            $this->form_validation->set_rules('subject', 'subject', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|email');

            $this->form_validation->set_rules('message', 'Message', 'trim|required');



            if ($this->form_validation->run() == FALSE) {

                $this->load->view('header', $data);

                $this->load->view('contact');

                $this->load->view('footer');
            } else {

                $urname = trim($this->input->post('name', true));

                $uremail = trim($this->input->post('email', true));

                $ursubject = trim($this->input->post('subject', true));

                $urmessage = trim($this->input->post('message', true));

                $data = array('name' => $urname,
                    'email' => $uremail,
                    'subject' => $ursubject,
                    'message' => $urmessage
                );

                $this->data_model->insert_contact($data);

                $uremail = trim($this->input->post('email', true));

                $ursubject = trim($this->input->post('subject', true));

                $urmessage = trim($this->input->post('message', true));

                $this->load->library('email');
                $this->email->from($uremail);

                $this->email->to('raghda.ashraf@click-group.com');

                $this->email->subject($ursubject);

                $this->email->message($messsage);
                $this->email->send();

                print "<script type=\"text/javascript\">alert('Your message has been send');</script>";


                redirect('info/contact_us');
            }
        }
    }

    /**
     * careers
     */
    public function careers() {
        $data['services'] = $this->data_model->get_name_services();
        $data['careers'] = $this->data_model->get_career();
        $data['contact_egypt'] = $this->data_model->get_contact_egypt();
        $data['social_media'] = $this->data_model->get_social_media();
        if (!$this->input->post()) {

            $this->load->view('header', $data);

            $this->load->view('careers');

            $this->load->view('footer');
        } else {
            $this->load->library('form_validation');


            $this->form_validation->set_rules('name', 'Your Name', 'trim|required');
            $this->form_validation->set_rules('address', 'address', 'trim|required');
            $this->form_validation->set_rules('email', 'Email', 'trim|required|email');
            $this->form_validation->set_rules('position', 'position', 'trim|required');
            // $this->form_validation->set_rules('cv', 'cv', 'trim|required');



            if ($this->form_validation->run() == FALSE) {

                $this->load->view('header', $data);

                $this->load->view('careers');

                $this->load->view('footer');
            } else {

                $config['upload_path'] = 'includes/upload/careers';

                $config['allowed_types'] = 'doc|docx|pdf';

                $this->load->library('upload', $config);



                if (!$this->upload->do_upload('cv')) {

                    $error = array('error' => $this->upload->display_errors());
                    print_r($error);
                    die;
                    $this->load->view('header', $data);

                    $this->load->view('careers', $error);
                    $this->load->view('footer');
                } else {

                    array('upload_data' => $this->upload->data());
                    $urname = trim($this->input->post('name', true));
                    $uraddress = trim($this->input->post('address', true));
                    $uremail = trim($this->input->post('email', true));

                    $urposition = trim($this->input->post('position', true));

                    $urcv = $_FILES['cv']['name'];

                    $data = array('name' => $urname,
                        'address' => $uraddress,
                        'email' => $uremail,
                        'position' => $urposition,
                        'cv' => $urcv
                    );

                    $this->data_model->insert_careers($data);
                    $this->load->library('email');

                    $att = $_FILES['cv']['name'];
                    $attach = strip_tags($att);
                    $this->email->from($uremail);
                    $this->email->to('raghda.ashraf@click-group.com');

                    $this->email->subject($urposition);

                    $path = $this->upload->data();

                    $this->email->attach($path['full_path']);
                    $this->email->send();

                    print "<script type=\"text/javascript\">alert('Your E-mail has been send');</script>";


                    redirect('info/careers');
                }
            }
        }
    }

}

/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */