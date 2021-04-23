<?php
class Contact_page {
	public $contact_map;
	public $contact_header;
	public $contact_location;
	public $contact_phone;
	public $contact_fax;
	public $contact_email;
	public $contact_website;

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
