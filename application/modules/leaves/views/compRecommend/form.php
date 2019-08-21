<div class="card-body">

<?php

if(!$leave_dtls){

    echo "No Data Found";

}
else{

?>
    <form class="form-horizontal"
          method="post"
          action="<?php echo site_url('leave/comprecommend/form'); ?>"
          role="form" > 

        <div class="form-body">

            <h3 class="box-title">Comp Off Info</h3>

            <hr class="m-t-0 m-b-40">

            <div class="row">

                <div class="col-md-6">

                    <div class="form-group row">

                        <label class="control-label text-left col-md-4">Name:</label>

                        <div class="col-md-8">

                            <p class="form-control-static"><?php echo $leave_dtls->emp_name;?></p>

                        </div>

                    </div>

                </div>
                
                <div class="col-md-6">

                    <div class="form-group row">

                        <label class="control-label text-left col-md-4">Leave Period:</label>

                        <div class="col-md-8">

                            <p class="form-control-static"><?php echo date('d-m-Y', strtotime($leave_dtls->from_dt)).' to '.date('d-m-Y', strtotime($leave_dtls->to_dt)); ?></p>

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group row">

                        <label class="control-label text-left col-md-4">Leave Reason:</label>

                        <div class="col-md-8">

                            <p class="form-control-static"><?php echo $leave_dtls->reason;?></p>

                        </div>

                    </div>

                </div>

                <div class="col-md-6">

                    <div class="form-group row">

                        <label class="control-label text-left col-md-4">Remarks:</label>

                        <div class="col-md-8">

                            <p class="form-control-static"><?php echo $leave_dtls->remarks;?></p>

                        </div>

                    </div>

                </div>
                
            </div>
            
        </div>
        
        <div class="form-actions">

            <div id="remarksDiv">

                <div class="form-row">

                    <div class="form-group col-md-12">

                        <strong>Your Remarks:</strong>

                        <textarea class="form-control" name="remarks" id="remarks" rows="2" cols="50" required></textarea>

                    </div>

                </div>

            </div>

            <div class="form-group">

                <button class="btn btn-success waves-effect waves-dark submittable" 
                        id="approve"
                        name="approve_status"
                        style="width: 100%;"
                        type="button"
                        value="1">Recommend
                </button>

            </div>

            <div class="form-group">

                <button class="btn btn-danger waves-effect waves-dark submittable"
                        id="reject" 
                        name="reject_status"
                        style="width: 100%;"
                        type="button"
                        value="1">Reject
                </button>

            </div>

            <div class="form-group">

                <button class="btn btn-inverse waves-effect waves-light" 
                    type="button" 
                    style="width: 100%;"
                    data-dismiss="modal">Cancel
                </button>

            </div>

        </div>

    </form>

</div>

<?php

}

?>

<script type="text/javascript">$(document).ready(function(){$('#remarksDiv').hide();$('#approve').click(function(){$('#remarksDiv').show();$('#reject').remove();});$('#reject').click(function(){$('#remarksDiv').show();$('#approve').remove();});$("textarea").change(function(){$('.submittable').attr('type', 'submit');});});</script>
