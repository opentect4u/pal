<div class="row page-titles">

    <div class="col-md-8 col-12 align-self-center">

        <h3 class="text-themecolor m-b-0 m-t-0">Payroll</h3>

        <ol class="breadcrumb">

            <li class="breadcrumb-item"><a href="javascript:void(0)">Payroll</a></li>

            <li class="breadcrumb-item active">Payslip Generation</li>

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
                    method="post" 
                    action="<?php echo site_url('payroll/payslipgeneration');?>"
                >
                
                    <div class="form-body">
                        
                        <div class="row">
                                    
                            <div class="col-md-6">
                        
                                <div class="form-group">
                        
                                    <label class="control-label">Month</label>
                        
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
                                            readonly
                                    >
                                </div> 
                        
                            </div>
                        
                        </div>     
                            
                    </div>

                    <div class="form-actions">

                        <div class="row">

                            <div class="col-md-6">

                                <div class="row">

                                    <div class="col-md-offset-3 col-md-9">

                                        <button type="submit" name="submit" value="generate" class="btn btn-success">Generate</button>

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

        $('#month').change(function(){

            $.get('<?php echo site_url("payroll/payslipgeneration/check"); ?>',
                {
                    month: $(this).val(),
                    year: $('#year').val()
                }
            ).done(function(data){
                
                if(data > 0){

                    $('#alert').attr('class', 'alert alert-danger');
                    $('.alert').html('Already generated <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();
                    $('.btn').html('Regenerate'); 
                    $('.btn').val('regenerate'); 

                }
                else{
                    $('.alert').hide();
                    $('.btn').html('Generate');
                    $('.btn').val('generate'); 

                }
            });

        });

        $('button').click(function(){
            
            $('button').attr('type', 'submit');

        });

    });

</script>

<script>
   
    $(document).ready(function() {

        $('.alert').hide();

        <?php if($this->session->flashdata('msg')['message']){ ?>

            $('.alert').html('<?php echo $this->session->flashdata('msg')['message']; ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

        <?php } ?>

    });
    
</script>