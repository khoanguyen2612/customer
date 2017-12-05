
<div class="logo_div">
	<div class="container">
		<div class="row">
			<div class="col-md-12 col-lg-12">
				<div class="col-lg-6 col-md-4">
					<?php echo $this->Html->image('vtc-logo.png',array('class'=>'logo', 'url' => array('controller' => 'home', 'action' => 'index'))); ?>
				</div>
                    <!--tue.phpmailer@gmail.com
                    add infor for menu home-->
					<div class="col-lg-6 col-md-8">
						<div class="cart-header col-md-offset-6 col-md-6 col-sm-offset-6 col-sm-6 col-xs-12 pull-right">
							<i class="fa fa-cart-plus" style="color:#fff;font-size:20px;"><?php echo $this->Html->image('cart_icon.png', array('class'=>'') ); ?></i>
                            <span> Bạn đang có: <?php echo $total_product; ?> sản phẩm</span>
						</div>
						<div class="user-header col-md-12">
							<p>Xin chào <b> <?php echo $name; ?></b> !</p>
							<a href="#"><b>Danh sách khách hàng</b></a>
							|<a href="#">Thông tin tài khoản</a>
							|<a href="#">Thay đổi mật khấu</a>
							|<a href="../users/logout"><b>Thoát</b></a>
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
					<span>Đại lý cấp: </span> 0 <br>
					<span>Tổng tiền đã nạp: <big>0 đ</big></span>
				</div>
				<div class="col-md-3 text-center">
					<span>Số dư tài khoản: <big>0 đ</big></span>
				</div>
				<div class="col-md-3 text-center bg-1a70b7">
					<span>Điểm thưởng: <big>0</big></span>
				</div>

				<div class="col-md-3 text-center">
                    <?php
                    echo $this->Form->create('Wallet', array('type' => 'POST',
                            'url' => array('controller' => 'Wallet', 'action' => 'index'),
                            'id' => "form_wallet",
                            'name' => "form_wallet",
                            'class' => 'form',
                            'role' => 'form',
                            'div' => false,
                        )
                    );
                    ?>
                    <?php
                        echo $this->Form->input('Nạp tiền',
                            array(
                                'id' => "id_submit",
                                'name' => "submit",
                                'value' => "Nạp tiền",
                                'class' => 'btn',
                                'type' => 'button',
                                'label' => false,
                                'div' => false,
                             )
                        );
                    ?>
                    <?php echo $this->Form->end(); ?>
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
                <li>
                    <a href="<?php echo $this->Html->url(array('controller' => 'home', 'action' => 'index'), true); ?>" style="padding: 9px;">
                        <i class="fa fa-home" style="color:#fff;font-size:32px;"></i>
                    </a>
                </li>
                <li  class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Đăng ký dịch vụ</a>
                </li>
                <li  class="dropdown">
                    <a href="<?php echo $this->Html->url(array('controller' => 'OrderHistorys', 'action' => 'index'), true); ?>">Lịch sử giao dịch</a>
                </li>
                <li  class="dropdown"><a href="#">Bảng giá dịch vụ</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Quản lý dịch vụ</a>
                    <ul class="dropdown-menu">
                        <li>
                            <a href="<?php echo $this->Html->url(array('controller' => 'DomainsManager', 'action' => 'index'), true); ?>">Quản Lý Tên Miền</a>
                        </li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#">Đang chờ xử lý</a></li>
            </ul>
        </div>
    </div>
    </nav>

    <!--// The above will output fast message for Note!-->
    <!--// tue.phpmailer@gmail.com //-->
    <div id="flashMessage" class="message alert">
        <code><?php echo $this->Session->flash(); ?></code>
    </div>
    <script type="text/javascript">
        $(document).ready(function(){
            var message = $("#flashMessage" ).contents().find("code").text();
            if ( message == '' || message.length == 0) {
                $("#flashMessage").css('display', 'none');
            }
            console.log('flashMessage: ' + message);
        })
    </script>






