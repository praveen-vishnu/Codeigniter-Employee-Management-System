<div class="row">
    <div class="col-md-6 col-md-offset-3">

        <div class="panel panel-default">
            <div class="panel-heading"><h3 class="text-center">Admin Login</h3></div>

            <div class="panel-body">
                <?php if($this->session->flashdata('error_login')): ?> 
                    <div class="alert alert-danger"> 
                        <?= $this->session->flashdata('error_login') ?>
                    </div>
                <?php endif; ?>


                <?php echo form_open('login-process',['id' => 'demo-form2"', 'class' => 'form-horizontal form-label-left']); ?>
 	
                    <div class="form-group">
                        <?php
                            $label_args = ['class' => 'control-label col-md-4 col-sm-4 col-xs-12'];
                            echo form_label('Username','username', $label_args);
                        ?>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php
                            $input_args = [
                                'name'      => 'username',
                                'id'        => 'username',
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
                            echo form_label('Password','password', $label_args);
                        ?>
                        <div class="col-md-8 col-sm-8 col-xs-12">
                            <?php
                            $input_args = [
                                'name'      => 'password',
                                'id'        => 'password',
                                'type'      => 'password',
                                'required'  => 'required',
                                'class'     => 'form-control'
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
                            'value' => 'Login'
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
