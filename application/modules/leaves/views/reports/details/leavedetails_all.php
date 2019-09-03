<script>
    function printReport() { 
    $('#hie').show();   
  var divToPrint = document.getElementById('divToPrint');

  var WindowObject = window.open('','Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title>');

        WindowObject.document.writeln('<style type="text/css">@media print { .center { text-align: center;} .underline { text-decoration: underline; } p { display:inline; } .left { margin-left: 315px; text-align="left"; display: inline; } .right { margin-right: 375px; display: inline; } td.left_algn { text-align: left; } td.right_algn { text-align: right; } td.hight { hight: 15px; } table.width { width: 100px; } table.noborder { border: 0px solid black; } th.width { width: 10px; } .border { border: 1px solid black; } .bottom { position: absolute; bottom: 5px; width: 100%; } .tValHide { display:none; } } </style>');
       
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        $('#hie').hide();
        setTimeout(function(){WindowObject.close();},10);
    }
</script>


<div class="row page-titles">
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Leaves</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Leave</a></li>
            <li class="breadcrumb-item active">All Leave Details</li>
        </ol>
    </div>
</div>

<div class="row">

    <div class="col-12">

        <div class="card">

            <div id = "divToPrint" class="card-body">
                
                <table id="demo-foo-addrow" style="width: 100%;" class="table m-t-30 table-hover contact-list">

                       
                        <h3 align="center"><?php echo "Leave Details For All Employee Between ".date('d-m-Y',strtotime($dates[0])).' And '.date('d-m-Y',strtotime($dates[1])); ?></h3>
                    <thead>

                        <tr>
                        
                            <th>Leave No</th>
                            <th>Application Date</th>
                            <th>Employee Code</th>
                            <th>Name</th>
                            <th>Leave Type</th>
                            <!--<th>Leave Period</th>-->
                            <th>No.of Days</th>
                            <!--<th>Recommendation Date</th>
                            <th>Recommended By</th>
                            <th>Approval Date</th>
                            <th>Reason</th>-->

                        </tr>

                    </thead>

                    <tbody> 

                        <?php 
                        
                        if($leave_dtls_all) {
                            
                            foreach($leave_dtls_all as $l_dtls) {

                                if($l_dtls->leave_type=='E'){
                                    $leaveDtls = "EL";
                                }elseif($l_dtls->leave_type=='HE'){
                                    $leaveDtls = "Half EL";    
                                }elseif($l_dtls->leave_type=='M'){
                                    $leaveDtls = "Sick Leave";
                                }elseif($l_dtls->leave_type=='HM'){
                                    $leaveDtls = "Half Sick Leave";
                                }elseif($l_dtls->leave_type=='C'){
                                    $leaveDtls = "Comp.Off";
                                }elseif($l_dtls->leave_type=='HC'){
                                    $leaveDtls = "Half Comp.Off";
                                }elseif($l_dtls->leave_type=='N'){
                                    $leaveDtls = "National Holidays";
                                }else{
                                    $leaveDtls = "Half National Holidays";
                                }

                        ?>

                                <tr>

                                    <td><?php echo $l_dtls->trans_cd; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($l_dtls->trans_dt)); ?></td>
                                    <td><?php echo $l_dtls->emp_code; ?></td>
                                    <td><?php echo $l_dtls->emp_name;?></td>
                                    <td><?php echo $leaveDtls; ?></td>
                                    <!--<td><?php echo date('d-m-Y', strtotime($l_dtls->from_dt)).' To '.date('d-m-Y', strtotime($l_dtls->to_dt)); ?></td>-->
                                    <td><?php echo $l_dtls->amount; ?></td>
                                    <!--<td><?php echo date('d-m-Y', strtotime($l_dtls->recommend_dt)); ?></td>
                                    <td><?php echo $l_dtls->recommend_by; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($l_dtls->approval_dt)); ?></td>
                                    <td><?php echo $l_dtls->reason; ?></td>-->
                                    <!--<td><a href="javascript:void(0)" class="view" title="View" id="<?php //echo $l_dtls->trans_cd; ?>">

                                            <i class="mdi mdi-36px mdi-eye" style="color: #7b8299"></i>
                                            
                                    </td></a>-->

                                </tr>
                        <?php
                                
                                }

                            }

                            else {

                                echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td></tr>";

                            }
                        ?>

                    </tbody>

                    

                </table>

                <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            
                    <div class="modal-dialog modal-lg">

                        <div class="modal-content">
                            
                            <div id="modal"></div>
                            
                        </div>

                    </div>

                    </div>

                    <div class="card-footer">
                        <button class="btn print-btn tValHide" type="button" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print" style="width: 95px;" id="" onclick="printReport();"><i class="fa fa-print fa-lg" aria-hidden="true"></i></button>
        
        
                        <a data-toggle="tooltip" data-original-title="Save As Excel" class="btn btn-lg btn-success" href="<?php echo site_url('leaves/pwExpence_xlsx');?>">
                        
                        <span class="fa-stack fa-lg">
                                    <i class="fa fa-file-excel-o fa-stack-1x">Excel</i>
                        </span>
                            
                        </a>
                    </div> 

                </div>

            </div>

        </div>

    </div>

</div>

<script>

    $(document).ready(function(){
        
        $('.view').click(function(){

            $.get(
                
                "<?php echo site_url('leave/detail_all') ?>",

                {
                    trans_cd: $(this).attr('id')
                }
                
                ).done(function(data){
                    
                    $('#modal').html(data);
                    $('#add-contact').modal('show');

            });

        });

    });


</script>