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
           $this->load->model('Web/Home/Home_data_query','Home_data_query', true);
           error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));
    }

    private function render()
    {
        $lang = $this->uri->segment(1);
        $this->lang->load('content',$lang=='' ? 'en' : $lang);
        $this->master["language"] = $this->lang->line('language');
        $this->master["lang"] = $lang;
        $this->master["main_css"] = $this->load->view('web/main_css.php', [], TRUE);
        $this->master["main_js"] = $this->load->view("web/main_js.php", [], TRUE);
        $this->master["header"] = $this->load->view("web/header.php",$this->master, TRUE);
        $this->load->view("web/master", $this->master);
    }
    public function index($lang = '')
	{
        $data = $this->Home_data_query->get_news();
        $this->master["content"] = $this->load->view("web/home/home.php",$data, TRUE);
        $this->render();
	}
      public function news($lang = '')
      {
            $News = $this->Home_data_query->get_news();
            $this->master["content"] = $this->load->view("web/news/news.php",[], TRUE);
            $this->render();
      }

  public function news_detail($slug)
  {         
        $NewsDetail = $this->Home_data_query->get_news_detail($slug);
        //pr($NewsDetail );exit;
        $this->master["content"] = $this->load->view("web/news/news_detail.php", $NewsDetail , TRUE);
        $this->render();
  }
  public function welcome_login($lang = '')
  {
        $News = $this->Home_data_query->get_news();
       // pr($News);exit;
        $this->master["content"] = $this->load->view("web/login/welcome_login.php",[], TRUE);
        $this->render();
  }
  public function login($lang = '')
  {
        $News = $this->Home_data_query->get_news();
       // pr($News);exit;
        $this->master["content"] = $this->load->view("web/login/login.php",[], TRUE);
        $this->render();
  }
  public function register($lang = '')
  {
        $News = $this->Home_data_query->get_news();
       // pr($News);exit;
        $this->master["content"] = $this->load->view("web/login/register.php",[], TRUE);
        $this->render();
  }
    public function exporter()
	{
        //pr('masuk');exit;
        $this->master["custume_css"] = NULL;
        $this->master["custume_js"] = NULL;
        $this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);
        $this->master["content"] = $this->load->view("web/home/home.php",[], TRUE);
        $this->render();
	}

  public function exporter_account($lang = '')
  {
        $News = $this->Home_data_query->get_news();
       // pr($News);exit;
        $this->master["content"] = $this->load->view("web/dashboard/exporter_account.php",[], TRUE);
        $this->render();
  }



}
