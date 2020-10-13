<?php
class News_data_detail_query extends CI_Model{

    public function get_detail($news_slug) {
          require_once('Detail_news_page.php');
          $this->db->select([
    			'a.news_id ',
    			'a.news_title',
    			'a.news_slug',
    			'a.news_thumbnail',
          'a.news_header',
          'a.tag_id',
          'a.news_content',
    			'a.post_date',
          'b.tag_slug',
    			'b.tag_title',
    			'c.admin_name'
    		]);
    		$this->db->where('a.status', 1);
    		$this->db->where('a.delete_date', null);
        $this->db->where('a.news_slug', $news_slug);
    		$this->db->join('itpc_tag b', 'a.tag_id = b.tag_id');
    		$this->db->join('itpc_admin c', 'a.post_by = c.admin_id');
    		$query = $this->db->get('itpc_news a');
    		$news_detail = [];
    		array_map(function($item) use(&$news_detail){
    			$news_detail[] = (new Detail_news_page($item))->to_array();
    		}, $query->result_array());
    		$query->free_result();
    		$this->db->reset_query();

        return [
    			'data' => $news_detail
    		];
    }

    /*
    $this->db->limit($limit, $start);
  $query = $this->db->get('form');
  return $query->result_array();
    */

}
