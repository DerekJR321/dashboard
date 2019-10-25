<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Team extends CI_Controller {

    public function __construct() {

        parent::__construct();
        $this->load->model('admin/Team_model');
    }

    public function index() {
        $data = array();
        $usrinfo = array();
        $data['teams'] = $this->Team_model->get_all_Teams();
        $usrinfo['content'] = 'teams';
		$usrinfo['profile'] = '';
		$usrinfo['page_title'] = 'Teams';
        $this->load->view('admin/inc/header.php', $usrinfo);
        $this->load->view('admin/Teams', $data);
        $this->load->view('admin/inc/footer.php');
    }

    public function get_team_by_id() {
        $id = $this->input->post('id');
        $data = $this->Team_model->get_by_id($id);
        $arr = array('success' => false, 'data' => '');
        if($data) {
            $arr = array('success' => true, 'data' => $data);
        }
        echo json_encode($arr);
    }

    public function store() {
        $data = array(
            'teamName' => $this->input->post('teamName'),
            'teamLogo' => $this->input->post('teamLogo'),
            'teamManager' => $this->input->post('teamManager'),
            
        );

        $status = false;

		$id = $this->input->post('team_id');
		
        if($id) {
            $update = $this->Team_model->update($data);
            $status = true;
        } else {
            $id = $this->Team_model->create($data);
            $status = true;
        }

        $data = $this->Team_model->get_by_id($id);

        echo json_encode(array('status' => $status, 'data' => $data));
    }

    public function delete() {
        $this->Team_model->delete();
        echo json_encode(array('status' => TRUE));
    }


}
