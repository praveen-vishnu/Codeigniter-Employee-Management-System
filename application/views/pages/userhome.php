<!-- This is the content of home -->
<main>
	<section>
		<div class="rad-body-wrapper rad-nav-min">
			<div class="container-fluid">
				<header class="rad-page-title">
				<div class="row">
					<div class="col-lg-3 col-xs-6">
						<div class="rad-info-box rad-txt-success">

							<span class="heading">Last Login</span>
							<span class="value"><span><?php $date = date_create($this->session->userdata('last_login'));
                     echo date_format($date, 'F, j Y @ g:i');?></span></span>
						</div>
					</div>
					<div class="col-lg-3 col-xs-6">
						<div class="rad-info-box rad-txt-primary">



			<?php 
				 if($pending)
				 {
				foreach ($pending as $pending_va) {
					//print_r($pending_va);
					$Pending = $pending_va->total_leave_days;
				}
				}
				else 
				{
					$Pending = 0;
				}
				if($approved){
				foreach ($approved as $approved_va) {
					//print_r($pending_va);
					$Approved = $approved_va->total_leave_days;
				}
			}
				else 
				{
					$Approved = 0;
				}
		

					$leaves_are_left = 15 - ($Pending + $Approved);
							

								?>
								
								


							<span class="heading">Leaves Left</span>
							<span class="value"><span><?= $leaves_are_left; ?></span></span>
						</div>
					</div>
					<div class="col-lg-3 col-xs-6">
						<div class="rad-info-box rad-txt-danger">

							<span class="heading">Total Leaves</span>
							<span class="value"><span>15</span></span>
						</div>
					</div>
					
					<div class="col-lg-3 col-xs-6">
						<div class="rad-info-box rad-txt-danger">
<?
$total_hrs = 0;
$total_min = 0;
foreach ($hours as $hour) {
	

 $date1 = strtotime($hour->Login);
 $date2 = strtotime($hour->Logout); 
 
 $hours = round(($date2 - $date1) / 3600 ,2);
//echo $hours.'<br/>';
$total_hrs = $total_hrs + $hours;

$total_min = $total_min + round(abs($date2 - $date1) / 60, 2);

}
//echo $total_min; 
 ?>
							<span class="heading">Work Hours</span>
							<span class="value"><span><?= $total_hrs." Hours" ?></span></span>
						</div>
					</div>
				</div>


				
</main>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js'></script>
<script src='http://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js'></script>
<script src='http://code.jquery.com/ui/1.11.4/jquery-ui.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jQuery-slimScroll/1.3.3/jquery.slimscroll.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/lodash.js/3.8.0/lodash.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/d3/3.5.5/d3.min.js'></script>
<script src='http://jvectormap.com/js/jquery-jvectormap-2.0.3.min.js'></script>
<script src='http://jvectormap.com/js/jquery-jvectormap-world-mill-en.js'></script>

  

