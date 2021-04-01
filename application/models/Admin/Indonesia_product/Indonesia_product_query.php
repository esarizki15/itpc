<?php

class Indonesia_product_query extends CI_Model {

	function add_product($product){
	  $result =	$this->db->insert_batch('itpc_indo_product', $product);
	  if(!$result)
	     $this->session->set_flashdata('error', 'Gagal menyimpan data');
	  return $result;
	}


	function get_last_product(){
		$this->db->select([
			'a.indo_product_order as order'
		]);
		$this->db->limit(1);
		$this->db->order_by('a.indo_product_order','DESC');
		$query = $this->db->get('itpc_indo_product a');
		if($query){
			foreach($query->result() as $row){
        return $row->order+1;
       }
		}else{
			return false;
		}

	}

	function getProduct($postData=null){
			require_once('indonesia_product_data.php');
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
					$searchQuery = " (a.indo_product_title like '%".$searchValue."%' or
														a.post_date like '%".$searchValue."%')";
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
			$records = $this->db->get('itpc_indo_product a')->result();
			$totalRecords = $records[0]->allcount;

			## Total number of record with filtering
			$this->db->select('count(*) as allcount');
			if($searchQuery != '')
			$this->db->where($searchQuery);
			$records = $this->db->get('itpc_indo_product a')->result();
			$totalRecordwithFilter = $records[0]->allcount;


			## Fetch records
			//$this->db->select('*');
			$this->db->select([
				'a.indo_product_id as id',
				'a.indo_product_title as title',
				'a.indo_product_thumbnail	as thumbnail',
				'a.indo_product_file as file',
				'a.post_date as post_date',
				'a.status as status'
			]);
			if($searchQuery != '')
			$this->db->where($searchQuery);
			$this->db->where('a.delete_date', null);
			$this->db->order_by($columnName, $columnSortOrder);
			$this->db->limit($rowperpage, $start);
			//$records = $this->db->get('itpc_exporter')->result();
			$records = $this->db->get('itpc_indo_product a');

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
			$product_list = [];

			array_map(function($item) use(&$product_list){
				$product_list[] = (new indonesia_product_data($item))->to_array();
				//$category_list[0]['curr_category'] = "subcategory";
			}, $records->result_array());
			}

			## Response

			if($product_list){

				$response = array(
						"draw" => intval($draw),
						"iTotalRecords" => $totalRecords,
						"iTotalDisplayRecords" => $totalRecordwithFilter,
						"aaData" => $product_list
				);
				return $response;
			}else{
				return FALSE;
			}


	}

}
