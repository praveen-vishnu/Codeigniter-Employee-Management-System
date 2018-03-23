<?php
//This is the main controller
date_default_timezone_set("Asia/Kolkata");
defined('BASEPATH') OR exit('No direct script access allowed');

class MainController extends CI_Controller {
    
    private $project_name = 'Employee management';

    public function __construct() {
        parent::__construct();

        //check the user if not logged in
        if($this->session->userdata('username') === NULL ) {
            redirect('userlogin');
        }
    }

    public function index() {

         if($this->session->userdata('username') === 'admin' ) {
        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Home';
        $data['content_view'] = 'views/pages/home.php';
        
        $this->load->view('main', $data);
    }
    else{
        redirect('emphome');
    }
    }

    public function emp_home() {

	 if($this->session->userdata('emp_id') === NULL ) {
            redirect('userlogin');
        }
        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Home';
        $data['content_view'] = 'views/pages/userhome.php';
       
       $data['hours'] = $this->user->getWorkHours($this->session->userdata('emp_id'));       
       $data['pending'] = $this->employee->PendingLeaves($this->session->userdata('emp_id'));
       $data['approved'] = $this->employee->ApprovedLeaves($this->session->userdata('emp_id'));

       $this->load->view('usermain', $data);
    }

  
    public function request_leave() {
        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Request Leave';
        $data['content_view'] = 'views/pages/req-leave.php';
        $data['employee'] =  $this->employee->getEmployee($this->session->userdata('id'));
        $this->load->view('usermain', $data);
    }





    public function request_leave_process($id) {

        
        $employee=  $this->employee->getEmployee($id);
        $datetime1 = new DateTime($this->input->post('from'));

        $datetime2 = new DateTime($this->input->post('to'));

        $difference = $datetime1->diff($datetime2);
$data = [
            'emp_id'            => $employee->emp_id,
            'leaves_left'       => $employee->leaves_left,
            'reason_for_leave'  => $this->input->post('reason_for_leave'),
            'total_leave_days'  => $difference->d,
            'leave_from'        => $datetime1->format('Y-m-d'),
            'leave_to'          => $datetime2->format('Y-m-d'),
            'status'            => 0
        ];

       // echo "<pre>";
       // print_r($data); 
       // print_r($employee);
        if($this->employee->req_leave($data)) {
            $this->session->set_flashdata('add-success', 'Request Sent!');
            redirect('emphome');
        } else {
            $this->session->set_flashdata('add-failed', 'Error on requesting leave.');
            redirect('req_leave');
        }
    }


    public function employee() {

        $config['base_url'] = site_url().'/employee';
        $config['total_rows'] = $this->db->count_all('ems_employee');
        $config['per_page'] = 7;
        $config['uri_segment'] = 2;

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";   

        $this->pagination->initialize($config);

        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Employee List';
        $data['content_view'] = 'views/pages/employee-list.php';

        //get all employee
        $data['employees'] = $this->employee->getAllEmployees($config['per_page'], $this->uri->segment(2));
        
        $this->load->view('main', $data);
    }

    public function add_employee() {
        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Add Employee';
        $data['content_view'] = 'views/pages/employee-add.php';
        $data['emp_id'] = $this->generateEmployeeId();
        
        $this->load->view('main', $data);
    }
	

	  
    public function add_employee_process() {

        $data = [
            'emp_id'      => $this->generateEmployeeId(),
            'emp_name'    => $this->input->post('emp_name'),
            'emp_bday'    => $this->input->post('emp_bday'),
            'emp_address' => $this->input->post('emp_address'),
            'emp_salary'  => $this->input->post('emp_salary'),
            'emp_pass'  => md5($this->input->post('emp_pass'))
        ];

        //print_r($data);

        if($this->employee->addEmployee($data)) {
            $this->session->set_flashdata('add-success', 'New Employee Added!');
            redirect('employee');
        } else {
            $this->session->set_flashdata('add-failed', 'Error on adding new employee.');
            redirect('add');
        }
    }

    public function update_employee($id) {

        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Update Employee';
        $data['content_view'] = 'views/pages/employee-update.php';
        $data['employee'] =  $this->employee->getEmployee($id);
        
        $this->load->view('main', $data);
    }
public function leave_grant($id) {

       
    $this->employee->leaveGrant($id);
    redirect('leaverequests');

        
       
    }
public function leave_reject($id) {

      
    $this->employee->leaveReject($id);
    redirect('leaverequests');
        
    }

    public function update_employee_process($id) {
        $data = [
            'emp_name'    => $this->input->post('update_emp_name'),
            'emp_bday'    => $this->input->post('update_emp_bday'),
            'emp_address' => $this->input->post('update_emp_address'),
            'emp_salary'  => $this->input->post('update_emp_salary')
        ];

        if($this->employee->updateEmployee($id, $data)) {
            $this->session->set_flashdata('update-success', ' Employee has been updated!');
            redirect('employee');
        } else {
            $this->session->set_flashdata('update-failed', 'Error on updating an employee.');
            redirect('update/'.$id);
        }
    }

    public function delete($id) {
        if($this->employee->delete($id)) {
            redirect('employee');
        }
    }
    public function leavegrant($id) {
        if($this->employee->delete($id)) {
            redirect('employee');
        }
    }
    public function leavedeny($id) {
        if($this->employee->delete($id)) {
            redirect('employee');
        }
    }


    

    private function generateEmployeeId() {
        $last = $this->employee->getLast();
        $id = substr($last->emp_id, 3);
        $id += 1;
        return 'EMS'.$id;
    }

    public function leaverequests() {

        $config['base_url'] = site_url().'/leaverequests';
        $config['total_rows'] = $this->db->count_all('emp_leaves');
        $config['per_page'] = 7;
        $config['uri_segment'] = 2;

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";   

        $this->pagination->initialize($config);

        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Employee Leave List';
        $data['content_view'] = 'views/pages/admin-side-leave-list.php';

        //get all employee
        $data['employees'] = $this->employee->getAllLeaves($config['per_page'], $this->uri->segment(2));
        
        $this->load->view('main', $data);
    }

    public function leavehistory() {

        $config['base_url'] = site_url().'/leaverequests';
        $config['total_rows'] = $this->db->count_all('emp_leaves');
        $config['per_page'] = 7;
        $config['uri_segment'] = 2;

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";   

        $this->pagination->initialize($config);

        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Employee Leave List';
        $data['content_view'] = 'views/pages/leaves-list.php';

        //get all employee
        $data['employees'] = $this->employee->getAllLeaves($config['per_page'], $this->uri->segment(2));
        
        $this->load->view('usermain', $data);
    }
public function leavepending() {

        $config['base_url'] = site_url().'/leaverequests';
        $config['total_rows'] = $this->db->count_all('emp_leaves');
        $config['per_page'] = 7;
        $config['uri_segment'] = 2;

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";   

        $this->pagination->initialize($config);

        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Employee Leave List';
        $data['content_view'] = 'views/pages/leaves-list.php';

        //get all employee
        $data['status'] = 0;
        $data['employees'] = $this->employee->getPendingLeaves($config['per_page'], $this->uri->segment(2),$this->session->userdata('emp_id'));
       
          $this->load->view('usermain', $data);
    }
    public function leavecancelled() {

        $config['base_url'] = site_url().'/leaverequests';
        $config['total_rows'] = $this->db->count_all('emp_leaves');
        $config['per_page'] = 7;
        $config['uri_segment'] = 2;

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";   

        $this->pagination->initialize($config);

        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Employee Leave List';
        $data['content_view'] = 'views/pages/leaves-list.php';

        //get all employee
        $data['employees'] = $this->employee->getCancelledLeaves($config['per_page'], $this->uri->segment(2),$this->session->userdata('emp_id'));
       
          $this->load->view('usermain', $data);
    }
    public function leaveapproved() {

        $config['base_url'] = site_url().'/leaverequests';
        $config['total_rows'] = $this->db->count_all('emp_leaves');
        $config['per_page'] = 7;
        $config['uri_segment'] = 2;

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";   

        $this->pagination->initialize($config);

        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Employee Leave List';
        $data['content_view'] = 'views/pages/leaves-list.php';

        //get all employee
        $data['employees'] = $this->employee->getApprovedLeaves($config['per_page'], $this->uri->segment(2),$this->session->userdata('emp_id'));
       
          $this->load->view('usermain', $data);
    }
public function workhours_list() {
        
        $config['base_url'] = site_url().'/workhours_list';
        $config['total_rows'] = $this->db->count_all('works_hours');
        $config['per_page'] = 7;
        $config['uri_segment'] = 2;

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";   

        $this->pagination->initialize($config);

        

        $data['project_name'] = $this->project_name;
        $data['title'] = $this->project_name.' | Employee List';
        $data['content_view'] = 'views/pages/work-hours-list.php';

        //get all employee
        $data['employees'] = $this->employee->getAllWorkHours($config['per_page'], $this->uri->segment(2));

        $this->load->view('main', $data);
    }



    public function logout() {
       $this->user->workshours_logout();
       $this->user->setLastLogin($this->session->userdata('emp_id'));
       $this->session->unset_userdata(['status','id','username','name']);
       redirect('userlogin');
   }

}
