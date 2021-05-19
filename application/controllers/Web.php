<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class WEB extends CI_Controller {

    public $user_id;
    public $username;
    public $password;
    public $password_text;
    public $email;
    public $perPage = 2;

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
           
            $data = $this->Home_data_query->get_news($this->isLang());
            //pr($data);exit;
            $this->master["content"] = $this->load->view("web/home/home.php",$data, TRUE);
            $this->render();
      }
      public function web_indonesian_product($lang = '')
      {
        $this->master["content"] = $this->load->view("web/indonesian_product/indonesian_product.php",[], TRUE);
        $this->render();
      }
      public function web_news($lang = '')
      {    
            
            $category="";
            if($this->input->post("category")=="All" && empty($this->input->post("page"))){
                  
                  $start =0;
                  $data = $this->Home_data_query->news_all($this->isLang(),$this->perPage,$start,null);
                  $totalPosts =  count($data['news']);
                  $data['total_pages']  = ceil($totalPosts/$this->perPage);
                  $data['tag']='All';
                  $data['category']='All';
                  $data['block']=0;
                  echo json_encode($data); exit;
                  
            }else if($this->input->post("category") && empty($this->input->post("page"))){
                  $start =0;
                  $category=$this->input->post("category");
                 
                  //pr($data['tag'][0]['tag_title']);exit;
                  $data = $this->Home_data_query->news_all($this->isLang(),$this->perPage,$start,$category);
                  $totalPosts =  count($data['news']);
                  $data['total_pages']  = ceil($totalPosts/$this->perPage);
                  $intag=$this->Home_data_query->tag_category($category);
                  $data['tag']=$intag[0]['tag_title'];
                  $data['category']=$category;
                  $data['block']=1;
                  echo json_encode($data); exit;
            }

             if(!empty($this->input->post("page"))){
                
                  $category=$this->input->post("category");
                  $start = ($this->perPage * $this->input->post('page')) - $this->perPage;
                  if ($category=='All') {
                      $data['news'] = $this->Home_data_query->news_all($this->isLang(), $this->perPage, $start,null); //limit,start
                      $total = $this->Home_data_query->news_total($this->isLang(),$this->perPage,$start, null);
                      $data['total_pages'] =count($total['news']);
                      $data['category']='All';
                      $data['block']=2;
                  }else{
                      $data['news'] = $this->Home_data_query->news_all($this->isLang(), $this->perPage, $start,$category); //limit,start
                      $total = $this->Home_data_query->news_total($this->isLang(),$this->perPage,$start, $category);
                      $data['total_pages'] =count($total['news']);
                      $data['category']=$category;
                      $data['block']=3;
                  }
                  echo json_encode($data); exit;
                        // $this->load->view('web/news/ajax_news.php',$data);
              }
              else {
                  $category=$this->input->post("category");
                  $start =0;
                  //$this->Home_data_query->news_all($this->isLang(),$this->perPage,$start,null);

                  $data['news'] = $this->Home_data_query->news_all($this->isLang(),$this->perPage,$start, null); //limit,start
                  $total = $this->Home_data_query->news_total($this->isLang(),$this->perPage,$start, null);
                  
                  $data['total_pages'] =count($total['news']);
                  $data['tag']=$this->Home_data_query->tag_category(null);
                  $data['category']=$category;
                  $data['block']=4;
                  $this->master["content"] = $this->load->view("web/news/news.php",$data, TRUE);
                  $this->render();
              }
      }

      public function web_news_detail($slug)
      {         
            $NewsDetail = $this->Home_data_query->get_news_detail($slug,$this->isLang());
            $this->master["content"] = $this->load->view("web/news/news_detail.php", $NewsDetail , TRUE);
            $this->render();
      }
      public function web_welcome_login($lang = '')
      {
     
        $this->master["content"] = $this->load->view("web/login/welcome_login.php",[], TRUE);
        $this->render();
      }
      public function web_search_result($lang = '')
      {
            $parameter['language']=$this->isLang();
            $parameter['param']=$this->input->post('search');
            $this->master["content"] = $this->load->view("web/search/search_result.php",$parameter, TRUE);
            $this->render();
      }
      public function web_about_us($lang = '')
      {
        $data = $this->Home_data_query->about_us($this->isLang());
        //pr($data);exit;
        $this->master["content"] = $this->load->view("web/about/about_us.php",$data , TRUE);
        $this->render();
      }
      public function web_contact_us($lang = '')
      {
        session_start();
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $data['token'] = $_SESSION['token'];
        $data['content'] = $this->Home_data_query->contact_us($this->isLang());
        $data['download'] = $this->Home_data_query->download_apps($this->isLang());

       //pr($data);exit;
        $this->master["content"] = $this->load->view("web/contact/contact_us.php",$data, TRUE);
        $this->render();
      }
      public function store_contact_us(){
            if($this->input->post('csrf_token_reg') !== $_SESSION['token']) {
                  $this->session->set_flashdata('flsh_msg','failed, please contact the admin');
                  redirect($this->redirection("web_contact_us"));
            } 
       
            $contact = [
                  "full_name" => $this->input->post('name'),
                  "email" => $this->input->post('email'),
                  "industry" => $this->input->post('industry'),
                  "phone_number" => $this->input->post('phone'),
                  "message" => $this->input->post('message'),
                  "create_date" => date("Y-m-d H:i:s") 
            ];

            $submit_user = $this->Home_data_query->save_contact_us($contact);
            if($submit_user){
                  $select_email_cc =  $this->Home_data_query->selectemailcc();
                  foreach($select_email_cc as $item){
                        $this->load->library('email');
                        $this->data['data'] = $contact;
                       // pr($this->data);exit;
                        $send_to = $item['email'];
                        $message = $this->load->view('email/confirm_contact_us.php',$this->data,TRUE);
                        $this->email->from('itpcmaster2020@gmail.com', 'ITPC system');
                        $this->email->to($send_to);
                        $this->email->cc('itpcmaster2020@gmail.com');
                        $this->email->reply_to('itpcmaster2020@gmail.com');
                        $this->email->subject('ITPC Feedback');
                        $this->email->message($message);
                        $this->email->send();

                        if($this->email->send(FALSE)){
                              $register['data'] = null;
                              $register['status'] = true;
                              $register['message'] = "Sory you have already submit ";
                        }else{
                              $register['data'] = null;
                              $register['status'] = true;
                              $register['message'] = "you have already submit ";
                        }
                  }
               
            }
            //pr($register);exit;
            $this->session->set_flashdata('flsh_msg',$register['message']);
            redirect($this->redirection("web_contact_us"));
          
      }

      public function web_index_exporter($lang = '')
      {
      $this->load->model('API/Exporter/Exporter_category_query','Exporter_category_query', true);
      $this->load->model('API/Exporter/Exporter_subcategory_query','Exporter_subcategory_query', true);
      $this->load->model('API/Authentication/Auth','Auth', true);
      $this->load->model('API/User/User_query','User_query', true);
      $this->load->model('Web/Exporter/Exporter_list_query','Exporter_list_query', true);
      
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
    
      $data=array();
      // if($get_auth_code){
                  $data['id_ex']  = $this->User_query->detail_exporter($this->session->user_logged['user_id'])['exporter_detail'][0]['id'];
                  $data['category'] = $this->Exporter_category_query->category_list();
                  $data['subcategory'] = $this->Exporter_subcategory_query->subcategory_list();
                  $data['curr_category'] = $this->Exporter_category_query->category_curr_list($this->session->user_logged['user_id']);
      //}
      $data['exporter']=$this->Exporter_list_query->exporter_list();
      //pr($data['exporter']);exit;
        $this->master["content"] = $this->load->view("web/exporter/exporter_index.php",$data, TRUE);
        $this->render();
      }
      public function web_index_exporter_detail($lang = '')
      {
        $this->master["content"] = $this->load->view("web/exporter/exporter_index_detail.php",[], TRUE);
        $this->render();
      }
      public function web_exporter_search_result($lang = '')
      {
      $category = $this->input->get('categoryId');
      $exporterName = $this->input->get('name');
        $this->load->model('Web/Exporter/Exporter_list_query','Exporter_list_query', true);
        $data['exporter']=$this->Exporter_list_query->search($exporterName, $category);
        $data['category'] = "All";
        if(!empty($data["exporter"]["data"])){
              $data['category'] = $data["exporter"]["category"]["category_title"];
        }
        $data['exporterName'] = $exporterName;
        $this->master["content"] = $this->load->view("web/exporter/exporter_search_result.php",$data, TRUE);
        $this->render();
      }
      public function web_importer_list($lang = '')
      {
           $this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
            $getIdImporter=clean($this->input->get('detail'));
            $importerlist=$this->Inquiry_query->importer_inquiry(10,0,$getIdImporter);
            $this->master["content"] = $this->load->view("web/dashboard/importer_list.php",$importerlist, TRUE);
            $this->render();
      }
      public function web_importer_list_detail($id)
      {
          
            $this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
            $importerlist=$this->Inquiry_query->importer_detail($id);
            //pr($importerlist);exit;
            $this->master["content"] = $this->load->view("web/dashboard/importer_list_detail.php",$importerlist, TRUE);
            $this->render();
      }

      public function web_itpc_login($lang = '')
      {
        session_start();
        $_SESSION['token'] = bin2hex(random_bytes(32));
        $data['token'] = $_SESSION['token'];
        $this->master["content"] = $this->load->view("web/login/login.php",$data, TRUE);
        $this->render();
      }
      public function web_itpc_Logout()
	{
		$this->session->sess_destroy();
		redirect($this->redirection("web_itpc_login"));

	}
      function redirection($string){

            $redirect ="";
            if($this->uri->segment(1)==''){
                  $redirect='en/'+$string;
            }elseif($this->uri->segment(1) == 'en'){
                  $redirect=$this->uri->segment(1).'/'.$string;
            }elseif($this->uri->segment(1) == 'id'){
                  $redirect=$this->uri->segment(1).'/'.$string;
            }elseif($this->uri->segment(1) == 'es'){
                  $redirect=$this->uri->segment(1).'/'.$string;
            }else{
                  $redirect = $this->config->base_url('en/'.$string);
            }
            return $redirect;
      }

      function isLang(){

            $lang ="";

            if($this->uri->segment(1)==''){   $lang='en';  }
            elseif($this->uri->segment(1) == 'en'){ $lang='en'; }
            elseif($this->uri->segment(1) == 'id'){ $lang='id'; }
            elseif($this->uri->segment(1) == 'es'){ $lang='es'; }
            else{ $lang='en'; }
        
            return $lang;
      }


      public function web_store_login(){

      if($this->input->post('csrf_token_reg') !== $_SESSION['token']) {
            $this->session->set_flashdata('flsh_msg','failed to register user data, please contact the admin');
            redirect($this->redirection("web_itpc_login"));
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
            redirect($this->redirection("web_exporter_account"));
      }else{
            $this->session->set_flashdata('flsh_msg_login','Please Check Your Email And Password !');
            redirect($this->redirection('web_itpc_login'));
      }
  }
  public function web_register($lang = '')
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
                  redirect($this->redirection('web_register'));
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
            if($register['status']==true) redirect($this->redirection('web_thank_you'));
            $this->session->set_flashdata('flsh_msg',$register['message']);
		redirect($this->redirection('web_register'));
  }

      public function web_confirm_success(){
      
      echo "Congratulations, your account activation is successful";
      }

      public function web_confirm_failed(){
            //$this->load->view('email/confirm_failed.php',[],TRUE);
            echo "Sorry your account activation failed";
      }

      private function hash_password($password) {
      return password_hash($password, PASSWORD_DEFAULT);
      }

    public function web_exporter()
	{
        //pr('masuk');exit;
        $this->master["custume_css"] = NULL;
        $this->master["custume_js"] = NULL;
        $this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);
        $this->master["content"] = $this->load->view("web/home/home.php",[], TRUE);
        $this->render();
	}

  public function web_exporter_account($lang = '')
  {
        if(!$this->session->user_logged['user_id']){  redirect("/en/web_itpc_login"); }
        $this->load->model('WEB/Exporter/Exporter_list_query','User_query', true);
        $user_id = $this->session->user_logged['user_id'];
        $detail_user = $this->User_query->find_exporter($user_id);
        //pr($detail_user);exit;
        $this->master["content"] = $this->load->view("web/dashboard/exporter_account.php",$detail_user, TRUE);
        $this->render();
  }

  public function web_add_account($lang = '')
  {
     
      if($this->session->user_logged)
      {
            $this->load->model('API/User/User_query','User_query', true);
            $auth_code = $this->input->get_request_header('auth_code');
            $user_id = $this->session->user_logged['user_id'];
            $detail_user['user_id'] = $user_id;
            $detail_user['detail_user'] = $this->User_query->detail_exporter($user_id);
            //pr($detail_user);exit;

      }else{
            redirect($this->redirection('web_login'));
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
                 // pr('ss');exit;
            
			$this->load->model('API/User/User_query','User_query', true);
                  $this->load->model('WEB/Exporter/Exporter_list_query','Exporter__query', true);
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
                              //Cek Exporter Home 
                              $CekExHome=$this->Exporter__query->find_exporter($exporter_id);
                              //pr($CekExHome['it_ex'][0]['exporter_home']);exit;
                              if($CekExHome['it_ex'][0]['exporter_home']==0){
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
                                                'exporter_home' => 1,
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
                                          'exporter_home' => 1,
                                          'exporter_office_phone' => $exporter_office_phone,
                                          'exporter_fax' => $exporter_fax,
                                          'exporter_email' => $exporter_email,
                                          'exporter_link' => $exporter_link
                                          ];
                              }
                              
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
                  
                  //pr($update_exporter);exit;
                        redirect($this->redirection('web_exporter_account'));
              

	}



  public function web_add_category($lang = '')
  {
      $this->load->model('API/Exporter/Exporter_category_query','Exporter_category_query', true);
      $this->load->model('API/Exporter/Exporter_subcategory_query','Exporter_subcategory_query', true);
      $this->load->model('API/Authentication/Auth','Auth', true);
      $this->load->model('API/User/User_query','User_query', true);
      $this->load->model('WEB/Exporter/Exporter_list_query','Ex_cek', true);

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

  public function web_thank_you($lang = '')
  {
        $this->master["content"] = $this->load->view("web/login/thankyou.php",[], TRUE);
        $this->render();
  }


  public function web_add_product($lang = '')
  {
      $this->load->model('API/User/User_query','User_query', true);
      $this->load->model('API/Authentication/Auth','Auth', true);

      $this->form_validation->set_rules('exporter_id', 'exporter_id', 'trim|required|numeric');

      if($this->session->user_logged)
      {

            $exporter_id =  $this->User_query->detail_exporter($this->session->user_logged['user_id'])['exporter_detail'][0]['id'];
            $auth_code = $this->session->user_logged['auth_code'];
            $get_auth_code = $this->Auth->cek_auth($auth_code);
            if($get_auth_code){
                if($get_auth_code['user_id'] == $exporter_id){
                        $update_product['data'] = $this->User_query->get_exporter_product($exporter_id);

                        $update_product['ex_id']=$exporter_id;
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
      $update_product['totaldataproduk']=count($update_product['data']);

      //pr($update_product);exit;
      $this->master["content"] = $this->load->view("web/dashboard/add_product.php",$update_product, TRUE);  
      $this->render();
  }
      public function w_add_category_exporter()
	{
			$this->load->model('WEB/User/User_query','User_query', true);
                  $this->load->model('WEB/Exporter/Exporter_list_query','CekIDex', true);
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
                              $update = [
                                          'exporter_id' => $id,
                                          'exporter_home' => 2
                                        ];
                             
                              $update_exporter['data'] = $this->User_query->Exporter_data_update($update);
                        	$add_category['status'] = true;
					$add_category['message'] = "Data saved successfully";
				}else{
					$add_category['data'] = null;
					$add_category['status'] = true;
					$add_category['message'] = "Data failed to save";
				}

			}else{
				$add_category['data'] = null;
				$add_category['status'] = false;
				$add_category['message'] = validation_errors();
			}

			echo json_encode($add_category); //send data to script
			return json_encode($add_category);
	}
  public function store_product(){
      $date = date_create();
      if (!empty($_FILES['ex_pro_image']['name'])) {

            $upload_config['upload_path'] = './assets/website/exporter_product/';
            //pr($upload_config['upload_path'] );exit;
            $upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
            $upload_config['max_width']            = 1024;
            $upload_config['max_height']           = 768;
            $upload_config['file_name'] = "ex_pro_image"."-".date_timestamp_get($date).'-'.md5($_FILES['ex_pro_image']['name']).'.'.str_replace('image/','',$_FILES['ex_pro_image']['type']);
            $upload_config['max_size'] = 2000;

            $this->load->library('upload', $upload_config);
            $this->upload->initialize($upload_config);

            $data=array();
            if (!$this->upload->do_upload('ex_pro_image')) 
            {
                  
                  $data = array('error' => $this->upload->display_errors());
                  $this->session->set_flashdata('flsh_msg',$data['error']);
                  redirect($this->redirection('web_add_product'));
            } 
            else 
            {
                  $data = array('image_metadata' => $this->upload->data());
            }
      }
      $this->load->model('API/User/User_query','User_query', true);
      $this->form_validation->set_rules('exporter_id', 'exporter_id', 'trim|required|numeric');
     
      if($this->form_validation->run() == TRUE)
            {
                  // pr('ss');exit;
                        $images = array();
                        $id = $this->input->post('exporter_id');
                        $ex_pro_image = $upload_config['file_name'];
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
                                    $product_img_path['data'] = 'success';
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
            redirect($this->redirection('web_add_product'));




  }

  public function web_add_inquiry($lang = '')
  {
      $this->load->model('API/Exporter/Exporter_category_query','Exporter_category_query', true);
      $this->load->model('API/Exporter/Exporter_subcategory_query','Exporter_subcategory_query', true);
      $this->load->model('API/Authentication/Auth','Auth', true);
      $this->load->model('API/User/User_query','User_query', true);
      $auth_code = $this->session->user_logged['auth_code'];
      $get_auth_code = $this->Auth->cek_auth($auth_code);

     
    
      $category_exporter=array();
      if($get_auth_code){
           
                  $category_exporter['data']['id_ex']  = $this->User_query->detail_exporter($this->session->user_logged['user_id'])['exporter_detail'][0]['id'];
                  $category_exporter['data']['category'] = $this->Exporter_category_query->category_list();
                  $category_exporter['data']['subcategory'] = $this->Exporter_subcategory_query->subcategory_list();
                  $category_exporter['data']['curr_category'] = $this->Exporter_category_query->category_curr_list($this->session->user_logged['user_id']);
      }
     // pr($category_exporter);exit;
      
     $_SESSION['token'] = bin2hex(random_bytes(32));
     $category_exporter['token'] = $_SESSION['token'];
      
        $this->master["content"] = $this->load->view("web/dashboard/add_inquiry.php",$category_exporter, TRUE);
        $this->render();
  }

  public function store_inquiry()
		{
                  if($this->input->post('csrf_token_reg') !== $_SESSION['token']) {
                        $this->session->set_flashdata('flsh_msg','failed to register user data, please contact the admin');
                        redirect($this->redirection('web_register'));
                  } 
      
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
                        //pr($inquiry);exit;
                        if($inquiry['status']){
                              redirect($this->redirection('web_exporter_account'));
                        }else{
                              $this->session->set_flashdata('flsh_msg',$inquiry['message']);
                              redirect($this->redirection('web_add_inquiry'));
                        }

                        //pr($inquiry);exit;
				//return json_encode($inquiry);
		}

  public function web_inquiry_list($lang = '')
  {
      $this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
      $this->load->model('API/Authentication/Auth','Auth', true);
      $this->load->model('API/User/User_query','User_query', true);
      $this->form_validation->set_rules('exporter_id', 'exporter_id', 'trim|required|integer');

      
            $auth_code = $this->session->user_logged['auth_code'];
            $exporter_id =  $this->User_query->detail_exporter($this->session->user_logged['user_id'])['exporter_detail'][0]['id'];
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
      
          
      $auth_code = $this->input->get_request_header('auth_code');
      $user_id = $this->session->user_logged['user_id'];
      $list_inquiry['user_id'] = $user_id;
      $list_inquiry['detail_user'] = $this->User_query->detail_exporter($user_id);
     // pr($list_inquiry);exit;
      $this->master["content"] = $this->load->view("web/dashboard/inquiry_list.php",$list_inquiry, TRUE);
      $this->render();
  }

  public function web_inquiry_progress($lang = '')
  {
            $this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
            $this->load->model('API/Authentication/Auth','Auth', true);
            $this->load->model('API/User/User_query','User_query', true);
            $this->form_validation->set_rules('exporter_id', 'exporter_id', 'trim|required|integer');

            
                  $auth_code = $this->session->user_logged['auth_code'];
                  $exporter_id =  $this->User_query->detail_exporter($this->session->user_logged['user_id'])['exporter_detail'][0]['id'];
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
            
            
            $auth_code = $this->input->get_request_header('auth_code');
            $user_id = $this->session->user_logged['user_id'];
            $list_inquiry['user_id'] = $user_id;
            $list_inquiry['detail_user'] = $this->User_query->detail_exporter($user_id);
            //pr($list_inquiry);exit;
            $this->master["content"] = $this->load->view("web/dashboard/inquiry_progress.php",$list_inquiry, TRUE);
            $this->render();
  }
  public function web_inquiry_inbox($inquiry_id)
  {
      $lang="";
      //  pr($id);exit;
      $this->load->model('API/Inquiry/Inquiry_query','Inquiry_query', true);
      $this->load->model('API/Authentication/Auth','Auth', true);
      $this->form_validation->set_rules('inquiry_id', 'inquiry_id', 'trim|integer');


      
            $auth_code = $this->session->user_logged['auth_code'];
           
          
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
      
       // pr($inbox);exit;
        $inbox['data']['auth_code']=$auth_code;
        $inbox['data']['exporter_id']=$auth_code;
        $this->master["content"] = $this->load->view("web/dashboard/inquiry_inbox.php",$inbox, TRUE);
        $this->render();
  }




}
