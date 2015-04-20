<?php 
class Admin extends CI_controller {
	public function __construct() {
		parent:: __construct();
		$this->load->library('table');
        $this->load->library('session'); 
        $this->load->helper('url');
        $this->load->database();
		$this->load->model('admin_model');
		$this->load->model('menu_model');
		$this->load->model('user_model');
		header('Content-type: text/html; charset=utf-8'); 
		   
	}

	public function show_error() {

		$data['dynamic_view']='show_error';
		$data['menu']=$this->menu_model->get_menu();
		$this->load->view('templates/main', $data);
	}

	public function wait_approval() {

		$data['dynamic_view']='wait_approval';
		$data['menu']=$this->menu_model->get_menu();
		$this->load->view('templates/main', $data);
	}

	public function add_questions() {
		if($this->session->userdata('role_id')!=4) {
			redirect('admin/show_error');		
		}
		$this->form_validation->set_rules('question[]', 'Въпрос', 'required');
        $this->form_validation->set_rules('code[]', 'Код', 'required');
        $this->form_validation->set_rules('group_id[]', 'Група', 'required');
        $this->form_validation->set_rules('is_reverse[]', 'Тип въпрос', 'required');

        if ($this->form_validation->run()==FALSE )
			
        {
            $this->questions();
        }
      
        else
        { 
			
			if($this->admin_model->add_questions($this->input->post('question'))) {
				$survey_id = $this->uri->segment(3);
				echo "Добавихте въпроса успешно!";
				header('Refresh: 2; url=/survey/index.php/admin/survey_show/'.$survey_id);
			}
			else
			{
				$this->load->model('user_model');
				$data['survey'] = $this->admin_model->survey_show();
				$data['dynamic_view']='surveys_show';
				$data['survey_name'] = $this->user_model->survey_name();
				$data['groups_show']=$this->admin_model->groups_show();
				$data['menu']=$this->menu_model->get_menu();
				$this->load->view('templates/main', $data);
			}
			
		}

	}

	public function add_teacher() {
		//remove?
		if($this->admin_model->add_teacher()) {
			echo "Добавихте учителя успешно!";
			header('Refresh: 2; url=/survey/index.php/admin/students_show');
		}
		else
		{
			$data['dynamic_view'] = 'teacher_student_show'; 
	        $data['students_show'] = $this->admin_model->students_show();
	        $data['teachers_show'] = $this->admin_model->teachers_show();
	        $data['menu']=$this->menu_model->get_menu();
	        $this->load->view('templates/main',$data);
		}	
			
	}


	public function surveys_manage() {
		if($this->session->userdata('role_id')!=4) {
	            redirect('admin/show_error');    
	    }

		$this->admin_model->survey_show();
		$data['dynamic_view']='surveys_manage';
		$data['menu']=$this->menu_model->get_menu();
		$this->load->view('templates/main', $data);

	}

	public function survey_show() {	
		if($this->session->userdata('role_id')!=4) {
	        	redirect('admin/show_error');    
	    }
		if($this->admin_model->deactivate_questions()) {
			echo "Изтрихте въпроса успешно!";         
          	header('Refresh: 2; url=/survey/index.php/admin/surveys_manage');
		} 
		else {
			$this->load->model('user_model');
			$data['survey'] = $this->admin_model->survey_show();
			$data['dynamic_view']='surveys_show';
			$data['survey_name'] = $this->user_model->survey_name();
			$data['groups_show']=$this->admin_model->groups_show();	
			$data['menu']=$this->menu_model->get_menu();
			$this->load->view('templates/main', $data);
	
		}

	}
	public function students_show()
    {
        if($this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=2) {
	            redirect('admin/show_error');    
	    }
	    if(($this->session->userdata('role_id')==2 && $this->user_model->is_approved_user() ) ||
	    $this->session->userdata('role_id')==4) {
	    	 
	        $data['dynamic_view'] = 'students_show'; 
	        $data['students_show'] = $this->admin_model->students_show();
	        $data['teachers_show'] = $this->admin_model->teachers_show();
	        $data['menu']=$this->menu_model->get_menu();
	        $this->load->view('templates/main',$data);
	    } else 
	    	redirect('admin/wait_approval');
	    
    }

    public function teachers_show()
    {
    	if($this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=2) {
	            redirect('admin/show_error');    
	    }
        
        $data['dynamic_view'] = 'teachers_show'; 
        $data['teachers_show'] = $this->admin_model->teachers_manage();
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data);
    }

    public function deactivate_teacher()
    {
    	if($this->session->userdata('role_id')!=4) {
	            redirect('admin/show_error');    
	    }
        if($this->admin_model->deactivate_teacher()) {
            echo "Изтрихте учителя успешно!";   
            header('Refresh: 2; url=/survey/index.php/admin/teachers_show' );
        } 
        else 
        {
           	$data['dynamic_view'] = 'teachers_show'; 
	        $data['teachers_show'] = $this->admin_model->teachers_manage();
	        $data['menu']=$this->menu_model->get_menu();
	        $this->load->view('templates/main',$data);
        }
    }

	public function unapproved_users_show() 
	{
		if($this->session->userdata('role_id')!=4) {
	            redirect('admin/show_error');    
	    }
		$data['dynamic_view'] = 'unapproved_users_show';        
        $data['unapproved_users'] = $this->admin_model->unapproved_users_show();
        $data['menu']=$this->menu_model->get_menu();        
        $this->load->view('templates/main',$data);
           
	}

	public function approve_users() {
		if($this->session->userdata('role_id')!=4) {
	            redirect('admin/show_error');    
	    }

		$data['dynamic_view'] = 'unapproved_users_show';        
        $data['unapproved_users'] = $this->admin_model->unapproved_users_show();;
        $this->admin_model->approve_users();
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data);
    }

    public function deactivate_student()
    {
    	if($this->session->userdata('role_id')!=4) {
	            redirect('admin/show_error');    
	    }
        if($this->admin_model->deactivate_student()) {
            echo "Деактивирахте ученика успешно!";   
            header('Refresh: 2; url=/survey/index.php/admin/students_show' );
        } 
        else 
        {
            $data['dynamic_view'] = 'students_show'; 
	        $data['students_show'] = $this->admin_model->students_show();
	        $data['teachers_show'] = $this->admin_model->teachers_show();
	        $data['menu']=$this->menu_model->get_menu();
	        $this->load->view('templates/main',$data);
        }
    }

    public function edit_students()
    {
    	if($this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=2) {
	            redirect('admin/show_error');    
	    }
        if($this->admin_model->edit_students()) {
            echo "Изтрихте учениците успешно!";
            $teacher_id = $this->uri->segment(3);
			$school_id = $this->uri->segment(4);
            header('Refresh: 2; url=/survey/index.php/admin/edit_students/'.$teacher_id .'/' .$school_id);
        }
        else
        { 
           
            $data['dynamic_view'] = 'edit_students'; 
            $data['select_students']=$this->admin_model->select_students();
            $data['select_teachers_students']=$this->admin_model->select_teachers_students();
            $data['teacher_name']=$this->admin_model->teacher_name();
            $data['menu']=$this->menu_model->get_menu();
            $this->load->view('templates/main',$data);
        }
    }
    
    public function delete_teachers_from_coord()
    {
    	if($this->session->userdata('role_id')!=4 || $this->session->userdata('role_id')!=5) {
	            redirect('admin/show_error');    
	    }
        if($this->admin_model->delete_teachers_from_coord()) {
            echo "Изтрихте учителите успешно!";
            $coordinator_id = $this->uri->segment(3);
			
            header('Refresh: 2; url=/survey/index.php/admin/edit_coordinators/'.$coordinator_id );
        }
        else
        { 
           
            $data['dynamic_view'] = 'edit_coordinators'; 
            $data['select_teachers']=$this->admin_model->teachers_with_coordinators();
            $data['select_coord_teachers']=$this->admin_model->select_teachers_by_coordinator();
            $data['teacher_name']=$this->admin_model->teacher_name();
            $data['menu']=$this->menu_model->get_menu();
            $this->load->view('templates/main',$data);
        }
    }

    public function edit_teachers()
    { 
	    if($this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=2) {
	            redirect('admin/show_error');    
	    }           
            $data['dynamic_view'] = 'edit_teachers'; 
            $data['select_teachers']=$this->admin_model->show_teachers();
            $data['select_teachers_students']=$this->admin_model->select_teachers_by_student();
            $data['teacher_name']=$this->admin_model->teacher_name();
            $data['menu']=$this->menu_model->get_menu();
            $this->load->view('templates/main',$data);      
    }

    public function delete_teachers()
    {
    	if($this->session->userdata('role_id')!=4) {
	            redirect('admin/show_error');    
	    }
        if($this->admin_model->delete_teachers()) {
            echo "Изтрихте учителите успешно!";
            $student_id = $this->uri->segment(3);
			$school_id = $this->uri->segment(4);
            header('Refresh: 2; url=/survey/index.php/admin/edit_teachers/'.$student_id .'/' .$school_id);
        }
        else
        { 
           
            $data['dynamic_view'] = 'edit_teachers'; 
            $data['select_teachers']=$this->admin_model->show_teachers();
            $data['select_teachers_students']=$this->admin_model->select_teachers_by_student();
            $data['teacher_name']=$this->admin_model->teacher_name();
            $data['menu']=$this->menu_model->get_menu();
            $this->load->view('templates/main',$data);
       }
    }

    public function add_students()
    {
    	if($this->session->userdata('role_id')!=4) {
	            redirect('admin/show_error');    
	    }
        if($this->admin_model->add_students()) {
            echo "Добавихте учениците успешно!";
            $teacher_id = $this->uri->segment(3);
			$school_id = $this->uri->segment(4);
            header('Refresh: 2; url=/survey/index.php/admin/edit_students/'.$teacher_id .'/' .$school_id);
        }
        else
        { 
           
            $data['dynamic_view'] = 'edit_students'; 
            $data['select_students']=$this->admin_model->select_students();
            $data['select_teachers_students']=$this->admin_model->select_teachers_students();
            $data['teacher_name']=$this->admin_model->teacher_name();
            $data['menu']=$this->menu_model->get_menu();
            $this->load->view('templates/main',$data);
        }
    }

    public function add_teachers()
    {

    	if($this->session->userdata('role_id')!=4) {
            redirect('admin/show_error');    
        } 
        if($this->admin_model->add_teachers()) {
            echo "Добавихте учителите успешно!";
            $student_id = $this->uri->segment(3);
			$school_id = $this->uri->segment(4);
            header('Refresh: 2; url=/survey/index.php/admin/edit_teachers/'.$student_id .'/' .$school_id);
        }
        else
        { 
           
            $data['dynamic_view'] = 'edit_teachers'; 
            $data['select_teachers']=$this->admin_model->show_teachers();
            $data['select_teachers_students']=$this->admin_model->select_teachers_by_student();
            $data['teacher_name']=$this->admin_model->teacher_name();
            $data['menu']=$this->menu_model->get_menu();
            $this->load->view('templates/main',$data);
        }
    }

    public function add_teachers_to_coord()
    {
    	if($this->session->userdata('role_id')!=4 || $this->session->userdata('role_id')!=5) {
	            redirect('admin/show_error');    
	    }
        if($this->admin_model->add_teachers_to_coord()) {
            echo "Добавихте учителите успешно!";
            $coordinator_id = $this->uri->segment(3);
			$school_id = $this->uri->segment(4);
            header('Refresh: 2; url=/survey/index.php/admin/edit_coordinators/'.$coordinator_id );
        }
        else
        { 
           
            $data['dynamic_view'] = 'edit_coordinators'; 
            $data['select_teachers']=$this->admin_model->teachers_with_coordinators();
            $data['select_coord_teachers']=$this->admin_model->select_teachers_by_coordinator();
            $data['teacher_name']=$this->admin_model->teacher_name();
            $data['menu']=$this->menu_model->get_menu();
            $this->load->view('templates/main',$data);
        }
    }

    public function coordinators_show() {
    	if($this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=5) {
	            redirect('admin/show_error');    
	    }
	    $data['dynamic_view'] = 'coordinators_show'; 
	    $data['coordinators_show']=$this->admin_model->coordinators_show();
	    $data['menu']=$this->menu_model->get_menu();
	    $this->load->view('templates/main',$data);
    }

    public function edit_coordinators()
    {
	    if($this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=5) {
		    redirect('admin/show_error');    
		}

        $data['dynamic_view'] = 'edit_coordinators'; 
        $data['select_teachers']=$this->admin_model->teachers_with_coordinators();
        $data['select_coord_teachers']=$this->admin_model->select_teachers_by_coordinator();
        $data['teacher_name']=$this->admin_model->teacher_name();
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data);      
    }
    
    public function deactivate_coordinator() {
    	if($this->session->userdata('role_id')!=4) {
	            redirect('admin/show_error');    
	    }
        if($this->admin_model->deactivate_coordinator()) {
            echo "Изтрихте координатора успешно!";  
                
            header('Refresh: 2; url=/survey/index.php/admin/coordinators_show' );
        } 
        else 
        {
             $data['dynamic_view'] = 'coordinators_show'; 
	        $data['coordinators_show']=$this->admin_model->coordinators_show();
	        $data['menu']=$this->menu_model->get_menu();
	        $this->load->view('templates/main',$data);

        }
    }




}