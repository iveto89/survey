<?php
class Menu_model extends CI_model {
	public function __construct() {
    parent:: __construct();
    $this->load->database();
      
  }

 	public function get_menu () {
 	  $this->db->select('*');
    $this->db->from('menu'); 
    $this->db->where('role_id', $this->session->userdata('role_id')); 
  	$q = $this->db->get();
  	if($q->num_rows() > 0) {
  		foreach($q->result() as $row) {
    		$menu[] = $row;
   		}
   		return $menu;
  	}

  }
                  
        
}