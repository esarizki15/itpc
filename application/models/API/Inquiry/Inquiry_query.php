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

  public function Submit_log_inquiry($log){
  //$result = $this->db->insert('zambert_user',$user);
  $result =	$this->db->insert_batch('itpc_log_inquiry',$log);
  if(!$result)
     $this->session->set_flashdata('error', 'Gagal menyimpan data');
  return $result;
  }

  public function get_list_inquiry($limit,$start,$exporter_id){
      require_once('Inquiry_list.php');
      $this->db->select([
        'a.inquiry_id as inquiry_id',
        'a.inquiry_title as inquiry_title',
        'a.progress as progress',
        'a.contact_name as contact_name',
        'a.post_date as post_date',
        'a.status as status',
        'b.category_title as category_title',
        'c.subcategory_title as subcategory_title'
      ]);
      $this->db->where('a.status !=', 2);
      $this->db->where('a.delete_date', null);
      $this->db->where('a.exporter_id', $exporter_id);
      $this->db->join('itpc_category b','a.category_id = b.category_id');
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

  public function get_detail_inquiry($inquiry_id){
      require_once('Inquiry_detail.php');
      require_once('Inquiry_inbox.php');
      $this->db->select([
        'a.inquiry_id as inquiry_id',
        'a.inquiry_title as inquiry_title',
        'a.exporter_name as exporter_name',
        'a.exporter_address as exporter_address',
        'a.progress as progress',
        'b.category_title as category_title',
        'c.subcategory_title as subcategory_title',
        'a.product_detail as product_detail',
        'a.product_capacity as product_capacity',
        'a.have_export as have_export',
        'a.contact_name as contact_name',
        'a.contact_email as contact_email',
        'a.contact_phone as contact_phone',
        'a.post_date as post_date',
        'a.update_date as update_date',
        'a.status as status'

      ]);
      $this->db->where('a.inquiry_id', $inquiry_id);
      $this->db->join('itpc_category b','a.category_id = b.category_id');
      $this->db->join('itpc_subcategory c','a.subcategory_id = c.subcategory_id');
      $this->db->order_by('a.post_date','ASC');
      $query = $this->db->get('itpc_inquiry a');

      if($query->num_rows() > 0){
        $detail_inquiry = [];
        array_map(function($item) use(&$detail_inquiry){
          $detail_inquiry[] = (new Inquiry_detail($item))->to_array();
        }, $query->result_array());
        $query->free_result();
        $this->db->reset_query();


        $this->db->select([
          'a.inbox_id as inbox_id',
          'a.inquiry_id as inquiry_id',
          'a.exporter_id as exporter_id',
          'a.status as status'
        ]);
        $this->db->where('a.inquiry_id', $inquiry_id);
        $this->db->where('a.inbox_read', 0);
        $this->db->where('a.delete_date', null);
        $this->db->where('a.status', 1);
        $query = $this->db->get('itpc_inbox a');

        $itpc_inbox = [];
        array_map(function($item) use(&$itpc_inbox){
          $itpc_inbox[] = (new Inquiry_inbox($item))->to_array();
        },$query->result_array());



        return[
          'detail' => $detail_inquiry,
          'inbox' => $itpc_inbox
        ];
      }else{
        return false;
      }
  }


  public function get_inbox_inquiry($limit,$start,$inquiry_id){
      require_once('Inquiry_list_inbox.php');
      $this->db->select([
        'a.inbox_id as inbox_id',
        'a.inquiry_id as inquiry_id',
        'a.inbox_content as inbox_content',
        'a.inbox_read as inbox_read',
        'a.post_date as post_date',
        'a.status as status'

      ]);
      $this->db->where('a.inquiry_id', $inquiry_id);
      $this->db->where('a.status', 1);
      $this->db->order_by('a.post_date','DESC');
      $this->db->limit($limit, $start);
      $query = $this->db->get('itpc_inbox a');

      if($query->num_rows() > 0){
        $itpc_inbox = [];
        array_map(function($item) use(&$itpc_inbox){
          $itpc_inbox[] = (new Inquiry_list_inbox($item))->to_array();
        },$query->result_array());
        return[
          'inbox' => $itpc_inbox,
        ];
      }else{
        return false;
      }
  }

  public function update_inbox_inquiry($update) {
    $this->db->where('inbox_id',$update['inbox_id']);
    $result = $this->db->update('itpc_inbox', $update);
    return true;
  }

  public function update_inbox_inquiry_all($update) {
    $this->db->where('inquiry_id',$update['inquiry_id']);
    $result = $this->db->update('itpc_inbox', $update);
    return true;
  }

  public function submit_inquiry_file($inquiryfile){
  //$result = $this->db->insert('zambert_user',$user);
  $result =	$this->db->insert_batch('itpc_files_inquiry',$inquiryfile);
  if(!$result)
     $this->session->set_flashdata('error', 'Gagal menyimpan data');
  return $result;
  }

  public function list_file_inquiry($inquiry_id){
      require_once('Inquiry_file_list.php');
      $this->db->select([
        'a.file_id as file_id',
        'a.file_patch as file_patch'
      ]);
      $this->db->where('a.inquiry_id', $inquiry_id);
      $this->db->where('a.delete_date', null);
      $this->db->where('a.status', 1);
      $this->db->where('a.file_device =','ios');
      $this->db->order_by('a.post_date','DESC');
      $query = $this->db->get('itpc_files_inquiry a');

      if($query->num_rows() > 0){
        $file_list = [];
        array_map(function($item) use(&$file_list){
          $file_list[] = (new Inquiry_file_list($item))->to_array();
        },$query->result_array());
        return $file_list;
      }else{
        return false;
      }
  }

  public function file_user_id($file_id){
    $this->db->select([
      'b.exporter_id as exporter_id'
    ]);
    $this->db->where('a.file_id',$file_id);
    $this->db->join('itpc_inquiry b','a.inquiry_id = b.inquiry_id');
    $query = $this->db->get('itpc_files_inquiry a');
    if($query){
      foreach($query->result() as $row){
       return $row->exporter_id;
      }
    }else{
      return false;
    }
  }

  public function inquiry_file_delete($update) {

    $this->db->where('file_id',$update['file_id']);
		$result = $this->db->update('itpc_files_inquiry', $update);
		return true;
	}

}
