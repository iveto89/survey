<?php
class Coordinator_model extends CI_Model { 
    
    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->helper('array');
        $this->load->library('session'); 
         
    }
     
    public function teachers_show()
    {
        $this->db->select('coordinator_id, teacher_id, users.username, users.user_id');     
        $this->db->from('coordinator_teacher_conn');
        $this->db->join('users AS US', 'US.user_id=coordinator_teacher_conn.coordinator_id');
        $this->db->join('users', 'users.user_id=coordinator_teacher_conn.teacher_id');
        $this->db->select(' US.username as U');
        $this->db->where('US.deactivated_at = "0000-00-00 00:00:00" || US.deactivated_at IS NULL ');
        $this->db->where('users.role_id', '2');
        $result=$this->db->get();
      		return $result->result();
	}
	
	public function coordinator_show()
    {
        //remove
        $this->db->select('coordinator_id, teacher_id, users.user_id,users.username');
        $this->db->from('coordinator_teacher_conn');
        $this->db->join('users', 'users.user_id=coordinator_teacher_conn.coordinator_id','left');   
        $this->db->where('users.deactivated_at = "0000-00-00 00:00:00" || users.deactivated_at IS NULL ');   
        $result=$this->db->get();
      		return $result->result();
	}
   
   
    public function deactivate_teacher() {
        //remove
        $submit=$this->input->post('deactivate');
        $date = new DateTime("now"); 
        if(isset($submit)&&($submit=='Деактивирай учител')) {
            $data = array(         
                'deactivated_at' => $date->format('Y-m-d H:i:s')          
            );
            $this->db->where('user_id', $this->input->post('teacher'));
            $this->db->update('users', $data);    
      
            if($this->db->affected_rows() > 0)
            {   
                return true;
            } 

                return false;
        }

    }
   
    public function	edit_coordinator() {
       //remove
    	$date = new DateTime("now");
    	
		if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==5) {
			if($this->input->post('edit_coordinator')) {
				foreach($this->input->post('edit_coordinator') as $val) {  
				    $data = array(			      
				        'coordinator_id'=> $val   				              
				    );
				        $this->db->where('teacher_id', $this->uri->segment(3));
						$this->db->update('coordinator_teacher_conn',$data);
				}
				
			     if($this->db->affected_rows() > 0)
			     {
			         return true;
			     } 
			         return false;
			    
			 }
		}		

	}

	public function teacher_show() 
    {
        $this->db->select('*');
        $this->db->from('coordinator_teacher_conn');  
        $this->db->join('users', 'users.user_id=coordinator_teacher_conn.teacher_id');
        $this->db->where('teacher_id', $this->uri->segment(3));
        $result=$this->db->get();
            return $result->result();
    }
	       	    		
	public function select_coordinator() 
    {
        //remove
        $this->db->select('*');
        $this->db->from('coordinator_teacher_conn');  
        $this->db->join('users', 'users.user_id=coordinator_teacher_conn.coordinator_id');
        $this->db->where('teacher_id', $this->uri->segment(3));
        $result=$this->db->get();
            return $result->result();
    }
    
	public function	add_students() {
       
    	$date = new DateTime("now");
    	if (null !==($this->input->post('add'))) {
		    if($this->session->userdata('role_id')==4 || $this->session->userdata('role_id')==2) {
				if($this->input->post('user')) {
					foreach($this->input->post('user') as $user) {  
				    	$data = array(			      
				            'student_id'=> $user,
				             'teacher_id'=> $this->session->userdata['user_id'],
				             'created_at'=>$date->format('Y-m-d H:i:s')				              
				        );
				      
						$this->db->insert('teacher_student_conn',$data);
					}
							
    			        if($this->db->affected_rows() > 0)
    			        {
    			          
    			            return true;
    			        } 
    			        return false;
			    
			    }
			}	
		}	

	}


}


 