<?php
class about_title_data{

	public $trans_key;
	public $title_english;
	public $title_bahasa;
	public $title_spanyol;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			if(array_key_exists($key, $arr))
				$this->$key = $arr[$key];
		}
	}

	public function to_array() { return (array) $this; }
}
