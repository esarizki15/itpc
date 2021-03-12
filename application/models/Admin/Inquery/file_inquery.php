<?php
class file_inquery {
	public $file_id;
	public $file_patch;
	public $post_date;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'file_patch':
					if(array_key_exists('file_patch', $arr) AND $arr['file_patch'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'inquiry/'.$arr['file_patch'];
					}
					break;
					case 'post_date':
					if(array_key_exists($key, $arr)){
								date_default_timezone_set('Asia/Jakarta');
								$date_publish = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('m/d/Y');
								$this->$key = $date;
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
