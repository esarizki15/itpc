<?php
class Useful_link {
	public $id;
	public $title;
	public $logo;
	public $link;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'logo':
					if(array_key_exists('logo', $arr) AND $arr['logo'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'useful_link/'.$arr['logo'];
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
