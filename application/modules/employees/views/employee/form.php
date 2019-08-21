<div class="modal-header">
    
    <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4> 

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>  

</div>

    <form class="form-horizontal form-material" 
        id="form"
        method="post" 
        action="<?php echo site_url('employee/'.$url.'');?>"
        >
        
        <div class="modal-body">

            <div class="form-group">

                <div class="col-md-12 m-b-20">

                    <input type="<?php echo $type; ?>" 
                        class="form-control" 
                        name="emp_code"
                        placeholder="Employee Code"
                        value="<?php echo $emp->emp_code; ?>"
                        required
                        /> 
                    
                </div>

                <div class="col-md-12 m-b-20">
                    
                    <input type="text" 
                        class="form-control" 
                        name="emp_name"
                        placeholder="Name"
                        value="<?php echo $emp->emp_name; ?>"
                        required
                        />

                </div>

                <div class="col-md-12 m-b-20">
                    
                    <input type="email" 
                        class="form-control" 
                        name="email"
                        placeholder="Email"
                        value="<?php echo $emp->email; ?>"
                    />
                    
                </div>

                <div class="col-md-12 m-b-20">

                    <input type="text" 
                        class="form-control" 
                        name="phn_no"
                        placeholder="Phone"
                        value="<?php echo $emp->phn_no; ?>"
                        />
                    
                </div>

                <div class="col-md-12 m-b-20">

                    <input type="text" 
                        class="form-control" 
                        name="gurd_name"
                        placeholder="Guardian Name"
                        value="<?php echo $emp->gurd_name; ?>"
                        />
                    
                </div>

                <div class="col-md-12 m-b-20">

                    <select class="form-control"
                            name="marital_status"
                            id="marital_status"
                            required
                            >

                        <option value="">Marital Status</option>
                        <option value="M" <?php echo ($emp->marital_status == 'M')? 'selected':''; ?>>Married</option>
                        <option value="U" <?php echo ($emp->marital_status == 'U')? 'selected':''; ?>>Unmarried</option>
                        
                    </select>
                    
                </div>

                <div class="col-md-12 m-b-20">

                    <select class="form-control"
                            name="gender"
                            id="gender"
                            required
                            >

                        <option value="">Gender</option>
                        <option value="F" <?php echo ($emp->gender == 'F')? 'selected':''; ?>>Female</option>
                        <option value="M" <?php echo ($emp->gender == 'M')? 'selected':''; ?>>Male</option>
                        <option value="O" <?php echo ($emp->gender == 'O')? 'selected':''; ?>>Othre</option>
                        
                    </select>
                    
                </div>

                <div class="col-md-12 m-b-20">
                    
                    <select class="form-control" 
                            name="department"
                            required
                        >

                                <option>Department</option>

                        <?php

                            foreach($department as $d_list){

                                ?>

                                <option value="<?php echo $d_list->sl_no ?>" 
                                        
                                        <?php echo ($emp->department == $d_list->sl_no)? 'selected':''; ?>

                                ><?php echo $d_list->dept_name ?></option>

                                <?php

                            }

                        ?>

                    </select>
                   
                </div>

                <div class="col-md-12 m-b-20">
                    
                    <input type="text" 
                        class="form-control" 
                        name="designation"
                        placeholder="Designation"
                        value="<?php echo $emp->designation; ?>"
                        />
                    
                </div>

                <div class="col-md-12 m-b-20">

                    <input type="text" 
                        class="form-control" 
                        name="join_dt"
                        id="join_dt"
                        placeholder="Date of joining"
                        value="<?php echo ($emp->joining_date)? date('d-m-Y', strtotime($emp->joining_date)) : $emp->joining_date; ?>"
                        />
                    
                </div>

                <div class="col-md-12 m-b-20">

                    <select class="form-control"
                            name="emp_type"
                            id="emp_type"
                            required
                            >

                        <option value="">Employee Type</option>
                        <option value="E" <?php echo ($emp->emp_type == 'E')? 'selected':''; ?>>Employee</option>
                        <option value="H" <?php echo ($emp->emp_type == 'H')? 'selected':''; ?>>HOD</option>
                        <option value="HR" <?php echo ($emp->emp_type == 'HR')? 'selected':''; ?>>HR</option>
                        
                    </select>
                    
                </div>

                <div class="col-md-12 m-b-20">

                    <select class="form-control"
                            name="emp_catg"
                            id="emp_catg"
                            required
                            >

                        <option value="">Category</option>
                        <option value="C" <?php echo ($emp->emp_catg == 'C')? 'selected':''; ?>>Confirmed Employee</option>
                        <option value="P" <?php echo ($emp->emp_catg == 'P')? 'selected':''; ?>>Probationary period</option>
                        
                    </select>
                    
                </div>

                <div class="col-md-12 m-b-20">

                    <select class="form-control"
                            name="reset_pass"
                            id="reset_pass"
                            >

                        <option value="">Password as it is</option>
                        <option value="R">Reset to 321</option>
                        
                    </select>
                    
                </div>

                <div class="col-md-12 m-b-20">

                    <input type="text" 
                           class="form-control" 
                           name="termination_dt"
                           id="termination_dt"
                           placeholder="Date of termination"
                           value="<?php echo ($emp->termination_date)? date('d-m-Y', strtotime($emp->termination_date)) : $emp->termination_date; ?>"
                        />
                    
                </div>                

            </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-info waves-effect" >Save</button>
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
        </div>

    </form>
            
<script>
    
    $(document).ready(function(){

        $('#join_dt').click(function(){

            $(this).attr('type', 'date');

        });

        $('#termination_dt').click(function(){

            $(this).attr('type', 'date');

        });

        $('#emp_type').change(function(){

            if($(this).val() == 'E'){

                $('#emp_catg').val('');
                $('#emp_catg').show();

            }
            else if($(this).val() != 'E'){

                $('#emp_catg').val('C');

                //$('#emp_catg').hide();
                
            }

        });

    });

</script>