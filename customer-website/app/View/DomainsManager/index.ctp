<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h4><i class="star"></i>Quản lý tên miền</h4>
				<div class="customer-panel text-center">
					<ul class="list-inline">
						<li><a href="">Đăng ký tên miền</a></li>
						<li>
							<button type="button" class="btn btn-info btn-lg check_wh" data-toggle="modal" data-target="#whois_dg">Xem Thông tin WHOIS</button>
							<div id="whois_dg" class="modal fade" role="dialog">
								<div class="modal-dialog modal-lg">
									<div class="modal-content md-cn" id="demo">
									</div>
								</div>
							</div>
						</li>
						<li><a href="">Cài đặt DNS</a></li>
						<button type="button" class="btn btn-info btn-lg update_ns" data-toggle="modal" data-target="#whois_dg">Cập nhật NS</button>
						<button type="button" class="btn btn-info btn-lg stop_wh" data-toggle="modal" data-target="#whois_dg">Whois Protect</button>
						<li><a href="">Giới hạn tên miền</a></li>
						<li><a href="">Thay đổi mật khẩu</a></li>
						<li><a href="">Domain Lock</a></li>
						<li><a href="">Gửi mail</a></li>
					</ul>
				</div>
				<div class="search_advance">
					<button class="btn btn-info" role="btn-seach" style="display: table;">
						<?php echo $this->Html->image('search_icon.png') ?>
						TÌM KIẾM NÂNG CAO
					</button>
					<div id="search" style="display: none;">
						<legend class="text-center" style="font-weight: 600;color: #f37636">NHẬP VÀO THÔNG TIN ĐỂ TÌM KIẾM NÂNG CAO</legend>
						<form method="POST" action="">
							<table class="table table-bordered" style="width: 80%;margin: auto;">
								<tbody>
									<tr>
										<td>Tên miền</td>
										<td>
											<textarea placeholder="Nhập tên miền..." name="domain_name"></textarea>
										</td>
									</tr>
									<tr>
										<td>Loại Tên miền:</td>
										<td>
											<select name="domain_type">
												<option selected="selected" value="">Chọn loại tên miền</option>
												<option value="1">Tên miền việt nam</option>
												<option value="0">Tên miền quốc tế</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Trạng thái</td>
										<td>
											<select name="domain_status">
												<option selected="selected" value="">Chọn Trạng Thái Tên Miền</option>
												<option value="1">Đang Sử Dụng</option>
												<option value="0">Hết Hạn Sử Dụng</option>
											</select>
										</td>
									</tr>
									<tr>
										<td>Ngày đăng ký:</td>
										<td><input type="text" name="reg_date" id="reg_date" placeholder="Chọn ngày đăng ký ..."></td>
									</tr>
									<tr>
										<td>Ngày hết hạn:</td>
										<td><input type="text" name="exp_date" id="exp_date" placeholder="Chọn ngày hết hạn ..."></td>
									</tr>
								</tbody>
							</table>
							<button class="btn btn-success" type="submit" style="display: block;background-color: #f37636" id="search_btn">Tìm kiếm</button>
						</form>
					</div>
				</div>
				<div class="list_dm">
					<div class="top_pn">
						<div class="left_area pull-left"> 
								<!--<a href="">
									<span style="display: inline-block;width: 25px;height: 25px;border:solid 1px #ebece9;">
										<img src="img/prev.png">
									</span>
								</a>
								<a href="">1</a>
								<a href="">
									<span style="display: inline-block;width: 25px;height: 25px;border:solid 1px #ebece9;">
										<img src="img/next.png">
									</span>
								</a>-->
								<?php echo $this->Paginator->prev('Previous ', null, null, array('class' => 'disabled')); ?>
								<?php echo $this->Paginator->numbers(); ?>
								<?php echo $this->Paginator->next('Next',null,null, array('class'=>'disabled')); ?>
							</div>
							<div class="righ_area pull-right">
								Số bản ghi: 
								<select name="limitValue" onchange="getLimit(this.value);">
									<option value="10" <?php echo ($limit==10)?'selected':''; ?>>10</option>
									<option value="20"  <?php echo ($limit==20)?'selected':''; ?>>20</option>
									<option value="50"  <?php echo ($limit==50)?'selected':''; ?>>50</option>
									<option value="100"  <?php echo ($limit==100)?'selected':''; ?>>100</option>
								</select>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 20px;"></div>
						<div class="table-responsive">
							<table id="tbl-dm" class="table table-bordered">
								<tbody>
									<tr id="panel">
										<td bgcolor="#ebece9" role="th"></td>
										<td bgcolor="#ebece9" role="th">STT</td>
										<td bgcolor="#ebece9" role="th">
											Tên miền
											<span role="sort" field="domain_name"></span>
										</td>
										<td bgcolor="#ebece9" role="th">
											Whois Protect
											<span role="sort" field="domain_status"></span>
										</td>
										<td bgcolor="#ebece9" role="th">
											Ngày đăng ký
											<span role="sort" field="created_date"></span>
										</td>
										<td bgcolor="#ebece9" role="th">
											Ngày hết hạn
											<span  role="sort" field="expiration_date"></span>
										</td>
										<td bgcolor="#ebece9" role="th">Trạng thái</td>
										<td bgcolor="#ebece9" role="th">Bản khai</td>
									</tr>
									<?php $stt = 1; ?>
									<?php foreach($data as $row):?>
										<tr>
											<td>
												<input type="radio" name="sl_domain" id="dm_<?php echo $stt; ?>" value="<?php echo $row['Domain']['domain_name']; ?>">
												<label for="dm_<?php echo $stt; ?>">
													<span></span>
												</label>
											</td>
											<td>
												<?php echo $stt;$stt++; ?>
											</td>
											<td><?php echo $row['Domain']['domain_name']; ?></td>
											<td>
												<?php
												if($row['Domain']['whois_type'] == 'Natural'){
													echo 'Đang hiển thị';
												}else if($row['Domain']['whois_type'] == 'legal'){
													echo 'Đã ẩn';
												}
												?>
											</td>
											<td>
												<?php 
												$created_date = strtotime($row['Domain']['created_date']);
												echo date("d-m-Y H:i:s", $created_date);
												?> 
											</td>
											<td>
												<?php 
												$expiration_date = strtotime($row['Domain']['expiration_date']);
												echo date("d-m-Y H:i:s", $expiration_date);
												$today = date("d-m-Y");
												$time_end = ($expiration_date - strtotime($today)) / (60 * 60 * 24);;
												echo (ceil($time_end) > 0) ?'(còn lại '.ceil($time_end).' ngày)' : '';
												?> 
											</td>
											<td>
												<?php
												if($row['Domain']['domain_status'] == '1'){
													echo "Đang sử dụng";
												} else if($row['Domain']['domain_status'] == '0'){
													echo "Đang dừng sử dụng";
												}
												?>
											</td>
											<td><a href="">Download bản khai</a></td>
										</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
						<div class="toppanel" style="margin-bottom: 20px;">					
							<div class="left_area pull-left"> 
								<!--<a href="">
									<span style="display: inline-block;width: 25px;height: 25px;border:solid 1px #ebece9;">
										<img src="img/prev.png">
									</span>
								</a>-->
								<?php echo $this->Paginator->prev('Previous ', null, null, array('class' => 'disabled')); ?>
								<?php echo $this->Paginator->numbers(); ?>
								<?php echo $this->Paginator->next('Next',null,null, array('class'=>'disabled')); ?>
								<!--<a href="">
									<span style="display: inline-block;width: 25px;height: 25px;border:solid 1px #ebece9;">
										<img src="img/next.png">
									</span>
								</a>-->
								<p>Tổng số <strong><?php echo $this->Paginator->params()['count'];  ?></strong> tên miền</p>
							</div>
							<div class="righ_area pull-right">
								Số bản ghi:
								<select name="limitValue" onchange="getLimit(this.value);">
									<option value="10" <?php echo ($limit==10)?'selected':''; ?>>10</option>
									<option value="20" <?php echo ($limit==20)?'selected':''; ?>>20</option>
									<option value="50"  <?php echo ($limit==50)?'selected':''; ?>>50</option>
									<option value="100"  <?php echo ($limit==100)?'selected':''; ?>>100</option>
								</select>
							</div>
						</div>
						<div class="clearfix" style="margin-bottom: 20px;"></div>
						<button>Kết xuất ra Excels</button>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('button[role=btn-seach]').on('click', function(event) {
			$('#search').slideToggle();
		});
		function getLimit(value){
			$.ajax({
				url: "<?php echo $this->Html->url(array('controller'=>'DomainsManager','action'=>'index')); ?>",
				type: 'POST',
				dataType: 'html',
				data: {
					limit: value
				},
			})
			.done(function(result) {
				$('.content').replaceWith(result);
			// console.log(result);
		});		
		}
		$("#reg_date,#exp_date").datepicker({ dateFormat: 'yy-mm-dd' });

		$('#search_btn').on('click',function(e){
			event.preventDefault();
			$.ajax({
				url: "<?php echo $this->Html->url(array('controller'=>'DomainsManager','action'=>'index')); ?>",
				type: 'POST',
				dataType: 'html',
				data: {
					action:'search',
					domain_name: $('textarea[name="domain_name"]').val(),
					domain_type:$('select[name=domain_type]').val(),
					domain_status:$('select[name=domain_status]').val(),
					start:$('input[name=reg_date]').val(),
					end:$('input[name=exp_date]').val(),
				},
			})
			.done(function(result) {
				$('.list_dm').html(result);
				//console.log(result);
			});
			
			
		});
		$('span[role=sort]').on('click',function(){
			if(!$(this).hasClass('sort-up')){
				$('span.sort-up').removeClass('sort-up');
			}
			$(this).toggleClass('sort-up');
			var order_by = $(this).attr('class');
			$.ajax({
				url: "<?php echo $this->Html->url(array('controller'=>'DomainsManager','action'=>'index')); ?>",
				type: 'POST',
				dataType: 'html',
				data: {
					action:'sort',
					field:$(this).attr('field'),
					order_by:order_by,
				},
			})
			.done(function(result) {
				$('#panel').nextAll().remove();
				$('#panel').after(result);
				//console.log(result);
			});	
		});

		// call ajax check whois
		$('button.check_wh').on('click',function(event){
			if($('input[name=sl_domain]:checked').val() == undefined){
				alert('Chọn tên miền bất kì để kiểm tra');
				event.preventDefault();
				event.stopPropagation();
			}else{
				$.ajax({
					url: "<?php echo $this->Html->url(array('controller'=>'DomainsManager','action'=>'whois_domain')) ?>",
					type: 'POST',
					dataType: 'html',
					data: {
						domain_name: $('input[name=sl_domain]:checked').val()
					},
				})
				.done(function(result) {
					//console.log(result);
					$('#demo').html(result);
				});
			}	
		});
		$('button.stop_wh').on('click',function(event){
			if($('input[name=sl_domain]:checked').val() == undefined){
				alert('Chọn tên miền bất kì');
				event.preventDefault();
				event.stopPropagation();
			}else{
				$.ajax({
					url: "<?php echo $this->Html->url(array('controller'=>'DomainsManager','action'=>'whois_protect')) ?>",
					type: 'POST',
					dataType: 'html',
					data: {
						domain_name: $('input[name=sl_domain]:checked').val()
					},
				})
				.done(function(result) {
					//console.log(result);
					$('#demo').html(result);
				});
			}	
		});
		$('button.update_ns').on('click',function(event){
			if($('input[name=sl_domain]:checked').val() == undefined){
				alert('Chọn tên miền bất kì');
				event.preventDefault();
				event.stopPropagation();
			}else{
				$.ajax({
					url: "<?php echo $this->Html->url(array('controller'=>'DomainsManager','action'=>'update_ns')) ?>",
					type: 'POST',
					dataType: 'html',
					data: {
						domain_name: $('input[name=sl_domain]:checked').val()
					},
				})
				.done(function(result) {
					//console.log(result);
					$('#demo').html(result);
				});
			}	
		});

	</script>
	<style type="text/css">
	legend{
		font-size: 17px;
	}
	button[role=btn-seach]{
		margin: 30px auto 20px auto;
		background-color: #f37636;
		border:0;
	}
	#search_btn{
		padding: 5px 20px;
		border-radius: unset;
		margin: 20px auto;
		border:none;
		font-weight: 600;
	}
	span[role=sort]{
		width: 22px;
		height: 22px;
		display: inline-block;
		float: right;
		cursor: pointer;
		position: absolute;
		right: 2px;
		top:4px;
		background:url("<?php echo $this->Html->url('/img/sort_down.png')?>") no-repeat center;
	}
	td[role=th]{
		position:relative;
		padding-right: 22px !important;
	}
	.sort-up{
		background:url("<?php echo $this->Html->url('/img/sort_up.png')?>") no-repeat center !important;
	}
	.top_pn a {
		text-decoration: none;
	}
	.content{
		background-color: #f3f3f3;
	}
	.content .row{
		margin-top: 10px;
		margin-bottom: 30px;
		padding-bottom: 60px;
		background-color: #fff;
	}
	.star{
		background: url("<?php echo $this->Html->url('/img/star_img.png')?>") no-repeat top;
		display: inline-block;
		width: 27px;
		height: 27px;
		margin-bottom: -6px;
		margin-right: 8px;
	}
	.content h4{
		margin-top: 30px;
		color: #f37636;
		text-transform: uppercase;
		font-weight: 600;
	}
	#search{
		background-color: #F4F4F4;
		margin:20px auto;
		width: 80%;
		text-align: center;
		border:solid 1px #F4F4F4;
		padding-top: 20px;
	}
	#search tr td:nth-child(1){
		width: 30%;
		font-weight: 600;
	}
	#search td textarea, #search td select,#search td input{
		width: 100%;
		padding: 5px 10px;
		border:solid 1px #D4D4D4;
	}
	#search td{
		border:solid 1px #D4D4D4;
		padding-left: 2% !important;
		text-align: center;
	}
	.customer-panel a,.customer-panel button{
		display: inline-block;
		background-color: #9bed74;
		background: #9bed74; 
		background: -webkit-linear-gradient(#fbf608, #9bed74);
		background: -o-linear-gradient(#fbf608, #9bed74); 
		background: -moz-linear-gradient(#fbf608, #9bed74);
		background: linear-gradient(#fbf608, #9bed74);
		color: #353535;
		padding: 5px 8px;
		border-radius: 4px;
		text-decoration: none;
		font-size: 14px;
		margin: 5px 0px;
		font-weight: 500;
	}
	#tbl-dm td{
		padding: 0px;
		vertical-align: middle;
		text-align:center;
	}
	input[name=sl_domain] {
		display: none;
	}
	input[name=sl_domain]  + label > span{
		margin: 0px 0px -4px 0;
		vertical-align: middle;
		padding: 0px !important;
		display:inline-block;
		width:20px;
		height:20px;
		cursor:pointer;
		background:url(<?php echo $this->Html->url('/img/tick_radio.png') ?>) -4px top no-repeat;
	}
	input[name=sl_domain]:checked  + label > span{
		background:url(<?php echo $this->Html->url('/img/tick_radio.png') ?>) -30px top no-repeat;
	}
	#panel td{
		padding: 6px !important;
	}
	.md-cn {
		width: 100%;
		padding: 0%;
		height: auto;
	}
	.modal-lg {
		padding: unset;
	}
	.modal-header {
		padding: 20px;
		background: #e67237;
		color: #fff;
	}
	.whois-body {
		margin: 10px 50px;
		text-align: left;

	}
	.whois-section {
		margin-bottom: 15px;

	}
	.whois-item {
		background: #005faf;
		color: #fff;
		padding: 10px;
		font-size: 24px;
	}
	.whois-content {
		line-height: 30px;
		padding-top: 10px;
	}
	.whois-content-1 {
		line-height: 15px;
		padding-top: 20px;
	}
	.dcol {
		float: left;
		width: 50%;
	}
</style>