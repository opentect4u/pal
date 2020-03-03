    <div class="row page-titles">

        <div class="col-md-6 col-8 align-self-center">

            <h3 class="text-themecolor m-b-0 m-t-0">Comp Off</h3>

            <ol class="breadcrumb">

                <li class="breadcrumb-item"><a href="javascript:void(0)">Comp Off</a></li>

                <li class="breadcrumb-item active">Form</li>

            </ol>

        </div>

        <div class="col-md-6 col-12 align-self-center">
            <div class="alert alert-danger"></div>
        </div>

    </div>

<?php

if(!$compOffHalf_dtls){

    echo "No Data Found";

}

else{

?>

    <div class="row">

        <div class="col-lg-12">

            <div class="card card-outline-info">

                <div class="card-header">

                    <h4 class="m-b-0 text-white">Comp Off Form</h4>
                    
                </div>

                <div class="card-body">

                    <form class="form-horizontal" 
                        id="form"
                        method="post" 
                        action="<?php echo site_url('leave/compoffhalf/'.$url.'');?>"
                    >
                    
                        <div class="form-body">

                            <h3 class="box-title">Period</h3>
                            
                            <hr class="m-t-0 m-b-40">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
                                        
                                        <h6 class="card-subtitle">Date</h6>
                                            
                                        <input type='date' class="form-control halfdate" id="from_dt" name="from_dt" value="<?php echo $compOffHalf_dtls->from_dt; ?>" />

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

                                            <option value="Week Off" <?php echo ($compOffHalf_dtls->reason == "Week Off")?'selected':''; ?> >Week Off</option>

                                            <option value="Govt. Holidays" <?php echo ($compOffHalf_dtls->reason == "Govt. Holidays")?'selected':''; ?>>Govt. Holidays</option>

                                            <option value="Other Holiday" <?php echo ($compOffHalf_dtls->reason == "Other Holiday")?'selected':''; ?>>Other Holiday</option>

                                        </select>
                                        
                                    </div>

                                </div>

                            </div>    
                                
                            <div class="row">

                                <div class="col-md-12">

                                    <div class="form-group">

                                        <label class="control-label">Remarks</label>

                                        <textarea class="form-control" name="remarks" required><?php echo $compOffHalf_dtls->remarks; ?></textarea>

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
<script>

    var event = 0;

    $(document).ready(function(){

        $('.alert').hide();
        
        datepicker(moment('<?php echo $compOffHalf_dtls->from_dt; ?>'), moment('<?php echo $compOffHalf_dtls->to_dt; ?>'), moment());
        
        $('.halfdate').change(function(){
            let from_date   = $('.halfdate').val();
            let to_date     = $('.halfdate').val();
            let overlappDt  = fetch('<?php echo $this->session->userdata('valid')['trans_cd']; ?>', from_date, to_date, 'overlapp');

            if(overlappDt){
                            
                datepicker(moment('<?php echo $compOffHalf_dtls->from_dt; ?>'), moment('<?php echo $compOffHalf_dtls->to_dt; ?>'), moment());
                
                $('.alert').html('Sorry! Dates are overlapping with previous dates <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                $('#submit').attr('type', 'button');
            }
            else{

                $('.alert').hide();
                $('#submit').attr('type', 'submit');
            }

        });

        $('#form').on('submit',function(){

        var frm_dt = $('#from_dt').val();

            if(frm_dt.length == 0){

                alert('Invalid Date');
                window.location.href = "<?php echo site_url('leave/compoffhalf'); ?>";
                return false;
            }
        });

    });

</script>

    