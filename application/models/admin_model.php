<?php
class Admin_model extends CI_model {
	public function __construct() {
    parent:: __construct();
    $this->load->database();
    $this->load->library('session'); 
   
  }

   
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
        if($data['question'][$i] && $data['code'][$i]) {
        $insert['question'] = $data['question'][$i]; 
        $insert['code'] = $data['code'][$i]; 
        $insert['survey_id'] =$this->uri->segment(3); 
        $insert['group_id'] = $data['group_id'][$i];
        $insert['is_reverse']=$data['is_reverse'][$i]; 
        $insert['created_at'] = $date->format('Y-m-d H:i:s');
        if($this->db->insert('survey_questions',$insert)) {
          return true;
        }
        return false;
      }
      }
    }
  }

  public function surveys_show() {
    $this->db->select('surveys.survey_name, surveys.survey_id');
    $result=$this->db->get('surveys');
      return $result->result();
  }

  public function groups_show() {
    $this->db->select('id, group_name');
    $result=$this->db->get('question_groups');
      return $result->result();
  }
         

  public function survey_show() {
    $this->db->select('*');
    $this->db->from('survey_questions');
    $this->db->where('survey_id', $this->uri->segment(3));
    $result=$this->db->get();
      return $result->result();
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

  public function add_students() {
    $date = new DateTime("now");
     
    $submit=$this->input->post('add');
        $date = new DateTime("now"); 
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

  public function add_teachers() {
    $date = new DateTime("now");
     
    $submit=$this->input->post('add');
        $date = new DateTime("now"); 
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
  public function add_teachers_to_coord() {
    $date = new DateTime("now");
     
    $submit=$this->input->post('add');
        $date = new DateTime("now"); 
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


  public function unapproved_users_show() {
    $this->db->select('user_id, username, users.is_approved,users.role_id, roles.role_name');
    $this->db->from('users');
    $this->db->join('roles', 'roles.role_id=users.role_id');
    $this->db->where('is_approved', '0');
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
  /*public function students_show() {
      
      $this->db->select('*');
      $this->db->from('users');
      $this->db->where('role_id', '1');
      $result=$this->db->get();
        return $result->result();
        
        /*$query= $this->db->query("SELECT * FROM users AS C 
        LEFT JOIN teacher_student_conn AS SC ON SC.student_id = C.user_id      
         WHERE 
         C.deactivated_at = '0000-00-00 00:00:00' || C.deactivated_at IS NULL AND
         SC.teacher_id IS NULL AND C.role_id= '1'  ");
                
            return $query->result();
  }*/

  /*public function teachers_show() {

      $this->db->select('users.user_id, teacher_student_conn.student_id, users.username, COUNT(teacher_student_conn.teacher_id) AS S, users.class,
       schools.region, users.school_id, schools.school_name');
      $this->db->from('teacher_student_conn');

      $this->db->join('users', 'teacher_student_conn.student_id=users.user_id','right');
      $this->db->join('users AS T', 'teacher_student_conn.teacher_id=T.user_id','right');
      $this->db->join('schools', 'schools.school_id=users.school_id');

      $this->db->where('users.deactivated_at = "0000-00-00 00:00:00" || users.deactivated_at IS NULL ');
      $this->db->where('users.role_id', '1');
      $this->db->group_by("teacher_student_conn.student_id");
      $result=$this->db->get();
        return $result->result();
  }*/
 
   /*public function teachers_show() {
     $query=("SELECT users.user_id,  users.username, COUNT(DISTINCT(teacher_student_conn.teacher_id)) AS S, users.class,
       schools.region, users.school_id,schools.school_name FROM teacher_student_conn
        RIGHT JOIN users ON teacher_student_conn.student_id=users.user_id
        
        LEFT JOIN users as T ON teacher_student_conn.teacher_id=T.user_id
        LEFT JOIN class_divisions ON class_divisions.id=users.division
        LEFT JOIN schools ON schools.school_id=users.school_id
        WHERE (users.deactivated_at = '0000-00-00 00:00:00' OR users.deactivated_at IS NULL) AND users.role_id = 1 GROUP BY teacher_student_conn.student_id");

      
        $result = $this->db->query($query);
        echo $this->db->last_query();
                return $result->result();  


  }*/

  public function teachers_manage() {   
 
      $this->db->select('users.user_id, users.username,T.user_id AS TU,T.username AS T,teacher_id, COUNT(student_id) AS S, COUNT(DISTINCT(users.class)) AS count_classes, schools.region, T.school_id,schools.school_name');      
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
      $this->db->select('users.user_id, users.username, first_name, last_name');      
      $this->db->from('users');      
      //$this->db->where('users.user_id',$this->session->userdata('user_id'));
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
  public function schools_show() {
      $this->db->select('schools.school_id,schools.school_name');      
      $this->db->from('schools');      
     
      $result=$this->db->get();
     
        return $result->result();
  }
  /*public function coordinators_show() {
      $this->db->select('users.user_id, users.username, COUNT(coordinator_teacher_conn.teacher_id) AS T, coordinator_teacher_conn.coordinator_id');
      $this->db->from('coordinator_teacher_conn');
      $this->db->join('users', 'coordinator_teacher_conn.coordinator_id=users.user_id','left');         
      $this->db->where('users.deactivated_at = "0000-00-00 00:00:00" || users.deactivated_at IS NULL ');
      //$this->db->where('users.role_id', '5');  
      if($this->session->userdata('role_id')==5) {
          $this->db->where('users.user_id', $this->session->userdata('user_id')); 
      }
      $this->db->group_by('coordinator_teacher_conn.coordinator_id');    
      $result=$this->db->get();
          return $result->result();
  }*/
   public function coordinators_show() {
      $this->db->select('users.user_id, users.username, COUNT(teacher_id) AS T, coordinator_teacher_conn.coordinator_id,C.user_id AS CU,C.username AS C');
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


  public function teachers_show() {   
   
      $this->db->select('users.user_id, users.username,T.user_id AS TU,T.username AS T,teacher_id, COUNT(student_id) AS S, COUNT(DISTINCT(users.class)) AS count_classes, schools.region, T.school_id,schools.school_name');      
      $this->db->from('teacher_student_conn');      
      $this->db->join('users ', 'teacher_student_conn.teacher_id=users.user_id');
        $this->db->join('users AS T', 'teacher_student_conn.student_id=T.user_id','right');
      $this->db->join('schools', 'schools.school_id=T.school_id');    
      $this->db->where('(users.deactivated_at = "0000-00-00 00:00:00" OR users.deactivated_at IS NULL )
        AND (T.deactivated_at = "0000-00-00 00:00:00" OR T.deactivated_at IS NULL)');  
      $this->db->where('T.role_id', '1');
      if($this->session->userdata('role_id')==2) {
          $this->db->where('T.user_id',$this->session->userdata('user_id')); 
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
      $this->db->where('role_id','1'); 
      $result=$this->db->get();
          return $result->result();  
  }
  
/* public function select_students() {

         $query = "SELECT users.user_id, users.username, users.school_id, users.class, users.division, users.role_id, schools.school_name, schools.region,class_divisions.division FROM users"
                 . "LEFT JOIN teacher_student_conn ON teacher_student_conn.student_id=users.user_id"
                 . "LEFT JOIN teacher_student_conn as T ON T.teacher_id=users.user_id"
                 . "LEFT JOIN class_divisions ON class_divisions.id=users.division"
                 . "LEFT JOIN schools ON schools.school_id=users.school_id"
                 . "WHERE (users.deactivated_at = '0000-00-00 00:00:00' OR users.deactivated_at IS NULL) AND users.role_id = 1 AND "
                 . "users.school_id = ".$this->uri->segment(4)." AND teacher_student_conn.teacher_id = ".$this->uri->segment(4)." AND teacher_student_conn.student_id IS NULL";
        $result = $this->db->query($query);

        return $result->result();             
}*/
  public function select_students() {
    $teacher=$this->uri->segment(3);
    $school=$this->uri->segment(4);
    
    $query=("SELECT users.user_id, users.username, users.school_id, users.class, users.division, users.role_id, schools.school_name, schools.region,class_divisions.division FROM users
      LEFT JOIN teacher_student_conn ON teacher_student_conn.student_id=users.user_id
      AND teacher_student_conn.teacher_id = $teacher
      LEFT JOIN teacher_student_conn as T ON T.teacher_id=users.user_id
      LEFT JOIN class_divisions ON class_divisions.id=users.division
      LEFT JOIN schools ON schools.school_id=users.school_id
      WHERE (users.deactivated_at = '0000-00-00 00:00:00' OR users.deactivated_at IS NULL) AND users.role_id = 1 AND
      users.school_id = $school AND teacher_student_conn.student_id IS NULL");

      $result = $this->db->query($query);
          return $result->result();   
  }

  public function show_teachers() {
    $student=$this->uri->segment(3);
    $school=$this->uri->segment(4);
    $user_id=$this->session->userdata('user_id');

    $query=("SELECT users.user_id, teacher_student_conn.teacher_id,users.username, users.school_id, users.class, users.division, users.role_id, schools.school_name, schools.region,class_divisions.division FROM users
      LEFT JOIN teacher_student_conn ON teacher_student_conn.teacher_id=users.user_id
      AND teacher_student_conn.student_id = $student
      
      LEFT JOIN class_divisions ON class_divisions.id=users.division
      LEFT JOIN schools ON schools.school_id=users.school_id
      WHERE (users.deactivated_at = '0000-00-00 00:00:00' OR users.deactivated_at IS NULL) AND users.role_id = 2 AND
      users.school_id = $school AND teacher_student_conn.teacher_id IS NULL");

    if($this->session->userdata('role_id')==2) {
      $query=("SELECT users.user_id, teacher_student_conn.teacher_id,users.username, users.school_id, users.class, users.division, users.role_id, schools.school_name, schools.region,class_divisions.division FROM users
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

  public function teachers_with_coordinators() {
    $coordinator=$this->uri->segment(3);
  
    $query=("SELECT users.user_id, coordinator_teacher_conn.teacher_id,users.username, users.school_id, users.class, users.division, users.role_id, schools.school_name, schools.region,class_divisions.division FROM users
      LEFT JOIN coordinator_teacher_conn ON coordinator_teacher_conn.teacher_id=users.user_id
      AND coordinator_teacher_conn.coordinator_id = $coordinator
      
      LEFT JOIN class_divisions ON class_divisions.id=users.division
      LEFT JOIN schools ON schools.school_id=users.school_id
      WHERE (users.deactivated_at = '0000-00-00 00:00:00' OR users.deactivated_at IS NULL) AND users.role_id = 2 AND
        coordinator_teacher_conn.teacher_id IS NULL");
 
      $result = $this->db->query($query);
          return $result->result(); 
  }

  public function select_teachers_by_coordinator() {
      $this->db->select('DISTINCT(teacher_id), coordinator_id, user_id, username,schools.school_name, schools.region,
        users.role_id,users.class, class_divisions.division,');
      $this->db->from('coordinator_teacher_conn');
      $this->db->join('users','users.user_id=coordinator_teacher_conn.teacher_id','left');
      $this->db->join('schools','schools.school_id=users.school_id','left');
      $this->db->join('class_divisions','class_divisions.id=users.division','left');
      $this->db->where('coordinator_teacher_conn.coordinator_id',$this->uri->segment(3) );
      $result=$this->db->get();
            return $result->result();
  }

  public function select_teachers_students() {
      $this->db->select('teacher_id, student_id, user_id, username,schools.school_name, schools.region,
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

  public function select_teachers_by_student() {
      $this->db->select('DISTINCT(teacher_id), U.username AS U,student_id, users.user_id, users.username,schools.school_name, schools.region,
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

  public function select_teacher_students() {
      $this->db->select('student_id');
      $this->db->from('teacher_student_conn');
      $this->db->where('teacher_student_conn.teacher_id',$this->uri->segment(3) );
      $result=$this->db->get();
            return $result->result();
  }
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
     


}
