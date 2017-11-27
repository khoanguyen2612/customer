<!DOCTYPE html>
<html>
<head>
	<title>VTC Cloud</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/customer_home.css">
	<link rel="stylesheet" type="text/css" href="css/storage_service.css">
</head>
<body>
	<div class="logo_div">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-lg-12">
					<div class="col-lg-6 col-md-4">
						<img src="img/vtc-logo.png" class="logo">
					</div>
					<div class="col-lg-6 col-md-8">
						<div class="cart-header col-md-offset-6 col-md-6 col-sm-offset-6 col-sm-6 col-xs-12 pull-right">
							<i class="fa fa-cart-plus" style="color:#fff;font-size:20px;"></i><span> Bạn đang có: 0  sản phẩm</span>
						</div>
						<div class="user-header col-md-12">
							<p>Xin chào <b>ABC</b>!</p>
							<a href="#"><b>Danh sách khách hàng</b></a>
							|<a href="#">Thông tin tài khoản</a>
							|<a href="#">Thay đổi mật khấu</a>
							|<a href="#"><b>Thoát</b></a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="account-cart">
		<div class="container">
			<div class="row">
				<div class="col-md-3 bg-1a70b7">
					<span>Đại lý cấp: </span>3<br>
					<span>Tổng tiền đã nạp: <big>42.961.720đ</big></span>
				</div>
				<div class="col-md-3 text-center">
					<span>Số dư tài khoản: <big>961.720đ</big></span>
				</div>
				<div class="col-md-3 text-center bg-1a70b7">
					<span>Điểm thưởng: <big>720</big></span>
				</div>
				<div class="col-md-3 text-center">
					<button class='btn'>Nạp tiền</button>
				</div>
			</div>
		</div>
	</div>
	<nav class="navbar navbar-default" id="menuNavbar">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span> 
				</button>	
			</div>
			<div class="collapse navbar-collapse" id="myNavbar">
				<ul class="nav navbar-nav">
					<li><a href="Home.html"><i class="fa fa-home" style="color:#fff;font-size:20px;"></i></a></li>
					<li  class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Đăng ký dịch vụ</a>
					</li>
					<li  class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Lịch sử giao dịch</a>
					</li> 
					<li  class="dropdown"><a href="#">Bảng giá dịch vụ</a></li>
					<li  class="dropdown"><a href="#">Quản lý dịch vụ</a></li>
					<li  class="dropdown"><a href="#">Đang chờ xử lý</a></li>
				</ul>
			</div>
		</div>
	</nav>
		<div id="content">
			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<div class="sp_tag product-home">
				<div class="container">
			<div class="row">
				<div class="product-contact pay-cart">
					<img src="img/pay-cart.png">
				</div>
				<div class="product-contact">
					<div class="col-md-4">
						<img src="img/icon-01.png"><span>NHÂN VIÊN PHỤ TRÁCH KINH DOANH</span>
						<ul>
							<li>Thiên Thanh</li>
							<li>0912.345.678</li>
							<li>cloud.info@vtc.vn</li>
						</ul>
						<img src="img/icon-04.png"><span>HỖ TRỢ KỸ THUẬT</span>
						<ul>
							<li>Thiên Thanh</li>
							<li>(08) 4450 3077</li>
						</ul>
						<img src="img/icon-05.png"><span>CHĂM SÓC KHÁCH HÀNG</span>
						<ul>
							<li>Thiên Thanh</li>
							<li>(08) 4450 3077</li>
						</ul>
					</div>
					<div class="col-md-4">
						<img src="img/icon-02.png"><span>TIN KHUYẾN MÃI</span>
						<div class="list-contact">
							<p><b>(06-11-2017)</b><a href="#"> Thông báo bảo trì hệ thống Windows Hosting trên Server shost016 và shost017</a></p>
							<p><b>(06-10-2017)</b><a href="#"> Thông báo bảo trì hệ thống Server</a></p>
							<p><b>(16-02-2017)</b><a href="#"> Thông báo Điều chỉnh biểu phí tên miền Việt Nam ".VN"</a></p>
							<p><b>(06-01-2017)</b><a href="#"> Thông báo bảo trì hệ thống Windows Hosting trên Server shost016 và shost017</a></p>
							<p><b>(01-01-2017)</b><a href="#"> Thông báo bảo trì hệ thống Windows Hosting trên Server shost016 và shost017</a></p>
							<div class="pull-right">
								<a href="#" class="btn btn-orange">Xem tất cả</a>
							</div>
						</div>
					</div>
					<div class="col-md-4">
						<img src="img/icon-03.png"><span>HÒM THƯ GÓP Ý</span><br>
						<div class="send-mail">
							<a href="#"><img src="img/icon-email.png"><span>Gửi tới ban giám đốc</span></a>
						</div>
						<div class="send-mail">
							<a href="#"><img src="img/icon-email1.png"><span>Gửi tới bộ phận chăm sóc khách hàng</span></a>
						</div>
					</div>
				</div>
			</div>
				</div>
			</div>
			<footer>
		<div class="tfoot">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
						<form action="" method="POST">
							<label for="send_mail">Đăng ký nhận  email</label>
							<div>
								<input type="text" class="form-control" id="send_mail" placeholder="Vui lòng ghi địa chỉ email tại đây!.....">
								<button type="submit" class="btn btn-primary">SUBMIT</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<div class="bfoot">
			<div class="container">
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
						<section class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
							<h4>Hosting Packages</h4>
							<ul class="list-group">
								<li class="list-group-item"><a href="">Web Hosting</a></li>
								<li class="list-group-item"><a href="">Reseller Hosting</a></li>
								<li class="list-group-item"><a href="">VPS Hosting</a></li>
								<li class="list-group-item"><a href="">Dedicated Servers</a></li>
								<li class="list-group-item"><a href="">Windows Hosting</a></li>
								<li class="list-group-item"><a href="">Cloud Hosting</a></li>
								<li class="list-group-item"><a href="">Linux Servers</a></li>
							</ul>
						</section>
						<section class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
							<h4>Our Products</h4>
							<ul class="list-group">
								<li class="list-group-item"><a href="">Website Builder</a></li>
								<li class="list-group-item"><a href="">Web Design</a></li>
								<li class="list-group-item"><a href="">Logo Design</a></li>
								<li class="list-group-item"><a href="">Register Domains</a></li>
								<li class="list-group-item"><a href="">Traffic Booster</a></li>
								<li class="list-group-item"><a href="">Search Advertising</a></li>
								<li class="list-group-item"><a href="">Email Marketing</a></li>
							</ul>
						</section>
						<section class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
							<h4>Hosting Packages</h4>
							<ul class="list-group">
								<li class="list-group-item"><a href="">About Us</a></li>
								<li class="list-group-item"><a href="">Press & Media</a></li>
								<li class="list-group-item"><a href="">News / Blogs</a></li>
								<li class="list-group-item"><a href="">Careers</a></li>
								<li class="list-group-item"><a href="">Awards & Reviews</a></li>
								<li class="list-group-item"><a href="">Testimonials</a></li>
								<li class="list-group-item"><a href="">Affiliate Program</a></li>
							</ul>
						</section>
						<section class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
							<h4>Follow Us</h4>
							<ul class="list-inline">
								<a href="" class="icon fa_icon"></a>
								<a href="" class="icon tw_icon"></a>
								<a href="" class="icon gg_icon"></a>
								<a href="" class="icon yt_icon"></a>
								<a href="" class="icon in_icon"></a>
							</ul>
						</section>
						<section class="col-xs-6 col-sm-6 col-md-4 col-lg-4">
							<h4>Resources</h4>
							<ul class="list-group">
								<li class="list-group-item"><a href="">How to Create a Website</a></li>
								<li class="list-group-item"><a href="">How to Transfer a Website</a></li>
								<li class="list-group-item"><a href="">Start a Web Hosting Business</a></li>
								<li class="list-group-item"><a href="">How to Start a Blog</a></li>

							</ul>
						</section>
						<section class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
							<h4>Support</h4>
							<ul class="list-group">
								<li class="list-group-item"><a href="">Product Support</a></li>
								<li class="list-group-item"><a href="">Contact Us</a></li>
								<li class="list-group-item"><a href="">Knowledge Base</a></li>
								<li class="list-group-item"><a href="">Tutorials</a></li>
							</ul>
						</section>
					</div>
					<div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 text-right" id="address">
						<img src="img/logo_footer.png">
						<ul class="list-unstyled">
							<li class="list-group-item">Toà nhà VTC,</li>
							<li class="list-group-item"> 23 Phố Lạc Trung, </li>
							<li class="list-group-item">Vĩnh Tuy, Hai Bà Trưng, Hà Nội</li>
							<li class="list-group-item">Phone: (04) 4450 5566</li>
							<li class="list-group-item">Mail: cloud.info@vtc.vn</li>
							<li class="list-group-item">View Directions</li>
							<img src="img/logo_icon.png" class="hidden-xs">
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div class="coppyright">
			<div class="container">
				<div class="row">
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<span>Copyright © 2015 ARKAHOST. All rights reserved.</span>
					</div>
					<div class="col-xs-6 col-sm-6 col-md-6 col-lg-6">
						<ul class="list-inline text-right">
							<li class="list-group-item"><a href="">Terms of Service | </a></li>
							<li class="list-group-item"><a href="">Privacy Policy | </a></li>
							<li class="list-group-item"><a href="">Site Map</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
			</footer>
		</div>
	</body>
</html>
