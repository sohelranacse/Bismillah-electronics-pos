<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> STOCK SUMMARY</h3>
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
                            <button type="button" class="btn btn-default" onclick="return stock_summary_search()"><i class="icofont icofont-search"></i></button>
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
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Product Code</th>
                                <th>Added Date</th>
                                <th>Details</th>
                                <th>Purchase Report</th>
                                <th>Sales Report</th>
                            </tr>
                        </thead>
                        <tbody id="stock_summary_search">
                        <?php
                        if (is_array($results)){ 
                        foreach ($results as $cous_data) {
                            $id = $cous_data->pid;
                            $name = $cous_data->name;
                            $product_code = $cous_data->product_code;
                        ?>
                            <tr>
                                <td>#<?php echo $id; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $product_code; ?></td>
                                <td><?php echo $cous_data->add_date; ?></td>
                                <td>
                                    <a href="<?php echo base_url() ?>home/details_product/<?php echo $id ?>" target="_blank" class="btn btn-sm btn-default"><i class="icofont icofont-plus"></i> Details</a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url() ?>home/purchase_product/<?php echo $id ?>" target="_blank" class="btn btn-sm btn-info"><i class="icofont icofont-plus"></i> Purchase</a>
                                </td>
                                <td>
                                    <a  href="<?php echo base_url() ?>home/sales_product/<?php echo $id ?>" target="_blank" target="_blank" class="btn btn-sm btn-success"><i class="icofont icofont-plus"></i> Sales</a>
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