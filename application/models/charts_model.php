<?php
class Charts_model extends CI_model {
	public function __construct() {
        parent:: __construct();
    }

    /*public function get_activity() {
        $query = $this->db->query("SELECT count(question_id)  AS question_id, count(answer) 
			AS answer 
    	  	FROM survey_answers
    	  	WHERE survey_answers.question_id = '3'
    	  	AND survey_answers.answer = '5'
            ORDER BY (answer)");

            if($query->num_rows()>0) {
			    return $query->result();
			}
		    else {
			    return NULL;
		    }

	}*/



}