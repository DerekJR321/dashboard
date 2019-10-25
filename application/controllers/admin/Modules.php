<?php if(!defined('BASEPATH')) exit('no direct access script allowed');

class Modules extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->helper('url');
        $this->load->library('session');
        $this->load->model('admin/Modules_db');

    }

    public function index() {
        $data = array();
        $module_data = $this->Modules_db->select();

        if($module_data !== null) {
            $data['result'] = $module_data;
            $data['checking_status'] = 1;
        } else {
            $data['checking_status'] = 0;
        }

        $data['content'] = 'modules';
        $this->load->view('admin/base_view', $data);
    }
}
