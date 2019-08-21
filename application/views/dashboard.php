    
    <div class="row page-titles">
        <div class="col-md-5 col-8 align-self-center">
            <h3 class="text-themecolor">Dashboard</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </div>
        
    </div>
    
    <div class="row">
        
        <div class="col-md-6 col-lg-3">
            <div class="card card-body">
                
                <div class="row">
                    
                    <div class="col p-r-0 align-self-center">
                        <h2 class="font-light m-b-0">EL</h2>
                        <h6 class="text-muted"></h6></div>
                    
                    <div class="col text-right align-self-center">
                        <div data-label="<?php echo isset($leave_balance->el_bal)? $leave_balance->el_bal : 0 ; ?>" class="css-bar m-b-0 css-bar-info css-bar-<?php echo isset($leave_balance->el_bal)? ceil($leave_balance->el_bal / 48 * 20) * 5 : 0 ; ?>"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-lg-3">
            <div class="card card-body">
                
                <div class="row">
                    
                    <div class="col p-r-0 align-self-center">
                        <h2 class="font-light m-b-0">SL</h2>
                        <h6 class="text-muted"></h6></div>
                    
                    <div class="col text-right align-self-center">
                        <div data-label="<?php echo isset($leave_balance->ml_bal)? $leave_balance->ml_bal : 0 ; ?>" class="css-bar m-b-0 css-bar-success css-bar-<?php echo isset($leave_balance->ml_bal)? ceil($leave_balance->ml_bal / 8 * 20)  * 5 : 0 ; ?>"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card card-body">
                
                <div class="row">
                    
                    <div class="col p-r-0 align-self-center">
                        <h2 class="font-light m-b-0">Comp Off</h2>
                        <h6 class="text-muted"></h6></div>
                    
                    <div class="col text-right align-self-center">
                        <div data-label="<?php echo isset($leave_balance->comp_off_bal)? $leave_balance->comp_off_bal : 0 ; ?>" class="css-bar m-b-0 css-bar-primary css-bar-<?php echo isset($leave_balance->comp_off_bal)? ceil($leave_balance->comp_off_bal / 8 * 20) * 5 : 0 ; ?>"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6 col-lg-3">
            <div class="card card-body">
                
                <div class="row">
                    
                    <div class="col p-r-0 align-self-center">
                        <h2 class="font-light m-b-0">Upcomming</h2>
                        <h6 class="text-muted"></h6></div>
                    
                    <div class="col text-right align-self-center">
                        <div data-label="<?php echo isset($pending->count)? $pending->count : 0 ; ?>" class="css-bar m-b-0 css-bar-warning css-bar-<?php echo isset($pending->count)? $pending->count * 5: 0 ; ?>"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">
        
        <div class="col-md-6 col-lg-3">
            <div class="card card-body">
                
                <div class="row">
                    
                    <div class="col p-r-0 align-self-center">
                        <h2 class="font-light m-b-0">Rejected</h2>
                        <h6 class="text-muted"></h6></div>
                    
                    <div class="col text-right align-self-center">
                        <div data-label="<?php echo isset($reject->count)? $reject->count : 0 ; ?>" class="css-bar m-b-0 css-bar-danger css-bar-<?php echo isset($reject->count)? $reject->count * 5 : 0 ; ?>"></div>
                    </div>
                </div>
            </div>
        </div>

    </div>    