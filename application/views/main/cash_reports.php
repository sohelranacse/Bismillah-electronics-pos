<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> CASH REPORTS</h3>
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
                            <button type="button" class="btn btn-default" onclick="return cash_reports_search()"><i class="icofont icofont-search"></i></button>
                        </div>
                    </div>
            </form>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>CASH #ID</th>
                                <th>Cash Type</th>
                                <th>Amount</th>
                                <th>Date</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody id="cash_reports_search">
                        <?php
                        if (is_array($results)){ 
                        foreach ($results as $cous_data) {
                            $id = $cous_data->id;
                            $cash_id = $cous_data->cash_id;
                            $roots = $cous_data->roots;
                            if ($roots==1) {
                                $type = 'Cash Receive';
                            }else if ($roots==2) {
                                $type = 'Cash Payment';
                            }
                            $amount = $cous_data->amount;

                            $added_date = $cous_data->dated;
                        ?>
                            <tr>
                                <td>#<?php echo $cash_id; ?></td>
                                <td><?php echo $type; ?></td>
                                <td><b><?php echo number_format(round($amount ,0), 2, '.', ','); ?> Tk.</b></td>
                                <td><?php echo $added_date; ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>home/details_cash_reports/<?php echo $id ?>/<?php echo $roots; ?>" target="_blank" class="btn btn-sm btn-default"><i class="icofont icofont-plus"></i> Details</a>
                                </td>
                            </tr>
                        <?php }} ?>
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

  <script>
  $( function() {
    $( "#from_date" ).datepicker({dateFormat : 'yy-mm-dd'});
    $( "#to_date" ).datepicker({dateFormat : 'yy-mm-dd'});
  } );
  </script>