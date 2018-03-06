<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h3 class="page-header"><a href="#" onclick = "location.replace(document.referrer);" class="btn btn-default btn-sm"><i class="icofont icofont-undo"></i></a> Create New User</h3>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
		
		<div class="panel panel-default">

			<?php echo form_open('home/userSubmit'); ?>
			<div class="panel-body">
				<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12">
					

					
					<div class="well">
						<span style="color: red;font-size: 12px;"><?php echo validation_errors();  ?></span>
						<div class="form-group">
							<label for="">username</label>
							<input type="text" class="form-control" name="username" placeholder="Input Type username" autocomplete="off">
						</div>
						<div class="form-group">
							<label for="">password</label>
							<input type="password" class="form-control" name="password" id="passShowId" placeholder="Input Type password">
							<input type="checkbox" id="showPass"> Show Password
						</div>
						<div class="form-group">
							<label for="">Select Type</label>

							<select id="type" name="role" onchange="return per_type(this)" class="form-control" required="required">

								<option value="1">Type</option>
								<option value="0">user</option>
							</select>
						</div>
						<div class="form-group">
							<label for="">Status </label>
							<input type="radio" name="status" value="1" checked=""> Active
							<input type="radio" name="status" value="0"> Inactive
						</div>
					
					</div>
					


				</div>

				
				<div class="col-md-6 col-lg-6 col-sm-6 col-xs-12" id="per"></div>
			</div>
			
			<div class="text-center" style="padding-bottom: 20px;" id="getsumitbutton"></div>
		    <?php echo form_close(); ?>
		</div> <!-- panel end -->

    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->

<script type="text/javascript" src="<?php echo base_url() ?>assest/dist/js/users.js"></script>