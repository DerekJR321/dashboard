<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Team_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function get_user_id($id) {
        $this->db->from('user');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function get_all_teams() {
        $this->db->from('teams');
        $query = $this->db->get();
        return $query->result();
    }

    public function get_by_id($id) {
        $this->db->from('teams');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function create($data) {
        $this->db->insert('teams', $data);
        return $this->db->insert_id();
    }

    public function update($data) {
        $where = array('id' => $this->input->post('team_id'));
        $this->db->update('teams', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete() {
        $id = $this->input->post('team_id');
        $this->db->where('id', $id);
        $this->db->delete('teams');
    }
}

