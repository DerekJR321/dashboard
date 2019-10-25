<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Player_model extends CI_Model {

    public function __construct() {
		parent::__construct();
	}
	
	public function get_teams() {
		$this->db->from('teams');
		$query = $this->db->get();

		return $query->result();
	}

    public function get_all_players() {
        $query = $this->db->query('SELECT players.*, teams.id AS teamid, teams.teamName FROM players INNER JOIN teams on players.team_id = teams.id');
        return $query->result();
    }

    public function get_by_id($id) {
        $this->db->from('players');
        $this->db->where('id', $id);
        $query = $this->db->get();

        return $query->row();
    }

    public function create($data) {
		$this->db->insert('players', $data);
        return $this->db->insert_id();
    }

    public function update($data) {
        $where = array('id' => $this->input->post('player_id'));
        $this->db->update('players', $data, $where);
        return $this->db->affected_rows();
    }

    public function delete() {
        $id = $this->input->post('player_id');
        $this->db->where('id', $id);
        $this->db->delete('players');
    }
}
