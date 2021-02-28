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
     
        $this->master["content"] = $this->load->view("web/login/welcome_login.php",[], TRUE);
        $this->render();
      }
      public function login($lang = '')
      {
        session_start();
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $data['token'] = $_SESSION['token'];
        $this->master["content"] = $this->load->view("web/login/login.php",$data, TRUE);
        $this->render();
      }
      public function Logout()
	{
		$this->session->sess_destroy();
		redirect("en/login");

	}

      public function store_login(){

      if($this->input->post('csrf_token_reg') !== $_SESSION['token']) {
            $this->session->set_flashdata('flsh_msg','failed to register user data, please contact the admin');
            redirect('en/login');
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

      
      $this->session->set_flashdata('flsh_msg',$register['message']);
      if($login['status'] == 1){
            $this->session->set_userdata(['user_logged' =>  $login['data']]);
            redirect('en/exporter_account');
      }else{
            redirect('en/login');
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
       // pr($_SESSION);exit;
        $this->master["content"] = $this->load->view("web/dashboard/exporter_account.php",[], TRUE);
        $this->render();
  }

  public function add_account($lang = '')
  {
        $News = $this->Home_data_query->get_news();
        $this->master["content"] = $this->load->view("web/dashboard/add_account.php",[], TRUE);
        $this->render();
  }

  public function add_category($lang = '')
  {
        $News = $this->Home_data_query->get_news();
        $this->master["content"] = $this->load->view("web/dashboard/add_category.php",[], TRUE);
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



}
