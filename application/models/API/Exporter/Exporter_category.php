<?php
class Exporter_category {
	public $id;
	public $title;
	public $slug;
	public $sum;
	public $category;
	//public $category_title;
	public $curr_category = "category";


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			if(array_key_exists($key, $arr))
				$this->$key = $arr[$key];
		}
	}

	public function to_array() { return (array) $this; }
}
