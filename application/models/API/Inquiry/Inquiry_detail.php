<?php
class Inquiry_detail {
	public $inquiry_id;
	public $inquiry_title;
	public $exporter_name;
	public $progress;
	public $category_title;
	public $subcategory_title;
	public $product_detail;
	public $product_capacity;
	public $have_export;
	public $contact_name;
	public $contact_email;
	public $contact_phone;
	public $post_date;
	public $update_date;
	public $status;
	public function __construct($arr){
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
					case 'post_date':
						if(array_key_exists($key, $arr)) {
							date_default_timezone_set('Asia/Jakarta');
							$date = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('d F Y');
							//$this->$key = date($arr[$key],strtotime('-1 hour'));
							$this->$key = $date;

						}
						break;

						case 'update_date':
							if(array_key_exists($key, $arr)) {
								date_default_timezone_set('Asia/Jakarta');
								if($arr[$key] != null){
									$date = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('d F Y');
									//$this->$key = date($arr[$key],strtotime('-1 hour'));
									$this->$key = $date;
								}else{
									$date = "no update yet";
									$this->$key = $date;
								}
							}
							break;
						case 'status':
							if(array_key_exists($key, $arr)) {
								if($arr[$key] == 1){
									$status = "Actived";
								}else if($arr[$key] == 3){
									$status = "Closed";
								}

								$this->$key = $status ;
							}
							break;
				default:
					if(array_key_exists($key, $arr))
						$this->$key = $arr[$key];
					break;
			}
		}
	}

	public function to_array() { return (array) $this; }
}
