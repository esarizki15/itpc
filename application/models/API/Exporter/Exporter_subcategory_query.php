<?php
class Exporter_subcategory_query extends CI_Model{

    public function get($limit,$start,$title,$id) {
          require_once('Exporter_subcategory.php');
        $this->db->select([
    			'a.subcategory_id as id',
    			'a.subcategory_title as title',
          'a.subcategory_slug as slug',
          'COUNT(b.exporter_id ) AS sum',
          'a.category_id as category',
          'c.category_title as category_title'
    		]);
        if(isset($title)) {
          $this->db->like('a.subcategory_title',$title);
        }
        $this->db->where('a.status', 1);
        //$this->db->where('a.delete_date', null);
        $this->db->where('a.category_id', $id);
        $this->db->limit($limit, $start);
        //$this->db->join('itpc_exporter b','a.subcategory_id=b.subcategory_id','Right');
        //$this->db->join('itpc_category b','a.category_id = b.category_id');
        $this->db->join('itpc_exporter_category b','a.subcategory_id = b.subcategory_id and b.status = 1 and b.delete_date is null');
        $this->db->join('itpc_category c','a.category_id = c.category_id');
        $this->db->order_by('a.subcategory_title','ASC');
        $this->db->group_by('b.subcategory_id');
    		$query = $this->db->get('itpc_subcategory a');



        if($query->num_rows() > 0){

          $category_list = [];

      		array_map(function($item) use(&$category_list){
      			$category_list[] = (new Exporter_subcategory($item))->to_array();
            //$category_list[0]['curr_category'] = "subcategory";
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

    public function subcategory_list() {
      $this->db->select([
        'a.subcategory_id as id',
        'a.category_id as category_id',
        'a.subcategory_title as title'
      ]);
      $this->db->where('a.status', 1);
      $this->db->where('a.delete_date', null);
      $this->db->order_by('a.category_id ASC','a.subcategory_title ASC');
      $query = $this->db->get('itpc_subcategory a');
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
