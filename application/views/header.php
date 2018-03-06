<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Bismillah Electric Co. Ltd">
    <meta name="Md. Sohel Rana" content="Briliant Software Engineer">
    <link rel="shortcut icon" href="<?php echo base_url() ?>assest/img/favicon.png" type="image/x-icon" />

    <title><?php echo $title; ?> :: Bismillah Electric Co. Ltd.</title>

    <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>assest/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assest/style.css">

    <!-- MetisMenu CSS -->
    <link href="<?php echo base_url() ?>assest/bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?php echo base_url() ?>assest/dist/css/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assest/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assest/dist/css/jquery-ui.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assest/dist/css/icofont.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url() ?>assest/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="http://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js"></script>
    
    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assest/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>
	<div id="overlay">
        <div class="spinner"></div>
    </div>
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-fixed-top" role="navigation" style="margin-bottom: 0;background:#222;border: none">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand admin-logo" href="<?php echo base_url() ?>home/index"><img src="<?php echo base_url() ?>assest/img/logo_250x60.png"></a>
                <strong class="hidden-xs" style="color: #fff;display: inline-block; margin-top: 14px; font-size: 17px;">
                <?php 
					$userRole = $userId = $this->session->userdata('role');
					if ($userRole==1) {
						echo 'SUPER ADMIN';
					}else{
						echo 'USER';
					}
				?>
						
				</strong>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <?php echo $this->session->userdata('name') ?> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li>
                        	<a  href="#Profile_admin" data-toggle="modal"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <?php if ($userRole==1) {
                        ?>
                        <li>
                        	<a href="#smsSetting" data-toggle="modal"><i class="fa fa-envelope fa-fw"></i> SMS Settings</a>
                        </li>
                        <?php } ?>
                        <li>
                        	<a onclick="PasswordChange();" href="#Profilechange" data-toggle="modal"><i class="fa fa-gear fa-fw"></i> Password Change</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                        	<a href="<?php echo base_url() ?>home/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
            
            <?php include ('sidebar-nav.php'); ?>

        </nav>
<div class="modal fade" id="smsSetting">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icofont icofont-ui-close"></i></button>
				<h4 class="modal-title">SMS SETTINGS</h4>
			</div>
			<div class="modal-body">
				<form action="" method="POST" role="form">
				<?php
				if ($userRole==1) { 
					$this->db->where('id',1);
					$qeurysms = $this->db->get("sms_setting");
					foreach ($qeurysms->result_array() as $sms_setiing_data) {
						$username = $sms_setiing_data['username'];
						$password = $sms_setiing_data['password'];
						$sender = $sms_setiing_data['sender'];
				?>
					<div class="form-group">
						<label for="">Username : </label>
						<input type="text" class="form-control" id="sett_username" value="<?php echo $username; ?>">
					</div>
					<div class="form-group">
						<label for="">Password : </label>
						<input type="text" class="form-control" id="sett_password" value="<?php echo $password; ?>">
					</div>
					<div class="form-group">
						<label for="">Sender : </label>
						<input type="text" class="form-control" id="sett_sender" value="<?php echo $sender; ?>">
					</div>
					<button type="button" onclick="updated_sms_settings()" class="btn btn-success">UPDATE</button>
				</form>
				<?php }} ?>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="Profilechange">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icofont icofont-ui-close"></i></button>
				<h4 class="modal-title">Change Password</h4>
			</div>
			<div class="modal-body" id="PasswordChange1">
				
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="Profile_admin">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icofont icofont-ui-close"></i></button>
				<h4 class="modal-title">User Profile</h4>
			</div>
			<div class="modal-body">
			<?php
				$this->db->where('id', $this->session->userdata('id'));
				$queryuser = $this->db->get('users');
				$rows = $queryuser->row();
				$userid = $rows->id;
				$username = $rows->username;
				$useremail = $rows->email;
				$userFname = $rows->name;
				$userrole = $rows->role;
				if ($userrole==1) {
					$showrole = 'Admin';
				}else{
					$showrole = 'User';
				}
			?>
			
				<div role="tabpanel">
					<!-- Nav tabs -->
					<ul class="nav nav-tabs" role="tablist">
						<li role="presentation" class="active">
							<a href="#Profileshow" aria-controls="home" role="tab" data-toggle="tab">Profile</a>
						</li>
						<li role="presentation">
							<a href="#updateProfiletabs" aria-controls="tab" role="tab" data-toggle="tab">Update Profile</a>
						</li>
					</ul>
				
					<!-- Tab panes -->
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="Profileshow">
							<div class="well text-center">
								<i class="icofont icofont-user usericon" style="font-size: 70px;color: #26B2AA"></i>
								<h2><?php echo $userFname; ?></h2>
								<div class="table-responsive">
									<table class="table table-bordered table-striped">
										<tbody>
											<tr>
												<th width="50%">username : </th>
												<td class="text-right"><?php echo $username; ?></td>
											</tr>
											<tr>
												<th>Email : </th>
												<td class="text-right"><?php echo $useremail; ?></td>
											</tr>
											<tr>
												<th>Role : </th>
												<td class="text-right"><?php echo $showrole; ?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
						<div role="tabpanel" class="tab-pane" id="updateProfiletabs">
							
					
								<div class="form-group">
									<label for="">Username</label>
									<input type="hidden" id="pro_id" value="<?php echo $this->session->userdata('id'); ?>">
									<input type="text" class="form-control" id="pro_username" value="<?php echo $username; ?>">
								</div>
								<div class="form-group">
									<label for="">Email</label>
									<input type="text" class="form-control" id="pro_email" value="<?php echo $useremail; ?>">
								</div>
								<div class="form-group">
									<label for="">Name</label>
									<input type="text" class="form-control" id="pro_name" value="<?php echo $userFname; ?>" required>
								</div>
							
								<button type="button" onclick="updateprofile()" class="btn btn-info">UPDATE</button>

						</div>
					</div>
				</div>

					
			</div>
			<div class="modal-footer">
				<button class="btn btn-default" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>
