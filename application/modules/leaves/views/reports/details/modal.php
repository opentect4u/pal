<div class="card-body">

    <h3 class="box-title">Leave Info of : <?php echo $leave_dtls->dept_name; ?></h3>

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

                <label class="control-label text-left col-md-4">Leave Type:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php switch ($leave_dtls->leave_type) {
                                        
                                                            case "E": 
                                                                echo "EL";
                                                                break;
                                                            
                                                            case "M": 
                                                                echo "SL";
                                                                break;
                                                                
                                                            case "C": 
                                                                echo "Comp Off";
                                                                break;
                                                            case "N": 
                                                                echo "National Holiday";
                                                                break;

                                                            case "HE": 
                                                                echo "Half EL";
                                                                break;
                                                            
                                                            case "HM": 
                                                                echo "Half SL";
                                                                break;
                                                                
                                                            case "HC": 
                                                                echo "Half Comp Off";
                                                                break;
                                                            case "HN": 
                                                                echo "Half National Holiday";
                                                                break;
                                                        }
                                                    ?>
                                                    
                    </p>

                </div>

            </div>

        </div>

        <div class="col-md-6">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">Applier's Remarks:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo $leave_dtls->remarks;?></p>

                </div>

            </div>

        </div>

    </div>

    <div class="row">
        
        <div class="col-md-4">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">HOD's Remarks:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo $leave_dtls->recommend_remarks;?></p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">Status:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo ($leave_dtls->recommendation_status == 0)? '<span class="label label-danger">Unaprove</span>':'<span class="label label-success">Recommended</span>';?></p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">Date:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo $leave_dtls->recommend_dt;?></p>

                </div>

            </div>

        </div>

        <div class="col-md-12">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">Recommended By:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo $leave_dtls->recommend_by;?></p>

                </div>

            </div>

        </div>
        
    </div>

    <div class="row">
        
        <div class="col-md-4">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">HR's Remarks:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo $leave_dtls->approve_remarks;?></p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">Status:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo ($leave_dtls->approval_status == 0)? '<span class="label label-danger">Unaprove</span>':'<span class="label label-success">Approved</span>';?></p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">Date:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo $leave_dtls->approval_dt;?></p>

                </div>

            </div>

        </div>

        <div class="col-md-12">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">Approved By:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo $leave_dtls->approved_by;?></p>

                </div>

            </div>

        </div>
        
    </div>

    <div class="row">
        
        <div class="col-md-4">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">Remarks:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo $leave_dtls->rejection_remarks;?></p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">Status:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo ($leave_dtls->rejection_status == 1)? '<span class="label label-danger">Rejected</span>':'';?></p>

                </div>

            </div>

        </div>

        <div class="col-md-4">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">Date:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo $leave_dtls->rejected_dt;?></p>

                </div>

            </div>

        </div>

        <div class="col-md-12">

            <div class="form-group row">

                <label class="control-label text-left col-md-4">Rejected By:</label>

                <div class="col-md-8">

                    <p class="form-control-static"><?php echo $leave_dtls->rejected_by;?></p>

                </div>

            </div>

        </div>
        
    </div>
    
</div>
