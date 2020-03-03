<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('/assets/images/logo1.png'); ?>">
    <title>Login</title>
    
    <link href="<?php echo base_url('/assets/plugins/bootstrap/css/bootstrap.min.css'); ?>" rel="stylesheet">
    
    <link href="<?php echo base_url('/css/style.css'); ?>" rel="stylesheet">
    
</head>

	<body>
		
		
		
		<section id="wrapper" class="login-register login-sidebar" style="background-image:url(<?php echo site_url('/assets/images/background/logLogo.jpg'); ?>);">
			<div class="login-box card">
				<div class="card-body">
				<a href="http://www.ayurindus.com" target="_blank" class="text-center db"><img src="<?php echo base_url('/assets/images/logo1.png'); ?>" alt="Logo" height="45px" /><br/><img src="<?php echo base_url('/assets/images/logo2.png'); ?>" alt="Home" height="30px" /></a>
					<form class="form-horizontal form-material" id="loginform" action="<?php echo site_url('auths'); ?>" method="POST">
						
						<div class="form-group m-t-40">
							<div class="col-xs-12">
								<input class="form-control" type="text" name="user_id" id="user_id" required="" placeholder="Username" />
							</div>
						</div>
						<div class="form-group">
							<div class="col-xs-12">
								<input class="form-control" type="password" name="password" required="" placeholder="Password">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12 col-xs-12">
								<div class="alert alert-<?php echo $this->session->flashdata('msg')['status']; ?>" style="text-align: center;"></div>
							</div>
							<div class="form-group text-center m-t-20">
								<div class="col-xs-12">
									<button class="btn btn-info btn-lg btn-block text-uppercase waves-effect waves-light" type="submit" style="height: 50px;">Log In</button>
								</div>
							</div>

						</div>
							
					</form>
					
				</div>
				<div style="text-align: center;">
					<p>POWERED BY: <a href="http://www.synergicsoftek.in" style="text-decoration: none; color: black;" target="_blank">Synergic Softek Solutions Pvt. Ltd.</a></p>
				</div>
			</div>
		</section>
		
		<script src="<?php echo base_url('/assets/plugins/jquery/jquery.min.js'); ?>"></script>
		<script src="<?php echo base_url('/js/custom.min.js'); ?>"></script>
		<script>
   
			$(document).ready(function() {

				$('.alert').hide();

				<?php if($this->session->flashdata('msg')['message']){ ?>

					$('.alert').html('<?php echo $this->session->flashdata('msg')['message']; ?>').show();

				<?php } ?>

				$("#user_id").on('change',function(){

					var userId = $("#user_id").val();

					
					$.get("<?php echo site_url('Auths/chkAsn'); ?>",{user:userId},function(data){

						if(data==0){
							$("#user_id").val("");
							alert('HOD not yet assigned.Cannot Log In')
							return false;
						}else{
							return true;
						}

					});
				});

			});
			
		</script>
	</body>

</html>






