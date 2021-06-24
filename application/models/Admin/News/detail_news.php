<?php
class detail_news {
	public $news_id;
	public $tag_id;
	public $tag_title;
	public $news_thumbnail_type;
	public $news_thumbnail;
	public $news_header;
	public $trans_key;
	public $post_date;
	public $status;
	public $title_english;
	public $title_bahasa;
	public $title_spanyol;
	public $content_english;
	public $content_bahasa;
	public $content_spanyol;


	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'news_thumbnail':
				if(array_key_exists('news_thumbnail', $arr) AND $arr['news_thumbnail'] !== NULL){
							$CI =& get_instance();
							$this->$key = $CI->config->item('website_assets')."news/".$arr['news_thumbnail'];
					}
					break;
					case 'news_header':
					if(array_key_exists('news_header', $arr) AND $arr['news_header'] !== NULL){
								$CI =& get_instance();
								$this->$key = $CI->config->item('website_assets')."news/".$arr['news_header'];
						}
						break;
				case 'post_date':
				if(array_key_exists($key, $arr)){
							date_default_timezone_set('Asia/Jakarta');
							$date = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('m/d/Y');
							$this->$key = $date;
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
