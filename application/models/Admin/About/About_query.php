<?php

class About_query extends CI_Model {

	public function about(){
		require_once('about_data.php');
		$this->db->select([
			'a.about_content as about_content',
			'a.about_header as about_header'
		]);
		$query = $this->db->get('itpc_about a');

		$about = [];
	 	array_map(function($item) use(&$about){
	 		 $about[] = (new about_data($item))->to_array();
	 	 }, $query->result_array());

	 	$query->free_result();
	 	$this->db->reset_query();

		return $about;
	}

}
