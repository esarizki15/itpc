<?php

class About_query extends CI_Model {

	public function about_header(){
		require_once('about_header_data.php');
		$this->db->select([
			'a.about_header as about_header'
		]);

		$query = $this->db->get('itpc_about a');

		$about_header = [];
	 	array_map(function($item) use(&$about_header){
	 		 $about_header[] = (new about_header_data($item))->to_array();
	 	 }, $query->result_array());

	 	$query->free_result();
	 	$this->db->reset_query();
		return $about_header;
	}

	public function about_detail(){
		require_once('about_title_data.php');
		$this->db->select([
			'a.trans_key as trans_key',
			'b.english as title_english',
			'b.bahasa as title_bahasa',
			'b.spanyol as title_spanyol',
			'c.id as trans_id',
			'c.english as content_english',
			'c.bahasa as content_bahasa',
			'c.spanyol as content_spanyol'
		]);

		$this->db->join('short_translations b','a.trans_key = b.trans_key');
		$query = $this->db->get('itpc_about a');

		$about_title = [];
	 	array_map(function($item) use(&$about_title){
	 		 $about_title[] = (new about_title_data($item))->to_array();
	 	 }, $query->result_array());

	 	$query->free_result();
	 	$this->db->reset_query();

		$this->db->select([
			'c.id as trans_id',
			'c.english as content_english',
			'c.bahasa as content_bahasa',
			'c.spanyol as content_spanyol'
		]);
		$this->db->join('long_translations c','a.trans_key = c.trans_key');
		$query = $this->db->get('itpc_about a');

		$about_content = [];
		array_map(function($item) use(&$about_content){
			 $about_content[] = (new about_content_data($item))->to_array();
		 }, $query->result_array());

		$query->free_result();
 	 	$this->db->reset_query();

		return $about[
				'about_title' => $about_title,


		]
	}

}
