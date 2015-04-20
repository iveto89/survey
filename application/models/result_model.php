<?php
class Result_model extends CI_Model {
    public function __construct() {
        parent:: __construct();
        $this->load->database();     
    }
     
    public function total_rows()
    {
   		$this->db->select('*');
	    $this->db->from('survey_answers');
	    $this->db->join('survey_questions', 'survey_questions.question_id=
	    survey_answers.question_id	');
	    $this->db->group_by('survey_answers.question_id');
	    $this->db->where('survey_id', '1');
	    $query=$this->db->get();

    	if($query->num_rows() > 0)
        {
            return $query->num_rows();
        } 
        else 
        {
            return false;
        }
    }
    
    public function result_question()
    {    		
    	$this->db->select('survey_questions.question');
    	$this->db->distinct('survey_questions.question_id');
	    $this->db->select_avg('answer');

	    $this->db->from('survey_answers');
	    $this->db->join('survey_questions', 'survey_questions.question_id=
	    survey_answers.question_id	');
	    $this->db->group_by('survey_answers.question_id');
	    $this->db->where('survey_id', $this->uri->segment(3));

	    $query=$this->db->get();
		return $query->result();

	}



}



