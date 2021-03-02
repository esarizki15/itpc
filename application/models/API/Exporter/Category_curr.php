<?php
class Category_curr{

	public $ex_cat_id;
	public $title;
	public $sub_title;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				/*case 'ex_cat_id':
					if(array_key_exists($key, $arr)) {
								$id = intval($arr[$key]);
								$this->$key = $id;
						}
					break;*/
				default:
					if(array_key_exists($key, $arr))
						$this->$key = $arr[$key];
					break;
			}
		}
	}

	public function to_array() { return (array) $this; }
}
