<?php
class Exporter_subcategory_query extends CI_Model{

    public function get($limit,$start,$title,$id) {
          require_once('Exporter_category.php');
        $this->db->select([
    			'a.subcategory_id as id',
    			'a.subcategory_title as title',
          'a.subcategory_slug as slug',
          'COUNT(b.exporter_id ) AS sum'
    		]);
        if(isset($title)) {
          $this->db->like('a.subcategory_title',$title);
        }
        $this->db->where('a.status', 1);
        $this->db->where('a.delete_date', null);
        $this->db->where('a.category_id', $id);
        $this->db->limit($limit, $start);
        $this->db->join('itpc_exporter b','a.subcategory_id=b.subcategory_id','Right');
        $this->db->order_by('a.subcategory_title','ASC');
        $this->db->group_by('a.subcategory_id');
    		$query = $this->db->get('itpc_subcategory a');
    		$category_list = [];
    		array_map(function($item) use(&$category_list){
    			$category_list[] = (new Exporter_category($item))->to_array();
    		}, $query->result_array());
    		$query->free_result();
    		$this->db->reset_query();


        return [
    			'data' => $category_list
    		];
    }

    /*
    $this->db->limit($limit, $start);
  $query = $this->db->get('form');
  return $query->result_array();
    */

}
