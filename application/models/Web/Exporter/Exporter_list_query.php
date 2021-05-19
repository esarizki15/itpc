<?php
class Exporter_list_query extends CI_Model{

        public function exporter_list() {
            $this->db->select([
              'it_ex.*'
            ]);
            
            $query = $this->db->get('itpc_exporter it_ex');

            $it_ex = $query->result_array();
            return [
              'it_ex' => $it_ex
            ];
         }
         public function find_exporter($exporter_id) {
            $this->db->select([
              'a.*'
            ]);
            $this->db->where('a.exporter_id', $exporter_id);
            $query = $this->db->get('itpc_exporter a');
            $it_ex = $query->result_array();
            return [
              'it_ex' => $it_ex
            ];
       }

       public function search($name, $categoryId) {
        $this->db->select([
          'a.*'
        ]);
        $category = null;
        // $this->db->join('itpc_exporter_category b', 'b.exporter_id = a.exporter_id');
        // $this->db->join('itpc_category c', 'c.category_id = b.category_id');
        // $this->db->where('b.category_id', $categoryId);
        $this->db->like('a.exporter_name', $name, 'both');
        $query = $this->db->get('itpc_exporter a');
        $it_ex = $query->result_array();
        if(!empty($it_ex)){
          $cek = $this->db->where('b.exporter_id', $it_ex[0]['exporter_id'])->where('b.category_id', $categoryId)->where('delete_by', null)->limit(1)->get('itpc_exporter_category b')->result_array();
          if(!empty($cek)){
            $cekCategory = $this->db->where('c.category_id', $categoryId)->where('delete_by', null)->limit(1)->get('itpc_category c')->result_array();
            if(!empty($cekCategory)){
              $category = $cekCategory[0];
            }
          }
        }
        return [
          'data' => $it_ex,
          'category' => $category,
        ];
     }
    


    }