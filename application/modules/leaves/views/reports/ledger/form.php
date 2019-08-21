    <div class="row page-titles">
        <div class="col-md-8 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Leaves</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Leave</a></li>
                <li class="breadcrumb-item active">Report</li>
            </ol>
        </div>
        <div class="col-md-4 col-12 align-self-center">
            <div class="alert alert-<?php echo $this->session->flashdata('msg')['status']; ?>"></div>
        </div>
    </div>
    
    <div class="row">

        <div class="col-lg-12">

            <div class="card card-outline-info">

                <div class="card-header">

                    <h4 class="m-b-0 text-white">Leave Ledger</h4>
                    
                </div>

                <div class="card-body">

                    <form class="form-horizontal" 
                        id="form"
                        method="post" 
                        action="<?php echo site_url('leave/ledger');?>"
                    >

                        <div class="form-body">

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label class="control-label">From Date</label>

                                        <input class="form-control" 
                                                type="date"
                                                name="from_date"
                                                required
                                                
                                            />
                                        
                                    </div>

                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label class="control-label">To Date</label>

                                        <input class="form-control" 
                                                type="date"
                                                name="to_date"
                                                required
                                                
                                            />
                                        
                                    </div>

                                </div>
                                
                            </div>

                        <?php
                            if($this->session->userdata('loggedin')->emp_type != 'E'){
                        ?>
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">

                                        <label class="control-label">Employee Name</label>

                                        <select class="form-control" name="emp_code" required>
                                        
                                            <option value="">Select</option>
                                            
                                            <?php foreach ($emp_dtls as $list):?>
                                            
                                                <option value="<?php echo $list->emp_code;?>">
                                                
                                                    <?php echo $list->emp_name;?>
                                                
                                                </option>
                                                
                                            <?php endforeach;?> 
                                            
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

    