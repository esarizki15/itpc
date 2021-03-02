<?php
function check_status_data_type($val) {
	return (is_string($val) and in_array($val,["1","0","true","false"]))
		or is_bool($val)
		or (is_int($val) and in_array($val, [1,0]));
}

function nullable($val) {
	return isset($val) || !isset($val) || empty($val) || !empty($val);
}

function valid_comma_separated_emails(&$val) {
	$emails = explode(',',$val);
	foreach($emails as &$email) {
		$email = trim($email);
		if(!filter_var($email, FILTER_VALIDATE_EMAIL))
			return false;
	}
	$val = implode(',',$emails);
	return true;
}

