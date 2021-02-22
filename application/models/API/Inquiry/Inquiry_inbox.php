<?php
class Inquiry_inbox {
	public $inbox_id;
	public $inquiry_id;
	public $exporter_id;
	public $status;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			if(array_key_exists($key, $arr))
				$this->$key = $arr[$key];
		}
	}

	public function to_array() { return (array) $this; }
}
