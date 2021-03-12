<?php

class Langguage_query extends CI_Model {


function language_list(){
	$this->db->select([
		'a.language_id as language_id',
		'a.language_title as language_title',
		'a.language_code as language_code',
	]);
	$this->db->where('a.delete_date', NULL);
	$this->db->where('a.status', 1);
	$this->db->order_by('a.language_id','ASC');
	$query = $this->db->get('itpc_language a');
	if($query){
			return $query->result_array();
	}else{
		return false;
	}
}

function add_short_translations($short_translations){
  $result =	$this->db->insert_batch('short_translations', $short_translations);
  if(!$result)
     $this->session->set_flashdata('error', 'Gagal menyimpan data');
  return $result;
}

function update_short_translations($short_translations){
  $this->db->where('trans_key',$short_translations['trans_key']);
  $result = $this->db->update('short_translations', $short_translations);
  return true;
}

function add_long_translations($long_translations){
  $result =	$this->db->insert_batch('long_translations', $long_translations);
  if(!$result)
     $this->session->set_flashdata('error', 'Gagal menyimpan data');
  return $result;
}

function update_long_translations($long_translations){
  $this->db->where('trans_key',$long_translations['trans_key']);
  $result = $this->db->update('long_translations', $long_translations);
  return true;
}


}
