 
        <form method="post">
         

           <input id="min" name="min" type="date"/> 
           <input id="max" name="max" type="date"/> 
           <input id="empid" name="empid" type="text"/> 
           <input type="submit" name="search_submit" class="btn btn-primary"/> 

        </form> 

        
    <div class="row">
    <div class="col-md-12">

        <?php if($this->session->flashdata('add-success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('add-success'); ?>
            </div>
        <?php endif; ?>    

        <br><br>

        <?php if($employees): ?>

  
            <table id="example" class="table table-striped table-hover display">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Employee Id</th>
                    <th> Login  Date / Time </th>
                    <th> Logout Date / Time </th>
                    <th> No. of Work Hours </th>
                    <th> &nbsp; </th>
                   
                </tr>
                </thead>
                <tbody>
                    <?php foreach($employees as $employee): ?>
                        <tr>
                            <td><?= $employee->id; ?></td>
                            <td><?= $employee->empid; ?></td>
                            <td>
                                <?php 
                                     $date = date_create($employee->Login); 
                                     echo date_format($date, 'F, j Y @ g:i'); 
                                ?>
                             </td>
                            <td>
                                <?php
                                    $date = date_create($employee->Logout);
                                    echo date_format($date, 'F, j Y @ g:i'); 
                                ?>
                             </td>
                             <td> <?
$total_hrs = 0;
$total_min = 0;


 $date1 = strtotime($employee->Login);
 $date2 = strtotime($employee->Logout); 
 
 $hours = round(($date2 - $date1) / 3600 ,2);
//echo $hours.'<br/>';
$total_hrs = $total_hrs + $hours;
$total_min = $total_min + round(abs($date2 - $date1) / 60, 2);
//echo $total_min; 
echo $hours;

 ?></td>
                    <td> &nbsp; </td>

                        </tr>
                    <?php endforeach; ?> 
                    
                </tbody>
                
            </table>
            <?= $this->pagination->create_links(); ?>
        <?php else: ?> 
            <h3>No Employee</h3>    
        <?php endif; ?>
    </div>
</div>



