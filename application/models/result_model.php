<?php
class Result_model extends CI_Model {
    public function __construct() {
        parent:: __construct();       
    }

    /* Show number of answer rows of a survey */ 
    public function total_rows()
    {
   		$this->db->select('*');
	    $this->db->from('survey_answers');
	    $this->db->join('survey_questions', 'survey_questions.question_id=
	    survey_answers.question_id	');
        $this->db->where('survey_id', '1');
	    $this->db->group_by('survey_answers.question_id');
	    
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
    /* Show average answers of questions of student for student role*/
    public function average_student_result($user_id)
    {           
        
        $first_year = $this->uri->segment(5);
        $next_year = $first_year + 1;

        $this->db->select('survey_questions.question,survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left'); 

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');

        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id');
          
        $this->db->where('survey_answers.user_id', $user_id); 
        
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));       
       
        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');
        
        $this->db->group_by('survey_answers.question_id');
        $this->db->order_by('survey_answers.question_id');
        
        $query=$this->db->get();
        return $query->result_array();  

    }
    /* Show average answers of questions of student's class for student role */
     public function average_student_class_results($user_id)
    { 
        $first_year = $this->uri->segment(5);
        $next_year = $first_year + 1;

        $this->db->select('survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
        
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left'); 

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');

        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id');
          
        $this->db->where('survey_answers.user_id', $user_id); 
        
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));       
       
        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');
        
        $this->db->group_by('survey_answers.question_id');
        $this->db->order_by('survey_answers.question_id');
        
        $query=$this->db->get();
        $student = $query->result_array();

        $rows = array();
        foreach($student as $row)
        {
            
            $rows[] = $row['question_id'];
        } 

        /* average class results  */      

        $this->db->select('school_id,class,division');
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $result=$this->db->get();
        $user=$result->row_array();  
       
        $this->db->select('survey_questions.question,survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left');

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');
 
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id'); 
        $this->db->join('users', 'users.user_id=
        survey_answers.user_id'); 
       
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));

        $this->db->where('users.school_id', $user['school_id']); 
        $this->db->where('users.class', $user['class']); 
        $this->db->where('users.division', $user['division']);

        $this->db->where_in('survey_questions.question_id', $rows); 

        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');

        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        return $query->result_array();

    }
     /* Show average answers of questions  of school where user studies*/
    /*public function average_student_results($student)
    {     

        $this->db->select('survey_questions.question');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id  '); 
         $this->db->join('users', 'users.user_id=
        survey_answers.user_id'); 
        $this->db->where('users.user_id', $student); 
        $this->db->where('survey_id', $this->uri->segment(3));
        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        return $query->result_array();

    }*/
    public function average_student_results($user_id) {
        $first_year = $this->uri->segment(5);
        $next_year = $first_year + 1;

        $this->db->select('survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
        
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left'); 

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');

        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id');
          
        $this->db->where('survey_answers.user_id', $user_id); 
        
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));       
       
        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');
        
        $this->db->group_by('survey_answers.question_id');
        $this->db->order_by('survey_answers.question_id');
        
        $query=$this->db->get();
        $student = $query->result_array();

        $rows = array();
        foreach($student as $row)
        {
            
            $rows[] = $row['question_id'];
        } 
        /* average results of all */


        $this->db->select('survey_questions.question,survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left'); 

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id');

        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));       
        $this->db->where('student_surveys.survey_id',$this->uri->segment(3));

        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"'); 
        $this->db->where_in('survey_questions.question_id',$rows);
        
        $this->db->group_by('survey_answers.question_id');
        $this->db->order_by('survey_answers.question_id');
        
        $query=$this->db->get();
        return $query->result_array();

    }
   

    /* Show average answers of questions  of school where user studies*/
    public function average_school_student_results($user_id)
    {     

        $first_year = $this->uri->segment(5);
        $next_year = $first_year + 1;

        $this->db->select('survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
        
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left'); 

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');

        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id');
          
        $this->db->where('survey_answers.user_id', $user_id); 
        
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));       
       
        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');
        
        $this->db->group_by('survey_answers.question_id');
        $this->db->order_by('survey_answers.question_id');
        
        $query=$this->db->get();
        $student = $query->result_array();

        $rows = array();
        foreach($student as $row)
        {
            
            $rows[] = $row['question_id'];
        } 
        /* average school student results */

        $this->db->select('school_id,class,division');
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $result=$this->db->get();
        $user=$result->row_array();     

        $this->db->select('survey_questions.question,survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left'); 

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');

        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id'); 
        $this->db->join('users', 'users.user_id=
        survey_answers.user_id'); 
        
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));

        $this->db->where('users.school_id', $user['school_id']);

        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"'); 
         $this->db->where_in('survey_questions.question_id', $rows);

        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        return $query->result_array();

    }
    
     /* Show average answers for coordinator's schools */
    public function coord_school_results($school_id)
    {     

        $this->db->select('survey_questions.question');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id  '); 
         $this->db->join('users', 'users.user_id=
        survey_answers.user_id'); 
        $this->db->where('users.school_id', $school_id); 
        $this->db->where('survey_id', $this->uri->segment(3));
        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        return $query->result_array();

    }
   
   
    /* Show classes of teacher's school*/
    public function teacher_classes_show($user_id)
    {   
        $date = new DateTime("now"); 
        $now = $date->format('Y-m-d');
        $current_year = $date->format('Y');
        $last_year =  $current_year - 1; 
        $next_year =  $current_year + 1;  
        $mydate = $current_year."-09-15";  

        $this->db->select('users.user_id, 
            users.class, users.division,class_divisions.division as CD');
        $this->db->distinct('users.user_id,users.class, users.division,class_divisions.division');
        /*$this->db->from('users');

        $this->db->join('teacher_student_conn', 'users.user_id=
        teacher_student_conn.student_id','right');
        $this->db->join('student_surveys', 'users.user_id=student_surveys.user_id','right');
         $this->db->join('teacher_subject', 'teacher_subject.teacher_subject_id
            =student_surveys.id','right');
        $this->db->join('survey_answers', 'survey_answers.student_survey_id=student_surveys.id','right');

        $this->db->join('class_divisions', 'users.division=
        class_divisions.id');
        $this->db->where('teacher_student_conn.teacher_id', $user_id); 
        $this->db->order_by('users.class,users.division');
        $query=$this->db->get();
        return $query->result();*/

        $this->db->from('student_surveys');

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('teacher_student_conn', 'student_surveys.user_id=teacher_student_conn.student_id','right');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id','left');
        $this->db->join('survey_answers', 'student_surveys.id=survey_answers.student_survey_id','right');

        $this->db->join('users', 'student_surveys.user_id=users.user_id','left');
        $this->db->join('surveys', 'student_surveys.survey_id=surveys.survey_id','left');

        $this->db->join('class_divisions', 'class_divisions.id=users.division','left');
        $this->db->join('schools', 'schools.school_id=users.school_id');

        if($now < $mydate) {         
            $this->db->where('student_surveys.created_at < "'.$current_year . '-09-15" AND student_surveys.created_at >= "'.$last_year . '-09-15"');
        }
        else {     
            $this->db->where('student_surveys.created_at >= "'.$current_year . '-09-15" AND student_surveys.created_at < "'.$next_year . '-09-15"');
        }
  

        $this->db->where('users.deactivated_at = "0000-00-00 00:00:00" OR users.deactivated_at IS NULL ');  
        $this->db->where('student_surveys.teacher_id',$this->session->userdata('user_id'));
        $this->db->group_by('users.class,users.division');
        $this->db->order_by('users.class,users.division');
        $query=$this->db->get();
        return $query->result();

    }
     /* Show students for each class from teacher's school*/
    public function class_students_show($class, $division, $user_id)
    {     

        $this->db->select('school_id');
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $result=$this->db->get();
        $school_id=$result->row_array();

        $this->db->select('users.user_id, users.username, users.class, users.division,class_divisions.division as CD');
        $this->db->distinct('users.user_id, users.username,users.class, users.division,class_divisions.division');
        $this->db->from('users');
        $this->db->join('class_divisions', 'users.division=
        class_divisions.id');
        $this->db->where('users.school_id', $school_id['school_id']); 
        $this->db->where('users.class', $class); 
        $this->db->where('users.division', $division); 
        $this->db->where('users.role_id', '1'); //students
        $this->db->order_by('users.class');
        $query=$this->db->get();
        return $query->result();

    }
    
     /* Show classes of teacher's school*/
    public function coord_schools_show($user_id)
    {     

        $this->db->select('school_id');
        $this->db->from('coordinator_teacher_conn');
        $this->db->join('users','coordinator_teacher_conn.teacher_id=users.user_id','left');
        $this->db->where('coordinator_id', $user_id);
        $result=$this->db->get();
       
        $school_id = array();
        foreach ($result->result_array() as $school)
        {
            $school_id[] = $school['school_id'];
        }

    
        if(!empty($school_id)) {
            $this->db->select('schools.school_name, users.school_id');
            $this->db->distinct('users.school_id,schools.school_name');
            $this->db->from('users');
            $this->db->join('schools', 'users.school_id=
            schools.school_id');
            $this->db->where_in('users.school_id', $school_id); 
            $this->db->order_by('schools.school_name');
            $query=$this->db->get();
            return $query->result();
        }

    }
    /* Show average answers of questions  of school where student studies*/
    public function average_class_result($user_id)
    {     

        $this->db->select('school_id, class, division');
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $result=$this->db->get();
        $user=$result->row_array();

        $this->db->select('survey_questions.question');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id  '); 
        $this->db->join('users', 'users.user_id=
        survey_answers.user_id  '); 
        $this->db->where('users.school_id', $user['school_id']); 
        $this->db->where('users.class', $user['class']); 
        $this->db->where('users.division', $user['division']); 
        $this->db->where('survey_id', $this->uri->segment(3));
        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        return $query->result_array();

    }
     /* Show average answers of questions in teacher's school classes*/
    public function average_class_results($user_id,$class,$division)
    {     

        $this->db->select('school_id');
        $this->db->from('users');
        $this->db->where('user_id', $user_id);
        $result=$this->db->get();
        $user=$result->row_array();

        $this->db->select('survey_questions.question');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id  '); 
        $this->db->join('users', 'users.user_id=
        survey_answers.user_id  '); 
        $this->db->where('users.school_id', $user['school_id']); 
        $this->db->where('users.class', $class); 
        $this->db->where('users.division', $division); 
        $this->db->where('survey_id', $this->uri->segment(3));
        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        return $query->result_array();

    }
    /* Query for all student results */
    public function student_results_generate() {
      $this->db->select(' users.first_name,users.last_name,users.username, users.user_id,users.location, schools.school_name,
        users.class, class_divisions.division,users.gender, users.birth_day, users.birth_month, users.birth_year, users.language,
         student_surveys.school_year,surveys.survey_name,  T.first_name as teacher_first_name, T.last_name as teacher_last_name,subjects.subject_name,
          survey_questions.question, survey_answers.question_id,survey_answers.answer, survey_questions.code, is_reverse,
         
        scale, emotion_component, c_emotional_experience, time, emotions,student_surveys.created_at');
        $this->db->from('survey_answers');  
        $this->db->join('student_surveys', 'survey_answers.student_survey_id=student_surveys.id');
        
        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');

        $this->db->join('survey_questions', 'survey_questions.question_id=survey_answers.question_id');
        $this->db->join('users', 'users.user_id=survey_answers.user_id');
        $this->db->join('schools', 'schools.school_id=users.school_id','left');
        $this->db->join('class_divisions', 'class_divisions.id=users.division','left');
        $this->db->join('surveys', 'surveys.survey_id=survey_questions.survey_id');
        $this->db->join('users AS T', 'student_surveys.teacher_id=T.user_id');
        //$this->db->order_by('survey_answers.user_id, survey_answers.question_id');
        return $result=$this->db->get();
              
    }
    /* Show student results - limit 2500 */
    public function student_results_show() {
        $this->db->select('users.username, users.first_name, users.location,users.gender, users.birth_day, users.birth_month, users.birth_year, 
            users.language, users.last_name,users.user_id,survey_answers.answer,survey_answers.question_id, 
        users.class, class_divisions.division, student_surveys.school_year,surveys.survey_name, T.first_name as teacher_first_name, T.last_name as teacher_last_name,
        subjects.subject_name,student_surveys.created_at, schools.school_name,
        survey_questions.code, is_reverse, survey_questions.question, scale, emotion_component, c_emotional_experience, time, emotions');
        $this->db->from('survey_answers');  
        $this->db->join('student_surveys', 'survey_answers.student_survey_id=student_surveys.id');

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');

        $this->db->join('survey_questions', 'survey_questions.question_id=survey_answers.question_id');
        $this->db->join('users', 'users.user_id=survey_answers.user_id');
        $this->db->join('schools', 'schools.school_id=users.school_id','left');
        $this->db->join('class_divisions', 'class_divisions.id=users.division','left');
        $this->db->join('surveys', 'surveys.survey_id=survey_questions.survey_id');
        $this->db->join('users AS T', 'student_surveys.teacher_id=T.user_id');
        //$this->db->order_by('survey_answers.user_id, survey_answers.question_id');
        $this->db->limit('2500');
        $this->db->order_by('survey_answers.created_at','DESC');
        
        $result=$this->db->get();
              return $result->result();
    }
    /* Show average answers of questions */
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
    
    public function admin_results_show()
    {     

     $date = new DateTime("now"); 
     $now=$date->format('Y-m-d'); 
     $current_year=date('Y');
     $last_year =  $current_year -1; 
     $next_year = $current_year +1; 
     $mydate = $current_year."-09-15";
   

        $this->db->select('users.user_id, 
            users.first_name, users.last_name, T.first_name as TF, T.last_name as TL,
            users.username,T.user_id AS TU,T.username AS T,  student_surveys.teacher_id,
            surveys.survey_name,
            S.class as student_class, T.class, T.school_id,S.division as student_division,schools.school_name');      
        $this->db->select('GROUP_CONCAT(DISTINCT T.first_name ) as teacher_first_name');
        $this->db->select('GROUP_CONCAT(DISTINCT T.last_name ) as teacher_last_name');
      
        $this->db->select('GROUP_CONCAT(DISTINCT SS.class) as student_class');
        $this->db->select('GROUP_CONCAT(DISTINCT class_divisions.division) as division');
        $this->db->select('GROUP_CONCAT(DISTINCT SS.division) as division_id');
       
        $this->db->select('GROUP_CONCAT(SS.school_id) as teacher_school');
        $this->db->select('GROUP_CONCAT(surveys.survey_name) as name');

        $this->db->select('GROUP_CONCAT(teacher_subject.subject_id) as subject_id');
        $this->db->select('GROUP_CONCAT(subjects.subject_name) as subject_name');
        $this->db->select('COUNT(DISTINCT(student_surveys.user_id)) AS count_students');

        $this->db->select('GROUP_CONCAT(DISTINCT student_surveys.survey_id) as survey_id');
       
        $this->db->from('coordinator_teacher_conn');  

        $this->db->join('users', 'coordinator_teacher_conn.coordinator_id=users.user_id','left');
        $this->db->join('users AS T', 'coordinator_teacher_conn.teacher_id=T.user_id','left');
        $this->db->join('teacher_student_conn', 'teacher_student_conn.teacher_id=T.user_id','right');
        $this->db->join('users as S', 'teacher_student_conn.student_id=S.user_id','left');

        $this->db->join('student_surveys', 'student_surveys.teacher_id=T.user_id','right');
        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id','left');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id','left');
        $this->db->join('survey_answers', 'student_surveys.id=survey_answers.student_survey_id','right');

        $this->db->join('users as SS', 'student_surveys.user_id=SS.user_id','left');
         
        $this->db->join('surveys', 'student_surveys.survey_id=surveys.survey_id','left');

        $this->db->join('class_divisions', 'class_divisions.id=SS.division','left');
        $this->db->join('schools', 'schools.school_id=T.school_id');   
      
     
        if($now < $mydate) {         
            $this->db->where('student_surveys.created_at < "'.$current_year . '-09-15" AND student_surveys.created_at >= "'.$last_year . '-09-15"');
        }
        else {     
            $this->db->where('student_surveys.created_at >= "'.$current_year . '-09-15" AND student_surveys.created_at < "'.$next_year . '-09-15"');
        }

        $this->db->where('(users.deactivated_at = "0000-00-00 00:00:00" OR users.deactivated_at IS NULL )
          AND (T.deactivated_at = "0000-00-00 00:00:00" OR T.deactivated_at IS NULL)');  
        $this->db->group_by("users.user_id,T.user_id,SS.class,SS.division,student_surveys.survey_id,teacher_subject.subject_id");
        $this->db->order_by("users.user_id,T.user_id,SS.class");
        $result=$this->db->get();     
        return $result->result_array();  


    }

    public function coordinator_teachers_show()
    {     

     $date = new DateTime("now"); 
     $now=$date->format('Y-m-d'); 
     $current_year=date('Y');
     $last_year =  $current_year -1; 
     $next_year = $current_year +1; 
     $mydate = $current_year."-09-15";
   

        $this->db->select('users.user_id, 
            users.first_name, users.last_name, T.first_name as TF, T.last_name as TL,
            users.username,T.user_id AS TU,T.username AS T,  student_surveys.teacher_id,
            surveys.survey_name,
            S.class as student_class, T.class, T.school_id,S.division as student_division,schools.school_name');      
        $this->db->select('GROUP_CONCAT(DISTINCT T.first_name ) as teacher_first_name');
        $this->db->select('GROUP_CONCAT(DISTINCT T.last_name ) as teacher_last_name');
      
        $this->db->select('GROUP_CONCAT(DISTINCT SS.class) as student_class');
        $this->db->select('GROUP_CONCAT(DISTINCT class_divisions.division) as division');
        $this->db->select('GROUP_CONCAT(DISTINCT SS.division) as division_id');
       
        $this->db->select('GROUP_CONCAT(SS.school_id) as teacher_school');
        $this->db->select('GROUP_CONCAT(surveys.survey_name) as name');

        $this->db->select('GROUP_CONCAT(teacher_subject.subject_id) as subject_id');
        $this->db->select('GROUP_CONCAT(subjects.subject_name) as subject_name');
        $this->db->select('COUNT(DISTINCT(student_surveys.user_id)) AS count_students');

        $this->db->select('GROUP_CONCAT(DISTINCT student_surveys.survey_id) as survey_id');
       
        $this->db->from('coordinator_teacher_conn');  

        $this->db->join('users', 'coordinator_teacher_conn.coordinator_id=users.user_id','left');
        $this->db->join('users AS T', 'coordinator_teacher_conn.teacher_id=T.user_id','left');
        $this->db->join('teacher_student_conn', 'teacher_student_conn.teacher_id=T.user_id','right');
        $this->db->join('users as S', 'teacher_student_conn.student_id=S.user_id','left');

        $this->db->join('student_surveys', 'student_surveys.teacher_id=T.user_id','right');
        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id','left');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id','left');
        $this->db->join('survey_answers', 'student_surveys.id=survey_answers.student_survey_id','right');

        $this->db->join('users as SS', 'student_surveys.user_id=SS.user_id','left');
         
        $this->db->join('surveys', 'student_surveys.survey_id=surveys.survey_id','left');

        $this->db->join('class_divisions', 'class_divisions.id=SS.division','left');
        $this->db->join('schools', 'schools.school_id=T.school_id');   
      
     
        if($now < $mydate) {         
            $this->db->where('student_surveys.created_at < "'.$current_year . '-09-15" AND student_surveys.created_at >= "'.$last_year . '-09-15"');
        }
        else {     
            $this->db->where('student_surveys.created_at >= "'.$current_year . '-09-15" AND student_surveys.created_at < "'.$next_year . '-09-15"');
        }

        $this->db->where('(users.deactivated_at = "0000-00-00 00:00:00" OR users.deactivated_at IS NULL )
          AND (T.deactivated_at = "0000-00-00 00:00:00" OR T.deactivated_at IS NULL)');  
        $this->db->group_by("users.user_id,T.user_id,SS.class,SS.division,student_surveys.survey_id,teacher_subject.subject_id");
        $this->db->order_by("users.user_id,T.user_id,SS.class");
        $result=$this->db->get();     
        return $result->result_array();  


    }
    public function teacher_results_show() {

        $this->db->select('student_surveys.teacher_id, surveys.survey_name,
        schools.school_name');      

        $this->db->select('GROUP_CONCAT(DISTINCT SS.class) as student_class');
        $this->db->select('GROUP_CONCAT(DISTINCT class_divisions.division) as division');
        $this->db->select('GROUP_CONCAT(DISTINCT SS.division) as division_id');
       
        $this->db->select('GROUP_CONCAT(SS.school_id) as teacher_school');
        $this->db->select('GROUP_CONCAT(surveys.survey_name) as name');

        $this->db->select('GROUP_CONCAT(teacher_subject.subject_id) as subject_id');
        $this->db->select('GROUP_CONCAT(subjects.subject_name) as subject_name');
        $this->db->select('COUNT(DISTINCT(student_surveys.user_id)) AS count_students');

        $this->db->select('GROUP_CONCAT(DISTINCT student_surveys.survey_id) as survey_id');
      
        $this->db->from('student_surveys'); 
        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id','left');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id','left');

        $this->db->join('survey_answers', 'student_surveys.id=survey_answers.student_survey_id','right');
        $this->db->join('users as SS', 'student_surveys.user_id=SS.user_id','left');
         
        $this->db->join('surveys', 'student_surveys.survey_id=surveys.survey_id','left');

        $this->db->join('class_divisions', 'class_divisions.id=SS.division','left');
        $this->db->join('schools', 'schools.school_id=SS.school_id');   
       
     
        $date = new DateTime("now"); 
        $now=$date->format('Y-m-d');
        $current_year = $date->format('Y');
        $last_year =  $current_year - 1; 
        $next_year =  $current_year + 1;   
        $mydate = $current_year."-09-15";

       if($now < $mydate) {         
            $this->db->where('student_surveys.created_at < "'.$current_year . '-09-15" AND student_surveys.created_at >= "'.$last_year . '-09-15"');
        }
        else {     
            $this->db->where('student_surveys.created_at >= "'.$current_year . '-09-15" AND student_surveys.created_at < "'.$next_year . '-09-15"');
        }


        $this->db->where('SS.deactivated_at = "0000-00-00 00:00:00" OR SS.deactivated_at IS NULL ');  
        $this->db->where('student_surveys.teacher_id',$this->session->userdata('user_id'));
        $this->db->group_by("SS.class,SS.division,student_surveys.survey_id,student_surveys.subject_id");
        $this->db->order_by("SS.class");
        $result=$this->db->get();     
        return $result->result_array();  


    }
    public function all_student_results_show() {
        $date = new DateTime("now"); 
        $now=$date->format('Y-m-d');
        $current_year = $date->format('Y');
        $last_year =  $current_year - 1;  
        $next_year =  $current_year + 1;  
        $mydate = $current_year."-09-15";

        $this->db->select('student_surveys.teacher_id,surveys.survey_name,
                    schools.school_name,
                     T.first_name as TF, T.last_name as TL,
            SS.username,T.user_id AS TU');      
        
        $this->db->select('GROUP_CONCAT(SS.school_id) as teacher_school');
        $this->db->select('GROUP_CONCAT(surveys.survey_name) as name');
        $this->db->select('GROUP_CONCAT(teacher_subject.subject_id) as subject_id');
        $this->db->select('GROUP_CONCAT(subjects.subject_name) as subject_name');
        $this->db->select('GROUP_CONCAT(DISTINCT T.first_name ) as teacher_first_name');
        $this->db->select('GROUP_CONCAT(DISTINCT T.last_name ) as teacher_last_name');

        $this->db->select('GROUP_CONCAT(DISTINCT student_surveys.survey_id) as survey_id');
      
        $this->db->from('student_surveys');

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id','left');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id','left');
        $this->db->join('survey_answers', 'student_surveys.id=survey_answers.student_survey_id','right');

        $this->db->join('users as SS', 'student_surveys.user_id=SS.user_id','left');
        $this->db->join('users as T', 'student_surveys.teacher_id=T.user_id','left');
        $this->db->join('surveys', 'student_surveys.survey_id=surveys.survey_id','left');

        $this->db->join('class_divisions', 'class_divisions.id=SS.division','left');
        $this->db->join('schools', 'schools.school_id=SS.school_id');   

        if($now < $mydate) {         
            $this->db->where('student_surveys.created_at < "'.$current_year . '-09-15" AND student_surveys.created_at >= "'.$last_year . '-09-15"');
        }
        else {     
            $this->db->where('student_surveys.created_at >= "'.$current_year . '-09-15" AND student_surveys.created_at < "'.$next_year . '-09-15"');
        }

        $this->db->where('SS.deactivated_at = "0000-00-00 00:00:00" OR SS.deactivated_at IS NULL ');  
        $this->db->where('student_surveys.user_id',$this->session->userdata('user_id'));
        $this->db->group_by("student_surveys.survey_id,teacher_subject.subject_id");
        $this->db->order_by("student_surveys.survey_id");
        $result=$this->db->get();     
        return $result->result_array();  

    }
    /* Show student results for teacher role */
    public function student_result($user_id) 
    {
        $date = new DateTime("now"); 
        $now=$date->format('Y-m-d');
        $current_year = $date->format('Y');
        $last_year =  $current_year - 1; 
        $next_year =  $current_year + 1;    
        $mydate = $current_year."-09-15";

        $this->db->select('surveys.survey_name, schools.school_name, SS.username');      
        
        $this->db->select('GROUP_CONCAT(surveys.survey_name) as name');
        $this->db->select('GROUP_CONCAT(teacher_subject.subject_id) as subject_id');
        $this->db->select('GROUP_CONCAT(subjects.subject_name) as subject_name');
        $this->db->select('GROUP_CONCAT(DISTINCT SS.first_name ) as student_first_name');
        $this->db->select('GROUP_CONCAT(DISTINCT SS.user_id ) as user_id');
        $this->db->select('GROUP_CONCAT(DISTINCT SS.last_name ) as student_last_name');

        $this->db->select('GROUP_CONCAT(DISTINCT student_surveys.survey_id) as survey_id');
      
        $this->db->from('student_surveys');

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id','left');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id','left');
        $this->db->join('survey_answers', 'student_surveys.id=survey_answers.student_survey_id','right');

        $this->db->join('users as SS', 'student_surveys.user_id=SS.user_id','left');
        $this->db->join('surveys', 'student_surveys.survey_id=surveys.survey_id','left');

        $this->db->join('class_divisions', 'class_divisions.id=SS.division','left');
        $this->db->join('schools', 'schools.school_id=SS.school_id');   

        if($now < $mydate) {         
            $this->db->where('student_surveys.created_at < "'.$current_year . '-09-15" AND student_surveys.created_at >= "'.$last_year . '-09-15"');
        }
        else {     
            $this->db->where('student_surveys.created_at >= "'.$current_year . '-09-15" AND student_surveys.created_at < "'.$next_year . '-09-15"');
        }

        $this->db->where('SS.deactivated_at = "0000-00-00 00:00:00" OR SS.deactivated_at IS NULL ');  
        $this->db->where('student_surveys.teacher_id',$this->session->userdata('user_id'));
        $this->db->where('SS.class',$this->uri->segment(3));
        $this->db->where('SS.division',$this->uri->segment(4));
        $this->db->group_by("student_surveys.survey_id,teacher_subject.subject_id,SS.user_id");
        $this->db->order_by("student_surveys.survey_id,SS.first_name,teacher_subject.subject_id");
        $result=$this->db->get();     
        return $result->result_array();  

    }


    /* Show average answers of questions  of school where user studies*/
    public function admin_school_results_show()
    {  
        $first_year = $this->uri->segment(8);
        $next_year = $first_year + 1; 

        $this->db->select('survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
      
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left');

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');
 
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id'); 
        $this->db->join('users', 'users.user_id=
        survey_answers.user_id'); 
        $this->db->where('users.school_id', $this->uri->segment(4)); 
        $this->db->where('users.class', $this->uri->segment(5)); 
        $this->db->where('users.division', $this->uri->segment(6)); 
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(7));

        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');

        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        $class=$query->result_array();
     

        $rows = array();
        foreach($class as $row)
        {
            
            $rows[] = $row['question_id'];
        }

        /* school */  

        $this->db->select('survey_questions.question');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id'); 

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');


        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id'); 
        $this->db->join('users', 'users.user_id=
        survey_answers.user_id'); 
        $this->db->where('users.school_id', $this->uri->segment(4)); 
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(7));

         $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');

        $this->db->where_in('survey_questions.question_id', $rows);

        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        return $query->result_array();

    }
    /* Show average answers of classes - for admin role */
    public function admin_class_results_show()
    {     
        $first_year = $this->uri->segment(8);
        $next_year = $first_year + 1;

        $this->db->select('survey_questions.question');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left');

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');
 
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id'); 
        $this->db->join('users', 'users.user_id=
        survey_answers.user_id'); 
        $this->db->where('users.school_id', $this->uri->segment(4)); 
        $this->db->where('users.class', $this->uri->segment(5)); 
        $this->db->where('users.division', $this->uri->segment(6)); 
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(7));

        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');

        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        return $query->result_array();

    }
     /* Show average answers of classes - for teacher role */
    public function student_class_results_show($user_id=null)
    {   
        $first_year = $this->uri->segment(6);
        $next_year = $first_year + 1;

        $this->db->select('school_id,class,division');
        $this->db->from('users');
        $this->db->where('user_id', $this->uri->segment(5));
        $result=$this->db->get();
        $user=$result->row_array();  
       
        $this->db->select('survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');

        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left');

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');
 
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id'); 
        $this->db->join('users', 'users.user_id=
        survey_answers.user_id'); 
       
        $this->db->where('student_surveys.teacher_id', $user_id); 
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));

        $this->db->where('users.school_id', $user['school_id']); 
        $this->db->where('users.class', $user['class']); 
        $this->db->where('users.division', $user['division']); 

        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');

        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        $student=$query->result_array();
       
        $question=array();
        $rows = array();
        foreach($student as $row)
        {
            
            $rows[] = $row['question_id'];
        }
        /* class */

        $this->db->select('school_id,class,division');
        $this->db->from('users');
        $this->db->where('user_id', $this->uri->segment(5));
        $result=$this->db->get();
        $user=$result->row_array();  
       
        $this->db->select('survey_questions.question,survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left');

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');
 
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id'); 
        $this->db->join('users', 'users.user_id=
        survey_answers.user_id'); 
       
        $this->db->where('student_surveys.teacher_id', $user_id); 
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));

        $this->db->where('users.school_id', $user['school_id']); 
        $this->db->where('users.class', $user['class']); 
        $this->db->where('users.division', $user['division']); 

        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');

        $this->db->where_in('survey_questions.question_id', $rows);

        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        return $query->result_array();

    }
    public function student_school_results_show($user_id)
    {
        $first_year = $this->uri->segment(6);
        $next_year = $first_year + 1;

        $this->db->select('survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
     
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left'); 

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');

        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id');
          
        if($user_id) {
            $this->db->join('users', 'users.user_id=
            survey_answers.user_id'); 
            $this->db->where('survey_answers.user_id', $this->uri->segment(5)); 
        }   
        $this->db->where('student_surveys.teacher_id', $this->session->userdata['user_id']);  
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));       
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));

         $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');

        
        $this->db->group_by('survey_answers.question_id');
        $this->db->order_by('survey_answers.question_id');
        
        $query=$this->db->get();
        $student=$query->result_array();
       
        $question=array();
        $rows = array();
        foreach($student as $row)
        {
            
            $rows[] = $row['question_id'];
        }
        /* school */

        $this->db->select('school_id,class,division');
        $this->db->from('users');
        $this->db->where('user_id', $this->uri->segment(5));
        $result=$this->db->get();
        $user=$result->row_array();     

        $this->db->select('survey_questions.question,survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left'); 

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');

        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id'); 
        $this->db->join('users', 'users.user_id=
        survey_answers.user_id'); 
        
        $this->db->where('student_surveys.teacher_id', $user_id); 
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));

        $this->db->where('users.school_id', $user['school_id']);

        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"'); 

        $this->db->where_in('survey_questions.question_id', $rows);
       
        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        return $query->result_array();

    }
    /* Average answer of question of all - used for student role */
    public function student_result_question($user_id = 0)
    {  
        $first_year = $this->uri->segment(6);
        $next_year = $first_year + 1;

        $this->db->select('survey_questions.question,survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left'); 

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');

        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id');
          
        if($user_id) {
            $this->db->join('users', 'users.user_id=
            survey_answers.user_id'); 
            $this->db->where('survey_answers.user_id', $this->uri->segment(5)); 
        }   
        $this->db->where('student_surveys.teacher_id', $this->session->userdata['user_id']);  
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));       
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));

         $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');

        
        $this->db->group_by('survey_answers.question_id');
        $this->db->order_by('survey_answers.question_id');
        
        $query=$this->db->get();
        return $query->result_array();
        /*$query=("SELECT question,AVG(answer) FROM survey_answers 
            JOIN student_surveys ON student_surveys.id= survey_answers.student_survey_id 
            LEFT JOIN teacher_subject ON student_surveys.subject_id=teacher_subject.teacher_subject_id 
            JOIN subjects ON subjects.subject_id=teacher_subject.subject_id 
            JOIN survey_questions ON survey_questions.question_id= survey_answers.question_id 
            WHERE student_surveys.survey_id=1 AND teacher_subject.subject_id=6 AND student_surveys.teacher_id=1 
            GROUP BY survey_answers.question_id ORDER BY survey_answers.question_id ");
         $result = $this->db->query($query);
      return $result->result_array();*/
    }
    public function all_students_result() {
        $first_year = $this->uri->segment(6);
        $next_year = $first_year + 1;

        $this->db->select('survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
       
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left'); 

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id');
 
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));       
        $this->db->where('student_surveys.survey_id',$this->uri->segment(3));

         $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"'); 
         $this->db->where('survey_answers.user_id', $this->uri->segment(5));
        
        $this->db->group_by('survey_answers.question_id');
        $this->db->order_by('survey_answers.question_id');
        
        $query=$this->db->get();
        $student = $query->result_array();

        $rows = array();
        foreach($student as $row)
        {
            
            $rows[] = $row['question_id'];
        }
        /* all results */

        $this->db->select('survey_questions.question,survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left'); 

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id');

        // $this->db->where('student_surveys.teacher_id', $this->session->userdata['user_id']);  
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(4));       
        $this->db->where('student_surveys.survey_id',$this->uri->segment(3));

         $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"'); 

        $this->db->where_in('survey_questions.question_id',$rows);
        
        $this->db->group_by('survey_answers.question_id');
        $this->db->order_by('survey_answers.question_id');
        
        $query=$this->db->get();
        return $query->result_array();

    }
    
      
    /* Average answer of question of all - used for admin role */
     public function result_question($user_id = 0)
    {   
        $first_year = $this->uri->segment(8);
        $next_year = $first_year + 1;

        $this->db->select('survey_questions.question_id');
        $this->db->distinct('survey_questions.question_id');
      
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id','left');

        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');
 
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id'); 
        $this->db->join('users', 'users.user_id=
        survey_answers.user_id'); 
        $this->db->where('users.school_id', $this->uri->segment(4)); 
        $this->db->where('users.class', $this->uri->segment(5)); 
        $this->db->where('users.division', $this->uri->segment(6)); 
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(7));

        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');

        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        $class = $query->result_array();

        $rows = array();
        foreach($class as $row)
        {
            
            $rows[] = $row['question_id'];
        }
        /* average results of all filled */

       

        $this->db->select('survey_questions.question');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id'); 
        $this->db->join('teacher_subject', 'student_surveys.subject_id=teacher_subject.teacher_subject_id');
        $this->db->join('subjects', 'subjects.subject_id=teacher_subject.subject_id');
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id');   
        if($user_id) {
            $this->db->where('survey_answers.user_id', $user_id);     
        }
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        $this->db->where('teacher_subject.subject_id', $this->uri->segment(7));

        $this->db->where('student_surveys.created_at >= "'.$first_year . '-09-15" 
            AND student_surveys.created_at < "'.$next_year . '-09-15"');

        $this->db->where_in('survey_questions.question_id', $rows);
        
        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        return $query->result_array();

    }

    /* public function result_question($user_id = 0)
    {           
        $this->db->select('survey_questions.question');
        $this->db->distinct('survey_questions.question_id');
        $this->db->select_avg('answer');
        $this->db->from('survey_answers');
        $this->db->join('student_surveys', 'student_surveys.id=
        survey_answers.student_survey_id'); 
        $this->db->join('survey_questions', 'survey_questions.question_id=
        survey_answers.question_id');   
        if($user_id) {
            $this->db->where('survey_answers.user_id', $user_id);     
        }
        $this->db->where('student_surveys.survey_id', $this->uri->segment(3));
        if($this->uri->segment(7)) {
            $this->db->where('subject_id', $this->uri->segment(7));
        }
        $this->db->order_by('survey_answers.question_id');
        $this->db->group_by('survey_answers.question_id');
        $query=$this->db->get();
        return $query->result_array();

    }
*/


}



