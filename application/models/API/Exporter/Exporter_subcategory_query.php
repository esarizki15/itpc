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
        $this->db->where('a.status',1);
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

          $this->db->select([
            'COUNT(a.subcategory_id) AS total_data'
      		]);
          $this->db->where('a.category_id', $id);
          $query = $this->db->get('itpc_subcategory a');
          if($query){
            foreach($query->result() as $row){
              $total_data = $row->total_data;
            }
          }else{
            return false;
          }


          $last_page = intval($total_data / 10);

          return [
      			'data' => $category_list,
            'total_data' => intval($total_data),
            'last_page' => $last_page
      		];

        }else{
          return false;
        }


    }

    public function subcategory_list() {
      require_once('Subcategory_list.php');
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

        $subcategory_list = [];
        array_map(function($item) use(&$subcategory_list){
          $subcategory_list[] = (new Subcategory_list($item))->to_array();
        }, $query->result_array());

        $query->free_result();
        $this->db->reset_query();

        //return $query->result_array();

        return $subcategory_list;

  	 	}else{
        return false;
      }


    }


    public function subcategory_inquiry_list($exporter_id) {
      require_once('Subcategory_inquiry.php');
      $this->db->select([
        'a.subcategory_id as id',
        'a.category_id as category_id',
        'a.subcategory_title as title'
      ]);
      $this->db->where('a.status', 1);
      $this->db->where('a.delete_date', null);
      $this->db->where('b.exporter_id', $exporter_id);
      $this->db->join('itpc_exporter_category b','a.subcategory_id = b.subcategory_id','Right');
      $this->db->group_by('a.subcategory_id');
      $this->db->order_by('a.subcategory_id ASC','a.subcategory_title ASC');
      $query = $this->db->get('itpc_subcategory a');
      if($query)
  	 	{

        $subcategory_list = [];
        array_map(function($item) use(&$subcategory_list){
          $subcategory_list[] = (new Subcategory_inquiry($item))->to_array();
        }, $query->result_array());

        $query->free_result();
        $this->db->reset_query();

        //return $query->result_array();

        return $subcategory_list;

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
