<?php
class Exporter_icon{

	public $icon_id;
	public $icon_title;
	public $icon_image;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'icon_image':
					if(array_key_exists('icon_image', $arr) AND $arr['icon_image'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'icon/'.$arr['icon_image'];
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
