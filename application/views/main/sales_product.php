<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> SALE PRODUCT REPORT</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">


        <div class="panel panel-default">
            <div class="panel-body">
                <?php
                    $this->db->where("pid",$pid);
                    $query = $this->db->get("sale_product");
                    if ($query->num_rows()>0) {
                        $values = $query->row();
                    
                ?>
                <div class="text-center">
                    <h4 style="padding-bottom: 7px;border-bottom: 2px solid #222;display: inline-block;margin-bottom: 15px;margin-top: 0"> <?php echo $values->pname.' - '.$values->pid; ?></h4>
                </div>
                <?php } ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Invoice No.</th>
                                <th>Customer Name</th>
                                <th>Mobile Phone</th>
                                <th>Email</th>
                                <th>Quantity</th>
                                <th>Price</th>
                                <th>Total</th>
                                <th>Added Date</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (is_array($results)){ 
                        foreach ($results as $value) {
                            $a_date = $value->added_date;
                            $create_date = date_create($a_date);
                            $added_date = date_format($create_date, 'd-m-Y');

                            $invoice_id = $value->invoice_id;
                            $pid = $value->pid;

                            $this->db->where("sell_invoice",$invoice_id);
                            $query_sale = $this->db->get("sale");
                            $query_values = $query_sale->row();
                            $cmrid = $query_values->cmrid;

                            $this->db->where("cmrid",$cmrid);
                            $query_cous = $this->db->get("coustomer");
                            $query_values_cus = $query_cous->row();
                            $name = $query_values_cus->name;
                            $email = $query_values_cus->email;
                            $mobile = $query_values_cus->mobile_phone;
                        ?>
                            <tr>
                                <td>#<?php echo $invoice_id; ?></td>

                                <td><?php echo $name; ?></td>
                                <td><?php echo $email; ?></td>
                                <td><?php echo $mobile; ?></td>

                                <td><?php echo $value->qty; ?></td>
                                <td><?php echo $value->price; ?></td>
                                <td><?php echo $value->gross_amount; ?></td>
                                <td><?php echo $added_date; ?></td>
                            </tr>
                        <?php }} ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </div>


    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->