<?php
class User_model extends CI_Model {

    
    public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->helper('array');
         
    }
     
    public function register()
    {
        $date = new DateTime("now"); 
                   
        $data=array(
            'username'=>$this->input->post('username'),
            'password'=>sha1($this->input->post('password')),
            'first_name'=>$this->input->post('first_name'),
            'last_name'=>$this->input->post('last_name'),
            'email'=>$this->input->post('email'),
            'location'=>$this->input->post('location'),
            //'school'=>$this->input->post('school'),
           // 'class'=>$this->input->post('class'),
            // 'role_id'=> $this->input->post('role_id'),
            'created_at'=>$date->format('Y-m-d H:i:s')
           
        );
        
        $this->db->insert('users',$data);
	    $insert_id =$this->db->insert_id();
        $this->input->post($insert_id);
         foreach ($this->input->post('role_id') as $value)
        {
            $data = array('role_id' => $value 
            );
        $this->db->where('user_id',$insert_id);
            $this->db->update('users', $data);

        }

        foreach ($this->input->post('class') as $value)
        {
            
            $data = array('class' => $value
            );

            $this->db->where('user_id',$insert_id);
            $this->db->update('users', $data);
        }
        foreach ($this->input->post('school') as $v)
        {
            $data = array('school' => $v
            );

            $this->db->where('user_id',$insert_id);
            $this->db->update('users', $data);

        }
        if($this->db->affected_rows() > 0)
            {
                
                return true;
            } 
            return false;
    }


    public function login()
    {
             
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password',sha1($this->input->post('password')));
        $result=$this->db->get('users');
         
          return $result->row_array();
            
    }

    public function survey_show() {
       
        $this->db->select('*');
        $this->db->from('survey_questions');
        $this->db->where('survey_id', $this->uri->segment(3));
        $this->db->where('question_id', $this->uri->segment(4));
        $result=$this->db->get();
            return $result->result();
    }   
    public function survey_count() {
       
        $this->db->select('*');
        $this->db->from('survey_questions');
        $this->db->where('survey_id', $this->uri->segment(3));
         return $this->db->count_all('survey_questions');
         
    } 
    
    public function survey_fill() 
    {
        $answers=($this->input->post('answer'));

        if (null !==($this->input->post('submit'))) {
            $date = new DateTime("now"); 
            foreach($answers as $question_id=>$answer)
            {
                $data = array(
                    'user_id'=>$this->session->userdata['user_id'],
                    'question_id'=>$question_id,
                    'answer'=>$answer,              
                    'created_at'=>$date->format('Y-m-d H:i:s')
                );

                $this->db->insert('survey_answers', $data);
            }
              if($this->db->affected_rows() > 0)
            {
                 
                return true;
            } 
            return false;
        }
    }

    public function select_question() 
    {

        $this->db->select('*');
        $this->db->from('survey_questions');  
        $this->db->where('question_id', $this->uri->segment(3));
        $result=$this->db->get();
              return $result->result();
    }

    public function update_question() 
    {

        if (null !==($this->input->post('submit'))) {
            $data = array(
                'question'=>$this->input->post('question')           
            );

            $this->db->where('question_id', $this->uri->segment(3));
            $this->db->update('survey_questions', $data);
    
            if($this->db->affected_rows() > 0)
            {
                
                return true;
            } 
            return false;
        
        }
    }


}

   