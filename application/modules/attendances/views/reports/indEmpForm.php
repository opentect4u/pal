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

    <div class="row">

        <div class="col-lg-12">

            <div class="card card-outline-info">

                <div class="card-header">

                    <h4 class="m-b-0 text-white">Generate Payslips</h4>
                    
                </div>

                <div class="card-body">

                    <form class="form-horizontal" 
                        id="form"
                        method="get" 
                        action="<?php echo site_url('attendance/report/details-emp');?>"
                    >
                    
                        <div class="form-body">
                            
                            <div class="row">
                                        
                                <div class="col-md-6">
                            
                                    <div class="form-group">
                            
                                        <label class="control-label">From Date</label>
                            
                                        <input type="date" 
                                               class="form-control" 
                                               name="from_date"
                                               requied
                                            >
                            
                                    </div>
                            
                                </div>
                            
                            </div>

                            <div class="row">
                                        
                                <div class="col-md-6">
                            
                                    <div class="form-group">
                            
                                        <label class="control-label">To Date</label>
                            
                                        <input type="date" 
                                               class="form-control" 
                                               name="to_date"
                                               requied
                                            >
                            
                                    </div>
                            
                                </div>
                            
                            </div>  

                            <?php
                                if($this->session->userdata('loggedin')->emp_type == 'HR'){
                            ?>
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
                                            <option value="<?php echo $e_dtls->emp_code; ?>" 
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

                            <?php
                                }
                            ?>
                                
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
