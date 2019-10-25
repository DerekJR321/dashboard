<?php 

class Common_model extends CI_Model {

	// insert function
	public function insert($data, $table) {
		$this->db->insert($table, $data);
		return $this->db->insert_id();
	}

	// edit function
	function edit_option($action, $id, $table) {
		$this->db->where('id', $id);
		$this->db->update($table, $action);
		return;
	}

	// update function
	function update($action, $id, $table) {
		$this->db->where('id', $id);
		$this->db->update($table, $action);
		return;
	}

	// delete function
	function delete($id, $table) {
		$this->db->delete($table, array('id' => $id));
		return;
	}

	// user role delete function
	function delete_user_role($id, $table) {
		$this->db->delete($table, array('user_id' => $id));
		return;
	}

	// select function
	function select($table) {
		$this->db->select();
		$this->db->from($table);
		$this->db->order_by('id', 'ASC');
		$query = $this->db->get();
		$query = $query->result_array();
		return $query;
	}

	// select by id
	function select_option($id, $table) {
		$this->db->select();
		$this->db->from($table);
		$this->db->where('id', $id);
		$query = $this->db->get();
		$query = $query->result_array();
		return $query;
	}

	// check user role power
	function check_power($type) {
		$this->db->select('ur.*');
		$this->db->from('user_role ur');
		$this->db->where('ur.user_id', $this->session->userdata('id'));
		$this->db->where('ur.action', $type);
		$query = $this->db->get();
		$query = $query->result_array();
		return $query;
	}

	// check email (not active at the moment)
	public function check_email($email) {
		$this->db->select('*');
		$this->db->from('user');
		$this->db->where('email', $email);
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	// check user power level
	public function check_exist_power($id) {
		$this->db->select('*');
		$this->db->from('user_power');
		$this->db->where('power_id', $id);
		$this->db->limit(1);
		$query = $this->db->get();
		if($query->num_rows() == 1) {
			return $query->result();
		} else {
			return false;
		}
	}

	// get all power
	function get_all_power($table) {
		$this->db->select();
		$this->db->from($table);
		$this->db->order_by('power_id', 'ASC');
		$query = $this->db->get();
		$query = $query->result_array();
		return $query;
	}

	// get logged in user info
	function get_user_info() {
		$this->db->select('u.*');
		$this->db->select('c.name as country_name');
		$this->db->from('user u');
		$this->db->join('country c', 'c.id = u.country', 'LEFT');
		$this->db->where('u.id', $this->session->userdata('id'));
		$this->db->order_by('u.id', 'DESC');
		$query = $this->db->get();
		$query = $query->result_array();
		return $query;
	}

	// get single user info
	function get_single_user_info($id) {
		$this->db->select('u.*');
		$this->db->select('c.name as country_name');
		$this->db->from('user u');
		$this->db->join('country c', 'c.id = u.country', 'LEFT');
		$this->db->where('u.id', $id);
		$query = $this->db->get();
		$query = $query->row();
		return $query;
	}

	// get user role
	function get_user_role($id) {
		$this->db->select('ur.*');
		$this->db->from('user_role ur');
		$this->db->where('ur.user_id', $id);
		$query = $this->db->get();
		$query = $query->result_array();
		return $query;
	}

	// get all users with type 2
	function get_all_users() {
		$this->db->select('u.*');
		$this->db->select('c.name as country, c.id as country_id');
		$this->db->from('user u');
		$this->db->join('country c', 'c.id = u.country', 'LEFT');
		$this->db->order_by('u.id', 'DESC');
		$query = $this->db->get();
		$query = $query->result_array();
		return $query;
	}

	// count active, inactive and total users
	function get_user_total() {
		$this->db->select('*');
		$this->db->select('count(*) as total');
		$this->db->select('(SELECT count(user.id)
							FROM user
							WHERE (user.status = 1))
							AS active_user', TRUE);
		$this->db->select('(SELECT count(user.id)
							FROM user
							WHERE(user.status = 0))
							AS inactive_user', TRUE);
		$this->db->select('(SELECT count(user.id)
							FROM user
							WHERE (user.role = "admin"))
							AS admin', TRUE);
		$this->db->from('user');
		$query = $this->db->get();
		$query = $query->row();
		return $query;
	}

	// image upload function with resize option
	function upload_image($max_side) {
		
		// set the upload path
		$config['upload_path']		=	"./assets/uploads/images/";
		$config['allowed_types']	=	'gif|jpg|png|jpeg';
		$config['max_size']			=	'92000';
		$config['max_width']		=	'92000';
		$config['max_height']		=	'92000';

		$this->load->library('upload', $config);

		if($this->upload->do_upload("photo")) {

			$data = $this->upload->data();

			// set upload 
			$source					=	"./assets/uploads/images/".$data['file_name'];
			$destination_thumb		=	"./assets/uploads/images/thumbnail/";
			$destination_medium		=	"./assets/uploads/images/medium/";
			$main_img				=	$data['file_name'];
			// set permission
			chmod($source, 0777);

			// resize processing
			$this->load->library('image_lib');
			$img['image_library']	=	'GD2';
			$img['create_thumb']	=	TRUE;
			$img['maintain_ratio']	=	TRUE;

			// limit resize
			$limit_medium	=	$max_size;
			$limit_thumb	=	200;

			// size image limit
			$limit_use	=	$data['image_width'] > $data['image_height'] ? $data['image_width'] : $data['image_height'];

			// percentage resize
			if ($limit_use > $limit_medium || $limit_use > $limit_thumb) {
				$percent_medium = $limit_medium / $limit_use;
				$percent_thumb = $limit_thumb / $limit_use;
			}

			// create thumbnail
			$img['width'] = $limit_use > $limit_thumb ? $data['image_width'] * $percent_thumb : $data['image_width'];
			$img['height'] = $limit_use > $limit_thumb ? $data['image_height'] * $percent_thumb : $data['image_height'];

			// configure image manipulation for thumbnail :: dynamic
			$img['thumb_marker']	=	'_thumb-'.floor($img['width']).'x'.floor($img['height']);
			$img['quality']			=	'100%';
			$img['source_image']	=	$source;
			$img['new_image']		=	$destination_thumb;

			$thumb_nail = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];

			// resize
			$this->image_lib->initialize($img);
			$this->image_lib->resize();
			$this->image_lib->clear();

			// create medium image
			$img['width']	=	$limit_use > $limit_medium ? $data['image_width'] * $percent_medium : $data['image_width'];
			$img['height']	=	$limit_use > $limit_medium ? $data['image_height'] * $percent_medium : $data['image_height'];

			// configure image manipulation for medium image :: dynamic
			$img['thumb_marker']	=	'_medium-'.floor($img['width']).'x'.floor($img['height']);
			$img['quality']			=	'100%';
			$img['source_image']	=	$source;
			$img['new_image']		=	$destination_medium;

			$mid = $data['raw_name']. $img['thumb_marker'].$data['file_ext'];

			// resize
			$this->image_lib->initialize($img);
			$this->image_lib->resize();
			$this->image_lib->clear();

			// set upload path for medium and thumb
			$images = 'assets/uploads/images/medium/'.$mid;
			$thumb = 'assets/uploads/images/thumbnail/'.$thumb_nail;
			unlink($source);

			return array(
				'images' => $images,
				'thumb' => $thumb
			);
		} else {
			echo "Failed to upload image!";
		}
	}
}
