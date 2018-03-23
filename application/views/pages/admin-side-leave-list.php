<style type="text/css">
	body {
		color: #566787;
		background: #f5f5f5;
		font-family: 'Roboto', sans-serif;
	}
	.table-wrapper {
		width: 1100px;
		background: #fff;
		padding: 20px 30px 5px;
		margin: 30px auto;
		box-shadow: 0 0 1px 0 rgba(0,0,0,.25);
	}
	.table-title .btn-group {
		float: right;
	}
	.table-title .btn {
		min-width: 50px;
		border-radius: 2px;
		border: none;
		padding: 6px 12px;
		font-size: 95%;
		outline: none !important;
		height: 30px;
	}
	.table-title {
		border-bottom: 1px solid #e9e9e9;
		padding-bottom: 15px;
		margin-bottom: 5px;
		background: rgb(0, 50, 74);
		margin: -20px -31px 10px;
		padding: 15px 30px;
		color: #fff;
	}
	.table-title h2 {
		margin: 2px 0 0;
		font-size: 24px;
	}
	table.table tr th, table.table tr td {
		border-color: #e9e9e9;
		padding: 12px 15px;
		vertical-align: middle;
	}
	table.table tr th:first-child {
		width: 40px;
	}
	table.table tr th:last-child {
		width: 100px;
	}
	table.table-striped tbody tr:nth-of-type(odd) {
		background-color: #fcfcfc;
	}
	table.table-striped.table-hover tbody tr:hover {
		background: #f5f5f5;
	}
	table.table td a {
		color: #2196f3;
	}
	table.table td .btn.manage {
		padding: 2px 10px;
		background: #37BC9B;
		color: #fff;
		border-radius: 2px;
	}
	table.table td .btn.manage:hover {
		background: #2e9c81;		
	}
</style>
<div class="table-wrapper">
	<div class="table-title">
		<div class="row">
			<div class="col-sm-6"><h2>Employees <b>Leaves</b></h2></div>
			<div class="col-sm-6">
				<div class="btn-group" data-toggle="buttons">
					<label class="btn btn-info approved">
						<input type="radio" name="status" value="all" checked="checked"> All
					</label>
					<label class="btn btn-success">
						<input type="radio" name="status" value="approved"> approved
					</label>
					<label class="btn btn-warning">
						<input type="radio" name="status" value="pending"> pending
					</label>
					<label class="btn btn-danger">
						<input type="radio" name="status" value="cancelled"> cancelled
					</label>							
				</div>
			</div>
		</div>
	</div>
	<?php if($employees): ?>

		<table class="table table-striped table-hover">
			<thead>
				<tr>
					<th>#</th>
					<th>Employee ID</th>
					<th>Status</th>
					<th>Leave From</th>
					<th>Leave to</th>
					<th>Total Leave Days</th>
					<th>Reason For Leave</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody><?php $s=1;
				$labelD = "label label-danger";
				$labelW = "label label-warning";
				$labelS = "label label-success";
				foreach($employees as $employee):

					?>
				<?php if(($employee->status) == 1)
				{$data_status = "approved";  } 
				elseif (($employee->status) == 0)  
					{$data_status = "pending";  } 
				else 
					$data_status = "cancelled";
				?>
				<tr data-status="<?= $data_status ;?>">
					<td><?= $employee->id; ?></td>
					<td><?= $employee->emp_id; ?></td>
					<td><span class= "<?php if(($employee->status) == 1)
				{echo $labelS ;  } 
				elseif (($employee->status) == 0)  
					{ echo $labelW;  } 
				else 
					echo $labelD
				?>" ><?= $data_status; ?></span></td>
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
					<td><a href="#viewReason_<?php echo $s; ?>" class="delete" data-toggle="modal" class="btn btn-sm manage">View</a></td>
					<td>
						<a href="<?= site_url()."/leave_grant/".$employee->id; ?>" class="delete" title="Grant" data-toggle="tooltip"><i class="material-icons" style="color:green">beenhere</i></a>
						<a href="<?=  site_url()."/leave_reject/".$employee->id; ?>" class="delete" title="Cancel" data-toggle="tooltip"><i style="color:red"class="material-icons" >&#xE5C9;</i></a>
					</tr> <div id="viewReason_<?php echo $s; ?>" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<form>
								<div class="modal-header">                      
									<h4 class="modal-title">Reason For a Leave</h4>
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body" style="word-break: break-all;">                    
									<?= $this->employee->getleavereason($employee->id)->reason_for_leave; ?>
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


