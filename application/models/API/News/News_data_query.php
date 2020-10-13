<?php
class News_data_query extends CI_Model{

    public function get($limit,$start,$Tag_slug = null) {
          require_once('News_page.php');
          $this->db->select([
    			'a.news_id ',
    			'a.news_title',
    			'a.news_slug',
    			'a.news_order',
    			'a.news_thumbnail_type',
    			'a.news_thumbnail',
    			'a.post_date',
          'b.tag_slug',
    			'b.tag_title',
    			'c.admin_name'
    		]);

    		$this->db->where('a.status', 1);
    		$this->db->where('a.delete_date', null);
        if(isset($Tag_slug)) {
            $this->db->where('b.tag_slug', $Tag_slug);
        }
    		$this->db->join('itpc_tag b', 'a.tag_id = b.tag_id');
    		$this->db->join('itpc_admin c', 'a.post_by = c.admin_id');
        $this->db->limit($limit, $start);
        $this->db->order_by('a.post_date','DESC');
    		$query = $this->db->get('itpc_news a');
    		$news_list = [];
    		array_map(function($item) use(&$news_list){
    			$news_list[] = (new News_page($item))->to_array();
    		}, $query->result_array());
    		$query->free_result();
    		$this->db->reset_query();

        return [
    			'data' => $news_list
    		];
    }

    /*
    $this->db->limit($limit, $start);
  $query = $this->db->get('form');
  return $query->result_array();
    */

}
