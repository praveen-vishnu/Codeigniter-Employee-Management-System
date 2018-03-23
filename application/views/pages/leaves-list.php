<div class="row">
    <div class="col-md-12">

        <?php if($this->session->flashdata('add-success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('add-success'); ?>
            </div>
        <?php endif; 


        ?>    


        <?php if($employees): ?>
            <table class="table table-striped">
                <center><thead>
                <tr>
                    <th>#</th>
                    <th>Employee ID</th>
                    <th>Leave From</th>
                    <th>Leave to</th>
                    <th>Total Leave Days</th>
                    <th>Reason For Leave</th>
                  <?php 
                        if($employees[0]->status == 0){ ?>
                       <th>Cancel Leave</th>
                  <?php  }
                  ?>


                </tr>
                </thead>
                <tbody>
                    <?php $s=1;
                    foreach($employees as $employee):
                    
                     ?>
                        <tr>
                            <td><?= $employee->id; ?></td>
                            <td><?= $employee->emp_id; ?></td>
                            <td>
                                <?php
                                    $date = date_create($employee->leave_from);
                                    echo date_format($date, 'F, j Y'); 
                                ?>
                             </td>
<td>
                                <?php
                                    $date = date_create($employee->leave_to);
                                    echo date_format($date, 'F, j Y'); 
                                
                                ?>
                             </td>
                            <td><?= $employee->total_leave_days; ?></td>
                            <td><a href="#viewReason_<?php echo $s; ?>" class="delete" data-toggle="modal"><?php $da = $this->employee->getleavereason($employee->id)->reason_for_leave;?>View</a>
                           
                       
       
    </td>
    <td> <?php 

     if($employee->status == 0){ ?> <a href="<?=  site_url()."/leave_reject/".$employee->id; ?>" class="delete" title="Delete" data-toggle="tooltip"><i style="color:red"class="material-icons" >&#xE5C9;</i></a><?php }?> </td>
    
     </tr>

  <div id="viewReason_<?php echo $s; ?>" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <form>
                    <div class="modal-header">                      
                        <h4 class="modal-title">Reason For a Leave</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    </div>
                    <div class="modal-body" style="word-break: break-all;">                    
                     <?= $da; ?>
                    </div>
                   
                </form>
            </div>
        </div>
    </div>
                     <?php $s++; endforeach; ?> 
                </tbody>
                </center>
            </table>

            <?= $this->pagination->create_links(); ?>
        <?php else: ?> 
            <h3>No Leaves info</h3>    
        <?php endif; ?>
    </div>
</div>
<!-- Delete Modal HTML -->
    