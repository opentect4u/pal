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
                <li class="breadcrumb-item active">Ledger Report</li>
            </ol>
        </div>
    </div>

    <div class="row">
    
        <div class="col-12">

            <div class="card">

                <div class="card-body" id="divToPrint">

                <h4 align="center"><?php echo 'Leave Ledger Report Between '.date('d-m-Y',strtotime($date[0])).' To '.date('d-m-Y',strtotime($date[1])); ?></h4>


                    <div class="card-subtitle">
                        <p>Sick Leave: <?php echo @$open_bal->ml_bal; ?></p>
                        <p>Earn Leave: <?php echo @$open_bal->el_bal; ?></p>
                        <p>Comp Off: <?php echo @$open_bal->comp_off_bal; ?></p>
                        <p>Employee Code :<?php echo $emp_code;?></p>
                        <p>Employee Code :<?php foreach($emp_name as $r_name){
                                                echo $r_name->emp_name;
                                                }
                                          ?>      
                        </p>                        
                        
                    </div>


                    
                    <div class="table-responsive">

                    
                    <table id="demo-foo-addrow" style="width: 100%;" class="table m-t-30 table-hover contact-list">

                            <thead>

                                <tr>
                                
                                    <th width="15%">Date</th>
                                    <th>SL</th>
                                    <th>SL Balance</th>
                                    <th>EL</th>
                                    <th>EL Balance</th>
                                    <th>Comp Off</th>
                                    <th>Comp Off Balance</th>

                                </tr>

                            </thead>
                            
                            <tbody> 

                                <?php 

                               
                                if($remaining_bal) {
                                    
                                    foreach($remaining_bal as $r_dtls) {

                                ?>

                                        <tr>

                                            <td><?php echo $r_dtls->balance_dt; ?></td>
                                            <td><?php echo $r_dtls->ml_out; ?></td>
                                            <td><?php echo $r_dtls->ml_bal; ?></td>
                                            <td><?php echo $r_dtls->el_out; ?></td>
                                            <td><?php echo $r_dtls->el_bal; ?></td>
                                            <td><?php echo $r_dtls->comp_off_out; ?></td>
                                            <td><?php echo $r_dtls->comp_off_bal; ?></td>

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

                    </div>

                </div>

            </div>
            
        </div>

    </div>

    <div class="card-footer">
        <button class="btn print-btn tValHide" type="button" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Print" style="width: 95px;" id="" onclick="printReport();"><i class="fa fa-print fa-lg" aria-hidden="true"></i></button>
    </div> 

    <script>
        $(document).ready(function(){
            $('table').DataTable({
                dom: 'Bfrtip',
                paging: false,
                searching: false,
                buttons: [
                    'excel'
                ]
            });
        });
    </script>