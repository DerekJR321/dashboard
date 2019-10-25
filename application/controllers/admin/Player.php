<?php if(!defined('BASEPATH')) exit('No direct script access allowed');

class Player extends CI_Controller {

    public function __construct() {

		parent::__construct();
		$this->load->model('admin/Player_model');

    }

    public function index() {
		$data = array();
		$usrinfo = array();
		$data['teams'] = $this->Player_model->get_teams();
        $data['players'] = $this->Player_model->get_all_Players();
        $usrinfo['content'] = 'players';
		$usrinfo['profile'] = '';
		$usrinfo['page_title'] = 'Players';
        $this->load->view('admin/inc/header.php', $usrinfo);
        $this->load->view('admin/Players', $data);
        $this->load->view('admin/inc/footer.php');
    }

    public function get_player_by_id() {
        $id = $this->input->post('id');
        $data = $this->Player_model->get_by_id($id);
        $arr = array('success' => false, 'data' => '');
        if($data) {
            $arr = array('success' => true, 'data' => $data);
        }
        echo json_encode($arr);
    }

    public function store() {
        $data = array(
            'team_id'               =>   $this->input->post('team_id'),
            'player_name'           =>   $this->input->post('player_name'),
            'player_number'         =>   $this->input->post('player_number'),
            'player_position'       =>   $this->input->post('player_position'),
            'player_shoots'         =>   $this->input->post('player_shoots'),
            'player_height'         =>   $this->input->post('player_height'),
            'player_weight'         =>   $this->input->post('player_weight'),
            'player_dob'            =>   $this->input->post('player_dob'),
            'player_img'            =>   $this->input->post('player_img'),
        );

        $status = false;

        $id = $this->input->post('player_id');

        if($id) {
            $update = $this->Player_model->update($data);
            $status = true;
        } else {
            $id = $this->Player_model->create($data);
            $status = true;
        }

        $data = $this->Player_model->get_by_id($id);

        echo json_encode(array('status' => $status, 'data' => $data));
    }

    public function delete() {
        $this->Player_model->delete();
        echo json_encode(array('status' => TRUE));
    }

}
