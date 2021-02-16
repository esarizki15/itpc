<?php
class Exporter_category_query extends CI_Model{

    public function get($limit,$start,$title) {
        require_once('Exporter_category.php');
        $this->db->select([
    			'a.category_id as id',
    			'a.category_title as title',
          'a.category_slug as slug',
          'COUNT(b.subcategory_id) AS sum'
    		]);
        if(isset($title)) {
          $this->db->like('a.category_title',$title);
        }
        $this->db->like('a.category_title',$title);
        $this->db->where('a.status', 1);
        $this->db->where('a.delete_date', null);
        $this->db->limit($limit, $start);
        $this->db->order_by('a.category_title','ASC');
        $this->db->join('itpc_subcategory b','a.category_id = b.category_id and b.status = 1 and b.delete_date is null','Right');
        $this->db->group_by('a.category_id');
    		$query = $this->db->get('itpc_category a');
        if($query->num_rows() > 0){
          $category_list = [];
      		array_map(function($item) use(&$category_list){
      			$category_list[] = (new Exporter_category($item))->to_array();
      		}, $query->result_array());
      		$query->free_result();
      		$this->db->reset_query();



          return [
      			'data' => $category_list
      		];
        }else{
          return false;
        }


    }

    public function category_list() {
      $this->db->select([
        'a.category_id as id',
        'a.category_title as title'
      ]);
      $this->db->where('a.status', 1);
      $this->db->where('a.delete_date', null);
      $this->db->order_by('a.category_title','ASC');
      $query = $this->db->get('itpc_category a');
      if($query)
  	 	{
        return $query->result_array();
  	 	}else{
        return false;
      }
    }

    public function category_curr_list($exporter_id){
      $this->db->select([
        'a.ex_cat_id as ex_cat_id',
        'b.category_title as title',
        'c.subcategory_title as sub_title'
      ]);
      $this->db->where('a.status', 1);
      $this->db->where('a.delete_date', null);
      $this->db->where('a.exporter_id', $exporter_id);
      $this->db->join('itpc_category b','a.category_id = b.category_id','Right');
      $this->db->join('itpc_subcategory c','a.subcategory_id = c.subcategory_id','Right');
      $this->db->order_by('a.ex_cat_id','ASC');
      $query = $this->db->get('itpc_exporter_category a');
      if($query)
      {
        return $query->result_array();
      }else{
        return false;
      }

    }

    /*
    $this->db->limit($limit, $start);
  $query = $this->db->get('form');
  return $query->result_array();
    */

}
