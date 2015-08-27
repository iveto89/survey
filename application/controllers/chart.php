<?php
class Chart extends CI_Controller {
   
    public function __construct() {
        parent::__construct();
          
        $this->load->model('menu_model'); 
        $this->load->model('charts_model'); 
    
    }
    /* Show piechart */
    public function activity_chart()
	{
        if($this->session->userdata('role_id')!=4 && $this->session->userdata('role_id')!=1 &&
            $this->session->userdata('role_id')!=2 && $this->session->userdata('role_id')!=5) {
            redirect('authentication/show_error');   
        } 
        
	 	$this->load->model('result_model'); 
        $data['total_rows'] =$this->result_model->total_rows();
        $data['result_question1'] = $this->result_model->result_question();
        $data['activity_chart']=$this->result_model->result_question();
        $data['dynamic_view']='results/piechart2';
	 	$data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main', $data);
	}

	






   }