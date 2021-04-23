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

	private function render()
 {
	 $this->master["main_css"] = $this->load->view('mobile/main_css.php', [], TRUE);
	 $this->load->view("mobile/master", $this->master);
 }

	public function home()
	{
			$this->load->model('API/Home/Home_data_query','Home_data_query', true);

			$data['data'] = $this->Home_data_query->get_latest();
			if(!empty($data['data']))
			{
			 $data['status'] = true;
			 $data['message'] = "";
			}else{
			 $data['status'] = false;
			 $data['message'] = "sorry no data available";
			}

			echo json_encode($data); //send data to script
			return json_encode($data);

	}

	public function latest_news(){
		$this->load->model('API/News/News_data_query','News_data_query', true);

			$news = $this->News_data_query->get_latest();
 		 	if(!empty($news['data']))
 		 	{
 			 $news['status'] = true;
 			 $news['message'] = "";
 		 	}else{
 			 $news['status'] = false;
 			 $news['message'] = "sorry no data available";
 		 	}
		echo json_encode($news); //send data to script
		return json_encode($news);
	}

	/*public function about(){
		$this->load->model('API/About/About_query','About_query', true);

			$about = $this->About_query->get();
 		 	if(!empty($about['data']))
 		 	{
 			 $about['status'] = true;
 			 $about['message'] = "";
 		 	}else{
 			 $about['status'] = false;
 			 $about['message'] = "sorry no data available";
 		 	}
		echo json_encode($about); //send data to script
		return json_encode($about);
	}*/

	public function about(){
		$this->load->model('API/About/About_query','About_query', true);
		$this->data["data"] = $this->About_query->get();


		if($this->data["data"]){
			$this->master["content"] = $this->load->view("mobile/About.php",$this->data, TRUE);
			$this->render();
		}else{
			echo "sorry page data is not available";
		}
	}

	public function contact(){
		$this->load->model('API/Contact/Contact_query','Contact_query', true);
		$this->data["data"] = $this->Contact_query->get();
		if($this->data["data"]){
			$this->master["content"] = $this->load->view("mobile/Contact.php",$this->data, TRUE);
			$this->render();
		}else{
			echo "sorry page data is not available";
		}
	}


	public function news(){
		$this->load->model('API/News/News_data_query','News_data_query', true);

		$this->form_validation->set_rules('page', 'page', 'required|integer');

		if($this->form_validation->run() == TRUE)
	 	{
			$page = $this->input->post('page',true);
			$tag_id = $this->input->post('tag_id');



			if($page == 0){
				$page = 0;
			}else{
				$page = $page * 10;
			}

			$per_page = 10;
			$news = $this->News_data_query->get($per_page,$page,$tag_id);
 		 	if(!empty($news['data']))
 		 	{
 			 $news['status'] = true;
 			 $news['message'] = "";
 		 	}else{
 			 $news['status'] = false;
 			 $news['message'] = "sorry no data available";
 		 	}

		}else{
			$news['data'] = null;
			$news['status'] = false;
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
				$news_detail['status'] = true;
				$news_detail['message'] = "";
			}else{
				$news_detail['status'] = false;
				$news_detail['message'] = "sorry no data available";
			}

		}else{
			$news_detail['data'] = null;
			$news_detail['status'] = false;
			$news_detail['message'] = "sorry, you must enter parameters";
		}
		 echo json_encode($news_detail); //send data to script
		 return json_encode($news_detail);
	}

	public function exporter(){
			$this->load->model('API/Exporter/Exporter_category_query','Exporter_category_query', true);
			$this->load->model('API/Exporter/Exporter_subcategory_query','Exporter_subcategory_query', true);
			$this->load->model('API/Exporter/Exporter_company_query','Exporter_company_query', true);
			$this->form_validation->set_rules('page', 'page', 'required');

			if($this->form_validation->run() == TRUE)
			{

				$page = $this->input->post('page',true);
				$data_type = $this->input->post('data_type');
				$title = $this->input->post('title');
				$id = $this->input->post('id');

				if($page == 0){
					$page = 0;
				}else{
					$page = $page * 10;
				}
				$per_page = 10;
				$status = true;

					if(empty($data_type) || $data_type == 'category'){
						$exporter_data = $this->Exporter_category_query->get($per_page,$page,$title);
						if($exporter_data == false){
							$exporter_data['status'] = false;
							$exporter_data['message'] = "sorry no data available";
						}else{
							$exporter_data['status'] = true;
							$exporter_data['message'] = "";
						}

					}else if($data_type == 'subcategory'){
						//$exporter_data['data'] = "subcategory";

							$exporter_data = $this->Exporter_subcategory_query->get($per_page,$page,$title,$id);

							if($exporter_data == false){
								$exporter_data['status'] = false;
								$exporter_data['message'] = "sorry no data available";

							}else{

								$exporter_data['status'] = true;
								$exporter_data['message'] = "";
							}

					}else if($data_type == 'exporter'){
						 $exporter_data = $this->Exporter_company_query->get($per_page,$page,$title,$id);
							if($exporter_data  == false){
								$exporter_data['status'] = false;
								$exporter_data['message'] = "sorry no data available";
							}else{
								$exporter_data['status'] = true;
								$exporter_data['message'] = "";
							}
					}
			}else{
				$exporter_data['data'] = 	"";
				$exporter_data['status'] = false;
				$exporter_data['message'] = "sorry, you must enter parameters";
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
						$exporter_detail['status'] = false;
						$exporter_detail['message'] = "sorry no data available";
					}else{
						$exporter_detail['status'] = true;
						$exporter_detail['message'] = "";
					}

			}else{
				$exporter_detail['data'] = null;
				$exporter_detail['status'] = false;
				$exporter_detail['message'] = "sorry, you must enter parameters";
			}

			echo json_encode($exporter_detail); //send data to script
			return json_encode($exporter_detail);
	}


	public function login()
	{
			$this->load->model('API/User/User_query','User_query', true);

			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
			$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');

			if($this->form_validation->run() == TRUE)
			{
					$email = $this->input->post('email');
					$password = $this->input->post('password');

					$get_hash = $this->User_query->cek_email($email);

					if($get_hash){

							if(password_verify($password, $get_hash)){
									$login_user = $this->User_query->login($email,$get_hash);
									 $cek_active = $login_user['user_data'][0]['status'];
									 $user_id = $login_user['user_data'][0]['user_id'];

									$cek_auth = $this->User_query->cek_auth($user_id);
									if($cek_auth){

										$post_date = date("Y-m-d H:i:s");
										$code = $this->hash_password($post_date);
										$auth = [
													"auth_code" => $code,
													//"auth_code" => $this->hash_password($password),
													"user_id" => $user_id,
													"post_date" => $post_date
										];
										$update_auth_code = $this->User_query->update_auth($auth);
										$auth_code = $this->User_query->get_auth($user_id);
									}else{
										$post_date = date("Y-m-d H:i:s");
										$auth_code = $this->hash_password($post_date);
										$auth[] = [
													"auth_id " => null,
													"auth_code" => $auth_code,
													//"auth_code" => $this->hash_password($password),
													"user_id" => $user_id,
													"post_date" => $post_date,
										];
										$create_auth_code = $this->User_query->create_auth($auth);
										if($create_auth_code){
											$auth_code = $this->User_query->get_auth($user_id);
										}
									}

									if($login_user && $cek_active == 1){
										 $login_user['category_data'][0]['category'];
										 $login_user['category_data'][0]['subcategory'];
										if($login_user['category_data'][0]['category'] == NULL || $login_user['category_data'][0]['subcategory'] == NULL)
										{
											$inquery_menu = false;
										}else{
											$inquery_menu = true;
										}


										$login['data'] = [
											//"user_id" => intval($login_user['user_data'][0]['user_id']),
											"user_id" => $login_user['user_data'][0]['user_id'],
											/*"username" => $login_user['user_data'][0]['username'],
											"email" => $login_user['user_data'][0]['email'],
											"status" => $login_user['user_data'][0]['status'],
											"inquery_menu" => $inquery_menu,*/
											"auth_code" => $auth_code
										];

										$login['status'] = true;
										if($inquery_menu){
												$login['message'] = "Welcome back";
										}else{
												$login['message'] = "Please complete the company data and product category";
										}

									}else if($login_user && $cek_active == 2){
										$login['data'] = null;
										$login['status'] = false;
										$login['message'] = "Please activate your account first";
									}else{
										$login['data'] = null;
										$login['status'] = false;
										$login['message'] = "failed to register user data, please contact the admin";
									}

							}else{
								$login['data'] = null;
								$login['status'] = false;
								$login['message'] = "Passwords do not match";

							}

					}else{
						$login['data'] = null;
						$login['status'] = false;
						$login['message'] = "Email is not registered";
					}

			}else{
				$login['data'] = null;
				$login['status'] = false;
				$login['message'] = validation_errors();
			}

			echo json_encode($login); //send data to script
			return json_encode($login);
	}

	public function account_status(){
		$this->load->model('API/User/User_query','User_query', true);

		$this->form_validation->set_rules('user_id', 'user_id', 'required|integer');
		if($this->form_validation->run() == TRUE)
		{
			$expoter_id = $this->input->post('user_id');
			$account_status = $this->User_query->account_status($expoter_id);


			$account_status['category_data'][0]['category'];
			$account_status['category_data'][0]['subcategory'];

			if($account_status['exporter_data'][0]['name'] == NULL || $account_status['exporter_data'][0]['phone'] == NULL || $account_status['exporter_data'][0]['email'] == NULL){
					 $category_menu = false;
			}else{
					 $category_menu = true;
			}

		 	if($account_status['category_data'][0]['category'] == NULL || $account_status['category_data'][0]['subcategory'] == NULL)
				 {
					 $inquery_menu = false;
				 }else{
					 $inquery_menu = true;
				 }

				 $account = [
 					//"user_id" => intval($account_status['user_data'][0]['user_id']),
					"user_id" => $account_status['user_data'][0]['user_id'],
 					"username" => $account_status['user_data'][0]['username'],
 					"email" => $account_status['user_data'][0]['email'],
 					"status" => $account_status['user_data'][0]['status'],
					"category_menu" => $category_menu,
 					"inquery_menu" => $inquery_menu
 				];
				echo json_encode($account); //send data to script
				return json_encode($account);
		}
	}

	public function register()
	{

		$this->load->model('API/User/User_query','User_query', true);
		$this->load->model('API/Exporter/Exporter_company_query','Exporter_company_query', true);

		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email|is_unique[itpc_user.email]', array('is_unique' => 'This email already exists. Please choose another one.'));
 		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
 		$this->form_validation->set_rules('conf_password', 'confirm password', 'trim|required|min_length[6]|matches[password]' , array('matches' => 'Password does not match.'));

		if($this->form_validation->run() == TRUE)
		{
			$email = $this->input->post('email');
			$explode_email = explode("@", $email);
			$username = $explode_email[0];
  		$password = $this->input->post('password');
			$password_text = $password;
			$post_date = date("Y-m-d H:i:s");
			$post_by = "user";
			$status = 2;

			$user[] = [
						"user_id " => null,
						"username" => $username,
						"password" => $this->hash_password($password),
						"password_text" => $password_text,
						"email" => $email,
						"expoter_id" => null,
						"post_date" => $post_date,
						"post_by" => $post_by,
						"delete_date" => null,
						"delete_by" => null,
						"status" => $status
			];

			$submit_user = $this->User_query->save($user);

			if($submit_user)
			{
				$expoter_id = $this->User_query->get_id_user($email);

				$update_exporter_id = $this->User_query->update_exporter_id($expoter_id);

				$exporter[] = [
					"exporter_id" => $expoter_id,
					"exporter_name" => null,
					"exporter_slug" => null,
					"exporter_logo" => null,
					"exporter_address" => null,
					"exporter_phone" => null,
					"exporter_office_phone" => null,
					"exporter_fax" => null,
					"exporter_email" => $email,
					"exporter_link" => null,
					"post_date" => $post_date,
					"post_by" => $post_by,
					"delete_date" => null,
					"delete_by" => null,
					"status" => $status

				];

				 $regis_exporter = $this->Exporter_company_query->register_exporter($exporter);

				if($regis_exporter){

					$this->load->library('email');
					$actived_link = base_url()."API/Actived_account/".$exporter[0]['exporter_id'];

					$this->data['data']['username'] = $user[0]['username'];
					$this->data['data']['email'] = $user[0]['email'];
					$this->data['data']['password'] = $user[0]['password_text'];
					$this->data['data']['link'] = $actived_link;

					$send_to = $user[0]['email'];

					$message = $this->load->view('email/actived_account.php',$this->data,TRUE);
					$this->email->from('itpcmaster2020@gmail.com', 'ITPC system');
					$this->email->to($send_to);
					$this->email->cc('itpcmaster2020@gmail.com');
					$this->email->reply_to('itpcmaster2020@gmail.com');
					$this->email->subject('ITPC Actived account');
					$this->email->message($message);
					//$this->email->attach(base_url().'assets/confirm/'.$name_file);
					$this->email->send();

					if($this->email->send(FALSE)){
						$register['data'] = null;
						$register['status'] = true;
						$register['message'] = "Sorry, your message not send to ".$email.",please contact administrator ";
					}else{
						$register['data'] = null;
						$register['status'] = true;
						$register['message'] = "Congratulations, you have successfully registered, please check your email (".$email.") for account activation";
					}



				}else{
					$register['data'] = null;
					$register['status'] = false;
					$register['message'] = "failed to register exporter data, please contact the admin";
				}

			}else{
				$register['data'] = null;
				$register['status'] = false;
				$register['message'] = "failed to register user data, please contact the admin";

			}

		}else{

			$register['data'] = null;
			$register['status'] = false;
			$register['message'] = validation_errors();
		}
		echo json_encode($register); //send data to script
		return json_encode($register);

	}


	public function Actived_account($oder_actived){
		$this->load->model('API/User/User_query','User_query', true);
		$update = [
				'status' => 1
		];

		$update_user = $this->User_query->User_activved($oder_actived,$update);
		$update_exporter = $this->User_query->Exporter_activved($oder_actived,$update);

		if($update_user){
			redirect("API/confirm_success");

		}else{
			redirect("API/confirm_failed");
		}
	}

	public function confirm_success(){
		//$this->load->view('email/confirm_success.php',[],TRUE);
		echo "Congratulations, your account activation is successful";
	}

	public function confirm_failed(){
		//$this->load->view('email/confirm_failed.php',[],TRUE);
		echo "Sorry your account activation failed";
	}

	private function hash_password($password) {
    return password_hash($password, PASSWORD_DEFAULT);
  }

	public function detail_company_profile()
	{

		 $this->form_validation->set_rules('exporter_id', 'exporter_id', 'required|integer');


		 if($this->form_validation->run() == TRUE)
		 {

			$auth_code = $this->input->get_request_header('auth_code');
 			$user_id = $this->input->post('exporter_id', true);
 			$this->load->model('API/Authentication/Auth','Auth', true);
 			$get_auth_code = $this->Auth->cek_auth($auth_code);

			if($get_auth_code['auth_code'])
			{
				if($get_auth_code['user_id'] == $user_id){
					$this->load->model('API/User/User_query','User_query', true);
					$detail_user = $this->User_query->detail_exporter($user_id);

					$company_profile['data'] = $detail_user;
					$company_profile['status'] = true;
					$company_profile['message'] = "";

				}else{
					$company_profile['data'] = null;
					$company_profile['status'] = false;
					$company_profile['message'] = "Your exporter ID cannot be found, please contact the admin";
					var_dump($user_id);
				}

			}else{
				$company_profile['data'] = null;
				$company_profile['status'] = false;
				$company_profile['message'] = "Wrong auth code please re-login";

			}

		 }else{
			 $company_profile['data'] = null;
			 $company_profile['status'] = false;
			 $company_profile['message'] = validation_errors();
		 }

			echo json_encode($company_profile); //send data to script
			return json_encode($company_profile);


	}

	public function submit_image_logo(){

		$date = date_create();
		if($_FILES['logo']['error'] === 0) {
		 $upload_config['upload_path'] = 'assets/' . $this->config->item('exporter_logo_path');
		 $upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
		 //$upload_config['max_height'] = 500;
		 //$upload_config['max_width'] = 500;
		 $upload_config['file_name'] = "logo"."-".date_timestamp_get($date);
		 $this->upload->initialize($upload_config);
		 if ($this->upload->do_upload('logo')) {
			 $exporter_logo['data'] = $this->upload->data('file_name');
			 $exporter_logo['status'] = true;
			 $exporter_logo['message'] = "Image submit successful";
		 }else{
			 $exporter_logo['data'] ="";
			 $exporter_logo['status'] = false;
			 $exporter_logo['message'] =  $this->session->set_flashdata('error', 'File logo image: ' . $this->upload->display_errors('', ''));
		 }
	 }else{
		 $error =  $this->session->set_flashdata('error', 'File logo image: ' . $this->upload->display_errors('', ''));
		 $exporter_logo['data'] = $error;
		 $exporter_logo['status'] = false;
		 $exporter_logo['message'] = "Image submit failed";
	 }

	echo json_encode($exporter_logo); //send data to script
	return json_encode($exporter_logo);


	}

	public function update_detail_exporter()
	{
			$this->load->model('API/User/User_query','User_query', true);
			$this->form_validation->set_rules('id', 'id', 'trim|required|numeric');
			$this->form_validation->set_rules('name', 'name', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('address', 'address', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('phone', 'phone', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('office_phone', 'office_phone', 'trim');
			$this->form_validation->set_rules('fax', 'fax', 'trim');
			$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
			$this->form_validation->set_rules('link', 'link', 'trim');

			if($this->form_validation->run() == TRUE)
			{
				 $save_status = true;

				 $exporter_id = $this->input->post('id');
				 $exporter_name = $this->input->post('name');
				 $exporter_address = $this->input->post('address');
				 $exporter_phone = $this->input->post('phone');
				 $exporter_office_phone = $this->input->post('office_phone');
				 $exporter_phone = $this->input->post('phone');
				 $exporter_logo = $this->input->post('exporter_logo');


				 if($exporter_office_phone == null || $exporter_office_phone == ""){
					 $exporter_office_phone = null;
				 }
				 $exporter_fax = $this->input->post('fax');
				 if($exporter_fax == null || $exporter_fax == ""){
					 $exporter_fax = null;
				 }
				 $exporter_email = $this->input->post('email');
				 $exporter_link = $this->input->post('link');
				 if($exporter_link == null || $exporter_link == ""){
					 $exporter_link = null;
				 }

				 $lower_name = strtolower($exporter_name);
				 $exporter_slug = str_replace(" ","_",$lower_name);

				 $date = date_create();

				 /*
				 if($_FILES['logo']['error'] === 0) {
					$upload_config['upload_path'] = 'assets/' . $this->config->item('exporter_logo_path');
					$upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
					$upload_config['max_height'] = 500;
					$upload_config['max_width'] = 500;
					$upload_config['file_name'] = $exporter_slug."-".date_timestamp_get($date);
					$this->upload->initialize($upload_config);
					if ($this->upload->do_upload('logo')) {
						$exporter_logo = $this->upload->data('file_name');
					} else {
						$this->session->set_flashdata('error', 'File thumbnail image: ' . $this->upload->display_errors('', ''));
						$save_status = false;
					}
				}else{
					$image_defalut = rand(1,3);
					$exporter_logo = "dummy-".$image_defalut.".png";
				}*/

				if(empty($exporter_logo)){
					$image_defalut = rand(1,3);
					$exporter_logo = "dummy-".$image_defalut.".png";
				}

				if($save_status == true){

						$update = [
								'exporter_id' => $exporter_id,
								'exporter_name' => $exporter_name,
								'exporter_slug' => $exporter_slug,
								'exporter_address' => $exporter_address,
								'exporter_phone' => $exporter_phone,
								'exporter_office_phone' => $exporter_office_phone,
								'exporter_fax' => $exporter_fax,
								'exporter_email' => $exporter_email,
								'exporter_link' => $exporter_link,
								'exporter_logo' => $exporter_logo
						];

						$update_exporter['data'] = $this->User_query->Exporter_data_update($update);
						$update_exporter['status'] = true;
						$update_exporter['message'] = "Data update is successful";
				}else{
					$update_exporter['data'] = null;
					$update_exporter['status'] = false;
					$update_exporter['message'] = "Data update is failed";
				}


			}else{
				$update_exporter['data'] = null;
				$update_exporter['status'] = false;
				$update_exporter['message'] = validation_errors();
			}

			echo json_encode($update_exporter); //send data to script
			return json_encode($update_exporter);

	}

	public function update_category_exporter()
	{
		$this->load->model('API/Exporter/Exporter_category_query','Exporter_category_query', true);
		$this->load->model('API/Exporter/Exporter_subcategory_query','Exporter_subcategory_query', true);
		$this->load->model('API/Authentication/Auth','Auth', true);

		$this->form_validation->set_rules('expoter_id', 'expoter_id', 'required|integer');

		if($this->form_validation->run() == TRUE)
		{
			$auth_code = $this->input->get_request_header('auth_code');
			$expoter_id = $this->input->post('expoter_id', true);

			$get_auth_code = $this->Auth->cek_auth($auth_code);

			if($get_auth_code){

				if($get_auth_code['user_id'] == $expoter_id){
					$category_exporter['data']['category'] = $this->Exporter_category_query->category_list();
					$category_exporter['data']['subcategory'] = $this->Exporter_subcategory_query->subcategory_list();
					$category_exporter['data']['curr_category'] = $this->Exporter_category_query->category_curr_list($expoter_id);

					if($category_exporter['data']['category']  && $category_exporter['data']['subcategory'])
					{
						$category_exporter['status'] = true;
						$category_exporter['message'] = "Data displayed successfully";
					}else{
						$category_exporter['data'] = null;
						$category_exporter['status'] = false;
						$category_exporter['message'] = "Data is not displayed";
					}
				}else{
					$category_exporter['data'] = null;
					$category_exporter['status'] = false;
					$category_exporter['message'] = "Your exporter ID cannot be found, please contact the admin";
				}

			}else{
				$category_exporter['data'] = null;
				$category_exporter['status'] = false;
				$category_exporter['message'] = "Wrong auth code please re-login";
			}

		}else{
			$category_exporter['data'] = null;
			$category_exporter['status'] = false;
			$category_exporter['message'] = validation_errors();
		}
		echo json_encode($category_exporter); //send data to script
		return json_encode($category_exporter);
	}

	public function add_category_exporter()
	{
			$this->load->model('API/User/User_query','User_query', true);
			$this->form_validation->set_rules('expoter_id', 'expoter_id', 'trim|required|numeric');
			$this->form_validation->set_rules('category_id[]', 'category_id', 'trim|required|numeric');
			$this->form_validation->set_rules('subcategory_id[]', 'subcategory_id', 'trim|required|numeric');

			if($this->form_validation->run() == TRUE)
			{
				$id = $this->input->post('expoter_id');
				$category_id = $this->input->post('category_id');
				$subcategory_id = $this->input->post('subcategory_id');
				$post_date = date("Y-m-d H:i:s");
				$post_by = $id;

				for($i=0; $i < count($category_id); $i++) {
					$category[] = [
						 'exporter_id' => $id,
						 'category_id' => $category_id[$i],
						 'subcategory_id' => $subcategory_id[$i],
						 'post_date' => $post_date,
						 'post_by' => $post_by
					];
				}


				$add_category['data'] = $this->User_query->Submit_category($category);

				if($add_category['data']){
					$add_category['status'] = true;
					$add_category['message'] = "Data saved successfully";
				}else{
					$add_category['data'] = null;
					$add_category['status'] = true;
					$add_category['message'] = "Data failed to save";
				}


				/*
				if($already_existing == null){
						$already_existing = $this->User_query->Cek_category_id($category);
						if($add_category['data']){
							$add_category['status'] = true;
							$add_category['message'] = "Add Category is successful";
						}else{
							$add_category['data'] = null;
							$add_category['status'] = false;
							$add_category['message'] = "Add Category is failed";
						}
				}*/
			}else{
				$add_category['data'] = null;
				$add_category['status'] = false;
				$add_category['message'] = validation_errors();
			}

			echo json_encode($add_category); //send data to script
			return json_encode($add_category);
	}

	public function delete_category_exporter(){
		$this->load->model('API/User/User_query','User_query', true);
		$this->form_validation->set_rules('ex_cat_id', 'ex_cat_id', 'trim|required|numeric');

		if($this->form_validation->run() == TRUE)
		{

			$ex_cat_id = $this->input->post('ex_cat_id');
			$delete_date = date("Y-m-d H:i:s");

			$delete_by = $this->User_query->get_exporter_catgory_id($ex_cat_id);

			$update = [
					'ex_cat_id' => $ex_cat_id,
					'delete_date' => $delete_date,
					'delete_by' => $delete_by,
					'status' => 3
			];

			$delete_category['data'] = $this->User_query->delete_exporter_category($update);

			if($delete_category['data']){
				$delete_category['status'] = true;
				$delete_category['message'] = "Data delete is successful";
			}else{
				$delete_category['data'] = null;
				$delete_category['status'] = true;
				$delete_category['message'] = "Data delete is failed";
			}



		}else{
			$delete_category['data'] = null;
			$delete_category['status'] = false;
			$delete_category['message'] = validation_errors();
		}

		echo json_encode($delete_category); //send data to script
		return json_encode($delete_category);

	}

	public function update_exporter_product()
	{
		$this->load->model('API/User/User_query','User_query', true);
		$this->load->model('API/Authentication/Auth','Auth', true);

		$this->form_validation->set_rules('exporter_id', 'exporter_id', 'trim|required|numeric');

		if($this->form_validation->run() == TRUE)
		{

		  $exporter_id = $this->input->post('exporter_id', true);

			$auth_code = $this->input->get_request_header('auth_code');
			$get_auth_code = $this->Auth->cek_auth($auth_code);

			if($get_auth_code){

					if($get_auth_code['user_id'] == $exporter_id){

						$update_product['data'] = $this->User_query->get_exporter_product($exporter_id);

						if($update_product['data']){
							$update_product['status'] = true;
							$update_product['message'] = "Data displayed successfully";
						}else{
							$update_product['data'] = null;
							$update_product['status'] = false;
							$update_product['message'] = "Data is not displayed";
						}

					}else{
						$update_product['data'] = null;
						$update_product['status'] = false;
						$update_product['message'] = "Your exporter ID cannot be found, please contact the admin";
					}

			}else{
				$update_product['data'] = null;
				$update_product['status'] = false;
				$update_product['message'] = "Wrong auth code please re-login";
			}

		}else{
			$update_product['data'] = null;
			$update_product['status'] = false;
			$update_product['message'] = validation_errors();
		}

		echo json_encode($update_product); //send data to script
		return json_encode($update_product);

	}

	public function submit_image_exporter_product()
	{
			$date = date_create();
			if($_FILES['files']['error'] === 0) {
			 $upload_config['upload_path'] = 'assets/' . $this->config->item('exporter_product');
			 $upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
			 //$upload_config['max_height'] = 500;
			 //$upload_config['max_width'] = 500;
			 $upload_config['file_name'] = "product"."-".date_timestamp_get($date);
			 $this->upload->initialize($upload_config);
			 if($this->upload->do_upload('files')) {
				 $product_img['data'] = $this->upload->data('file_name');
				 $product_img['status'] = true;
				 $product_img['message'] = "File submit successful";
			 }else{
				 $product_img['data'] ="";
				 $product_img['status'] = false;
				 $product_img['message'] =  $this->session->set_flashdata('error', 'File thumbnail image: ' . $this->upload->display_errors('', ''));
			 }
		 }else{
			 $product_img['data'] = $this->upload->data('file_name');
			 $product_img['status'] = false;
			 $product_img['message'] = "file submit failed";
		 }

		echo json_encode($product_img); //send data to script
		return json_encode($product_img);
	}


		public function add_exporter_product()
		{
				$this->load->model('API/User/User_query','User_query', true);
				$this->form_validation->set_rules('exporter_id', 'exporter_id', 'trim|required|numeric');
				$this->form_validation->set_rules('ex_pro_image', 'ex_pro_image', 'trim|required');

				if($this->form_validation->run() == TRUE)
				{
						$images = array();
						$id = $this->input->post('exporter_id');
						$ex_pro_image = $this->input->post('ex_pro_image');
						$date = date_create();

							$post_date = date("Y-m-d H:i:s");

							$product[] = [
								 'ex_pro_id' => null,
								 'exporter_id' => $id,
								 'ex_pro_image' => $ex_pro_image,
								 'post_date' => $post_date,
								 'post_by' => $id,
								 'delete_date' => null,
								 'delete_by' => null,
								 'status' => 1,
							];
							$add_product = $this->User_query->add_exporter_product($product);

							if($add_product){
								$product_img_path['data'] = $this->upload->data('file_name');
								$product_img_path['status'] = true;
								$product_img_path['message'] = "managed to save the product image";
							}else{
								$product_img_path['data'] = null;
								$product_img_path['status'] = false;
								$product_img_path['message'] = "failed to save product images";
							}

				}else{
						$product_img_path['data'] = null;
						$product_img_path['status'] = false;
						$product_img_path['message'] = "an error occurred in uploading the file, make sure the form contains the correct contents";
				}
				echo json_encode($product_img_path); //send data to script
				return json_encode($product_img_path);
			}

	/*
	public function add_exporter_product()
	{
			$this->load->model('API/User/User_query','User_query', true);
			$this->form_validation->set_rules('exporter_id', 'exporter_id', 'trim|required|numeric');

			if($this->form_validation->run() == TRUE)
			{
					$images = array();
					$id = $this->input->post('exporter_id');
					$date = date_create();

					$total = count($_FILES['files']['name']);

					if ($total > 0) {
						$upload_config['upload_path'] = 'assets/' . $this->config->item('exporter_product');
						$upload_config['allowed_types'] = 'jpg|jpeg|png';
						$upload_config['max_height'] = 500;
						$upload_config['max_width'] = 500;

						$product_img_errors = [];
						$product_img_path = [];

						for ($i = 0; $i < $total; $i++){

							$_FILES['file']['name'] = $_FILES['files']['name'][$i];
							$_FILES['file']['type'] = $_FILES['files']['type'][$i];
							$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
							$_FILES['file']['error'] = $_FILES['files']['error'][$i];
							$_FILES['file']['size'] = $_FILES['files']['size'][$i];

							$upload_config['file_name'] = $id."-".date_timestamp_get($date);
							$this->upload->initialize($upload_config);

							if ($_FILES['file']['error'] === 0) {
								if ($this->upload->do_upload('file')) {

									$post_date = date("Y-m-d H:i:s");

									$product[] = [
										 'ex_pro_id' => null,
										 'exporter_id' => $id,
										 'ex_pro_image' => $this->upload->data('file_name'),
										 'post_date' => $post_date,
										 'post_by' => $id,
										 'delete_date' => null,
										 'delete_by' => null,
										 'status' => 1,
									];
									$add_product = $this->User_query->add_exporter_product($product);

									if($add_product){
										$product_img_path['data'] = $this->upload->data('file_name');
										$product_img_path['status'] = true;
										$product_img_path['message'] = "managed to save the product image";
									}else{
										$product_img_path['data'] = null;
										$product_img_path['status'] = false;
										$product_img_path['message'] = "failed to save product images";
									}
								}else{
									$product_img_path['data'] = null;
									$product_img_path['status'] = false;
									$product_img_path['message'] = "File [" . $_FILES['file']['name'] . "]: " . $this->upload->display_errors('', '');
								}
							}else if ($_FILES['file']['error'] !== 4) {
								$product_img_path['data'] = null;
								$product_img_path['status'] = false;
								//$product_img_path['message'] = "File [" . $_FILES['file']['name'] . "]: " . $this->lang->line('upload_' . $_FILES['file']['error']);
								$product_img_path['message'] = "eror 4";
							}

						}

					}

			}else{
					$product_img_path['data'] = null;
					$product_img_path['status'] = false;
					$product_img_path['message'] = "an error occurred in uploading the file, make sure the form contains the correct contents";
			}
			echo json_encode($product_img_path); //send data to script
			return json_encode($product_img_path);
		}*/


		public function delete_exporter_product(){
			$this->load->model('API/User/User_query','User_query', true);
			$this->form_validation->set_rules('ex_pro_id', 'ex_pro_id', 'trim|required|numeric');

			if($this->form_validation->run() == TRUE)
			{

				$ex_pro_id = $this->input->post('ex_pro_id');
				$delete_date = date("Y-m-d H:i:s");


				$update = [
						'ex_pro_id' => $ex_pro_id,
						'delete_date' => $delete_date,
						'delete_by' => $delete_by,
						'status' => 3
				];

				$product_delete['data'] = $this->User_query->delete_exporter_product($update);

				if($product_delete['data']){
					$product_delete['status'] = true;
					$product_delete['message'] = "Data delete is successful";
				}else{
					$product_delete['data'] = null;
					$product_delete['status'] = true;
					$product_delete['message'] = "Data delete is failed";
				}
			}else{
				$product_delete['data'] = null;
				$product_delete['status'] = false;
				$product_delete['message'] = validation_errors();
			}
			echo json_encode($product_delete); //send data to script
			return json_encode($product_delete);
		}


		public function add_inquiry(){
			$this->load->model('API/User/User_query','User_query', true);
			$this->load->model('API/Exporter/Exporter_category_query','Exporter_category_query', true);
			$this->load->model('API/Exporter/Exporter_subcategory_query','Exporter_subcategory_query', true);
			$this->load->model('API/Authentication/Auth','Auth', true);

			$this->form_validation->set_rules('exporter_id', 'exporter_id', 'required|integer');

			if($this->form_validation->run() == TRUE)
			{
				$auth_code = $this->input->get_request_header('auth_code');
				$exporter_id = $this->input->post('exporter_id', true);
				$get_auth_code = $this->Auth->cek_auth($auth_code);
				if($get_auth_code){
					if($get_auth_code['user_id'] == $exporter_id){

						$inquiry['data'] = $this->User_query->get_add_inquiry($exporter_id);
						$inquiry['data']['category'] = $this->Exporter_category_query->category_inquiry_list($exporter_id);
						$inquiry['data']['subcategory'] = $this->Exporter_subcategory_query->subcategory_inquiry_list($exporter_id);

						if($inquiry['data']){
							$inquiry['status'] = true;
							$inquiry['message'] = "Data displayed successfully";
						}else{
							$inquiry['data'] = null;
							$inquiry['status'] = false;
							$inquiry['message'] = "Data is not displayed";

						}

					}else{
						$inquiry['data'] = null;
						$inquiry['status'] = false;
						$inquiry['message'] = "Your exporter ID cannot be found, please contact the admin";
					}
				}else{
					$inquiry['data'] = null;
					$inquiry['status'] = false;
					$inquiry['message'] = "Wrong auth code please re-login";
				}

			}else{
				$inquiry['data'] = null;
				$inquiry['status'] = false;
				$inquiry['message'] = validation_errors();
			}
			echo json_encode($inquiry); //send data to script
			return json_encode($inquiry);
		}

		public function submit_inquiry()
		{
				$this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);

				$this->form_validation->set_rules('exporter_id', 'exporter_id', 'trim|required|integer');
				$this->form_validation->set_rules('inquiry_title', 'inquiry_title', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('exporter_name', 'exporter_name', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('exporter_address', 'exporter_address', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('category_id', 'category_id', 'trim|required|integer');
				$this->form_validation->set_rules('subcategory_id', 'subcategory_id', 'trim|required|integer');
				$this->form_validation->set_rules('product_detail', 'product_detail', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('product_capacity', 'product_capacity', 'trim|required|integer');
				$this->form_validation->set_rules('have_export', 'have_export', 'trim|required|integer');
				$this->form_validation->set_rules('contact_name', 'contact_name', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('contact_email', 'contact_email', 'trim|required|valid_email');
				$this->form_validation->set_rules('contact_phone', 'contact_phone', 'trim|required');

				if($this->form_validation->run() == TRUE)
				{
					$exporter_id = $this->input->post('exporter_id', true);
					$inquiry_title = $this->input->post('inquiry_title', true);
					$exporter_name = $this->input->post('exporter_name', true);
					$exporter_address = $this->input->post('exporter_address', true);
					$category_id = $this->input->post('category_id', true);
					$subcategory_id = $this->input->post('subcategory_id', true);
					$product_detail = $this->input->post('product_detail', true);
					$product_capacity = $this->input->post('product_capacity', true);
					$have_export = $this->input->post('have_export', true);
					$contact_name = $this->input->post('contact_name', true);
					$contact_email = $this->input->post('contact_email', true);
					$contact_phone = $this->input->post('contact_phone', true);
					$progress = 0;
					$approved = "waiting";

					$post_date = date("Y-m-d H:i:s");

					$inquiry_data[] = [
						 'inquiry_id' => null,
						 'exporter_id' => (int) $exporter_id,
						 'inquiry_title' => $inquiry_title,
						 'exporter_name' => $exporter_name,
						 'exporter_address' => $exporter_address,
						 'progress' => $progress,
						 'category_id' => (int) $category_id,
						 'subcategory_id' => (int) $subcategory_id,
						 'product_detail' => $product_detail,
						 'product_capacity' => (int) $product_capacity,
						 'have_export' => $have_export,
						 'contact_name' => $contact_name,
						 'contact_email' => $contact_email,
						 'contact_phone' => $contact_phone,
						 'post_date' => $post_date,
						 'post_by' => (int) $exporter_id,
						 'update_date' => null,
						 'update_by' => null,
						 'delete_date' => null,
						 'delete_by' => null,
						 'approved' => 	$approved,
						 'status' => 1
					];

					$submit_inquiry = $this->Inquiry_query->Submit_inquiry($inquiry_data);

					$log_status = 'submit';
					$already_read = 0;
					$action_role = "user";

					$notif[] = [
						'notif_id' => null,
						'inquiry_id' => $submit_inquiry,
						'exporter_id' => $exporter_id,
						'already_read' => $already_read,
						'post_date' => $post_date,
						'delete_date' => null,
						'status' => 1
					];

					$log[] = [
						'log_id' => null,
						'inquiry_id' => $submit_inquiry,
						'action' => $log_status,
						'action_by' => $exporter_id,
						'action_date' => $post_date,
						'action_role' => $action_role
					];

					$submit_notif = $this->Inquiry_query->Submit_notif_inquiry($notif);
					$log_inquiry = $this->Inquiry_query->Submit_log_inquiry($log);

					if($submit_inquiry && $submit_notif && $log_inquiry){
						$inquiry['data'] = "";
						$inquiry['status'] = true;
						$inquiry['message'] = "Congratulations, your inquiry has been successfully submitted";
					}else{
						$inquiry['data'] = "";
						$inquiry['status'] = false;
						$inquiry['message'] = "Sorry the inquiry failed to be submitted, please contact the administrator";
					}


				}else{
					$inquiry['data'] = null;
					$inquiry['status'] = false;
					$inquiry['message'] = validation_errors();
				}

				echo json_encode($inquiry); //send data to script
				return json_encode($inquiry);
		}

		public function list_inquiry()
		{
			$this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
			$this->load->model('API/Authentication/Auth','Auth', true);
			$this->form_validation->set_rules('exporter_id', 'exporter_id', 'trim|required|integer');

			if($this->form_validation->run() == TRUE)
			{
				$auth_code = $this->input->get_request_header('auth_code');
				$exporter_id = $this->input->post('exporter_id', true);
				$title = $this->input->post('title', true);
				$get_auth_code = $this->Auth->cek_auth($auth_code);

				if($get_auth_code){
					if($get_auth_code['user_id'] == $exporter_id){

						$page = $this->input->post('page',true);
						$limit = 10;
						$list_inquiry['data'] = $this->Inquiry_query->get_list_inquiry($limit,$page,$exporter_id);

						if($list_inquiry['data']){
							$list_inquiry['status'] = true;
							$list_inquiry['message'] = "Data displayed successfully";
						}else{
							$list_inquiry['data'] = null;
							$list_inquiry['status'] = false;
							$list_inquiry['message'] = "Data is not displayed";
						}

					}else{
						$list_inquiry['data'] = null;
						$list_inquiry['status'] = false;
						$list_inquiry['message'] = "Your exporter ID cannot be found, please contact the admin";
					}
				}else{
					$list_inquiry['data'] = null;
					$list_inquiry['status'] = false;
					$list_inquiry['message'] = "Wrong auth code please re-login";
				}
			}else{
				$list_inquiry['data'] = "";
				$list_inquiry['status'] = false;
				$list_inquiry['message'] = "Sorry the inquiry failed to be submitted, please contact the administrator";
			}

			echo json_encode($list_inquiry); //send data to script
			return json_encode($list_inquiry);
		}

		public function detail_inquiry()
		{
			$this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
			$this->load->model('API/Authentication/Auth','Auth', true);
			$this->form_validation->set_rules('inquiry_id', 'inquiry_id', 'trim|required|integer');

			if($this->form_validation->run() == TRUE)
			{
				$auth_code = $this->input->get_request_header('auth_code');
				$inquiry_id = $this->input->post('inquiry_id', true);
				$get_auth_code = $this->Auth->cek_auth($auth_code);

				if($get_auth_code){
					if($get_auth_code['user_id']){


						$detail_inquiry['data'] = $this->Inquiry_query->get_detail_inquiry($inquiry_id);

						if($detail_inquiry['data']){
							$detail_inquiry['status'] = true;
							$detail_inquiry['message'] = "Data displayed successfully";

							if(!empty($detail_inquiry['data']['inbox'])){
								$detail_inquiry['data']['inbox'] = true;
							}else{
								$detail_inquiry['data']['inbox'] = false;
							}

							$progress[] = $detail_inquiry['data']['detail'][0];
							if($progress[0]['progress'] > 99){
									$detail_inquiry['data']['importer_access'] = true;
							}else{
									$detail_inquiry['data']['importer_access'] = false;
							}
						}else{
							$detail_inquiry['data'] = null;
							$detail_inquiry['status'] = false;
							$detail_inquiry['message'] = "Data is not displayed";
						}

					}else{
						$detail_inquiry['data'] = null;
						$detail_inquiry['status'] = false;
						$detail_inquiry['message'] = "Your exporter ID cannot be found, please contact the admin";
					}
				}else{
					$detail_inquiry['data'] = null;
					$detail_inquiry['status'] = false;
					$detail_inquiry['message'] = "Wrong auth code please re-login";
				}
			}else{
				$detail_inquiry['data'] = "";
				$detail_inquiry['status'] = false;
				$detail_inquiry['message'] = "Sorry  inquiry detail failed to be load, please contact the administrator";
			}

			echo json_encode($detail_inquiry); //send data to script
			return json_encode($detail_inquiry);
		}

		public function inbox(){
			$this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
			$this->load->model('API/Authentication/Auth','Auth', true);
			$this->form_validation->set_rules('inquiry_id', 'inquiry_id', 'trim|integer');


			if($this->form_validation->run() == TRUE)
			{
				$auth_code = $this->input->get_request_header('auth_code');
				$inquiry_id = $this->input->post('inquiry_id', true);
				$get_auth_code = $this->Auth->cek_auth($auth_code);

				if($get_auth_code){
					if($get_auth_code['user_id']){

						$page = $this->input->post('page',true);
						if($page == 0){
							$page = 0;
						}else{
							$page = $page * 10;
						}
						$per_page = 10;

						$inbox['data'] = $this->Inquiry_query->get_inbox_inquiry($limit,$page,$inquiry_id);

						if($inbox['data']){
							$inbox['status'] = true;
							$inbox['message'] = "Data displayed successfully";

						}else{
							$inbox['data'] = null;
							$inbox['status'] = false;
							$inbox['message'] = "Data is not displayed";
						}

					}else{
						$inbox['data'] = null;
						$v['status'] = false;
						$inbox['message'] = "Your exporter ID cannot be found, please contact the admin";
					}
				}else{
					$inbox['data'] = null;
					$inbox['status'] = false;
					$inbox['message'] = "Wrong auth code please re-login";
				}
			}else{
				$inbox['data'] = "";
				$inbox['status'] = false;
				$inbox['message'] = "Sorry the inbox failed to be load, please contact the administrator";
			}
			echo json_encode($inbox); //send data to script
			return json_encode($inbox);
		}

		public function inbox_read(){
			$this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
			$this->form_validation->set_rules('inquiry_id', 'inquiry_id', 'trim|integer');
			$this->form_validation->set_rules('inbox_id', 'inbox_id', 'trim|integer');

			if($this->form_validation->run() == TRUE)
			{
					$inquiry_id = $this->input->post('inquiry_id', true);
					$inbox_id = $this->input->post('inbox_id', true);
					$inbox_read = 1;
					$update = date("Y-m-d H:i:s");

					if(!empty($inbox_id)){

						$update = [
							'inbox_id' => $inbox_id,
							'inbox_read' => $inbox_read,
							'update_date' => $update
						];


						$inbox['data'] = $this->Inquiry_query->update_inbox_inquiry($update);
					}else{
						$update = [
							'inquiry_id' => $inquiry_id,
							'inbox_read' => $inbox_read,
							'update_date' => $update
						];
						$inbox['data'] = $this->Inquiry_query->update_inbox_inquiry_all($update);
					}

					if($inbox['data']){
						$inbox['status'] = true;
						$inbox['message'] = " inbox on inquiry have been read";

					}else{
						$inbox['data'] = null;
						$inbox['status'] = false;
						$inbox['message'] = "failed to read all";
					}

			}else{
				$inbox['data'] = "";
				$inbox['status'] = false;
				$inbox['message'] = "Sorry the inbox failed to be read, please contact the administrator";
			}
			echo json_encode($inbox); //send data to script
			return json_encode($inbox);
		}



		public function inquiry_file(){
			$this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
			$this->load->model('API/Authentication/Auth','Auth', true);
			$this->form_validation->set_rules('inquiry_id', 'inquiry_id', 'trim|required|integer');
			if($this->form_validation->run() == TRUE)
			{
				$auth_code = $this->input->get_request_header('auth_code');
				$get_auth_code = $this->Auth->cek_auth($auth_code);
				$inquiry_id = $this->input->post('inquiry_id', true);
				$inquiry_file['data'] = $this->Inquiry_query->list_file_inquiry($inquiry_id);

				if($get_auth_code){
					if($inquiry_file['data']){
						$inquiry_file['status'] = true;
						$inquiry_file['message'] = "successful file load";
					}else{
						$inquiry_file['data'] = "";
						$inquiry_file['status'] = false;
						$inquiry_file['message'] = "file not available";
					}
				}else{
					$inquiry_file['data'] = "";
					$inquiry_file['status'] = false;
					$inquiry_file['message'] = "Wrong auth code please re-login";
				}
			}else{
				$inquiry_file['data'] = "";
				$inquiry_file['status'] = false;
				$inquiry_file['message'] = "Sorry the inbox failed to be load, please contact the administrator";
			}
			echo json_encode($inquiry_file); //send data to script
			return json_encode($inquiry_file);
		}


		public function submit_inquiry_file(){
			$date = date_create();
			if($_FILES['files']['error'] === 0) {
			 $upload_config['upload_path'] = 'assets/' . $this->config->item('inquiry_file');
			 $upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
			 //$upload_config['max_height'] = 500;
			 //$upload_config['max_width'] = 500;
			 $upload_config['file_name'] = "inquiry"."-".date_timestamp_get($date);
			 $this->upload->initialize($upload_config);
			 if ($this->upload->do_upload('files')) {
				 $inquiry_file['data'] = $this->upload->data('file_name');
				 $inquiry_file['status'] = true;
				 $inquiry_file['message'] = "File submit successful";
			 }else{
				 $inquiry_file['data'] ="";
				 $inquiry_file['status'] = false;
				 $inquiry_file['message'] =  $this->session->set_flashdata('error', 'File thumbnail image: ' . $this->upload->display_errors('', ''));
			 }
		 }else{
			 $inquiry_file['data'] = $this->upload->data('file_name');
			 $inquiry_file['status'] = false;
			 $inquiry_file['message'] = "file submit failed";
		 }

		echo json_encode($inquiry_file); //send data to script
		return json_encode($inquiry_file);
		}


		public function submit_data_inquiry_file()
		{
				$this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
				$this->form_validation->set_rules('inquiry_id', 'inquiry_id', 'trim|required|numeric');
				$this->form_validation->set_rules('user_id', 'user_id', 'trim|required|numeric');
				$this->form_validation->set_rules('file_patch', 'file_patch', 'trim|required');

				if($this->form_validation->run() == TRUE)
				{
						$images = array();
						$inquiry_id = $this->input->post('inquiry_id');
						$user_id = $this->input->post('user_id');
						$file_patch = $this->input->post('file_patch');
						$date = date_create();

						$post_date = date("Y-m-d H:i:s");
						$file_device = "ios";

						$inquiryfile[] = [
							 'file_id' => null,
							 'file_patch' => $file_patch,
							 'inquiry_id' => $inquiry_id,
							 'file_device' => $file_device,
							 'post_date' => $post_date,
							 'post_by' => $user_id,
							 'update_date' => null,
							 'update_by' => null,
							 'delete_date' => null,
							 'delete_by' => null,
							 'status' => 1,
						];
						$file_submit = $this->Inquiry_query->submit_inquiry_file($inquiryfile);

						if($file_submit){
							$inquiry_file['data'] = $this->upload->data('file_name');
							$inquiry_file['status'] = true;
							$inquiry_file['message'] = "managed to save the inquiry file";
						}else{
							$inquiry_file['data'] = null;
							$inquiry_file['status'] = false;
							$inquiry_file['message'] = "failed to save inquiry file";
						}


				}else{
						$inquiry_file['data'] = null;
						$inquiry_file['status'] = false;
						$inquiry_file['message'] = "an error occurred in uploading the file, make sure the form contains the correct contents";
				}
				echo json_encode($inquiry_file);
				return json_encode($inquiry_file);
			}



			public function delete_inquiry_file(){
				$this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
				$this->form_validation->set_rules('file_id', 'file_id', 'trim|required|numeric');


				if($this->form_validation->run() == TRUE)
				{
					$file_id = $this->input->post('file_id');
					$file_user_id = $this->Inquiry_query->file_user_id($file_id);

					$delete_date = date("Y-m-d H:i:s");
					$update = [
							'file_id' => $file_id,
							'delete_date' => $delete_date,
							'delete_by' => $file_user_id,
							'status' => 3
					];

					$file_delete['data'] = $this->Inquiry_query->inquiry_file_delete($update);

					if($file_delete['data']){
						$file_delete['status'] = true;
						$file_delete['message'] = "Data delete is successful";
					}else{
						$file_delete['data'] = null;
						$file_delete['status'] = true;
						$file_delete['message'] = "Data delete is failed";
					}
				}else{
					$file_delete['data'] = null;
					$file_delete['status'] = false;
					$file_delete['message'] = validation_errors();
				}
				echo json_encode($file_delete); //send data to script
				return json_encode($file_delete);
			}

			public function logout()
			{

				$this->load->model('API/User/User_query','User_query', true);
				$this->load->model('API/Authentication/Auth','Auth', true);

				$this->form_validation->set_rules('user_id', 'user_id', 'trim|required|numeric');

				if($this->form_validation->run() == TRUE)
				{

					$user_id = $this->input->post('user_id');
					$post_date = date("Y-m-d H:i:s");
					$code = $this->hash_password($post_date);
					$auth = [
								"auth_code" => $code,
								//"auth_code" => $this->hash_password($password),
								"user_id" => $user_id
					];
					$update_auth_code = $this->User_query->update_auth($auth);

					$logout['data'] = "";
					$logout['status'] = true;
					$logout['message'] = "successfully exited, thank you for using this application";
				}else{
					$logout['data'] = null;
					$logout['status'] = false;
					$logout['message'] = "an error occurred in uploading the file, make sure the form contains the correct contents";
				}
				echo json_encode($logout); //send data to script
				return json_encode($logout);
			}



			public function importer_inquiry_list(){
				$this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
				$this->load->model('API/Authentication/Auth','Auth', true);
				$this->form_validation->set_rules('inquiry_id', 'inquiry_id', 'trim|required|integer');
				$this->form_validation->set_rules('page', 'page', 'trim|required|integer');

				if($this->form_validation->run() == TRUE)
				{
					$auth_code = $this->input->get_request_header('auth_code');
					$get_auth_code = $this->Auth->cek_auth($auth_code);
					$inquiry_id = $this->input->post('inquiry_id', true);


					$page = $this->input->post('page',true);

					if($page == 0){
						$page = 0;
					}else{
						$page = $page * 10;
					}
					$per_page = 10;

					$importer_inquir['data'] = $this->Inquiry_query->importer_inquiry($per_page,$page,$inquiry_id);


					if($get_auth_code){
						if($importer_inquir['data']){
							$importer_inquir['status'] = true;
							$importer_inquir['message'] = "successful file load";
						}else{
							$importer_inquir['data'] = "";
							$importer_inquir['status'] = false;
							$importer_inquir['message'] = "file not available";
						}
					}else{
						$importer_inquir['data'] = null;
						$importer_inquir['status'] = false;
						$importer_inquir['message'] = "Wrong auth code please re-login";
					}
				}else{
					$importer_inquir['data'] = "";
					$importer_inquir['status'] = false;
					$importer_inquir['message'] = "Sorry the inbox failed to be load, please contact the administrator";
				}
				echo json_encode($importer_inquir); //send data to script
				return json_encode($importer_inquir);
			}


			public function importer_inquiry_detail($importer_id){
				$this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
				if($importer_id){
					$this->data["data"] = $this->Inquiry_query->importer_detail($importer_id);
					$this->load->view('mobile/importer_detail.php',$this->data);
				}else{
					echo "sorry page data is not available";
				}

			}

			public function importer_inquiry_detail_x(){
				$this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
				$this->load->model('API/Authentication/Auth','Auth', true);
				$this->form_validation->set_rules('importer_id', 'importer_id', 'trim|required|integer');

				if($this->form_validation->run() == TRUE)
				{
					$auth_code = $this->input->get_request_header('auth_code');
					$get_auth_code = $this->Auth->cek_auth($auth_code);
					$importer_id = $this->input->post('importer_id', true);

					if($get_auth_code){

						$this->data["data"] = $this->Inquiry_query->importer_detail($importer_id);
						//$this->Inquiry_query->importer_detail($importer_id);
						if($this->data["data"]){
							$body_html = $this->load->view('mobile/importer_detail.php',$this->data,TRUE);
							$importer_detail['data'] = base_url()."API/importer_inquiry_detail";
							$importer_detail['status'] = false;
							$importer_detail['message'] = "file not available";
						}else{
							$importer_detail['data'] = "";
							$importer_detail['status'] = false;
							$importer_detail['message'] = "file not available";
						}
					}else{
						$importer_detail['data'] = null;
						$importer_detail['status'] = false;
						$importer_detail['message'] = "Wrong auth code please re-login";
					}


				}else{
					$importer_detail['data'] = "";
					$importer_detail['status'] = false;
					$importer_detail['message'] = "Sorry the inbox failed to be load, please contact the administrator";
				}
				echo json_encode($importer_detail); //send data to script
				return json_encode($importer_detail);

			}
			//$message = $this->load->view('email/actived_account.php',$this->data,TRUE);

		/*public function submit_data_inquiry_file()
		{
				$this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
				$this->form_validation->set_rules('inquiry_id', 'inquiry_id', 'trim|required|numeric');
				$this->form_validation->set_rules('user_id', 'user_id', 'trim|required|numeric');

				if($this->form_validation->run() == TRUE)
				{
						$images = array();
						$inquiry_id = $this->input->post('inquiry_id');
						$user_id = $this->input->post('user_id');
						$date = date_create();

						$total = count($_FILES['files']['name']);

						if ($total > 0) {
							$upload_config['upload_path'] = 'assets/' . $this->config->item('inquiry_file');
							$upload_config['allowed_types'] = 'jpg|jpeg|png';

							for ($i = 0; $i < $total; $i++){

								$_FILES['file']['name'] = $_FILES['files']['name'][$i];
								$_FILES['file']['type'] = $_FILES['files']['type'][$i];
								$_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
								$_FILES['file']['error'] = $_FILES['files']['error'][$i];
								$_FILES['file']['size'] = $_FILES['files']['size'][$i];

								$upload_config['file_name'] = $inquiry_id."-".date_timestamp_get($date);
								$this->upload->initialize($upload_config);
								$file_type = "image";

								if ($_FILES['file']['error'] === 0) {
									if ($this->upload->do_upload('file')) {

										$post_date = date("Y-m-d H:i:s");
										$file_device = "ios";

										$inquiryfile[] = [
											 'file_id' => null,
											 'file_patch' => $this->upload->data('file_name'),
											 'inquiry_id' => $inquiry_id,
											 'file_device' => $file_device,
											 'post_date' => $post_date,
											 'post_by' => $user_id,
											 'update_date' => null,
											 'update_by' => null,
											 'delete_date' => null,
											 'delete_by' => null,
											 'status' => 1,
										];
										$file_submit = $this->Inquiry_query->submit_inquiry_file($inquiryfile);

										if($file_submit){
											$inquiry_file['data'] = $this->upload->data('file_name');
											$inquiry_file['status'] = true;
											$inquiry_file['message'] = "managed to save the inquiry file";
										}else{
											$inquiry_file['data'] = null;
											$inquiry_file['status'] = false;
											$inquiry_file['message'] = "failed to save inquiry file";
										}
									}else{
										$inquiry_file['data'] = null;
										$inquiry_file['status'] = false;
										$inquiry_file['message'] = "File [" . $_FILES['file']['name'] . "]: " . $this->upload->display_errors('', '');
									}
								}else if ($_FILES['file']['error'] !== 4) {
									$inquiry_file['data'] = null;
									$inquiry_file['status'] = false;
									//$product_img_path['message'] = "File [" . $_FILES['file']['name'] . "]: " . $this->lang->line('upload_' . $_FILES['file']['error']);
									$inquiry_file['message'] = "eror 4";
								}

							}

						}

				}else{
						$inquiry_file['data'] = null;
						$inquiry_file['status'] = false;
						$inquiry_file['message'] = "an error occurred in uploading the file, make sure the form contains the correct contents";
				}
				echo json_encode($inquiry_file);
				return json_encode($inquiry_file);
			}*/




}
