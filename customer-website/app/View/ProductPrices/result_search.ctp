<SCRIPT LANGUAGE="JavaScript">
	var mikExp = /[$\\@\\\#%\^\&\*\(\)\[\]\+\_\{\}\`\~\=\|\!\-]/;
	function dodacheck(val) {
		var strPass = val.value;
		var strLength = strPass.length;
		var lchar = val.value.charAt((strLength) - 1);
		if(lchar.search(mikExp) != -1) {
			var tst = val.value.substring(0, (strLength) - 1);
			val.value = tst;
		}
	}
</script>
<div class="search-domain">
	<div class="container-fluid">
		<h3 class="text-center">KIỂM TRA TÊN MIỀN</h3>
		<ul class="nav nav-tabs container">
			<li><a href="<?php echo $this->Html->url(array('controller'=>'ProductPrices','action'=>'register_domain'),true);?>">Đăng ký tên miền</a></li>
			<li><a href="">Chuyển đổi nhà cung cấp</a></li>
			<li class="active"><a href="<?php echo $this->Html->url(array('controller'=>'ProductPrices','action'=>'result_search'),true);?>">Kiểm tra tên miền</a></li>
			<li>
				<a href="<?php echo $this->Html->url(array('controller' => 'ProductPrices', 'action' => 'price'), true); ?>">Bảng giá tên miền</a>
			</li>
		</ul>
		<hr>
		<div class="container">
			<div id="check">
				<div class="row">
					<?php echo $this->Session->flash(); ?>
					<form action="" method="POST" name="checkavailble">
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
							<p><span>1</span>Nhập các tên miền cần kiểm tra</p>
							<textarea rows="4" cols="50" required name="dm_input" maxlength="200" onKeyUp="javascript:dodacheck(this);" style="padding: 10px;" oninvalid="this.setCustomValidity('Bạn chưa nhập tên miền kiểm tra')" oninput="setCustomValidity('')"></textarea>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-5 col-lg-5">
							<p><span>2</span>Chọn ít nhất 01 loại tên miền</p>
							<ul class="nav nav-tabs" role="tablist" id="select_type">
								<li role="presentation" class="active">
									<a href="#common" aria-controls="common" role="tab" data-toggle="tab">
										<input type="radio" role="tab-controll" name="tab" checked>
										<label><span></span>Phổ biến</label>
									</a>
								</li>
								<li role="presentation">
									<a href="#qt" aria-controls="qt" role="tab" data-toggle="tab">
										<input type="radio" role="tab-controll" name="tab">
										<label><span></span>Quốc tế</label>
									</a>
								</li>
								<li role="presentation">
									<a href="#vn" aria-controls="vn" role="tab" data-toggle="tab">
										<input type="radio" role="tab-controll" name="tab">
										<label><span></span>Việt Nam</label>
									</a>
								</li>
							</ul>
							<div class="tab-content">
								<div id="common" class="tab-pane fade in active">
									<ul class="list-inline domain_name">
										<?php $s_id=0; ?>
										<?php foreach ($data_dm as $key => $row): ?>
											<?php if($row['ProductPrice']['domain_common'] == 1): ?>
												<li>
													<input type="checkbox" id="check_<?php echo $s_id; ?>" name="suffix_key[]" value="<?php echo $key  ?>">
													<label for="check_<?php echo $s_id;$s_id++; ?>">
														<span></span><?php echo $row['ProductPrice']['product_name'] ?>
													</label>
												</li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								</div>
								<div id="qt" class="tab-pane fade">
									<ul class="list-inline domain_name">
										<?php foreach ($data_dm as $key => $row): ?>
											<?php if($row['ProductPrice']['domain_type'] == 0): ?>
												<li>
													<input type="checkbox" id="check_<?php echo $s_id; ?>" name="suffix_key[]" value="<?php echo $key ?>">
													<label for="check_<?php echo $s_id;$s_id++; ?>">
														<span></span><?php echo $row['ProductPrice']['product_name'] ?>
													</label>
												</li>
											<?php endif; ?>
										<?php endforeach; ?>
									</ul>
								</div>
								<div id="vn" class="tab-pane fade">
									<ul class="list-inline domain_name">
										<?php foreach ($data_dm as $key => $row): ?>
											<?php if($row['ProductPrice']['domain_type'] == 1): ?>
												<li>
													<input id="check_<?php echo $s_id; ?>" type="checkbox" name="suffix_key[]" value="<?php echo $key ?>">
													<label for="check_<?php echo $s_id;$s_id++; ?>">
														<span></span><?php echo $row['ProductPrice']['product_name'] ?>
													</label></li>
												<?php endif; ?>
											<?php endforeach; ?>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
								<p><span>3</span>Click để kiểm tra</p>
								<button type="submit" class="btn btn-success">Kiểm tra</button>
							</div>
						</form>
					</div>
					<hr>
					<?php if(isset($result)): ?>
						<div class="row">
							<div class="col-lg-12 add-domain-domain">
								<p><span>4</span>Kết quả kiểm tra tên miền</p>
								<div class="table-responsive result add-on">
									<table class="table table-hover table-bordered">
										<thead>
											<tr>
												<th class="dm_head_result"></th>
												<th class="dm_head_result">Tên miền</th>
												<th class="dm_head_result">Phí duy trì</th>
												<th class="dm_head_result">Phí đăng kí</th>
												<th class="dm_head_result">Thông tin Whois</th>
												<th>Thêm vào giỏ hàng</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($result as $row): ?>

												<?php if ($row['status'] == 'available'): ?>
													<tr>
														<td>
															<?php echo "<img src='../app/webroot/img/icon-check.png'>"; ?>
														</td>
														<td>
															<?php echo $row['name']; ?>
														</td>
														<td class="mn_count">
															<?php echo number_format($row['ProductPrice']['price'], 0, ',', '.'); ?> VND
														</td>
														<td class="mn_count">
															<?php echo number_format($row['ProductPrice']['bk_price'], 0, ',', '.'); ?> VND
														</td>
														<td>
														</td>
														<td>
															<input type="checkbox" class="add-domain-checkbox" id="domain_item_id" name="">
															<label for="demo" class="demoCheck demoCheckLabel"></label>
														</td>
													</tr>
												<?php else: ?>
													<tr>
														<td>
															<?php echo "<img src='../app/webroot/img/icon-del.png'>"; ?>
														</td>
														<td>
															<?php echo $row['name']; ?>
														</td>
														<td class="mn_count">
															<?php echo number_format($row['ProductPrice']['price'], 0, ',', '.'); ?> VND
														</td>
														<td class="mn_count">
															<?php echo number_format($row['ProductPrice']['bk_price'], 0, ',', '.'); ?> VND
														</td>
														<td>
															<input type="hidden" class="domain_name" name="domain_name" value="<?php echo $row['name']; ?>">
															<div class='btn btn-danger button1' data-toggle="modal" data-target="#myModal">
																Whois 
																<img src='../app/webroot/img/icon-whois.png'>
															</div>
															<div class="modal fade" id="myModal" role="dialog">
																<div class="modal-dialog modal-lg">
																	<div class="modal-content md-cn" id="demo">
																	</div>
																</div>
															</div>
														</td>
														<td>
														</td>
													</tr>
												<?php endif; ?>

											<?php endforeach; ?>
										</tbody>
									</table>
								</div>
								<button type="submit" class="btn pull-right" id="go_to_cart"> Chuyển đến giỏ hàng</button>
							</div>

							

							<div class="col-md-8 col-lg-8 explain">
								<p class="p-explain"> Bảng chú thích các kí hiệu</p>
								<table class="table table-bordered">
									<tbody>
										<tr>
											<td><img src="../app/webroot/img/icon-del.png"></td>
											<td>Tên miền đã được đăng kí, bạn không thể đăng kí tên miền này</td>
										</tr>
										<tr>
											<td><img src="../app/webroot/img/icon-check.png"></td>
											<td>Tên miền chưa đăng kí, bạn có thể đăng kí tên miền này</td>
										</tr>
										<tr>
											<td>
												<button type="submit" class="btn btn-danger">Whois <img
													src="../app/webroot/img/icon-whois.png"></button>
												</td>
												<td>Xem thông tin tin miền</td>
											</tr>
											<tr>
												<td><img src="../app/webroot/img/icon-empty.png"></td>
												<td>Tên miền có thể đăng kí, đang ở trạng thái chưa chọn</td>
											</tr>
											<tr>
												<td><img src="../app/webroot/img/icon-tick.png"></td>
												<td>Tên miền có thể đăng kí, đang ở trạng thái đã chọn</td>
											</tr>
										</tbody>
									</table>
								</div>
								<div class="col-md-4 col-lg-4"></div>
							</div>
						<?php endif; ?>	
					</div>
				</div>
			</div>
		</div>
		<script type="text/javascript">
			$(function () {
				$('.nav-tabs').on('click', 'a[role=tab] input[type=radio]', function(event) {
					event.stopPropagation();
					$(this).parent().tab('show');
				});
				$('.nav-tabs').on('show.bs.tab', 'a[role=tab]', function() {
					$(this).find('input[type=radio]').prop('checked', true);
				});
			});

			$(document).ready(function () {
				$('.button1').click(function () {
					console.log($(this).parent().children(".domain_name").val());
					$.ajax({
						url: "<?php echo $this->Html->url(array('controller' => 'ProductPrices', 'action' => 'whois_domain'))?>",
						type: "post",
						dataType: "html",
						data: {
							domain_name: $(this).parent().children(".domain_name").val(),
						},
						success: function (result) {
							$('#demo').html(result);
						}
					});
				});
			});
		</script>
		<style type="text/css">
		#go_to_cart{
			background-color: #ea7836;
			border: none;
			color: white;
			padding: 6px 12px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			height: 50px;
			border-radius: 0px;
			width: 173px;
		}
		.result a:hover{
			color: #0060af !important;
		}
		form ul.nav a{
			text-decoration: none !important;
			margin-top: 0px !important;
			margin-bottom:0px !important;
		}
		.mn_count{
			color: #0060af;
		}
		.result a[role="button"]{
			border-radius: 0px;
		}
		.search_owner{
			background-color: #fff !important;
			color: #b8b8b8;
		}
		#select_type{
			border-bottom: none;
		}
		#select_type li a{
			background-color: unset !important;
			color: #2d3740 !important;
			border:0px !important;
			text-transform: capitalize !important;
			padding-left: 0px !important;
		}
		input[type="radio"],.domain_name input[type=checkbox] {
			display:none;
		}
		input[role=tab-controll] + label > span{
			margin:-2px 10px 0 0;
			vertical-align: middle;
			padding: 0px !important;
			display:inline-block;
			width:22px;
			height:22px;
			cursor:pointer;
			background:url(<?php echo $this->Html->url('/img/tick_radio.png') ?>) left top no-repeat;
		}
		input[role=tab-controll]:checked + label span{
			background:url(<?php echo $this->Html->url('/img/tick_radio.png') ?>) -28px top no-repeat;
		}
		.domain_name input[type=checkbox]  + label > span{
			margin:-4px 3px 0 0;
			vertical-align: middle;
			padding: 0px !important;
			display:inline-block;
			width:20px;
			height:20px;
			cursor:pointer;
			background:url(<?php echo $this->Html->url('/img/checbox.png') ?>) -4px top no-repeat;
		}
		.domain_name input[type=checkbox]:checked  + label span{
			background:url(<?php echo $this->Html->url('/img/checbox.png') ?>) -30px top no-repeat;
		}
		.domain_name li{
			width: 20%;
			float: left !important;
		}

		/**/
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