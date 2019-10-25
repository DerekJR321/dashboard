<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

    public function __construct() {

		parent::__construct();
		//check_login_user();
		$this->load->model('admin/common_model');

  
    }

    public function index() {
		$data = array();
		$data['page_title'] = 'Dashboard';
		$data['count'] = $this->common_model->get_user_total();
        $data['content'] = 'home';
        $data['profile'] = '';
        $this->load->view('admin/inc/header.php', $data);
        $this->load->view('admin/Home');
        $this->load->view('admin/inc/footer.php');
	}
	
	public function backup($fileName='db_backup.zip') {
		$this->load->dbutil();
		$backup =& $this->dbutil->backup();
		$this->load->helper('file');
		write_file(FCPATH.'/downloads/'.$fileName, $backup);
		$this->load->helper('download');
		force_download($fileName, $backup);
	}
}
