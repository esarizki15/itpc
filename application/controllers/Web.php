<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WEB extends CI_Controller {

    public $user_id;
    public $username;
    public $password;
    public $password_text;
    public $email;

    function __construct(){
           parent::__construct();
           $this->load->helper(array('url','html','form','slug'));
           $this->load->library('cart');
           $this->load->library('pagination');
           $this->load->library('session');
           $this->load->library('upload');
           $this->load->library('form_validation');
           $this->load->helper('validation');
           
           error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    }

    private function render()
    {
        $lang = $this->uri->segment(1);
        pr($lang);exit;
        $this->lang->load('content',$lang=='' ? 'en' : $lang);
        $this->master["language"] = $this->lang->line('language');
        $this->master["main_css"] = $this->load->view('web/main_css.php', [], TRUE);
        $this->master["main_js"] = $this->load->view("web/main_js.php", [], TRUE);
        $this->load->view("web/master", $this->master);
    }
    public function index($lang = '')
	{
     
        $this->master["custume_css"] = NULL;
        $this->master["custume_js"] = NULL;
        $this->master["content"] = $this->load->view("web/home/home.php",[], TRUE);
        $this->render();
			
	}

}
