<?php if(!defined('BASEPATH')) exit('no direct script access allowed');

class Profile extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->database();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->model('admin/Profile_model');

		// protect the controller from unregistered users
		if(!$this->session->userdata('logged_in')) {

			redirect('admin/login','refresh');
		}
	}

	public function index() {
        $data = array();
        $data['profile'] = $this->Profile_model->get_user_id($this->session->userdata('user_id'));
		$data['content'] = 'profile';
		$this->load->view('admin/inc/header.php', $data);
		$this->load->view('admin/Profile.php', $data);
		$this->load->view('admin/inc/footer.php');
	}

}
