<?php

class Inquery_query extends CI_Model {

	function Inquery_list($postData=null){
		require_once('list_inquery.php');
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
			$searchQuery = "(inquiry_title like '%".$searchValue."%' or exporter_name like '%".$searchValue."%' )";
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
	$records = $this->db->get('itpc_inquiry')->result();
	$totalRecords = $records[0]->allcount;

	## Total number of record with filtering
	$this->db->select('count(*) as allcount');
	if($searchQuery != '')
	$this->db->where($searchQuery);
	$records = $this->db->get('itpc_inquiry')->result();
	$totalRecordwithFilter = $records[0]->allcount;


	## Fetch records
	//$this->db->select('*');
	$this->db->select([
		'a.inquiry_id  as inquiry_id ',
		'a.inquiry_title as inquiry_title',
		'a.exporter_name as exporter_name',
		'a.progress as progress',
		'a.post_date as post_date',
		'a.approved as approved',
		'a.status as status'
		]);
		if($searchQuery != '')
		$this->db->where($searchQuery);
		$this->db->where('a.delete_date', null);
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		//$records = $this->db->get('itpc_exporter')->result();
		$inquiry = $this->db->get('itpc_inquiry a');

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

	if($inquiry->num_rows() > 0){
		$list_inquiry = [];

		array_map(function($item) use(&$list_inquiry){
			$list_inquiry[] = (new list_inquery($item))->to_array();
			//$category_list[0]['curr_category'] = "subcategory";
		}, $inquiry->result_array());
	}


	## Response

	if($list_inquiry){

		$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecordwithFilter,
		"aaData" => $list_inquiry
		);
		return $response;
	}else{
		return FALSE;
	}
}


function Inquery_detail($inquiry_id){

	require_once('detail_inquery.php');
	require_once('file_inquery.php');

	$this->db->select([
		'a.inquiry_id as inquiry_id',
		'a.exporter_id as exporter_id',
		'a.inquiry_title as inquiry_title',
		'a.exporter_name as exporter_name',
		'a.exporter_address as exporter_address',
		'a.progress as progress',
		'a.product_detail as product_detail',
		'a.product_capacity as product_capacity',
		'a.have_export as have_export',
		'a.contact_name as contact_name',
		'a.contact_email as contact_email',
		'a.contact_phone as contact_phone',
		'a.post_date as post_date',
		'a.update_date as update_date',
		'a.approved as approved',
		'b.category_title as category_title',
		'c.subcategory_title as subcategory_title',
		'a.status as status'
	]);

	 $this->db->where('a.inquiry_id', $inquiry_id);
	 $this->db->join('itpc_category b','a.category_id = b.category_id','LEFT');
	 $this->db->join('itpc_subcategory c','a.subcategory_id = c.subcategory_id','LEFT');
	 $query = $this->db->get('itpc_inquiry a');

	 $inquiry_detail = [];
	 array_map(function($item) use(&$inquiry_detail){
		 $inquiry_detail[] = (new detail_inquery($item))->to_array();
	 }, $query->result_array());

	 $query->free_result();
	 $this->db->reset_query();

	 $get_inquiry_id = $inquiry_detail[0]['inquiry_id'];

	 $this->db->select([
 		'a.file_id as file_id',
 		'a.file_patch as file_patch',
 		'a.post_date as post_date'
 	]);
	 $this->db->where('a.inquiry_id', $get_inquiry_id);
	 $this->db->where('a.delete_date', null);
	 $this->db->where('a.status', 1);
	 $query = $this->db->get('itpc_files_inquiry a');

	 $inquiry_file = [];
	 array_map(function($item) use(&$inquiry_file){
		 $inquiry_file[] = (new file_inquery($item))->to_array();
	 }, $query->result_array());

	 $query->free_result();
	 $this->db->reset_query();

	 return [
		 'inquiry_detail' => $inquiry_detail,
		 'inquiry_file' => $inquiry_file
	 ];

}

function update_approved($update){
	$this->db->where('inquiry_id',$update['inquiry_id']);
	$result = $this->db->update('itpc_inquiry',$update);
	if($result){
		return true;
	}else{
		return false;
	}
}


}