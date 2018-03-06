<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header">Dashboard</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">

    <?php 
        $query = $this->db->get("coustomer");
        foreach ($query->result_array() as $result) {
            $id = $result['cmrid'];
            $name = $result['name'];
            $company = $result['company'];
            $address = $result['address'];
            $mobile_phone = $result['mobile_phone'];
            $city = $result['city'];
    ?>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-primary">
                <div class="panel-heading" style="min-height: 195px">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-user fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?php echo $id ?></div>
                            <div><strong style="font-size: 16px;"><?php echo $name ?></strong></div>
                            <div><?php echo $mobile_phone ?></div>
                            
                        </div>
                        <p class="text-right" style="padding-right: 11px;margin-bottom: 0;font-size: 16px;"><strong><?php echo $company ?></strong></p>
                        <p class="text-right" style="padding-right: 11px"><?php echo $address.', '.$city ?></p>
                    </div>
                </div>
                <a href="<?php echo base_url(); ?>home/details_customer/<?php echo $id ?>" target="_blank">
                    <div class="panel-footer">
                        <span class="pull-left">View Details - <?php echo $result['due']; ?> Tk.</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    <?php }?>


    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->