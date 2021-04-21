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
      


    }