<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

function pr($var){

    echo '<pre>';
    print_r($var);
    echo '<pre>';

}

function clean($string) {
    $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.
    return preg_replace('/\D/', '', $string); // Removes special chars.
 }

			
function getLang($parlang){
    $langnya=$parlang;
    $ex=explode('/',$_SERVER['REQUEST_URI']);
    $host=(isset($_SERVER['HTTPS']) ? "https://" : "http://").$_SERVER['HTTP_HOST'];
    $host.= str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
    
    if($ex[2]){
        $langnya=$host.$parlang.'/'.$ex[2]; 
    }
    if($ex[3]){
        $langnya=$host.$parlang.'/'.$ex[2].'/'.$ex[3]; 
    }
    //pr($langnya);exit;
    return $langnya;
}
