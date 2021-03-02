<?php
class Importer_detail{
	public $importer_id;
	public $importer_name;
	public $importer_detail;
	public $importer_address;
	public $importer_city;
	public $importer_provience;
	public $importer_postal;
	public $country_name;
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
	public $created_by;
	public function __construct($arr){
		foreach(get_object_vars($this) as $key => $val) {
			switch($key) {
					case 'post_date':
						if(array_key_exists($key, $arr)) {
							date_default_timezone_set('Asia/Jakarta');
							$date = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('d F Y');
							//$this->$key = date($arr[$key],strtotime('-1 hour'));
							$this->$key = $date;

						}
						break;

						case 'update_date':
							if(array_key_exists($key, $arr)) {
								date_default_timezone_set('Asia/Jakarta');
								if($arr[$key] != null){
									$date = (new DateTime())->createFromFormat('Y-m-d H:i:s', $arr[$key])->format('d F Y');
									//$this->$key = date($arr[$key],strtotime('-1 hour'));
									$this->$key = $date;
								}else{
									$date = "no update yet";
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
