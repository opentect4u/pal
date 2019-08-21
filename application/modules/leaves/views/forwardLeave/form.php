    <div class="row page-titles">
        <div class="col-md-7 col-7 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Leaves</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Forward Leaves</li>
            </ol>
        </div>
        <div class="col-md-5 col-12 align-self-center">
            <div class="alert alert-<?php echo $this->session->flashdata('msg')['status']; ?>"></div>
        </div>
    </div>
    
    <div class="row">

        <div class="col-lg-12">

            <div class="card card-outline-info">

                <div class="card-header">

                    <h4 class="m-b-0 text-white">Leaves Forward</h4>
                    
                </div>

                <div class="card-body">

                    <form class="form-horizontal" 
                        id="form"
                        method="post" 
                        action="<?php echo site_url('leave/forwardLeaves/operations');?>"
                    >
                    
                        <div class="form-body">
                            
                            <div class="row">

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <label class="control-label">Current Year</label>

                                        <input type="text" class="form-control" value="<?php echo date('Y'); ?>" readonly />
                                        
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

                                <div class="col-md-6"> </div>

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