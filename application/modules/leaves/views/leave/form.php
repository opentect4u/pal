    <div class="row page-titles">

        <div class="col-md-6 col-8 align-self-center">

            <h3 class="text-themecolor m-b-0 m-t-0">Leaves</h3>

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="javascript:void(0)">Leave</a></li>

                <li class="breadcrumb-item active">Form</li>

            </ol>

        </div>

        <div class="col-md-6 col-12 align-self-center">
            <div class="alert alert-danger"></div>
        </div>

    </div>

<?php

if(!$leave_dtls){

    echo "No Data Found";

}

else{

?>


    <!-- JS // For selecting date range Start-->

    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

    <!-- For date Range End-->

    <div class="row">

        <div class="col-lg-12">

            <div class="card card-outline-info">

                <div class="card-header">

                    <h4 class="m-b-0 text-white">Leave Form</h4>
                    
                </div>

                <div class="card-body">

                    <form class="form-horizontal" 
                        id="form"
                        method="post" 
                        action="<?php echo site_url('leave/'.$url.'');?>"
                    >

                        <div class="form-body">

                            <h3 class="box-title">Type & Period</h3>
                            
                            <hr class="m-t-0 m-b-40">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label class="control-label">Type</label>

                                        <select class="form-control" 
                                                id="leave_type"
                                                name="leave_type"
                                                required
                                                
                                            >

                                            <option value="">Select</option>

                                            <option value="M" <?php echo ($leave_dtls->leave_type == 'M')? 'selected':''; ?>>SL</option>

                                            <?php 

                                                if($this->session->userdata('loggedin')->emp_catg != 'P'){

                                            ?>
                                                    <option value="E" <?php echo ($leave_dtls->leave_type == 'E')? 'selected':''; ?>>EL</option>
                                            
                                            <?php
                                            
                                                }

                                            ?>

                                            <option value="C" <?php echo ($leave_dtls->leave_type == 'C')? 'selected':''; ?>>Comp Off</option>
                                            <option value="N" <?php echo ($leave_dtls->leave_type == 'N')? 'selected':''; ?>>National Holidays</option>

                                        </select>
                                        
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                        
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label class="control-label">From Date</label>
                                                <input type='date' class="form-control" id="from_date" name="from_date" value="<?php echo $leave_dtls->from_dt; ?>" />
                                            </div>
                                            <div class="col-md-6">
                                                <label class="control-label">To Date</label>
                                                <input type='date' class="form-control" id="to_date" name="to_date" value="<?php echo $leave_dtls->to_dt; ?>" />
                                            </div>
                                        </div>

                                        <!-- <div class="row">

                                            <div class="col-md-12">
                                                <label class="control-label">Date Range</label>
                                                
                                                <input type="text" class="form-control" name="datefilter" value="<?php //echo $leave_dtls->from_dt.'  '.$leave_dtls->to_dt; ?>" />
                                            </div>

                                        </div> -->

                                    </div>

                                </div>
                                
                            </div>  
                                
                            <h3 class="box-title">Info</h3>

                            <hr class="m-t-0 m-b-40">
                            
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label class="control-label">Reason</label>

                                        <select class="form-control" 
                                                id="reason"
                                                name="reason">

                                            <option value="Family and Medical Leave" <?php echo ($leave_dtls->reason == 'Family and Medical Leave')?'selected':''; ?> >Family and Medical Leave </option>

                                            <option value="Bereavement" <?php echo ($leave_dtls->reason == 'Bereavement')?'selected':''; ?>>Bereavement</option>

                                            <option value="Pregnancy" <?php echo ($leave_dtls->reason == 'Pregnancy')?'selected':''; ?>>Pregnancy</option>

                                            <option value="Public holidays" <?php echo ($leave_dtls->reason == 'Public holidays')?'selected':''; ?>>Public holidays</option>

                                            <option value="Maternity/Paternity" <?php echo ($leave_dtls->reason == 'Maternity/Paternity')?'selected':''; ?>>Maternity/Paternity</option>

                                            <option value="Personal leave" <?php echo ($leave_dtls->reason == 'Personal leave')?'selected':''; ?>>Personal leave</option>

                                            <option value="Adverse weather" <?php echo ($leave_dtls->reason == 'Adverse weather')?'selected':''; ?>>Adverse weather</option>

                                            <option value="Comp time to compensate for extra hours worked" <?php echo ($leave_dtls->reason == 'Comp time to compensate for extra hours worked')?'selected':''; ?>>Comp time to compensate for extra hours worked</option>

                                        </select>
                                        
                                    </div>

                                </div>

                            </div>    
                                
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label class="control-label">Remarks</label>

                                        <textarea class="form-control" name="remarks" required><?php echo $leave_dtls->remarks; ?></textarea>

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

                                            <button type="submit" id="submit" class="btn btn-success">Submit</button>

                                        </div>

                                    </div>

                                </div>

                                <div class="col-md-6"> </div>

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


<!-- JS for dateRange picker calender Start-->
<!-- <script type="text/javascript">

    $(function(){

        $('input[name="datefilter"]').daterangepicker({
            autoUpdateInput: false,
            locale: {
                cancelLabel: 'Clear'
            }
        });

        $('input[name="datefilter"]').on('apply.daterangepicker', function(ev, picker) {
            $(this).val(picker.startDate.format('YYYY-MM-DD') + '  ' + picker.endDate.format('YYYY-MM-DD'));
        });

        $('input[name="datefilter"]').on('cancel.daterangepicker', function(ev, picker) {
            $(this).val('');
        });

    });

    //var startDate =  picker.startDate.format('DD/MM/YYYY');
    //var endDate =  picker.endDate.format('DD/MM/YYYY');

    //console.log(startDate); 

</script> -->
<!-- JS for dateRange picker calender End-->


<script>

    var event = 0,
        elLimit=0.00,
        mlLimit= 0;

    $(document).ready(function(){
        
        var closingBalances = '';

        $('.alert').hide();
        
        $.get(
            
            '<?php echo site_url("leave/leaveBalance"); ?>'

        ).done(function(data){
            
            closingBalances = JSON.parse(data);

        });
         
        /*switch('<?php //echo $leave_dtls->leave_type ?>'){

            case 'E': 

                //datepicker(moment('<?php echo $leave_dtls->from_dt; ?>'), moment('<?php echo $leave_dtls->to_dt; ?>'), moment());
                $('#from_date').val('');
                $('#to_date').val('');

                break;

            case 'C':

                //datepicker(moment('<?php echo $leave_dtls->from_dt; ?>'), moment('<?php echo $leave_dtls->to_dt; ?>'), moment());    
                $('#from_date').val('');
                $('#to_date').val('');
            
                break;

            case 'N':

                //datepicker(moment('<?php echo $leave_dtls->from_dt; ?>'), moment('<?php echo $leave_dtls->to_dt; ?>'), moment());    
                $('#from_date').val('');
                $('#to_date').val('');
            
                break;    
        }*/

        // $('#leave_type').change( function() {

        //     switch ($(this).val()) {
               
        //         case 'E':

        //             var newDate     = new Date(),
        //                 startMonth  = newDate.getFullYear()+'-0'+ getParamVal(3)+'-01',
        //                 endMonth    = newDate.getFullYear()+'-'+ getParamVal(4)+'-31',
        //                 elCount     = fetch(startMonth, endMonth, 'countEl');
        //                 $('#from_date').attr('min', '<?php echo date('Y-m-d'); ?>');
        //                 $('#to_date').attr('min', '<?php echo date('Y-m-d'); ?>');
        //                 if(parseInt(elCount) >= parseInt(getParamVal(5))){

        //                     $('.alert').html('Sorry! You have exceeded your EL limit <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

        //                     $(this).val('');

        //                 }
        //                 else if(closingBalances.el_bal <= 0){
                            
        //                     $('.alert').html('Sorry! You don\'t have EL Balance <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

        //                     $(this).val('');

        //                 }
        //                 else{
                            
        //                     //datepicker(moment().add(parseInt(getParamVal(7)), 'day'), moment().add(parseInt(getParamVal(7)) + 1, 'day'), moment().add(1, 'day'));
        //                     $('#from_date').val('');
        //                     $('#to_date').val('');
        //                     $('.alert').hide();

        //                 }

        //             break;

        //         case 'M':
                    
        //             if(closingBalances.ml_bal <= 0){
                            
        //                 $('.alert').html('Sorry! You don\'t have SL Balance <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

        //                 $(this).val('');

        //             }
        //             // else if{

        //             //     $.get('<?php //echo site_url("leave/monthlyMlBalance") ?>';)
        //             //     .done(function(data){
        //             //         console.log(data);
        //             //     })

        //             // }
        //             else{

        //                 //datepicker(moment(), moment().add(2, 'day'), null);
        //                 $('#from_date').val('');
        //                 $('#to_date').val('');
        //                 $('.alert').hide();

        //             }
                    
        //             break;

        //         case 'C':
                    
        //             if(closingBalances.comp_off_bal <= 0){
                        
        //                 $('#from_date').attr('min', '<?php echo date('Y-m-d'); ?>');
        //                 $('#to_date').attr('min', '<?php echo date('Y-m-d'); ?>');
                        
        //                 $('.alert').html('Sorry! You don\'t have Compp Off balance <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

        //                 $(this).val('');

        //             }
        //             else{
                            
        //                 //datepicker(moment().add(parseInt(getParamVal(7)), 'day'), moment().add(parseInt(getParamVal(7)) + 2, 'day'), moment().add(1, 'day'));
        //                 $('#from_date').val('');
        //                 $('#to_date').val('');
        //                 $('.alert').hide();

        //             }
                    
        //             break;

        //         case 'N':
                    
        //             $('.alert').hide('');
                    
        //             //datepicker(moment(), moment(), moment());
        //             $('#from_date').val('');
        //             $('#to_date').val('');

        //             break;

        //     }        

        // });
        

        // Can't apply for past --
        $('#from_date').change(function(){

            var leaveType       =       $('#leave_type').val();
            var fromDt = $(this).val();
            var currentTime = new Date();
            var month = currentTime.getMonth() + 1;
            var day = currentTime.getDate();
            var year = currentTime.getFullYear();
            if(month < 10)
                month = '0'+month;
            if(day < 10)
                day = '0'+day;
        
            var today = year+'-'+month+'-'+day;
            
            if(leaveType != 'M')
            {
                if(today > fromDt)
                {
                    $('#from_date').css('border-color', 'red');
                    $('#to_date').css('border-color', 'red');
                    $('.alert').html('Sorry! Can not apply leave for past. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                    $('#submit').prop('disabled', true);
                    return false;
                }
                else
                {
                    $('.alert').html('Sorry! Can not apply leave for past. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').hide();
                    $('#submit').prop('disabled', false);
                    return true;
                }
            }

        })


        // For checking Whether the employee had taken more than 2 ML in a month or not / only 2 ML can be applied
        $('#to_date').change(function(){

            var leaveType       =       $('#leave_type').val();
            var fromDt          =       $('#from_date').val();
            var toDt            =       $('#to_date').val();
            var leaveRange      =       new ValidDates(fromDt, toDt).dateRange();
            //let overlappDt  = fetch(from_date, to_date, 'overlapp');
            //console.log(data);
            
            switch(leaveType)
            {
                case 'M':

                    $.get('<?php echo site_url("leave/monthlyMLbalance"); ?>',{fromDate: fromDt, leaveType : leaveType})
                    .done(function(data){
                        //console.log(JSON.parse(data));
                        let leaveTaken = parseFloat(JSON.parse(data).amount).toFixed(1);
                        //console.log(parseFloat(leaveTaken).toFixed(1));
                        if(JSON.parse(data).amount != null) // checking whether leaveTaken is null or not
                        {

                            let MlBalance = parseFloat(2 - parseFloat(leaveTaken));
                            console.log('MlBalance '+MlBalance);
                            if(parseFloat(leaveRange) <= parseFloat(MlBalance))
                            {
                                return true;
                            }
                            else
                            {
                                $('#from_date').css('border-color', 'red');
                                $('#to_date').css('border-color', 'red');
                                $('.alert').html('Sorry! You are crossing assigned monthly SL limit. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                                $('#submit').prop('disabled', true);
                                return false;
                            }
                        
                        }
                        else // if leaveTaken is null then leaveRange to be checked / is it crossing the limit "2" or not
                        {
                            if(parseFloat(leaveRange) <= 2)
                            {
                                return true;
                            }
                            else // if greater than "2" alert should be given
                            {
                                $('#from_date').css('border-color', 'red');
                                $('#to_date').css('border-color', 'red');
                                $('.alert').html('Sorry! You are crossing assigned monthly SL limit. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                                $('#submit').prop('disabled', true);
                                return false;
                            }
                        }

                    })

                    break;

                case 'E':

                    $.get('<?php echo site_url("leave/monthlyELbalance") ?>', {fromDate : fromDt, leaveType : leaveType})
                    .done(function(data){

                        //console.log(JSON.parse(data));
                        if(JSON.parse(data) != null)
                        {
                            var leaveBal = JSON.parse(data).el_bal;
                            
                            if(parseFloat(leaveBal) <= 18) // firstly checking the total EL balance / more than 18 or not
                            {
                                // getting total amount of EL taken in this month
                                $.get('<?php echo site_url("leave/monthlyMLbalance"); ?>',{fromDate: fromDt, leaveType : leaveType})
                                .done(function(data){

                                    let leaveTaken = JSON.parse(data).amount;
                                    let ElCheckVal = parseFloat(leaveTaken)+parseFloat(leaveRange);
                                    if(parseFloat(ElCheckVal) > 1.5) // checking monthly el balance / more than 1.5 or not 
                                    {
                                        $('#from_date').css('border-color', 'red');
                                        $('#to_date').css('border-color', 'red');
                                        $('.alert').html('Sorry! You are crossing assigned monthly EL limit. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                                        $('#submit').prop('disabled', true);
                                        console.log("leaveBal <= 18 // ElCheckVal > 1.5 ");
                                        
                                        return false;

                                    }
                                    else
                                    {
                                        $('#submit').prop('disabled', false);
                                        return true;
                                    }

                                })

                            }
                            else if(parseFloat(leaveBal) > 18) // For the case while total EL balance is more than 18 
                            {

                                var applyMonth = fromDt.split('-');
                                //console.log(applyMonth[1]);
                                if(applyMonth[1] == 1) // Checking Whether application month is january or not 
                                {
                                    if(parseFloat(leaveRange) >= parseFloat(leaveBal)) // Though it's january employee can't apply for more than total el_bal
                                    {
                                        $('#from_date').css('border-color', 'red');
                                        $('#to_date').css('border-color', 'red');
                                        $('.alert').html('Sorry! You are crossing assigned total EL limit. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                                        $('#submit').prop('disabled', true);
                                        console.log("leaveBal > 18 // month = 1");
                                        
                                        return false;

                                    }
                                    else
                                    {
                                        $('#submit').prop('disabled', false);
                                        return true;
                                    }
                                }
                                else // If the application month isn't january then it'll be treated as the scenario like "leaveBal<18"
                                {
                                    // getting total amount of EL taken in this month
                                    $.get('<?php echo site_url("leave/monthlyMLbalance"); ?>',{fromDate: fromDt, leaveType : leaveType})
                                    .done(function(data){

                                        let leaveTaken = JSON.parse(data).amount;
                                        let ElCheckVal = parseFloat(leaveTaken)+parseFloat(leaveRange);
                                        if(parseFloat(ElCheckVal) > 1.5) // checking monthly el amount / 1.5 or not 
                                        {
                                            $('#from_date').css('border-color', 'red');
                                            $('#to_date').css('border-color', 'red');
                                            $('.alert').html('Sorry! You are crossing assigned monthly EL limit. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                                            $('#submit').prop('disabled', true);
                                            console.log("month != 1 // ElCheckVal > 1.5 ");
                                            
                                            return false;

                                        }
                                        else
                                        {
                                            $('#submit').prop('disabled', false);
                                            return true;
                                        }

                                    })

                                }
                                
                            }

                        }
                        else
                        {
                            if(parseFloat(leaveRange) <= 1.5)
                            {
                                return true;
                            }
                            else
                            {
                                $('#from_date').css('border-color', 'red');
                                $('#to_date').css('border-color', 'red');
                                $('.alert').html('Sorry! You are crossing assigned monthly EL limit. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                                $('#submit').prop('disabled', true);
                                //console.log("No leaveTaken / range is crossing '1.5' limit");
                                
                                return false;
                            }
                            
                        }

                    })

                    break;

                //case ''

            }


            // Checking whather previously any leave applied in this date range or not -- 
            $.get('<?php echo site_url("leave/check_leave_appliedDt"); ?>',{fromDt: fromDt, toDt : toDt})
            .done(function(data){

                var overlapDtNo = JSON.parse(data).num_rows;
                if(overlapDtNo > 0)
                {
                    $('#from_date').css('border-color', 'red');
                    $('#to_date').css('border-color', 'red');
                    $('.alert').html('Sorry! You had applied leave previously for this date range. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                    $('#submit').prop('disabled', true);
                    return false;
                }
                else
                {
                    $('.alert').html('Sorry! You had applied leave previously for this date range. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').hide();
                    $('#submit').prop('disabled', false);
                    return true;
                }

            })


            // For checking -- "quaterly 2 SL can be taken max"
            if(leaveType == 'M')
            {

                $.get('<?php echo site_url("leave/check_quaterly_slTaken"); ?>',{fromDt: fromDt, toDt : toDt})
                .done(function(data){

                    var tot_sl = JSON.parse(data).tot_sl;
                    //console.log(tot_sl);
                    if(parseFloat(tot_sl+leaveRange) > 2)
                    {
                        $('#leave_type').css('border-color', 'red');
                        $('.alert').html('Sorry! You are crossing quaterly SL limit. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                        $('#submit').prop('disabled', true);
                        return false;
                    }   
                    else
                    {
                        $('.alert').html('Sorry! You are crossing quaterly SL limit. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').hide();
                        $('#submit').prop('disabled', false);
                        return true;
                    }

                })

            }


            // Except SL other leave can't be applied for previous day --
            var currentTime = new Date();
            var month = currentTime.getMonth() + 1;
            var day = currentTime.getDate();
            var year = currentTime.getFullYear();
            if(month < 10)
                month = '0'+month;
            if(day < 10)
                day = '0'+day;
        
            var today = year+'-'+month+'-'+day;
            
            if(leaveType != 'M')
            {
                if(today > fromDt)
                {
                    $('#from_date').css('border-color', 'red');
                    $('#to_date').css('border-color', 'red');
                    $('.alert').html('Sorry! Can not apply leave for past. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                    $('#submit').prop('disabled', true);
                    return false;
                }
                else
                {
                    $('.alert').html('Sorry! Can not apply leave for past. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').hide();
                    $('#submit').prop('disabled', false);
                    return true;
                }
            }

        })


        

        $('input[type=date]').change(function(){

        //     // let str         = $('.buttonClass').val().replace(/ /g, '').split('-');
        //     let from_date   = $('#from_date').val();
        //     let to_date     = $('#to_date').val();
        //     let overlappDt  = fetch(from_date, to_date, 'overlapp');
        //     let data        = new ValidDates(from_date, to_date);
            
        //     switch ($('#leave_type').val()) {
               
        //        case 'M':
                    
        //             if(overlappDt != 1){
                       
        //                //datepicker(moment(new Date(overlappDt)).add(1, 'day'), moment(new Date(overlappDt)).add(3, 'day'), moment().add(parseInt(getParamVal(7)), 'day'));
        //                $('#from_date').val('');
        //                $('#to_date').val('');
                       
        //                event = 4;

        //                break;

        //             }
        //             else if(closingBalances.ml_bal < data.dateRange()){
                        
        //                 event = 5;
                        
        //                 break;
        //             }
        //             else if(mlLimit  = fetch(from_date, to_date, 'mlLimit')){
                        
        //                 if(data.dateRange() > mlLimit){
        //                     event = 7;
        //                     break;
        //                 }
        //                 else{
                        
        //                     event = 0;
                        
        //                 }
                        
        //             }
        //             else{
                        
        //                 event = 0;

        //             }
                
        //             break;

        //        case 'E':
                
        //            elLimit  = fetch(from_date, to_date, 'elLimit');
                   
        //            if(overlappDt != 1){
                       
        //                 //datepicker(moment(new Date(overlappDt)).add(1, 'day'), moment(new Date(overlappDt)).add(3, 'day'), moment().add(parseInt(getParamVal(7)), 'day'));
        //                 $('#from_date').val('');
        //                 $('#to_date').val('');
                        
        //                 event = 4;

        //                 break;

        //            }
        //            else if(closingBalances.el_bal < data.dateRange()){
                   
        //                 //datepicker(moment().add(parseInt(getParamVal(7)), 'day'), moment().add(parseInt(getParamVal(7)) + parseInt(closingBalances.el_bal) - 1, 'day'), moment().add(parseInt(getParamVal(7)), 'day'));
        //                 $('#from_date').val('');
        //                 $('#to_date').val('');
                    
        //                 event = 5;

        //                 break;
        //            }
        //            else if((closingBalances.el_bal <= 18) && (data.dateRange() > (parseFloat(elLimit).toFixed(1) * 1.5))){
                        
        //                 $('#submit').attr('type', 'button');
        //                 event = 6;
                        
        //                 break;
        //            }
        //            else{

        //                event = 0;
        //                $('#submit').attr('type', 'submit');
        //                break;

        //            }
                   
        //        case 'C':

        //             if(overlappDt != 1){
                            
        //                 //datepicker(moment(new Date(overlappDt)).add(1, 'day'), moment(new Date(overlappDt)).add(3, 'day'), moment().add(parseInt(getParamVal(7)), 'day'));
        //                 $('#from_date').val('');
        //                 $('#to_date').val('');
                        
        //                 event = 4;

        //                 break;

        //             }
        //             else if(closingBalances.comp_off_bal < data.dateRange()){

        //                 //datepicker(moment().add(parseInt(getParamVal(7)), 'day'), moment().add(parseInt(getParamVal(7)) + parseInt(closingBalances.el_bal) - 1, 'day'), moment().add(parseInt(getParamVal(7)), 'day'));
        //                 $('#from_date').val('');
        //                 $('#to_date').val('');
                        
        //                 event = 5;

        //                 break;

        //             }
        //             else{

        //                event = 0;
                        
        //                break;

        //            }
                    

        //         case 'N':

        //             event = 0;

        //             break; 

        //         default:
                    
        //             $('#submit').attr('type', 'submit');
                        

        //     }

            
        //     switch (event) {

        //         case 0:

        //             $('.alert').hide();
        //             $('#submit').attr('type', 'submit');
        //             break;

        //         case 3:

        //             $('.alert').html('Sorry! Select minimum two day <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                    
        //             $('#submit').attr('type', 'button');

        //             break;

        //         case 4:

        //             $('.alert').html('Sorry! Dates are overlapping with previous dates <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

        //             $('#submit').attr('type', 'button');

        //             break;

        //         case 5:
                
        //             $('.alert').html('Sorry! Choose a shorter period <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                    
        //             break;

        //         case 6:
                    
        //             $('.alert').html('Sorry! Maximum '+ parseFloat(elLimit * 1.5).toFixed(1) +' EL for this month <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

        //             break;

        //         case 7:
                    
        //             $('.alert').html('Please use '+ mlLimit +' SL for this quarter <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

        //             break; 
                        

        //     }

        });


        



    });

</script>

    