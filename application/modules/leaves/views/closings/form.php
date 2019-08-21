<div class="row page-titles">
    <div class="col-md-8 col-8 align-self-center">
        <h3 class="text-themecolor m-b-0 m-t-0">Leave</h3>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
            <li class="breadcrumb-item active">Closing Balance</li>
        </ol>
    </div>
    <div class="col-md-4 col-12 align-self-center">
        <div class="alert alert-<?php echo $this->session->flashdata('msg')['status']; ?>"></div>
    </div>
</div>

<?php
if($_SERVER['REQUEST_METHOD'] == "GET"){

?>

<div class="row">
    
    <div class="col-12">

        <div class="card">

            <div id="divToPrint">
            
                <div class="card-body">

                    <h2 class="card-title" style="text-align: center;"><u>Leave Closing Balances For All Employees For Date <?php echo date('d-m-Y'); ?></u> </h2>
                    
                    <form action="<?php echo site_url('leaves/closings/updateclosings'); ?>"
                          method="POST"
                          enctype="multipart/form-data"
                        >

                        <div class="form-body">
                            
                            <div class="row">

                                <div class="col-md-6">

                                    <div class="form-group">
    
                                        <label class="control-label">Upload Leave Balances</label>

                                        <input type="file" name="closings" accept=".csv" />

                                    </div>


                                </div>

                            </div>

                            <div class="row">

                                <div class="col-md-6">

                                    <div class="row">

                                        <div class="col-md-offset-3 col-md-9">

                                            <button type="submit" class="btn btn-success">Import</button>

                                        </div>

                                    </div>

                                </div>

                            </div>

                    </form>
                    
                    <h6 class="card-subtitle"></h6>

                    <div class="table-responsive">

                        <table id="demo-foo-addrow" style="width: 100%;" class="table m-t-30 table-hover contact-list">

                            <thead>

                                <tr>
                                
                                    <th>SL No.</th>
                                    <th>Emp Code</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>SL</th>
                                    <th>EL</th>
                                    <th>Comp Off</th>

                                </tr>

                            </thead>
                            
                            <tbody> 

                                <?php 
                                
                                if($closings) {

                                        $i = 1;
                                        foreach($closings as $list) {

                                ?>

                                        <tr>
                                        
                                            <td><?php echo $i++; ?></td>
                                            <td class="emp_code"><?php echo $list->emp_code; ?></td>
                                            <td><?php echo $list->emp_name; ?></td>
                                            <td><?php echo $list->department; ?></td>
                                            <td style="text-align: right;"> <input type="hidden" class="form-control sl_cls" value="<?php echo $list->sl; ?>" /> <span class="sl"><?php echo $list->sl; ?></span></td>
                                            <td style="text-align: right;"> <input type="hidden" class="form-control el_cls" value="<?php echo $list->el; ?>" /> <span class="el"><?php echo $list->el; ?></span></td>
                                            <td style="text-align: right;"> <input type="hidden" class="form-control compoff_cls" value="<?php echo $list->compoff; ?>" /> <span class="compoff"><?php echo $list->compoff; ?></span></td>

                                        </tr>

                                <?php
                                        
                                        }

                                    }

                                    else {

                                        echo "<tr><td colspan='6' style='text-align: center;'>No data Found</td></tr>";

                                    }
                                ?>
                            
                            </tbody>

                        </table>

                    </div>

                </div>

            </div>

            <!-- <div style="text-align: center;">

                <button class="btn btn-info" type="button" onclick="printDiv();">Print</button>

            </div> -->

        </div>
        
    </div>

</div>

<script>
    $(document).ready(function(){

        $('.alert').hide();

            <?php if($this->session->flashdata('msg')['message']){ ?>

                $('.alert').html('<?php echo $this->session->flashdata('msg')['message']; ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

            <?php } ?>
            
        $('table').DataTable({
            dom: 'Bfrtip',
            paging: false,
            searching: false,
            buttons: [
                'excel'
            ]
        });

        //Individual Employee
        //For SL 
        $('.sl').dblclick(function() {
            $(this).hide();
            $('.sl_cls:eq('+ $('.sl').index(this)+')').attr('type', 'text');
        });

        $('.sl_cls').blur(function(){

            $('.sl:eq('+ $('.sl_cls').index(this)+')').html($(this).val());
            $('.sl').show();
            $('.sl_cls').attr('type', 'hidden');
            $.post('<?php echo site_url('leaves/closings/changeClosing'); ?>',{
                leaveType: 'S',
                empCode: $('.emp_code:eq('+$('.sl_cls').index(this)+')').html(),
                balance: $(this).val()
            });
            alert('Successfully Changed');
        });

        //For EL 
        $('.el').dblclick(function() {
            $(this).hide();
            $('.el_cls:eq('+ $('.el').index(this)+')').attr('type', 'text');
        });

        $('.el_cls').blur(function(){

            $('.el:eq('+ $('.el_cls').index(this)+')').html($(this).val());
            $('.el').show();
            $('.el_cls').attr('type', 'hidden');
            $.post('<?php echo site_url('leaves/closings/changeClosing'); ?>',{
                leaveType: 'E',
                empCode: $('.emp_code:eq('+$('.el_cls').index(this)+')').html(),
                balance: $(this).val()
            });
            alert('Successfully Changed');
        });

        //For CompOff 
        $('.compoff').dblclick(function() {
            $(this).hide();
            $('.compoff_cls:eq('+ $('.compoff').index(this)+')').attr('type', 'text');
        });

        $('.compoff_cls').blur(function(){

            $('.compoff:eq('+ $('.compoff_cls').index(this)+')').html($(this).val());
            $('.compoff').show();
            $('.compoff_cls').attr('type', 'hidden');
            $.post('<?php echo site_url('leaves/closings/changeClosing'); ?>',{
                leaveType: 'C',
                empCode: $('.emp_code:eq('+$('.compoff_cls').index(this)+')').html(),
                balance: $(this).val()
            });
            alert('Successfully Changed');
        });

    });
</script>

<?php
}
?>