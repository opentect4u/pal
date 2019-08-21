    <div class="row page-titles">
        <div class="col-md-8 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Leaves</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Reject Approve Leaves</li>
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

                    <h4 class="m-b-0 text-white">Reject Approved Leave Applications</h4>
                    
                </div>

                <div class="card-body">

                    <form class="form-horizontal" 
                        id="form"
                        method="post" 
                        action="<?php echo site_url('leave/reject');?>"
                    >
                    
                        <div class="form-body">
                            
                            <div class="row">
                                        
                                <div class="col-md-6">
                            
                                    <div class="form-group">
                            
                                        <label class="control-label">From Month</label>
                            
                                        <select class="form-control" name="month" id="month" required>
                            
                                            <option value="">Select Month</option>
                            
                                            <?php foreach($month_list as $m_list) {?>
                            
                                                <option value="<?php echo $m_list->id ?>" ><?php echo $m_list->month_name; ?></option>
                            
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

    <script>
   
        $(document).ready(function() {

            $('.alert').hide();

            <?php if($this->session->flashdata('msg')['message']){ ?>

                $('.alert').html('<?php echo $this->session->flashdata('msg')['message']; ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

            <?php } ?>

            });
        
    </script>