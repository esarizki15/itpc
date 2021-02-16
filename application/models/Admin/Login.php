<?php

class Login extends CI_Model {


	public function login_admin($email,$password) {
		$this->db->select([
			'admin_id ',
			'admin_email',
			'admin_name',
			'admin_password',
			'admin_role'
		]);
		$this->db->where('admin_email',$email);
    $this->db->where('admin_password',$password);
    $this->db->where('status', 1);
		$this->db->where('delete_date', null);
		$query = $this->db->get('itpc_admin');
    if($query){
			return $query->result_array();
		}else{
			return false;
		}

	}
}
