<?php
class Detail_importer_key{
	public $importer_id;
	public $importer_name;
	public $importer_detail;
	public $importer_address;
	public $importer_city;
	public $importer_provience;
	public $id;
	public $name;
	public $importer_postal;
	public $contact_name;
	public $contact_office_phone;
	public $contact_phone;
	public $contact_fax;
	public $contact_email;
	public $contact_website;
	public $social_twitter;
	public $social_facebook;
	public $social_google;
	public $post_date;
	public $update_date;
	public $status;

	public function __construct($arr) {
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {

					case 'post_date':
						if(array_key_exists($key, $arr)) {
								date_default_timezone_set('Asia/Jakarta');
							$date = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('d F Y');
							$this->$key = $date;
						}
						break;
						case 'update_date':
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
