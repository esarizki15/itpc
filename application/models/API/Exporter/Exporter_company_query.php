<?php
class Exporter_company_query extends CI_Model{

    public function get($limit,$start,$title,$id) {
        require_once('Exporter_company.php');
        require_once('Exporter_company_detail.php');
        $this->db->select([
    			'a.exporter_id as id',
    			'a.exporter_name as title',
          'a.exporter_slug as slug',
          'a.exporter_logo as logo',
          'a.exporter_phone as phone',
          'a.exporter_office_phone as office_phone',
          'a.exporter_fax as fax',
          'a.exporter_email as email'
    		]);
        if(isset($title)) {
          $this->db->like('a.exporter_name',$title);
        }
        $this->db->where('a.status', 1);
        $this->db->where('a.delete_date', null);
        $this->db->where('a.subcategory_id', $id);
        $this->db->limit($limit, $start);
        $this->db->order_by('a.exporter_name','ASC');
    		$query = $this->db->get('itpc_exporter a');
    		$exporter_list = [];
    		array_map(function($item) use(&$exporter_list){
    			$exporter_list[] = (new Exporter_company($item))->to_array();
    		}, $query->result_array());


        return [
    			'data' => $exporter_list
    		];
    }


    public function get_detail($id,$icon_group) {
        require_once('Exporter_company_detail.php');
        require_once('Exporter_company_product.php');
        require_once('Exporter_icon.php');

        $this->db->select([
    			'a.exporter_id as id',
    			'a.exporter_name as title',
          'a.exporter_slug as slug',
          'a.exporter_logo as logo',
          'a.exporter_phone as phone',
          'a.exporter_office_phone as office_phone',
          'a.exporter_fax as fax',
          'a.exporter_email as email',
          'a.exporter_link as link'
    		]);
        $this->db->where('a.status', 1);
        $this->db->where('a.delete_date', null);
        $this->db->where('a.exporter_id',$id);
    		$query = $this->db->get('itpc_exporter a');
    		$exporter_detail = [];
    		array_map(function($item) use(&$exporter_detail){
    			$exporter_detail[] = (new Exporter_company_detail($item))->to_array();
    		}, $query->result_array());
        $query->free_result();
        $this->db->reset_query();

        $this->db->select([
          'a.ex_pro_id as image_id',
          'a.ex_pro_image as image_product'
        ]);
        $this->db->where('a.status', 1);
        $this->db->where('a.delete_date', null);
        $this->db->where('a.exporter_id',$id);
        $query = $this->db->get('itpc_exporter_product a');
        $exporter_product = [];

        if(isset($query)){
            $exporter_product[0]['image_id'] = 0;
            $exporter_product[0]['image_product'] = base_url()."assets/website/exporter_product/"."dummy.jpg";
        }

    		array_map(function($item) use(&$exporter_product){
    			$exporter_product[] = (new Exporter_company_product($item))->to_array();
    		}, $query->result_array());
        $query->free_result();
        $this->db->reset_query();

        $this->db->select([
          'icon_id',
          'icon_title',
          'icon_image'
        ]);
        $this->db->where('status', 1);
        $this->db->where('delete_date', null);
        $this->db->where('icon_group', $icon_group);
        $query = $this->db->get('itpc_icon');
        $exporter_icon = [];
    		array_map(function($item) use(&$exporter_icon){
    			$exporter_icon[] = (new Exporter_icon($item))->to_array();
    		}, $query->result_array());


        return [
          'exporter_icon' => $exporter_icon,
    			'exporter_detail' => $exporter_detail,
          'exporter_product' => $exporter_product
    		];
    }



    /*
    $this->db->limit($limit, $start);
  $query = $this->db->get('form');
  return $query->result_array();
    */

}
