                </div>
                
                <footer class="footer"> © 2019 Synergic Softek Solutions Pvt. Ltd. </footer>
                
            </div>
            
        </div>
        
        <script src="<?php echo base_url('/assets/plugins/jquery/jquery.min.js'); ?>"></script>
        <!-- Bootstrap tether Core JavaScript -->
        <script src="<?php echo base_url('/assets/plugins/popper/popper.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/plugins/bootstrap/js/bootstrap.min.js'); ?>"></script>
        <!-- slimscrollbar scrollbar JavaScript -->
        <script src="<?php echo base_url('/js/jquery.slimscroll.js'); ?>"></script>
        <!--Wave Effects -->
        <script src="<?php echo base_url('/js/waves.js'); ?>"></script>
        <!--Menu sidebar -->
        <script src="<?php echo base_url('/js/sidebarmenu.js'); ?>"></script>
        <!--stickey kit -->
        <script src="<?php echo base_url('/assets/plugins/sticky-kit-master/dist/sticky-kit.min.js'); ?>"></script>
        <script src="<?php echo base_url('/assets/plugins/sparkline/jquery.sparkline.min.js'); ?>"></script>
        <!--Custom JavaScript -->
        <script src="<?php echo base_url('/js/custom.min.js'); ?>"></script>

        <?php 

            if($script){

                echo "\n";

                foreach($script as $s_list){

                    echo "\t\t";

                    echo '<script src="'.base_url($s_list).'"></script>';

                    echo "\n";

                }
                
            }

            if(isset($cdnscript)){

                echo "\n";

                foreach($cdnscript as $s_list){

                    echo "\t\t";

                    echo '<script src="'.$s_list.'"></script>';

                    echo "\n";

                }
                
            }

        ?>
       
    </body>

</html>