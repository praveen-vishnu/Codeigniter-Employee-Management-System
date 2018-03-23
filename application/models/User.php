<?php

    //User Model
class User extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

        //Add a user
    public function addUser($data) {
        $this->db->insert('ems_users', $data);
    }

        //get a user
    public function getUser($username) {
        return $this->db->get_where('ems_users',['username' => $username])->row();
    }
    public function getemp($username,$password) {

        return $this->db->get_where('ems_employee',['emp_address' => $username , 'emp_pass' => $password])->row();


    }

    public function getWorkHours($emp_id)
    {
        return $this->db->get_where('works_hours', ['empid' => $emp_id])->result();

    }
    
    public function workshours_login($emp_id)
    {
     $data = [ 'empid' => $emp_id,'Login'  => date('Y-m-d G:i:s')];
     $this->db->insert('works_hours', $data);
     $last_id = $this->db->insert_id();
     $array = array(
         'work_hours_id' => $last_id
         );

     $this->session->set_userdata( $array );
 }
 public function workshours_logout()
 {
     $data = ['Logout'  => date('Y-m-d G:i:s')];
     $this->db->where('id', $this->session->userdata('work_hours_id'));
     $this->db->update('works_hours', $data);


 }


 public function setLastLogin($emp_id){
   $this->db->where('emp_id', $emp_id);
   $this->db->update('ems_employee', [ 'last_login'  => date('Y-m-d g:i:s')]);
}


}
