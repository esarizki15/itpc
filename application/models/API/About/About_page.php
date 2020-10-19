<?php
class About_page {
	public $about_content;
	public $about_header;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'about_header':
					if(array_key_exists('about_header', $arr) AND $arr['about_header'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'about/'.$arr['about_header'];
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
