<?php
class Slider_list_data{

	public $slider_id;
	public $title_bahasa;
	public $file_patch;
	public $link;
	public $post_date;
	public $status;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'file_patch':
					if(array_key_exists('file_patch', $arr) AND $arr['file_patch'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'slider/'.$arr['file_patch'];
					}
					break;
						case 'post_date':
							if(array_key_exists($key, $arr)) {
									date_default_timezone_set('Asia/Jakarta');
								$date = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('d F Y');
								$this->$key = $date;
							}
							break;
							case 'link':
									if(array_key_exists($key, $arr)) {
										if($arr[$key] == NULL){
											$this->$key = false;
										}else{
											$this->$key = $arr[$key];
										}

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
