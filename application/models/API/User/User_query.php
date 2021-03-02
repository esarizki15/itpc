<?php
class User_query extends CI_Model{

    public $user_id;
		public $username;
		public $password;
		public $password_text;
		public $email;
		public $expoter_id;
		public $post_date;
		public $post_by;
		public $delete_date;
		public $delete_by;
		public $status;

    public $exporter_id;
    public $category_id;
    public $subcategory_id;

    public function Submit_category($category){
    //$result = $this->db->insert('zambert_user',$user);
    $result =	$this->db->insert_batch('itpc_exporter_category',$category);
    if(!$result)
       $this->session->set_flashdata('error', 'Gagal menyimpan data');
    return $result;
    }

    public function save($user){
		//$result = $this->db->insert('zambert_user',$user);
		$result =	$this->db->insert_batch('itpc_user',$user);
		if(!$result)
			 $this->session->set_flashdata('error', 'Gagal menyimpan data');
		return $result;
		}



    public function cek_email($email){
      $this->db->select([
        'password as password'
      ]);
      $this->db->where('email', $email);
      $query = $this->db->get('itpc_user');
      if($query){
        foreach($query->result() as $row){
         return $row->password;
        }
  		}else{
  			return false;
  		}
    }

    public function cek_password($email,$password){
      $this->db->select([
        'password as password'
      ]);
      $this->db->where('email', $email);
      $this->db->where('password', $password);
      $query = $this->db->get('itpc_user');
      if($query){
        foreach($query->result() as $row){
         return $row->password;
        }
  		}else{
  			return false;
  		}
    }

    public function cek_auth($user_id){
      $this->db->select([
        'auth_code as auth_code'
      ]);
      $this->db->where('user_id', $user_id);
      $this->db->limit(1);
      $this->db->order_by('auth_id','ASC');
      $query = $this->db->get('itpc_authentication');
      if($query){
        foreach($query->result() as $row){
         return $row->auth_code;
        }
  		}else{
  			return false;
  		}
    }

    public function get_auth($user_id){
      $this->db->select([
        'auth_code as auth_code'
      ]);
      $this->db->where('user_id', $user_id);
      $this->db->limit(1);
      $this->db->order_by('auth_id','ASC');
      $query = $this->db->get('itpc_authentication');
      if($query){
        foreach($query->result() as $row){
         return $row->auth_code;
        }
  		}else{
  			return false;
  		}
    }


    public function create_auth($auth){
		//$result = $this->db->insert('zambert_user',$user);
		$result =	$this->db->insert_batch('itpc_authentication',$auth);
		if(!$result)
			 $this->session->set_flashdata('error', 'Gagal menyimpan data');
		return $result;
		}

    public function update_auth($auth){
		//$result = $this->db->insert('zambert_user',$user);
     $this->db->where('user_id',$auth['user_id']);
     $result = $this->db->update('itpc_authentication', $auth);
     return true;
		}

    public function login($cek_email,$cek_password){

      require_once('User_data.php');
      require_once('Category_data.php');


      $this->db->select([
        'a.user_id as user_id',
        'a.username as username',
        'a.email as email',
        'a.status as status'
      ]);
      $this->db->where('a.status <', 3);
      $this->db->where('a.delete_date', null);
      $this->db->where('a.email', $cek_email);
      $this->db->where('a.password', $cek_password);
      $query = $this->db->get('itpc_user a');
      $user_data = [];
      array_map(function($item) use(&$user_data){
        $user_data[] = (new User_data($item))->to_array();
      }, $query->result_array());
      /*
      if($query){
         $user_data = $query->result_array();
  		}else{
  			$user_data = false;
  		}*/
      $query->free_result();
      $this->db->reset_query();

      //echo $exporter_id = $user_data[0]['user_id'];
      //echo "<br/>";

      $exporter_id = $user_data[0]['user_id'];

      $this->db->select([
        'b.category_title as category',
        'c.subcategory_title as subcategory'
      ]);
      $this->db->where('a.exporter_id', $exporter_id);
      $this->db->where('a.status', 1);
      $this->db->where('a.delete_date', null);
      $this->db->join('itpc_category b', 'a.category_id = b.category_id');
      $this->db->join('itpc_subcategory c', 'a.subcategory_id = c.subcategory_id');
      $query = $this->db->get('itpc_exporter_category a');
      $category_data = [];
      array_map(function($item) use(&$category_data){
        $category_data[] = (new Category_data($item))->to_array();
      }, $query->result_array());

      return [
        'user_data' => $user_data,
        'category_data' => $category_data
      ];
    }

    public function account_status($id)
    {
      require_once('User_data.php');
      require_once('Category_data.php');
      require_once('Exporter_detail.php');


      $this->db->select([
        'a.user_id as user_id',
        'a.username as username',
        'a.email as email',
        'a.status as status'
      ]);
      $this->db->where('a.status <', 3);
      $this->db->where('a.delete_date', null);
      $this->db->where('a.user_id', $id);
      $query = $this->db->get('itpc_user a');
      $user_data = [];
      array_map(function($item) use(&$user_data){
        $user_data[] = (new User_data($item))->to_array();
      }, $query->result_array());
      /*
      if($query){
         $user_data = $query->result_array();
      }else{
        $user_data = false;
      }*/
      $query->free_result();
      $this->db->reset_query();

      //echo $exporter_id = $user_data[0]['user_id'];
      //echo "<br/>";

      $exporter_id = $user_data[0]['user_id'];

      $this->db->select([
        'a.exporter_name as name',
        'a.exporter_phone as phone',
        'a.exporter_email as email'
      ]);
      $this->db->where('a.exporter_id', $exporter_id);
      $query = $this->db->get('itpc_exporter a');
      $exporter_data = [];
      array_map(function($item) use(&$exporter_data){
        $exporter_data[] = (new Exporter_detail($item))->to_array();
      }, $query->result_array());

      $query->free_result();
      $this->db->reset_query();

      $this->db->select([
        'b.category_title as category',
        'c.subcategory_title as subcategory'
      ]);
      $this->db->where('a.exporter_id', $exporter_id);
      $this->db->where('a.status', 1);
      $this->db->where('a.delete_date', null);
      $this->db->join('itpc_category b', 'a.category_id = b.category_id');
      $this->db->join('itpc_subcategory c', 'a.subcategory_id = c.subcategory_id');
      $query = $this->db->get('itpc_exporter_category a');
      $category_data = [];
      array_map(function($item) use(&$category_data){
        $category_data[] = (new Category_data($item))->to_array();
      }, $query->result_array());

      return [
        'user_data' => $user_data,
        'exporter_data' => $exporter_data,
        'category_data' => $category_data
      ];

    }

    public function get_id_user($email) {
			$this->db->select([
			'user_id'
		]);
		$this->db->from('itpc_user');
		$this->db->where([
			'email' => $email,
			'delete_date' => null,
			'status' => 2
		]);
		$query = $this->db->get();
		foreach($query->result() as $row){
			return $row->user_id;
		}
	}

  public function update_exporter_id($expoter_id) {
		extract($expoter_id);

		$data = array(
		    'expoter_id' => $expoter_id
		);
    $this->db->where('user_id',$expoter_id);
		$result = $this->db->update('itpc_user', $data);
		return true;
	}

  public function detail_exporter($user_id){

    require_once('Exporter_detail.php');
    require_once('Category_exporter_data.php');

    $this->db->select([
      'exporter_id as id',
      'exporter_name as name',
      'exporter_logo as logo',
      'exporter_address as address',
      'exporter_phone as phone',
      'exporter_office_phone as office_phone',
      'exporter_fax as fax',
      'exporter_email as email',
      'exporter_link as link'
    ]);
    $this->db->where('exporter_id', $user_id);
    $this->db->where('status', 1);
    $this->db->where('delete_date', null);
    $query = $this->db->get('itpc_exporter');
    $exporter_detail = [];
    array_map(function($item) use(&$exporter_detail){
      $exporter_detail[] = (new Exporter_detail($item))->to_array();
    }, $query->result_array());
    
    $query->free_result();
    $this->db->reset_query();

    $exporter_id = $exporter_detail[0]['id'];

    $this->db->select([
      'a.ex_cat_id  as id',
      'b.category_title as category',
      'c.subcategory_title as subcategory'
    ]);
    $this->db->where('a.exporter_id', $exporter_id);
    $this->db->where('a.status', 1);
    $this->db->where('a.delete_date', null);
    $this->db->join('itpc_category b', 'a.category_id = b.category_id');
    $this->db->join('itpc_subcategory c', 'a.subcategory_id = c.subcategory_id');
    $query = $this->db->get('itpc_exporter_category a');
    $category_data = [];
    array_map(function($item) use(&$category_data){
      $category_data[] = (new Category_exporter_data($item))->to_array();
    }, $query->result_array());
   
    return [
      'exporter_detail' => $exporter_detail,
      'category_data' => $category_data
    ];
  }

  public function Exporter_data_update($update) {
    $this->db->where('exporter_id',$update['exporter_id']);
    $result = $this->db->update('itpc_exporter',$update);

    if($result){
      return true;
    }else{
      return false;
    }

  }

  public function Cek_category_id($category){
    $category['exporter_id'];
    $this->db->select([
        'ex_cat_id'
      ]);
      $this->db->from('itpc_exporter_category');
      $this->db->where([
        'exporter_id' => $category['exporter_id'],
        'category_id' => $category['category_id'],
        'subcategory_id' => $category['subcategory_id'],
        'delete_date' => null,
        'status' => 1
      ]);
      $query = $this->db->get();
      foreach($query->result() as $row){
        return $row->ex_cat_id;
     }
  }


  public function User_activved($oder_actived,$update) {
    $this->db->where('user_id',$oder_actived);
    $result = $this->db->update('itpc_user',$update);
    if($result){
      return true;
    }else{
      return false;
    }

  }

  public function delete_exporter_category($update) {
    $this->db->where('ex_cat_id',$update['ex_cat_id']);
    $result = $this->db->update('itpc_exporter_category',$update);

    if($result){
      return true;
    }else{
      return false;
    }

  }

  public function get_exporter_catgory_id($ex_cat_id) {
    $this->db->select([
    'exporter_id'
  ]);
  $this->db->from('itpc_exporter_category');
  $this->db->where([
    'exporter_id' => $ex_cat_id
  ]);
  $query = $this->db->get();
  foreach($query->result() as $row){
    return $row->exporter_id;
  }
}

public function get_exporter_product($exporter_id){
  require_once('Exporter_product.php');
  $this->db->select([
    'ex_pro_id as id',
    'ex_pro_image as image'
  ]);
  $this->db->where('exporter_id', $exporter_id);
  $this->db->where('status', 1);
  $this->db->where('delete_date', null);
  $query = $this->db->get('itpc_exporter_product');
  $exporter_product = [];
  array_map(function($item) use(&$exporter_product){
    $exporter_product[] = (new Exporter_product($item))->to_array();
  }, $query->result_array());

  return $exporter_product;
}

public function add_exporter_product($product){
//$result = $this->db->insert('zambert_user',$user);
$result =	$this->db->insert_batch('itpc_exporter_product',$product);
if(!$result)
   $this->session->set_flashdata('error', 'Gagal menyimpan data');
return $result;
}

public function delete_exporter_product($update) {
  $this->db->where('ex_pro_id',$update['ex_pro_id']);
  $result = $this->db->update('itpc_exporter_product',$update);

  if($result){
    return true;
  }else{
    return false;
  }

}

public function get_add_inquiry($exporter_id){
  require_once('Exporter_inquiry.php');
  //require_once('Subcategory_inquiry.php');

  $this->db->select([
    'a.exporter_id as exporter_id',
    'a.exporter_name as exporter_name',
    'a.exporter_address as exporter_address',
    'b.username as username',
    'a.exporter_phone as exporter_phone',
    'b.email as email'
  ]);
  $this->db->where('a.exporter_id', $exporter_id);
  $this->db->where('a.delete_date', null);
  $this->db->join('itpc_user b', 'a.exporter_id = b.user_id');
  $query = $this->db->get('itpc_exporter a');
  $exporter_inquiry = [];
  array_map(function($item) use(&$exporter_inquiry){
    $exporter_inquiry[] = (new Exporter_inquiry($item))->to_array();
  }, $query->result_array());

  $query->free_result();
  $this->db->reset_query();

  return [
      'exporter_inquiry' => $exporter_inquiry
  ];


}









}
