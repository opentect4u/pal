<div class="row page-titles">

    <div class="col-md-8 col-12 align-self-center">

        <h3 class="text-themecolor m-b-0 m-t-0">Payroll</h3>

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="javascript:void(0)">Payroll</a></li>

            <li class="breadcrumb-item active">Payslip Details</li>

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

                    <h4 class="m-b-0 text-white">Payroll Report</h4>
                    
                </div>

                <div class="card-body">

                    <form class="form-horizontal" 
                        id="form"
                        method="post" 
                        action="<?php echo site_url('payroll/payslipdetails');?>"
                    >
                    
                        <div class="form-body">
                            
                            <div class="row">
                                        
                                <div class="col-md-6">
                            
                                    <div class="form-group">
                            
                                        <label class="control-label">From Month</label>
                            
                                        <select class="form-control" name="month" id="month" required>
                            
                                            <option value="">Select Month</option>
                            
                                            <?php foreach($month_list as $m_list) {?>
                            
                                                <option value="<?php echo $m_list->month_name ?>" ><?php echo $m_list->month_name; ?></option>
                            
                                            <?php
                                                    }
                                            ?>
                            
                                        </select>
                            
                                    </div>
                            
                                </div>
                            
                            </div>    

                            <div class="row">

                                <div class="col-md-6">
                            
                                    <div class="form-group">
                        
                                        <label for="year" class="control-label">Year</label>
                            
                                        <input type="text" 
                                                class="form-control"
                                                name="year"
                                                id="year"  
                                                value="<?php echo date('Y'); ?>"   
                                        >
                                    </div>  
                            
                                </div>
                            
                            </div>    

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="emp_code" class="control-label">Employee</label>

                                        <select class="form-control" 
                                                id="emp_code"
                                                name="emp_code"
                                                >

                                            <option value="">Select</option>

                                        <?php 

                                            if($employee_dtls) {

                                                foreach($employee_dtls as $e_dtls) {

                                        ?>
                                            <option value="<?php echo $e_dtls->emp_code; ?>">
                                            
                                                <?php echo $e_dtls->emp_name.' ('.$e_dtls->department.')'; ?> 
                                            
                                            </option>
                                        
                                        <?php
                                                }
                                            }

                                        ?>

                                        </select>
                                        
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


        WindowObject.document.writeln('@media print { .center { text-align: center;} .underline { text-decoration: underline; } p { display:inline; } .left { margin-left: 315px; text-align="left" display: inline; } .right { margin-right: 375px; display: inline; } td.left_algn { text-align: left; } td.right_algn { text-align: right; } td.hight { hight: 15px; } table.width { width: 100%; } table.noborder { border: 0px solid black; } th.noborder { border: 0px solid black; } table, th, td { border: 1px solid black; } .bottom { position: absolute;; bottom: 5px; width: 100%; } } </style>');
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

            <div id="divToPrint">
            
                <div class="card-body">

                    <h2 class="card-title" style="margin-left: 42%; display: inline;"><u>Salary Slip</u> 
                        <span style="margin-left: 16%; display: inline;">
                            <img src="<?php echo base_url('/assets/images/logo1.png'); ?>" alt="homepage" class="dark-logo" height="30px" />    
                            <img src="<?php echo base_url('/assets/images/logo2.png'); ?>" class="light-logo" alt="homepage" height="30px" />
                        </span>
                    </h2>
                    <h4 class="card-title" style="text-align: center;">INDUS VALLEY AYURVEDIC CENTRE PVT LTD</h4>
                    <h4 class="card-title" style="text-align: center;">Tel: +91-821-2473437/263/266, Fax: +91-821-2473590</h4>
                    <h4 class="card-title" style="text-align: center;">LALITHADRIPURA, MYSORE 570 028</h4>

                    <h6 class="card-subtitle"></h6>

                    <div class="table-responsive">

                        <table id="demo-foo-addrow" style="width: 100%;" class="table m-t-30 table-hover contact-list">

                            <thead>

                                <tr>
                                
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Basic</th>
                                    <th>DA</th>
                                    <th>HRA</th>
                                    <th>Conveyance</th>
                                    <th>Incentives</th>
                                    <th>Misc. Earnings</th>
                                    <th>Others</th>
                                    <th>Tot Earnings</th>
                                    <th>PF</th>
                                    <th>ESI</th>
                                    <th>P-TAX</th>
                                    <th>TDS</th>
                                    <th>LWF</th>
                                    <th>Food/Accommodation</th>
                                    <th>Loans & Advance</th>
                                    <th>Laundry</th>
                                    <th>Misc. Deductions</th>
                                    <th>Fine for Absent</th>
                                    <th>Fine for Half</th>
                                    <th>Tot Deductions</th>
                                    <th>Net Salary</th>
                                    <th>Bank Name</th>
                                    <th>Bank Acc No</th>
                                    <th>PF Acc No</th>
                                    <th>ESI No</th>
                                    <th>PAN No</th>
                                    <th>IFSC No</th>
                                    <th>Base or Eligibility</th>

                                </tr>

                            </thead>
                            
                            <tbody> 

                                <?php 
                                
                                if($pay_dtls) {

                                    
                                        foreach($pay_dtls as $p_dtls) {

                                ?>

                                        <tr>

                                            <td><?php echo $p_dtls->emp_code; ?></td>
                                            <td><?php echo $p_dtls->emp_name; ?></td>
                                            <td><?php echo $p_dtls->department; ?></td>
                                            <td><?php echo $p_dtls->designation; ?></td>

                                            <td style="text-align: right;"><?php echo $p_dtls->basic; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->da; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->hra; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->conveyance; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->incentives; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->misc_ear; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->others; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->tot_earnings; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->pf; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->esi; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->p_tax; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->tds; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->lwf; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->accommodation; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->advance; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->laundry; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->misc; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->deduct_for_absent; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->deduct_for_half; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->tot_deduction; ?></td>
                                            <td style="text-align: right;"><?php echo $p_dtls->net_amount; ?></td>

                                            <td><?php echo $p_dtls->bank_name; ?></td>
                                            <td><?php echo $p_dtls->bank_ac_no; ?></td>
                                            <td><?php echo $p_dtls->pf_ac_no; ?></td>
                                            <td><?php echo $p_dtls->esi_no; ?></td>
                                            <td><?php echo $p_dtls->pan_no; ?></td>
                                            <td><?php echo $p_dtls->ifsc; ?></td>
                                            <td><?php echo $p_dtls->base_or_eligibitity; ?></td>

                                        </tr>

                                <?php
                                        
                                        }

                                    }

                                    else {

                                        echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td></tr>";

                                    }
                                ?>
                            
                            </tbody>

                            <tfoot>

                                <tr>
                                    
                                    <td style="text-align: right;" colspan="4"><b><u>Totals</u></b></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->basic; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->da; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->hra; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->conveyance; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->incentives; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->misc_ear; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->others; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->tot_earnings; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->pf; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->esi; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->p_tax; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->tds; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->lwf; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->accommodation; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->advance; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->laundry; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->misc; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->deduct_for_absent; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->deduct_for_half; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->tot_deduction; ?></td>
                                    <td style="text-align: right;"><?php echo $sum_dtls->net_amount; ?></td>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                </div>

            </div>

            <!-- <div style="text-align: center;">

                <button class="btn btn-info" type="button" onclick="printDiv();">Print</button>

            </div> -->

        </div>
        
    </div>

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
    
<?php
}
?>