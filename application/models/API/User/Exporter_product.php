<?php
class Exporter_product{

	public $id;
	public $image;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'image':
					if(array_key_exists('image', $arr) AND $arr['image'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'exporter_product/'.$arr['image'];
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
