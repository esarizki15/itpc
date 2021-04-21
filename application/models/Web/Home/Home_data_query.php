<?php
class Home_data_query extends CI_Model{
    public function get_news($lang) {
        require_once('News_latest.php');
        require_once('Exporter_home.php');
        require_once('Indonesia_product.php');
        require_once('Useful_link.php');

        $where_exporter_logo = "exporter_logo is  NOT NULL";

        $short='st.english AS short';
        $long='lt.english AS long';
        if($lang=='id') { 
          $short="st.bahasa AS short";
          $long='lt.bahasa AS long';
        }else if($lang=='es'){
          $short='st.spanyol AS short';
          $long='lt.spanyol AS long';
        }else if($lang=='en'){
          $short='st.english AS short';
          $long='lt.english AS long';
        }
        
        $this->db->select([
    			'inews.news_id as id',
    			'inews.news_title as title',
    			'inews.news_slug as slug',
          'inews.news_order as order',
    			'inews.news_thumbnail as thumbnail',
          $short,$long,
          'inews.post_date as date'
    		]);

      

    		$this->db->where('status', 1);
    		$this->db->where('delete_date', null);
        $this->db->join('long_translations lt','inews.trans_key = lt.trans_key', 'left');
        $this->db->join('short_translations st','inews.trans_key = st.trans_key', 'left');
        $this->db->limit(4);
        $this->db->order_by('news_order','DESC');
    		$query = $this->db->get('itpc_news inews');
    		$news_latest = [];
    		array_map(function($item) use(&$news_latest){
    			$news_latest[] = (new News_latest($item))->to_array();
    		}, $query->result_array());

        //pr($news_latest);exit;

      
    		$query->free_result();
    		$this->db->reset_query();

        $this->db->select([
    			'exporter_id as id',
    			'exporter_name as name',
    			'exporter_logo as logo'
    		]);

        $this->db->where('status', 1);
        $this->db->where('delete_date', null);
        $this->db->where('exporter_home', 1);
        $this->db->where($where_exporter_logo);
        $this->db->order_by('exporter_id', 'RANDOM');
        $this->db->limit(5);
        $query = $this->db->get('itpc_exporter');
        $exporter_home = [];
        array_map(function($item) use(&$exporter_home){
    			$exporter_home[] = (new Exporter_home($item))->to_array();
    		}, $query->result_array());

        $query->free_result();
    		$this->db->reset_query();

        $this->db->select([
    			'exporter_id as id',
    			'exporter_name as name',
    			'exporter_logo as logo'
    		]);

        $this->db->where('status', 1);
        $this->db->where('delete_date', null);
        $this->db->where('exporter_home', 1);
        $this->db->where($where_exporter_logo);
        $this->db->order_by('exporter_id', 'RANDOM');
        $this->db->limit(5);
        $query = $this->db->get('itpc_exporter');
        $exporter_home = [];
        array_map(function($item) use(&$exporter_home){
    			$exporter_home[] = (new Exporter_home($item))->to_array();
    		}, $query->result_array());

        $query->free_result();
        $this->db->reset_query();

        $this->db->select([
          'indo_product_id as id',
          'indo_product_title as title',
          'indo_product_thumbnail as thumbnail',
          'indo_product_file as file'
        ]);

        $this->db->where('status', 1);
        $this->db->where('delete_date', null);
        $this->db->order_by('indo_product_id','ASC');
        $this->db->limit(4);
        $query = $this->db->get('itpc_indo_product');
        $indonesia_product = [];
        array_map(function($item) use(&$indonesia_product){
    			$indonesia_product[] = (new Indonesia_product($item))->to_array();
    		}, $query->result_array());

        $query->free_result();
        $this->db->reset_query();

        $this->db->select([
          'useful_id as id',
          'userful_title as title',
          'useful_logo as logo',
          'useful_link as link'
        ]);

        $this->db->where('status', 1);
        $this->db->where('delete_date', null);
        $this->db->order_by('useful_id','ASC');
        $query = $this->db->get('itpc_useful');
        $useful_link = [];
        array_map(function($item) use(&$useful_link){
    			$useful_link[] = (new Useful_link($item))->to_array();
    		}, $query->result_array());

        return [
    			'news_latest' => $news_latest,
          'exporter_home' => $exporter_home,
          'indonesia_product' => $indonesia_product,
          'useful_link' => $useful_link
    		];
    }

    public function get_news_detail($slug,$lang) {
      require_once('News_detail.php');
      require_once('Exporter_home.php');
      require_once('Indonesia_product.php');
      require_once('Useful_link.php');

      $where_exporter_logo = "exporter_logo is  NOT NULL";

      $short='st.english AS short';
      $long='lt.english AS long';
      if($lang=='id') { 
        $short="st.bahasa AS short";
        $long='lt.bahasa AS long';
      }else if($lang=='es'){
        $short='st.spanyol AS short';
        $long='lt.spanyol AS long';
      }else if($lang=='en'){
        $short='st.english AS short';
        $long='lt.english AS long';
      }


      $this->db->select([
        'inews.news_id as id',
        'inews.news_title as title',
        'inews.news_slug as slug',
        'inews.news_content as content',
        $short,$long,
        'inews.news_order as order',
        'inews.news_thumbnail as thumbnail',
        'inews.post_date as date'
      ]);

      $this->db->where('status', 1);
      $this->db->where('delete_date', null);
      $this->db->join('long_translations lt','inews.trans_key = lt.trans_key', 'left');
      $this->db->join('short_translations st','inews.trans_key = st.trans_key', 'left');
      $this->db->where('inews.news_slug', $slug);
      $this->db->order_by('news_order','DESC');
      $query = $this->db->get('itpc_news inews');
      //pr($query->result_array());exit;
      $news_latest = [];
      array_map(function($item) use(&$news_latest){
        $news_latest[] = (new News_latest($item))->to_array();
      }, $query->result_array());

     //pr($news_latest);exit;
      return [
        'news_detail' => $news_latest
      ];

    }

    public function news_all($lang,$limit = null, $start = null) {
      require_once('News_latest.php');
      require_once('Exporter_home.php');
      require_once('Indonesia_product.php');
      require_once('Useful_link.php');

      $where_exporter_logo = "exporter_logo is  NOT NULL";

      $short='st.english AS short';
      $long='lt.english AS long';
      if($lang=='id') { 
        $short="st.bahasa AS short";
        $long='lt.bahasa AS long';
      }else if($lang=='es'){
        $short='st.spanyol AS short';
        $long='lt.spanyol AS long';
      }else if($lang=='en'){
        $short='st.english AS short';
        $long='lt.english AS long';
      }
      
      $this->db->select([
        'inews.news_id as id',
        'inews.news_title as title',
        'inews.news_slug as slug',
        'inews.news_order as order',
        'inews.news_thumbnail as thumbnail',
        $short,$long,
        'inews.post_date as date'
      ]);

    

      $this->db->where('status', 1);
      $this->db->where('delete_date', null);
      $this->db->join('long_translations lt','inews.trans_key = lt.trans_key', 'left');
      $this->db->join('short_translations st','inews.trans_key = st.trans_key', 'left');
      $this->db->limit($limit, $start);
      $this->db->order_by('news_order','DESC');
      $query = $this->db->get('itpc_news inews');
      $news_latest = [];
      array_map(function($item) use(&$news_latest){
        $news_latest[] = (new News_latest($item))->to_array();
      }, $query->result_array());

      return [
        'news' => $news_latest
      ];
   
    }


    public function about_us($lang) {
      require_once('News_latest.php');
      require_once('Exporter_home.php');
      require_once('Indonesia_product.php');
      require_once('Useful_link.php');

      $where_exporter_logo = "exporter_logo is  NOT NULL";

      $short='st.english AS short';
      $long='lt.english AS long';
      if($lang=='id') { 
        $short="st.bahasa AS short";
        $long='lt.bahasa AS long';
      }else if($lang=='es'){
        $short='st.spanyol AS short';
        $long='lt.spanyol AS long';
      }else if($lang=='en'){
        $short='st.english AS short';
        $long='lt.english AS long';
      }
      
      $this->db->select([
        'about.*',
       
        $short,$long,
      
      ]);

    

 
      $this->db->join('long_translations lt','about.trans_key = lt.trans_key', 'left');
      $this->db->join('short_translations st','about.trans_key = st.trans_key', 'left');
      $this->db->limit(1);
      $query = $this->db->get('itpc_about about');

      $about_us = $query->result_array();
     //pr($about_us);exit;

      return [
        'about' => $about_us
      ];
   
    }

   

    


}
