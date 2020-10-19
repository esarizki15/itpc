<?php
class Exporter_company_product{

	public $image_id;
	public $image_product;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'image_product':
					if(array_key_exists('image_product', $arr) AND $arr['image_product'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'exporter_product/'.$arr['image_product'];
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
