<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Date : <?php echo $dated; ?> | Daily Expense Reports Bismillah Electric Co. Ltd.</title>
	<link href="<?php echo base_url() ?>assest/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assest/style.css">
    <link href="<?php echo base_url() ?>assest/dist/css/icofont.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url() ?>assest/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<style>
		.printTable>table>thead>tr>th,.printTable>table>tbody>tr>td{text-align: center;padding: 5px 0;}
	</style>
	<script src="<?php echo base_url() ?>assest/bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body>
<div id="page-wrapper" class="container" style="margin-top: 30px;font-family: play;">
    <div class="row">
        <div class="col-sm-12">    
            <!-- /.row -->
            <div class="row">
        		<div class="panel panel-default" style="border: none;background: #eee">
                    <div class="panel-body">
                        
                        <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                            <?php 
                            $this->db->where("id",1);
                            $query_company = $this->db->get("company");
                            $company = $query_company->row();
                            ?>
                            <h3 style="margin-top: 0"><?php echo $company->name; ?></h3>
                            <p>Phone : <?php echo $company->phone; ?></p>
                            <p><?php echo $company->address; ?></p>
                    
                            <h4 style="padding-bottom: 7px;border-bottom: 2px solid #222;display: inline-block;margin-bottom: 15px;margin-top: 0"> Date : <?php echo $dated ?></h4>
                        </div>

                        <div class="col-md-12 col-lg-12 col-sm-12 printTable">
                            <table width="100%" border="1">
                            <?php 
                                $this->db->where("dated",$dated);
                                $query = $this->db->get("daily_expense");
                                if ($query->num_rows()>0) {                                    
                            ?>
                                <thead>
                                    <tr>
                                        <th>SL</th>
                                        <th>Title</th>
                                        <th>Purpose</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                    $i=1;
                                    $sum=0;
                                    foreach ($query->result_array() as $value) {
                                        $sum = $sum+$value['amount'];
                                ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $value['name']; ?></td>
                                        <td><?php echo $value['purpose']; ?></td>
                                        <td><?php echo number_format(round($value['amount'] ,0), 2, '.', ',') ?> Tk.</td>
                                    </tr>
                                <?php } ?>
                                    <tr>
                                        <td colspan="3"><b>Total</b></td>
                                        <td><b><?php echo number_format(round($sum ,0), 2, '.', ',') ?> Tk.</b></td>
                                    </tr>
                            <?php }else{
                                    echo "No Data Found";
                                    } ?>

                                </tbody>
                            </table>
                        </div>

                        <div class="" style="font-weight: bold;margin-top: 20px;">
                            <div class="col-md-3 col-lg-3 col-sm-3"></div>
                            <div class="col-sm-offset-6 col-md-offset-6 col-lg-offset-6 col-md-3 col-sm-3 col-lg-3 text-right" style="margin-top: 50px">
                                <p style="border-top: 2px solid #333;">Authorise Signature</p>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

	<script src="<?php echo base_url() ?>assest/dist/js/jquery-ui.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo base_url() ?>assest/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</body>
</html>