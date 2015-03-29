<?php
class Admin_model extends CI_model {
	public function __construct() {
        parent:: __construct();
        $this->load->database();
        $this->load->library('session'); 
    }

    public function add_questions() {
        $date = new DateTime("now"); 
        foreach($this->input->post('survey') as $v) {  
    	$data = array(
            'question'=>$this->input->post('question'),
             'survey_id'=>$v,         
            'created_at'=>$date->format('Y-m-d H:i:s')    
        );

        if($this->db->insert('survey_questions',$data)) {
            return true;
        } 
        return false;
        }
    }
    public function surveys_show() {
        $this->db->select('surveys.survey_name, surveys.survey_id');
        
        $result=$this->db->get('surveys');
            return $result->result();
    }


    
}