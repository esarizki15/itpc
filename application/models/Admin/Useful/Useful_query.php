<?php

class Useful_query extends CI_Model {

	public function useful_list(){
		require_once('Useful_data.php');
		$this->db->select([
			'useful_id as useful_id',
			'userful_title as userful_title',
			'useful_logo as useful_logo',
			'useful_link as useful_link',
			'post_date as post_date',
			'status as status'
		]);
		$query = $this->db->get('itpc_useful a');

		$useful = [];
	 	array_map(function($item) use(&$useful){
	 		 $useful[] = (new Useful_data($item))->to_array();
	 	 }, $query->result_array());

	 	$query->free_result();
	 	$this->db->reset_query();

		return $useful;
	}

}
