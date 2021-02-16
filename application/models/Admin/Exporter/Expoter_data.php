<?php
class Expoter_data {
	public $exporter_id;
	public $exporter_name;
	public $exporter_logo;
	public $exporter_address;
	public $exporter_phone;
	public $exporter_office_phone;
	public $exporter_fax;
	public $exporter_email;
	public $exporter_link;
	public $exporter_home;
	public $status;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'exporter_logo':
					if(array_key_exists('exporter_logo', $arr) AND $arr['exporter_logo'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'exporter/'.$arr['exporter_logo'];
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
