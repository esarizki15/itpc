<?php
class list_exporter_key{
	public $id;
	public $name;
	public $logo;
	public $email;
	public $post_date;
	public $status;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
					case 'logo':
						if(array_key_exists('logo', $arr) AND $arr['logo'] !== NULL) {
							$CI =& get_instance();
							$this->$key = $CI->config->item('website_assets').'exporter/'.$arr['logo'];
						}
					break;
					case 'post_date':
						if(array_key_exists($key, $arr)) {
								date_default_timezone_set('Asia/Jakarta');
							$date = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('d F Y');
							$this->$key = $date;
						}
						break;
					case 'status':
							if(array_key_exists($key, $arr)) {
								if($arr[$key] == 1){
									$this->$key = "actived";
								}else{
									$this->$key = "non actived";
								}

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
