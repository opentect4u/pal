
    <div class="row page-titles">
        <div class="col-md-8 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Payroll</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Payslips</li>
            </ol>
        </div>
        <div class="col-md-4 col-12 align-self-center">
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
                                
                                    <th>Date</th>
                                    <th>Month</th>
                                    <th>Year</th>
                                    <th>Net Salary</th>
                                    <th>Action</th>

                                </tr>

                            </thead>
                            
                            <tbody> 

                                <?php 
                                
                                if($pay_list) {

                                    
                                        foreach($pay_list as $p_list) {

                                ?>

                                        <tr>

                                            <td><?php echo date('d-m-Y', strtotime($p_list->trans_dt)); ?></td>
                                            <td><?php echo $p_list->month; ?></td>
                                            <td><?php echo $p_list->year; ?></td>
                                            <td><?php echo $p_list->net_amount; ?></td>
                                            <td>
                                            
                                                <a href="<?php echo site_url('payroll/payslips/view?month=').$p_list->month.'&year='.$p_list->year; ?>"
                                                   class="edit"
                                                   title="Edit"
                                                >

                                                    <i class="fas fa-eye text-inverse m-r-10" style="color: #007bff"></i>
                                                    
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
                                    
                                    <td colspan="5">
                                        <div class="text-right">
                                            <ul class="pagination"> </ul>
                                        </div>
                                    </td>

                                </tr>

                            </tfoot>

                        </table>

                    </div>

                </div>

            </div>
            
        </div>

    </div>
    

    <script>
    
        $(document).ready(function(){

            $('#demo-foo-addrow').DataTable({
                "paging": false
            });
            

            $('#add').click(function(){

                $.get(
                    
                    "<?php echo site_url('employee/add') ?>"
                    
                    ).done(function(data){

                        $('#modal').html(data);
                        $('#add-contact').modal('show');

                });

            });

            $('.edit').click(function(){

                $.get(
                    
                    "<?php echo site_url('employee/edit') ?>",

                    {
                        emp_no: $(this).attr('id')
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
        
    

    $(document).ready( function (){

        $('.status').click(function () {

            var indexNo =   $('.status').index(this),
                transId =   $(this).attr('id'),
                value   =   $(this).attr('val');

            $.get('<?php echo site_url("employee/updateStatus"); ?>',
                {
                    trans_id: transId,
                    value:    value
                }
            )
            .done(function(data){

                if(value == 'A'){
                    
                    $('.badge:eq('+indexNo+')').attr('class', 'badge badge-danger');
                    $('.badge:eq('+indexNo+')').html('Inactive');
                    $('.status:eq('+indexNo+')').attr('val', data);

                }
                else{
                    
                    $('.badge:eq('+indexNo+')').attr('class', 'badge badge-success');
                    $('.badge:eq('+indexNo+')').html('Active');
                    $('.status:eq('+indexNo+')').attr('val', data);

                } 
            });
            
        });

    });

</script>
