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
            'created_at'=>$date->format('Y-m-d H:i:s')
           
        );
        
        $this->db->insert('users',$data);
	    $insert_id =$this->db->insert_id();
        $this->input->post($insert_id);

        if ($this->input->post('role_id')) {
            foreach ($this->input->post('role_id') as $value)
            {
                if ($value == '2' || $value == '5') {
                    $data = array(
                        'role_id' => $value,
                        'is_approved' => '0' 
                    );
                } 
                else 
                {
                    $data = array('role_id' => $value 
                    );
                }
               
                $this->db->where('user_id',$insert_id);
                $this->db->update('users', $data);

            }
        }
        if ($this->input->post('class')) {
            foreach ($this->input->post('class') as $class)
            {                
                $data = array('class' => $class
                );

                $this->db->where('user_id',$insert_id);
                $this->db->update('users', $data);
            }
        }
        if ($this->input->post('class_divisions')) {
            foreach ($this->input->post('class_divisions') as $division)
            {                
                $data = array('division' => $division
                );

                $this->db->where('user_id',$insert_id);
                $this->db->update('users', $data);
            }
        }
        if ($this->input->post('school')) {
            foreach ($this->input->post('school') as $v)
            {
                $data = array('school_id' => $v
                );

                $this->db->where('user_id',$insert_id);
                $this->db->update('users', $data);

            }
        }
    
        if ($this->input->post('teacher')) {
            foreach ($this->input->post('teacher') as $teach)
            {
                $data = array(
                    'teacher_id' => $teach,
                    'student_id' => $insert_id,
                    'created_at'=>$date->format('Y-m-d H:i:s')
                );
              
                $this->db->insert('teacher_student_conn', $data);
            }
        }
        if ($this->input->post('all_teachers_show')) {
            foreach ($this->input->post('all_teachers_show') as $teacher)
            {
                $data = array(
                    'teacher_id' => $teacher,
                    'coordinator_id' => $insert_id,
                    'created_at'=>$date->format('Y-m-d H:i:s')
                );

              
                $this->db->insert('coordinator_teacher_conn', $data);

            }
        }
        if($this->db->affected_rows() > 0)
            {   
                return true;
            } 

            return false;
    }


    public function login()
    {
        $this->db->select('*'); 
        $this->db->from('users');     
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password',sha1($this->input->post('password')));
        //$this->db->where('deactivated_at = "0000-00-00 00:00:00" OR deactivated_at IS NULL');
        
        $result=$this->db->get();
            return $result->row_array();            
    }

    public function code_check()
    {
        if(null!==($this->input->post('code_submit'))) {
        $this->db->select('*'); 
        $this->db->from('student_surveys');     
        $this->db->where('survey_code', $this->input->post('code'));
        
        $result=$this->db->get();
            if($result->num_rows > 0) {
                return $result->row_array();            
            }
            return false;
        }
    }

    public function all_teachers_show() {
        $this->db->select('user_id, username');
        $this->db->from('users');
        $this->db->where('role_id', '2');
        $result=$this->db->get();
            return $result->result();

    }
   
    public function survey_show() {       
        $this->db->select('*');
        $this->db->from('survey_questions');
        $this->db->where('survey_questions.survey_id', $this->uri->segment(3)); 
        $result=$this->db->get();
            return $result->result();
        //$this->db->where('deactivated_at', NULL);                
    } 

    public function getSurvey($survey, $question = 0)
    {
        $this->db->select('*');
        $this->db->from('survey_questions');
        $this->db->where('deactivated_at = "0000-00-00 00:00:00" || deactivated_at IS NULL ');
        $this->db->where('survey_id', $survey);
        if ($question) {
            $this->db->where('question_id', $question);
        }
        return $this->db->get();
    }

    public function survey_name() {
       
        $this->db->select('survey_name');
        $this->db->from('surveys');       
        $this->db->join('survey_questions', 'surveys.survey_id=survey_questions.survey_id'); 
        $this->db->where('survey_questions.survey_id', $this->uri->segment(3));    
        $result=$this->db->get();
            return $result->row_array();
        //$this->db->where('deactivated_at', NULL);                
    } 

    public function survey_count() {
       
        $this->db->select('*');
        $this->db->from('survey_questions');
        $this->db->where('survey_id', $this->uri->segment(3));
        // return $this->db->count_all('survey_questions');
        $query=$this->db->get();
        return $query->num_rows();
    } 

    public $insert;
     
    public function add_teacher_subject() {

        $date = new DateTime("now"); 
        $data=array(
            'teacher_id'=>$this->input->post('teacher'),
            'subject_id'=>$this->input->post('subject'),
            'survey_id'=>$this->uri->segment(3),
            'user_id'=>$this->session->userdata['user_id'],
            'survey_code'=>$this->input->post('random_code'),          
            'created_at'=>$date->format('Y-m-d H:i:s')
           
        );
        
        $this->db->insert('student_surveys',$data);
        $result=$this->db->insert_id();
        return $result;
        
    }
    
    public function survey_fill() 
    {
        if ($this->input->post('answer')) {
            $answers= $this->input->post('answer');           
            if (null !==($this->input->post('submit'))) {
                $date = new DateTime("now"); 
                foreach($answers as $question_id=>$answer)
                {
                    $data = array(
                        'user_id'=>$this->session->userdata['user_id'],
                        'question_id'=>$question_id,
                        'answer'=>$answer,              
                        'created_at'=>$date->format('Y-m-d H:i:s'),
                        'student_survey_id' => $this->add_teacher_subject()
                    );
                         
                    $this->db->insert('survey_answers', $data);
                            
                }

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
        $this->db->select('survey_questions.question, survey_questions.is_reverse, 
            survey_questions.question_id, survey_questions.group_id,question_groups.id');
        $this->db->from('survey_questions');  
        $this->db->join('question_groups', 'question_groups.id=survey_questions.group_id', 'left');
        $this->db->where('question_id', $this->uri->segment(3));
        $result=$this->db->get();
              return $result->result();
    }

    public function update_question() 
    {
        if (null !==($this->input->post('submit'))) {
            foreach($this->input->post('is_reverse') as $is_reverse) {
                foreach($this->input->post('group_id') as $group_id) {
                    $data = array(
                        'question' => $this->input->post('question'),
                        'group_id' => $group_id,
                        'is_reverse' => $is_reverse
                    );

                    $this->db->where('question_id', $this->uri->segment(4));
                    $this->db->update('survey_questions', $data);
                }
            }
            if($this->db->affected_rows() > 0)
            {
                
                return true;
            } 
            return false;
        
        }
    }

    public function is_approved_user() {
        $this->db->select('*');
        $this->db->from('users');  
        $this->db->where('user_id', $this->session->userdata['user_id']);
        $this->db->where('is_approved', '1');
        $result=$this->db->get();
          
            if($result->num_rows() > 0)
            {                
                return true;
            } 
            return false;
    }
    public function is_active_user() {
        $this->db->select('*');
        $this->db->from('users');         
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('deactivated_at = "0000-00-00 00:00:00" || deactivated_at IS NULL ');
        $result=$this->db->get();
          
            if($result->num_rows() > 0)
            {
                return $result->row_array();

            } 
            return false;           
    }
     
    public function student_results_show() {
        $this->db->select('*');
        $this->db->from('survey_answers');  
        $this->db->join('survey_questions', 'survey_questions.question_id=survey_answers.question_id');
        $this->db->join('users', 'users.user_id=survey_answers.user_id');
        $this->db->join('schools', 'schools.school_id=users.school_id');
        $this->db->order_by('survey_answers.user_id, survey_answers.question_id');
        $result=$this->db->get();
              return $result->result();
    }

    public function average_results() {
        $this->db->select('*');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');  
        $this->db->join('survey_questions', 'survey_questions.question_id=survey_answers.question_id');
        $this->db->join('users', 'users.user_id=survey_answers.user_id');
        $this->db->group_by('survey_answers.question_id');
        $result=$this->db->get();
            return $result->result();
    }

    public function regions_show() {
        $this->db->select('region');
        $this->db->distinct('region'); 
        $this->db->from('schools');  
        $result=$this->db->get();
            return $result->result();
    }

    public function school_show() {
        $this->db->select('school_name, school_id');    
        $this->db->from('schools');  
        $result=$this->db->get();
            return $result->result();
    }

    public function classes_show() {
        $this->db->select('*');
        $this->db->from('classes');  
        $result=$this->db->get();
            return $result->result();
    }

    public function class_divisions_show() {
        $this->db->select('*');
        $this->db->from('class_divisions');  
        $result=$this->db->get();
            return $result->result();
    }

    public function teachers_show() {
        $this->db->select('*');
        $this->db->from('teacher_student_conn');  
        $this->db->join('users','teacher_student_conn.teacher_id=users.user_id');  
        $this->db->where("student_id", $this->session->userdata['user_id']);
        $result=$this->db->get();
            return $result->result();
    }

    public function subjects_show_by_teacher($teacher) {

        if ($teacher) {
            $this->db->select('teacher_subject_id, subject_name');
            $this->db->from('teacher_subject');  
            $this->db->join('subjects','teacher_subject.subject_id=subjects.subject_id');  
            $this->db->where("teacher_subject.teacher_id", $teacher);
            $query=$this->db->get();
                if ($query->num_rows() > 0) {
                    return $query->result();
                } else {
                    return FALSE;
                }
        }
    }

    public function get_schools_by_region($region = null) {
        if ($region) {
            $this->db->select('school_id, school_name');
            $this->db->from('schools');
            $this->db->where("region", $region);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            }
        }

    }
    
    public function get_teachers_by_school($school = null) {
        if ($school) {
            $this->db->select('user_id, username');
            $this->db->from('users');
            $this->db->where("role_id",'2');
            $this->db->join("schools",'schools.school_id=users.school_id');
            $this->db->where("schools.school_id", $school);
            $query = $this->db->get();

            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            }
        }
    }
   

}

   