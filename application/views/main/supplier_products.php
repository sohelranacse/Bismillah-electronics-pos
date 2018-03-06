<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> CUSTOMER SALE REPORT</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">


        <div class="panel panel-default">
            <div class="panel-body">
                <?php
                    $this->db->where("cmrid",$cmrid);
                    $query = $this->db->get("supplier");
                    if ($query->num_rows()>0) {
                        $values = $query->row();
                    
                ?>
                <div class="text-center">
                    <h4 style="padding-bottom: 7px;border-bottom: 2px solid #222;display: inline-block;margin-bottom: 15px;margin-top: 0"> <?php echo $values->name.' - '.$values->cmrid; ?></h4>
                </div>
                <?php } ?>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Invoice No.</th>
                                <th>Total Product</th>
                                <th>Gross Amount</th>
                                <th>Discount</th>
                                <th>Cash</th>
                                <th>Loan</th>
                                <th>Sale Date</th>
                                <th>Invoice Create</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (is_array($results)){ 
                        foreach ($results as $value) {
                            $sell_date = $value->sell_date;
                            $sell_invoice = $value->sell_invoice;
                        ?>
                            <tr>
                                <td>#<?php echo $sell_invoice; ?></td>
                                <td><?php
                                    $this->db->where("invoice_id",$sell_invoice);
                                    $query_sale = $this->db->get("sale_product");
                                    $row_count = $query_sale->num_rows();
                                ?>
                                    <button class="btn btn-default btn-sm" disabled><?php echo $row_count; ?></button>
                                    <a href="<?php echo base_url() ?>home/sale_product_own/<?php echo $sell_invoice; ?>" target="_blank" class="btn btn-default btn-sm">View</a>
                                </td>
                                <td><?php echo number_format(round($value->gross_amount ,0), 2, '.', ',') ?> Tk.</td>
                                <td><?php echo $value->discount; ?></td>
                                <td><?php echo number_format(round($value->cash ,0), 2, '.', ',') ?> Tk.</td>
                                <td><?php echo number_format(round($value->due ,0), 2, '.', ',') ?> Tk.</td>
                                <td><?php echo $sell_date; ?></td>
                                <td><?php echo $value->created_by; ?></td>
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