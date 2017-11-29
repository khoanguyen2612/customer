<div class="logo_div">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-lg-12">

                <div class="col-lg-6 col-md-4">
                    <?php // echo $this->Html->image('vtc-logo.png', array('class' => 'logo')); ?>
                </div>

                <div class="col-lg-6 col-md-8">

                    <div class="cart-header col-md-offset-6 col-md-6 col-sm-offset-6 col-sm-6 col-xs-12 pull-right">
                        <i class="fa fa-cart-plus" style="color:#fff;font-size:20px;"></i><span> Bạn đang có: <?php echo $n_item_cart; ?> sản phẩm</span>
                    </div>

                    <div class="user-header col-md-12">
                        <p>Xin chào <b> <?php echo $name; ?> </b>!</p>
                        <a href="#">
                            <b>Danh sách khách hàng</b>
                        </a>
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
                <span>Đại lý cấp: </span>0<br>
                <span>Tổng tiền đã nạp: <big>0 VNĐ</big></span>
            </div>
            <div class="col-md-3 text-center">
                <span>Số dư tài khoản: <big>0 VNĐ</big></span>
            </div>
            <div class="col-md-3 text-center bg-1a70b7">
                <span>Điểm thưởng: <big>0</big></span>
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
                <li>
                    <a href="#">
                        <i class="fa fa-home" style="color:#fff;font-size:20px;"></i>
                    </a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Đăng ký dịch vụ</a>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                       aria-expanded="false">Lịch sử giao dịch</a>
                </li>
                <li class="dropdown">
                    <a href="#">Bảng giá dịch vụ</a>
                </li>
                <li class="dropdown">
                    <a href="#">Quản lý dịch vụ</a>
                </li>
                <li class="dropdown">
                    <a href="#">Đang chờ xử lý</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="user_pay">
    <div class="container">
        <div class="row">

            <?php
            echo $this->Form->create('Payment', array('type' => 'POST',
                    'url' => array('controller' => 'carts', 'action' => 'accept_payment'),
                    'id' => "form2",
                    'name' => "form2",
                    'class' => 'form',
                    'role' => 'form',
                )
            );
            ?>

            <div class="col-lg-12">

                <h4><i class="star"></i>Số tiền cần nạp thêm</h4>
                <?php
                echo $this->Form->input('add_curent_money', array(
                        'id' => "add_curent_money",
                        //'name' => "add_curent_money",
                        'class' => '',
                        'type' => 'text',
                        'value' => '',
                        'label' => false,
                    )
                );
                ?>

            </div>

            <div class="col-lg-12">
                <h4><i class="star"></i>Chọn phương thức thanh toán</h4>
                <p class="title"> Bạn vui lòng chọn một trong số các hình thức thanh toán bên dưới:</p>
            </div>

            <div class="col-lg-12">

                <?php echo $this->Form->end(); ?>

                <style type="text/css">

                    /* reset color in link text */
                    a {
                        color: inherit; /* blue colors for links too */
                        text-decoration: inherit; /* no underline */
                    }

                    a:hover {
                        cursor: pointer;
                        color: inherit; /* blue colors for links too */
                        text-decoration: inherit; /* no underline */
                    }

                </style>

                <p id="pay_ol" class="">
                    <a class="text" id="btnContinue" data-i18n="website.continue" onClick='submitDetailsForm()' >THANH TOÁN TRỰC TUYẾN </a>
                </p>

                <script language="javascript" type="text/javascript">
                    function submitDetailsForm() {
                        $("#form2").submit();
                    }
                </script>

                <ul class="list-inline banklist text-center">
                    <li>
                        <a href="#"><?php echo $this->Html->image('paypal.png', array('class' => 'img-responsive')); ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $this->Html->image('vietcom.png', array('class' => 'img-responsive')); ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $this->Html->image('techcom.png', array('class' => 'img-responsive')); ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $this->Html->image('viettin.png', array('class' => 'img-responsive')); ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $this->Html->image('vib.png', array('class' => 'img-responsive')); ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $this->Html->image('hdbank.png', array('class' => 'img-responsive')); ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $this->Html->image('agri.png', array('class' => 'img-responsive')); ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $this->Html->image('bidv.png', array('class' => 'img-responsive')); ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $this->Html->image('donga.png', array('class' => 'img-responsive')); ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $this->Html->image('baokim.png', array('class' => 'img-responsive')); ?></a>
                    </li>
                    <li>
                        <a href="#"><?php echo $this->Html->image('soha.png', array('class' => 'img-responsive')); ?></a>
                    </li>
                </ul>

            </div>
        </div>
    </div>
</div>

<?php  echo $this->Html->css('customer_home.css') . "\n"; ?>

<style type="text/css">

    .user_pay{
        background-color: #f3f3f3;
    }

    .user_pay .row{
        margin-top: 10px;
        margin-bottom: 30px;
        padding-bottom: 60px;
        background-color: #fff;
    }

    .star{
        background: url(<?php echo $this->Html->url('/img/star_img.png');?>) no-repeat top;
        display: inline-block;
        width: 27px;
        height: 27px;
        margin-bottom: -6px;
        margin-right: 8px;
    }

    .user_pay h4{
        margin-top: 30px;
        color: #f37636;
        text-transform: uppercase;
        font-weight: 600;
    }

    .user_pay p.title{
        margin-top:20px;
        padding-left: 35px;
        font-size: 18px;
        color: #0060af;
    }

    .user_pay input[type=text]{
        border:solid 1px #29353f;
        width: 50%;
        margin: auto;
        display: block;
        height: 45px;
        padding-left: 10px;
        margin-top: 30px;
        margin-bottom: 20px;
    }

    #pay_ol{
        font-weight: 600;
        font-size: 18px;
        border-radius: 4px;
        padding: 8px 0px;
        margin: 68px auto;
        text-align: center;
        width: 40%;
        background-color: #0060af;
        font-size: 18px;
        color: #fff;
    }

</style>


<?php //echo $this->element('sql_dump'); ?>



