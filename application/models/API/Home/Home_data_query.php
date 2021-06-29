<?php
class Home_data_query extends CI_Model{
    public function get_latest() {
        require_once('News_latest.php');
        require_once('Exporter_home.php');
        require_once('Indonesia_product.php');
        require_once('Useful_link.php');

        $where_exporter_logo = "exporter_logo is  NOT NULL";

        $this->db->select([
    			'news_id as id',
    			'news_title as title',
    			'news_slug as slug',
          'news_order as order',
    			'news_thumbnail as thumbnail',
    			'post_date as date'
    		]);

    		$this->db->where('status', 1);
    		$this->db->where('delete_date', null);
        $this->db->limit(5);
        $this->db->order_by('news_order','DESC');
    		$query = $this->db->get('itpc_news');
    		$news_latest = [];
    		array_map(function($item) use(&$news_latest){
    			$news_latest[] = (new News_latest($item))->to_array();
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
        $this->db->order_by('indo_product_id','DESC');
        $this->db->limit(12);
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

    /*
    $this->db->limit($limit, $start);
  $query = $this->db->get('form');
  return $query->result_array();
    */

}
