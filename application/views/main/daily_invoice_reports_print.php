<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Invoice No : <?php echo $sell_invoice; ?> | Bismillah Electric Co. Ltd.</title>
	<link href="<?php echo base_url() ?>assest/bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom Style CSS -->
    <link rel="stylesheet" href="<?php echo base_url() ?>assest/style.css">
    <link href="<?php echo base_url() ?>assest/dist/css/icofont.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Play" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo base_url() ?>assest/bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	<style>
		.printTable>table>tbody>tr>th,.printTable>table>tbody>tr>td{text-align: center;padding: 5px 0;}
	</style>
	<script src="<?php echo base_url() ?>assest/bower_components/jquery/dist/jquery.min.js"></script>
</head>
<body>
<div id="page-wrapper" class="container" style="margin-top: 30px;font-family: play;">
    <div class="row">
        <div class="col-lg-12">
    <?php $sell_invoice.$cmrid; ?>
    <!-- /.row -->
    <div class="row">
		<div class="panel panel-default" style="border: none;background: #eee">
            <div class="panel-body">
                <?php
                    $this->db->where('sell_invoice',$sell_invoice);
                    $query = $this->db->get("sale");
                    $row = $query->row();
                    $sell_date = $row->sell_date;

                    $gross_amount = $row->gross_amount;

                    $discount = $row->discount;
                    $cash = $row->cash;
                    $due = $row->due;
                    $created_by = $row->created_by;


                    $roots = $row->roots;
                    if ($roots==1) {
                        $in_type = 'Sale';

                        $this->db->where('cmrid',$cmrid);
                        $query = $this->db->get("coustomer");
                        $row2 = $query->row();

                        $cous_name = $row2->name;                        
                        $total_due = $row2->due;
                    }else{
                        $in_type = 'Purchase';

                        $this->db->where('cmrid',$cmrid);
                        $query = $this->db->get("Supplier");
                        $row3 = $query->row();
                        $rowcount = $query->num_rows();
                        if ($rowcount = $query->num_rows()) {

                           $cous_name = $row3->name;
                           $total_due = $row3->loan;
                        }
                    }

                    
                ?>
            	<div class="col-md-12 col-lg-12 col-sm-12 text-center">
            		<?php 
                    $this->db->where("id",1);
                    $query_company = $this->db->get("company");
                    $company = $query_company->row();
                    ?>
                    <h3 style="margin-top: 0"><?php echo $company->name; ?></h3>
                    <p>Phone : <?php echo $company->phone; ?></p>
                    <p><?php echo $company->address; ?></p>
                    
            		<h4 style="padding-bottom: 7px;border-bottom: 2px solid #222;display: inline-block;margin-bottom: 15px;margin-top: 0"><?php echo $in_type; ?> Report</h4>
            	</div>
				<div class="invoice_date">
					<div class="col-md-6 col-lg-6 col-sm-6">
						<p>Invoice No. : #<?php echo $sell_invoice; ?></p>
						<p><?php if ($roots==1) { echo 'Coustomer'; }else{ echo 'Supplier';} ?> : <?php echo $cous_name; ?></p>
					</div>
					<div class="col-md-6 col-lg-6 col-sm-6 text-right">
						<p>Date : <?php echo $sell_date; ?></p>
						<p>Surved By : <?php echo $created_by; ?></p>
					</div>

				</div>
				<div class="col-md-12 col-lg-12 col-sm-12 printTable">
            		<table width="100%" border="1">
            			<tbody>
	            			<tr>
	            				<th>Product Code</th>
	            				<th>Product Name</th>
	            				<th>Qty</th>
	            				<th>Price</th>
	            				<th>Total Price</th>
	            			</tr>
	            			<?php 

                            $this->db->where('invoice_id',$sell_invoice);
                            $query_product = $this->db->get("sale_product");
                            $row_products = $query_product->row();
                            $pid = $row_products->invoice_id;

                            $sum = 0;
                            $this->db->where('invoice_id',$sell_invoice);
                            $query_products = $this->db->get("sale_product");
                            foreach ($query_products->result_array() as $product_all) {

                            $pid = $product_all['pid'];
                            $pname = $product_all['pname']; 
                            $qty = $product_all['qty']; 
                            $price = $product_all['price']; 
                            $gross_amount_p_sale = $product_all['gross_amount']; 

                            $sum = $sum+$gross_amount_p_sale;

		                    
		                    ?>
		            			<tr>
		            				<td><?php
                                       $this->db->where('pid',$pid);
                                        $product_code = $this->db->get("product");
                                        $product_code_row = $product_code->row();
                                        echo $product_code = $product_code_row->product_code; 
                                    ?></td>
		            				<td><?php echo $pname ?></td>
		            				<td><?php echo $qty ?></td>
		            				<td><?php echo number_format(round($price ,0), 2, '.', ',') ?> Tk.</td>
		            				<td><?php echo number_format(round($gross_amount_p_sale ,0), 2, '.', ',') ?> Tk.</td>
		            			</tr>
                            <?php } ?>
	            			<tr>
	            				<th colspan="4">Net Amount</th>
	            				<th><?php echo number_format(round($sum ,0), 2, '.', ',') ?> Tk.</th>
	            			</tr>
                            
            			</tbody>
            		</table>
            		<strong>(In words) : 
					<?php 
						//$amount = number_format(round($gross_amount ,0), 2, '.', ',').'<hr>';
						try
						{
							echo convert_number($gross_amount);
						}
						catch(Exception $e)
						{
							echo $e->getMessage();
						}
					?>
            		Taka only.</strong>
            	</div>

            	<div class="col-md-offset-6 col-sm-offset-6 col-lg-offset-6 col-md-6 col-lg-6 col-sm-6 printTable" style="margin-bottom: 40px;margin-top: 30px">
            		<table width="100%" border="1">
            			<tbody>
	            			<tr>
	            				<th>Net Payable</th>
	            				<td><?php echo number_format(round($gross_amount ,0), 2, '.', ',') ?> Tk.</td>
	            			</tr>
	            			<tr>
	            				<th>Discount</th>
	            				<td><?php
	            				echo $dbdis = ($gross_amount/100)*$discount.' Tk. ';?>
	            				(<?php echo $discount; ?>%)</td>
	            			</tr>
	            			<tr>
	            				<th>Cash</th>
	            				<td><?php echo number_format(round($cash ,0), 2, '.', ',') ?> Tk.</td>
	            			</tr>
                            <?php 
                            if ($roots==1) { ?>
	            			<tr>
	            				<th>Previous Due</th>
	            				<td><?php $prev_due = $total_due-$due; echo number_format(round($prev_due ,0), 2, '.', ',') ?> Tk.</td>
	            			</tr>
	            			<tr>
	            				<th>Due</th>
	            				<td><?php echo number_format(round($due ,0), 2, '.', ',') ?> Tk.</td>
	            			</tr>
	            			<tr>
	            				<th>Total Due</th>
	            				<td><?php echo number_format(round($total_due ,0), 2, '.', ',') ?> Tk.</td>
	            			</tr>

                            <?php } else{ ?>
                            <tr>
                                <th>Previous Loan</th>
                                <td><?php $prev_due = $total_due-$due; echo number_format(round($prev_due ,0), 2, '.', ',') ?> Tk.</td>
                            </tr>

                            <tr>
                                <th>Loan</th>
                                <td><?php echo number_format(round($due ,0), 2, '.', ',') ?> Tk.</td>
                            </tr>
                            <tr>
                                <th>Total Loan</th>
                                <td><?php echo number_format(round($total_due ,0), 2, '.', ',') ?> Tk.</td>
                            </tr>
                            <?php } ?>
            			</tbody>
            		</table>
            	</div>

            	<div class="invoice_date" style="font-weight: bold;margin-top: 20px;">
                    <div class="col-md-3 col-lg-3 col-sm-3">
                        <p style="border-top: 2px solid #333;"><?php if ($roots==1) { ?>Coustomer<?php }elseif($roots==2){ ?> Supplier <?php } ?>Signature </p>
                    </div>
					<div class="col-sm-offset-6 col-md-offset-6 col-lg-offset-6 col-md-3 col-sm-3 col-lg-3 text-right">
						<p style="border-top: 2px solid #333;">Authorise Signature</p>
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
<?php
function convert_number($number) 
{ 
    if (($number < 0) || ($number > 999999999)) 
    { 
    throw new Exception("Number is out of range");
    } 

    $Gn = floor($number / 100000);  /* Millions (giga) */ 
    $number -= $Gn * 100000; 
    $kn = floor($number / 1000);     /* Thousands (kilo) */ 
    $number -= $kn * 1000; 
    $Hn = floor($number / 100);      /* Hundreds (hecto) */ 
    $number -= $Hn * 100; 
    $Dn = floor($number / 10);       /* Tens (deca) */ 
    $n = $number % 10;               /* Ones */ 

    $res = ""; 

    if ($Gn) 
    { 
        $res .= convert_number($Gn) . " Lac"; 
    } 

    if ($kn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($kn) . " Thousand"; 
    } 

    if ($Hn) 
    { 
        $res .= (empty($res) ? "" : " ") . 
            convert_number($Hn) . " Hundred"; 
    } 

    $ones = array("", "One", "Two", "Three", "Four", "Five", "Six", 
        "Seven", "Eight", "Nine", "Ten", "Eleven", "Twelve", "Thirteen", 
        "Fourteen", "Fifteen", "Sixteen", "Seventeen", "Eightteen", 
        "Nineteen"); 
    $tens = array("", "", "Twenty", "Thirty", "Fourty", "Fifty", "Sixty", 
        "Seventy", "Eigthy", "Ninety"); 

    if ($Dn || $n) 
    { 
        if (!empty($res)) 
        { 
            $res .= " and "; 
        } 

        if ($Dn < 2) 
        { 
            $res .= $ones[$Dn * 10 + $n]; 
        } 
        else 
        { 
            $res .= $tens[$Dn]; 

            if ($n) 
            { 
                $res .= "-" . $ones[$n]; 
            } 
        } 
    } 

    if (empty($res)) 
    { 
        $res = "zero"; 
    } 

    return $res; 
}



?>