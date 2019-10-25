<?php defined('BASEPATH') OR exit('No direct script access allowed');

Class Users_db extends CI_Model {

	public function __construct() {

		parent::__construct();
		$this->load->database();
	}

	function select() {
		$this->db->select('*');
		$this->db->from('users');
		$query = $this->db->get();
		return $result = $query->result();
	}
}
