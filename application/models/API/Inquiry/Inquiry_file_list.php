<?php
class Inquiry_file_list{

	public $file_id;
	public $file_patch;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key){
				case 'file_id':
					if(array_key_exists($key, $arr)) {
								$id = intval($arr[$key]);
								$this->$key = $id;
						}
					break;
				case 'file_patch':
					if(array_key_exists('file_patch', $arr) AND $arr['file_patch'] !== NULL){
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'inquiry/'.$arr['file_patch'];
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
