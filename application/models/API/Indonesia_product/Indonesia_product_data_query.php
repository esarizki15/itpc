<?php
class Indonesia_product_data_query extends CI_Model{
    public function get_indoensia_product_search($limit,$start,$keyword) {
          require_once('Indonesia_product.php');
            $this->db->select([
              'a.indo_product_id as id',
              'a.indo_product_title as title',
              'a.indo_product_thumbnail as thumbnail',
              'a.indo_product_file as file',
              'a.post_date as post_date'
            ]);
    		$this->db->where('a.status', 1);
        $this->db->where('a.delete_date', null);
        $this->db->like('a.indo_product_title',$keyword);
        $this->db->limit($limit, $start);
        $this->db->order_by('a.post_date','DESC');
    		$query = $this->db->get('itpc_indo_product a');
    		$indo_product = [];
    		array_map(function($item) use(&$indo_product){
    			$indo_product[] = (new Indonesia_product($item))->to_array();
    		}, $query->result_array());
    		$query->free_result();
    		$this->db->reset_query();
        return $indo_product;
    }



    /*
    $this->db->limit($limit, $start);
  $query = $this->db->get('form');
  return $query->result_array();
    */

}
