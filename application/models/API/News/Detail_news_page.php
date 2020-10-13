<?php
class Detail_news_page {
	public $news_id;
	public $news_title;
	public $news_slug;
	public $news_thumbnail;
	public $news_header;
	public $tag_id;
	public $news_content;
	public $post_date;
	public $tag_slug;
	public $tag_title;
	public $admin_name;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'news_thumbnail':
					if(array_key_exists('news_thumbnail', $arr) AND $arr['news_thumbnail'] !== NULL) {
						$CI =& get_instance();
						$this->$key = $CI->config->item('website_assets').$arr['news_thumbnail'];
					}
					break;
					case 'news_header':
						if(array_key_exists('news_header', $arr) AND $arr['news_header'] !== NULL) {
							$CI =& get_instance();
							$this->$key = $CI->config->item('website_assets').$arr['news_header'];
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
