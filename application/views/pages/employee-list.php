<div class="row">
    <div class="col-md-12">

        <?php if($this->session->flashdata('add-success')): ?>
            <div class="alert alert-success">
                <?= $this->session->flashdata('add-success'); ?>
            </div>
        <?php endif; ?>    

        <a href="<?= site_url(); ?>/add" class="btn btn-primary ">New Employee</a>
        <br><br>

        <?php if($employees): ?>
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Employee Name</th>
                    <th>Employee Birthdate</th>
                    <th>Employee Email</th>
                    <th>Employee Salary</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                    <?php foreach($employees as $employee): ?>
                        <tr>
                            <td><?= $employee->emp_id; ?></td>
                            <td><?= $employee->emp_name; ?></td>
                            <td>
                                <?php
                                    $date = date_create($employee->emp_bday);
                                    echo date_format($date, 'F, j Y'); 
                                ?>
                             </td>
                            <td><?= $employee->emp_address; ?></td>
                            <td><?= number_format($employee->emp_salary, 2); ?></td>

                            <td>
                                <a href="<?= site_url(); ?>update/<?= $employee->id; ?>" class="btn btn-success btn-sm">Update</a>
                                <a href="<?= site_url(); ?>delete/<?= $employee->id; ?>" class="btn btn-danger btn-sm">Delete</a>
                            </td>
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
