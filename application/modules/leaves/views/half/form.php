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

if(!$half_dtls){

    echo "No Data Found";

}

else{

?>

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
                        action="<?php echo site_url('leave/half/'.$url.'');?>"
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

                                            <option value="HM" <?php echo ($half_dtls->leave_type == 'HM')? 'selected':''; ?>>SL</option>

                                            <?php 

                                                if($this->session->userdata('loggedin')->emp_catg != 'P'){

                                            ?>
                                                    <option value="HE" <?php echo ($half_dtls->leave_type == 'HE')? 'selected':''; ?>>EL</option>
                                            
                                            <?php
                                            
                                                }

                                            ?>

                                            <option value="HC" <?php echo ($half_dtls->leave_type == 'HC')? 'selected':''; ?>>Comp Off</option>
                                            <option value="HN" <?php echo ($half_dtls->leave_type == 'HN')? 'selected':''; ?>>National Holidays</option>

                                        </select>
                                        
                                    </div>

                                </div>

                                <div class="col-md-6">

                                    <div class="form-group">
                                    
                                        <label class="control-label">Date</label>
                                        
                                        <input type='date' class="form-control halfdate" id= "from_dt" name="from_dt" value="<?php echo $half_dtls->from_dt; ?>" />

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

                                            <option value="Family and Medical Leave" <?php echo ($half_dtls->reason == 'Family and Medical Leave')?'selected':''; ?> >Family and Medical Leave </option>

                                            <option value="Bereavement" <?php echo ($half_dtls->reason == 'Bereavement')?'selected':''; ?>>Bereavement</option>

                                            <option value="Pregnancy" <?php echo ($half_dtls->reason == 'Pregnancy')?'selected':''; ?>>Pregnancy</option>

                                            <option value="Public holidays" <?php echo ($half_dtls->reason == 'Public holidays')?'selected':''; ?>>Public holidays</option>

                                            <option value="Maternity/Paternity" <?php echo ($half_dtls->reason == 'Maternity/Paternity')?'selected':''; ?>>Maternity/Paternity</option>

                                            <option value="Personal leave" <?php echo ($half_dtls->reason == 'Personal leave')?'selected':''; ?>>Personal leave</option>

                                            <option value="Adverse weather" <?php echo ($half_dtls->reason == 'Adverse weather')?'selected':''; ?>>Adverse weather</option>

                                            <option value="Comp time to compensate for extra hours worked" <?php echo ($half_dtls->reason == 'Comp time to compensate for extra hours worked')?'selected':''; ?>>Comp time to compensate for extra hours worked</option>

                                        </select>
                                        
                                    </div>

                                </div>

                            </div>    
                                
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label class="control-label">Remarks</label>

                                        <textarea class="form-control" name="remarks" required><?php echo $half_dtls->remarks; ?></textarea>

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


<!-- <script>

    var event = 0,
        elLimit=0.00,
        mlLimit= 0;

    $(document).ready(function(){
        
        var closingBalances = '';

        $('.alert').hide();
        
        $.get(
            
            '<?php echo site_url("leave/half/leaveBalance"); ?>'

        ).done(function(data){
            
            closingBalances = JSON.parse(data);

        });
         
        switch('<?php echo $half_dtls->leave_type ?>'){

            case 'HE': 

                datepicker(moment('<?php echo $half_dtls->from_dt; ?>'), moment('<?php echo $half_dtls->to_dt; ?>'), moment());

                break;

            case 'HC':

                datepicker(moment('<?php echo $half_dtls->from_dt; ?>'), moment('<?php echo $half_dtls->to_dt; ?>'), moment());    
            
                break;

            case 'HN':

                datepicker(moment('<?php echo $half_dtls->from_dt; ?>'), moment('<?php echo $half_dtls->to_dt; ?>'), moment());    
            
                break;    
        }

        $('#leave_type').change( function() {
            $('.alert').hide();
            switch ($(this).val()) {
               
                case 'HE':

                    var newDate     = new Date(),
                        startMonth  = newDate.getFullYear()+'-0'+ getParamVal(3)+'-01',
                        endMonth    = newDate.getFullYear()+'-'+ getParamVal(4)+'-31',
                        elCount     = fetch(startMonth, endMonth, 'countEl');
                        
                        if(parseInt(elCount) >= parseInt(getParamVal(5))){

                            $('.alert').html('Sorry! You have exceeded your EL limit <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

                            $(this).val('');

                        }
                        else if(closingBalances.el_bal <= 0){
                            
                            $('.alert').html('Sorry! You don\'t have EL Balance <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

                            $(this).val('');

                        }
                        else{
                            
                            datepicker(moment().add(parseInt(getParamVal(7)), 'day'), moment().add(parseInt(getParamVal(7)) + 1, 'day'), moment().add(1, 'day'));

                        }

                    break;

                case 'HM':
                    
                    if(closingBalances.ml_bal <= 0){
                            
                        $('.alert').html('Sorry! You don\'t have SL Balance <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

                        $(this).val('');

                    }
                    else{

                        datepicker(moment(), moment().add(2, 'day'), null);

                    }
                    
                    break;

                case 'HC':
                    
                    if(closingBalances.comp_off_bal <= 0){

                        $('.alert').html('Sorry! You don\'t have Compp Off balance <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

                        $(this).val('');

                    }
                    else{
                            
                        datepicker(moment().add(parseInt(getParamVal(7)), 'day'), moment().add(parseInt(getParamVal(7)) + 2, 'day'), moment().add(parseInt(getParamVal(7)), 'day'));

                    }
                    
                    break;

                case 'HN':
                    
                    $('.alert').html('');
                    
                    datepicker(moment(), moment(), moment());

                    break;

                default: 
                
                    event = 4;

                    break;
            }        

        });
        
        $('.halfdate').change(function(){
            
            let from_date   = $('.halfdate').val();
            let to_date     = $('.halfdate').val();
            let overlappDt  = fetch(from_date, to_date, 'overlapp');
            let data        = new ValidDates(from_date, to_date);
            
            switch ($('#leave_type').val()) {
               
               case 'HM':
                    
                    if(overlappDt != 1){
                       
                       datepicker(moment(new Date(overlappDt)).add(1, 'day'), moment(new Date(overlappDt)).add(3, 'day'), moment().add(parseInt(getParamVal(7)), 'day'));
                       
                       event = 4;

                       break;

                    }
                    else if(closingBalances.ml_bal < data.dateRange()){
                        
                        event = 5;
                        
                        break;
                    }
                    else if(mlLimit  = fetch(from_date, to_date, 'mlLimit')){

                        if(parseInt(mlLimit) >= 2){
                            event = 7;
                            break;
                        }
                        else{
                        
                            event = 0;
                        
                        }
                        
                    }
                    else{
                        
                        event = 0;

                    }
                
                    break;

               case 'HE':
                
                   elLimit  = fetch(from_date, to_date, 'elLimit');
                   
                   if(overlappDt != 1){
                       
                        datepicker(moment(new Date(overlappDt)).add(1, 'day'), moment(new Date(overlappDt)).add(3, 'day'), moment().add(parseInt(getParamVal(7)), 'day'));
                        
                        event = 4;

                        break;

                   }
                   else if(closingBalances.el_bal < data.dateRange()){
                   
                        datepicker(moment().add(parseInt(getParamVal(7)), 'day'), moment().add(parseInt(getParamVal(7)) + parseInt(closingBalances.el_bal) - 1, 'day'), moment().add(parseInt(getParamVal(7)), 'day'));
                    
                        event = 5;

                        break;
                   }
                   else if((closingBalances.el_bal <= 18) && (data.dateRange() > (parseFloat(elLimit).toFixed(1) * 1.5))){
                        
                        $('#submit').attr('type', 'button');
                        event = 6;
                        
                        break;
                   }
                   else{

                       event = 0;
                       $('#submit').attr('type', 'submit');
                       break;

                   }
                   
               case 'HC':

                    if(overlappDt != 1){
                            
                        datepicker(moment(new Date(overlappDt)).add(1, 'day'), moment(new Date(overlappDt)).add(3, 'day'), moment().add(parseInt(getParamVal(7)), 'day'));
                        
                        event = 4;

                        break;

                    }
                    else if(closingBalances.comp_off_bal < data.dateRange()){

                        datepicker(moment().add(parseInt(getParamVal(7)), 'day'), moment().add(parseInt(getParamVal(7)) + parseInt(closingBalances.el_bal) - 1, 'day'), moment().add(parseInt(getParamVal(7)), 'day'));
                        
                        event = 5;

                        break;

                    }
                    else{

                       event = 0;
                        
                       break;

                   }
                    

                case 'HN':

                    event = 0;

                    break; 

                default:
                    
                    $('#submit').attr('type', 'submit');
                        

            }

            
            switch (event) {

                case 0:

                    $('.alert').hide();
                    $('#submit').attr('type', 'submit');
                    break;

                case 3:

                    $('.alert').html('Sorry! Select minimum two day <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                    
                    $('#submit').attr('type', 'button');

                    break;

                case 4:

                    $('.alert').html('Sorry! Dates are overlapping with previous dates <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

                    $('#submit').attr('type', 'button');

                    break;

                case 5:
                
                    $('.alert').html('Sorry! Choose a shorter period <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                    
                    break;

                case 6:
                    
                    $('.alert').html('Sorry! Maximum '+ parseFloat(elLimit * 1.5).toFixed(1) +' EL for this month <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

                    break;

                case 7:
                    
                    $('.alert').html('You used '+ mlLimit +' SL for this quarter <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

                    break; 
                        

            }

        });

    });

</script> -->

    

<!-- Checking whather there is any leave apply for the same date -->
<script>

    $(document).ready(function(){

        $('.alert').hide();
        $('#from_dt').on('change', function(){

            var from_dt = $(this).val();
            var leaveType = $('#leave_type').val();

            $.get('<?php echo site_url("leave/half/check_halfLeave_appliedDt"); ?>',{from_dt: from_dt})
            .done(function(data){

                //console.log(JSON.parse(data));
                if(JSON.parse(data) == null)
                {
                    return true;
                }
                else
                {
                    var overlapDtNo = JSON.parse(data).num_rows;
                    if(overlapDtNo > 0)
                    {
                        $('#from_dt').css('border-color', 'red');
                        $('.alert').html('Sorry! You had applied leave previously for this date. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                        $('#submit').prop('disabled', true);
                        return false;
                    }
                    else
                    {
                        $('.alert').html('Sorry! You had applied leave previously for this date. <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').hide();
                        $('#submit').prop('disabled', false);
                        return true;
                    }
                }

            })


            // For checking -- "quaterly 2 SL can be taken max"
            if(leaveType == 'HM')
            {
                var leaveRange = 0.5;

                $.get('<?php echo site_url("leave/check_quaterly_slTaken"); ?>',{fromDt: from_dt, toDt : from_dt})
                .done(function(data){

                    var tot_sl = JSON.parse(data).tot_sl;
                    console.log(tot_sl);
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
            
            if(leaveType != 'HM')
            {
                if(today > from_dt)
                {
                    $('#from_dt').css('border-color', 'red');
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


        $('#leave_type').on('change', function(){

            var leaveType = $(this).val();
            var from_dt = $('#from_dt').val();

            // For checking -- "quaterly 2 SL can be taken max"
            if(leaveType == 'HM')
            {
                var leaveRange = 0.5;

                $.get('<?php echo site_url("leave/check_quaterly_slTaken"); ?>',{fromDt: from_dt, toDt : from_dt})
                .done(function(data){

                    var tot_sl = JSON.parse(data).tot_sl;
                    console.log(tot_sl);
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

        })

    })

</script>