<?php
class about_content_data{
	public $trans_id;
	public $content_english;
	public $content_bahasa;
	public $content_spanyol;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			if(array_key_exists($key, $arr))
				$this->$key = $arr[$key];
		}
	}

	public function to_array() { return (array) $this; }
}
