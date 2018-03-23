<?php

    //User Model
    class Employee extends CI_Model {

        public function __construct() {
            parent::__construct();
        }

 public function getAllWorkHours($limit, $offset)
    {
            if (isset($_POST['search_submit'])){


              // print ($_POST['min']);
              // echo "<br>";
              // print ($_POST['max']);
              // echo "<br>";
              // print ($_POST['empid']);

                $Login = $_POST['min'];
                $Logout = $_POST['max'];
                $empid = $_POST['empid'];

                $select_table = "select * from works_hours WHERE ";
                $condition = $select_table." 1";

              if (isset($_POST['min']) && !empty($_POST['min'])    && isset($_POST['empid']) && !empty($_POST['empid'])   && isset($_POST['max']) && !empty($_POST['max']) ) {

                
                $condition = $select_table."Login >= '$Login'  and Logout <= '$Logout' and empid = '$empid'";

             }
             elseif (isset($_POST['min']) && !empty($_POST['min']) &&  
                    isset($_POST['max']) && !empty($_POST['max']) ) {

                
                $condition = $select_table."Login >= '$Login'  and Logout <= '$Logout' ";

             }
             elseif (isset($_POST['empid']) && !empty($_POST['empid'])   && isset($_POST['max']) && !empty($_POST['max']) ) {

                
                $condition = $select_table." Logout <= '$Logout' and empid = '$empid'";

             }
             elseif (isset($_POST['min']) && !empty($_POST['min'])    && isset($_POST['empid']) && !empty($_POST['empid'])) {

                
                $condition = $select_table."Login >= '$Login'  and  empid = '$empid'";

             }
             elseif (isset($_POST['min']) && !empty($_POST['min'])   ) {

                
                $condition = $select_table."Login >= '$Login'";

             }
             elseif (isset($_POST['empid']) && !empty($_POST['empid']) ) {

                
                $condition = $select_table." empid = '$empid'";

             }
             elseif (isset($_POST['max']) && !empty($_POST['max']) ) {

                
                $condition = $select_table."Logout <= '$Logout'";

             }

             else{
                              $condition = $select_table." 1";

             }

        $this->db->limit($limit, $offset);
       // echo $condition;
        return $this->db->query($condition)->result();
           }
         else{

        $this->db->limit($limit, $offset);
        return $this->db->get('works_hours')->result();

         }
    }
    
         public function getAllLeaves($limit, $offset) {
            $this->db->limit($limit, $offset);
            return $this->db->get('emp_leaves')->result();
        }

           public function getPendingLeaves($limit, $offset,$emp_id) {
            $this->db->limit($limit, $offset);
             return $this->db->get_where('emp_leaves',['emp_id' =>$emp_id ,'status' => 0])->result();
        }
          public function getApprovedLeaves($limit, $offset,$emp_id) {
            $this->db->limit($limit, $offset);
             return $this->db->get_where('emp_leaves',['emp_id' =>$emp_id ,'status' => 1])->result();
        }
          public function getCancelledLeaves($limit, $offset,$emp_id) {
            $this->db->limit($limit, $offset);
             return $this->db->get_where('emp_leaves',['emp_id' =>$emp_id ,'status' => 2])->result();
        }

        //fetch all employees
        public function getAllEmployees($limit, $offset) {
            $this->db->limit($limit, $offset);
            return $this->db->get('ems_employee')->result();
        }

        //get employee by id
        public function getEmployee($id) {
             return $this->db->get_where('ems_employee',['id' => $id])->row();
        }
 //get leave reason by id
        public function getleavereason($id) {
             
              $this->db->select('reason_for_leave');
             return $this->db->get_where('emp_leaves',['id' => $id])->row();
        }
        //Add an Employee
        public function addEmployee($data) {
            $this->db->insert('ems_employee', $data);
            return true;
        }

        //get last inserted employee
        public function getLast() {
            $this->db->order_by('id', 'DESC');
            $this->db->limit(1);
            return $this->db->get('ems_employee')->row();
        }

        //update an employee
        public function updateEmployee($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('ems_employee', $data);
        }  
          
        // public function leavegrant($emp_id) {
            
        //     $this->db->where('emp_id', $emp_id);
        //     return $this->db->update('ems_employee', ['leaves_left' => $this->db->get ]);
        // }
        public function leavedeny($id, $data) {
            $this->db->where('id', $id);
            return $this->db->update('ems_employee', $data);
        }

        //delete employee
        public function delete($id) {
            $this->db->where('id', $id);
            return $this->db->delete('ems_employee');
        }

        //request  an leave
        public function req_leave($data) {
            $this->db->insert('emp_leaves', $data);
            return true;
        }


  public function leaveGrant($id) {
            $this->db->where('id', $id);
            return $this->db->update('emp_leaves', ['status' => 1]);
        } 
  public function leaveReject($id) {
            $this->db->where('id', $id);
            return $this->db->update('emp_leaves', ['status' => 2]);
        }

         public function getleaveleft($id) {
         return $this->db->get_where('emp_leaves',['emp_id' => $id])->row();
        }
         public function PendingLeaves($emp_id){
             $query = $this->db->select_sum('total_leave_days');
             $query = $this->db->get_where('emp_leaves',['emp_id' =>$emp_id ,'status' => 0]);
             return  $query->result();
             // return $result[0]->Dues_Paid_Tot;
        }
          public function ApprovedLeaves($emp_id) {
           
            $query = $this->db->select_sum('total_leave_days');
             $query = $this->db->get_where('emp_leaves',['emp_id' =>$emp_id ,'status' => 1]);
             return  $query->result();        }

    }