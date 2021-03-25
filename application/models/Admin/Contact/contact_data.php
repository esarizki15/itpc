<?php
class contact_data {

	public $content_english;
	public $content_bahasa;
	public $content_spanyol;
	public $contact_header;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'contact_header':
					if(array_key_exists('contact_header', $arr) AND $arr['contact_header'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'contact/'.$arr['contact_header'];
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
