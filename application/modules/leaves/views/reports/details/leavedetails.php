<div class="row page-titles">
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Leaves</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Leave</a></li>
            <li class="breadcrumb-item active">Ledger Report</li>
        </ol>
    </div>
</div>

<div class="row">

    <div class="col-12">

        <div class="card">

            <div class="card-body">
                
                <table id="demo-foo-addrow" style="width: 100%;" class="table m-t-30 table-hover contact-list">

                    <thead>

                        <tr>
                        
                            <th>Leave No</th>
                            <th>Application Date</th>
                            <th>Leave Period</th>
                            <th>Recommendation Date</th>
                            <th>Recommended By</th>
                            <th>Approval Date</th>
                            <th>Reason</th>
                            <th>View</th>

                        </tr>

                    </thead>

                    <tbody> 

                        <?php 
                        
                        if($leave_dtls) {
                            
                            foreach($leave_dtls as $l_dtls) {

                        ?>

                                <tr>

                                    <td><?php echo $l_dtls->trans_cd; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($l_dtls->trans_dt)); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($l_dtls->from_dt)).' To '.date('d-m-Y', strtotime($l_dtls->to_dt)); ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($l_dtls->recommend_dt)); ?></td>
                                    <td><?php echo $l_dtls->recommend_by; ?></td>
                                    <td><?php echo date('d-m-Y', strtotime($l_dtls->approval_dt)); ?></td>
                                    <td><?php echo $l_dtls->reason; ?></td>
                                    <td><a href="javascript:void(0)" class="view" title="View" id="<?php echo $l_dtls->trans_cd; ?>">

                                            <i class="mdi mdi-36px mdi-eye" style="color: #7b8299"></i>
                                            
                                    </td></a>

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

<script>

    $(document).ready(function(){
        
        $('.view').click(function(){

            $.get(
                
                "<?php echo site_url('leave/detail') ?>",

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