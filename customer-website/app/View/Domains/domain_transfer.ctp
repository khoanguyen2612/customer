<div class="search-domain">
		<div class="container-fluid">
			<h3 class="text-center">CHUYỂN ĐỔI NHÀ CUNG CẤP</h3>
			<ul class="nav nav-tabs container">
				<li><a href="#">Đăng ký tên miền</a></li>
				<li><a href="<?php echo $this->Html->url(array('controller'=>'Domains','action'=>'domain_transfer')); ?>">Chuyển đổi nhà cung cấp</a></li>
				<li><a href="#">Kiểm tra tên miền</a></li>
				<li><a href="<?php echo $this->Html->url(array('controller'=>'Domains','action'=>'product_price')); ?>">Bảng giá tên miền</a></li>
			</ul>
			<hr>
		</div>
		<div class="container">
			<div class="row"> 
				<form action="" method="">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 domain-transfer">
						<div class="send-require">
							<div class="col-xs-12 col-sm-12 col-md-10 col-lg-10">
								<input type="text" name="" class="form-control input-add" placeholder="">
							</div>
							<div class="col-xs-12 col-sm-12 col-md-2 col-lg-2">
								<button type="submit" class="btn btn-send-require"> Gửi yêu cầu</button>
							</div>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 domain-vn-transfer">
							<div class="line_color"></div>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th> Tên miền Việt Nam</th>
										<th> Phí chuyển đổi</th>
										<th> Kiểm tra </th>
									</tr>
								</thead>
								<?php foreach($data0 as $item){
              					?> 
								<tbody>
									<tr>
										<td><?php echo ($item['product_price']['product_name']);?></td>
										<td><?php if(!empty($item['product_price']['price_transfer'])){
											echo number_format($item['product_price']['price_transfer'],0,',','.');
										}else{
											echo $this->Html->image('icon-free.png'); 
										}
										?>
										</td>
										<td><button type="submit" class="btn btn-check-transfer">Kiểm tra</button></td>
									</tr>
								</tbody>
								  <?php
								}
								  ?>
							</table>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 domain-inter-transfer">
							<div class="line_color"></div>
							<table class="table table-bordered">
								<thead>
									<tr>
										<th> Tên miền quốc tế</th>
										<th> Phí chuyển đổi</th>
										<th> Kiểm tra </th>
									</tr>
								</thead>
								<?php foreach($data1 as $item){
              					?> 
								<tbody>
									<tr>
										<td><?php echo ($item['product_price']['product_name']);?></td>
										<td><?php if(!empty($item['product_price']['price_transfer'])){
											echo number_format($item['product_price']['price_transfer'],0,',','.');
										}else{
											echo $this->Html->image('icon-free.png'); 
										}
										?>
										</td>
										<td><button type="submit" class="btn btn-check-transfer">Kiểm tra</button></td>
									</tr>
								</tbody>
								 <?php
								}
								  ?>
							</table>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h4 class="condition-transfer">Điều kiện và quy trình khi chuyển tên miền tại VTC</h4>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 condition-vn">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th colspan="2">Tên miền Việt Nam</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><h2>1</h2></td>
										<td>
											<p>
												Yêu cầu nhà đăng ký cũ mở khóa chuyển đổi tên miền và cung cấp mã Authorization Key
											</p>
										</td>
									</tr>
									<tr>
										<td><h2>2</h2></td>
										<td>
											<p>
												Nhập thông tin tên miền muốn chuyển đổi nhà đăng ký và Gửi yêu cầu tới VTC
											</p>
										</td>
									</tr>
									<tr>
										<td><h2>3</h2></td>
										<td>
											<p>
												Check email quản trị tên miền Quý khách sẽ nhận được 1 email có chứa 1 link xác nhận chuyển đổi và 1 password
											</p>
										</td>
									</tr>
									<tr>
										<td>
											<h2>4</h2>
										</td>
										<td>
											<p>
												Quý khách click vào link xác nhận và nhập Password và mã Auth-code được cấp trước đó và xác nhận.
											</p>
										</td>
									</tr>
									<tr>
										<td>
											<h2>5</h2>
										</td>
										<td>
											<p>
												Sau khi xác nhận chờ từ 2 đến 7 ngày tên miền sẽ được chuyển về cloud.vtc.vn sẽ cấp tài khoản quản lý tên miền tới Quý khách
											</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 condition-inter">
							<table class="table table-bordered">
								<thead>
									<tr>
										<th colspan="2">Tên miền Quốc Tế</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td><h2>1</h2></td>
										<td>
											<p> 
												Yêu cầu nhà đăng ký cũ mở khóa chuyển đổi tên miền và cung
												cấp mã Authorization Key
											</p>
										</td>
									</tr>
									<tr>
										<td><h2>2</h2></td>
										<td>
											<p>Quý khách nhập tên miền muốn chuyển đổi nhà đăng ký vào đây</p>
										</td>
									</tr>
									<tr>
										<td><h2>3</h2></td>
										<td>
											<p>Gửi yêu chuyển đổi nhà đăng ký tới VTC</p>
										</td>
									</tr>
									<tr>
										<td><h2>4</h2></td>
										<td>
											<p>VTC thực hiện nghiệp vụ chuyển từ nhà đăng ký cũ về VTC</p>
										</td>
									</tr>
									<tr>
										<td><h2>5</h2></td>
										<td>
											<p>
												Chờ 2 đến 7 ngày tên miền sẽ được chuyển về cloud.vtc.vn cung cấp tài khoản quản lý tên miền tới Quý khách
											</p>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<h4 class="condition-transfer">Điều kiện transfer tên miền</h4>
						</div>
						<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
							<ul class="condition">
								<li>
									Tên miền sau khi đăng ký 60 ngày
								</li>
								<li>
									Tên miền Việt Nam còn hạn trên 30 ngày
								</li>
								<li>
									Tên miền Quốc tế còn hạn trên 30 ngày, nếu hết hạn và Quý khách thực hiện gia hạn và cần đợi sau 45 ngày mới được  transfer về VTC. 
								</li>
								<li>
									Nếu vẫn transfer theo quy định ICCAN, tên miền của Quý khách vẫn được transfer thành công nhưng không được gia hạn 1 năm khi chuyển về.
								</li>
								<li>
									Tên miền Quốc tế mới thay đổi thông tên chủ thể tên miền hoặc email chủ thể tên miền cần phải đợi sau 60 ngày mới transfer được.
								</li>
								<li>
									Tên miền Quốc tế khi transfer về VTCcần nộp phí gia hạn thêm 1 năm, hiện VTC có chính sách ưu đãi phí gia hạn cho Quý khách 
								</li>
								<li>
									khi transfer tên miền về VTC chi tiết xem thêm (tại đây)
								</li>
							</ul>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
	<style type="text/css">
	.condition-vn table{
		border-bottom: solid 10px #bfe4f8 !important;
	}
	.condition-inter table{
		border-bottom: solid 10px #ffe3d5 !important;
	}
	.condition{
		padding: 26px 5px 26px 70px;
		border:solid 1px #2a363f;
	}
	.condition li{
		margin-bottom: 5px;
		display: list-item !important;
	}
	.condition-vn th,.condition-inter th{
		border:none !important;
	}
</style>