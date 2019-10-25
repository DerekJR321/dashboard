<?php if(!defined('BASEPATH')) exit('no direct script access allowed');

class Settings extends CI_Controller {

	public function __construct() {

		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');

	}

	public function index() {

		$data['content'] = 'settings';
		$this->load->view('admin/base_view', $data);
	}
}
