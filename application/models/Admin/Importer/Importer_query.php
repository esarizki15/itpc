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

	public function Importer_product_list(){
		$this->db->select([
			'a.category_id as category_id',
			'a.category_title	as category_title'
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

	public function importer_detail($id){
		require_once('Detail_importer_key.php');
		$this->db->select([
			'a.importer_id as importer_id',
			'a.importer_name as importer_name',
			'a.importer_detail as importer_detail',
			'a.importer_address as importer_address',
			'a.importer_city as importer_city',
			'a.importer_provience	 as importer_provience',
			'b.id as id',
			'b.name as name',
			'a.importer_postal as importer_postal',
			'a.contact_name as contact_name',
			'a.contact_office_phone	 as contact_office_phone',
			'a.contact_phone as contact_phone',
			'a.contact_fax as contact_fax',
			'a.contact_email as contact_email',
			'a.contact_website as contact_website',
			'a.social_twitter as social_twitter',
			'a.social_facebook as social_facebook',
			'a.social_google as social_google',
			'a.post_date as post_date',
			'a.update_date as update_date',
			'a.status as status',
		]);
		$this->db->join('itpc_country b','a.country_id = b.id','LEFT');
		$this->db->where('a.importer_id', $id);
		$query = $this->db->get('itpc_importer a');
		if($query->num_rows() > 0){

			$importer_detail = [];

			array_map(function($item) use(&$importer_detail){
				$importer_detail[] = (new Detail_importer_key($item))->to_array();
				//$category_list[0]['curr_category'] = "subcategory";
			}, $query->result_array());

			$query->free_result();
			$this->db->reset_query();
			return $importer_detail;

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


public function getImporter_filter($postData=null){
	require_once('list_importer_key.php');
	$response = array();

	## Read value
	$draw = $postData['draw'];
	$start = $postData['start'];
	$categoryId = $postData['categoryId'];
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
if($categoryId > 0){
	$this->db->join('itpc_importer_product b','a.importer_id = b.importer_id','LEFT');
	$this->db->where('b.category_id',$categoryId);
	$this->db->where('b.status',1);
	$this->db->where('b.delete_date', null);
}
$this->db->select('count(*) as allcount');
$records = $this->db->get('itpc_importer a')->result();
$totalRecords = $records[0]->allcount;

## Total number of record with filtering
if($categoryId > 0){
	$this->db->join('itpc_importer_product b','a.importer_id = b.importer_id','LEFT');
	$this->db->where('b.category_id',$categoryId);
	$this->db->where('b.status',1);
	$this->db->where('b.delete_date', null);
}
$this->db->select('count(*) as allcount');
if($searchQuery != '')
$this->db->where($searchQuery);
$records = $this->db->get('itpc_importer a')->result();
$totalRecordwithFilter = $records[0]->allcount;


## Fetch records
//$this->db->select('*');
$this->db->select([
	'a.importer_id as id',
	'a.importer_name as name',
	'a.importer_city as city',
	'a.post_date as post_date',
	'a.status as status'
	]);
	if($categoryId > 0){
		$this->db->join('itpc_importer_product b','a.importer_id = b.importer_id','LEFT');
		$this->db->where('b.status',1);
		$this->db->where('b.delete_date', null);
	}
	if($searchQuery != '')
	$this->db->where($searchQuery);
	$this->db->where('a.delete_date', null);
	if($categoryId > 0){
		$this->db->where('b.category_id',$categoryId);
	}
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

public function importer_submit($importer){
	$result =	$this->db->insert_batch('itpc_importer', $importer);
	$insert_id = $this->db->insert_id();

	if(!$result)
		 $this->session->set_flashdata('error', 'Gagal menyimpan data');
	//return $result;
	$this->db->trans_start();
	$this->db->trans_complete();
	return $insert_id;
}

public function importer_product_save($importer_product){
	$result =	$this->db->insert_batch('itpc_importer_product',$importer_product);
	if($result){
		 return true;
	}else{
		 return false;
	}
}

public function list_importer_product_categories($postData=null){
	$importer_id= $postData['importer_id'];
	$this->db->select([
		'a.product_id as product_id',
		'a.importer_id as importer_id',
		'a.category_id as category_id',
		'b.category_title as category_title'
	]);

	$this->db->where('a.importer_id', $importer_id);
	$this->db->where('a.delete_date', NULL);
	$this->db->where('a.status', 1);
	$this->db->order_by('a.product_id','DESC');
	$this->db->join('itpc_importer_category b','a.category_id = b.category_id','LEFT');
	$query = $this->db->get('itpc_importer_product a');
	if($query){
			return $query->result_array();
	}else{
		return false;
	}
}


public function importer_product_delete($delete,$product_id){
	$this->db->where('product_id',$product_id);
	$result = $this->db->update('itpc_importer_product',$delete);
	if($result){
		return true;
	}else{
		return false;
	}
}




}
