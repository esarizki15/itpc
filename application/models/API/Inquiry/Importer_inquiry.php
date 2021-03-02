<?php
class Importer_inquiry{
	public $importer_id;
	public $importer_name;
	public $link;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'importer_id':
					if(array_key_exists($key, $arr)) {
								$importer_id = intval($arr[$key]);
								$this->$key = $importer_id;
						}
					break;
					case 'link':
						if(array_key_exists($key, $arr)) {
									$link = base_url()."API/importer_inquiry_detail/".$arr[$key];
									$this->$key = $link;
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
