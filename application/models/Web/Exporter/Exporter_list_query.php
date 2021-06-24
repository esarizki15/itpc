<?php
class Exporter_list_query extends CI_Model{
 
    public function exporter_list($limit=2, $start=0)
    {
        $this->db->select([
              'it_ex.*'
            ]);
        $this->db->where('it_ex.status', 1);
        $this->db->limit($limit, $start);
        $query = $this->db->get('itpc_exporter it_ex');
        $it_ex = $query->result_array();
        $arrRes=array();
        foreach ($it_ex as $x => $val) {
            //find category
            $this->db->select([
                'b.category_id','c.category_title'
              ]);

            $this->db->join('itpc_exporter_category b', 'b.exporter_id = a.exporter_id');
            $this->db->join('itpc_category c', 'c.category_id = b.category_id');
            $this->db->where('a.exporter_id', $val['exporter_id']);
            $this->db->group_by("b.category_id");
            $cat = $this->db->get('itpc_exporter a')->result_array();

            foreach ($cat as $catfish) {
                if ($catfish['category_id']==$val['exporter_id']) {
                    $it_ex[$x]['category']=$catfish;
                }
            }

           /*
            $this->db->select_max('d.ex_pro_image');
            $this->db->join('itpc_exporter_product d', 'd.exporter_id = a.exporter_id');
            $this->db->where('a.exporter_id', $val['exporter_id']);
            $this->db->limit(1);
            $imagenya = $this->db->get('itpc_exporter a')->result_array();

            $it_ex[$x]['imagenya']=$imagenya[0]['ex_pro_image'];*/


            $this->db->select_max('a.exporter_logo');
            //$this->db->join('itpc_exporter_product d', 'd.exporter_id = a.exporter_id');
            $this->db->where('a.exporter_id', $val['exporter_id']);
            $this->db->limit(1);
            $imagenya = $this->db->get('itpc_exporter a')->result_array();

            $it_ex[$x]['imagenya']=$imagenya[0]['exporter_logo'];



        }

        return [
              'it_ex' => $it_ex
            ];
    }
    public function find_exporter($exporter_id)
    {
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
 public function detailexporter($id){

  $this->db->select([
    'it_ex.*'
  ]);
    $this->db->where('it_ex.status', 1);
    $this->db->where('it_ex.exporter_slug', $id);

    $query = $this->db->get('itpc_exporter it_ex');

    $it_ex = $query->result_array();

    $arrRes=array();
    foreach ($it_ex as $x => $val) {
        //find category
        $this->db->select([
          'b.category_id','c.category_title'
        ]);

        $this->db->join('itpc_exporter_category b', 'b.exporter_id = a.exporter_id');
        $this->db->join('itpc_category c', 'c.category_id = b.category_id');
        $this->db->where('a.exporter_id', $val['exporter_id']);
        if ($categoryId <> 0) {
            //pr($categoryId);exit;
            $this->db->where('b.category_id', $categoryId);
        }
        $this->db->group_by("b.category_id");
        $cat = $this->db->get('itpc_exporter a')->result_array();

        $it_ex[$x]['category']="";
        foreach ($cat as $catfish) {
            if ($catfish['category_id']==$val['exporter_id']) {
                $it_ex[$x]['category']=$catfish;
            }
        }
        $this->db->select_max('d.ex_pro_image');
        $this->db->join('itpc_exporter_product d', 'd.exporter_id = a.exporter_id');
        $this->db->where('a.exporter_id', $val['exporter_id']);
        $this->db->limit(1);
        $imagenya = $this->db->get('itpc_exporter a')->result_array();

        $it_ex[$x]['imagenya']=$imagenya[0]['ex_pro_image'];
        if ($it_ex[$x]['category'] === "") {
            $it_ex[$x] = null;
        }
    }

    //pr($it_ex);exit;
    return [
      'data' => $it_ex,
      'category' => $category,
    ];
 }
    public function search($name, $categoryId,$order,$subcategoryId, $limit=2, $start=0)
    {

        $this->db->select([
        'it_ex.*'
      ]);
        $this->db->where('it_ex.status', 1);
        // $this->db->where('it_ex.exporter_id', $id);
        $this->db->like('it_ex.exporter_name', $name, 'both');
       // pr($order);exit;
        if ($order == "newor") {
          $this->db->order_by('it_ex.post_date', 'desc');
        } elseif ($order === "oldor") {
          $this->db->order_by("it_ex.post_date", "asc");
        } elseif ($order === "titor") {
        $this->db->order_by("it_ex.exporter_name", "asc");
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get('itpc_exporter it_ex');

        $it_ex = $query->result_array();
        $arrRes=array();
        foreach ($it_ex as $x => $val) {
            //find category
            $this->db->select([
              'b.category_id','c.category_title'
            ]);

            $this->db->join('itpc_exporter_category b', 'b.exporter_id = a.exporter_id');
            $this->db->join('itpc_category c', 'c.category_id = b.category_id');
            $this->db->where('a.exporter_id', $val['exporter_id']);
            if ($categoryId <> 0) {
                //pr($categoryId);exit;
                $this->db->where('b.category_id', $categoryId);
            }
            $this->db->group_by("b.category_id");
            $cat = $this->db->get('itpc_exporter a')->result_array();
            // var_dump($cat); exit;
            $it_ex[$x]['category']="";
            foreach ($cat as $catfish) {
                if ($catfish['category_id']==$val['exporter_id']) {
                    $it_ex[$x]['category']=$catfish;
                }
            }
            $this->db->select_max('d.ex_pro_image');
            $this->db->join('itpc_exporter_product d', 'd.exporter_id = a.exporter_id');
            $this->db->where('a.exporter_id', $val['exporter_id']);
            $this->db->limit(1);
            $imagenya = $this->db->get('itpc_exporter a')->result_array();

            $it_ex[$x]['imagenya']=$imagenya[0]['ex_pro_image'];
            if ($it_ex[$x]['category'] === "") {
                $it_ex[$x] = null;
            }
        }

        //pr($it_ex);exit;
        return [
          'data' => $it_ex,
          'start' => $start += count($it_ex),
          // 'category' => $category,
        ];
    }
    public function dataproduct($id){
      $this->db->select('d.*');
      $this->db->join('itpc_exporter_product d', 'd.exporter_id = a.exporter_id');
      $this->db->where('a.exporter_slug', $id);
      $product = $this->db->get('itpc_exporter a')->result_array();
      return $product;

    }

    public function oldsearch($name, $categoryId, $order)
    {
        $this->db->select([
          'a.*'
        ]);
        $category = null;


        $this->db->like('a.exporter_name', $name, 'both');
        $query = $this->db->get('itpc_exporter a');
        $it_ex = $query->result_array();
        if (!empty($it_ex)) {
            $cek = $this->db->where('b.exporter_id', $it_ex[0]['exporter_id'])->where('b.category_id', $categoryId)->where('delete_by', null)->limit(1)->get('itpc_exporter_category b')->result_array();
            if (!empty($cek)) {
                $cekCategory = $this->db->where('c.category_id', $categoryId)->where('delete_by', null)->limit(1)->get('itpc_category c')->result_array();
                if (!empty($cekCategory)) {
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
