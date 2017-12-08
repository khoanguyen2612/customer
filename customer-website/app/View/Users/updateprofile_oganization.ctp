	<?php echo $this->Html->css('fileinput.min');?>
	<?php echo $this->Html->css('profile');?>
	<div class="update_pr" style="background-color: #f3f3f3;padding-bottom: 20px;padding-top: 20px;">	
	<div class="container"  style="background-color: #fff;">
	<?php echo $this->Form->create('Account',array('class'=>'form-horizontal','enctype' => 'multipart/form-data'));?>
		<div class="row"  style="padding: 20px 0px;">
		<?php echo $this->Session->flash();?> 
			<div class="col-md-2">
				<div class="text-center">
					<div class="profile-user">
						<div class="kv-avatar">
			                <div class="">
			                    <?php echo $this->Form->input('avatar',array(
			                    	'id'=>'avatar-2',
			                    	'label'=>false,
			                    	'type'=>'file',
			                    	));
			                    ?>	                
			               	</div>
			            </div>
			            <div class="kv-avatar-hint"><small>File tải lên nhỏ hơn 1,5M</small></div>
    				</div>
				</div>
			</div>
			<div class="col-md-10">
				<div class="row">
					<div class="col-md-6 personal-info">
						<h3 style="color: #005faf;margin-top: 10px;"> Thông tin tổ chức</h3>
						<div class="form-group">
							<label class="col-lg-4 control-label"> Tên doanh nghiệp:</label>
							<div class="col-lg-8">          
				            	<?php
					                echo $this->Form->input('organ_name',array(
					                    'type' => 'text',
					                    'class' => 'form-control',
					                    'label' => false,
					                    'value'=>$user['Organization']['organ_name']
					                    ));
					            ?>

				            </div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label"> Họ người đại diện: </label>
							<div class="col-lg-8">
								<?php
					                echo $this->Form->input('fname',array(
					                    'type' => 'text',
					                    'class' => 'form-control',
					                    'label' => false,
					                    'value'=>$user['Account']['fname']
					                    ));
					            ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label"> Tên người đại diện: </label>
							<div class="col-lg-8">
								<?php
					                echo $this->Form->input('lname',array(
					                    'type' => 'text',
					                    'class' => 'form-control',
					                    'label' => false,
					                    'value'=>$user['Account']['lname']
					                    ));
					            ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label"> Email: </label>
							<div class="col-lg-8">
								<?php
					                echo $this->Form->input('email',array(
					                    'type' => 'email',
					                    'class' => 'form-control',
					                    'label' => false,
					                    'value'=>$user['Account']['email']
					                    ));
					            ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label"> Mã số thuế: </label>
							<div class="col-lg-8">
								<?php
					                echo $this->Form->input('tax_code',array(
					                    'type' => 'text',
					                    'class' => 'form-control',
					                    'label' => false,
					                    'value'=>$user['Organization']['tax_code']
					                    ));
					            ?>
							</div>
						</div>
					</div>
					<div class="col-md-6" style="margin-top: 35px;">
						<div class="form-group">
							<label class="col-lg-4 control-label"> Địa chỉ liên hệ: </label>
							<div class="col-lg-8">
								<?php
					                echo $this->Form->input('add_contact',array(
					                    'type' => 'text',
					                    'class' => 'form-control',
					                    'label' => false,
					                    'value'=>$user['Account']['add_contact']
					                    ));
					            ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label"> Tỉnh/Thành phố: </label>
							<div class="col-lg-8">
								<?php
					                echo $this->Form->input('address',array(
					                    'type' => 'text',
					                    'class' => 'form-control',
					                    'label' => false,
					                    'value'=>$user['Account']['address']
					                    ));
					            ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label"> Quốc gia </label>
							<div class="col-lg-8">
								<?php
					                echo $this->Form->input('country',array(
					                    'type' => 'text',
					                    'class' => 'form-control',
					                    'label' => false,
					                    'value'=>$user['Account']['country']
					                    ));
					            ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label"> Số điện thoại chính: </label>
							<div class="col-lg-8">
								<?php
					                echo $this->Form->input('phonenumber',array(
					                    'type' => 'text',
					                    'class' => 'form-control',
					                    'label' => false,
					                    'value'=>$user['Account']['phonenumber']
					                    ));
					            ?>
							</div>
						</div>
						<div class="form-group">
							<label class="col-lg-4 control-label"> Số điện thoại phụ: </label>
							<div class="col-lg-8">
								<?php
					                echo $this->Form->input('phonenumber2',array(
					                    'type' => 'text',
					                    'class' => 'form-control',
					                    'label' => false,
					                    'value'=>$user['Organization']['phonenumber2']
					                    ));
					            ?>
							</div>
						</div>						
					</div>
				</div>
			</div>
			<div class="col-lg-12">
		    		<div class="text-center">
		              <?php echo $this->Form->button('Lưu thay đổi',array(
		                    'class' => 'btn btn-primary action',
		                    'type' => 'submit',
		                  ));
		                  echo $this->Form->button('Hủy',array(
		                    'class' => 'btn btn-primary action',
		                    'type' => 'reset',
		                    'style' => 'background-color:#f47636'
		                  ));
		                ?>
		    		</div>
			</div>
		</div>
	<?php echo $this->Html->script('fileinput.min');?>
	</div>
	</div>
<style type="text/css">
	.krajee-default.file-preview-frame .kv-file-content,.kv-preview-data,.file-preview-other-frame{
		width: 100% !important;
	}
	.krajee-default.file-preview-frame{
		float: none !important;
	}
	label.control-label{
		display: inline-block;
		text-align: left !important;
		padding: 10px 0px !important;
	}
	.form-horizontal .form-group{
		margin:10px 0px !important;
	}
	button.action{
		margin: 5px 20px;
		border-radius: unset !important;
		border:0px !important;
		width: 165px !important;
	}
	.file-preview {
		height: 170px;
	}
</style>
<script>
	$("#avatar-2").fileinput({
	    overwriteInitial: true,
	    maxFileSize: 1500,
	    showClose: false,
	    showCaption: false,
	    showBrowse: false,
	    browseOnZoneClick: true,
	    removeLabel: '',
	    removeIcon: '<i class="glyphicon glyphicon-remove"></i>',
	    removeTitle: 'Cancel or reset changes',
	    // elErrorContainer: '#kv-avatar-errors-2',
	    msgErrorClass: 'alert alert-block alert-danger',
	    defaultPreviewContent: '<?php 
	    if(empty($user["Account"]["avatar"])){
	   		echo $this->Html->image("profile-default.png");
		}
	    else{
	    	echo $this->Html->image("../uploads/images/".$user["Account"]["avatar"]);
	    }
	    ?><h6 class="text-muted">Click để chọn ảnh</h6>',
	    layoutTemplates: {main2: '{preview} {remove} {browse}'},
	    allowedFileExtensions: ["jpg", "png", "gif"]
	});
</script>
<?php echo $this->fetch('script'); ?>