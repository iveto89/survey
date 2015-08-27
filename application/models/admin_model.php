<?php
class Admin_model extends CI_model {
	public function __construct() {
    parent:: __construct();  
  }

  /* Add new survey*/
  public function add_survey()
  {
    
    $date = new DateTime("now"); 
    
    $data = array(    
      'survey_name' => $this->input->post('add_survey'),    
      'created_at' => $date->format('Y-m-d H:i:s')          
    );

    $this->db->insert('surveys',$data);  
    if($this->db->affected_rows() > 0)
    {   
      return true;
    } 
      return false; 
    
  }

   /* Add questions to a survey */
  public function add_questions($data=array())
  {
    if(count($data) > 0)
    {
      $date = new DateTime("now"); 
      $data['question']=$this->input->post('question');
      $data['code']=$this->input->post('code');
      $data['survey_id']=$this->uri->segment(3);
      $data['group_id']=$this->input->post('group_id');
      $data['is_reverse']=$this->input->post('is_reverse');

      for($i=0;$i<count($data['question']);$i++) {
        $insert = array();
       
        $insert['question'] = $data['question'][$i]; 
        $insert['code'] = $data['code'][$i]; 
        $insert['survey_id'] =$this->uri->segment(3); 
        $insert['group_id'] = $data['group_id'][$i];
        $insert['is_reverse']=$data['is_reverse'][$i]; 
        $insert['created_at'] = $date->format('Y-m-d H:i:s');
        $this->db->insert('survey_questions',$insert);
          
        
      }
    }
  }

  /* Get survey name */
  public function surveys_show() {
    $this->db->select('surveys.survey_name, surveys.survey_id');
    $result=$this->db->get('surveys');
    return $result->result();
  }

  /*public function groups_show() {
    $this->db->select('id, group_name');
    $result=$this->db->get('question_groups');
    return $result->result();
  }*/
   
  /* Get survey questions */      
  public function survey_show() {
    $this->db->select('*');
    $this->db->from('survey_questions');
    //$this->db->join('surveys','surveys.survey_id=survey_questions.survey_id','left');
    $this->db->where('survey_questions.survey_id', $this->uri->segment(3));
    $result=$this->db->get();
    return $result->result();
  }   

   public function check_survey_active($survey_id) {
    $this->db->select('*');
    $this->db->from('surveys'); 
    $this->db->where('survey_id', $survey_id);
    $result=$this->db->get();
    return $result->row_array();
  }  
  public function deactivate_questions() {
    $submit=$this->input->post('deactivate');
    $date = new DateTime("now"); 
      if(isset($submit)&&($submit=='Премахни')) {
        $data = array(         
          'deactivated_at' => $date->format('Y-m-d H:i:s')          
        );
        $this->db->where('question_id', $this->input->post('question_id'));
        $this->db->update('survey_questions', $data);    
      
          if($this->db->affected_rows() > 0)
          {   
            return true;
          } 
            return false;
      }
  }

  public function restore_questions() {
    $submit=$this->input->post('restore');
    $date = new DateTime("now"); 
    if(isset($submit)&&($submit=='Възстанови')) {
      $data = array(         
        'deactivated_at' => NULL          
      );
      $this->db->where('question_id', $this->input->post('question_id'));
      $this->db->update('survey_questions', $data);    
      
      if($this->db->affected_rows() > 0)
      {   
        return true;
      } 
        return false;
    }

  }

  public function deactivate_coordinator() {
    $submit=$this->input->post('deactivate');
    $date = new DateTime("now"); 
    if(isset($submit)&&($submit=='Изтрий')) {
      $data = array(         
        'deactivated_at' => $date->format('Y-m-d H:i:s')          
      );
      $this->db->where('user_id', $this->input->post('coordinator'));
      $this->db->update('users', $data);    
      
      if($this->db->affected_rows() > 0)
      {   
        return true;
      } 
        return false;
    }

  }

  /* Remove */
  public function add_teacher() {
    $date = new DateTime("now");     
    if($this->session->userdata('role_id')==4) {
      if($this->input->post('teacher')) {
        foreach($this->input->post('teacher') as $teacher) {  
          $data = array(            
            'teacher_id'=> $teacher,
            'student_id' => $this->input->post('student'),
            'created_at' =>  $date->format('Y-m-d H:i:s')                       
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
  /* Add students to teachers */
  public function add_students() {
    $date = new DateTime("now");    
    $submit=$this->input->post('add');
    if(isset($submit)&&($submit=='Добави ученици')) {
      if($this->input->post('student')) {
        foreach($this->input->post('student') AS $student) {          

          $data=array(
            'student_id' => $student,
            'teacher_id' => $this->uri->segment(3),
            'created_at' => $date->format('Y-m-d H:i:s')
          );

          $this->db->insert('teacher_student_conn', $data);    
        }  
      
      }

      if($this->db->affected_rows() > 0)
      {   
        return true;
      } 

        return false;
    }

  }
   /* Add teachers to students */
  public function add_teachers() {
    $date = new DateTime("now");     
    $submit=$this->input->post('add'); 
    if(isset($submit)&&($submit=='Добави учители')) {
      if($this->input->post('teacher2')) {
        foreach($this->input->post('teacher2') AS $teacher2) {          

          $data=array(
            'student_id' => $this->uri->segment(3),
            'teacher_id' => $teacher2,
            'created_at' => $date->format('Y-m-d H:i:s')
          );

          $this->db->insert('teacher_student_conn', $data);    
        }  
      
      }
      if($this->db->affected_rows() > 0)
      {   
        return true;
      } 

        return false;
    }

  }
  /* Add teachers to coordinator */
  public function add_teachers_to_coord() {
    $date = new DateTime("now");     
    $submit=$this->input->post('add');
    if(isset($submit)&&($submit=='Добави учители')) {
      if($this->input->post('add_teacher')) {
        foreach($this->input->post('add_teacher') AS $teacher2) {          

          $data=array(
            'coordinator_id' => $this->uri->segment(3),
            'teacher_id' => $teacher2,
            'created_at' => $date->format('Y-m-d H:i:s')
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

  }
  /* Show unapproved teachers (role_id = 2) and coordinators (role_id = 5) */
  public function unapproved_users_show() {
    $this->db->select('user_id, username, users.is_approved,users.role_id, roles.role_name');
    $this->db->from('users');
    $this->db->join('roles', 'roles.role_id=users.role_id');    
    $this->db->where('(is_approved = "0")
      AND (users.role_id = "2" || users.role_id = "5")');  
    $this->db->order_by('users.role_id');
    $result=$this->db->get();
    return $result->result();
  }

  public function approve_users() {
    $submit=$this->input->post('submit');
    if(isset($submit)&&($submit=='Одобри')) {
      $data = array(         
        'is_approved'=>'1'           
      );
      $this->db->where('user_id', $this->input->post('approve'));
      $this->db->update('users', $data);    
    }
  }
 
 /* Teachers manage */
  public function teachers_manage() {   
 
    $this->db->select('users.user_id, T.first_name, T.last_name, T.email, users.username,T.user_id AS TU,T.username AS T,teacher_id, COUNT(student_id) AS S, COUNT(DISTINCT(users.class)) AS count_classes, schools.region, T.school_id,schools.school_name');      
    $this->db->from('teacher_student_conn');      
    $this->db->join('users', 'teacher_student_conn.student_id=users.user_id');
    $this->db->join('users AS T', 'teacher_student_conn.teacher_id=T.user_id','right');
    $this->db->join('schools', 'schools.school_id=T.school_id');    
    $this->db->where('(users.deactivated_at = "0000-00-00 00:00:00" OR users.deactivated_at IS NULL )
      AND (T.deactivated_at = "0000-00-00 00:00:00" OR T.deactivated_at IS NULL)');  
    $this->db->where('T.role_id', '2');
    if($this->session->userdata('role_id')==2) {
      $this->db->where('T.user_id',$this->session->userdata('user_id')); 
    }
    $this->db->group_by("T.user_id");
    $result=$this->db->get();     
    return $result->result();       
  }

  public function quaestors_show() {
    if($this->session->userdata('role_id')==2) {  
      $this->db->select('users.school_id');
      $this->db->from('users');             
      $this->db->where('user_id', $this->session->userdata['user_id']); 
      $result=$this->db->get();
      $school=$result->row_array();         
    }

    $this->db->select('users.user_id, users.username, first_name, last_name');      
    $this->db->from('users');      
    if($this->session->userdata('role_id')==2) { 
      $this->db->where('users.school_id',$school['school_id']);
    }
    $this->db->where('users.role_id','2');
    $result=$this->db->get();     
    return $result->result();
  }

  public function add_quaestors() {     
    if($this->session->userdata('role_id')==4) {
      $submit=$this->input->post('submit');
      $date = new DateTime("now"); 
      if(isset($submit)&&($submit=='Добави')) {        
        if($this->input->post('class')) {
          foreach($this->input->post('class') as $class) { 
            if($this->input->post('class_divisions')) { 
              foreach($this->input->post('class_divisions') as $division) {  
                $data = array(            
                  'school_id'=> $this->input->post('school'),
                  'class' => $class,
                  'class_division' => $division,
                  'quaestor' => $this->input->post('quaestor'),
                  'day' => $this->input->post('day'),
                  'month' => $this->input->post('month'),
                  'year' => $this->input->post('year'),
                  'created_at' =>  $date->format('Y-m-d H:i:s')                       
                );
              
                $this->db->insert('quaestors',$data);
              }    
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

  }

  /* Schools show for quaestors manage */
  public function schools_show() {
    $this->db->select('schools.school_id,schools.school_name');      
    $this->db->from('schools');   
    if($this->session->userdata('role_id')==2) {  // role_id = 2 - teachers
      $this->db->join('users', 'schools.school_id=users.school_id'); 
      $this->db->where('users.user_id', $this->session->userdata('user_id'));    
    }
    $result=$this->db->get();     
    return $result->result();
  }

  /* Coordinators manage */
  public function coordinators_show() {
    $this->db->select('users.user_id, C.email, C.first_name, C.last_name, COUNT(teacher_id) AS T, coordinator_teacher_conn.coordinator_id,C.user_id AS CU,C.username AS C');
    $this->db->from('coordinator_teacher_conn');      
    $this->db->join('users', 'coordinator_teacher_conn.teacher_id=users.user_id');   
    $this->db->join('users AS C', 'coordinator_teacher_conn.coordinator_id=C.user_id','right');      
    $this->db->where('(users.deactivated_at = "0000-00-00 00:00:00" OR users.deactivated_at IS NULL )
      AND (C.deactivated_at = "0000-00-00 00:00:00" OR C.deactivated_at IS NULL)');  
    $this->db->where('C.role_id', '5');  
    if($this->session->userdata('role_id')==5) {
      $this->db->where('C.user_id', $this->session->userdata('user_id')); 
    }
    $this->db->group_by('C.user_id');    
    $result=$this->db->get();
    return $result->result();
  }

  /* Students manage - students show and count teachers */
  public function teachers_show() {     
    if($this->session->userdata('role_id')==2) {
        $this->db->select('school_id');
        $this->db->from('users');       
        $this->db->where('user_id', $this->session->userdata['user_id']);  
        $result=$this->db->get();
        $school=$result->row_array();

    }

    $this->db->select('users.user_id, T.first_name, T.last_name, T.email,users.username,T.user_id AS TU,T.username AS T,teacher_id, COUNT(student_id) AS S, COUNT(DISTINCT(users.class)) AS count_classes, schools.region, T.school_id,schools.school_name');      
    $this->db->from('teacher_student_conn');      
    $this->db->join('users ', 'teacher_student_conn.teacher_id=users.user_id');
    $this->db->join('users AS T', 'teacher_student_conn.student_id=T.user_id','right');
    $this->db->join('schools', 'schools.school_id=T.school_id');    
    $this->db->where('(users.deactivated_at = "0000-00-00 00:00:00" OR users.deactivated_at IS NULL )
      AND (T.deactivated_at = "0000-00-00 00:00:00" OR T.deactivated_at IS NULL)');  
    $this->db->where('T.role_id', '1');
    if($this->session->userdata('role_id')==2) {

      $this->db->where('T.school_id',$school['school_id']); 
    }
    $this->db->group_by("T.user_id");
    $result=$this->db->get();    
    return $result->result();
        
  }

  public function students_show()
  {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('deactivated_at = "0000-00-00 00:00:00" || deactivated_at IS NULL ');
    $this->db->where('role_id','1'); //students
    $result=$this->db->get();
    return $result->result();  
  }
/*remove?*/
  /*public function students_show()
  {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('deactivated_at = "0000-00-00 00:00:00" || deactivated_at IS NULL ');
    $this->db->where('role_id','1'); //students
    $result=$this->db->get();
    return $result->result();  
  }*/
  
  /* Select students that haven't been added to this teacher */
  public function select_students() {
    $teacher=$this->uri->segment(3);
    $school=$this->uri->segment(4);
    
    $query=("SELECT users.user_id, users.first_name, users.last_name, users.email,users.username, users.school_id, users.class, users.division, users.role_id, schools.school_name, schools.region,class_divisions.division FROM users
      LEFT JOIN teacher_student_conn ON teacher_student_conn.student_id=users.user_id
      AND teacher_student_conn.teacher_id = $teacher
      LEFT JOIN teacher_student_conn as T ON T.teacher_id=users.user_id
      LEFT JOIN class_divisions ON class_divisions.id=users.division
      LEFT JOIN schools ON schools.school_id=users.school_id
      WHERE (users.deactivated_at = '0000-00-00 00:00:00' OR users.deactivated_at IS NULL)
       AND users.role_id = 1 AND /* students */
      users.school_id = $school AND teacher_student_conn.student_id IS NULL");

      $result = $this->db->query($query);
      return $result->result();   
  }

  /* Select teachers that haven't been added to this student */
  public function show_teachers() {
    $student=$this->uri->segment(3);
    $school=$this->uri->segment(4);
    $user_id=$this->session->userdata('user_id');

    $query=("SELECT users.user_id,users.first_name, users.last_name, teacher_student_conn.teacher_id,users.username, 
      users.school_id, users.class, users.division, users.role_id, schools.school_name, schools.region,class_divisions.division FROM users
      LEFT JOIN teacher_student_conn ON teacher_student_conn.teacher_id=users.user_id
      AND teacher_student_conn.student_id = $student      
      LEFT JOIN class_divisions ON class_divisions.id=users.division
      LEFT JOIN schools ON schools.school_id=users.school_id
      WHERE (users.deactivated_at = '0000-00-00 00:00:00' OR users.deactivated_at IS NULL) AND users.role_id = 2 AND
      users.school_id = $school AND teacher_student_conn.teacher_id IS NULL");

    if($this->session->userdata('role_id')==2) {
      $query=("SELECT users.user_id, users.first_name, users.last_name,teacher_student_conn.teacher_id,users.username, 
        users.school_id, users.class, users.division, users.role_id, schools.school_name, 
        schools.region,class_divisions.division FROM users
        LEFT JOIN teacher_student_conn ON teacher_student_conn.teacher_id=users.user_id
        AND teacher_student_conn.student_id = $student
        
        LEFT JOIN class_divisions ON class_divisions.id=users.division
        LEFT JOIN schools ON schools.school_id=users.school_id
        WHERE ((users.deactivated_at = '0000-00-00 00:00:00' OR users.deactivated_at IS NULL) AND users.role_id = 2 AND
        users.school_id = $school AND users.user_id=$user_id AND teacher_student_conn.teacher_id IS NULL)");
    }
  
      $result = $this->db->query($query);
      return $result->result();   
  }

  /* Select teachers that don't have coordinator */
  public function teachers_with_coordinators() {
    $coordinator=$this->uri->segment(3);
  
    $query=("SELECT users.user_id, users.first_name, users.last_name, users.email, coordinator_teacher_conn.teacher_id,users.username, users.school_id, users.class, users.division, users.role_id, schools.school_name, schools.region,class_divisions.division FROM users
      LEFT JOIN coordinator_teacher_conn ON coordinator_teacher_conn.teacher_id=users.user_id
      AND coordinator_teacher_conn.coordinator_id = $coordinator      
      LEFT JOIN class_divisions ON class_divisions.id=users.division
      LEFT JOIN schools ON schools.school_id=users.school_id
      WHERE (users.deactivated_at = '0000-00-00 00:00:00' OR users.deactivated_at IS NULL) AND users.role_id = 2 AND
        coordinator_teacher_conn.teacher_id IS NULL");
 
      $result = $this->db->query($query);
      return $result->result(); 
  }

  /* Select teachers that have coordinator */
  public function select_teachers_by_coordinator() {
    $this->db->select('DISTINCT(teacher_id), coordinator_id, users.first_name, users.last_name, users.email,
      user_id, username,schools.school_name, schools.region,
      users.role_id,users.class, class_divisions.division,');
    $this->db->from('coordinator_teacher_conn');
    $this->db->join('users','users.user_id=coordinator_teacher_conn.teacher_id','left');
    $this->db->join('schools','schools.school_id=users.school_id','left');
    $this->db->join('class_divisions','class_divisions.id=users.division','left');
    $this->db->where('coordinator_teacher_conn.coordinator_id',$this->uri->segment(3) );
    $result=$this->db->get();
    return $result->result();
  }
  /* Select students that have teacher - $this->uri->segment(3) */
  public function select_teachers_students() {
    $this->db->select('teacher_id, student_id, user_id,users.first_name, users.last_name, users.email, username,schools.school_name, schools.region,
      users.role_id,users.class, class_divisions.division,');
    $this->db->from('teacher_student_conn');
    $this->db->join('users','users.user_id=teacher_student_conn.student_id','left');
    $this->db->join('schools','schools.school_id=users.school_id','left');
    $this->db->join('class_divisions','class_divisions.id=users.division','left');
    $this->db->where('teacher_student_conn.teacher_id',$this->uri->segment(3) );
    $this->db->group_by("teacher_student_conn.student_id");
    $result=$this->db->get();
    return $result->result();
  }

  /* Select teachers of this student - $this->uri->segment(3) */
  public function select_teachers_by_student() {
    $this->db->select('DISTINCT(teacher_id), U.first_name, U.last_name,U.username AS U,student_id, users.user_id, users.username,schools.school_name, schools.region,
      users.role_id,users.class, class_divisions.division,');
    $this->db->from('teacher_student_conn');
    $this->db->join('users','users.user_id=teacher_student_conn.student_id','left');
    $this->db->join('users AS U','U.user_id=teacher_student_conn.teacher_id','left');
    $this->db->join('schools','schools.school_id=users.school_id','left');
    $this->db->join('class_divisions','class_divisions.id=users.division','left');
    $this->db->where('teacher_student_conn.student_id',$this->uri->segment(3) );
    // $this->db->group_by("teacher_student_conn.teacher_id");
    if($this->session->userdata('role_id')==2) {
      $this->db->where('teacher_student_conn.teacher_id',$this->session->userdata('user_id')); 
    }
    $result=$this->db->get();
    return $result->result();
  }
  /* Remove? */
  public function select_teacher_students() {
      $this->db->select('student_id');
      $this->db->from('teacher_student_conn');
      $this->db->where('teacher_student_conn.teacher_id',$this->uri->segment(3) );
      $result=$this->db->get();
            return $result->result();
  }

  /* Delete students from teacher */
  public function edit_students() {    
    $submit=$this->input->post('change');
    $date = new DateTime("now"); 
    if(isset($submit)&&($submit=='Изтрий ученици')) {
      if($this->input->post('student')) {
        foreach($this->input->post('student') AS $student) {          
          $this->db->where('student_id',$student);
          $this->db->where('teacher_id',$this->uri->segment(3));
          $this->db->delete('teacher_student_conn');    
        }  
      }
      if($this->db->affected_rows() > 0)
      {   
        return true;
      } 

        return false;
    }
  }
  /* Delete teachers from student */
  public function delete_teachers() {
    $submit=$this->input->post('change');
    $date = new DateTime("now"); 
    if(isset($submit)&&($submit=='Изтрий учители')) {
      if($this->input->post('teacher')) {
        foreach($this->input->post('teacher') AS $teacher) {          
          $this->db->where('teacher_id',$teacher);
          $this->db->where('student_id',$this->uri->segment(3));
          $this->db->delete('teacher_student_conn');    
        }  
      
      }
      if($this->db->affected_rows() > 0)
      {   
        return true;
      } 

        return false;
    }
  }

  /* Delete teachers from coordinator */
  public function delete_teachers_from_coord() {    
    $submit=$this->input->post('change');
    $date = new DateTime("now"); 
    if(isset($submit)&&($submit=='Изтрий учители')) {
      if($this->input->post('delete_teacher')) {
        foreach($this->input->post('delete_teacher') AS $teacher) {          
          $this->db->where('teacher_id',$teacher);
          $this->db->where('coordinator_id',$this->uri->segment(3));
          $this->db->delete('coordinator_teacher_conn');    
        }  
      
      }
      if($this->db->affected_rows() > 0)
      {   
        return true;
      } 

        return false;
    }
  }   
  
  public function teacher_name() {
    $this->db->select('*');
    $this->db->from('users');
    $this->db->where('users.user_id',$this->uri->segment(3) );
    $result=$this->db->get();
    return $result->result();
  }

  public function deactivate_student() {
    $submit=$this->input->post('deactivate');
    $date = new DateTime("now"); 
    if(isset($submit)&&($submit=='Изтрий')) {
      $data = array(         
        'deactivated_at' => $date->format('Y-m-d H:i:s')          
      );
      $this->db->where('user_id', $this->input->post('student'));
      $this->db->update('users', $data);    
      
      if($this->db->affected_rows() > 0)
      {   
        return true;
      } 

        return false;
    }
  }

  public function deactivate_teacher() {
    $submit=$this->input->post('deactivate');
    $date = new DateTime("now"); 
    if(isset($submit)&&($submit=='Изтрий')) {
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
  public function manage_survey($survey) {
    $submit=$this->input->post('manage_survey');
    $date = new DateTime("now"); 
      if(isset($submit)&&($submit=='Изтрий анкетата')) {
        $data = array(         
          'deactivated_at' => $date->format('Y-m-d H:i:s')          
        );
        $this->db->where('survey_id', $survey);
        $this->db->update('surveys', $data);    
      
      }

      if(isset($submit)&&($submit=='Възстанови анкетата')) {
        $data = array(         
          'deactivated_at' => NULL          
        );
        $this->db->where('survey_id', $survey);
        $this->db->update('surveys', $data);    
      
         
      }
      if($this->db->affected_rows() > 0)
      {   
        return true;
      } 
        return false; 
  }

     


}
