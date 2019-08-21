<div class="row page-titles">

    <div class="col-md-6 col-8 align-self-center">

        <h3 class="text-themecolor m-b-0 m-t-0">Payroll</h3>

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="javascript:void(0)">Payroll</a></li>

            <li class="breadcrumb-item active">Salary Statement</li>

        </ol>

    </div>

    <div class="col-md-6 col-12 align-self-center">
        <div class="alert alert-danger"></div>
    </div>

</div>

<?php

if(!$employee_dtls){

    echo "No Data Found";

}

else{

?>

    <div class="row">

        <div class="col-lg-12">

            <div class="card card-outline-info">

                <div class="card-header">

                    <h4 class="m-b-0 text-white">Salary Statement</h4>
                    
                </div>

                <div class="card-body">

                    <form class="form-horizontal" 
                        id="form"
                        method="post" 
                        action="<?php echo site_url('payroll/statements/'.$url.'');?>"
                    >

                        <div class="form-body">
                            
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label for="emp_code" class="control-label">Employee</label>

                                        <select class="form-control" 
                                                id="emp_code"
                                                name="emp_code"
                                                required
                                                >

                                            <option value="">Select</option>

                                        <?php 

                                            if($employee_dtls) {

                                                foreach($employee_dtls as $e_dtls) {

                                        ?>
                                            <option value="<?php echo $e_dtls->emp_code; ?>" 
                                            <?php echo ($statemets->emp_code == $e_dtls->emp_code)? 'selected':''; ?>
                                            ><?php echo $e_dtls->emp_name.' ('.$e_dtls->department.')'; ?> 
                                            
                                            </option>
                                        
                                        <?php
                                                }
                                            }

                                        ?>

                                        </select>
                                        
                                    </div>

                                </div>

                            </div>

                            <div class="row">
                            
                                <div class="col-md-6">

                                    <h3 class="box-title">Earnings</h3>
                                    
                                </div>

                                <div class="col-md-6">
                                
                                    <h3 class="box-title">Deductions</h3>

                                </div>

                            </div>        

                            <hr class="m-t-0 m-b-40">                                

                            <div class="row">

                                <div class="col-md-6">
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="basic" class="control-label">Basic</label>

                                                <input type="text" 
                                                    class="form-control earnings"
                                                    name="basic"
                                                    id="basic"
                                                    value="<?php echo $statemets->basic ;?>"
                                                    required  
                                                    >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="da" class="control-label">DA</label>

                                                <input type="text" 
                                                    class="form-control earnings"
                                                    name="da"
                                                    id="da"
                                                    value="<?php echo $statemets->da ;?>"

                                                    >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="hra" class="control-label">HRA</label>

                                                <input type="text" 
                                                    class="form-control earnings"
                                                    name="hra"
                                                    id="hra"  
                                                    value="<?php echo $statemets->hra ;?>"

                                                    >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="conveyance" class="control-label">Conveyance</label>

                                                <input type="text" 
                                                    class="form-control earnings"
                                                    name="conveyance"
                                                    id="conveyance" 
                                                    value="<?php echo $statemets->conveyance ;?>"

                                                    >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="incentives" class="control-label">Incentives</label>

                                                <input type="text" 
                                                    class="form-control earnings"
                                                    name="incentives"
                                                    id="incentives" 
                                                    value="<?php echo $statemets->incentives ;?>"

                                                    >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="misc_ear" class="control-label">Misc. Earning</label>

                                                <input type="text" 
                                                    class="form-control earnings"
                                                    name="misc_ear"
                                                    id="misc_ear" 
                                                    value="<?php echo $statemets->misc_ear ;?>"

                                                    >
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="others" class="control-label">Others</label>

                                                <input type="text" 
                                                    class="form-control earnings"
                                                    name="others"
                                                    id="others"   
                                                    value="<?php echo $statemets->others ;?>"

                                                    >
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="pf" class="control-label">EPF</label>

                                                <input type="text" 
                                                    class="form-control deductions"
                                                    name="pf"
                                                    id="pf"  
                                                    value="<?php echo $statemets->pf ;?>"

                                                    >
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="esi" class="control-label">ESI</label>

                                                <input type="text" 
                                                    class="form-control deductions"
                                                    name="esi"
                                                    id="esi" 
                                                    value="<?php echo $statemets->esi ;?>"

                                                    >
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                        
                                            <div class="form-group">

                                                <label for="ptax" class="control-label">PTAX</label>

                                                <input type="text" 
                                                    class="form-control deductions"
                                                    name="ptax"
                                                    id="ptax" 
                                                    value="<?php echo $statemets->p_tax ;?>"

                                                    >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="tds" class="control-label">TDS</label>

                                                <input type="text" 
                                                    class="form-control deductions"
                                                    name="tds"
                                                    id="tds" 
                                                    value="<?php echo $statemets->tds ;?>"

                                                >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="lwf" class="control-label">LWF</label>

                                                <input type="text" 
                                                    class="form-control deductions"
                                                    name="lwf"
                                                    id="lwf" 
                                                    value="<?php echo $statemets->lwf ;?>"

                                                    >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="accommodation" class="control-label">Food/Accommodation</label>

                                                <input type="text" 
                                                    class="form-control deductions"
                                                    name="accommodation"
                                                    id="accommodation" 
                                                    value="<?php echo $statemets->accommodation ;?>"

                                                    >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="advance" class="control-label">Loans & Advance</label>

                                                <input type="text" 
                                                    class="form-control deductions"
                                                    name="advance"
                                                    id="advance" 
                                                    value="<?php echo $statemets->advance ;?>"

                                                    >
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="laundry" class="control-label">Laundry</label>

                                                <input type="text" 
                                                    class="form-control deductions"
                                                    name="laundry"
                                                    id="laundry" 
                                                    value="<?php echo $statemets->laundry ;?>"

                                                    >
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">

                                                <label for="misc" class="control-label">Misc. Deductions</label>

                                                <input type="text" 
                                                    class="form-control deductions"
                                                    name="misc"
                                                    id="misc"  
                                                    value="<?php echo $statemets->misc ;?>"

                                                    >
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="tot_earnings" class="control-label">Gross Salary</label>

                                        <input type="text" 
                                            class="form-control"
                                            name="tot_earnings"
                                            id="tot_earnings"
                                            value="<?php echo $statemets->tot_earnings ;?>"
                                            readonly   
                                            >
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">

                                        <label for="tot_deductions" class="control-label">Total Deduction</label>

                                        <input type="text" 
                                            class="form-control"
                                            name="tot_deductions"
                                            id="tot_deductions"
                                            value="<?php echo $statemets->tot_deduction ;?>"
                                            readonly   
                                            >
                                    </div>
                                </div>
                            </div>

                            <h3 class="box-title">Summary</h3>
                            
                            <hr> 

                            <div class="row">
                                
                                <div class="col-md-6">
                                    
                                    <div class="form-group">

                                        <label for="net_sal" class="control-label">Net Salary</label>

                                        <input type="text" 
                                            class="form-control"
                                            name="net_sal"
                                            id="net_sal"
                                            value="<?php echo $statemets->net_amount ;?>"
                                            readonly
                                            >
                                    </div>
                                    
                                </div>

                            </div>
                            
                            <h3 class="box-title">Bank Details</h3>        

                            <hr class="m-t-0 m-b-40">

                            <div class="row">
                                
                                <div class="col-md-6">
                                    
                                    <div class="form-group">

                                        <label for="bank_name" class="control-label">Bank Name</label>

                                        <input type="text" 
                                               class="form-control"
                                               name="bank_name"
                                               id="bank_name"
                                               value="<?php echo $statemets->bank_name ;?>"

                                            >
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    
                                    <div class="form-group">

                                        <label for="bank_acc_no" class="control-label">Bank A/C No.</label>

                                        <input type="text" 
                                               class="form-control"
                                               name="bank_acc_no"
                                               id="bank_acc_no"
                                               value="<?php echo $statemets->bank_ac_no ;?>"

                                            >
                                    </div>
                                    
                                </div>

                            </div>

                            <div class="row">
                                
                                <div class="col-md-6">
                                    
                                    <div class="form-group">

                                        <label for="location" class="control-label">Location</label>

                                        <input type="text" 
                                               class="form-control"
                                               name="location"
                                               id="location"
                                               value="<?php echo $statemets->location ;?>"

                                            >
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    
                                    <div class="form-group">

                                        <label for="pf_acc_no" class="control-label">PF Acc No.</label>

                                        <input type="text" 
                                               class="form-control"
                                               name="pf_acc_no"
                                               id="pf_acc_no"
                                               value="<?php echo $statemets->pf_ac_no ;?>"

                                            >
                                    </div>
                                    
                                </div>

                            </div>

                            <div class="row">
                                
                                <div class="col-md-6">
                                    
                                    <div class="form-group">

                                        <label for="esi_no" class="control-label">ESI</label>

                                        <input type="text" 
                                               class="form-control"
                                               name="esi_no"
                                               id="esi_no"
                                               value="<?php echo $statemets->esi_no ;?>"

                                            >
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    
                                    <div class="form-group">

                                        <label for="pan_no" class="control-label">PAN No.</label>

                                        <input type="text" 
                                               class="form-control"
                                               name="pan_no"
                                               id="pan_no"
                                               value="<?php echo $statemets->pan_no ;?>"

                                            >
                                    </div>
                                    
                                </div>

                            </div>

                            <div class="row">
                                
                                <div class="col-md-6">
                                    
                                    <div class="form-group">

                                        <label for="base_or_eligibitity" class="control-label">Attendance: Base, Eligibility</label>

                                        <input type="text" 
                                               class="form-control"
                                               name="base_or_eligibitity"
                                               id="base_or_eligibitity"
                                               value="<?php echo $statemets->base_or_eligibitity ;?>"

                                            >
                                    </div>
                                    
                                </div>

                                <div class="col-md-6">
                                    
                                    <div class="form-group">

                                        <label for="ifsc" class="control-label">IFSC Code</label>

                                        <input type="text" 
                                               class="form-control"
                                               name="ifsc"
                                               id="ifsc"
                                               value="<?php echo $statemets->ifsc ;?>"

                                            >
                                    </div>
                                    
                                </div>

                            </div>
                            
                        </div>
                        
                        <hr>
                        
                        <div class="form-actions">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="row">

                                        <div class="col-md-offset-3 col-md-9">

                                            <button type="submit" class="btn btn-success">Submit</button>

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

?>


<script>
    $(document).ready(function(){
        
        $('.alert').hide();

        $('.earnings').change(function(){

            let tot_earnings = 0,
                basic = $(this).val(),  
                pf_parcentage = getParamVal(15);

            $('.earnings').each(function(){

                tot_earnings += +$(this).val();

            });

            $('#pf').val(  ((((parseInt(tot_earnings) - parseInt($('#hra').val())) * pf_parcentage) / 100) > 1800)? 1800 : (((parseInt(tot_earnings) - parseInt($('#hra').val())) * pf_parcentage) / 100).toFixed(0) );

            if(parseInt(tot_earnings) > 21000){
                $('#esi').val(0);
            }
            else{
                $('#esi').val(((tot_earnings * 1.75) / 100).toFixed(0));
            }

            $('#tot_earnings').val(tot_earnings);

            $('#net_sal').val($('#tot_earnings').val() - $('#tot_deductions').val());

            $('#tot_earnings').change();

        });

        $('.deductions').change(function(){

            let tot_deductions = 0;

            $('.deductions').each(function(){

                tot_deductions += +$(this).val();

            });

            $('#tot_deductions').val(tot_deductions);

            $('#net_sal').val($('#tot_earnings').val() - $('#tot_deductions').val());

        });

        $('#tot_earnings').change(function(){

            $.get(
                '<?php echo site_url("payroll/statements/ptax"); ?>',
                {
                    amount: $(this).val()
                }
            ).done(function(data){
                
                $('#ptax').val(data);

                $('.deductions').change();

            });

        });

    });
</script>