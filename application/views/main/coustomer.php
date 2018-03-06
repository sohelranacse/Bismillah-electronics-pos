<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> COUSTOMER</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

        <div class="date_search">            
            <form action="" method="POST" class="form-horizontal" role="form">                           
                    
                <div class="form-group" style="overflow: hidden;margin: 0">
                    <div class="col-sm-offset-4 col-sm-4">
                        <div class="form-group input-group">
                            <span class="input-group-addon"><i class="icofont icofont-user"></i>
                            </span>
                            <input type="text" onkeyup="return search_name_cus(this)" class="form-control" placeholder="Type Customer Name">
                        </div>
                    </div>

                </div>
            </form>
        </div>

        <div class="panel panel-default">
            <div class="panel-body">
                <div role="tabpanel">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                            <a href="#ALL_COUSTOMER" aria-controls="home" role="tab" data-toggle="tab">COUSTOMER</a>
                        </li>
                        <li role="presentation">
                            <a href="#NEW_COUSTOMER" aria-controls="tab" role="tab" data-toggle="tab">NEW COUSTOMER</a>
                        </li>
                    </ul>
                
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane active" id="ALL_COUSTOMER">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>#ID</th>
                                            <th>Name</th>
                                            <th>Company</th>
                                            <th>Mobile</th>
                                            <th>Address</th>
                                            <th>City</th>
                                            <th>Telephone</th>
                                            <th>Email</th>
                                            <th width="12%">Due</th>
                                            <th width="12%">Date</th>
                                            <th>View</th>
                                            <th>Message</th>
                                            <th>Edit</th>
                                        </tr>
                                    </thead>
                                    <tbody id="search_name_cus">
                                    <?php
                                    if (is_array($results)){ 
                                    foreach ($results as $cous_data) {
                                        $id = $cous_data->cmrid;
                                        $name = $cous_data->name;
                                        $company = $cous_data->company;
                                        $address = $cous_data->address;
                                        $mobile_phone = $cous_data->mobile_phone;
                                        $tel_phone = $cous_data->tel_phone;
                                        $email = $cous_data->email;
                                        $city = $cous_data->city;
                                        $due = $cous_data->due;

                                        $a_date = $cous_data->dated;
                                    ?>
                                        <tr>
                                            <td>#<?php echo $id; ?></td>
                                            <td><?php echo $name; ?></td>
                                            <td><?php echo $company; ?></td>
                                            <td><?php echo $mobile_phone; ?></td>
                                            <td><?php echo $address; ?></td>
                                            <td><?php echo $city; ?></td>
                                            <td><?php echo $tel_phone; ?></td>
                                            <td><?php echo $email; ?></td>
                                            <td><strong><?php echo $due; ?></strong> Tk.</td>
                                            <td><?php echo $a_date; ?></td>
                                            <td>
                                                <a href="<?php echo base_url(); ?>home/details_customer/<?php echo $id ?>" target="_blank" class="btn btn-sm btn-default"><i class="icofont icofont-plus"></i> Details</a>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-primary" value="<?php echo $id; ?>" onclick="send_sms_coustomer_only(this);" data-toggle="modal" data-target="#modal_md">
                                                    <i class="icofont icofont-ui-message"></i>
                                                </button>
                                            </td>
                                            <td>
                                                <button class="btn btn-sm btn-default" data-toggle="modal" data-target="#modal_lg" value="<?php echo $id; ?>" onclick="return update_customer(this)"><i class="icofont icofont-ui-edit"></i></button>
                                            </td>
                                        </tr>
                                    <?php }} ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php echo $links; ?>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="NEW_COUSTOMER">
                            
                            <div class="coustomer_panel" style="background: #eee">
                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="">Coustomer Name</label> <span class="label label-default">*</span>
                                        <input type="text" class="form-control" id="name" placeholder="Type Coustomer Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Address</label> <span class="label label-default">*</span>
                                        <input type="text" class="form-control" id="address" placeholder="Type Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="">City</label>
                                        <input type="text" class="form-control" id="city" placeholder="Type City">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Company</label>
                                        <input type="text" class="form-control" id="company" placeholder="Type Company">
                                    </div>

                                    <div class="form-group">
                                        <label for="">Added date</label> <span class="label label-default">*</span>
                                    </div>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"><i class="icofont icofont-ui-calendar"></i>
                                        </span>
                                        <input type="text" id="dated" class="form-control" value="<?php echo date("Y-m-d") ?>">
                                    </div>
                                </div>

                                <div class="col-md-6 col-lg-6 col-sm-6">
                                    <div class="form-group">
                                        <label for="">Previous Due</label> <span class="label label-success">Tk.</span>
                                        <input type="text" class="form-control" id="prev_due" placeholder="Type Previous Due">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Mobile Number</label> <span class="label label-default">*</span>
                                        <input type="text" class="form-control" id="mobile_phone" placeholder="Type Mobile Number. exm: 8801819292660">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Telephone Number</label>
                                        <input type="text" class="form-control" id="tel_phone" placeholder="Type Telephone Number">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" class="form-control" id="email" placeholder="Type Email">
                                    </div>
                                </div>
                                <div class="col-md-12 col-lg-12 col-sm-12 text-center">
                                    <button type="submit" onclick="crm_add()" class="btn btn-info">SUBMIT</button>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>


    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<script>
  $( function() {
    $( "#dated" ).datepicker({dateFormat : 'yy-mm-dd'});
  } );
</script>