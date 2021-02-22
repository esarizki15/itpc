<?php
class Inquiry_list_inbox {
	public $inbox_id;
	public $inquiry_id;
	public $inbox_content;
	public $inbox_read;
	public $post_date;
	public $status;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {

				case 'inbox_read':
					if(array_key_exists($key, $arr)) {
							if($arr[$key] == 1){
								$inbox_read = true;
							}else{
								$inbox_read = false;
							}
							$this->$key = $inbox_read;
					}
					break;
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
