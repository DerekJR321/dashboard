<?php if(!defined('BASEPATH')) exit('no direct script access allowed');

class Logout extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');

        if(!$this->session->userdata('logged_in')) {
            redirect('admin/login','refresh');
        }
    }

    public function index() {
        $this->session->unset_userdata('user_data_session');
        $this->session->set_userdata('logged_in', false);
        redirect('admin/login');
    }
}
