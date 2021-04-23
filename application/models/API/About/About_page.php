<?php
class About_page {
	public $about_title;
	public $about_content;
	public $about_header;
	public $function_image;
	public $function_content;
	public $mission_content;
	public $mission_image;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'about_header':
					if(array_key_exists('about_header', $arr) AND $arr['about_header'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'about/'.$arr['about_header'];
					}
					break;
					case 'function_image':
						if(array_key_exists('function_image', $arr) AND $arr['function_image'] !== NULL) {
							$CI =& get_instance();
							$this->$key = $CI->config->item('website_assets').'about/'.$arr['function_image'];
						}
						break;
						case 'mission_image':
							if(array_key_exists('mission_image', $arr) AND $arr['mission_image'] !== NULL) {
								$CI =& get_instance();
								$this->$key = $CI->config->item('website_assets').'about/'.$arr['mission_image'];
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
