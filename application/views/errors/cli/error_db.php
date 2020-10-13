<?php

class Update_auto_confirm extends CI_Model {


	public function Get_list_news($news_tag,$post_limit = null){
		/*$this->db->select(['a.news_id','a.news_title','a.news_thumbnail','a.news_header','a.news_thumbnail_type','a.post_date','a.post_by','b.tag_title','b.tag_slug','c.admin_name']);
		$this->db->join('itpc_tag b', 'a.tag_id = b.tag_id and b.status = 1 and b.delete_date is null');
		$this->db->join('itpc_admin c', 'a.post_by = c.admin_id');
		$this->db->where('a.slug',$blog_post_slug);
		$this->db->where('a.is_active', true);
		$this->db->where('a.deleted_at', null);
		$query = $this->db->get('blog_posts a');*/

		require_once('Blog_post_category.php');
		$result['blog_post_categories'][] = (new Blog_post_category(['category' => 'Semua','slug' => '']))->to_array();

	}

}
