<?php
class Exporter_company{

	public $id;
	public $title;
	public $slug;
	public $logo;
	public $phone;
	public $office_phone;
	public $fax;
	public $email;
	public $link;
	public $curr_category = "exporter";
	public $prev_category = "subcategory";


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'logo':
					if(array_key_exists('logo', $arr) AND $arr['logo'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'exporter/'.$arr['logo'];
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
