<?php if(!defined('BASEPATH')) exit('no direct script access allowed');

class Login extends CI_Controller {
    public function __construct()
    {
        parent::__construct();
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');
        $this->load->model('admin/Login_auth_db');
        $this->load->library('session');
    }

    public function index() {
        $this->load->view('admin/login');
    }

    public function login_auth() {
        $data = new stdClass();

        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('admin/Home_model');

        // set validation
        $this->form_validation->set_rules('username', 'Username', 'required|alpha_numeric');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if($this->form_validation->run() === false) {

            // validation failed
            $this->load->view('admin/login');
        } else {

            // set post variables
            $username = $this->input->post('username');
            $password = $this->input->post('password');

            if($this->Login_auth_db->login($username, $password)) {
                $user_data = $this->Login_auth_db->get_user_data($username);

                $user_detail = array(
                    'id'        =>  $user_data['id'],
                    'name'      =>  $user_data['name'],
                    'username'  =>  $user_data['username'],
                    'email'     =>  $user_data['email'],
                    'level'     =>  $user_data['level'],
                    'status'    =>  $user_data['status']
                );

                $this->session->set_userdata('user_data_session', $user_detail);
                $this->session->set_userdata('user_id', $user_detail['id']);
                $this->session->set_userdata('logged_in', true);

                // user logged in successfully
                $data = array();
                $data['selected'] = 'home';
                $data['content'] = 'home';
                $data['profile'] = $this->Home_model->get_user_id($this->session->userdata('user_id'));
                $this->load->view('admin/inc/header', $data);
                $this->load->view('admin/home');
                $this->load->view('admin/inc/footer');

            } else {

                // login failed
                $data->error = 'Incorrect Username or Password';
                $this->load->view('admin/login', $data);
            }
        }
    }

    public function home() {

        $data['content'] = 'dashboard';
        $this->load->view('admin/home', $data);
    }
}
