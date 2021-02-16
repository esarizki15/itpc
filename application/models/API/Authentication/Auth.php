<?php
class Auth extends CI_Model{
    public function cek_auth($auth_code){
      $this->db->select([
        'auth_code as auth_code',
        'user_id as user_id',
      ]);
      $this->db->where('auth_code', $auth_code);
      $query = $this->db->get('itpc_authentication');
      if($query->num_rows() > 0 )
  	 	{
  			 $auth_data = $query->row_array();
  			 return $auth_data;
  	 	}
    }


    /*
    public function cek_auth($user_id){
      $this->db->select([
        'auth_code as auth_code'
      ]);
      $this->db->where('user_id', $user_id);
      $this->db->limit(1);
      $this->db->order_by('auth_id','ASC');
      $query = $this->db->get('itpc_authentication');
      if($query){
        foreach($query->result() as $row){
         return $row->auth_code;
        }
  		}else{
  			return false;
  		}
    }*/





}
