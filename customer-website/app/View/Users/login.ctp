	<div class="body-login">
		<!-- <img src="img/bg-login.png"> -->

		<?php echo $this->Html->image('bg-login.png'); ?>
		<div class="container">	
			<div class="row">
				<div class="col-md-6 col-sm-6 login-form">
					<div>
						<h4><strong>ĐĂNG NHẬP</strong></h4>
						<p>Quý khách đăng nhập với thông tin tài khoản được cung cấp khi đăng ký sử dụng dịch vụ của TENTEN.VN</p>
						<p>Khi đăng nhập quý khách sẽ được gửi yêu cầu hỗ trợ kỹ thuật, xem thông tin những dịch vụ đã đăng ký, thay đổi password, chuyển quyền sở hữu....</p>
					</div>
					<div>
						<form action="" method="POST">
							<?php echo $this->Session->flash();?> 
							<div class="form-group">
								<label>Tên đăng nhập</label>
								<input type="text" name="data[Account][nickname]" tabindex="1" class="form-control" placeholder="" value="">
							</div>
							<div class="form-group">
								<label>Mật khẩu</label>
								<input type="password" name="data[Account][login_password]" tabindex="2" class="form-control" placeholder="">
							</div>
							<div class="form-group">
								<div class="col-md-6 col-sm-6 col-xs-6 check-line1">
									<input type="checkbox" tabindex="3" name="remember" id="remember">
									<label for="remember">Lưu thông tin</label>
								</div>
								<div class="col-md-6 col-sm-6 col-xs-6 check-line2">
									<a href="#">Quên mật khẩu</a>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-12 form-submit">
									<button type="submit"  tabindex="4" class="form-control btn-submit" class="btn"><b>ĐĂNG NHẬP</b></button>
								</div>
							</div>
						</form>
					</div>
				</div>
				<div class="col-md-6 col-sm-6 login-contact">
					
					<?php echo $this->Html->image('logo-24h.png'); ?>	
					<div class="contact">
						<div class="list-contact">
							<!-- <b> -->
							<?php foreach ($data as $item)  {?>	
							<h5><b><?php echo $item['Supporter']['position'] ?></b></h5>
							<h6><b><?php echo $item['Supporter']['name'] ?></b></h6>
							<span><b><?php echo $item['Supporter']['phone'] ?></b></span>
							<?php } ?>
						<!-- </b> -->
						</div>
					</div>
				</div>
			</div>
		</div>		
	</div>