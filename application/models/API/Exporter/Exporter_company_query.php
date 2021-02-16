<?php
class Exporter_company_query extends CI_Model{

  public $exporter_id;
  public $exporter_name;
  public $exporter_slug;
  public $exporter_logo;
  public $exporter_address;
  public $exporter_phone;
  public $exporter_office_phone;
  public $exporter_fax;
  public $exporter_email;
  public $exporter_link;
  public $category_id;
  public $subcategory_id;
  public $post_date;
  public $post_by;
  public $delete_date;
  public $delete_by;
  public $status;

  public function register_exporter($exporter){
  //$result = $this->db->insert('zambert_user',$user);
  $result =	$this->db->insert_batch('itpc_exporter', $exporter);
  if(!$result)
     $this->session->set_flashdata('error', 'Gagal menyimpan data');
  return $result;
  }

  public function get($limit,$start,$title,$id){
      require_once('Exporter_company.php');
      $this->db->select([
        'b.exporter_id as id',
        'b.exporter_name as title',
        'b.exporter_slug as slug',
        'b.exporter_logo as logo',
        'b.exporter_phone as phone',
        'b.exporter_office_phone as office_phone',
        'b.exporter_fax as fax',
        'b.exporter_email as email',
        'a.subcategory_id as subcategory',
        'c.subcategory_title as subcategory_title',
      ]);
      if(isset($title)) {
        $this->db->like('b.exporter_name',$title);
      }
      $this->db->where('a.status', 1);
      $this->db->where('a.delete_date', null);
      $this->db->where('a.subcategory_id', $id);
      $this->db->join('itpc_exporter b','a.exporter_id = b.exporter_id');
      $this->db->join('itpc_subcategory c','a.subcategory_id = c.subcategory_id');
      $this->db->limit($limit, $start);
      $this->db->order_by('b.exporter_name','ASC');
      $query = $this->db->get('itpc_exporter_category a');

      if($query->num_rows() > 0){
        $exporter_list = [];
        array_map(function($item) use(&$exporter_list){
          $exporter_list[] = (new Exporter_company($item))->to_array();
        }, $query->result_array());
        $query->free_result();
        $this->db->reset_query();



        return [
          'data' => $exporter_list
        ];
      }else{
        return false;
      }




  }

    /*public function get($limit,$start,$title,$id){
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
    }*/


    public function get_detail($id,$icon_group) {
        require_once('Exporter_company_detail.php');
        require_once('Exporter_company_product.php');
        require_once('Exporter_icon.php');

        $this->db->select([
    			'a.exporter_id as id',
    			'a.exporter_name as title',
          'a.exporter_slug as slug',
          'a.exporter_logo as logo',
          'a.exporter_address as address',
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
