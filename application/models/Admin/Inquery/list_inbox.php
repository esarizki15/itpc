<?php
class list_inbox {
	public $inbox_id;
	public $inbox_content;
	public $inbox_read;
	public $post_date;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
				case 'post_date':
				if(array_key_exists($key, $arr)){
								date_default_timezone_set('Asia/Jakarta');
							$date = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('"F j, Y');
							$this->$key = $date;
						}
						break;
				case 'inbox_read':
						if(array_key_exists($key, $arr)){

							if($arr[$key] == 1)
							{
									$inbox_read = "Already read";
							}else{
									$inbox_read = "Unread";
							}
							$this->$key = $inbox_read;
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
