<?php
class Indonesian_product_model extends CI_Model{
    public function indonesian_product($limit=4, $start=0) {

      $this->db->select([
        'indo_product_id as id',
        'indo_product_title as title',
        'indo_product_thumbnail as thumbnail',
        'indo_product_file as file'
      ]);

      $this->db->where('status', 1);
      $this->db->where('delete_date', null);
      $this->db->order_by('indo_product_id','ASC');
      $this->db->limit($limit, $start);
      //$this->db->limit(4);
      $query = $this->db->get('itpc_indo_product');
      return $query->result_array();


}}
