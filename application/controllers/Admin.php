<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

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
	 $this->master["main_css"] = $this->load->view('admin/main_css.php', [], TRUE);
	 $this->master["main_js"] = $this->load->view("admin/main_js.php", [], TRUE);
	 $this->master["top_menu"] = $this->load->view("admin/top_menu.php", $this->header_data, TRUE);
	 $this->master["main_menu"] = $this->load->view("admin/main_menu.php", $this->data, TRUE);
	 $this->load->view("admin/master", $this->master);
 }

 function tinymce_upload() {
		$config['upload_path'] = './assets/upload/';
		$config['allowed_types'] = 'jpg|png|jpeg';
		$config['max_size'] = 0;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('file')) {
			$this->output->set_header('HTTP/1.0 500 Server Error');
			exit;
		} else {
			$file = $this->upload->data();
			$this->output
				->set_content_type('application/json', 'utf-8')
				->set_output(json_encode(['location' => base_url().'assets/upload/'.$file['file_name']]))
				->_display();
			exit;
		}
	}

 private function hash_password($password) {
	 return password_hash($password, PASSWORD_DEFAULT);
 }

	public function index()
	{
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
		 	redirect("Admin/login");
			}else{
			//$this->load->model('admin/invoice/Invoice_admin','Invoice_admin', true);
			//$this->data['data'] = $this->Invoice_admin->list_invoice();
			//$this->data
			$this->master["custume_css"] = NULL;
			$this->master["custume_js"] = NULL;
			$this->master["content"] = $this->load->view("admin/dashboard/content.php",[], TRUE);
			$this->render();
			}
	}

	public function Expoter_management()
	{
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
		 	redirect("Admin/Logout");
			}else{
			//$this->load->model('admin/invoice/Invoice_admin','Invoice_admin', true);
			//$this->data['data'] = $this->Invoice_admin->list_invoice();
			//$this->data
			$this->master["custume_css"] = $this->load->view('admin/exporter_managment/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/exporter_managment/custume_js.php', [], TRUE);
			$this->master["content"] = $this->load->view("admin/exporter_managment/content.php",[], TRUE);
			$this->render();
			}
	}

	public function Exporter_add(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
		 	redirect("Admin/Logout");
			}else{
			//$this->load->model('admin/invoice/Invoice_admin','Invoice_admin', true);
			//$this->data['data'] = $this->Invoice_admin->list_invoice();
			//$this->data
			$this->master["custume_css"] = $this->load->view('admin/exporter_add/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/exporter_add/custume_js.php', [], TRUE);
			$this->master["content"] = $this->load->view("admin/exporter_add/content.php",[], TRUE);
			$this->render();
			}
	}


	public function Expoter_list_data()
	{
			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);

			$postData = $this->input->get();

			//$exporter_list = $this->Exporter_query->get_list();

			$exporter_list = $this->Exporter_query->getEmployees($postData);

			echo json_encode($exporter_list);

	}

	public function Submit_expoter()
	{
			$this->load->model('API/User/User_query','User_query', true);
			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);

			$this->form_validation->set_rules('exporter_name', 'exporter_name', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('exporter_address', 'exporter_address', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('exporter_phone', 'exporter_phone', 'trim');
			$this->form_validation->set_rules('exporter_office_phone', 'exporter_office_phone', 'trim');
			$this->form_validation->set_rules('exporter_fax', 'exporter_fax', 'trim');
			$this->form_validation->set_rules('exporter_email', 'exporter_email', 'trim|required|valid_email');
			$this->form_validation->set_rules('exporter_link', 'exporter_link', 'trim');
			$this->form_validation->set_rules('is_draft', 'is_draft', 'trim');

			if($this->form_validation->run() == TRUE)
			{
						$is_save = true;
						$exporter_name = $this->input->post('exporter_name');
						$exporter_address = $this->input->post('exporter_address');
						$exporter_phone = $this->input->post('exporter_phone');
						$exporter_office_phone = $this->input->post('exporter_office_phone');
						$exporter_fax = $this->input->post('exporter_fax');
						$exporter_email = $this->input->post('exporter_email');
						$exporter_link = $this->input->post('exporter_link');
						$is_draft = $this->input->post('is_draft');

						if($is_save){
								$cek_exporter_name = $this->Exporter_query->cek_expoter_name($exporter_name);
								if($cek_exporter_name){
										$this->session->set_flashdata('error', "exporter name already exists");
										$is_save = false;
								}

						}else{
								$is_save = false;
						}

						if($is_save == true){
							 	$cek_exporter_email = $this->Exporter_query->cek_expoter_email($exporter_email);
								if($cek_exporter_email){
									$is_save = false;
									$this->session->set_flashdata('error', "exporter email already exists");
								}else{
									$is_save = true;
								}

						}else{
								$is_save = false;
						}

					 	$lower_name = strtolower($exporter_name);
	 				 	$exporter_slug = str_replace(" ","_",$lower_name);
					 	$date = date_create();

						if($is_draft == 1){
								$status = 2;
						}else{
								$status = 1;
						}

						if($is_save == true){
							if($_FILES['logo']['error'] === 0) {
			 					$upload_config['upload_path'] = 'assets/' . $this->config->item('exporter_logo_path');
			 					$upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
			 					$upload_config['max_height'] = 500;
			 					$upload_config['max_width'] = 500;
			 					$upload_config['file_name'] = $exporter_slug."-".date_timestamp_get($date);
			 					$this->upload->initialize($upload_config);
			 					if($this->upload->do_upload('logo')) {
			 						$exporter_logo = $this->upload->data('file_name');
			 					} else {
			 						$this->session->set_flashdata('error', 'File thumbnail image: ' . $this->upload->display_errors('', ''));
			 						$is_save = false;
			 					}
			 				}else{
			 					$image_defalut = rand(1,3);
			 					$exporter_logo = "dummy-".$image_defalut.".png";
			 				}
						}

						if($is_save == true){



								$get_explode_email = explode("@", $exporter_email);
								$username = $get_explode_email[0];
								$get_password = explode(" ", $exporter_name);
					  		$password = $get_password[0]."-".date("Y-m-d");
								$password_text = $password;
								$post_date = date("Y-m-d H:i:s");
								$post_by = "admin";

								$user[] = [
											"user_id " => null,
											"username" => $username,
											"password" => $this->hash_password($password),
											"password_text" => $password_text,
											"email" => $exporter_email,
											"expoter_id" => null,
											"post_date" => $post_date,
											"post_by" => $post_by,
											"delete_date" => null,
											"delete_by" => null,
											"status" => 2
								];

								$exporter_user_submit = $this->Exporter_query->exporter_user_save($user);
								if($exporter_user_submit){
									$expoter_id = $this->User_query->get_id_user($exporter_email);
									$update_exporter_id = $this->User_query->update_exporter_id($expoter_id);
									if($update_exporter_id){
										$exporter[] = [
													"exporter_id " => $expoter_id,
													"exporter_name" => $exporter_name,
													"exporter_slug" => $exporter_slug,
													"exporter_logo" => $exporter_logo,
													"exporter_address" => $exporter_address,
													"exporter_phone" => $exporter_phone,
													"exporter_office_phone" => $exporter_office_phone,
													"exporter_fax" => $exporter_fax,
													"exporter_email" => $exporter_email,
													"exporter_link" => $exporter_link,
													"post_date" => $post_date,
													"post_by" => $post_by,
													"delete_date" => null,
													"delete_by" => null,
													"status" => $status
										];
										$exporter_submit = $this->Exporter_query->exporter_save($exporter);

										if($exporter_submit){
											$is_save = true;
											$this->session->set_flashdata('success', "exporter data has been saved");
											//redirect("Admin/Exporter_detail/".$expoter_id);
											redirect("Admin/Expoter_management");

										}else{
											$is_save = false;
										  $this->session->set_flashdata('exporter', "user data failed to save");
										}


									}else{
										$is_save = false;
										$this->session->set_flashdata('error', "user id not found");
									}
								}else{
									$is_save = false;
									$this->session->set_flashdata('error', "user data failed to save");
								}

						}else{
							$is_save = false;
						}

						if($is_save == false){
								redirect("Admin/Exporter_add");
						}
			}
	}

	public function Exporter_detail($exporter_id){

		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
		 	redirect("Admin/Logout");
			}else{
			//$this->load->model('admin/invoice/Invoice_admin','Invoice_admin', true);
			//$this->data['data'] = $this->Invoice_admin->list_invoice();
			//$this->data
			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);
			$this->data['data'] = $this->Exporter_query->exporter_detail($exporter_id);

			$this->master["custume_css"] = $this->load->view('admin/exporter_detail/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/exporter_detail/custume_js.php', [], TRUE);
			$this->master["content"] = $this->load->view("admin/exporter_detail/content.php",$this->data, TRUE);
			$this->render();
			}
	}

	public function Update_user_expoter()
	{
		$this->load->model('API/User/User_query','User_query', true);
		$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);

		$this->form_validation->set_rules('user_id', 'user_id', 'trim|required|numeric');
		$this->form_validation->set_rules('username', 'username', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'trim|min_length[3]');

		if($this->form_validation->run() == TRUE)
		{
			$is_save = true;
			$user_id = $this->input->post('user_id');
			$username = $this->input->post('username');
			$email = $this->input->post('email');
			$password = $this->input->post('password');
			$password_text = $password;

			if($password == "" || $password == NULL){
				$curr_password = $this->Exporter_query->curr_user_password($user_id);
				$password = $curr_password;
				$password_text = $password;
			}

			$update = [
						"user_id" => $user_id,
						"username" => $username,
						"password" => $this->hash_password($password),
						"password_text" => $password_text,
						"email" => $email
			];
			$update_user = $this->Exporter_query->update_user($update);

			if($update_user){
					$is_save = true;
					$this->session->set_flashdata('success', "user data has been update");
			}else{
					$is_save = false;
					$this->session->set_flashdata('error', "user data failed update");
			}

		}else{
			$is_save = false;
			$this->session->set_flashdata('error', "make sure the form is filled in correctly");
		}
		redirect("Admin/Exporter_detail/".$user_id);

	}


	public function Update_expoter(){
		$this->load->model('API/User/User_query','User_query', true);
		$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);

		$this->form_validation->set_rules('exporter_id', 'exporter_id', 'trim|required|numeric');
		$this->form_validation->set_rules('exporter_name', 'exporter_name', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('exporter_address', 'exporter_address', 'trim|required|min_length[3]');
		$this->form_validation->set_rules('exporter_office_phone', 'exporter_office_phone', 'trim');
		$this->form_validation->set_rules('exporter_link', 'exporter_link', 'trim');
		$this->form_validation->set_rules('exporter_email', 'exporter_email', 'trim|required|valid_email');
		$this->form_validation->set_rules('exporter_phone', 'exporter_phone', 'trim');
		$this->form_validation->set_rules('exporter_fax', 'exporter_fax', 'trim');

		if($this->form_validation->run() == TRUE)
		{
				$is_save = true;
				$exporter_id = $this->input->post('exporter_id');
				$exporter_name = $this->input->post('exporter_name');
				$exporter_address = $this->input->post('exporter_address');
				$exporter_office_phone = $this->input->post('exporter_office_phone');
				$exporter_link = $this->input->post('exporter_link');
				$exporter_email = $this->input->post('exporter_email');
				$exporter_phone = $this->input->post('exporter_phone');
				$exporter_fax = $this->input->post('exporter_fax');

				if($_FILES['logo']['error'] === 0) {
					$upload_config['upload_path'] = 'assets/' . $this->config->item('exporter_logo_path');
					$upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
					$upload_config['max_height'] = 500;
					$upload_config['max_width'] = 500;
					$upload_config['file_name'] = $exporter_slug."-".date_timestamp_get($date);
					$this->upload->initialize($upload_config);
					if($this->upload->do_upload('logo')) {
						$exporter_logo = $this->upload->data('file_name');
						$is_save = true;
					}else {
						$this->session->set_flashdata('error', 'File thumbnail image: ' . $this->upload->display_errors('', ''));
						$is_save = false;
					}
				}else{
					$curr_logo = $this->Exporter_query->curr_logo($exporter_id);
					$exporter_logo = $curr_logo;
				}

				if($is_save){
					$lower_name = strtolower($exporter_name);
 				 	$exporter_slug = str_replace(" ","_",$lower_name);

					$update = [
								"exporter_id" => $exporter_id,
								"exporter_name" => $exporter_name,
								"exporter_slug" => $exporter_slug,
								"exporter_logo" => $exporter_logo,
								"exporter_address" => $exporter_address,
								"exporter_phone" => $exporter_phone,
								"exporter_office_phone" => $exporter_office_phone,
								"exporter_fax" => $exporter_fax,
								"exporter_email" => $exporter_email,
								"exporter_link" => $exporter_link
					];

					$update_exporter = $this->Exporter_query->update_exporter($update);

					if($update_exporter){
						$is_save = true;
						$this->session->set_flashdata('success', "expoter data has been update");
					}else{
						$is_save = false;
						$this->session->set_flashdata('error', "user data failed update");
					}

				}
		}else{
			$is_save = false;
			$this->session->set_flashdata('error', "make sure the form is filled in correctly");
		}

			redirect("Admin/Exporter_detail/".$exporter_id);

	}

	public function get_subcategory(){
			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);

			//$category_id = $this->input->get('category_id');
			$category_id = $this->input->get();
			$subcategory_list = $this->Exporter_query->subcategory_list($category_id);

			echo json_encode($subcategory_list);

	}

	public function get_list_expoter_categories(){
			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);

			//$category_id = $this->input->get('category_id');
			$expoter_id = $this->input->get();

			$expoter_categories = $this->Exporter_query->list_expoter_categories($expoter_id);

			echo json_encode($expoter_categories);

	}



	public function submit_expoter_category(){
		//$exporter_id = $this->input->get('exporter_id');
		//$category_id = $this->input->get('category_id');
		//$subcategory_id = $this->input->get('subcategory_id');

		//var_dump($exporter_id);
		//var_dump($category_id);
		//var_dump($subcategory_id);
		$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);

		$exporter_id = $this->input->get('exporter_id');
		$category_id = $this->input->get('category_id');
		$subcategory_id = $this->input->get('subcategory_id');
		$post_date = date("Y-m-d H:i:s");
		$post_by = $_SESSION['admin_id'];



			$expoter_category []= [
						"ex_cat_id " => null,
						"exporter_id" => $exporter_id,
						"category_id" => $category_id,
						"subcategory_id	" => $subcategory_id,
						"post_date" => $post_date,
						"post_by" => $post_by,
						"delete_date" => null,
						"delete_by" => null,
						"status" => 1
			];

			$expoter_categoryr_submit = $this->Exporter_query->exporter_category_save($expoter_category);
			echo json_encode($expoter_categoryr_submit);

	}

	public function delete_expoter_categories($ex_cat_id,$exporter_id){
		$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);

		$delete_date = date("Y-m-d H:i:s");
		$delete_by = $_SESSION['admin_id'];

		$update = [
					"delete_date" => $delete_date,
					"delete_by" => $delete_by,
					"status" => 2
		];
		$exporter_category_delete = $this->Exporter_query->exporter_category_delete($update,$ex_cat_id);

		if($exporter_category_delete){
				$this->session->set_flashdata('success', "exporter category data has been delete");
		}else{
				$this->session->set_flashdata('error', "exporter category failed delete");
		}

		redirect("Admin/Exporter_detail/".$exporter_id);

	}

	public function exporter_delete($exporter_id){

		$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);

		$delete_date = date("Y-m-d H:i:s");
		$delete_by = $_SESSION['admin_id'];

		$update = [
					"delete_date" => $delete_date,
					"delete_by" => $delete_by,
					"status" => 2
		];
		$exporter_category_delete = $this->Exporter_query->exporter_delete($update,$exporter_id);

		if($exporter_category_delete){
				$this->session->set_flashdata('success', "exporter category data has been delete");
		}else{
				$this->session->set_flashdata('error', "exporter category failed delete");
		}

		redirect("Admin/Expoter_management");

	}


	public function login()
 	{
		$this->session->sess_destroy();
 		$this->master["custume_css"] = NULL;
 		$this->master["custume_js"] = NULL;
 		$this->master["content"] = $this->load->view("admin/login/content.php",[], TRUE);
 		$this->render();
 	}

	public function Logout()
	{
		$this->session->sess_destroy();
		redirect("Admin");

	}

	public function Submit_login()
	{
		$this->load->model('Admin/Login','Login', true);

		$this->form_validation->set_rules('email', 'email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'trim|required|min_length[6]');

		if($this->form_validation->run() == TRUE)
		{

			$email = $this->input->post('email');
			$password = md5($this->input->post("password"));

					$data['admin'] = $this->Login->login_admin($email , $password);
					if($data['admin']){
					$newdata = array(
						'admin_id' => $data['admin'][0]['admin_id'],
						'admin_name' => $data['admin'][0]['admin_name'],
						'admin_role' => $data['admin'][0]['admin_role']
					);


					$this->session->set_userdata($newdata);
					$this->session->set_flashdata('success', "Berhasil login");
					//echo "masuk";

					$_SESSION['admin_id'];
					redirect("Admin");
					//$this->index();

						}else{
							$this->session->set_flashdata('error', "terjadi kesalahan database");
							redirect("Admin/login");
							//echo "terjadi kesalahan database";
						}
				}else{
						$this->session->set_flashdata('error', "username / password kosong");
						redirect("Admin/login");
							//echo "username / password kosong";

			}
	}

	public function featured_setting($exporter_home,$exporter_id){
		$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);
		if($exporter_home == 1){
			$exporter_home = 0;
		}else{
			$exporter_home = 1;
		}

		$update = [
					"exporter_home" => $exporter_home
		];

		$featured_setting_update = $this->Exporter_query->featured_setting_update($update,$exporter_id);

		if($featured_setting_update){
				$this->session->set_flashdata('success', "exporter Featured data has been update");
		}else{
				$this->session->set_flashdata('error', "exporter featured failed update");
		}

		redirect("Admin/Exporter_detail/".$exporter_id);

	}

	public function Exporter_subcategory(){

		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
		 	redirect("Admin/Logout");
			}else{
			//$this->load->model('admin/invoice/Invoice_admin','Invoice_admin', true);
			//$this->data['data'] = $this->Invoice_admin->list_invoice();
			//$this->data
			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);
			$this->data['data'] = $this->Exporter_query->exporter_category_list();

			$this->master["custume_css"] = $this->load->view('admin/exporter_subcategory/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/exporter_subcategory/custume_js.php', [], TRUE);
			$this->master["content"] = $this->load->view("admin/exporter_subcategory/content.php",$this->data, TRUE);
			$this->render();
			}
	}

	public function Exporter_category(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{
			//$this->load->model('admin/invoice/Invoice_admin','Invoice_admin', true);
			//$this->data['data'] = $this->Invoice_admin->list_invoice();
			//$this->data
			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);
			$this->data['data'] = $this->Exporter_query->exporter_category_list();

			$this->master["custume_css"] = $this->load->view('admin/exporter_category/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/exporter_category/custume_js.php', [], TRUE);
			$this->master["content"] = $this->load->view("admin/exporter_category/content.php",$this->data, TRUE);
			$this->render();
			}
	}
	public function Submit_subcategory(){
			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);
			$this->form_validation->set_rules('category_id', 'category_id', 'trim|required');
			$this->form_validation->set_rules('subcategory_title', 'subcategory_title', 'trim|required');

			if($this->form_validation->run() == TRUE)
			{
				$is_save = true;
				$category_id = $this->input->post('category_id');
				$subcategory_old_id = $this->input->post('subcategory_old_id');
				$subcategory_title = $this->input->post('subcategory_title');
				$is_draft = $this->input->post('is_draft');

				if($is_draft != null || $is_draft != ""){
					 $is_draft= 0;
				}else{
					 $is_draft = 1;
				}

				$subcategory_title = str_replace("''","`",$subcategory_title);

				$subcategory_slug = str_replace("&","and",$subcategory_title);
		 		$slug = str_replace(" ","_",$subcategory_slug);

				$post_date = date("Y-m-d H:i:s");

				if(empty($subcategory_old_id)){
					$subcategory_old_id = NULL;
				}

				$subcategory_order = $this->Exporter_query->get_last_order_subcategory();
				if(!$subcategory_order){
					$subcategory_order = 1;
				}

				$subcategory[] = [
							"subcategory_id" => null,
							"subcategory_old_id" => $subcategory_old_id,
							"category_id" => $category_id,
							"subcategory_title" => $subcategory_title,
							"subcategory_slug" => $slug,
							"subcategory_order" => $subcategory_order,
							"post_date" => $post_date,
							"post_by" => $_SESSION['admin_id'],
							"delete_date" => null,
							"delete_by" => null,
							"status" =>  $is_draft
				];

				$subcategory_submit = $this->Exporter_query->subcategory_save($subcategory);

				if($subcategory_submit){
					$is_save = true;
					$this->session->set_flashdata('success', "subcategory data has been saved");
				}else{
					$is_save = false;
					$this->session->set_flashdata('error', "subcategory data failed to save");
				}

			}else{
				$is_save = false;
				$this->session->set_flashdata('error', "make sure the form is filled in correctly");
			}
			redirect("Admin/Exporter_subcategory");
	}

	public function Submit_category(){
			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);
			$this->form_validation->set_rules('category_title', 'subcategory_title', 'trim|required');

			if($this->form_validation->run() == TRUE)
			{
				$is_save = true;
				$category_old_id = $this->input->post('category_old_id');
				$category_title = $this->input->post('category_title');
				$is_draft = $this->input->post('is_draft');

				if($is_draft != null || $is_draft != ""){
					 $is_draft= 0;
				}else{
					 $is_draft = 1;
				}

				$category_title = str_replace("''","`",$category_title);

				$category_slug = str_replace("&","and",$category_title);
		 		$slug = str_replace(" ","_",$category_slug);

				$post_date = date("Y-m-d H:i:s");

				if(empty($category_old_id)){
					$category_old_id = NULL;
				}

				$category_order = $this->Exporter_query->get_last_order_category();
				if(!$category_order){
					$category_order = 1;
				}

				$category[] = [
							"category_id" => null,
							"category_old_id" => $category_old_id,
							"category_title" => $category_title,
							"category_slug" => $slug,
							"category_order" => $category_order,
							"post_date" => $post_date,
							"post_by" => $_SESSION['admin_id'],
							"delete_date" => null,
							"delete_by" => null,
							"status" =>  $is_draft
				];

				$category_submit = $this->Exporter_query->category_save($category);

				if($category_submit){
					$is_save = true;
					$this->session->set_flashdata('success', "subcategory data has been saved");
				}else{
					$is_save = false;
					$this->session->set_flashdata('error', "subcategory data failed to save");
				}

			}else{
				$is_save = false;
				$this->session->set_flashdata('error', "make sure the form is filled in correctly");
			}
			redirect("Admin/Exporter_category");
	}

	public function Subcategory_list_data()
	{
			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);

			$postData = $this->input->get();

			//$exporter_list = $this->Exporter_query->get_list();

			$subcategory_list = $this->Exporter_query->getSubcategory($postData);

			echo json_encode($subcategory_list);

	}

	public function Category_list_data()
	{
			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);

			$postData = $this->input->get();

			//$exporter_list = $this->Exporter_query->get_list();

			$category_list = $this->Exporter_query->getCategory($postData);

			echo json_encode($category_list);

	}

	public function News_management(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{
			$this->master["custume_css"] = $this->load->view('admin/news_managment/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/news_managment/custume_js.php', [], TRUE);
			$this->master["content"] = $this->load->view("admin/news_managment/content.php",$this->data, TRUE);
			$this->render();
			}
	}

	public function News_category(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{
				$this->load->model('Admin/News/News_query','News_query', true);
				//$this->data['data'] = $this->News_query->news_category_list();
				$this->master["custume_css"] = $this->load->view('admin/news_category/custume_css.php', [], TRUE);
				$this->master["custume_js"] = $this->load->view('admin/news_category/custume_js.php', [], TRUE);
				$this->master["content"] = $this->load->view("admin/news_category/content.php",$this->data, TRUE);
				$this->render();
			}
	}

	public function News_list_data()
	{

			$this->load->model('Admin/News/News_query','News_query', true);

			$postData = $this->input->get();
			//$exporter_list = $this->Exporter_query->get_list();

			$news_list = $this->News_query->news_list($postData);

			echo json_encode($news_list);

	}

	public function News_add(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{

			$this->load->model('Admin/Langguage/langguage_query','langguage_query', true);
			$this->load->model('Admin/News/News_query','News_query', true);

			$this->data['data']['language_list'] = $this->langguage_query->language_list();
			$this->data['data']['tag_list'] = $this->News_query->tag_list();



			$this->master["custume_css"] = $this->load->view('admin/news_add/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/news_add/custume_js.php',$this->data, TRUE);
			$this->master["content"] = $this->load->view("admin/news_add/content.php",$this->data, TRUE);
			$this->render();
			}
	}


	public function Submit_news(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
		}else{
				$this->load->model('Admin/Langguage/langguage_query','langguage_query', true);
				$this->load->model('Admin/News/News_query','News_query', true);

				$this->form_validation->set_rules('published_at', 'published_at', 'trim|required');
				$this->form_validation->set_rules('tag_id', 'tag_id', 'trim|required');
				$this->form_validation->set_rules('title[bahasa]', 'title', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('content[bahasa]', 'content', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('is_draft', 'is_draft', 'trim');

				if($this->form_validation->run() == TRUE)
				{

					$is_save = true;
					$last_order = $this->News_query->get_last_order();

					if($last_order == 0){
						$news_order = 1;
					}else{
						$news_order = $last_order + 1;
					}


					$date = date_create();
					$update_date = date("Y-m-d H:i:s");
					$created_date = date("Y-m-d H:i:s");


					if($is_save == true){

						if($_FILES['thumbnail']['error'] === 0) {
							$upload_config['upload_path'] = 'assets/' . $this->config->item('news');
							$upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
							$upload_config['max_height'] = 500;
							$upload_config['max_width'] = 500;
							$upload_config['file_name'] = "news-thumbnail"."-".date_timestamp_get($date);
							$this->upload->initialize($upload_config);
							if($this->upload->do_upload('thumbnail')) {
								$news_thumbnail = $this->upload->data('file_name');
								$save_status = true;
							} else {
								$this->session->set_flashdata('error', 'File thumbnail: ' . $this->upload->display_errors('', ''));
								$save_status = false;
								echo $upload_config;
								die();
							}
						}else{
							$thumbnail_defalut = rand(1,3);
							$news_thumbnail = "thumbnail_news-".$thumbnail_defalut.".png";
							$save_status = true;
						}

					}else{
						$is_save = false;
					}


					if($is_save == true){
						if($_FILES['header']['error'] === 0) {
							$upload_config['upload_path'] = 'assets/' . $this->config->item('news');
							$upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
							$upload_config['max_height'] = 768;
							$upload_config['max_width'] = 1360;
							$upload_config['file_name'] = "news-header"."-".date_timestamp_get($date);
							$this->upload->initialize($upload_config);
							if($this->upload->do_upload('header')) {
								$news_header = $this->upload->data('file_name');
								$is_save = true;
							} else {
								$this->session->set_flashdata('error', 'File header: ' . $this->upload->display_errors('', ''));
								$is_save = false;
							}
						}else{
							$header_defalut = rand(1,3);
							$news_header = "header_news-".$header_defalut.".png";
							$is_save = true;
						}

					}else{
						$is_save = false;
					}

					if($is_save){
						$data['title'] = $this->input->post('title');

						$data['content'] = $this->input->post('content');
						$data['tag_id'] = $this->input->post('tag_id');
						$data['news_thumbnail_type'] = $this->input->post('news_thumbnail_type');

						$lower_name = strtolower($data['title']['english']);
						$lower_name	= preg_replace("/[^a-zA-Z0-9]/", "", $lower_name);
						$slug = str_replace(" ","_",$lower_name);

						$post_date = $this->input->post('published_at');
						$post_date = date('Y-m-d H:i:s', strtotime($post_date));

						$trans_key = "news_key"."-".date_timestamp_get($date);

						$data['is_active'] = $this->input->post('is_draft');

						if($data['is_active'] != null || $data['is_active'] != ""){
							$data['status'] = 2;
						}else{
							$data['status'] = 1;
						}

						$news[] = [
									"news_id" => null,
									"news_slug" => $slug,
									"news_order" => $news_order,
									"news_title" => $data['title']['english'],
									"tag_id" => $data['tag_id'],
									"news_thumbnail_type" => $data['news_thumbnail_type'],
									"news_thumbnail" => $news_thumbnail,
									"news_header" => $news_header,
									"news_youtube" => null,
									"news_content" => $data['content']['english'],
									"trans_key" => 	$trans_key,
									"post_date" => $post_date,
									"post_by" => $_SESSION['admin_id'],
									"delete_date" => null,
									"delete_by" => null,
									"status" => $data['status']
						];

						$short_translations[] = [
							"id" => null,
							"trans_key" => $trans_key,
							"english" => $data['title']['english'],
							"bahasa" => $data['title']['bahasa'],
							"spanyol" => $data['title']['spanyol'],
							"deleted_by" => null,
							"deleted_at" => null,
							"updated_by" => $_SESSION['admin_id'],
							"updated_at" => $update_date,
							"created_by" => $_SESSION['admin_id'],
							"created_at" => $created_date

						];

						$long_translations[] = [
							"id" => null,
							"trans_key" => $trans_key,
							"english" => $data['content']['english'],
							"bahasa" => $data['content']['bahasa'],
							"spanyol" => $data['content']['spanyol'],
							"deleted_by" => null,
							"deleted_at" => null,
							"updated_by" => $_SESSION['admin_id'],
							"updated_at" => $update_date,
							"created_by" => $_SESSION['admin_id'],
							"created_at" => $created_date
						];

						$submit_news = $this->News_query->add_news($news);
						$submit_short_translations = $this->langguage_query->add_short_translations($short_translations);
						$submit_long_translations = $this->langguage_query->add_long_translations($long_translations);

						if($submit_news && $submit_short_translations && $submit_long_translations){
							$is_save = true;
							$this->session->set_flashdata('success', "news data has been saved");
						}else{
							$is_save = false;
							$this->session->set_flashdata('success', "news data has been saved");
						}

					}else{
						$this->session->set_flashdata('error', "image news failed to upload");
					}

				}else{
					$is_save = false;
					$this->session->set_flashdata('error', "make sure the form is filled in correctly");
				}
				redirect("Admin/News_management");
		}
	}

	public function Update_news(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
		}else{
				$this->load->model('Admin/Langguage/langguage_query','langguage_query', true);
				$this->load->model('Admin/News/News_query','News_query', true);
				$this->form_validation->set_rules('news_id', 'news_id', 'trim|required');
				$this->form_validation->set_rules('trans_key', 'trans_key', 'trim|required');
				$this->form_validation->set_rules('tag_id', 'tag_id', 'trim|required');
				$this->form_validation->set_rules('title[bahasa]', 'title', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('content[bahasa]', 'content', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('is_draft', 'is_draft', 'trim');

				if($this->form_validation->run() == TRUE)
				{

					$is_save = true;

					$news_id = $this->input->post('news_id');
					$trans_key = $this->input->post('trans_key');
					$detail_news_id = $news_id;


					$date = date_create();
					$update_date = date("Y-m-d H:i:s");
					$created_date = date("Y-m-d H:i:s");


					if($is_save == true){

						if($_FILES['thumbnail']['error'] === 0) {
							$upload_config['upload_path'] = 'assets/' . $this->config->item('news');
							$upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
							$upload_config['max_height'] = 500;
							$upload_config['max_width'] = 500;
							$upload_config['file_name'] = "news-thumbnail"."-".date_timestamp_get($date);
							$this->upload->initialize($upload_config);
							if($this->upload->do_upload('thumbnail')) {
								$news_thumbnail = $this->upload->data('file_name');
								$save_status = true;
							} else {
								$this->session->set_flashdata('error', 'File thumbnail: ' . $this->upload->display_errors('', ''));
								$save_status = false;
								echo $upload_config;
								die();
							}
						}else{
								$news_thumbnail = $this->News_query->get_news_thumbnail($news_id);
						}

					}else{
						$is_save = false;
					}


					if($is_save == true){
						if($_FILES['header']['error'] === 0) {
							$upload_config['upload_path'] = 'assets/' . $this->config->item('news');
							$upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
							$upload_config['max_height'] = 768;
							$upload_config['max_width'] = 1360;
							$upload_config['file_name'] = "news-header"."-".date_timestamp_get($date);
							$this->upload->initialize($upload_config);
							if($this->upload->do_upload('header')) {
								$news_header = $this->upload->data('file_name');
								$is_save = true;
							} else {
								$this->session->set_flashdata('error', 'File header: ' . $this->upload->display_errors('', ''));
								$is_save = false;
							}
						}else{
								$news_header = $this->News_query->get_news_header($news_id);
						}

					}else{
						$is_save = false;
					}

					if($is_save){
						$data['title'] = $this->input->post('title');

						$data['content'] = $this->input->post('content');
						$data['tag_id'] = $this->input->post('tag_id');
						$data['news_thumbnail_type'] = $this->input->post('news_thumbnail_type');

						$lower_name = strtolower($data['title']['english']);
						$lower_name	= preg_replace("/[^a-zA-Z0-9]/", "", $lower_name);
						$slug = str_replace(" ","_",$lower_name);

						$post_date = $this->input->post('published_at');
						$post_date = date('Y-m-d H:i:s', strtotime($post_date));


						$data['is_active'] = $this->input->post('is_draft');

						if($data['is_active'] != null || $data['is_active'] != ""){
							$data['status'] = 2;
						}else{
							$data['status'] = 1;
						}

						$news = [
									"news_id" => $news_id,
									"news_slug" => $slug,
									"news_title" => $data['title']['english'],
									"tag_id" => $data['tag_id'],
									"news_thumbnail_type" => $data['news_thumbnail_type'],
									"news_thumbnail" => $news_thumbnail,
									"news_header" => $news_header,
									"news_youtube" => null,
									"news_content" => $data['content']['english'],
									"status" => $data['status']
						];

						$short_translations = [
							"trans_key" => $trans_key,
							"english" => $data['title']['english'],
							"bahasa" => $data['title']['bahasa'],
							"spanyol" => $data['title']['spanyol'],
							"updated_by" => $_SESSION['admin_id'],
							"updated_at" => $update_date
						];

						$long_translations = [
							"trans_key" => $trans_key,
							"english" => $data['content']['english'],
							"bahasa" => $data['content']['bahasa'],
							"spanyol" => $data['content']['spanyol'],
							"updated_by" => $_SESSION['admin_id'],
							"updated_at" => $update_date
						];

						$update_news = $this->News_query->update_news($news);
						$update_short_translations = $this->langguage_query->update_short_translations($short_translations);
						$update_long_translations = $this->langguage_query->update_long_translations($long_translations);

						if($update_news && $update_short_translations && $update_long_translations){
							$is_save = true;
							$this->session->set_flashdata('success', "news data has been update");
						}else{
							$is_save = false;
							$this->session->set_flashdata('error', "news data failed update");
						}

					}else{
						$this->session->set_flashdata('error', "image news failed to upload");
					}

				}else{
					$is_save = false;
					$this->session->set_flashdata('error', "make sure the form is filled in correctly");

				}
				//echo validation_errors();
				redirect("Admin/detail_news/".$detail_news_id);
		}
	}

	public function Submit_news_category(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
		}else{
			$this->load->model('Admin/News/News_query','News_query', true);

			$this->form_validation->set_rules('tag_title', 'tag_title', 'trim|required');
			$this->form_validation->set_rules('is_draft', 'is_draft', 'trim');

			if($this->form_validation->run() == TRUE)
			{
					$is_save = true;
					$last_order = $this->News_query->get_last_tag_order();

					if($last_order == 0){
						$tag_order = 1;
					}else{
						$tag_order = $last_order + 1;
					}


					$date = date_create();
					$post_date = date("Y-m-d H:i:s");

					if($is_save){

						$tag_title = $this->input->post('tag_title');

						$lower_name = strtolower($data['title']['english']);
						$lower_name	= preg_replace("/[^a-zA-Z0-9]/", "", $lower_name);
						$slug = str_replace(" ","_",$lower_name);

						$data['is_active'] = $this->input->post('is_draft');

						if($data['is_active'] != null || $data['is_active'] != ""){
							$data['status'] = 2;
						}else{
							$data['status'] = 1;
						}

						$tag[] = [
									"tag_id" => null,
									"tag_title" => $tag_title,
									"tag_slug" => $slug,
									"tag_order" => $tag_order,
									"post_date" => $post_date,
									"post_by" => $_SESSION['admin_id'],
									"delete_date" => null,
									"delete_by" => null,
									"status" => $data['status']
						];

						$submit_tag = $this->News_query->add_tag($tag);

						if($submit_tag){
							$is_save = true;
							$this->session->set_flashdata('success', "category news data has been saved");
						}else{
							$is_save = false;
							$this->session->set_flashdata('error', "category news failed saved");
						}
					}else{
						$is_save = false;
						$this->session->set_flashdata('error', "an error occurs contact the developer");
					}
			}else{
				$is_save = false;
				$this->session->set_flashdata('error', "make sure the form is filled in correctly");
			}
		}
		redirect("Admin/News_category");
	}

	public function delete_news($news_id){
			$this->load->model('Admin/News/News_query','News_query', true);

			$delete_date = date("Y-m-d H:i:s");
			$delete_by = $_SESSION['admin_id'];
			$status = 3;

			$news = [
						"news_id" => $news_id,
						"delete_date" => $delete_date,
						"delete_by" => $delete_by,
						"status" => $status
			];

			$delete_news = $this->News_query->delete_news($news);

			if($delete_news){
				$is_save = true;
				$this->session->set_flashdata('success', "news has been delete");
			}else{
				$is_save = false;
				$this->session->set_flashdata('error', "news failed to delete");
			}

			redirect("Admin/News_management");
	}


	public function detail_news($news_id){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{

			$this->load->model('Admin/Langguage/langguage_query','langguage_query', true);
			$this->load->model('Admin/News/News_query','News_query', true);

			$this->data['data']['language_list'] = $this->langguage_query->language_list();
			$this->data['data']['tag_list'] = $this->News_query->tag_list();
			$this->data['data']['detail_news'] = $this->News_query->detail_news($news_id);
			//var_dump($this->data['data']['detail_news']);


			$this->master["custume_css"] = $this->load->view('admin/news_detail/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/news_detail/custume_js.php',$this->data, TRUE);
			$this->master["content"] = $this->load->view("admin/news_detail/content.php",$this->data, TRUE);
			$this->render();
			}
	}


	public function Inquiry_management(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{
			$this->master["custume_css"] = $this->load->view('admin/inquery_managment/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/inquery_managment/custume_js.php', [], TRUE);
			$this->master["content"] = $this->load->view("admin/inquery_managment/content.php",$this->data, TRUE);
			$this->render();
			}
	}



	public function Inquiry_list_data()
	{
			$this->load->model('Admin/Inquery/Inquery_query','Inquery_query', true);
			$postData = $this->input->get();
			//$exporter_list = $this->Exporter_query->get_list();
			$Inquery_list = $this->Inquery_query->Inquery_list($postData);
			echo json_encode($Inquery_list);
	}

	public function Tag_list_data()
	{
			$this->load->model('Admin/News/News_query','News_query', true);
			$postData = $this->input->get();
			$Tag_list = $this->News_query->tag_list_data($postData);
			echo json_encode($Tag_list);
	}

	public function Inquiry_detail($inquiry_id){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{

			$this->load->model('Admin/Inquery/Inquery_query','Inquery_query', true);
			$this->load->model('Admin/Importer/Importer_query','Importer_query', true);


			$this->data['data'] = $this->Inquery_query->Inquery_detail($inquiry_id);
			$this->data['data']['importer'] = $this->Importer_query->importer_category_list();
			$this->data['data']['list_inbox'] = $this->Inquery_query->Inquery_inbox($inquiry_id);
			$this->data['data']['progress'] = $this->Inquery_query->Inquery_progress($inquiry_id);
			//var_dump($this->data['data']['detail_news']);


			$this->master["custume_css"] = $this->load->view('admin/inquiry_detail/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/inquiry_detail/custume_js.php',$this->data, TRUE);
			$this->master["content"] = $this->load->view("admin/inquiry_detail/content.php",$this->data, TRUE);
			$this->render();
			}
	}

	public function Get_inbox_list(){
			$this->load->model('Admin/Inquery/Inquery_query','Inquery_query', true);
			$inquiry_id = $this->input->get();
			$inbox_list = $this->Inquery_query->Inbox_list($inquiry_id);
			echo json_encode($inbox_list);
	}

	public function Submit_inbox_data(){
		$this->load->model('Admin/Inquery/Inquery_query','Inquery_query', true);
		$inbox_content = $this->input->get('inbox_content');
		$exporter_id = $this->input->get('exporter_id');
		$inquiry_id = $this->input->get('inquiry_id');
		$post_date = date("Y-m-d H:i:s");
		$post_by = $_SESSION['admin_id'];



			$inbox []= [
						"inbox_id " => null,
						"inbox_content" => $inbox_content,
						"inbox_read" => 0,
						"inquiry_id" => $inquiry_id,
						"exporter_id" => $exporter_id,
						"post_date" => $post_date,
						"post_by" => $post_by,
						"update_date" => $post_date,
						"update_by" => $post_by,
						"delete_date" => null,
						"delete_by" => null,
						"status" => 1
			];

			$inbox_submit = $this->Inquery_query->Inbox_submit($inbox);
			echo json_encode($inbox_submit);

	}

	public function get_importer_list(){
			$this->load->model('Admin/Importer/Importer_query','Importer_query', true);

			//$category_id = $this->input->get('category_id');
			$category_id = $this->input->get();
			$subcategory_list = $this->Importer_query->get_importer_inquery_list($category_id);

			echo json_encode($subcategory_list);
	}

	public function get_list_importer_inquiry(){
			$this->load->model('Admin/Importer/Importer_query','Importer_query', true);
			$inquiry_id = $this->input->get();
			$impoter_list = $this->Importer_query->list_importer_inquiry_list($inquiry_id);
			echo json_encode($impoter_list);
	}

	public function update_approved_inquiry($approved,$inquiry_id){
			$this->load->model('Admin/Inquery/Inquery_query','Inquery_query', true);


			$update_date = date("Y-m-d H:i:s");
			$update_by = $_SESSION['admin_id'];
			if($approved == "approved"){
					$progress = 50;
			}else{
					$progress = 0;
			}


			$update = [
						"inquiry_id" => $inquiry_id,
						"progress" => $progress,
						"approved" => $approved,
						"update_date" => $update_date,
						"update_by" => $update_by
			];

			$update_inquiry = $this->Inquery_query->update_approved($update);
			if($update_inquiry){
				$this->session->set_flashdata('success', "inquiry has been update");
				redirect("Admin/Inquiry_detail/".$inquiry_id);
			}else{
				$this->session->set_flashdata('error', "inquiry failed to update");
				redirect("Admin/Inquiry_detail/".$inquiry_id);
			}
	}


	public function submit_inquery_importer_list(){
		$this->load->model('Admin/Inquery/Inquery_query','Inquery_query', true);
		$exporter_id = $this->input->get('exporter_id');
		$inquiry_id = $this->input->get('inquiry_id');
		$product_id = $this->input->get('category_id');
		$importer_id = $this->input->get('subcategory_id');
		$post_date = date("Y-m-d H:i:s");
		$post_by = $_SESSION['admin_id'];



			$inquiry_importer_list []= [
						"importer_inquiry_id" => null,
						"inquiry_id" => $inquiry_id,
						"importer_id" => $importer_id,
						"product_id" => $product_id,
						"exporter_id" => $exporter_id,
						"post_date" => $post_date,
						"post_by" => $post_by,
						"update_date" => $post_date,
						"update_by" => $post_by,
						"delete_date" => null,
						"delete_by" => null,
						"status" => 1
			];

			$inquery_importer_list_ = $this->Inquery_query->inquery_importer_list_save($inquiry_importer_list);
			echo json_encode($inquery_importer_list);

	}

	public function delete_importer_inquiry($inquiry,$importer_inquiry_id){
		$this->load->model('Admin/Inquery/Inquery_query','Inquery_query', true);

		$inquiry = $inquiry;
		$importer_inquiry_id = $importer_inquiry_id;
		$delete_date = date("Y-m-d H:i:s");
		$delete_by = $_SESSION['admin_id'];

		$delete = [
			"importer_inquiry_id " => $importer_inquiry_id,
			"delete_date" => $delete_date,
			"delete_by" => $delete_by,
			"status" => 2
		];

		$importer_inquiry_delete = $this->Inquery_query->inquiry_importer_delete($delete,$importer_inquiry_id);

		if($importer_inquiry_delete){
			$this->session->set_flashdata('success', "Importer list has been delete");
		}else{
			$this->session->set_flashdata('error', "Importer list failed delete");
		}
			redirect("Admin/Inquiry_detail/".$inquiry);

	}

	/*public function News_add(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{

			$this->load->model('Admin/Langguage/langguage_query','langguage_query', true);
			$this->load->model('Admin/News/News_query','News_query', true);

			$this->data['data']['language_list'] = $this->langguage_query->language_list();
			$this->data['data']['tag_list'] = $this->News_query->tag_list();



			$this->master["custume_css"] = $this->load->view('admin/news_add/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/news_add/custume_js.php',$this->data, TRUE);
			$this->master["content"] = $this->load->view("admin/news_add/content.php",$this->data, TRUE);
			$this->render();
			}
	}*/

	public function About_managment(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{

			$this->load->model('Admin/Langguage/langguage_query','langguage_query', true);
			$this->load->model('Admin/About/About_query','About_query', true);

			$this->data['data']['language_list'] = $this->langguage_query->language_list();
			$this->data['data']['about_header'] = $this->About_query->about_header();
			$this->data['data']['about_detail'] = $this->About_query->about_detail();


			$this->master["custume_css"] = $this->load->view('admin/about/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/about/custume_js.php',$this->data, TRUE);
			$this->master["content"] = $this->load->view("admin/about/content.php",$this->data, TRUE);
			$this->render();
			}
	}

	public function Contact_managment(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{

			$this->load->model('Admin/Langguage/langguage_query','langguage_query', true);
			$this->load->model('Admin/Contact/Contact_query','Contact_query', true);

			$this->data['data']['language_list'] = $this->langguage_query->language_list();
			$this->data['data']['contact'] = $this->Contact_query->contact();



			$this->master["custume_css"] = $this->load->view('admin/contact/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/contact/custume_js.php',$this->data, TRUE);
			$this->master["content"] = $this->load->view("admin/contact/content.php",$this->data, TRUE);
			$this->render();
			}
	}

	public function Indonesia_product_managment(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{

			$this->load->model('Admin/Langguage/langguage_query','langguage_query', true);
			$this->load->model('Admin/Contact/Contact_query','Contact_query', true);
			$this->data['data']['language_list'] = $this->langguage_query->language_list();
			$this->data['data']['contact'] = $this->Contact_query->contact();

			$this->master["custume_css"] = $this->load->view('admin/indonesia_product_management/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/indonesia_product_management/custume_js.php',$this->data, TRUE);
			$this->master["content"] = $this->load->view("admin/indonesia_product_management/content.php",$this->data, TRUE);
			$this->render();
			}
	}

	public function Submit_indonesia_product(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{
				$is_save = true;
				$this->load->model('Admin/Langguage/langguage_query','langguage_query', true);
				$this->load->model('Admin/Indonesia_product/Indonesia_product_query','Indonesia_product_query', true);
				$this->form_validation->set_rules('title', 'title', 'trim|required|min_length[3]');
				$this->form_validation->set_rules('is_draft', 'is_draft', 'trim');
				$date = date_create();
				$update_date = date("Y-m-d H:i:s");
				$created_date = date("Y-m-d H:i:s");
				if($is_save == true){
					if($_FILES['thumbnail']['error'] === 0) {
						$upload_config['upload_path'] = 'assets/' . $this->config->item('indonesia_product');
						$upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
						$upload_config['max_height'] = 300;
						$upload_config['max_width'] = 500;
						$upload_config['file_name'] = "product-thumbnail"."-".date_timestamp_get($date);
						$this->upload->initialize($upload_config);
						if($this->upload->do_upload('thumbnail')) {
							echo $product_thumbnail = $this->upload->data('file_name');
							//$is_save = true;
							//die();
						} else {
							$this->session->set_flashdata('error', 'File header: ' . $this->upload->display_errors('', ''));
							$is_save = false;
							echo "thumbnail tidak terupload";
							die();
						}
					}else{
						$thumbnail_defalut = rand(1,3);
						$product_thumbnail = "product-thumbnail-".$thumbnail_defalut.".png";
						$is_save = true;
						echo "thumbnail tidak terupload";
						die();
					}
				}


				if($is_save == true){
					if($_FILES['pdf']['error'] === 0) {
						$upload_config['upload_path'] = 'assets/' . $this->config->item('indonesia_product');
						$upload_config['allowed_types'] = 'pdf';
						$upload_config['file_name'] = "product-doc"."-".date_timestamp_get($date);
						$this->upload->initialize($upload_config);
						if($this->upload->do_upload('pdf')) {
							$product_doc = $this->upload->data('file_name');
							$is_save = true;
						} else {
							$this->session->set_flashdata('error', 'File header: ' . $this->upload->display_errors('', ''));
							$is_save = false;
						}
					}else{
						$is_save = false;
					}
				}

				if($is_save == true){
					$data['title'] = $this->input->post('title');
					$data['is_active'] = $this->input->post('is_draft');

					if($data['is_active'] != null || $data['is_active'] != ""){
						$data['status'] = 2;
					}else{
						$data['status'] = 1;
					}

						$last_id = $this->Indonesia_product_query->get_last_product();
						$product[] = [
									"indo_product_id" => null,
									"indo_product_title" => $data['title'],
									"indo_product_thumbnail" => $product_thumbnail,
									"indo_product_file" => $product_doc,
									"indo_product_order" => $last_id,
									"post_date" => 	$created_date ,
									"post_by" => $_SESSION['admin_id'],
									"delete_date" => null,
									"delete_by" => null,
									"status" => $data['status']
						];

					$submit_product = $this->Indonesia_product_query->add_product($product);

					if($submit_product){
						$this->session->set_flashdata('success', "Indonesia product submit success");
					}else{
						$this->session->set_flashdata('error', "Indonesia product submit failed ");
					}
				}else{
					$this->session->set_flashdata('error', "an error occurred in the system");
				}
		}
		redirect("Admin/Indonesia_product_managment");
	}

	public function get_indonesia_product(){
			$this->load->model('Admin/Indonesia_product/Indonesia_product_query','Indonesia_product_query', true);
			$postData = $this->input->get();

			$product_list = $this->Indonesia_product_query->getProduct($postData);

			echo json_encode($product_list);
	}

	public function Useful_link_managment(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{
			$this->load->model('Admin/Useful/Useful_query','Useful_query', true);
			$this->data['data'] = $this->Useful_query->useful_list();

			$this->master["custume_css"] = $this->load->view('admin/useful_link_management/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/useful_link_management/custume_js.php',$this->data, TRUE);
			$this->master["content"] = $this->load->view("admin/useful_link_management/content.php",$this->data, TRUE);
			$this->render();
			}
	}


	public function Submit_useful(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{
					$is_save = true;
					$this->load->model('Admin/Useful/Useful_query','Useful_query', true);

					$this->form_validation->set_rules('userful_title', 'userful_title', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('useful_link', 'useful_link', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('is_draft', 'is_draft', 'trim');


					$date = date_create();
					$update_date = date("Y-m-d H:i:s");
					$created_date = date("Y-m-d H:i:s");

					if($is_save == true){
						if($_FILES['logo']['error'] === 0) {
							$upload_config['upload_path'] = 'assets/' . $this->config->item('useful_link');
							$upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
							$upload_config['max_height'] = 300;
							$upload_config['max_width'] = 500;
							$upload_config['file_name'] = "userful-logo"."-".date_timestamp_get($date);
							$this->upload->initialize($upload_config);
							if($this->upload->do_upload('logo')) {
								echo $logo = $this->upload->data('file_name');
								//$is_save = true;
								//die();
							} else {
								$this->session->set_flashdata('error', 'File header: ' . $this->upload->display_errors('', ''));
								$is_save = false;

							}
						}else{
								$this->session->set_flashdata('error', 'File header: ' . $this->upload->display_errors('', ''));
								$is_save = false;
						}
					}

					if($is_save == true){

						$data['userful_title'] = $this->input->post('userful_title');
						$data['useful_link'] = $this->input->post('useful_link');
						$data['status'] = $this->input->post('status');

						$Useful[] = [
									"useful_id" => null,
									"userful_title" => $data['userful_title'],
									"useful_logo" => $logo,
									"useful_link" => $useful_link,
									"post_date" => 	$created_date ,
									"post_by" => $_SESSION['admin_id'],
									"delete_date" => null,
									"delete_by" => null,
									"status" => $data['status']
						];

						$submit_useful = $this->Useful_query->submit($Useful);

					}
			}
	}

	public function Update_about(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{
					$this->form_validation->set_rules('title_english', 'title_english', 'trim|required');
					$this->form_validation->set_rules('content_english', 'content_english', 'trim|required');
					$this->form_validation->set_rules('vision_english', 'vision_english', 'trim|required');
					$this->form_validation->set_rules('mission_english', 'mission_english', 'trim|required');

					$this->form_validation->set_rules('title_bahasa', 'title_bahasa', 'trim|required');
					$this->form_validation->set_rules('content_bahasa', 'content_bahasa', 'trim|required');
					$this->form_validation->set_rules('vision_bahasa', 'vision_bahasa', 'trim|required');
					$this->form_validation->set_rules('mission_bahasa', 'mission_bahasa', 'trim|required');

					$this->form_validation->set_rules('title_spanyol', 'title_spanyol', 'trim|required');
					$this->form_validation->set_rules('content_spanyol', 'content_spanyol', 'trim|required');
					$this->form_validation->set_rules('vision_spanyol', 'vision_spanyol', 'trim|required');
					$this->form_validation->set_rules('mission_spanyol', 'mission_spanyol', 'trim|required');

					if($this->form_validation->run() == TRUE)
					{
							$title_english = $this->input->post('title_english');
							$content_english = $this->input->post('content_english');
							$vision_english = $this->input->post('vision_english');
							$mission_english = $this->input->post('mission_english');

							$title_bahasa = $this->input->post('title_bahasa');
							$content_bahasa = $this->input->post('content_bahasa');
							$vision_bahasa = $this->input->post('vision_bahasa');
							$mission_bahasa = $this->input->post('mission_bahasa');

							$title_spanyol = $this->input->post('title_spanyol');
							$content_spanyol = $this->input->post('content_spanyol');
							$vision_spanyol = $this->input->post('vision_spanyol');
							$mission_spanyol = $this->input->post('mission_spanyol');


							$about[] = [
								'title_english' => $title_english,
								'content_english' => $content_english,
								'vision_english' => $vision_english,
								'mission_english' => $mission_english,

							];

					}else{

					}


			}
	}

	public function Importer_management()
	{
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
		 	redirect("Admin/Logout");
			}else{
			$this->load->model('Admin/Importer/Importer_query','Importer_query', true);
			$this->data['data'] = $this->Importer_query->Importer_product_list();
			//$this->load->model('admin/invoice/Invoice_admin','Invoice_admin', true);
			//$this->data['data'] = $this->Invoice_admin->list_invoice();
			//$this->data
			$this->master["custume_css"] = $this->load->view('admin/importer_managment/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/importer_managment/custume_js.php', [], TRUE);
			$this->master["content"] = $this->load->view("admin/importer_managment/content.php",$this->data, TRUE);
			$this->render();
			}
	}

	public function Importer_list_data()
	{
			$this->load->model('Admin/Importer/Importer_query','Importer_query', true);

			$postData = $this->input->get();

			//$exporter_list = $this->Exporter_query->get_list();

			$importer_list = $this->Importer_query->getImporter($postData);

			echo json_encode($importer_list);

	}

	public function importer_category_filter_data(){
		$this->load->model('Admin/Importer/Importer_query','Importer_query', true);

		$postData = $this->input->get();
		$importer_filter = $this->Importer_query->getImporter_filter($postData);
		echo json_encode($importer_filter);
	}

	public function Slider_management(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{

			$this->load->model('Admin/Langguage/langguage_query','langguage_query', true);
			$this->load->model('Admin/Slider/Slider_query','Slider_query', true);
			$this->data['data']['language_list'] = $this->langguage_query->language_list();
			$this->data['data']['slider'] = $this->Slider_query->Slider_list();

			$this->master["custume_css"] = $this->load->view('admin/slider_management/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/slider_management/custume_js.php',$this->data, TRUE);
			$this->master["content"] = $this->load->view("admin/slider_management/content.php",$this->data, TRUE);
			$this->render();
			}
	}

	public function Submit_slider(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{
					$is_save = true;
					$this->load->model('Admin/Slider/Slider_query','Slider_query', true);
					$this->load->model('Admin/Langguage/langguage_query','langguage_query', true);

					$this->form_validation->set_rules('title[english]', 'title', 'trim|required|min_length[3]');
					$this->form_validation->set_rules('description[english]', 'description', 'trim');
					$this->form_validation->set_rules('is_draft', 'is_draft', 'trim');

					if($this->form_validation->run() == TRUE)
					{

					$date = date_create();
					$update_date = date("Y-m-d H:i:s");
					$created_date = date("Y-m-d H:i:s");
					$trans_key = "slider_key"."-".date_timestamp_get($date);

					if($is_save == true){
						if($_FILES['file_patch']['error'] === 0) {
							$upload_config['upload_path'] = 'assets/' . $this->config->item('slider');
							$upload_config['allowed_types'] = 'jpg|jpeg|png|svg';
							$upload_config['max_height'] = 671;
							$upload_config['max_width'] = 1268;
							$upload_config['file_name'] = "slider"."-".date_timestamp_get($date);
							$this->upload->initialize($upload_config);
							if($this->upload->do_upload('file_patch')) {
								$file_patch = $this->upload->data('file_name');
								$is_save = true;
								//die();
							} else {
								$this->session->set_flashdata('error', 'File header: ' . $this->upload->display_errors('', ''));
								$is_save = false;

							}
						}else{
								$this->session->set_flashdata('error', 'File header: ' . $this->upload->display_errors('', ''));
								$is_save = false;
						}
					}

					if($is_save == true){

						$data['title'] = $this->input->post('title');
						$data['description'] = $this->input->post('description');
						$data['link'] = $this->input->post('link');
						if(empty($data['link'])){
							$data['link'] = null;
						}
						$data['status'] = $this->input->post('is_draft');
						if(!empty($data['status'])){
								$data['status'] = 0;
						}else{
								$data['status'] = 1;
						}

						$slider[] = [
									"slider_id" => null,
									"file_patch" => $file_patch,
									"trans_key" => $trans_key,
									"link" => $data['link'],
									"post_date" => 	$created_date ,
									"post_by" => $_SESSION['admin_id'],
									"update_date" => 	$created_date ,
									"update_by" => $_SESSION['admin_id'],
									"delete_date" => null,
									"delete_by" => null,
									"status" => $data['status']
						];

						$short_translations[] = [
							"id" => null,
							"trans_key" => $trans_key,
							"english" => $data['title']['english'],
							"bahasa" => $data['title']['bahasa'],
							"spanyol" => $data['title']['spanyol'],
							"deleted_by" => null,
							"deleted_at" => null,
							"updated_by" => $_SESSION['admin_id'],
							"updated_at" => $update_date,
							"created_by" => $_SESSION['admin_id'],
							"created_at" => $created_date

						];

						$long_translations[] = [
							"id" => null,
							"trans_key" => $trans_key,
							"english" => $data['description']['english'],
							"bahasa" => $data['description']['bahasa'],
							"spanyol" => $data['description']['spanyol'],
							"deleted_by" => null,
							"deleted_at" => null,
							"updated_by" => $_SESSION['admin_id'],
							"updated_at" => $update_date,
							"created_by" => $_SESSION['admin_id'],
							"created_at" => $created_date
						];

						$submit_slider = $this->Slider_query->submit($slider);
						$submit_short_translations = $this->langguage_query->add_short_translations($short_translations);
						$submit_long_translations = $this->langguage_query->add_long_translations($long_translations);

						if($submit_slider && $submit_short_translations && $submit_long_translations){
								$this->session->set_flashdata('success', "slider submit success");
						}else{
								$this->session->set_flashdata('error', "slider submit failed");
						}
					}
				}else{
					$is_save = false;
					$this->session->set_flashdata('error', "make sure the form is filled in correctly");
				}
					redirect("Admin/Slider_management/");
			}
	}

	public function slider_status_update($slider_id){

		$this->load->model('Admin/Slider/Slider_query','Slider_query', true);

		$update_date = date("Y-m-d H:i:s");
		$update_by = $_SESSION['admin_id'];

		$status = $this->Slider_query->cek_status($slider_id);

		if($status == 1){
			$status = 0;
		}else{
			$status = 1;
		}

		$update = [
					"update_date" => $update_date,
					"update_by" => $update_by,
					"status" => $status
		];
		$slider_status = $this->Slider_query->slider_status_update($update,$slider_id);

		if($slider_status){
				$this->session->set_flashdata('success', "slider data has been update");
		}else{
				$this->session->set_flashdata('error', "slider failed update");
		}

		redirect("Admin/Slider_management");

	}

	public function slider_delete($slider_id){

		$this->load->model('Admin/Slider/Slider_query','Slider_query', true);

		$delete_date = date("Y-m-d H:i:s");
		$delete_by = $_SESSION['admin_id'];

		$status = $this->Slider_query->cek_status($slider_id);
		$status = 2;


		$update = [
					"update_date" => $delete_date,
					"update_by" => $delete_by,
					"status" => $status
		];
		$slider_status = $this->Slider_query->slider_status_update($update,$slider_id);

		if($slider_status){
				$this->session->set_flashdata('success', "slider data has been update");
		}else{
				$this->session->set_flashdata('error', "slider failed update");
		}

		redirect("Admin/Slider_management");

	}

	public function Importer_add(){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
		 	redirect("Admin/Logout");
			}else{
			$this->load->model('Admin/Importer/Importer_query','Importer_query', true);
			$this->data['data']['coutry'] = $this->Importer_query->coutry_list();
			//$this->load->model('admin/invoice/Invoice_admin','Invoice_admin', true);
			//$this->data['data'] = $this->Invoice_admin->list_invoice();
			//$this->data
			$this->master["custume_css"] = $this->load->view('admin/importer_add/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/importer_add/custume_js.php',$this->data, TRUE);
			$this->master["content"] = $this->load->view("admin/importer_add/content.php",[], TRUE);
			$this->render();
			}
	}

	public function Submit_importer(){
		$is_save = true;
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
		 	redirect("Admin/Logout");
		}else{
			$this->load->model('Admin/Importer/Importer_query','Importer_query', true);
			$this->form_validation->set_rules('importer_name', 'importer_name', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('importer_detail', 'importer_detail', 'trim|min_length[3]');
			$this->form_validation->set_rules('importer_address', 'importer_address', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('importer_city', 'importer_city', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('importer_provience', 'importer_provience', 'trim|required|min_length[3]');
			$this->form_validation->set_rules('importer_postal', 'importer_postal', 'trim|is_natural|min_length[3]');

			$this->form_validation->set_rules('coutry_id', 'coutry_id', 'trim|required|is_natural');

			$this->form_validation->set_rules('contact_name', 'contact_name', 'trim|min_length[3]');
			$this->form_validation->set_rules('office_phone', 'office_phone', 'trim|required|is_natural');
			$this->form_validation->set_rules('contact_phone', 'contact_phone', 'trim|is_natural');
			$this->form_validation->set_rules('contact_fax', 'contact_fax', 'trim|is_natural');
			$this->form_validation->set_rules('contact_email', 'contact_email', 'trim|required|valid_email');
			$this->form_validation->set_rules('contact_website', 'contact_website', 'trim|valid_url');

			$this->form_validation->set_rules('social_twitter', 'social_twitter', 'trim');
			$this->form_validation->set_rules('social_facebook', 'social_facebook', 'trim');
			$this->form_validation->set_rules('social_google', 'social_google', 'trim');

			$this->form_validation->set_rules('is_draft', 'is_draft', 'trim');

			if($this->form_validation->run() == TRUE)
			{
				$date = date_create();
				$update_date = date("Y-m-d H:i:s");
				$created_date = date("Y-m-d H:i:s");

				$importer_name = $this->input->post('importer_name');
				$importer_detail = $this->input->post('importer_detail');
				$importer_address = $this->input->post('importer_address');
				$importer_city = $this->input->post('importer_city');
				$importer_provience = $this->input->post('importer_provience');
				$importer_postal = $this->input->post('importer_postal');
				$coutry_id = $this->input->post('coutry_id');
				$contact_name = $this->input->post('contact_name');
				$office_phone = $this->input->post('office_phone');
				$contact_phone = $this->input->post('contact_phone');
				$contact_fax = $this->input->post('contact_fax');
				$contact_website = $this->input->post('contact_website');
				$social_twitter = $this->input->post('social_twitter');
				$social_facebook = $this->input->post('social_facebook');
				$social_google = $this->input->post('social_google');
				$status = $this->input->post('is_draft');

				if($data['status'] == 1){
							$data['status'] == 0;
				}else{
						$data['status'] == 1;
				}

				$importer[] = [
							"importer_id" => null,
							"importer_name" => $importer_name,
							"importer_detail" => $importer_detail,
							"importer_address" => $importer_address,
							"importer_city" => $importer_city,
							"importer_provience" => $importer_provience,
							"importer_postal" => $importer_postal,
							"coutry_id" => $coutry_id,
							"contact_name" => $contact_name,
							"office_phone" => $office_phone,
							"contact_fax" => $contact_fax,
							"contact_website" => $contact_website,
							"social_twitter" => $social_twitter,
							"social_google" => $social_google,
							"goog" => $social_facebook,
							"post_date" => 	$created_date ,
							"post_by" => $_SESSION['admin_id'],
							"update_date" => 	$created_date ,
							"update_by" => $_SESSION['admin_id'],
							"delete_date" => null,
							"delete_by" => null,
							"status" => $status
				];

				$importer_submit = $this->Importer_query->importer_submit($importer);

				if($importer_submit){
					$is_save = true;
					$this->session->set_flashdata('success', "importer submit success");
				}else{
					$is_save = false;
					$this->session->set_flashdata('error', "importer submit error");
				}

			}else{
				$is_save = false;
				$this->session->set_flashdata('error', "make sure the form is filled in correctly");
			}


			if($is_save){
						//redirect("Admin/Detail_importer/".$importer_submit);
						echo $importer_submit;
			}else{
						redirect("Admin/Importer_add/");
			}

		}
	}

	public function importer_detail($id){
		if($_SESSION['admin_id'] == null || $_SESSION['admin_id'] == ""){
			redirect("Admin/Logout");
			}else{
			$this->load->model('Admin/Importer/Importer_query','Importer_query', true);
			$this->data['data']['coutry'] = $this->Importer_query->coutry_list();
			$this->data['data']['detail'] = $this->Importer_query->importer_detail($id);
			$this->data['data']['product'] = $this->Importer_query->Importer_product_list();

			$this->master["custume_css"] = $this->load->view('admin/importer_detail/custume_css.php', [], TRUE);
			$this->master["custume_js"] = $this->load->view('admin/importer_detail/custume_js.php',$this->data, TRUE);
			$this->master["content"] = $this->load->view("admin/importer_detail/content.php",[], TRUE);
			$this->render();
			}
	}

	public function submit_importer_product_category(){
		$this->load->model('Admin/Importer/Importer_query','Importer_query', true);
		$importer_id = $this->input->get('importer_id');
		$category_id = $this->input->get('category_id');
		$post_date = date("Y-m-d H:i:s");
		$post_by = $_SESSION['admin_id'];



			$importer_product []= [
						"product_id " => null,
						"importer_id" => $importer_id,
						"category_id" => $category_id,
						"post_date" => $post_date,
						"post_by" => $post_by,
						"update_date" => $post_date,
						"updated_by" => $post_by,
						"delete_date" => null,
						"delete_by" => null,
						"status" => 1
			];

			$importer_product_submit = $this->Importer_query->importer_product_save($importer_product);
			echo json_encode($importer_product_submit);

	}



	public function get_list_importer_product_category(){
		$this->load->model('Admin/Importer/Importer_query','Importer_query', true);
		//$category_id = $this->input->get('category_id');
		$importer_id = $this->input->get();

		$importer_product_categories = $this->Importer_query->list_importer_product_categories($importer_id);

		echo json_encode($importer_product_categories);
	}

	public function delete_importer_product_category($product_id,$importer_id){
		$this->load->model('Admin/Importer/Importer_query','Importer_query', true);
		$product_id = $product_id;
		$importer_id = $importer_id;
		$delete_date = date("Y-m-d H:i:s");
		$delete_by = $_SESSION['admin_id'];

		$delete = [
			"product_id " => $product_id,
			"delete_date" => $delete_date,
			"delete_by" => $delete_by,
			"status" => 2
		];

		$importer_product_delete = $this->Importer_query->importer_product_delete($delete,$product_id);

		if($importer_product_delete){
			$this->session->set_flashdata('success', "importer category has been delete");
		}else{
			$this->session->set_flashdata('error', "importer category failed delete");
		}
			redirect("Admin/importer_detail/".$importer_id);
	}

	public function send_account_expoter(){

			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);
			$acount = $this->Exporter_query->get_email_account();

			$this->load->library('email');
			$actived_link = base_url()."/web_itpc_login";

			foreach ($acount as $key_account => $value_account) {
				$user_id= $value_account['user_id'];
				$this->data['data']['username'] = $value_account['username'];
				$this->data['data']['email'] = $value_account['email'];
				$this->data['data']['password'] = $value_account['password_text'];
				$this->data['data']['link'] = $actived_link;
				echo $send_to = $value_account['email'];


				$message = $this->load->view('email/account_email.php',$this->data,TRUE);
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

					$update = [
						"send_email" => 1
					];

					$update = $this->Exporter_query->send_email_update($update,$user_id);
					$register['data'] = null;
					$register['status'] = true;
					$register['message'] = "Congratulations, you have successfully registered, please check your email (".$send_to.") for account activation";
				}
				//echo json_encode($this->data['data']);
			}


			echo json_encode($register);

	}

	public function Update_progress(){
		$this->load->model('Admin/Inquery/Inquery_query','Inquery_query', true);

		$progress_data = $this->input->get();

		 $progress = $progress_data['progress'];
		 $inquiry_id = $progress_data['inquiry_id'];

		$update_date = date("Y-m-d H:i:s");
		$updated_by = $_SESSION['admin_id'];

		$update = [
					"inquiry_id " => $inquiry_id,
					"progress" => $progress,
					"update_date" => $update_date,
					"update_by" => $updated_by
		];

		$update_progress = $this->Inquery_query->Update_progress($update,$inquiry_id);
		echo json_encode($update_progress);
	}










}
