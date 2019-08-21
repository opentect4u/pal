<div class="modal-header">
    
    <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4> 

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>  

</div>

    <form class="form-horizontal form-material" 
        id="form"
        method="post" 
        action="<?php echo site_url('employees/assign/operation');?>"
        >
        
        <input type="hidden"
               name="manage_by"
               value="<?php echo $this->input->get('manage_by'); ?>"
            />
        <div class="modal-body">

            <div class="form-group">

                <div class="col-md-12 m-b-20">
                    
                    <table id="demo-foo-addrow" class="table m-t-30 table-hover contact-list" data-page-size="10">

                        <thead>

                            <tr>
                            
                                <th>Employees</th>
                                <th style="text-align: right;">
                                    <button type="button" id="addrow" class="btn btn-info btn-rounded" >Add New</button>
                                </th>
                                
                            </tr>

                        </thead>

                        <tbody id="intro"> 

                            <?php 
                            
                            if($manage_dtls) {
                                
                                    foreach($manage_dtls as $manage_by) {

                            ?>

                                <tr>
                                
                                    <td style="display: none;">
                                        
                                        <input type="hidden" name='managed_emp[]' value="<?php echo $manage_by->managed_emp;?>" />
                                                
                                    </td>
                                    <td>
                                        
                                        <p><?php echo $manage_by->emp_name.' ('.$manage_by->department.')';?></p>
                                                
                                    </td>
                                    
                                    <td>
                                        
                                        <a href="javascript:void(0)" id="removeRow" title="Remove Employee" style="margin-left: 30px; color: #2f3d4a;">
                                        
                                            <i class="mdi mdi-table-row-remove" aria-hidden="true"></i>
                                            
                                        </a>
                                    
                                    </td>
                                    
                                </tr>

                            <?php
                                    
                                    }

                                }

                                else {

                                    echo "<tr id='void'><td style='text-align: center;'>No data Found</td></tr>";

                                }
                            ?>

                        </tbody>

                    </table>

                </div>        

            </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-info waves-effect" >Save</button>
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
        </div>

    </form>
            
<script>
    
    $(document).ready(function(){
     
        
        $("#addrow").click(function(){

            $('#intro').prepend("<tr><td><select class='form-control preferenceSelect' name='managed_emp[]' style='width: 275px;'><option>Select</option><?php foreach ($emp_dtls as $list):?><option value='<?php echo $list->emp_code;?>'><?php echo $list->emp_name.' ('.$list->department.')';?></option><?php endforeach;?></select></td><td><a href='javascript:void(0)' id='removeRow' title='Remove Employee' style='margin-left: 30px; color: #2f3d4a;'><i class='mdi mdi-table-row-remove' aria-hidden='true'></i></a></td></tr>");
            $('.preferenceSelect').change();
            $('#void').hide();

        });

        $("#intro").on('click','#removeRow',function(){
            $(this).parent().parent().remove();
            $('.preferenceSelect').change();
        });

        $("#intro").on("change", ".preferenceSelect", function(){
            
            $('.preferenceSelect').each(function(){
                
                $('.preferenceSelect').find('option[value ="' + this.value + '"]').toggle(false);
    
            });

        });    
       
    });

</script>