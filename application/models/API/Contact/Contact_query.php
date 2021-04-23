<?php
class Contact_query extends CI_Model{

    public function get() {
          require_once('Contact_page.php');
          $this->db->select([
    			'contact_map',
    			'contact_header',
          'contact_location',
          'contact_phone',
          'contact_fax',
          'contact_email',
          'contact_website'
    		]);

    		$query = $this->db->get('itpc_contact');
    		$contact_content = [];
    		array_map(function($item) use(&$contact_content){
    			$contact_content[] = (new Contact_page($item))->to_array();
    		}, $query->result_array());
    		$query->free_result();
    		$this->db->reset_query();

        return [
    			'data' => $contact_content
    		];
    }

    /*
    $this->db->limit($limit, $start);
  $query = $this->db->get('form');
  return $query->result_array();
    */

}
