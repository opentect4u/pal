<div class="row page-titles">

    <div class="col-md-6 col-8 align-self-center">

        <h3 class="text-themecolor m-b-0 m-t-0">Abcents</h3>

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="javascript:void(0)">Abcent</a></li>

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

                <h4 class="m-b-0 text-white">Abcent & Half Form</h4>
                
            </div>

            <div class="card-body">

                <form class="form-horizontal" 
                    id="form"
                    method="post" 
                    enctype="multipart/form-data"
                    action="<?php echo site_url('attendance/absents/add');?>"
                    >

                    <input type="file" name="inputfile" class="form-control">
                    <input type="submit" value="Submit" class="btn btn-primary">

                    <!-- <div class="form-body">

                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">
                                    
                                    <label for="date" class="control-label">Month</label>

                                    <select class=form-control  name="month">
                                        <option value="1">January</option>
                                        <option value="2">February</option>
                                        <option value="3">March</option>
                                        <option value="4">April</option>
                                        <option value="5">May</option>
                                        <option value="6">June</option>
                                        <option value="7">July</option>
                                        <option value="8">August</option>
                                        <option value="9">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                    
                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">
                                    
                                    <label for="date" class="control-label">Year</label>

                                    <input type="text"
                                           class="form-control"
                                           name="year"
                                           value="<?php echo date('Y'); ?>"
                                    />                                            

                                </div>

                            </div>

                            <!-- <div class="col-md-4">

                                <div class="form-group">
                                    
                                    <label for="" class="control-label">Choose</label>

                                    <div class="demo-radio-button">
                                        
                                        <input name="group" class="type" id="radio_1" type="radio" />
                                        <label for="radio_1">For Bulk Upload</label>
                                        <input name="group" class="type" id="radio_2" type="radio" checked />
                                        <label for="radio_2">Single Employee</label>

                                    </div>
                                    
                                </div>

                            </div> -->

                        </div>

                    </div>

                    <div class="form-body fbody1">

                        <h3 class="box-title">Import Abcents & Halfs In CSV</h3>

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

                        <div class="row">
                            <div class="col-md-11">
                                <h3 class="box-title">Invidiual Abcents & Halfs</h3>
                            </div>
                            <div class="col-md-1">
                                <button type="button" class="btn btn-success addAnother" title="Add another employee"><i class="fa fa-plus"></i></button>
                            </div>
                        </div>    

                        <hr class="m-t-0 m-b-40">
                        
                        <div class="row">

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="emp_code" class="control-label">Employee</label>

                                    <select class="form-control" 
                                            id="emp_code"
                                            name="emp_code[]"
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

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="absent" class="control-label">Abcent Day</label>

                                    <input type="text"
                                           class="form-control"
                                           name="absent[]"
                                           value="1"
                                        />

                                </div>

                            </div>

                            <div class="col-md-4">

                                <div class="form-group">

                                    <label for="half" class="control-label">Half</label>

                                    <input type="text"
                                           class="form-control"
                                           name="half[]" 
                                        />

                                </div>

                            </div>

                        </div>  

                        <div id="intro">
                        </div>  
                        
                    </div>

                    <!--<div class="form-actions">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="row">

                                    <div class="col-md-offset-3 col-md-9">

                                        <button type="submit" class="btn btn-success">Submit</button>

                                    </div>

                                </div>

                            </div>

                        </div>

                    </div> -->

                </form>

            </div>

        </div>

    </div>

</div>

<script>

    $(document).ready(function(){
        
        $('.fbody1').hide();

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

<script>
    $(document).ready(function(){

        $('.addAnother').click(function(){

            let row = `<div class="row">

                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="emp_code" class="control-label">Employee</label>

                                <select class="form-control" 
                                        id="emp_code"
                                        name="emp_code[]"
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

                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="emp_code" class="control-label">Abcent Day</label>

                                <input type="text"
                                    class="form-control"
                                    name="absent[]"
                                    value="1"
                                    />

                            </div>

                        </div>

                        <div class="col-md-4">

                            <div class="form-group">

                                <label for="emp_code" class="control-label">Half</label>

                                <input type="text"
                                    class="form-control"
                                    name="half[]" 
                                    />

                            </div>

                        </div>

                    </div>`;

            $('#intro').append(row);

        });

    });
</script>
