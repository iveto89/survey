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
            'gender'=>$this->input->post('gender'),
            'birth_day'=>$this->input->post('birth_day'),
            'birth_month'=>$this->input->post('birth_month'),
            'birth_year'=>$this->input->post('birth_year'),
            'ethnic_origin'=>$this->input->post('ethnic_origin'),
            'created_at'=>$date->format('Y-m-d H:i:s')
           
        );
        
        $this->db->insert('users',$data);
	    $insert_id =$this->db->insert_id();
        $this->input->post($insert_id);

         if ($this->input->post('role_id')) {
            $possible_values = array(1, 2, 5);
            
            foreach ($possible_values as $value) 
            {
                if ($this->input->post('role_id') == $value) {

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
        }        if ($this->input->post('class')) {
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
        //if ($this->input->post('role_id')=='1') {
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
     //}
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
        
        $query=$this->db->get();
           
        if ($query->num_rows() > 0)
        {   
            if (is_null($query->row('deactivated_at')) OR ($query->row('deactivated_at') == "0000-00-00 00:00:00"))
            {
                
                return $query->row_array();
            }
            else
            {
                
                return false;
            }
        } 
        else
        {
            
            return false;
        }       
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
     public function reject_participation() {
           $submit=$this->input->post('submit');
      $date = new DateTime("now"); 
      if(isset($submit)&&($submit=='Не искам да участвам')) {
          $data = array(         
            'participation' => $this->input->post('reject_participation')      
          );
          $this->db->where('user_id', $this->session->userdata('user_id'));
          if($this->db->update('users', $data)) {    
                  return TRUE;
          }
          else
          {
          return FALSE;
         }
         

      }
}
 public function confirm_participation() {
 $submit=$this->input->post('submit');
     if(isset($submit)&&($submit=='Искам да участвам')) {
          $data = array(         
            'participation' => $this->input->post('confirm_participation')      
          );
          $this->db->where('user_id', $this->session->userdata('user_id'));
          if($this->db->update('users', $data)) {    
                  return TRUE;
          }
          else
          {
          return FALSE;
         }
         

      }

    }
     public function select_participation() {
        $this->db->select('user_id, participation');
        $this->db->from('users');
        $this->db->where('user_id', $this->session->userdata('user_id'));
        $result=$this->db->get();
            return $result->result();



    }

    public function all_teachers_show() {
        $this->db->select('user_id, username, first_name, last_name');
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

   public function getSurvey($survey, $question = 0, $already_used = array(0))
    {

        $this->db->select('*');
        $this->db->from('survey_questions');
        $this->db->where('(deactivated_at = "0000-00-00 00:00:00" OR deactivated_at IS NULL) ');
        $this->db->where('survey_id', $survey);
        if ($question) {
            $this->db->where('question_id', $question);
        }
       
        $this->db->order_by('time');
        $this->db->order_by('question_id', 'RANDOM');
        $this->db->where_not_in('question_id', $already_used);
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

    /* public function add_teacher_subject() {

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
        $insert_id = $this->db->insert_id();
        $newdata = array('insert_id' => $insert_id);
        $this->session->set_userdata($newdata);
        return $insert_id; 
        
    }*/
 public function add_teacher_subject() {

        $date = new DateTime("now"); 
     
        
        if($this->uri->segment(3) == 3) {
            $survey3=array(
            'teacher_id'=>$this->input->post('teacher'),
            'subject_id'=>$this->input->post('subject'),
            'survey_id'=> 3,
            'user_id'=>$this->session->userdata['user_id'],
            'survey_code'=>$this->input->post('random_code'),  
            'location_filling'=>$this->input->post('location_filling'),          
            'created_at'=>$date->format('Y-m-d H:i:s')
           
        );
            $survey4=array(
            'teacher_id'=>$this->input->post('teacher'),
            'subject_id'=>$this->input->post('subject'),
            'survey_id'=> 4,
            'user_id'=>$this->session->userdata['user_id'],
            'survey_code'=>$this->input->post('random_code'),
            'location_filling'=>$this->input->post('location_filling'),            
            'created_at'=>$date->format('Y-m-d H:i:s')
           
        );
            $this->db->insert('student_surveys',$survey3);
            $this->db->insert('student_surveys',$survey4);

           // $session = array('survey' => 'survey');
           // $this->session->set_userdata($session);
                 
        } else {
            $data=array(
            'teacher_id'=>$this->input->post('teacher'),
            'subject_id'=>$this->input->post('subject'),
            'survey_id'=>$this->uri->segment(3),
            'user_id'=>$this->session->userdata['user_id'],
            'survey_code'=>$this->input->post('random_code'),   
            'location_filling'=>$this->input->post('location_filling'),         
            'created_at'=>$date->format('Y-m-d H:i:s')
           
        );
        $this->db->insert('student_surveys',$data);
        $insert_id = $this->db->insert_id();
        $newdata = array('insert_id' => $insert_id);
        $this->session->set_userdata($newdata);
        return $insert_id; 
    }
        
    }
    
   /*public function survey_fill() 
    {
       
        $insert_id = $this->session->userdata('insert_id');; 
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
                        'student_survey_id' => $insert_id
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
    } */

public function survey_fill($survey) 
    {
       
        $insert_id = $this->session->userdata('insert_id'); 
        if ($this->input->post('answer')) {
            $answers= $this->input->post('answer');           
            if (null !==($this->input->post('submit'))) {
                $date = new DateTime("now"); 
                
                if( $this->uri->segment(3) == 3 OR $this->uri->segment(3) == 4) {
                        $this->db->select('id');
                        $this->db->from('student_surveys');       
                        $this->db->where('user_id', $this->session->userdata['user_id']); 
                        $this->db->where('survey_id', $this->uri->segment(3));
                        $this->db->order_by('id', 'desc');   
                        $result=$this->db->get();
                        $insert=$result->row_array();
                    
                    foreach($answers as $question_id=>$answer)
                    {
                        $data = array(
                            'user_id'=>$this->session->userdata['user_id'],
                            'question_id'=>$question_id,
                            'answer'=>$answer,              
                            'created_at'=>$date->format('Y-m-d H:i:s'),
                            'student_survey_id' => implode(" ",$insert)
                        );
                             
                        $this->db->insert('survey_answers', $data);
                                
                    }
                } else {
                    foreach($answers as $question_id=>$answer)
                {
                    $data = array(
                        'user_id'=>$this->session->userdata['user_id'],
                        'question_id'=>$question_id,
                        'answer'=>$answer,              
                        'created_at'=>$date->format('Y-m-d H:i:s'),
                        'student_survey_id' => $insert_id
                    );
                         
                    $this->db->insert('survey_answers', $data);
                            
                }
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
        $this->db->select('users.username, users.first_name, users.location,gender, birth_day, birth_month, birth_year, ethnic_origin, users.last_name,users.user_id,survey_answers.answer,survey_answers.question_id, 
        users.class, class_divisions.division, surveys.survey_name, student_surveys.created_at, schools.school_name,
        survey_questions.code, is_reverse, survey_questions.question, scale, emotion_component, c_emotional_experience, time, emotions');
        $this->db->from('survey_answers');  
        $this->db->join('student_surveys', 'survey_answers.student_survey_id=student_surveys.id');
        $this->db->join('survey_questions', 'survey_questions.question_id=survey_answers.question_id');
        $this->db->join('users', 'users.user_id=survey_answers.user_id');
        $this->db->join('schools', 'schools.school_id=users.school_id','left');
        $this->db->join('class_divisions', 'class_divisions.id=users.division','left');
        $this->db->join('surveys', 'surveys.survey_id=survey_questions.survey_id');
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
   public function answers_show($survey_id) {
        $this->db->select('*');
        $this->db->from('answers');
       $this->db->where("survey_id", $survey_id);
 
        $result=$this->db->get();
        return $result->result_array();
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
            //$this->output->enable_profiler(TRUE);
            // $this->benchmark->mark('start');
            $this->db->select('school_id, school_name');
            $this->db->from('schools');
            $this->db->where('region', $region);
            $query = $this->db->get();

        //$this->benchmark->mark('end');
        //$this->benchmark->elapsed_time('start', 'end');
        
            if ($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            }
        }

    }
    
    public function get_teachers_by_school($school = null) {
        if ($school) {
            $this->db->select('user_id, username,first_name, last_name');
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

   