<?php
class Subcategory_list{

	public $id;
	public $category_id;
	public $title;
	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				/*case 'id':
					if(array_key_exists($key, $arr)) {
								$id = intval($arr[$key]);
								$this->$key = $id;
						}
					break;
					case 'category_id':
						if(array_key_exists($key, $arr)) {
									$category_id = intval($arr[$key]);
									$this->$key = $category_id;
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
