<style>
.avatar {
  border-radius: 50%;
}
</style>
    <div class="row page-titles">
        <div class="col-md-8 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Attendances</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Attendance Sheet</li>
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
                                
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Attendance</th>

                                </tr>

                            </thead>
                            
                            <tbody> 

                                <?php 
                                
                                if($attendance_dtls) {

                                    
                                        foreach($attendance_dtls as $e_dtls) {

                                ?>

                                        <tr>

                                            <td><?php echo $e_dtls->emp_code; ?></td>
                                            <td class="row">
                                                
                                                <img class="avatar" src="<?php echo base_url($e_dtls->img_path); ?>" alt="Profile Image" height="40" width="50">
                                                <div style="margin-left: 10px;">
    
                                                    <?php echo $e_dtls->emp_name; ?>

                                                </div>    
                                                
                                            </td>
                                            <td><?php echo $e_dtls->department; ?></td>
                                            <td><a href="javascript:void(0)" class="status" id="<?php echo $e_dtls->emp_code; ?>" val="<?php echo $e_dtls->status; ?>">

                                                    <span class="badge badge-<?php echo ($e_dtls->status == "P")? 'success' : 'danger'; ?>"><?php echo ($e_dtls->status == "P")? 'Present':'Absent'; ?></span> 

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
                                        <a href="<?php echo site_url('attendance/add'); ?>" class="btn btn-info btn-rounded">Add Attendances</button>
                                    </td>

                                    <td colspan="2">
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
   
        $(document).ready(function() {
            $('#demo-foo-addrow').DataTable({
                "paging": false
            });
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

                $.get('<?php echo site_url("attendance/updateStatus"); ?>',
                    {
                        trans_id: transId,
                        value:    value
                    }
                )
                .done(function(data){

                    if(value == 'P'){
                        
                        $('.badge:eq('+indexNo+')').attr('class', 'badge badge-danger');
                        $('.badge:eq('+indexNo+')').html('Absent');
                        $('.status:eq('+indexNo+')').attr('val', data);

                    }
                    else{
                        
                        $('.badge:eq('+indexNo+')').attr('class', 'badge badge-success');
                        $('.badge:eq('+indexNo+')').html('Present');
                        $('.status:eq('+indexNo+')').attr('val', data);

                    } 
                });
                
            });

        });

    </script>
