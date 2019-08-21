    <div class="row page-titles">
        <div class="col-md-8 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Departments</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Departments</li>
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

                    <h4 class="card-title">Department List</h4>

                    <h6 class="card-subtitle"></h6>

                    <div class="table-responsive">

                        <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">

                            <thead>

                                <tr>
                                
                                    <th>Sl No</th>
                                    <th>Department</th>
                                    <th>Action</th>

                                </tr>

                            </thead>
                            
                            <tbody> 

                                <?php 
                                
                                if($department_dtls) {

                                    
                                        foreach($department_dtls as $list) {

                                ?>

                                        <tr>

                                            <td><?php echo $list->sl_no; ?></td>
                                            <td><?php echo $list->dept_name; ?></td>
                                            
                                            <td>
                                            
                                                <a id="<?php echo $list->sl_no; ?>"
                                                   href="javascript:void(0)"
                                                   class="edit"
                                                   title="Edit"
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
                                    <td colspan="2">
                                        <button type="button" id="add" class="btn btn-info btn-rounded" data-toggle="modal" data-target="#add-contact">Add Department</button>
                                    </td>

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

            $('#add').click(function(){

                $.get(
                    
                    "<?php echo site_url('department/add') ?>"
                    
                    ).done(function(data){

                        $('#modal').html(data);
                        $('#add-contact').modal('show');

                });

            });

            $('.edit').click(function(){

                $.get(
                    
                    "<?php echo site_url('department/edit') ?>",

                    {
                        sl_no: $(this).attr('id')
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