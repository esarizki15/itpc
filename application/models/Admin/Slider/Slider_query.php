<?php

class Slider_query extends CI_Model {

	public function Slider_list() {
			require_once('Slider_list_data.php');
			$this->db->select([
				'a.slider_id as slider_id',
				'b.bahasa as title_bahasa',
				'a.file_patch as file_patch',
				'a.link as link',
				'a.post_date as post_date',
				'a.status as status'
			]);
			$this->db->join('short_translations b','a.trans_key = b.trans_key');
	    $this->db->where('a.status !=', 2);
			$this->db->where('a.delete_date', null);
			$query = $this->db->get('itpc_slider a');

			if($query->num_rows() > 0){

				$slider_list = [];

				array_map(function($item) use(&$slider_list){
					$slider_list[] = (new Slider_list_data($item))->to_array();
					//$category_list[0]['curr_category'] = "subcategory";
				}, $query->result_array());

				$query->free_result();
				$this->db->reset_query();
				return $slider_list;

			}else{
				return false;
			}
	}


	public slider_detail(){
		$this->db->select([
			'a.slider_id as slider_id',
			'b.bahasa as title_bahasa',
			'a.file_patch as file_patch',
			'a.link as link',
			'a.post_date as post_date',
			'a.status as status'
		]);
	}

	function submit($slider){
	  $result =	$this->db->insert_batch('itpc_slider', $slider);
	  if(!$result)
	     $this->session->set_flashdata('error', 'Gagal menyimpan data');
	  return $result;
	}

	function cek_status($slider_id){
		$this->db->select([
			'status as status',
		]);
		$this->db->where('slider_id', $slider_id);
		$this->db->where('delete_date', null);
		$query = $this->db->get('itpc_slider');
		if($query){
			foreach($query->result() as $row){
			 return $row->status;
			}
		}else{
			return false;
		}
	}

	function slider_status_update($update,$slider_id){
		$this->db->where('slider_id',$slider_id);
		$result = $this->db->update('itpc_slider', $update);
		return true;
	}


}
