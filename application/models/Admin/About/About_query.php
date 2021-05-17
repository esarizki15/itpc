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
		require_once('about_content_data.php');

		$this->db->select([
			'a.trans_key as trans_key',
			'b.english as title_english',
			'b.bahasa as title_bahasa',
			'b.spanyol as title_spanyol'
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


		return $about_content[] = [
				'trans_key' => $about_title[0]['trans_key'],
				'title_english' => $about_title[0]['title_english'],
				'trans_id_content' => $about_content[0]['trans_id'],
				'trans_id_visi' => $about_content[1]['trans_id'],
				'trans_id_mission' => $about_content[2]['trans_id'],
				'content_english' => $about_content[0]['content_english'],
				'visi_english' => $about_content[1]['content_english'],
				'mission_english' => $about_content[2]['content_english'],
				'title_bahasa' => $about_title[0]['title_bahasa'],
				'content_bahasa' => $about_content[0]['content_bahasa'],
				'visi_bahasa' => $about_content[1]['content_bahasa'],
				'mission_bahasa' => $about_content[2]['content_bahasa'],
				'title_spanyol' => $about_title[0]['title_spanyol'],
				'content_spanyol' => $about_content[0]['content_spanyol'],
				'visi_spanyol' => $about_content[1]['content_spanyol'],
				'mission_spanyol' => $about_content[2]['content_spanyol']
		];

		/*return [
				'about_title' => $about_title,
				'about_content' => $about_content
		];*/
	}

}
