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
		
       
	}
	public function show_error() {

		$data['dynamic_view']='show_error';
		$data['menu']=$this->menu_model->get_menu();
		$this->load->view('templates/main', $data);

	}
	
	public function questions() {
		if($this->session->userdata('role_id')!=4) {
			redirect('admin/show_error');
			
		} 

		$data['dynamic_view']='add_questions';
		$data['select_surveys'] =  $this->admin_model->surveys_show();
		$data['menu']=$this->menu_model->get_menu();
		$this->load->view('templates/main', $data);

	}

	public function add_questions() {
		$this->form_validation->set_rules('question', 'Въпрос', 'trim|required');
        $this->form_validation->set_rules('survey', 'Анкета', 'required'); 

        if ($this->form_validation->run()==FALSE )
			
        {
            $this->questions();
        }
      
        else
        { 
			
			if($this->admin_model->add_questions()) {
				echo "Добавихте въпроса успешно!";
				 header('Refresh: 2; url=/survey/index.php/admin/questions');
			}
			else
			{
				$data['select_surveys'] =  $this->admin_model->surveys_show();
				$data['dynamic_view']='add_questions';
				$data['menu']=$this->menu_model->get_menu();
				$this->load->view('templates/main', $data);
			}
			
		}

	}


}