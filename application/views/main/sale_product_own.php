<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Product id : <?php echo $invoice_id; ?></title>
	<link href="<?php echo base_url() ?>assest/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assest/style.css">
    <link href="<?php echo base_url() ?>assest/dist/css/icofont.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url() ?>assest/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<style>
		.printTable>table>tbody>tr>th,.printTable>table>tbody>tr>td{text-align: center;padding: 5px 0;}
        th{text-align: center;}
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
                        
                        <div class="col-md-12 col-lg-12 col-sm-12 text-center" style="margin-bottom: 40px;">
                            <?php 
                            $this->db->where("id",1);
                            $query_company = $this->db->get("company");
                            $company = $query_company->row();
                            ?>
                            <h3 style="margin-top: 0"><?php echo $company->name; ?></h3>
                            <p>Phone : <?php echo $company->phone; ?></p>
                            <p><?php echo $company->address; ?></p>
                        </div>

                        <div class="col-md-12 col-lg-12 col-sm-12 printTable">
                            <table width="100%" border="1">
                                <thead>
                                    <tr>
                                        <th>Invoice Id</th>
                                        <th>Product Name</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Total Amount</th>
                                        <th>Added Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                $this->db->where("invoice_id",$invoice_id);
                                $query = $this->db->get("sale_product");
                                foreach ($query->result_array() as $value) {
                                ?>
                                    <tr>
                                        <td>#<?php echo $invoice_id; ?></td>
                                        <td><?php echo $value['pname']; ?></td>
                                        <td><?php echo $value['qty']; ?></td>
                                        <td><?php echo number_format(round($value['price'] ,0), 2, '.', ',') ?> Tk.</td>
                                        <td><?php echo number_format(round($value['gross_amount'] ,0), 2, '.', ',') ?> Tk.</td>
                                        <td><?php echo $value['added_date']; ?></td>
                                    </tr>
                                <?php } ?>

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