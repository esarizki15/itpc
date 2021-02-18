<?php
class Inquiry_query extends CI_Model{

  public function Submit_inquiry($inquiry_data){
  //$result = $this->db->insert('zambert_user',$user);
  $result =	$this->db->insert_batch('itpc_inquiry',$inquiry_data);
  $insert_id = $this->db->insert_id();
  $this->db->trans_start();
  $this->db->trans_complete();
  if(!$result)
     $this->session->set_flashdata('error', 'Gagal menyimpan data');
  return $insert_id;
  }

  public function Submit_notif_inquiry($notif){
  //$result = $this->db->insert('zambert_user',$user);
  $result =	$this->db->insert_batch('itpc_notif_inquiry',$notif);
  if(!$result)
     $this->session->set_flashdata('error', 'Gagal menyimpan data');
  return $result;
  }

  public function list_inquiry($limit,$start,$title,$exporter_id){
      require_once('Inquiry_list.php');
      $this->db->select([
        'a.inquiry_id as inquiry_id',
        'a.inquiry_title as inquiry_title',
        'a.progress as progress',
        'a.contact_name as contact_name',
        'a.post_date as post_date',
        'b.category_title as category_title',
        'b.subcategory_title as subcategory_title'
      ]);
      if(isset($title)) {
        $this->db->like('a.inquiry_title',$title);
      }
      $this->db->where('a.status', 1);
      $this->db->where('a.delete_date', null);
      $this->db->where('a.exporter_id', $exporter_id);
      $this->db->join('itpc_category b','a.subcategory_id = b.subcategory_id');
      $this->db->join('itpc_subcategory c','a.subcategory_id = c.subcategory_id');
      $this->db->limit($limit, $start);
      $this->db->order_by('a.post_date','ASC');
      $query = $this->db->get('itpc_inquiry a');

      if($query->num_rows() > 0){
        $inquiry_list = [];
        array_map(function($item) use(&$inquiry_list){
          $inquiry_list[] = (new Inquiry_list($item))->to_array();
        }, $query->result_array());
        $query->free_result();
        $this->db->reset_query();
        return [
          'data' => $inquiry_list
        ];
      }else{
        return false;
      }
  }

}
