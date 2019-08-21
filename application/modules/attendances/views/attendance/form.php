<div class="row page-titles">

    <div class="col-md-6 col-8 align-self-center">

        <h3 class="text-themecolor m-b-0 m-t-0">Attendances</h3>

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="javascript:void(0)">Attendance</a></li>

            <li class="breadcrumb-item active">Form</li>

        </ol>

    </div>

    <div class="col-md-6 col-12 align-self-center">
    </div>

</div>

<div class="row">

    <div class="col-lg-12">

        <div class="card card-outline-info">

            <div class="card-header">

                <h4 class="m-b-0 text-white">Attendance Form</h4>
                
            </div>

            <div class="card-body">

                <form class="form-horizontal" 
                    id="form"
                    method="post" 
                    enctype="multipart/form-data"
                    action="<?php echo site_url('attendance/add');?>"
                    >

                    <div class="form-body">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">
                                    
                                    <label for="date" class="control-label">Attendance Date</label>

                                    <input type="date" 
                                           class="form-control" 
                                           name="date" 
                                           value="<?php echo date('Y-m-d'); ?>"
                                           required 
                                        />
                                    
                                </div>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">
                                    
                                    <label for="" class="control-label">Choose</label>

                                    <div class="demo-radio-button">
                                        
                                        <input name="group" class="type" id="radio_1" type="radio" checked />
                                        <label for="radio_1">For Bulk Upload</label>
                                        <input name="group" class="type" id="radio_2" type="radio" />
                                        <label for="radio_2">Single Employee</label>

                                    </div>
                                    
                                </div>

                            </div>

                        </div>

                    </div>

                    <div class="form-body fbody1">

                        <h3 class="box-title">Import Attendances In CSV</h3>

                        <hr class="m-t-0 m-b-40">
                        
                        <div class="row">

                            <div class="col-md-6">

                                <div class="form-group">

                                    <input type="file" name="attndances" accept=".csv">
                                    
                                </div>

                            </div>

                        </div>    
                        
                    </div>

                    <div class="form-body fbody2">
                            
                        <h3 class="box-title">Invidiual Attendance</h3>

                        <hr class="m-t-0 m-b-40">
                        
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

                            <div class="col-md-6">

                                <div class="form-group">

                                    <div class="demo-radio-button">
                                        
                                        <input name="status" 
                                               class="with-gap radio-col-green" 
                                               id="radio_3" 
                                               type="radio"
                                               value="P" 
                                               checked
                                            />
                                        <label for="radio_3">Present</label>
                                        
                                        <input name="status" 
                                               class="with-gap radio-col-red" 
                                               id="radio_4" 
                                               type="radio" 
                                               value="A"
                                            />
                                        <label for="radio_4">Absent</label>

                                    </div>

                                </div>

                            </div>

                        </div>    
                        
                    </div>

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

<script>

    $(document).ready(function(){
        
        $('.fbody2').hide();

        $('.type').change(function(){
            
            if(!$('.fbody2').is(":visible")){
                $('#emp_code').val('');
                $('.fbody1').hide();
                $('.fbody2').show();
            }
            else{
                $('#attndances').val('');
                $('.fbody1').show();
                $('.fbody2').hide();

            }
            
        });

    });

</script>
