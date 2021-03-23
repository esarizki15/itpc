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



}
