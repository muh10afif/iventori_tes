<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class M_item extends CI_Model {

    public function showAll(){
        $query = $this->db->get('item');
         if($query->num_rows() > 0){
             return $query->result();
         }else{
             return false;
         }
     }

     public function addItem($data){
        return $this->db->insert('item', $data);
    }
    public function updateItem($id,$field){
        $this->db->where('id_item', $id);
        $this->db->update('item', $field);
        if($this->db->affected_rows() >0){
            return true;
        }else{
            return false;
        }
        
    }
      public function deleteItem($id){
         $this->db->where('id_item', $id);
        $this->db->delete('item');
           if($this->db->affected_rows() >0){
            return true;
        }else{
            return false;
        }
        
    }

}

/* End of file M_item.php */
