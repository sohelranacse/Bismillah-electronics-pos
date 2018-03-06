 <?php 
    $this->db->where("pid",$id);
    $query = $this->db->get("product");
    $value = $query->row();

    ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $value->name.'-'.$value->product_code; ?> |  Bismillah Electric Co. Ltd.</title>
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
        		<div class="panel panel-default" style="border: none;background: #eee;">
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
                            <h4 style="padding-bottom: 7px;border-bottom: 2px solid #222;display: inline-block;margin-bottom: 15px;margin-top: 0"> <?php echo $value->name.' - '.$value->product_code; ?></h4>
                        </div>

                        <div class="col-md-12 col-lg-12 col-sm-12 printTable">
                            <table width="100%" border="1">
                                <thead>
                                    <th width="25%">Overseas Name</th>
                                    <th width="25%">Dated</th>
                                    <th width="25%">Debit</th>
                                    <th width="25%">Credit</th>
                                </thead>
                                <tbody>
                                <?php 
                                    $this->db->where("pid",$id);
                                    $query_over = $this->db->get("over_seas");
                                    if ($query_over->num_rows()>0) {
                                        $sum = 0;
                                        $sum2 = 0;
                                        foreach ($query_over->result_array() as $k_valeu) {
                                            if ($k_valeu['over_record_roots']==1) {
                                                $sum = $sum+$k_valeu['amount'];
                                ?>

                                    <tr>
                                        <td><?php echo $k_valeu['over_record_name']; ?></td>
                                        <td><?php echo $k_valeu['dated']; ?></td>
                                        <td><?php echo number_format(round($k_valeu['amount'] ,0), 2, '.', ',') ?>Tk. </td>
                                        <td></td>
                                    </tr>
                                <?php }
                                        else if ($k_valeu['over_record_roots']==2) {
                                                $sum2 = $sum2+$k_valeu['amount'];
                                    ?>
                                    <tr>
                                        <td><?php echo $k_valeu['over_record_name']; ?></td>
                                        <td><?php echo $k_valeu['dated']; ?></td>
                                        <td></td>
                                        <td><?php echo number_format(round($k_valeu['amount'] ,0), 2, '.', ',') ?>Tk. </td>
                                    </tr>
                                <?php }}} ?>
                                    <tr>
                                        <td colspan="2"><b>Total</b></td>
                                        <td><b><?php echo number_format(round($sum ,0), 2, '.', ',') ?> Tk.</b></td>
                                        <td><b><?php echo number_format(round($sum2 ,0), 2, '.', ',') ?> Tk.</b></td>
                                    </tr>

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