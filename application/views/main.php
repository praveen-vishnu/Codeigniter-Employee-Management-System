
      <!DOCTYPE html>
      <html lang="en">
      <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title><?= $title; ?></title>

        <!-- Bootstrap core CSS -->
        <link href="<?= base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <!-- Datetime Picker -->
        <link href="<?= base_url(); ?>assets/bootstrap-datepicker/css/bootstrap-datepicker.min.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="<?= base_url(); ?>assets/custom.css" rel="stylesheet">
            <link href="<?= base_url(); ?>assets/modal.css" rel="stylesheet">

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

</head>

      <body>

        <div class="container">

          <!-- Static navbar -->
          <?php include_once(APPPATH.'views/inc/navbar.php'); ?>
          <!-- content-->

          
          <?php include_once(APPPATH.$content_view); ?>
          
        </div> 
        <!-- /container -->


          <!-- Bootstrap core JavaScript
          ================================================== -->
          <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
          <script src="<?= base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>
          <script src="<?= base_url(); ?>assets/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
          <script>
            $(document).ready(function() {
              $('.input-group.date').datepicker({
                format: 'yyyy-mm-dd',
              });
            });
          </script>

          <!-- Date Picking Range
          ================================================== -->
          <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
          <link rel="stylesheet" href="/resources/demos/style.css">
          <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
          <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
          <script>
            $( function() {
              var dateFormat = "yyyy-mm-dd",
              from = $( "#from" )
              .datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                minDate :0,
                numberOfMonths: 1
              })
              .on( "change", function() {
                to.datepicker( "option", "minDate", getDate( this ) );
              }),
              to = $( "#to" ).datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1
              })
              .on( "change", function() {
                from.datepicker( "option", "maxDate", getDate( this ) );
              });
              
              function getDate( element ) {
                var date;
                try {
                  date = $.datepicker.parseDate( dateFormat, element.value );
                } catch( error ) {
                  date = null;
                }
                
                return date;
              }
            } );
          </script>
          <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css">
  <style type="text/css" class="init">
  
  </style>
 
  <script type="text/javascript" language="javascript" src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script type="text/javascript" language="javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript" class="init">


/* Custom filtering function which will search data in column four between two values */
$.fn.dataTable.ext.search.push(
  function( settings, data, dataIndex ) {
    var min = new Date( $('#min').val());
    var max = new Date( $('#max').val());
    var age = date( data[2] ) || 0; // use data for the age column

    if ( ( isNaN( min ) && isNaN( max ) ) ||
       ( isNaN( min ) && age <= max ) ||
       ( min <= age   && isNaN( max ) ) ||
       ( min <= age   && age <= max ) )
    {
      return true;
    }
    return false;
  }
);

$(document).ready(function() {
  var table = $('#example').DataTable();
  
  // Event listener to the two range filtering inputs to redraw on input
  $('#min, #max').keyup( function() {
    table.draw();
  } );
} );


  </script>

        </body>
        </html>
