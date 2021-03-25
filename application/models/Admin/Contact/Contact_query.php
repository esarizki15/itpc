<?php

class Contact_query extends CI_Model {

	public function contact(){
		require_once('contact_data.php');
		$this->db->select([
			'b.english as content_english',
			'b.bahasa as content_bahasa',
			'b.spanyol as content_spanyol',
			'a.contact_header as contact_header'
		]);
		$this->db->join('short_translations b','a.trans_key = b.trans_key');
		$query = $this->db->get('itpc_contact a');

		$contact = [];
	 	array_map(function($item) use(&$contact){
	 		 $contact[] = (new contact_data($item))->to_array();
	 	 }, $query->result_array());

	 	$query->free_result();
	 	$this->db->reset_query();

		return $contact;
	}

}
