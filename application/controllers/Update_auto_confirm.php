<?php

class Update_auto_confirm extends CI_Model {

	public function Invoice_update($id_invoice) {
		$now = (new DateTime())->format('Y-m-d H:i:s');
		$data = array(
				'invoice_date_update' => $now,
				'confirm_status' => 1
		);

		$this->db->where('invoice_id',$id_invoice);
		$result = $this->db->update('zambert_invoice',$data);
		return true;
	}

	public function Invoice_update_manual($invoice_number) {
		$now = (new DateTime())->format('Y-m-d H:i:s');
		$data = array(
				'invoice_date_update' => $now,
				'confirm_status' => 1,
				'status' => 1
		);

		$this->db->where('invoice_number',$invoice_number);
		$result = $this->db->update('zambert_invoice',$data);
		return true;
	}

	public function Invoice_manual_moota($id_invoice) {
		$now = (new DateTime())->format('Y-m-d H:i:s');
		$data = array(
				'invoice_date_update' => $now,
				'confirm_status' => 1,
				'status' => 1
		);

		$this->db->where('invoice_id',$id_invoice);
		$result = $this->db->update('zambert_invoice',$data);
		return true;
	}

		public function is_check($invoice_number){
		$now = (new DateTime())->format('Y-m-d H:i:s');
		$data = array(
				'date_check' => $now,
				'is_check' => 1
		);

		$this->db->where('invoice_number',$invoice_number);
		$this->db->where('is_check',0);
		$this->db->where('confirm_status',0);
		$this->db->where('status',1);
		$result = $this->db->update('zambert_invoice',$data);
		return true;
	}

	public function rotation_check() {
			$this->db->select([
			'invoice_number'
		]);
		$this->db->from('zambert_invoice');
		$this->db->where([
			'confirm_status' => 0,
			'is_check' => 1,
			'delete_date' => null,
			'status' => 1
		]);
		$query = $this->db->get();
		foreach($query->result() as $row){
			return $row->invoice_number;
		}

	}

	public function is_uncheck(){
	$now = (new DateTime())->format('Y-m-d H:i:s');
	$data = array(
			'date_check' => $now,
			'is_check' => 0
	);
	$this->db->where('is_check',1);
	$this->db->where('confirm_status',0);
	$this->db->where('status',1);
	$result = $this->db->update('zambert_invoice',$data);
	return true;
}

	public function Get_user_invoice($invoice_number) {

		$this->db->select([
			'a.user_id',
			'a.fullname',
			'a.email',
			'a.password_text',
			'a.no_phone',
			'a.event_id',
			'b.invoice_id',
			'b.invoice_number'
		]);
		$this->db->where('a.invoice_number', $invoice_number);
		$this->db->where('a.delete_date', null);
		$this->db->order_by('a.user_id','ASC');
		$this->db->join('zambert_invoice b', 'a.invoice_number = b.invoice_number');
		$query = $this->db->get('zambert_user a');
		if($query){
			return $query->result_array();
		}else{
			return false;
		}
	}


	public function send_user_data($user_id,$event_id,$invoice_number){
		require_once('Event_item.php');
		require_once('Invoice_item.php');
		$this->db->select([
			'user_id ',
			'fullname',
			'email',
			'no_phone',
			'gender',
			'birthday',
			'school'
		]);
		$this->db->where('a.user_id', $user_id);
		$this->db->where('a.delete_date', null);
		$user_query = $this->db->get('zambert_user a');
	 	$user_detail = [];
		if($user_query){
				$user_detail = $user_query->result_array();
		}
		$user_query->free_result();
		$this->db->reset_query();

		$this->db->select([
			'a.event_id ',
			'a.event_title',
			'a.event_desc',
			'a.event_slug',
			'a.event_image',
			'a.event_date',
			'a.event_hour',
			'a.event_venue',
			'a.event_link',
			'b.venue_name',
			'c.city_name',
		]);
		$this->db->where('a.event_id', $event_id);
		$this->db->join('zamber_venue b', 'a.event_venue = b.venue_id');
		$this->db->join('zambert_city c', 'a.event_city = c.city_id');
		$event_query = $this->db->get('zambert_event a');
		$event_detail = [];
		array_map(function($item) use(&$event_detail){
			$event_detail[] = (new Event_item($item))->to_array();
		}, $event_query->result_array());
		$event_query->free_result();
		$this->db->reset_query();

		$this->db->select([
			'invoice_id',
			'invoice_number',
			'invoice_total_cost',
			'invoice_total_user',
			'invoice_date_create',
			'invoice_date_expirate',
			'invoice_date_update',
			'confirm_status'
		]);
		$this->db->where('invoice_number', $invoice_number);
		$this->db->where('delete_date', null);
		$invoice_query = $this->db->get('zambert_invoice');
	 	$invoice_detail = [];
		array_map(function($item) use(&$invoice_detail){
			$invoice_detail[] = (new Invoice_item($item))->to_array();
		}, $invoice_query->result_array());
		$invoice_query->free_result();
		$this->db->reset_query();

		return [
			'user_detail' => $user_detail,
			'event_detail' => $event_detail,
			'invoice_detail' => $invoice_detail
		];

	}


}
