<?php
class indonesia_product_data {

	public $id;
	public $title;
	public $thumbnail;
	public $file;
	public $post_date;
	public $status;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'thumbnail':
					if(array_key_exists('thumbnail', $arr) AND $arr['thumbnail'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'indonesia_product/'.$arr['thumbnail'];
					}
					break;
					case 'file':
						if(array_key_exists('file', $arr) AND $arr['file'] !== NULL) {
							$CI =& get_instance();
							$this->$key = $CI->config->item('website_assets').'indonesia_product/'.$arr['file'];
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
