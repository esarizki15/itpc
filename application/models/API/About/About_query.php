<?php
class About_query extends CI_Model{

    public function get() {
          require_once('About_page.php');
          $this->db->select([
    			'about_content',
    			'about_header'
    		]);

    		$query = $this->db->get('itpc_about');
    		$about_content = [];
    		array_map(function($item) use(&$about_content){
    			$about_content[] = (new About_page($item))->to_array();
    		}, $query->result_array());
    		$query->free_result();
    		$this->db->reset_query();

        return [
    			'data' => $about_content
    		];
    }

    /*
    $this->db->limit($limit, $start);
  $query = $this->db->get('form');
  return $query->result_array();
    */

}
