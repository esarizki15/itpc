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

	public function latest_news(){
		$this->load->model('API/News/News_data_query','News_data_query', true);

			$news = $this->News_data_query->get_latest();
 		 	if(!empty($news['data']))
 		 	{
 			 $news['status'] = "success";
 			 $news['message'] = "";
 		 	}else{
 			 $news['status'] = "error";
 			 $news['message'] = "sorry no data available";
 		 	}
		echo json_encode($news); //send data to script
		return json_encode($news);
	}

	public function about(){
		$this->load->model('API/About/About_query','About_query', true);

			$about = $this->About_query->get();
 		 	if(!empty($about['data']))
 		 	{
 			 $about['status'] = "success";
 			 $about['message'] = "";
 		 	}else{
 			 $about['status'] = "error";
 			 $about['message'] = "sorry no data available";
 		 	}
		echo json_encode($about); //send data to script
		return json_encode($about);
	}

	public function news(){
		$this->load->model('API/News/News_data_query','News_data_query', true);

		$this->form_validation->set_rules('page', 'page', 'required|integer');

		if($this->form_validation->run() == TRUE)
	 	{
			$page = $this->input->post('page',true);
			$tag_id = $this->input->post('tag_id');

			if($tag_id == 1){
				 $tag_id = 1;
			}else{
				$tag_id = null;
			}

			$per_page = 10;
			$news = $this->News_data_query->get($per_page,$page,$tag_id);
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
		$this->form_validation->set_rules('news_id', 'news_id', 'required|integer');

		if($this->form_validation->run() == TRUE)
		{
			$news_id = $this->input->post('news_id',true);
			$news_detail = $this->News_data_detail_query->get_detail($news_id);
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

	public function exporter(){
			$this->load->model('API/Exporter/Exporter_category_query','Exporter_category_query', true);
			$this->load->model('API/Exporter/Exporter_subcategory_query','Exporter_subcategory_query', true);
			$this->load->model('API/Exporter/Exporter_company_query','Exporter_company_query', true);

			$page = $this->input->post('page',true);
			$data_type = $this->input->post('data_type');
			$title = $this->input->post('title');
			$id = $this->input->post('id');


			$per_page = 10;
			$status = true;

			$this->form_validation->set_rules('page', 'page', 'required|integer');

			if($this->form_validation->run() == TRUE)
			{

					if(empty($data_type) || $data_type == 'category'){
						$exporter_data = $this->Exporter_category_query->get($per_page,$page,$title);

						if(empty($exporter_data)){
							$exporter_data['status'] = "error";
							$exporter_data['message'] = "sorry no data available";
						}else{
							$exporter_data['status'] = "success";
							$exporter_data['message'] = "";
						}

					}else if($data_type == 'subcategory'){
						//$exporter_data['data'] = "subcategory";

							$exporter_data = $this->Exporter_subcategory_query->get($per_page,$page,$title,$id);

							if(empty($exporter_data)){

								$exporter_data['status'] = "error";
								$exporter_data['message'] = "sorry no data available";

							}else{

								$exporter_data['status'] = "success";
								$exporter_data['message'] = "";
							}

					}else if($data_type == 'exporter'){
						$exporter_data = $this->Exporter_company_query->get($per_page,$page,$title,$id);
						$exporter_data['status'] = "success";
						$exporter_data['message'] = "";
					}
			}

			echo json_encode($exporter_data); //send data to script
			return json_encode($exporter_data);
	}

	public function exporter_detail(){

			$this->load->model('API/Exporter/Exporter_company_query','Exporter_company_query', true);

			$id = $this->input->post('id',true);
			$icon_group = "detail_exporter";
			$this->form_validation->set_rules('id', 'id', 'required|integer');

			if($this->form_validation->run() == TRUE)
			{
					$exporter_detail['data'] = $this->Exporter_company_query->get_detail($id,$icon_group);

					if(empty($exporter_detail['data'])){
						$exporter_detail['status'] = "error";
						$exporter_detail['message'] = "sorry no data available";
					}else{
						$exporter_detail['status'] = "success";
						$exporter_detail['message'] = "";
					}

			}else{
				$exporter_detail['data'] = null;
				$exporter_detail['status'] = "error";
				$exporter_detail['message'] = "sorry, you must enter parameters";
			}

			echo json_encode($exporter_detail); //send data to script
			return json_encode($exporter_detail);


	}


}
