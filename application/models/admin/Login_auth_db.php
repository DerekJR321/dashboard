<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class login_auth_db extends CI_Model {

    public function __construct() {

        parent::__construct();
        

    }

    function login($username, $password) {

        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        $this->db->where('password', $password);
        $query = $this->db->get()->row();

        if (!empty($query)) {

            return true;

        } else {

            return false;

        }

    }

    function get_user_data($username) {

        //$this->load->library('session');
        $this->db->select('*');
        $this->db->from('user');
        $this->db->where('username', $username);
        $query = $this->db->get();

        $user_data = array(
            'id'	        =>	$query->row('id'),
			'name'			=>	$query->row('name'),
			'username'		=>	$query->row('username'),
			'email'			=>	$query->row('email'),
			'mobile'		=>	$query->row('mobile'),
			'country'		=>	$query->row('country'),
			'role'			=>	$query->row('role'),
			'status'		=>	$query->row('status'),
			'user_img'		=>	$query->row('user_img')
        );

        return $user_data;

    }

}
