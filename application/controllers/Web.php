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
        $this->master["content"] = $this->load->view("web/news/news_detail.php", $NewsDetail , TRUE);
        $this->render();
      }
      public function welcome_login($lang = '')
      {
     
        $this->master["content"] = $this->load->view("web/login/welcome_login.php",[], TRUE);
        $this->render();
      }
      public function itpc_login($lang = '')
      {
        session_start();
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $data['token'] = $_SESSION['token'];
        $this->master["content"] = $this->load->view("web/login/login.php",$data, TRUE);
        $this->render();
      }
      public function itpc_Logout()
	{
		$this->session->sess_destroy();
		redirect("en/itpc_login");

	}

      public function store_login(){

      if($this->input->post('csrf_token_reg') !== $_SESSION['token']) {
            $this->session->set_flashdata('flsh_msg','failed to register user data, please contact the admin');
            redirect('en/itpc_login');
      } 
     
    

      $this->load->model('API/User/User_query','User_query', true);
      $this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
      $this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');
      
      if($this->form_validation->run() == TRUE)
      {

         
                  $email = $this->input->post('email');
                  $password = $this->input->post('password');

                  $get_hash = $this->User_query->cek_email($email);
                  //pr($email);exit;
                  if($get_hash){

                              if(password_verify($password, $get_hash)){
                                          $login_user = $this->User_query->login($email,$get_hash);

                                           $cek_active = $login_user['user_data'][0]['status'];
                                           $user_id = $login_user['user_data'][0]['user_id'];

                                          $cek_auth = $this->User_query->cek_auth($user_id);
                                          if($cek_auth){
                                                $auth_code = $this->User_query->get_auth($user_id);
                                          }else{
                                                $post_date = date("Y-m-d H:i:s");
                                                $auth[] = [
                                                                  "auth_id " => null,
                                                                  "auth_code" => $this->hash_password($password),
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
                                                      "user_id" => $login_user['user_data'][0]['user_id'],
                                                      "username" => $login_user['user_data'][0]['username'],
                                                      "email" => $login_user['user_data'][0]['email'],
                                                      // "status" => $login_user['user_data'][0]['status'],
                                                      // "inquery_menu" => $inquery_menu,
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

      
      
      if($login['status'] == 1){
            $this->session->set_userdata(['user_logged' =>  $login['data']]);
            redirect('en/exporter_account');
      }else{
            $this->session->set_flashdata('flsh_msg_login','Please Check Your Email And Password !');
          
            redirect('en/itpc_login');
      }
  }
  public function register($lang = '')
  {
        session_start();
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $data['token'] = $_SESSION['token'];
        $this->master["content"] = $this->load->view("web/login/register.php",$data, TRUE);
        $this->render();
  }

  public function store_register(){

            if($this->input->post('csrf_token_reg') !== $_SESSION['token']) {
                  $this->session->set_flashdata('flsh_msg','failed to register user data, please contact the admin');
                  redirect('en/register');
            } 

		$this->load->model('API/User/User_query','User_query', true);
		$this->load->model('API/Exporter/Exporter_company_query','Exporter_company_query', true);
          //  pr($_REQUEST);exit;
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
		//echo json_encode($register); 
            if($register['status']==true) redirect('en/thank_you');
            $this->session->set_flashdata('flsh_msg',$register['message']);
		redirect('en/register');
  }

      public function confirm_success(){
      
      echo "Congratulations, your account activation is successful";
      }

      public function confirm_failed(){
            //$this->load->view('email/confirm_failed.php',[],TRUE);
            echo "Sorry your account activation failed";
      }

      private function hash_password($password) {
      return password_hash($password, PASSWORD_DEFAULT);
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
       
        $this->load->model('API/User/User_query','User_query', true);
        $user_id = $this->session->user_logged['user_id'];
        $detail_user = $this->User_query->detail_exporter($user_id);
        $this->master["content"] = $this->load->view("web/dashboard/exporter_account.php",$detail_user, TRUE);
        $this->render();
  }

  public function add_account($lang = '')
  {
     
      if($this->session->user_logged)
      {
            $this->load->model('API/User/User_query','User_query', true);
            $auth_code = $this->input->get_request_header('auth_code');
            $user_id = $this->session->user_logged['user_id'];
            $detail_user = $this->User_query->detail_exporter($user_id);
            //pr($detail_user);exit;

      }else{
            redirect('en/login');
      }

        $this->master["content"] = $this->load->view("web/dashboard/add_account.php",$detail_user, TRUE);
        $this->render();
  }

  
      public function store_detail_exporter()
	{           $date = date_create();

                  if (!empty($_FILES['exporter_logo']['name'])) {

                        $upload_config['upload_path'] = './assets/website/exporter/';
                        //pr($upload_config['upload_path'] );exit;
                        $upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
                        $upload_config['max_width']            = 1024;
                        $upload_config['max_height']           = 768;
                        $upload_config['file_name'] = "exporter_logo"."-".date_timestamp_get($date);
                        $upload_config['max_size'] = 2000;
            
                        $this->load->library('upload', $upload_config);
                        $this->upload->initialize($upload_config);
            
                        $data=array();
                        if (!$this->upload->do_upload('exporter_logo')) 
                        {
                              $data = array('error' => $this->upload->display_errors());
                        } 
                        else 
                        {
                              $data = array('image_metadata' => $this->upload->data());
                        }
                  }
            
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
				 $exporter_logo = $upload_config['file_name'];
                        

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

			
				if(empty($exporter_logo)){
					$image_defalut = rand(1,3);
					$exporter_logo = "dummy-".$image_defalut.".png";
				}

				if($save_status == true){
                                    if (!empty($_FILES['exporter_logo']['name'])) {
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
                              }else{
                                    $update = [
                                          'exporter_id' => $exporter_id,
                                          'exporter_name' => $exporter_name,
                                          'exporter_slug' => $exporter_slug,
                                          'exporter_address' => $exporter_address,
                                          'exporter_phone' => $exporter_phone,
                                          'exporter_office_phone' => $exporter_office_phone,
                                          'exporter_fax' => $exporter_fax,
                                          'exporter_email' => $exporter_email,
                                          'exporter_link' => $exporter_link
                              ];
                              }

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
                  
                        redirect('en/exporter_account');
              

	}



  public function add_category($lang = '')
  {
      $this->load->model('API/Exporter/Exporter_category_query','Exporter_category_query', true);
      $this->load->model('API/Exporter/Exporter_subcategory_query','Exporter_subcategory_query', true);
      $this->load->model('API/Authentication/Auth','Auth', true);
      $this->load->model('API/User/User_query','User_query', true);

      //GET SUBCATEGORY
      if(@$this->input->post('categoryId')){
            $subcategory = $this->Exporter_subcategory_query->subcategory_list();
            $tempcat=array();
            $i=0;
            foreach($subcategory as $itemsub){
                  if($itemsub['category_id']==$this->input->post('categoryId') )
                  {
                        $tempcat[$i]['id']=$itemsub['id'];
                        $tempcat[$i]['title']=$itemsub['title'];
                        $i++;
                  }
            }
            echo json_encode($tempcat);
            return json_encode($tempcat);
      }

      $auth_code = $this->session->user_logged['auth_code'];
      $get_auth_code = $this->Auth->cek_auth($auth_code);
    
      $category_exporter=array();
      if($get_auth_code){
                  $category_exporter['data']['id_ex']  = $this->User_query->detail_exporter($this->session->user_logged['user_id'])['exporter_detail'][0]['id'];
                  $category_exporter['data']['category'] = $this->Exporter_category_query->category_list();
                  $category_exporter['data']['subcategory'] = $this->Exporter_subcategory_query->subcategory_list();
                  $category_exporter['data']['curr_category'] = $this->Exporter_category_query->category_curr_list($this->session->user_logged['user_id']);
      }
      
      //pr($category_exporter);exit;
      $this->master["content"] = $this->load->view("web/dashboard/add_category.php",$category_exporter, TRUE);
      $this->render();
  }

  public function thank_you($lang = '')
  {
        $News = $this->Home_data_query->get_news();
        $this->master["content"] = $this->load->view("web/login/thankyou.php",[], TRUE);
        $this->render();
  }


  public function add_product($lang = '')
  {
        $News = $this->Home_data_query->get_news();
        $this->master["content"] = $this->load->view("web/dashboard/add_product.php",[], TRUE);
        $this->render();
  }

  public function add_inquiry($lang = '')
  {
        $News = $this->Home_data_query->get_news();
        $this->master["content"] = $this->load->view("web/dashboard/add_inquiry.php",[], TRUE);
        $this->render();
  }

  public function inquiry_list($lang = '')
  {
        $News = $this->Home_data_query->get_news();
        $this->master["content"] = $this->load->view("web/dashboard/inquiry_list.php",[], TRUE);
        $this->render();
  }

  public function inquiry_progress($lang = '')
  {
        $News = $this->Home_data_query->get_news();
        $this->master["content"] = $this->load->view("web/dashboard/inquiry_progress.php",[], TRUE);
        $this->render();
  }
  public function inquiry_inbox($lang = '')
  {
        $News = $this->Home_data_query->get_news();
        $this->master["content"] = $this->load->view("web/dashboard/inquiry_inbox.php",[], TRUE);
        $this->render();
  }



}
