<?php
class Home extends CI_Controller {
   
    public function __construct() {
        parent::__construct();
         
        $this->load->library('table');
        $this->load->library('session'); 
        $this->load->helper('url');
        $this->load->database();
        $this->load->model('menu_model'); 
        $this->load->model('user_model');   
        $this->load->model('admin_model');   
    }


    public function index()
    {
       
        $data['dynamic_view'] = 'login_form';
        $data['code']=$this->user_model->code_check();
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data);  
    }

    public function register()
    {

        $this->form_validation->set_rules('first_name', 'Име', 'trim|required');
        $this->form_validation->set_rules('last_name', 'Фамилия', 'trim|required'); 
        $this->form_validation->set_rules('username', 'Потребителско име', 'trim|required|min_length[6]|max_length[12]|is_unique[users.username]');
        $this->form_validation->set_rules('password', 'Парола', 'trim|required|min_length[6]'); 
        $this->form_validation->set_rules('password2', 'Потвърдете паролата', 'trim|required|matches[password]');  
        $this->form_validation->set_rules('email', 'Имейл', 'trim|required|valid_email');
        $this->form_validation->set_rules('location', 'Населено място', 'trim|required');
        $this->form_validation->set_rules('school', 'Училище', 'required');
        $this->form_validation->set_rules('class', 'Клас', 'required');
        $this->form_validation->set_rules('role_id', 'Роля', 'required');
          
        if ($this->form_validation->run()==FALSE)
        {
            $this->signup();
        }
        else 
        {  
            if( $this->user_model->register())
            {
                $data['dynamic_view'] = 'success_reg'; 
                $this->load->view('templates/main',$data);
            }
            else
            {
                $this->load->model('user_model');   
                $data['dynamic_view'] = 'register_form2'; 
                $data['regions'] = $this->user_model->regions_show();
                $data['classes'] = $this->user_model->classes_show();
                $data['school_show'] = $this->user_model->school_show();
                $data['class_divisions'] = $this->user_model->class_divisions_show();
                $data['all_teachers_show'] = $this->user_model->all_teachers_show();
                $this->load->view('templates/main',$data);
            }   
        }
    }

    
    public function get_schools() {

        $this->load->model('user_model');
        $region = $this->input->post('region');
        $schools = $this->user_model->get_schools_by_region($region);
        echo json_encode($schools);
    }

    public function get_teachers() {
        
        $this->load->model('user_model');
        $school = $this->input->post('school');
        $teachers = $this->user_model->get_teachers_by_school($school);
        echo json_encode($teachers);

    }

    public function signup()
    {
        $data['menu']=$this->menu_model->get_menu();
        $data['dynamic_view'] = 'register_form';
        $region = $this->input->post('region');
        $data['classes'] = $this->user_model->classes_show();
        $data['class_divisions'] = $this->user_model->class_divisions_show();
        $data['all_teachers_show'] = $this->user_model->all_teachers_show();
        $data['school_show'] = $this->user_model->school_show();
        $data['regions'] = $this->user_model->regions_show();
        $this->load->view('templates/main',$data);  
    }

    public function login ()
    {
            
        $this->load->model('user_model');
        $user=$this->user_model->login();
        
        $this->form_validation->set_rules('username', 'Потребителско име', 'trim|required|callback_login_check');
        $this->form_validation->set_rules('password', 'Парола', 'trim|required'); 

        if ($this->form_validation->run()==FALSE)
        {

            $this->index();
        }
        else 
        {
            if(count($user) > 0 )    
            {
                $this->load->library('session'); 
            
                 $data = array(
                    'username' => $user['username'],
                    'user_id' => $user['user_id'],
                    'is_logged_in' => TRUE,
                    'role_id' => $user['role_id']
                
                );
                $this->session->set_userdata($data);         
                
                redirect('index/surveys_show');
            }
        }
    }

    public function login_show ()
    {
            
        $this->load->model('user_model');
        $user=$this->user_model->login();

        $this->form_validation->set_rules('username', 'Потребителско име', 'trim|required|callback_login_check');
        $this->form_validation->set_rules('password', 'Парола', 'trim|required'); 

        if ($this->form_validation->run()==FALSE)
        {

            $this->signup_show();
        }
        else 
        {
            if(count($user) > 0)    
            {
                $this->load->library('session'); 
            
                $data = array(
                    'username' => $user['username'],
                    'user_id' => $user['user_id'],
                    'is_logged_in' => TRUE,
                    'role_id' => $user['role_id']
                
                );
                $this->session->set_userdata($data);
     
                redirect('index/surveys_show');
           
            }
        }
    }

    public function signup_show()
    {        
        $data['dynamic_view'] = 'logout';
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main',$data);  
    }
    
    public function logout()
    { 
        $this->session->sess_destroy();
        $data['dynamic_view']='logout';
        $data['menu']=$this->menu_model->get_menu();
        $this->load->view('templates/main', $data);

    }

    public function login_check()
    {
        $username = $this->input->post('username');
        $password = $this->input->post('password'); 
       
        if ($this->user_model->login($username, $password)) 
        {
            
            return TRUE;
        } 
        else
        {
            $this->form_validation->set_message('login_check', 'Грешно име или парола');
            return FALSE;
        }
             
    } 
    
    public function code_check()
    {      
        $this->form_validation->set_rules('code', 'Код', 'trim|required'); 
        if ($this->form_validation->run()==FALSE)
        {

            $this->index();
        }
        else 
        {
            if($this->user_model->code_check()) {
                redirect('index/results_show');
            } else {
                echo "Няма данни!";
                header('Refresh: 2; url=/survey/index.php/home/index/');             
            }
        }
    }



}

