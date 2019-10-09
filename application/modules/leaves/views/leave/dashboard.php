    <div class="row page-titles">
        <div class="col-md-8 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Leaves</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Leaves</li>
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
                                    <th>Date</th>
                                    <th>Type</th>
                                    <th>Remarks</th>
                                    <th>Satus</th>
                                    <th>Action</th>

                                </tr>

                            </thead>
                            
                            <tbody> 

                                <?php 
                                
                                $status = true;
                                if($leave_dtls) {
                                    
                                        foreach($leave_dtls as $e_dtls) {

                                ?>

                                        <tr>

                                            <td><?php echo $e_dtls->trans_cd; ?></td>

                                            <td><?php if(strtotime($e_dtls->trans_dt) == strtotime(date('Y-m-d'))) $status=true; echo date('d-m-Y', strtotime($e_dtls->trans_dt)); ?></td>
                                            
                                            <td><?php switch ($e_dtls->leave_type) {
                                                
                                                        case "E": 
                                                            echo "EL";
                                                            break;
                                                        
                                                        case "M": 
                                                            echo "SL";
                                                            break;
                                                            
                                                        case "C": 
                                                            echo "Comp Off";
                                                            break;
                                                            
                                                        case "N": 
                                                            echo "National Holiday";
                                                            break;
                                                
                                                      }

                                                ?>

                                            </td>
                                            
                                            <td><?php echo $e_dtls->remarks; ?></td>

                                            <td><?php echo ($e_dtls->recommendation_status == 0)? '<span class="label label-danger">Unaprove</span>':'<span class="label label-success">Recommended</span>'; ?></td>
                                            
                                            <td class="text-nowrap">
                                                
                                                <?php if($e_dtls->recommendation_status == 0){?>

                                                        <a href="<?php echo site_url('leave/edit?trans_cd='.$e_dtls->trans_cd.''); ?>"
                                                           title="Edit"
                                                        >

                                                            <i class="fas fa-pencil-alt text-inverse m-r-10" style="color: #007bff"></i>
                                                            
                                                        </a>

                                                <?php
                                                        }
                                                        else{

                                                            echo '<span style="margin-right: 30px;"></span>';

                                                        }
                                                ?>

                                                <a href="javascript:void(0)" 
                                                   id="<?php echo $e_dtls->trans_cd; ?>"
                                                   class="delete"
                                                   title="Delete"
                                                   data-toggle="modal" data-target="#deleteModal"
                                                   >
                                                
                                                    <i class="fas fa-window-close text-danger"></i> 
                                                    
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
                                    <?php
                                        if($status) {
                                    ?>
                                        <a class="btn btn-info btn-rounded"
                                           href="<?php echo site_url('leave/add'); ?>" 
                                         >Add New Leave</a>
                                    <?php
                                        }
                                    ?>
                                    </td>
                                    

                                    <td colspan="7">
                                        <div class="text-right">
                                            <ul class="pagination"> </ul>
                                        </div>
                                    </td>

                                </tr>

                            </tfoot>

                        </table>

                        <div class="modal fade" tabindex="-1" role="dialog" id="deleteModal" aria-labelledby="mySmallModalLabel" aria-hidden="true" style="display: none;">

                            <div class="modal-dialog modal-sm">

                                <div class="modal-content">

                                    <div class="modal-header" style="margin-left: 1px">

                                        <h4 class="modal-title" id="mySmallModalLabel">Are you sure?</h4>

                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                                    </div>

                                    <form id="delFrom" method="post" action="<?php echo site_url('leave/delete'); ?>">

                                        <input type="hidden" name="trans_cd" id="del" />

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger waves-effect waves-light">Delete</button>
                                        </div>
                                    
                                    </form>

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

            $('.delete').click(function(){

                $('#del').val($(this).attr('id'));

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