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
					$this->session->set_flashdata('exporter', "subcategory data failed to save");
				}

			}else{
				$is_save = false;
				$this->session->set_flashdata('error', "make sure the form is filled in correctly");
			}
			redirect("Admin/Exporter_subcategory");
	}

	public function Subcategory_list_data()
	{
			$this->load->model('Admin/Exporter/Exporter_query','Exporter_query', true);

			$postData = $this->input->get();

			//$exporter_list = $this->Exporter_query->get_list();

			$subcategory_list = $this->Exporter_query->getSubcategory($postData);

			echo json_encode($subcategory_list);

	}




}