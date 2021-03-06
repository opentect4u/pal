    
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Dashboard</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
        
    </div>

    <div>
        <h5 class="text-themecolor">Your Leave Balances : </h5>
    </div>    
    
    <div class="row">
        
        <div class="col-md-6 col-lg-3">
            <div class="card card-body">
                
                <div class="row">
                    
                    <div class="col p-r-0 align-self-center">
                        <h4 class="font-light m-b-0">EL</h4>
                        <h6 class="text-muted"></h6></div>
                    
                    <div class="col text-right align-self-center">
                        <div data-label="<?php echo isset($leave_balance->el_bal)? $leave_balance->el_bal : 0 ; ?>" class="css-bar m-b-0 css-bar-info css-bar-100"></div>

                        <?php //echo isset($leave_balance->el_bal)? ceil($leave_balance->el_bal / 48 * 20) * 5 : 0 ; ?>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card card-body">
                
                <div class="row">
                    
                    <div class="col p-r-0 align-self-center">
                        <h4 class="font-light m-b-0">SL</h4>
                        <h6 class="text-muted"></h6></div>
                    
                    <div class="col text-right align-self-center">
                        <div data-label="<?php echo isset($leave_balance->ml_bal)? $leave_balance->ml_bal : 0 ; ?>" class="css-bar m-b-0 css-bar-success css-bar-100"></div>

                        <?php //echo isset($leave_balance->ml_bal)? ceil($leave_balance->ml_bal / 8 * 20)  * 5 : 0 ; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card card-body">
                
                <div class="row">
                    
                    <div class="col p-r-0 align-self-center">
                        <h4 class="font-light m-b-0">Comp Off</h4>
                        <h6 class="text-muted"></h6></div>
                    
                    <div class="col text-right align-self-center">
                        <div data-label="<?php echo isset($leave_balance->comp_off_bal)? $leave_balance->comp_off_bal : 0 ; ?>" class="css-bar m-b-0 css-bar-primary css-bar-100"></div>

                        <?php //echo isset($leave_balance->comp_off_bal)? ceil($leave_balance->comp_off_bal / 8 * 20) * 5 : 0 ; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <h5 class="text-themecolor">Your Leave Application Status : </h5>
    </div>  

    <div class="row">

        <div class="col-md-6 col-lg-3">
            <div class="card card-body">
                
                <div class="row">
                    
                    <div class="col p-r-0 align-self-center">
                        <h4 class="font-light m-b-0">Approved</h4>
                        <h6 class="text-muted"></h6></div>
                    
                    <div class="col text-right align-self-center">
                        <div data-label="<?php echo isset($pending->pending_lv)? $pending->pending_lv : 0 ; ?>" class="css-bar m-b-0 css-bar-warning css-bar-100"></div>

                        <?php //echo isset($pending->pending_lv)? $pending->pending_lv * 5: 0 ; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card card-body">
                
                <div class="row">
                    
                    <div class="col p-r-0 align-self-center">
                        <h4 class="font-light m-b-0">Rejected</h4>
                        <h6 class="text-muted"></h6></div>
                    
                    <div class="col text-right align-self-center">
                        <div data-label="<?php echo isset($reject->count)? $reject->count : 0 ; ?>" class="css-bar m-b-0 css-bar-danger css-bar-100"></div>

                        <?php //echo isset($reject->count)? $reject->count * 5 : 0 ; ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="col-md-6 col-lg-3">
            <div class="card card-body">
                
                <div class="row">
                    
                    <div class="col p-r-0 align-self-center">
                        <h4 class="font-light m-b-0">Pending To HOD</h4>
                        <h6 class="text-muted"></h6></div>
                    
                    <div class="col text-right align-self-center">
                        <div data-label="<?php echo isset($hod->count)? $hod->count : 0 ; ?>" class="css-bar m-b-0 css-bar-success css-bar-100"></div>

                        <?php //echo isset($reject->count)? $reject->count * 5 : 0 ; ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card card-body">
                
                <div class="row">
                    
                    <div class="col p-r-0 align-self-center">
                        <h4 class="font-light m-b-0">Pending To HR</h4>
                        <h6 class="text-muted"></h6></div>
                    
                    <div class="col text-right align-self-center">
                        <div data-label="<?php echo isset($hr->count)? $hr->count : 0 ; ?>" class="css-bar m-b-0 css-bar-warning css-bar-100"></div>
                        <?php //echo isset($reject->count)? $reject->count * 5 : 0 ; ?>
                    </div>
                </div>
            </div>
        </div>

    </div>    