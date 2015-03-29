<?php
class Chart extends CI_Controller {
   
    public function __construct() {
        parent::__construct();
         
        $this->load->library('table');
        $this->load->library('session'); 
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('user_model'); 
        $this->load->model('menu_model'); 
         $this->load->model('charts_model'); 
    
    }

    function activity_chart()
	 {
	 	 $this->load->model('result_model'); 
        $data['total_rows'] =$this->result_model->total_rows();
        $data['result_question1'] = $this->result_model->result_question();

        $data['activity_chart']=$this->result_model->result_question();
		//$data['activity_chart']=$this->charts_model->get_activity();
	 	// $data['dynamic_view']='result';
	 	 //$data['dynamic_view']='piechart';
         $data['dynamic_view']='piechart2';
	 	   $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main', $data);
	 }

	 public function primer() {
        $this->load->model('result_model'); 
        $data['activity_chart']=$this->result_model->result_question();
	 	$data['dynamic_view']='survey';
	 	$data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main', $data);
	 }










   }