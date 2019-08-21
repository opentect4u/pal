    <div class="row page-titles">
        <div class="col-md-8 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Leaves</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Approve Leaves</li>
            </ol>
        </div>
        <div class="col-md-4 col-12 align-self-center">
            <div class="alert alert-<?php echo $this->session->flashdata('msg')['status']; ?>"></div>
        </div>
    </div>
    
    <div class="row">
    
        <div class="col-12">

            <div class="card">

                <div class="card-body">

                    <h6 class="card-subtitle"></h6>

                    <div class="table-responsive">

                        <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">

                            <thead>

                                <tr>
                                
                                    <th>Sl No</th>
                                    <th>Application Date</th>
                                    <th>Employee Name</th>
                                    <th>HOD Remarks</th>
                                    <th>Department</th>                                    
                                    <th>Action</th>

                                </tr>

                            </thead>
                            
                            <tbody> 

                                <?php 
                                
                                if($leave_dtls) {

                                    
                                        foreach($leave_dtls as $e_dtls) {

                                ?>

                                        <tr>

                                            <td><?php echo $e_dtls->trans_cd; ?></td>
                                            <td><?php echo date('d-m-Y', strtotime($e_dtls->trans_dt)); ?></td>
                                            <td><?php echo $e_dtls->emp_name; ?> </td>
                                            <td><?php echo $e_dtls->recommend_remarks; ?></td>
                                            <td><?php echo $e_dtls->dept_name; ?></td>
                                            <td>
                                            
                                                <a href="javascript:void(0)"
                                                   class="view"
                                                   title="View & Approve"
                                                   id="<?php echo $e_dtls->trans_cd; ?>"
                                                >

                                                    <i class="mdi mdi-36px mdi-eye" style="color: #7b8299"></i>
                                                    
                                                </a>
                                                
                                            </td>

                                        </tr>

                                <?php
                                        
                                        }

                                    }

                                    else {

                                        echo "<tr><td colspan='10' style='text-align: center;'>No data Found</td></tr>";

                                    }
                                ?>
                            
                            </tbody>

                        </table>

                        <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            
                            <div class="modal-dialog modal-lg">

                                <div class="modal-content">
                                    
                                        <div id="modal"></div>
                                    
                                </div>

                            </div>

                        </div>

                    </div>

                </div>

            </div>
            
        </div>

    </div>
    

    <script>
    
        $(document).ready(function(){

            $('.view').click(function(){

                $.get(
                    
                    "<?php echo site_url('leave/approve/form') ?>",

                    {
                        trans_cd: $(this).attr('id')
                    }
                    
                    ).done(function(data){

                        $('#modal').html(data);
                        $('#add-contact').modal('show');

                });

            });

        });

    </script>

    <script>
   
        $(document).ready(function() {
            $('table').DataTable();
            $('.alert').hide();

            <?php if($this->session->flashdata('msg')['message']){ ?>

                $('.alert').html('<?php echo $this->session->flashdata('msg')['message']; ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

            <?php } ?>

         });
        
    </script>
    