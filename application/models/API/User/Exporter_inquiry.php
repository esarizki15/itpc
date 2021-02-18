<?php
class Exporter_inquiry{
	public $exporter_id;
	public $exporter_name;
	public $exporter_address;
	public $username;
	public $exporter_phone;
	public $email;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			if(array_key_exists($key, $arr))
				$this->$key = $arr[$key];
		}
	}

	public function to_array() { return (array) $this; }
}
