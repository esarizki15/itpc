<?php
class News_website_search {
	public $news_id;
	public $news_slug;
	public $news_thumbnail;
	public $news_title;
	public $post_date;
 	public $tag_title;
	public $tag_id;
 	public $tag_slug;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'news_thumbnail':
					if(array_key_exists('news_thumbnail', $arr) AND $arr['news_thumbnail'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').'news/'.$arr['news_thumbnail'];
					}
					break;
					case 'post_date':
						if(array_key_exists($key, $arr)) {
								date_default_timezone_set('Asia/Jakarta');
							$date = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('d F Y');
							//$this->$key = date($arr[$key],strtotime('-1 hour'));
							$get_time = time_format($date);
							if($get_time != null){
								$this->$key = $get_time;
							}else{
								$this->$key = $date;
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
