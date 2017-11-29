
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
            <div class="col-lg-12">
                <h4><i class="star"></i>Hình thức thanh toán</h4>

                <?php
                echo $this->Form->create(null, array('type' => 'POST',
                        'url' => array('controller' => 'carts', 'action' => 'vtc_payment'),
                        'id' => "form2",
                        'name' => "form2",
                        'class' => 'form',
                        'role' => 'form',
                    )
                );
                ?>

                <div class="hidden">
                    <input name="txtOrderID" type="text" value="<?php echo $order_code ?>" id="txtOrderID"/>
                    <input name="txtCustomerFirstName" type="text" value="Nguyễn Tài" id="txtCustomerFirstName"/>
                    <input name="txtCustomerLastName" type="text" value="Tuệ" id="txtCustomerLastName"/>
                    <input name="txtBillAddress" type="text" value="Hà Nội" id="txtBillAddress"/>
                    <input name="txtCity" type="text" value="Hà Nội" id="txtCity"/>
                    <input name="txtCustomerEmail" type="text" value="nguyentaitue@codelovers.vn" id="txtCustomerEmail"/>
                    <input name="txtCustomerMobile" type="text" value="<?php echo "0916298481" ?>" id="txtCustomerMobile"/>
                    <input name="txtParamExt" type="text" value="" id="txtParamExt"/>
                    <input name="txtParamLanguage" type="text" value="vi" id="txtParamLanguage"/>
                    <input name="txtUrlReturn" type="text" value="<?php echo "http://vtc.codelovers.vn/carts/finish/" ?>" id="txtUrlReturn"/>
                    <input name="txtSecret" type="text" value="<?php echo "VtcPay_Codelovers_2017" ?>" id="txtSecret"/>
                    <input name="txtTotalAmount" type="text" value="<?php echo round($total_payment) ?>" id="txtTotalAmount"/>
                    <input name="txtCurency" type="text" value="VND" id="txtCurency"/> &nbsp;<i>VND/USD</i>
                    <input name="txtWebsiteID" type="text" value="10059" id="txtWebsiteID"/>
                    <input name="txtReceiveAccount" type="text" value="<?php echo "0916298481" ?>" id="txtReceiveAccount"/>
                    <input name="txtDescription" type="text" value="<?php echo $order_code ?> services" id="txtDescription"/>
                </div>

                <?php echo $this->Form->end(); ?>


                <p id="pay_ol" class=""> THANH TOÁN TRỰC TUYẾN </p>

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

                <h4> <i class="star"></i>SỐ DƯ TIỀN NẠP </h4>

                <div class="money_inf">
                    <p>
                        <strong>Số tiền được nạp: </strong>
                        <span><?php echo number_format((int) $add_curent_money,0,',','.' ); ?> VNĐ</span>
                    </p>
                    <p>
                        <strong>Tổng số dư: </strong>
                        <span> VNĐ</span>
                    </p>
                </div>

                <div class="text-center">
                    <a class="text pay-btn" id="btnContinue" data-i18n="website.continue" onClick='submitDetailsForm()' >Thực hiện thanh toán online</a>
                </div>

            </div>
        </div>
    </div>
</div>


<?php  echo $this->Html->css('customer_home.css') . "\n"; ?>

<style type="text/css">

    .user_pay{
        background-color: #f3f3f3;
    }

    .money_inf p{
        margin-bottom: 20px;
    }

    .money_inf{
        margin-top: 50px;
        margin-bottom: 50px;
    }

    .user_pay strong{
        color: #0060AF;
        font-size: 18px;
        margin-left: 5%;
    }

    .user_pay span{
        margin-left: 8%;
        font-weight: 600;
        font-size: 18px;
    }

    .user_pay .row{
        margin-top: 10px;
        margin-bottom: 30px;
        padding-bottom: 60px;
        background-color: #fff;
    }

    #pay-btn{
        text-decoration: none;
        margin-top: 20px;
        width: 50%;
        background-color: #f37636;
        color: #fff;
        border-radius: 6px;
        display: inline-block;
        padding: 10px;
        font-size: 20px;
        font-weight: 600;
    }

    /** fix css **/
    .pay-btn{
        text-decoration: none;
        margin-top: 20px;
        width: 50%;
        background-color: #f37636;
        color: #fff;
        border-radius: 6px;
        display: inline-block;
        padding: 10px;
        font-size: 20px;
        font-weight: 600;
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


<style type="text/css">

    /* reset color in link text */
    a {
        color: inherit; /* blue colors for links too */
        text-decoration: inherit; /* no underline */
    }

    a:hover {
        cursor: pointer;
        color: inherit; /* blue colors for links too */
        color: white; /* blue colors for links too */
        text-decoration: inherit; /* no underline */
        text-decoration: none; /* no underline */
    }

</style>

<?php //echo $this->element('sql_dump'); ?>




