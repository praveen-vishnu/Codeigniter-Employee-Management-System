<?php
//This is the auth controller
date_default_timezone_set("Asia/Kolkata");

defined('BASEPATH') OR exit('No direct script access allowed');

class AuthController extends CI_Controller {
    
    private $project_name = 'Employee management';

    public function __construct() {
        parent::__construct();
        //check if already logged in the user
        if($this->session->userdata('username') !== NULL ) {
            redirect('/');
        }
    }

    //This is the login view
    public function index() {

        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Login';
        $data['content_view'] = 'views/pages/userlogin.php';
        
        $this->load->view('main', $data);
    }
public function admin_login() {
        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Login Employee';
        $data['content_view'] = 'views/pages/adminlogin.php';

        
        $this->load->view('main', $data);
    }

public function reg_employee() {
        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Register Employee';
        $data['content_view'] = 'views/pages/register.php';

        
        $this->load->view('main', $data);
    }
    //This is the process for Admin login
    public function adminloginProcess() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if(empty($username) || empty($password)) {
            $this->session->set_flashdata('error_login','Username or Password must not empty');
            redirect('adminlogin');
        } else {
            $user = $this->user->getUser($username);
            if($user) {

                if($this->bcrypt->check_password($password, $user->password)) {
                    $userdata = [
                        'status'    => 'Online',
                        'id'        => $user->id,
                        'username'  => $user->username,
                        'name'      =>  $user->name
                    ];

                    $this->session->set_userdata($userdata);
                    redirect('/');

                } else {
                    $this->session->set_flashdata('error_login', 'Incorrect username or password');
                    redirect('adminlogin');
                }

            }else {
            $this->session->set_flashdata('error_login', 'Incorrect username or password');
            redirect('adminlogin');
            }
        }
    }

 //This is the process for User login
    public function userloginProcess() {
        $username = $this->input->post('username');
        $password = $this->input->post('password');

        if(empty($username) || empty($password)) {
            $this->session->set_flashdata('error_login','Username or Password must not empty');
            redirect('userlogin');
        } else {
            $user = $this->user->getemp($username,md5($password));
            if($user) {

                $this->user->workshours_login($user->emp_id);
   		 $userdata = [
                        'status'     => 'Online',
                        'id'         => $user->id,
                        'username'   => $user->emp_name,
                        'emp_id'     => $user->emp_id,
                        'last_login' => $user->last_login, 
                        'leaves_left' => $user->leaves_left
                    ];


                    $this->session->set_userdata($userdata);
		            redirect('/emphome');

                

            }else {
            $this->session->set_flashdata('error_login', 'Incorrect username or password');
            redirect('userlogin');
            }
        }
    }


   private function generateEmployeeId() {
        $last = $this->employee->getLast();
        $id = substr($last->emp_id, 3);
        $id += 1;
        return 'EMS'.$id;
    }
public function reg_employee_process() {

        $data = [
            'emp_id'      => $this->generateEmployeeId(),
            'emp_name'    => $this->input->post('emp_name'),
            'emp_bday'    => $this->input->post('emp_bday'),
            'emp_address' => $this->input->post('emp_address'),
            'emp_pass'    => md5($this->input->post('emp_pass')),
            'last_login'  => date('Y-m-d g:i:s')
        ];

        //print_r($data);

        if($this->employee->addEmployee($data)) {
            $this->session->set_flashdata('add-success', 'You are Added!');
            redirect('userlogin');
        } else {
            $this->session->set_flashdata('add-failed', 'Error on adding.');
            redirect('reg');
        }
    }


    //This method is for generate admin and encryption of password

    // public function generateAdmin() {
    //     $data = [
    //         'username' => 'admin',
    //         'password' => $this->bcrypt->hash_password('admin'),
    //         'name'     => 'Admin',
    //         ]; 
    //     $this->user->addUser($data);
    // }
}
