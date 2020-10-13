<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
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

	public function index()
	{
		//$this->load->view('welcome_message');
	}

	public function news($tag_slug = null){



		$this->load->model('API/News/News_data_query','News_data_query', true);

		$this->form_validation->set_rules('page', 'page', 'required|integer');

		if($this->form_validation->run() == TRUE)
	 	{
			$page = $this->input->post('page',true);
			$per_page = 10;
			$news = $this->News_data_query->get($per_page,$page,$tag_slug);
 		 	if(!empty($news['data']))
 		 	{
 			 $news['status'] = "success";
 			 $news['message'] = "";
 		 	}else{
 			 $news['status'] = "error";
 			 $news['message'] = "sorry no data available";
 		 	}

		}else{
			$news['data'] = null;
			$news['status'] = "error";
			$news['message'] = "sorry, you must enter parameters";
		}

		echo json_encode($news); //send data to script
		return json_encode($news);




	}

	public function detail_news(){
		$this->load->model('API/News/News_data_detail_query','News_data_detail_query', true);

		//$this->form_validation->set_rules('news_slug', 'news_slug', 'trim|required');
		$this->form_validation->set_rules('news_slug', 'news_slug', 'required');

		if($this->form_validation->run() == TRUE)
		{
			$news_slug = $this->input->post('news_slug',true);
			$news_detail = $this->News_data_detail_query->get_detail($news_slug);
			if(!empty($news_detail))
			{
				$news_detail['status'] = "success";
				$news_detail['message'] = "";
			}else{
				$news_detail['status'] = "error";
				$news_detail['message'] = "sorry no data available";
			}

		}else{
			$news_detail['data'] = null;
			$news_detail['status'] = "error";
			$news_detail['message'] = "sorry, you must enter parameters";
		}
		 echo json_encode($news_detail); //send data to script
		 return json_encode($news_detail);
	}


}
