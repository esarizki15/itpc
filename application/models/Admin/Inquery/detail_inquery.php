<?php
class detail_inquery {
	public $inquiry_id;
	public $exporter_id;
	public $inquiry_title;
	public $exporter_name;
	public $exporter_address;
	public $progress;
	public $product_detail;
	public $product_capacity;
	public $have_export;
	public $contact_name;
	public $contact_email;
	public $contact_phone;
	public $post_date;
	public $update_date;
	public $category_title;
	public $subcategory_title;
	public $approved;
	public $status;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'progress':
						if(array_key_exists($key, $arr)){
							$this->$key = $arr[$key]." %";
						}
				break;
				case 'have_export':
						if(array_key_exists($key, $arr)){

							if($arr[$key] == 1)
							{
									$have_export = "Yes";
							}else{
									$have_export = "No";
							}
							$this->$key = $have_export;
						}
				break;
				case 'post_date':
				if(array_key_exists($key, $arr)){
							date_default_timezone_set('Asia/Jakarta');
							$date_publish = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('m/d/Y');
							$this->$key = $date_publish;
						}
				break;

				case 'update_date':
				if(array_key_exists($key, $arr) AND $arr['update_date'] !== NULL ){
							date_default_timezone_set('Asia/Jakarta');
							$date_publish = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('m/d/Y');
							$this->$key = $date_publish;
						}else{
							$this->$key = "data not available";
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
