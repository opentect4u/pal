<div class="modal-header">
    
    <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?></h4> 

    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>  

</div>

    <form class="form-horizontal form-material" 
        id="form"
        method="post" 
        action="<?php echo site_url('department/'.$url.'');?>"
        >
        
        <div class="modal-body">

            <div class="form-group">

                <div class="col-md-12 m-b-20">

                    <input type="<?php echo $type; ?>" 
                        class="form-control" 
                        name="sl_no"
                        placeholder="Department Code"
                        value="<?php echo $data->sl_no; ?>"
                        required
                        /> 
                    
                </div>

                <div class="col-md-12 m-b-20">
                    
                    <input type="text" 
                        class="form-control" 
                        name="dept_name"
                        placeholder="Name"
                        value="<?php echo $data->dept_name; ?>"
                        required
                        />

                </div>

            </div>  

        </div>

        <div class="modal-footer">
            <button type="submit" class="btn btn-info waves-effect" >Save</button>
            <button type="button" class="btn btn-default waves-effect" data-dismiss="modal">Cancel</button>
        </div>

    </form>
        