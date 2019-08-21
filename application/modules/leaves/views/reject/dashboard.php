    <div class="row page-titles">
        <div class="col-md-8 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Leaves</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Cancle Leaves</li>
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
                                
                                    <th>Leave Code</th>
                                    <th>Date</th>
                                    <th>Leave Type</th>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>No of Dayes</th>
                                    <th>Action</th>

                                </tr>

                            </thead>
                            
                            <tbody> 

                                <?php 
                                
                                if($leave_dtls) {

                                    
                                        foreach($leave_dtls as $list) {

                                ?>

                                        <tr>

                                            <td><?php echo $list->trans_cd; ?></td>

                                            <td><?php echo date('d-m-Y', strtotime($list->trans_dt)); ?></td>
                                            
                                            <td><?php switch ($list->leave_type) {
                                                
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
                                                        
                                                        case "HE": 
                                                            echo "Half EL";
                                                            break;
                                                        
                                                        case "HM": 
                                                            echo "Half SL";
                                                            break;
                                                            
                                                        case "HC": 
                                                            echo "Half Comp Off";
                                                            break;
                                                            
                                                        case "HN": 
                                                            echo "Half National Holiday";
                                                            break;
                                                
                                                      }

                                                ?>

                                            </td>
                                            
                                            <td><?php echo date('d-m-Y', strtotime($list->from_dt)); ?></td>
                                            
                                            <td><?php echo date('d-m-Y', strtotime($list->to_dt)); ?></td>

                                            <td><?php echo $list->amount; ?></td>
                                            
                                            <td class="text-nowrap">

                                                <a href="javascript:void(0)" 
                                                   id="<?php echo $list->trans_cd; ?>"
                                                   type="<?php echo $list->leave_type; ?>"
                                                   amount="<?php echo $list->amount; ?>"
                                                   class="reject"
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

                                    <form id="delFrom" method="post" action="<?php echo site_url('leave/reject/delete'); ?>">

                                        <input type="hidden" id="trans_cd" name="trans_cd" id="del" />
                                        <input type="hidden" id="type" name="type" id="del" />
                                        <input type="hidden" id="amount" name="amount" id="del" />
                                        <input type="hidden" name="emp_code" value="<?php echo $leave_dtls[0]->emp_code; ?>">
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

            $('.reject').click(function(){

                $('#trans_cd').val($(this).attr('id'));
                $('#type').val($(this).attr('type'));
                $('#amount').val($(this).attr('amount'));
                    
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
    