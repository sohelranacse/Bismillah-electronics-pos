<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> DAILY INVOICE REPORTS</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="date_search">            
            <form action="" method="POST" class="form-horizontal" role="form">                           
                    
                    <div class="form-group" style="margin: 0;overflow: hidden;">
                        <div class="col-sm-2 text-right">
                            <label for="name">From Date : </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i>
                                </span>
                                <input type="text" id="from_date" class="form-control" value="<?php echo date("Y-m-01") ?>">
                            </div>
                        </div>
                        <div class="col-sm-1 text-right">
                            <label for="name">Today : </label>
                        </div>
                        <div class="col-sm-2">
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i>
                                </span>
                                <input type="text" id="to_date" class="form-control" value="<?php echo date("Y-m-d") ?>">
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <button type="button" class="btn btn-default" onclick="return invoice_report_search()"><i class="icofont icofont-search"></i></button>
                        </div>
                    </div>
            </form>
        </div>
        <div class="panel panel-default">
            <div class="panel-body" id="invoice_report_search">

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr class="success">
                                <th>Invoice No</th>
                                <th>Invoice Type</th>
                                <th>Invoice Date</th>
                                <th>Name</th>
                                <th>Sale Date</th>
                                <th>Print</th>
                                <th>SMS</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        if (is_array($results)){
                            foreach ($results as $invoice_data) {
                                $id = $invoice_data->id;
                                $sell_invoice = $invoice_data->sell_invoice;
                                $sell_date = $invoice_data->sell_date;
                                $cmrid = $invoice_data->cmrid;


                                $roots = $invoice_data->roots;
                                if ($roots==1) {
                                    $in_type = 'Sale';

                                    $this->db->where('cmrid',$cmrid);
                                    $query = $this->db->get("coustomer");
                                    $row = $query->row();
                                    $rowcount = $query->num_rows();
                                    if ($rowcount = $query->num_rows()) {
                                       $cous_name = $row->name;
                                    }else{
                                        $cous_name = '';
                                    }
                                }else{
                                    $in_type = 'Purchase';

                                    $this->db->where('cmrid',$cmrid);
                                    $query = $this->db->get("Supplier");
                                    $row = $query->row();
                                    $rowcount = $query->num_rows();
                                    if ($rowcount = $query->num_rows()) {
                                       $cous_name = $row->name;
                                    }else{
                                        $cous_name = '';
                                    }
                                }

                                //$pid = $invoice_data->pid;
                                //$price = $invoice_data->price;

                                $gross_amount = $invoice_data->gross_amount;
                                $due = $invoice_data->due;
                                $created_by = $invoice_data->created_by;

                                $a_date = $invoice_data->added_date;
                                $create_date = date_create($a_date);
                                $added_date = date_format($create_date, 'd-m-Y');

                                if (!empty($sell_invoice) || !empty($gross_amount)|| !empty($due)|| !empty($created_by)) {
                            ?>
                            <tr>
                                <td>#<?php echo $sell_invoice; ?></td>
                                <td><?php echo $in_type; ?></td>
                                <td><?php echo $sell_date; ?></td>
                                <td><?php echo $cous_name.' * '.$cmrid; ?></td>
                                <td><?php echo $sell_date; ?></td>
                                <td>
                                <?php 
                                    if (empty($gross_amount)) {
                                        echo '<button class="btn btn-warning btn-sm" disabled><i class="icofont icofont-ui-close"></i></button>';
                                    }else{
                                ?>
                                    <a href="<?php echo base_url(); ?>home/daily_invoice_reports_print/<?php echo $sell_invoice.'/'.$cmrid; ?>" target="_blank" class="btn btn-sm btn-info"><i class="icofont icofont-print"></i></a>
                                <?php } ?>
                                </td>
                                <td><?php 
                                if ($roots == 1) { 
                                    $this->db->where('invoice_id',$sell_invoice);
                                    $this->db->where('cmrid',$cmrid);
                                    $rowsmsCount=$this->db->get("sms");
                                    $rowcountsms = $rowsmsCount->num_rows();

                                    if ($rowcountsms) { ?>
                                        <button class="btn btn-sm btn-default" disabled><i class="icofont icofont-ui-check"></i></button>
                                    <?php }else{ ?>                                                                            
                                        <button class="btn btn-sm btn-primary" value="<?php echo $sell_invoice.'/'.$cmrid; ?>" onclick="send_sms_coustomer(this);" data-toggle="modal" data-target="#send_sms_coustomer">
                                            <i class="icofont icofont-ui-message"></i>
                                        </button>
                                    <?php }} ?>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-danger" value="<?php echo $roots.':'.$sell_invoice; ?>" onclick="return delete_invoice(this)"><i class="icofont icofont-ui-close"></i></button>
                                </td>
                            </tr>
                            <?php }}} ?>
                        </tbody>
                    </table>
                </div>
                <?php echo $links; ?>
            </div>
        </div>


    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<!-- /#send_sms_coustomer modal -->
<div class="modal fade" id="send_sms_coustomer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="icofont icofont-ui-close"></i></button>
                <h4 class="modal-title">Send SMS</h4>
            </div>
            <div class="modal-body" id="send_sms_coustomer_output">
                
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
  <script>
  $( function() {
    $( "#from_date" ).datepicker({dateFormat : 'yy-mm-dd'});
    $( "#to_date" ).datepicker({dateFormat : 'yy-mm-dd'});
  } );
  </script>