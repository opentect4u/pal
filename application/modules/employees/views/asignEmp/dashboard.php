<style>
    .avatar {
        border-radius: 50%;
    }
</style>    
    <div class="row page-titles">
        <div class="col-md-8 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Assign Employees</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Assign Employees</li>
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

                    <h4 class="card-title"></h4>

                    <h6 class="card-subtitle"></h6>

                    <div class="table-responsive">

                        <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">

                            <thead>

                                <tr>
                                
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Designation</th>
                                    <th>Email</th>
                                    <th>Action</th>

                                </tr>

                            </thead>
                            
                            <tbody> 

                                <?php 
                                
                                if($asignEmp_dtls) {

                                    
                                        foreach($asignEmp_dtls as $e_dtls) {

                                ?>

                                        <tr>

                                            <td><?php echo $e_dtls->emp_code; ?></td>
                                            <td class="row">
                                                
                                                <img class="avatar" src="<?php echo base_url($e_dtls->img_path); ?>" alt="Profile Image" height="40" width="50">
                                                <div style="margin-left: 10px;">
    
                                                    <?php echo $e_dtls->emp_name; ?>

                                                </div>    
                                                
                                            </td>
                                            <td><?php echo $e_dtls->dept_name; ?></td>
                                            <td><?php echo $e_dtls->designation; ?></td>
                                            <td><?php echo $e_dtls->email; ?></td>
                                            <td>
                                            
                                                <a id="<?php echo $e_dtls->emp_code; ?>"
                                                   href="javascript:void(0)"
                                                   class="edit"
                                                   id="<?php echo $e_dtls->emp_code; ?>"
                                                   title="Assign Employee"
                                                >

                                                    <i class="fas fa-pencil-alt text-inverse m-r-10" style="color: #007bff"></i>
                                                    
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

                            <tfoot>

                                <tr>
                                    
                                    <td colspan="7">
                                        <div class="text-right">
                                            <ul class="pagination"> </ul>
                                        </div>
                                    </td>

                                </tr>

                            </tfoot>

                        </table>

                        <div id="add-contact" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            
                            <div class="modal-dialog">
                               
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

            $('.edit').click(function(){

                let id = $(this).attr('id');

                $.get(
                    
                    "<?php echo site_url('employees/assign/operation') ?>",

                    {
                        manage_by: $(this).attr('id')
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

            $('.alert').hide();

            <?php if($this->session->flashdata('msg')['message']){ ?>

                $('.alert').html('<?php echo $this->session->flashdata('msg')['message']; ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

            <?php } ?>

        });
        
    </script>