<!DOCTYPE html>
<html lang="en">
<meta http-equiv="content-type" content="text/html;charset=UTF-8" />
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title>Report Occupancy - Tempo Scan Tower</title>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <link href= "<?=base_url('assets/css/bootstrap.min.css')?>" rel="stylesheet">
    <link href= "<?=base_url('assets/css/nifty.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/plugins/font-awesome/css/font-awesome.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/plugins/switchery/switchery.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/plugins/bootstrap-select/bootstrap-select.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/css/nifty-demo.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/plugins/pace/pace.min.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/plugins/datatables/media/css/dataTables.bootstrap.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/plugins/datatables/extensions/Responsive/css/dataTables.responsive.css')?>" rel="stylesheet">
    <link href="<?=base_url('assets/sweetalert-master/dist/sweetalert.css')?>" rel="stylesheet">
    <link rel="stylesheet" href="<?=base_url()?>assets/home/css/daterangepicker.css">
    <link rel="shortcut icon" href="<?=base_url()?>assets/img/logo-tempo-transparent.png" />
    <script src="<?=base_url('assets/plugins/pace/pace.min.js')?>"></script>
    <script src="<?=base_url('assets/sweetalert-master/dist/sweetalert.min.js')?>"></script>
    <script src="<?=base_url('assets/js/jquery-2.1.1.min.js')?>"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
    <style>
    th, td{
    font-family: montserrat;
}
    </style>
</head>
<style>
    body{
        font-family: montserrat;
    }        

  label{
      font-size: 1.1em;
  }  

.cntr {
  position: absolute;
  top: calc(50% - 10px);
  left: 0;
  width: 100%;
  text-align: center;
}

c {
    font-size: 1.1em;
    font-weight: normal;
}

d {
    font-size: 1.3em;
    font-weight: bold;
}
hr{
    border: 0;
    margin: 0;
    height: 0.1vw;    
    background-color: #eee;
}
    </style>
<body>
<?php
$search_period = $this->session->userdata('SEARCH_PERIOD_REPORT_OCCUPANCY');

if($search_period == ""){
  $search_period = date('01/m/Y')." - ".date('t/m/Y');
}
$period = str_replace("/","-",str_replace(" ","",$search_period));
 ?>
<div id="container" class="effect mainnav-lg">

    <!--NAVBAR-->
    <!--===================================================-->
    <?php
    $this->load->view('backend/layout/header');
    ?>
    <!--===================================================-->
    <!--END NAVBAR-->

    <div class="boxed">

        <!--CONTENT CONTAINER-->
        <!--===================================================-->
        <div id="content-container">

 			<div id="page-content">
                <div class="panel panel-primary"> 
                    <div class="panel-heading" style="background: #455a64">
                        <h3 class="panel-title"><b>Report Occupancy</b></h3>
                    </div>

                    <div class="panel-body">      
                      <div style="margin-left: 2%;margin-top: 2%;">
                      <div class="row" style="display: flex;margin: 0;margin-bottom: 1.5%">
                          <div class="col col-lg-1" style="padding-right:0;padding-left:0;margin-right: 1rem">
                          <h4>Periode :</h4>
                          </div>

                          <div class="col col-md-4 col-lg-4" style="padding-left:0px">
                            <input type="text" class="form-control" id="period" name="period" placeholder="Period" value="<?=$search_period?>">
                            
                          </div>                                                    
                          </div>
                          <a style="background: #455a64;font-family:montserrat" class="btn btn-primary" onclick="generate_report()">GENERATE REPORT</a>
                    </div>               
                    <div id="generate_report" style="display: none;">
                    </div>
                    </div>                                                                                          
                        </div>
                </div>
                <!--===================================================-->
                <!--<!--End page content-->
                <div class="modal fade" id="modalLoading" role="dialog">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-body" style="text-align:center">
                  <p>Please wait...</p>
                  <i class="fa fa-circle-o-notch fa-spin" style="font-size:24px"></i>
                </div>
              </div>
            </div>
          </div>

            </div>
        </div>
        <!--===================================================-->
        <!--END CONTENT CONTAINER-->

        <?php
        $this->load->view('backend/layout/sidebar');
        ?>

    </div>



    <!-- FOOTER -->
    <!--===================================================-->
    <?php
    $this->load->view('backend/layout/footer');
    ?>
    <!--===================================================-->
    <!-- END FOOTER -->


    <!-- SCROLL TOP BUTTON -->
    <!--===================================================-->
    <button id="scroll-top" class="btn"><i class="fa fa-chevron-up"></i></button>
    <!--===================================================-->



</div>
<!--===================================================-->
<!-- END OF CONTAINER -->
<!--JAVASCRIPT-->
<!--=================================================-->




<!--BootstrapJS [ RECOMMENDED ]-->
<script src="<?=base_url('assets/js/bootstrap.min.js')?>"></script>


<!--Fast Click [ OPTIONAL ]-->
<script src="<?=base_url('assets/plugins/fast-click/fastclick.min.js')?>"></script>


<!--Nifty Admin [ RECOMMENDED ]-->
<script src="<?=base_url('assets/js/nifty.min.js')?>"></script>


<!--Switchery [ OPTIONAL ]-->
<script src="<?=base_url('assets/plugins/switchery/switchery.min.js')?>"></script>


<!--Bootstrap Select [ OPTIONAL ]-->
<script src="<?=base_url('assets/plugins/bootstrap-select/bootstrap-select.min.js')?>"></script>
<!--Demo script [ DEMONSTRATION ]-->
<!--DataTables [ OPTIONAL ]-->
<script src="<?=base_url('assets/plugins/datatables/media/js/jquery.dataTables.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/media/js/dataTables.bootstrap.js')?>"></script>
<script src="<?=base_url('assets/plugins/datatables/extensions/Responsive/js/dataTables.responsive.min.js')?>"></script>
<!--Demo script [ DEMONSTRATION ]-->
<script src="<?=base_url('assets/js/demo/nifty-demo.min.js')?>"></script>
<!--DataTables Sample [ SAMPLE ]-->
<script src="<?=base_url('assets/js/demo/tables-datatables.js')?>"></script>
<script type="text/javascript" src="<?=base_url()?>assets/home/js/moment.min.js"></script>
<script type="text/javascript" src="<?=base_url()?>assets/home/js/daterangepicker.min.js"></script>

<script>      
$(function() {
        $('input[name="period"]').daterangepicker(function(start, end, label) {
            console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
        });
    });

    function showLoading(){              
              $('#modalLoading').modal({backdrop: 'static', keyboard: false});
            };

    function generate_report(){
      var period = $('#period').val();
      $.ajax({
   url: "<?php echo site_url('admin/report_occupancy/get_data'); ?>",
   type: 'post',
   data: {period: period},
   dataType: "json",
   success: function(response){      
     $('#generate_report').html(response);
     $('#generate_report').show();     
   }
 });      
    }

    $(document).ready(function(){
    var interval = setInterval(function () {
            $.ajax({
                    url : "<?php echo site_url('admin/my_task/count_my_task'); ?>",
                    type: "GET",                    
                    dataType: "json",
                    success: function(data)
                    {                                                            
                      $("#badge_my_task").text(data.count);
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {                              
                        console.log(errorThrown);                        
                    }
                });
        },1000);
    });
  
</script>
</body>
</html>