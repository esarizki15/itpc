<?php

class Exporter_query extends CI_Model {


	public function get_list() {
			require_once('list_exporter_key.php');
			$this->db->select([
				'a.exporter_id as id',
				'a.exporter_name as name',
				'a.exporter_email as email',
				'a.exporter_home as home',
				'a.post_date as date',
				'a.status as status'
			]);
	    $this->db->where('a.status', 1);
			$this->db->where('a.delete_date', null);
			$query = $this->db->get('itpc_exporter a');

			if($query->num_rows() > 0){

				$exporter_list = [];

				array_map(function($item) use(&$exporter_list){
					$exporter_list[] = (new list_exporter_key($item))->to_array();
					//$category_list[0]['curr_category'] = "subcategory";
				}, $query->result_array());

				$query->free_result();
				$this->db->reset_query();
				return $exporter_list;

			}else{
				return false;
			}
	}



	function getEmployees($postData=null){
			require_once('list_exporter_key.php');
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
          $searchQuery = " (exporter_name like '%".$searchValue."%' or exporter_email like '%".$searchValue."%')";
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
      $records = $this->db->get('itpc_exporter')->result();
      $totalRecords = $records[0]->allcount;

      ## Total number of record with filtering
      $this->db->select('count(*) as allcount');
      if($searchQuery != '')
      $this->db->where($searchQuery);
      $records = $this->db->get('itpc_exporter')->result();
      $totalRecordwithFilter = $records[0]->allcount;


      ## Fetch records
      //$this->db->select('*');
			$this->db->select([
				'exporter_id as id',
				'exporter_name as name',
				'exporter_logo as logo',
				'exporter_email as email',
				'post_date as post_date',
				'status as status'
			]);
      if($searchQuery != '')
      $this->db->where($searchQuery);
			$this->db->where('delete_date', null);
      $this->db->order_by($columnName, $columnSortOrder);
      $this->db->limit($rowperpage, $start);
      //$records = $this->db->get('itpc_exporter')->result();
			$records = $this->db->get('itpc_exporter');

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
			$exporter_list = [];

			array_map(function($item) use(&$exporter_list){
				$exporter_list[] = (new list_exporter_key($item))->to_array();
				//$category_list[0]['curr_category'] = "subcategory";
			}, $records->result_array());
			}

      ## Response

			if($exporter_list){

	      $response = array(
	          "draw" => intval($draw),
	          "iTotalRecords" => $totalRecords,
	          "iTotalDisplayRecords" => $totalRecordwithFilter,
	          "aaData" => $exporter_list
	      );
				return $response;
			}else{
				return FALSE;
			}


  }


	function cek_expoter_name($exporter_name){
		$this->db->select([
			'exporter_name as name',
		]);
		$this->db->where('exporter_name', $exporter_name);
		$this->db->where('delete_date', null);
		$query = $this->db->get('itpc_exporter');
		if($query){
			foreach($query->result() as $row){
			 return $row->name;
			}
		}else{
			return false;
		}
	}

	function cek_expoter_email($exporter_email){
			$this->db->select([
				'exporter_email as email',
			]);
			$this->db->where('exporter_email', $exporter_email);
			$this->db->where('delete_date', null);
			$query = $this->db->get('itpc_exporter');
			if($query){
				foreach($query->result() as $row){
				 return $row->email;
				}
			}else{
				return false;
			}
		}

	public function exporter_save($exporter){
		//$result = $this->db->insert('zambert_user',$user);
				$result =	$this->db->insert_batch('itpc_exporter',$exporter);
				if($result){
					 return true;
				}else{
					 return false;
				}
	}

	public function exporter_user_save($user){
		//$result = $this->db->insert('zambert_user',$user);
				$result =	$this->db->insert_batch('itpc_user',$user);
				if($result){
					 return true;
				}else{
					 return false;
				}
		}

	public function exporter_detail($exporter_id){
		require_once('User_data.php');
		require_once('Expoter_data.php');
		require_once('Expoter_categories.php');

		$this->db->select([
			'a.user_id as user_id',
			'a.username as username',
			'a.password_text as password_text',
			'a.email as email',
			'a.status as status'
		]);
		$this->db->where('a.expoter_id', $exporter_id);
		$query = $this->db->get('itpc_user a');

		$user_data = [];
		array_map(function($item) use(&$user_data){
			$user_data[] = (new User_data($item))->to_array();
		}, $query->result_array());

		$query->free_result();
		$this->db->reset_query();

		$this->db->select([
			'a.exporter_id as exporter_id',
			'a.exporter_name as exporter_name',
			'a.exporter_logo as exporter_logo',
			'a.exporter_address as exporter_address',
			'a.exporter_phone as exporter_phone',
			'a.exporter_office_phone as exporter_office_phone',
			'a.exporter_fax as exporter_fax',
			'a.exporter_email as exporter_email',
			'a.exporter_link as exporter_link',
			'a.exporter_home as exporter_home',
			'a.status as status'
		]);
		$this->db->where('a.exporter_id', $exporter_id);
		$query = $this->db->get('itpc_exporter a');

		$expoter_data = [];
		array_map(function($item) use(&$expoter_data){
			$expoter_data[] = (new Expoter_data($item))->to_array();
		}, $query->result_array());

		$query->free_result();
		$this->db->reset_query();


		$this->db->select([
			'a.category_id as category_id',
			'a.category_title as category_title'
		]);
		$this->db->where('a.status', 1);
	 	$this->db->where('a.delete_date', null);
		$this->db->order_by('a.category_title','ASC');
		$query = $this->db->get('itpc_category a');

		$expoter_categories = [];
		array_map(function($item) use(&$expoter_categories){
			$expoter_categories[] = (new Expoter_categories($item))->to_array();
		}, $query->result_array());

		$query->free_result();
		$this->db->reset_query();

		return [
			'user_data' => $user_data,
			'expoter_data' => $expoter_data,
			'expoter_categories' => $expoter_categories
		];

	}

	public function curr_user_password($user_id){
		$this->db->select([
			'a.password_text as password_text'
		]);
		$this->db->where('a.user_id', $user_id);
		$query = $this->db->get('itpc_user a');
		if($query){
			foreach($query->result() as $row){
			 return $row->password_text;
			}
		}else{
			return false;
		}
	}

	public function update_user($update){
		$this->db->where('user_id',$update['user_id']);
    $result = $this->db->update('itpc_user',$update);

    if($result){
      return true;
    }else{
      return false;
    }
	}

	public function curr_logo($exporter_id){
		$this->db->select([
			'a.exporter_logo as exporter_logo'
		]);
		$this->db->where('a.exporter_id', $exporter_id);
		$query = $this->db->get('itpc_exporter a');
		if($query){
			foreach($query->result() as $row){
			 return $row->exporter_logo;
			}
		}else{
			return false;
		}
	}

	public function update_exporter($update){
		$this->db->where('exporter_id',$update['exporter_id']);
    $result = $this->db->update('itpc_exporter',$update);

    if($result){
      return true;
    }else{
      return false;
    }
	}

	public function subcategory_list($postData=null){
		$category_id = $postData['category_id'];
		$this->db->select([
			'a.subcategory_id as subcategory_id',
			'a.subcategory_title as subcategory_title',
		]);
		$this->db->where('a.category_id', $category_id);
		$this->db->where('a.delete_date', NULL);
		$this->db->where('a.status', 1);
		$this->db->order_by('a.subcategory_title','ASC');
		$query = $this->db->get('itpc_subcategory a');
		if($query){
				return $query->result_array();
		}else{
			return false;
		}

	}

	public function exporter_category_list(){
		$this->db->select([
			'a.category_id as category_id',
			'a.category_title as category_title'
		]);
		$this->db->where('a.delete_date', NULL);
		$this->db->where('a.status', 1);
		$this->db->order_by('a.category_order','ASC');
		$query = $this->db->get('itpc_category a');
		if($query){
				return $query->result_array();
		}else{
			return false;
		}
	}

	public function subcategory_save($subcategory){
		$result =	$this->db->insert_batch('itpc_subcategory',$subcategory);
		if($result){
			 return true;
		}else{
			 return false;
		}
	}

	public function get_last_order_subcategory(){
  $this->db->select([
    'a.category_order as category_order'
   ]);
   $this->db->where('a.delete_by', NULL);
   $this->db->limit(1);
   $this->db->order_by('a.category_order','DESC');
   $query = $this->db->get('itpc_category a');
   if($query){
     foreach($query->result() as $row){
       return $row->category_order+1;;
      }
   }else{
     return false;
   }
}

function getSubcategory($postData=null){
		require_once('list_subcategory.php');
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
				$searchQuery = " (a.subcategory_title like '%".$searchValue."%' or
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
		$records = $this->db->get('itpc_subcategory a')->result();
		$totalRecords = $records[0]->allcount;

		## Total number of record with filtering
		$this->db->select('count(*) as allcount');
		if($searchQuery != '')
		$this->db->where($searchQuery);
		$records = $this->db->get('itpc_subcategory a')->result();
		$totalRecordwithFilter = $records[0]->allcount;


		## Fetch records
		//$this->db->select('*');
		$this->db->select([
			'a.subcategory_id as id',
			'a.subcategory_title as subcategory_title',
			'b.category_title as category_title',
			'a.post_date as post_date',
			'a.status as status'
		]);
		if($searchQuery != '')
		$this->db->where($searchQuery);
		$this->db->join('itpc_category b','a.category_id = b.category_id');
		$this->db->where('a.delete_date', null);
		$this->db->order_by($columnName, $columnSortOrder);
		$this->db->limit($rowperpage, $start);
		//$records = $this->db->get('itpc_exporter')->result();
		$records = $this->db->get('itpc_subcategory a');

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
		$exporter_list = [];

		array_map(function($item) use(&$exporter_list){
			$exporter_list[] = (new list_subcategory($item))->to_array();
			//$category_list[0]['curr_category'] = "subcategory";
		}, $records->result_array());
		}

		## Response

		if($exporter_list){

			$response = array(
					"draw" => intval($draw),
					"iTotalRecords" => $totalRecords,
					"iTotalDisplayRecords" => $totalRecordwithFilter,
					"aaData" => $exporter_list
			);
			return $response;
		}else{
			return FALSE;
		}


}

	public function exporter_category_save($expoter_category=null){
		$result =	$this->db->insert_batch('itpc_exporter_category',$expoter_category);
		if($result){
			 return true;
		}else{
			 return false;
		}
	}

	public function list_expoter_categories($postData=null){
		$exporter_id= $postData['exporter_id'];
		$this->db->select([
			'a.ex_cat_id as ex_cat_id',
			'a.exporter_id as exporter_id',
			'b.category_title as category_title',
			'c.subcategory_title as subcategory_title'
		]);

		$this->db->where('a.exporter_id', $exporter_id);
		$this->db->where('a.delete_date', NULL);
		$this->db->where('a.status', 1);
		$this->db->order_by('a.ex_cat_id','DESC');
		$this->db->join('itpc_category b','a.category_id = b.category_id','LEFT');
		$this->db->join('itpc_subcategory c','a.subcategory_id = c.subcategory_id','LEFT');
		$query = $this->db->get('itpc_exporter_category a');
		if($query){
				return $query->result_array();
		}else{
			return false;
		}
	}

	public function exporter_category_delete($update,$ex_cat_id){
		$this->db->where('ex_cat_id',$ex_cat_id);
		$result = $this->db->update('itpc_exporter_category',$update);
		if($result){
			return true;
		}else{
			return false;
		}
	}

	public function exporter_delete($update,$exporter_id){
		$this->db->where('exporter_id',$exporter_id);
		$result = $this->db->update('itpc_exporter',$update);
		if($result){
			return true;
		}else{
			return false;
		}
	}


	public function featured_setting_update($update,$exporter_id){
		$this->db->where('exporter_id',$exporter_id);
		$result = $this->db->update('itpc_exporter',$update);
		if($result){
			return true;
		}else{
			return false;
		}
	}




}
