<?php
class Inquiry_list {
	public $inquiry_id;
	public $inquiry_title;
	public $progress;
	public $contact_name;
	public $post_date;
	public $category_title;
	public $subcategory_title;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
					case 'post_date':
						if(array_key_exists($key, $arr)) {
							date_default_timezone_set('Asia/Jakarta');
							$date = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('d F Y');
							//$this->$key = date($arr[$key],strtotime('-1 hour'));
							$get_time = time_format($date);
							if($get_time != null){
								$this->$key = $get_time;
							}else{
								$this->$key = $date;
							}
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
