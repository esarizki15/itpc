<?php
class News_latest {
	public $id;
	public $title;
	public $slug;
	public $order;
	public $thumbnail;
	public $date;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'thumbnail':
					if(array_key_exists('thumbnail', $arr) AND $arr['thumbnail'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'news/'.$arr['thumbnail'];
					}
					break;
					case 'date':
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
