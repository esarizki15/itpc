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
			switch($key) {
				case 'exporter_id':
					if(array_key_exists($key, $arr)) {
								$id = intval($arr[$key]);
								$this->$key = $id;
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
