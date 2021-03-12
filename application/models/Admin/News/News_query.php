<?php

class News_query extends CI_Model {

	function news_list($postData=null){
		require_once('list_news.php');
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
			$searchQuery = "(news_title like '%".$searchValue."%')";
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
	$records = $this->db->get('itpc_news')->result();
	$totalRecords = $records[0]->allcount;

	## Total number of record with filtering
	$this->db->select('count(*) as allcount');
	if($searchQuery != '')
	$this->db->where($searchQuery);
	$records = $this->db->get('itpc_news')->result();
	$totalRecordwithFilter = $records[0]->allcount;


	## Fetch records
	//$this->db->select('*');
	$this->db->select([
		'a.news_id as news_id',
		'a.news_title as news_title',
		'a.post_date as post_date',
		'b.admin_name as post_by',
		'a.status as status',
		]);
		if($searchQuery != '')
		$this->db->where($searchQuery);
		$this->db->where('a.delete_date', null);
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		//$records = $this->db->get('itpc_exporter')->result();
		$this->db->join('itpc_admin b','a.post_by = b.admin_id');
		$records = $this->db->get('itpc_news a');

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
		$list_news = [];

		array_map(function($item) use(&$list_news){
			$list_news[] = (new list_news($item))->to_array();
			//$category_list[0]['curr_category'] = "subcategory";
		}, $records->result_array());
	}


	## Response

	if($list_news){

		$response = array(
		"draw" => intval($draw),
		"iTotalRecords" => $totalRecords,
		"iTotalDisplayRecords" => $totalRecordwithFilter,
		"aaData" => $list_news
		);
		return $response;
	}else{
		return FALSE;
	}
}

function tag_list(){
	$this->db->select([
		'a.tag_id as tag_id',
		'a.tag_title as tag_title'
	]);
	$this->db->where('a.delete_date', NULL);
	$this->db->where('a.status', 1);
	$this->db->order_by('a.tag_title','ASC');
	$query = $this->db->get('itpc_tag a');
	if($query){
			return $query->result_array();
	}else{
		return false;
	}
}

function get_last_order(){
	$this->db->select([
		'a.news_order as news_order',
	]);
	$this->db->order_by('a.news_order','DESC');
	$query = $this->db->get('itpc_news a');
	if($query){
		foreach($query->result() as $row){
		 return $row->news_order;
		}
	}else{
		return false;
	}

}

function add_news($news){
  $result =	$this->db->insert_batch('itpc_news', $news);
  if(!$result)
     $this->session->set_flashdata('error', 'Gagal menyimpan data');
  return $result;
}

function delete_news($news){
      $this->db->where('news_id',$news['news_id']);
      $result = $this->db->update('itpc_news', $news);
      return true;
}

function detail_news($news_id){
	require_once('detail_news.php');
	$this->db->select([
		'a.news_id as news_id',
		'a.tag_id as tag_id',
		'd.tag_title as tag_title',
		'a.news_thumbnail_type as news_thumbnail_type',
		'a.news_thumbnail as news_thumbnail',
		'a.news_header as news_header',
		'a.trans_key as trans_key',
		'a.post_date as post_date',
		'a.status as status',
		'b.english as title_english',
		'b.bahasa as title_bahasa',
		'b.spanyol as title_spanyol',
		'c.english as content_english',
		'c.bahasa as content_bahasa',
		'c.spanyol as content_spanyol'
	]);
	$this->db->join('short_translations b','a.trans_key = b.trans_key');
	$this->db->join('long_translations c','a.trans_key = c.trans_key');
	$this->db->join('itpc_tag d','a.tag_id = d.tag_id');
	$this->db->where('a.news_id', $news_id);
	$query = $this->db->get('itpc_news a');


	if($query->num_rows() > 0){
		$detail_news = [];
		array_map(function($item) use(&$detail_news){
			$detail_news[] = (new detail_news($item))->to_array();
			//$category_list[0]['curr_category'] = "subcategory";
		}, $query->result_array());
	}



	return $detail_news;

}


}
