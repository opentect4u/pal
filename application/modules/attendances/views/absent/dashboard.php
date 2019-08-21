<style>
.avatar {
  border-radius: 50%;
}
</style>
    <div class="row page-titles">
        <div class="col-md-8 col-8 align-self-center">
            <h3 class="text-themecolor m-b-0 m-t-0">Absents</h3>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                <li class="breadcrumb-item active">Absent Sheet</li>
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

                    <h4 class="card-title">For current month only</h4>

                    <h6 class="card-subtitle"></h6>

                    <div class="table-responsive">
                    
                        <form class="form-horizontal" 
                          id="form"
                          method="post" 
                          enctype="multipart/form-data"
                          action="<?php echo site_url('attendance/absents/add');?>"
                        >

                            <div class="row">

                                <div class="col-md-4">

                                    <div class="form-group">

                                        <select name="month" id="month" class="form-control">
                                            <?php foreach($month as $m_list) {?>
                            
                                                <option value="<?php echo $m_list->id ?>" <?php echo ($m_list->id == date('m'))? 'selected' : ''; ?> ><?php echo $m_list->month_name; ?></option>
                            
                                            <?php
                                                    }
                                            ?>
                                        </select>

                                    </div>

                                </div>

                                <div class="col-md-4">

                                    <div class="form-group">
                                        <input type="text" class="form-control" name="year" id="year" value="<?php echo date('Y'); ?>">
                                    </div>

                                </div>

                            </div>

                            <table class="table m-t-30 table-hover contact-list" data-page-size="10">

                                <thead>

                                    <tr>
                                    
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Department</th>
                                        <th>Absent</th>
                                        <th>Half</th>

                                    </tr>

                                </thead>
                                
                                <tbody> 

                                    <?php 
                                    
                                        echo $absent_dtls;

                                    ?>
                                
                                </tbody>

                                <tfoot>

                                    <tr>
                                        <td colspan="2">
                                        
                                            <button type="submit" class="btn btn-info btn-rounded">Submit</button>

                                        </td>

                                        <!-- <td colspan="3">
                                            <div class="text-right">
                                                <ul class="pagination"> </ul>
                                            </div>
                                        </td> -->

                                    </tr>

                                </tfoot>

                            </table>

                        </form>    

                    </div>

                </div>

            </div>
            
        </div>

    </div>
            
    <script>
   
        $(document).ready(function() {
            $('table').DataTable({
                "paging": false
            });
            $('.alert').hide();

            <?php if($this->session->flashdata('msg')['message']){ ?>

                $('.alert').html('<?php echo $this->session->flashdata('msg')['message']; ?> <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <span aria-hidden="true">×</span> </button>').show();

            <?php } ?>

            $('#month').change(function(){
                getAbsents();
            });

            $('#year').change(function(){
                getAbsents();
            });

            function getAbsents(){

                $.get('<?php echo site_url("attendance/absents/getDtls"); ?>', {
                    month: $('#month').val(),
                    year:  $('#year').val()
                }).done(function(data){
                    $('table').dataTable().fnDestroy();
                    $('tbody').html(data);
                    
                    $('table').DataTable({
                        "paging": false
                    });
                })

            }

        });

    </script>
