<?php if(!defined('BASEPATH')) exit('no direct script access allowed');

class User extends CI_Controller {

	public function __construct() {

		parent::__construct();
		check_login_user();
		$this->load->model('admin/common_model');
		$this->load->model('admin/login_model');
	}

	public function index() {

		$data = array();
		$usrinfo = array();
		$usrinfo['content'] = 'user';
		$usrinfo['profile'] = $this->common_model->get_user_info();
		$data['page_title'] = 'User';
		$data['country'] = $this->common_model->select('country');
		$data['power'] = $this->common_model->get_all_power('user_power');
		
        $this->load->view('admin/inc/header.php', $usrinfo);
        $this->load->view('admin/home', $data);
        $this->load->view('admin/inc/footer.php');

	}

	// add a new user by admin
	public function add() {
		if($_POST) {
			$data = array(
				'name'			=>	$_POST['name'],
				'username'		=>	$_POST['username'],
				'password'		=>	$_POST['password'],
				'email'			=>	$_POST['email'],
				'mobile'		=>	$_POST['mobile'],
				'country'		=>	$_POST['country'],
				'status'		=>	$_POST['status'],
				'role'			=>	$_POST['role'],
				'created_at'	=>	current_datetime()
			);

			$data = $this->security->xss_clean($data);

			// check for duplicate email
			$email = $this->common_model->check_email($_POST['email']);

			if(empty($email)) {
				$user_id = $this->common_model->insert($data, 'user');

				if($this->input->post('role') == "user") {
					$actions = $this->input->post('role_action');
					foreach($actions as $value) {
						$role_data = array(
							'user_id'	=>	$user_id,
							'action'	=>	$value
						);
						$role_data = $this->security->xss_clean($role_data);
						$this->common_model->insert($role_data, 'user_role');
					}
				}
				$this->session->set_flashdata('msg', 'User added Successfully');
				redirect(base_url('admin/user/all_user_list'));
				
			} else {
				$this->session->set_flashdata('error_msg', 'Email already exists. Try another email');
				redirect(base_url('admin/user'));
			}
		}
	}

	public function all_user_list() {
		$usrinfo['content'] = 'userlist';
		$usrinfo['profile'] = $this->common_model->get_single_user_info($id);
		$data['page_title'] = 'All Registered Users';
		$data['users'] = $this->common_model->get_all_users();
		$data['country'] = $this->common_model->select('country');
		$data['count'] = $this->common_model->get_user_total();
		$this->load->view('admin/inc/header.php', $usrinfo);
        $this->load->view('admin/user/users', $data, TRUE);
        $this->load->view('admin/inc/footer.php');
	}

	// update user info
	public function update($id) {
		if($_POST) {

			$data = array(
				'name'			=>	$_POST['name'],
				'mobile'		=>	$_POST['mobile'],
				'country'		=>	$_POST['country'],
				'role'			=>	$_POST['role']
			);
			$data = $this->security->xss_clean($data);

			$powers = $this->input->post('role_action');
			if(!empty($powers)) {
				$this->common_model->delete_user_role($id, 'user_role');
				foreach ($power as $value) {
					$role_data = array(
						'user_id'	=> $id,
						'action'	=> $value
					);
					$role_data = $this->security->xss_clean($role_data);
					$this->common_model->insert($role_data, 'user_role');
				}
			}

			$this->common_model->edit_option($data, $id, 'user');
			$this->session->set_flashdata('msg', 'Information Updated Successfully');
			redirect(base_url('admin/user/all_user_list'));
		}

		$usrinfo = array();
		$usrinfo['content'] 	=	'userlist';
		$usrinfo['profile'] 	= 	$this->common_model->get_single_user_info($id);
		$data['user']			=	$this->common_model->get_single_user_info($id);
		$data['user_role']		=	$this->common_model->get_user_role($id);
		$data['power']			=	$this->common_model->select('user_power');
		$data['country']		=	$this->common_model->select('country');
		$data['page_title']		=	'Edit Users';

		$this->load->view('admin/inc/header.php', $usrinfo);
        $this->load->view('admin/user/edit_user', $data, TRUE);
        $this->load->view('admin/inc/footer.php');
	}

	// active user
	public function active($id) {
		$data = array('status' => 1);
		$data = $this->security->xss_clean($data);
		$this->common_model->update($data, $id, 'user');
		
	}

	// deactivate user
	public function deactive($id) {
		$data = array('status' => 0);
		$data = $this->security->xss_clean($data);
		$this->common_model->update($data, $id, 'user');
		$this->session->$this->session->set_flashdata('msg', 'User Deactivated Successfully');
		redirect(base_url('admin/user/all_user_list'));
	}

	// delete user
	public function delete($id) {
		$this->common_model->delete($id, 'user');
		$this->session->$this->session->set_flashdata('msg', 'User Deleted Successfully');
		redirect(base_url('admin/user/all_user_list'));
	}

	// add user role
	public function power() {
		$usrinfo = array();
		$data = array();
		$usrinfo['content'] 	=	'userlist';
		$usrinfo['profile'] 	= 	$this->common_model->get_single_user_info($id);
		$data['page_title'] 	=	'Add User Role';
		$data['powers']			=	$this->common_model->get_all_power('user_power');
		$this->load->view('admin/inc/header.php', $usrinfo);
		$this->load->view('admin/user/user_power', $data, TRUE);
	}
}
