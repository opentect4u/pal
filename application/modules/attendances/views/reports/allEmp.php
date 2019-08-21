<div class="row page-titles">

    <div class="col-md-8 col-12 align-self-center">

        <h3 class="text-themecolor m-b-0 m-t-0">Attendance</h3>

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="javascript:void(0)">Attendance</a></li>

            <li class="breadcrumb-item active">All Employee's Attendance</li>

        </ol>

    </div>

    <div class="col-md-4 col-12 align-self-center">
        <div id="alert" class="alert alert-<?php echo $this->session->flashdata('msg')['status']; ?>"></div>
    </div>

</div>

<?php
if($_SERVER['REQUEST_METHOD'] == "GET"){

?>

    <div class="row">

        <div class="col-lg-12">

            <div class="card card-outline-info">

                <div class="card-header">

                    <h4 class="m-b-0 text-white">Generate Payslips</h4>
                    
                </div>

                <div class="card-body">

                    <form class="form-horizontal" 
                        id="form"
                        method="post" 
                        action="<?php echo site_url('attendance/report/all-emp');?>"
                    >
                    
                        <div class="form-body">
                            
                            <div class="row">
                                        
                                <div class="col-md-6">
                            
                                    <div class="form-group">
                            
                                        <label class="control-label">Date</label>
                            
                                        <input type="date" 
                                               class="form-control" 
                                               name="date"
                                               requied
                                            >
                            
                                    </div>
                            
                                </div>
                            
                            </div>      
                                
                        </div>

                        <div class="form-actions">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="row">

                                        <div class="col-md-offset-3 col-md-9">

                                            <button type="submit" class="btn btn-success">Proceed</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>
<?php
}
else{
?>
<script>
  function printDiv() {

        var divToPrint = document.getElementById('divToPrint');

        var WindowObject = window.open('', 'Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;} .underline { text-decoration: underline; } p { display:inline; } .left { margin-left: 315px; text-align="left" display: inline; } .right { margin-right: 375px; display: inline; } td.left_algn { text-align: left; } td.right_algn { text-align: right; } .t2 td, th { border: 1px solid black; } td.hight { hight: 15px; } table.width { width: 100%; } table.noborder { border: 0px solid black; } th.noborder { border: 0px solid black; } .border { border: 1px solid black; } .bottom { position: absolute;; bottom: 5px; width: 100%; } } </style>');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function () {
            WindowObject.close();
        }, 10);

  }
</script>
<div class="row">
    
    <div class="col-12">

        <div class="card">

            <div class="card-body">

                <h6 class="card-subtitle"></h6>

                <div class="table-responsive">

                    <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">

                        <thead>

                            <tr>
                            
                                <th>ID</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Attendance</th>

                            </tr>

                        </thead>

                        <tbody> 

                            <?php 
                            
                            if($attendance_dtls) {
                                
                                    foreach($attendance_dtls as $e_dtls) {

                            ?>

                                    <tr>

                                        <td><?php echo $e_dtls->emp_code; ?></td>
                                        <td><?php echo $e_dtls->emp_name; ?></td>
                                        <td><?php echo $e_dtls->department; ?></td>
                                        <td>
                                        
                                            <span class="badge badge-<?php echo ($e_dtls->status == "P")? 'success' : 'danger'; ?>"><?php echo ($e_dtls->status == "P")? 'Present':'Absent'; ?></span> 

                                        </td>

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
<?php
}
?>