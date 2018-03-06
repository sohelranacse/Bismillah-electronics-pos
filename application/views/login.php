<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin Login</title>

    <!-- Google fonts - witch you want to use - (rest you can just remove) -->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans:300,300italic,400,400italic,600,600italic,700,700italic,800,800italic' rel='stylesheet' type='text/css'>


    <!-- Bootstrap Core CSS -->
    <link href="<?php echo base_url() ?>assest/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?php echo base_url() ?>assest/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="<?php echo base_url() ?>assest/dist/css/icofont.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url() ?>assest/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet"> 


    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assest/style.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>

<body>

    <section class="signin-area">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="signin-logo">
                            <img src="<?php echo base_url() ?>assest/img/logo_250x60.png">
                        </div>

                        <form class="form-signin" method="post" action="" autocomplete="off">
                            <span class="meg_alert">
                            <?php 
                                if(isset($_SESSION)) {
                                    echo $this->session->flashdata('flash_data');
                                } 
                            ?></span>
                            <div class="login-wrap">
                                <div class="user-login-info">
                                    <input type="text" class="form-control" placeholder="Username" name="username" autofocus="" required="1">
                                    <input type="password" class="form-control" placeholder="Password" name="password" required="1">
                                </div>
                           
                               <button class="btn btn-lg btn-login btn-block" type="submit">Log in <i class="icofont icofont-login"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>

    <!-- jQuery -->
    <script src="<?php echo base_url() ?>assest/bower_components/jquery/dist/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>assest/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="<?php echo base_url() ?>assest/dist/js/sb-admin-2.js"></script>

</body>

</html>
