<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> ALL PRODUCT</h3>
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
                            <button type="button" class="btn btn-default" onclick="return all_product_search()"><i class="icofont icofont-search"></i></button>
                        </div>
                    </div>
            </form>
        </div>

        <div class="panel panel-default">
            <div class="panel-body" id="all_product_search">
                
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Product Code</th>
                                <th>Buy Price</th>
                                <th>Sell Price</th>
                                <th>Quantity</th>
                                <th>Added Date</th>
                                <th>Overseas</th>
                                <th>View</th>
                                <th>Edit</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (is_array($results)){ 
                        foreach ($results as $cous_data) {
                            $id = $cous_data->pid;
                            $name = $cous_data->name;
                            $product_code = $cous_data->product_code;

                            $price = $cous_data->price;
                            $quantity = $cous_data->quantity;
                            $sell_price = $cous_data->sell_price;
                            $opening_stock = $cous_data->opening_stock;
                            $opening_balance = $cous_data->total_price;

                            $added_date = $cous_data->add_date;
                        ?>
                            <tr>
                                <td>#<?php echo $id; ?></td>
                                <td><?php echo $name; ?></td>
                                <td><?php echo $product_code; ?></td>
                                <td><strong><?php echo $price; ?></strong> Tk.</td>
                                <td><strong><?php echo $sell_price; ?></strong> Tk.</td>
                                <td><b><?php echo $quantity; ?></b></td>
                                <td><?php echo $added_date; ?></td>                                
                                <td>
                                    <a href="<?php echo base_url() ?>home/overseas_product/<?php echo $id ?>" target="_blank"  class="btn btn-sm btn-info"><i class="icofont icofont-bow"></i></a>
                                </td>
                                <td>
                                    <a href="<?php echo base_url() ?>home/details_product/<?php echo $id ?>" target="_blank"  class="btn btn-sm btn-success"><i class="icofont icofont-plus"></i></a>
                                </td>
                                <td>
                                    <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_lg" value="<?php echo $id; ?>" onclick="return update_product(this)"><i class="icofont icofont-ui-edit"></i></button>
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