<?php
class Index extends CI_Controller {
   
    public function __construct() {
        parent::__construct();
         
        $this->load->library('table');
        $this->load->library('session'); 
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('user_model'); 
        $this->load->model('menu_model'); 
    }

    public function survey_show()
    {  
    	$this->load->library('pagination');
        $config['base_url'] = '/survey/index.php/index/survey_show/';
        $config['total_rows'] = $this->user_model->survey_count();
        $config['per_page'] = 1; 
        $config['display_pages'] = FALSE; 
        $config['last_link'] = FALSE;
        $config['next_link'] = 'Next';
       
        $this->pagination->initialize($config);
        $data["links"] = $this->pagination->create_links();   
        $offset=$config['uri_segment'] = 5;
        $data['survey'] = $this->user_model->survey_show($config["per_page"], $offset);

    	//$data['survey'] =$this->user_model->survey_show();
        $data['dynamic_view'] = 'survey_show';
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data); 
      
    }

    public function survey_fill()
    { 
        
        
    	$this->form_validation->set_rules('answer', 'Отговор', 'required');
        
        if ($this->form_validation->run()==FALSE)
        {

            $this->survey_show();
        }
        else 
        {

	    	 if ($this->user_model->survey_fill()) 
	        {
                echo "Попълнихте анкетата успешно!";
                header('Refresh: 2; url=/survey/index.php/index/surveys_show');
	        	
	        }

            else 
            {
                $this->load->model('user_model'); 
                $data['survey'] =$this->user_model->survey_show();
                $data['dynamic_view'] = 'survey_show';
                $data['menu']=$this->menu_model->get_menu();
                $this->load->view('templates/main',$data); 

    		}
        }
    }

    public function edit_question() {
        if($this->session->userdata('role_id')!=4) {
            redirect('admin/show_error');    
        } 

        $data['dynamic_view'] = 'edit_question';  
        $data['select_question'] =  $this->user_model->select_question();
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data);
       
    } 

    public function update_question () {
        if($this->session->userdata('role_id')!=4) {
            redirect('admin/show_error');    
        } 
        
        if($this->user_model->update_question())
        {
            
            redirect('index/surveys_show');
        }
        else 
        {
    
            $data['select_question'] =  $this->user_model->select_question();
            $data['dynamic_view'] = 'edit_question'; 
            $data['menu']=$this->menu_model->get_menu();
            $this->load->view('templates/main',$data);
        }
         
    }
     public function surveys_show()
    {  
        
        $data['dynamic_view'] = 'surveys';
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data); 
      
    }
    public function results_show()
    {
         $this->load->model('result_model'); 
         $this->load->model('charts_model');
         $data['total_rows'] =$this->result_model->total_rows();
        $data['result_question1'] = $this->result_model->result_question();
        
        $data['activity_chart']=$this->charts_model->get_activity();
        $data['menu']=$this->menu_model->get_menu();
        $data['dynamic_view'] = 'results';
        
        $this->load->view('templates/main',$data);  
    }

   



  }