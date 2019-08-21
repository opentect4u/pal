<script>
  function printDiv() {

        var divToPrint = document.getElementById('divToPrint');

        var WindowObject = window.open('', 'Print-Window');
        WindowObject.document.open();
        WindowObject.document.writeln('<!DOCTYPE html>');
        WindowObject.document.writeln('<html><head><title></title><style type="text/css">');


        WindowObject.document.writeln('@media print { .center { text-align: center;} .underline { text-decoration: underline; } p { display:inline; } .left { margin-left: 315px; text-align="left" display: inline; } .right { margin-right: 375px; display: inline; } td.left_algn { text-align: left; } td.right_algn { text-align: right; } .t2 th { border: 1px solid black; background-color: #c0c0c0; } td.hight { hight: 15px; } table.width { width: 100%; } table.noborder { border: 0px solid black; } th.noborder { border: 0px solid black; } .border { border: 1px solid black; } .bottom { position: absolute;; bottom: 5px; width: 100%; } } </style>');
        WindowObject.document.writeln('</head><body onload="window.print()">');
        WindowObject.document.writeln(divToPrint.innerHTML);
        WindowObject.document.writeln('</body></html>');
        WindowObject.document.close();
        setTimeout(function () {
            WindowObject.close();
        }, 10);

  }
</script>

<?php

    function getIndianCurrency($number) {
        
        $decimal = round($number - ($no = floor($number)), 2) * 100;
        $hundred = null;
        $digits_length = strlen($no);
        $i = 0;
        $str = array();
        $words = array(0 => '', 1 => 'One', 2 => 'Two',
            3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
            7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
            10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
            13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
            16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
            19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
            40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
            70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
        $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
        while( $i < $digits_length ) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += $divider == 10 ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
            } else $str[] = null;
        }
        $Rupees = implode('', array_reverse($str));
        $paise = ($decimal) ? "and " . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
        return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise .' Only.';
    }

?>

<style>
.t2 th { border: 1px solid black; background-color: #c0c0c0; }
.right_algn { text-align: right; }
</style>
<div class="row page-titles">
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Payroll</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Payslip</li>
        </ol>
    </div>
    <div class="col-md-4 col-12 align-self-center">
    </div>
</div>

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

                    <table class="width noborder" cellpadding="3.5">

                        <tr>
                            <th class="noborder" width="25%"></th>
                            <th class="noborder" width="1%"></th>
                            <th class="noborder" width="25%"></th>
                            <th class="noborder" width="1%"></th>
                            <th class="noborder" width="30%"></th>
                            <th class="noborder" width="1%"></th>
                            <th class="noborder" width="25%"></th>
                        </tr>
                        <tr class="t2">
                            <th colspan="7" style="text-align: center;">Pay Slip for the month of <?php echo $this->input->get('month');?> - <?php echo $this->input->get('year');?></th>
                        </tr>
                        <tr>

                            <td>Employee ID</td>
                            <td class="left_algn">:</td>
                            <td class="left_algn"><?php echo $pay_list->emp_code; ?></td>
                            <td></td>
                            <td>Bank Name</td>
                            <td class="left_algn">:</td>
                            <td><?php echo $pay_list->bank_name; ?></td>

                        </tr>

                        <tr>

                            <td>Name</td>
                            <td class="left_algn">:</td>
                            <td class="left_algn"><?php echo $pay_list->emp_name; ?></td>
                            <td></td>
                            <td>Bank A/C No.</td>
                            <td class="left_algn">:</td>
                            <td><?php echo $pay_list->bank_name; ?></td>

                        </tr>

                        <tr>

                            <td>Date of Joining</td>
                            <td class="left_algn">:</td>
                            <td class="left_algn"><?php if(($pay_list->joining_date != "0000-00-00") && ($pay_list->joining_date != NULL)){ echo date('d-m-Y', strtotime($pay_list->joining_date)); } ?></td>
                            <td></td>
                            <td>Location</td>
                            <td class="left_algn">:</td>
                            <td class="left_algn"><?php echo $pay_list->location; ?></td>                        

                        </tr>

                        <tr>

                            <td>Department</td>
                            <td class="left_algn">:</td>
                            <td class="left_algn"><?php echo $pay_list->department; ?></td>
                            <td></td>
                            <td>PF No.</td>
                            <td class="left_algn">:</td>
                            <td class="left_algn"><?php echo $pay_list->pf_ac_no; ?></td>                        

                        </tr>

                        <tr>

                            <td>Designation</td>
                            <td class="left_algn">:</td>
                            <td class="left_algn"><?php echo $pay_list->designation; ?></td>
                            <td></td>
                            <td>ESI NO</td>
                            <td class="left_algn">:</td>
                            <td class="left_algn"><?php echo $pay_list->esi_no; ?></td>                        

                        </tr>

                        <tr>

                            <td>Attendance: Base, Eligibility</td>
                            <td class="left_algn">:</td>
                            <td class="left_algn"><?php echo $pay_list->base_or_eligibitity; ?></td>
                            <td></td>
                            <td>PAN Number</td>
                            <td class="left_algn">:</td>
                            <td class="left_algn"><?php echo $pay_list->pan_no; ?></td>                        

                        </tr>

                        <tr class="t2">
                            <th colspan="2">Earnings</th>
                            <th colspan="2">Amount</th>
                            <th colspan="2">Deductions</th>
                            <th>Amount</th>
                        </tr>
                        <tr>
                            <td>BASIC</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->basic; ?></td>
                            <td></td>
                            <td>P.F</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->pf; ?></td>
                        </tr>

                        <tr>
                            <td>DA</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->da; ?></td>
                            <td></td>
                            <td>ESI</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->esi; ?></td>
                        </tr>

                        <tr>
                            <td>HRA</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->hra; ?></td>
                            <td></td>
                            <td>PT</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->p_tax; ?></td>
                        </tr>

                        <tr>
                            <td>Conveyance</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->conveyance; ?></td>
                            <td></td>
                            <td>Advance</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->advance; ?></td>

                        </tr>

                        <tr>
                            <td>Other all</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->others; ?></td>
                            <td></td>
                            <td>Misc</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->misc; ?></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"></td>
                            <td></td>
                            <td>Dedudct for Absent</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->deduct_for_absent; ?></td>
                        </tr>

                        <tr>
                            <td></td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"></td>
                            <td></td>
                            <td>Dedudct for Half</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->deduct_for_half; ?></td>
                        </tr>

                        <tr class="t2">
                            <th colspan="2">Total Earnings</th>
                            <th colspan="2" class="right_algn"><?php echo $pay_list->tot_earnings; ?></th>
                            <th colspan="2">Total Deductions</th>
                            <th class="right_algn"><?php echo $pay_list->tot_deduction; ?></th>
                        </tr>

                        <tr>
                            <td>Net Pay</td>
                            <td class="right_algn">:</td>
                            <td class="right_algn"><?php echo $pay_list->net_amount; ?></td>
                            <td></td>
                            <td></td>
                            <td class="right_algn"></td>
                            <td class="right_algn"></td>
                        </tr>

                        <tr>
                            <td>Net Pay in Words</td>
                            <td class="right_algn">:</td>
                            <td colspan="5" class="left_algn"><?php echo getIndianCurrency($pay_list->net_amount);?></td>
                            
                        </tr>

                    </table>
                    
                </div>

            </div>

            <div  class="bottom">
                
                <!-- <p style="display: inline;">Authorised Sign</p>

                <p style="display: inline; margin-left: 56%;">Employee Sign</p>
 -->
            </div>
        </div>

        <div style="text-align: center;">

            <button class="btn btn-info" type="button" onclick="printDiv();">Print</button>

        </div>
        
    </div>

</div>