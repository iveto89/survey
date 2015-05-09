<?php
class Index extends CI_Controller {
   
    public function __construct() {
        parent::__construct();
         
        $this->load->library('table');
        $this->load->library('session'); 
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('user_model'); 
        $this->load->model('admin_model'); 
        $this->load->model('menu_model'); 
        $this->load->library('session'); 
        $this->load->library('pagination');
       header('Content-type: text/html; charset=utf-8'); 

    }
    
    public function survey_show()
    {
        if($this->session->userdata('role_id')!=3 && $this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=1 &&
            $this->session->userdata('role_id')!=2 && $this->session->userdata('role_id')!=5) {
            redirect('admin/show_error');   
        } 

        $survey = $this->uri->segment(3);
        $question = $this->uri->segment(4);
        $query = $this->user_model->getSurvey($this->uri->segment(3));

        $data['survey'] = $query->result();
        $data['dynamic_view'] = 'survey_show';  
        $data['answers'] = $this->user_model->answers_show($this->uri->segment(3));       
        $data['menu']=$this->menu_model->get_menu();

        $already_used = $this->input->post('already_used');
        $already = explode(',', $already_used);
   
        $query = $this->user_model->getSurvey($this->uri->segment(3), $this->uri->segment(4),$already);
        $data['question'] = $query->result();
        $data['survey_name'] = $this->user_model->survey_name();
        $this->load->view('templates/main', $data);

    }
    public function participation_show() {
        if($this->session->userdata('role_id')!=3 && $this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=1 &&
            $this->session->userdata('role_id')!=2 && $this->session->userdata('role_id')!=5) {
            redirect('admin/show_error');   
        } 

        $data['dynamic_view'] = 'participation_show';   
         $data['participation'] = $this->user_model->select_participation();       
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data);
       
    } 
     public function participation() {

      if($this->user_model->reject_participation()) 
       {
     
             $this->session->set_flashdata('confirm_participation', 'Отказахте!');
            redirect('index/participation_show');
 //header('Refresh: 2; url=/survey/index.php/index/participation_show');

       }
 if($this->user_model->confirm_participation()) 
       {
     
            $this->session->set_flashdata('confirm_participation', 'Потвърдихте!');
            redirect('index/surveys_show');

 //header('Refresh: 2; url=/survey/index.php/index/surveys_show');

       }
    }
    
    public function survey_fill()
    { 
        if($this->session->userdata('role_id')!=3 && $this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=1 &&
            $this->session->userdata('role_id')!=2 && $this->session->userdata('role_id')!=5) {
            redirect('admin/show_error');   
        } 

       
  
      /*$query = $this->user_model->getSurvey($this->uri->segment(3), $this->uri->segment(4));
      $questions = $query->result();

      foreach($questions as $question){
        $this->form_validation->set_rules('answer['.$question->question_id.']', 'Question '.$question->question_id, 'required');
      }     
    
        if ($this->form_validation->run()==FALSE)
        {

            $this->survey_show();
        }
        else 
        {*/
                $survey=$this->uri->segment(3);

	    	if ($this->user_model->survey_fill($survey)) 
	        {
                  echo "Попълнихте анкетата успешно!";
                  echo "<script>setTimeout(\"location.href = '/survey/index.php/index/surveys_show';\",1500);</script>";        		
                       	
	        }

            else 
            {
                $this->load->model('user_model'); 
                $data['survey'] =$this->user_model->survey_show();
                $data['dynamic_view'] = 'survey_show';
                $data['menu']=$this->menu_model->get_menu();
                $this->load->view('templates/main',$data); 

    		}
        //}
    }

    public function edit_question() {
        if($this->session->userdata('role_id')!=4) {
            redirect('admin/show_error');    
        } 

        $data['dynamic_view'] = 'edit_question';  
        $data['select_question'] =  $this->user_model->select_question();
        $data['groups_show']=$this->admin_model->groups_show();
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data);
       
    } 

    public function update_question () {
        if($this->session->userdata('role_id')!=4) {
            redirect('admin/show_error');    
        } 
        
        if($this->user_model->update_question())
        {
            $survey_id=$this->uri->segment(3);
            $question_id=$this->uri->segment(4);
            redirect('admin/survey_show/' . $survey_id );
        }
        else 
        {
    
            $data['select_question'] =  $this->user_model->select_question();
            $data['dynamic_view'] = 'edit_question'; 
            $data['groups_show']=$this->admin_model->groups_show();
            $data['menu']=$this->menu_model->get_menu();
            $this->load->view('templates/main',$data);
        }
         
    }

    public function surveys_show()
    {  
        if($this->session->userdata('role_id')!=3 && $this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=1 &&
            $this->session->userdata('role_id')!=2 && $this->session->userdata('role_id')!=5) {
            redirect('admin/show_error');   
        } 
        $data['dynamic_view'] = 'surveys';
        $data['survey_name'] = $this->user_model->survey_name();
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data); 
     
    }
public function survey_instructions()
    {  
         
        $data['dynamic_view'] = 'survey_instructions';
        
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data); 
     
    }


    public function results_show()
    {
       // if($this->session->userdata('role_id')!=5 && $this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=2) {
         //   redirect('admin/show_error');
      //  }
        $this->load->model('result_model'); 
        $this->load->model('charts_model');
        $data['dynamic_view'] = 'results';
        $data['result_question1'] = $this->result_model->result_question();
        $data['menu']=$this->menu_model->get_menu();       
        $this->load->view('templates/main',$data);  
    }

    public function student_results_show() {
        if($this->session->userdata('role_id')!=3 && $this->session->userdata('role_id')!=4)  {
            redirect('admin/show_error'); 
        }
        
        $data['student_results'] = $this->user_model->student_results_show();
        $data['average_results'] = $this->user_model->average_results();
        $data['menu']=$this->menu_model->get_menu();
        $data['dynamic_view'] = 'student_results';    
        $this->load->view('templates/main',$data);              

    }

    public function get_subjects() {
     
        $this->load->model('user_model');
        $teacher = $this->input->post('teacher');
        $subjects = $this->user_model->subjects_show_by_teacher($teacher);
        echo json_encode($subjects);
    }

    public function student_surveys_show() {
        
        $data['dynamic_view'] = 'student_surveys'; 
        $data['teachers']=$this->user_model->teachers_show();   
        $data['menu']=$this->menu_model->get_menu();   
        $this->load->view('templates/main',$data); 
    }
    public function instructions_before() {
        
        $data['dynamic_view'] = 'instructions';    
        $data['menu']=$this->menu_model->get_menu();   
        $this->load->view('templates/main',$data); 
    }
   
   
   
     public function student_surveys() {
        if($this->session->userdata('role_id')!=3 && $this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=1 &&
            $this->session->userdata('role_id')!=2 && $this->session->userdata('role_id')!=5) {
            redirect('admin/show_error');   
        } 
         
        $this->form_validation->set_rules('teacher', 'Учител', 'required');
        $this->form_validation->set_rules('subject', 'Предмет', 'required|callback_subject'); 
        $this->form_validation->set_rules('location_filling', 'Място на попълване', 'required'); 
        if ($this->form_validation->run()==FALSE)
        {
            $this->student_surveys_show();
        } 
        else 
        {
            //$subject=$this->input->post('subject');
            $this->user_model->add_teacher_subject();
            if($this->db->affected_rows() > 0)
            {   
                $survey_id = $this->uri->segment(3);
               if($this->uri->segment(3) == 3) {
                    redirect('/index/survey3_show/' );
               } else {
               redirect('/index/survey_show/' . $survey_id);
               }

            }               
            
        }

    }
    public function survey3_show() {
        $data['dynamic_view'] = 'survey3_show';  
        $data['menu']=$this->menu_model->get_menu();   
        $this->load->view('templates/main',$data); 

    }

    public function subject()
    {
        if ($this->input->post('subject') === 'Моля изберете учител')  {
        $this->form_validation->set_message('subject', 'Полето Предмет е задължително.');
            return FALSE;
        }
        else {
            return TRUE;
        }
    }
    
}

