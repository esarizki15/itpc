<?php

class Importer_query extends CI_Model {


	public function importer_category_list(){
		$this->db->select([
			'a.category_id as category_id',
			'a.category_title as category_title'
		]);
		$this->db->where('a.delete_date', NULL);
		$this->db->where('a.status', 1);
		$this->db->order_by('a.category_title','ASC');
		$query = $this->db->get('itpc_importer_category a');
		if($query){
				return $query->result_array();
		}else{
			return false;
		}

	}


	public function get_importer_inquery_list($postData=null){
		$category_id = $postData['category_id'];
		$this->db->select([
			'a.importer_id as importer_id',
			'a.importer_name as importer_name'
		]);
		$this->db->join('itpc_importer_product b','a.importer_id = b.importer_id','LEFT');
		$this->db->where('b.category_id',$category_id);
		$this->db->where('b.delete_date', NULL);
		$this->db->where('a.delete_date', NULL);
		$this->db->where('a.status', 1);
		$this->db->order_by('a.importer_name','ASC');
		$this->db->group_by('b.importer_id');
		$query = $this->db->get('itpc_importer a');
		if($query){
				return $query->result_array();
		}else{
			return false;
		}
	}

	public function list_importer_inquiry_list($postData=null){
		 $inquiry_id = $postData['inquiry_id'];

		$this->db->select([
			'a.importer_inquiry_id as importer_inquiry_id',
			'c.importer_name as importer_name',
			'd.category_title as category_title'
		]);
		$this->db->where('a.inquiry_id', $inquiry_id);
		$this->db->where('a.delete_date', NULL);
		$this->db->where('a.status', 1);
		$this->db->join('itpc_importer_product b','a.product_id = b.product_id','LEFT');
		$this->db->join('itpc_importer c','b.importer_id = c.importer_id','LEFT');
		$this->db->join('itpc_importer_category d','b.category_id = d.category_id','LEFT');
		$this->db->group_by('a.importer_inquiry_id');

		$query = $this->db->get('itpc_importer_inquiry a');
		if($query){
				return $query->result_array();
		}else{
			return false;
		}

	}

	public function getImporter($postData=null){
		require_once('list_importer_key.php');
		$response = array();

		## Read value
		$draw = $postData['draw'];
		$start = $postData['start'];
		$rowperpage = $postData['length']; // Rows display per page
		$columnIndex = $postData['order'][0]['column']; // Column index
		$columnName = $postData['columns'][$columnIndex]['data']; // Column name
		$columnSortOrder = $postData['order'][0]['dir']; // asc or desc
		$searchValue = $postData['search']['value']; // Search value

		## Search
		$searchQuery = "";
		if($searchValue != ''){
			$searchQuery = " (a.importer_name like '%".$searchValue."%' or a.importer_city like '%".$searchValue."%')";
		}

		/*
		if($searchValue != ''){
		$searchQuery = " (exporter_name like '%".$searchValue."%' or
		exporter_email like '%".$searchValue."%' or
		post_date like'%".$searchValue."%' or
		status like'%".$searchValue."%' ) ";
	}
	*/


	## Total number of records without filtering
	$this->db->select('count(*) as allcount');
	$records = $this->db->get('itpc_importer a')->result();
	$totalRecords = $records[0]->allcount;

	## Total number of record with filtering
	$this->db->select('count(*) as allcount');
	if($searchQuery != '')
	$this->db->where($searchQuery);
	$records = $this->db->get('itpc_importer a')->result();
	$totalRecordwithFilter = $records[0]->allcount;


	## Fetch records
	//$this->db->select('*');
	$this->db->select([
		'importer_id as id',
		'importer_name as name',
		'importer_city as city',
		'post_date as post_date',
		'status as status'
		]);
		if($searchQuery != '')
		$this->db->where($searchQuery);
		$this->db->where('delete_date', null);
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		//$records = $this->db->get('itpc_exporter')->result();
		$records = $this->db->get('itpc_importer a');

		//$data = array();

		/*foreach($records as $record ){

		$data[] = array(
		"id"=>$record->exporter_id,
		"name"=>$record->exporter_name,
		"email"=>$record->exporter_email,
		"post_date"=>$record->post_date,
		"status"=>$record->status
		);
	}*/

	if($records->num_rows() > 0){
		$impoter_list = [];

		array_map(function($item) use(&$impoter_list){
			$impoter_list[] = (new list_importer_key($item))->to_array();
			//$category_list[0]['curr_category'] = "subcategory";
		}, $records->result_array());
	}

	## Response

	if($impoter_list){

		$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecordwithFilter,
		"aaData" => $impoter_list
		);
		return $response;
	}else{
		return FALSE;
	}
}

public function coutry_list(){
	$this->db->select([
		'a.id as id',
		'a.name as name'
	]);
	$this->db->order_by('a.name','ASC');
	$query = $this->db->get('itpc_country a');
	if($query){
			return $query->result_array();
	}else{
		return false;
	}
}




}
