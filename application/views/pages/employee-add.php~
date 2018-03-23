<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <?php if($this->session->flashdata('add-failed')): ?>
            <div class="alert alert-danger">
                <?= $this->session->flashdata('add-failed'); ?>
            </div>
        <?php endif; ?>  
        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="text-center">Add New Employee</h3></div>

            <div class="panel-body">
                <?php echo form_open('addProcess',['class' => 'form-horizontal form-label-left']); ?>

                    <div class="form-group">
                        <?php
                            $label_args = ['class' => 'control-label col-md-4 col-sm-4 col-xs-12'];
                            echo form_label('Employee ID','emp_id', $label_args);
                        ?>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php
                            $input_args = [
                                'name'      => 'emp_id',
                                'id'        => 'emp_id',
                                'required'  => 'required',
                                'class'     => 'form-control',
                                'disabled'  => 'disabled',
                                'value'     => $emp_id
                            ];
                            echo form_input($input_args);
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php
                            $label_args = ['class' => 'control-label col-md-4 col-sm-4 col-xs-12'];
                            echo form_label('Employee Name','emp_name', $label_args);
                        ?>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php
                            $input_args = [
                                'name'      => 'emp_name',
                                'id'        => 'emp_name',
                                'required'  => 'required',
                                'class'     => 'form-control'
                            ];
                            echo form_input($input_args);
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php
                            $label_args = ['class' => 'control-label col-md-4 col-sm-4 col-xs-12'];
                            echo form_label('Employee Birthdate','emp_bday', $label_args);
                        ?>

                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <div class="input-group date">
                                <input type="text" class="form-control" name="emp_bday"><span class="input-group-addon"><i class="glyphicon glyphicon-th"></i></span>
                            </div>
                        </div>
                    </div>    


                    <div class="form-group">
                        <?php
                            $label_args = ['class' => 'control-label col-md-4 col-sm-4 col-xs-12'];
                            echo form_label('Employee Address','emp_address', $label_args);
                        ?>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php
                            $input_args = [
                                'rows'       => '3',
                                'name'      => 'emp_address',
                                'id'        => 'emp_address',
                                'required'  => 'required',
                                'class'     => 'form-control'
                            ];
                            echo form_textarea($input_args);
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <?php
                            $label_args = ['class' => 'control-label col-md-4 col-sm-4 col-xs-12'];
                            echo form_label('Employee Salary','emp_salary', $label_args);
                        ?>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php
                            $input_args = [
                                'name'      => 'emp_salary',
                                'id'        => 'emp_salary',
                                'required'  => 'required',
                                'class'     => 'form-control ',
                                'type'      => 'number'
                            ];
                            echo form_input($input_args);
                            ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-4 col-sm-offset-4">
                        <?php
                            $args = [
                            'type' => 'submit',
                            'class' => 'btn btn-success',
                            'value' => 'Add Employee'
                            ];
                            echo form_input($args);
                        ?>
                        </div>
                    </div>
              <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>