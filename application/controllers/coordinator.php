<?php
class Coordinator extends CI_Controller {
   
    public function __construct() {
        parent::__construct();
         
        $this->load->library('table');
        $this->load->library('session'); 
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('coordinator_model'); 
        $this->load->model('menu_model'); 
        $this->load->library('session'); 
        header('Content-type: text/html; charset=utf-8'); 
    }

    public function teachers_show()
    {
        //remove
        $data['dynamic_view'] = 'teachers_show1'; 
        $data['coordinator_show']=$this->coordinator_model->coordinator_show();
        $data['select_coordinator']=$this->coordinator_model->select_coordinator();
        $data['teachers_show'] = $this->coordinator_model->teachers_show();
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data);
    }
   
    
    public function deactivate_teacher()
    {
        //remove
        if($this->coordinator_model->deactivate_teacher()) {
            echo "Деактивирахте учителя успешно!";  
            var_dump($this->input->post('teacher'));       
            header('Refresh: 2; url=/survey/index.php/coordinator/teachers_show' );
        } 
        else 
        {
            $data['dynamic_view'] = 'teachers_show'; 
            $data['teachers_show'] = $this->coordinator_model->teachers_show();
            $data['menu']=$this->menu_model->get_menu();
            $this->load->view('templates/main',$data);
        }
    }
    
    public function edit_coordinator()
    {
        //remove
        if($this->coordinator_model->edit_coordinator()) {
            echo "Променихте координатора успешно!";
            header('Refresh: 2; url=/survey/index.php/coordinator/teachers_show');
        }
        else
        { 
            $data['coordinator_show']=$this->coordinator_model->coordinator_show();
            $data['dynamic_view'] = 'edit_coordinator'; 
            $data['select_coordinator']=$this->coordinator_model->select_coordinator();
            $data['teachers_show'] = $this->coordinator_model->teachers_show();
            $data['teacher_show'] = $this->coordinator_model->teacher_show();
            $data['menu']=$this->menu_model->get_menu();
            $this->load->view('templates/main',$data);
        }

    }

    /*public function students_show()
    {
        
        $data['dynamic_view'] = 'students_show'; 
        $data['students_show'] = $this->admin_model->students_show();
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data);
    }*/
    
    public function add_students()
    {
        //remove
        if($this->coordinator_model->add_students()) {
            echo "Добавихте ученика успешно!";
            header('Refresh: 2; url=/survey/index.php/coordinator/students_show');
        }
        else
        { 
       
            $data['dynamic_view'] = 'students_show';      
            $data['students_show'] = $this->coordinator_model->students_show();
            $data['menu']=$this->menu_model->get_menu();
            $this->load->view('templates/main',$data);
        
        }

    }



}