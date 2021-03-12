<?php
class list_news {
	public $news_id;
	public $news_title;
	public $post_date;
	public $post_by;
	public $status;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'post_date':
				if(array_key_exists($key, $arr)){
								date_default_timezone_set('Asia/Jakarta');
							$date = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('m/d/Y');
							$this->$key = $date;
						}
						break;
				case 'status':
						if(array_key_exists($key, $arr)){

							if($arr[$key] == 1)
							{
									$status = "active";
							}else{
									$status = "non active";
							}
							$this->$key = $status;
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
