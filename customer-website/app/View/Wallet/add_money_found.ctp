
    <div class="user_pay">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h4><i class="star"></i>Hình thức thanh toán</h4>
                    <?php
                        echo $this->Form->create(null, array('type' => 'POST',
                                'url' => array('controller' => 'Wallet', 'action' => 'vtc_payment'),
                                'id' => "form_vtc_payment",
                                'name' => "form_vtc_payment",
                                'class' => 'form',
                                'role' => 'form',
                            )
                        );

                        $order_code = 'MSHĐ_A11770449Z1892938'. rand(10, 10000);
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
                        <input name="txtUrlReturn" type="text" value="<?php echo "/wallet/finish/" ?>" id="txtUrlReturn"/>
                        <input name="txtSecret" type="text" value="<?php echo "VtcPay_Codelovers_2017" ?>" id="txtSecret"/>
                        <input name="txtTotalAmount" type="text" value="<?php echo round($add_current_money) ?>" id="txtTotalAmount"/>
                        <input name="txtCurency" type="text" value="VND" id="txtCurency"/> &nbsp;<i>VND/USD</i>
                        <input name="txtWebsiteID" type="text" value="10059" id="txtWebsiteID"/>
                        <input name="txtReceiveAccount" type="text" value="<?php echo "0916298481" ?>" id="txtReceiveAccount"/>
                        <input name="txtDescription" type="text" value="<?php echo $order_code ?> services" id="txtDescription"/>
                    </div>

                    <?php echo $this->Form->end(); ?>

                    <p id="pay_ol" class=""> THANH TOÁN TRỰC TUYẾN </p>
                    <script language="javascript" type="text/javascript">
                        function submitDetailsForm() {
                            $("#form_vtc_payment").submit();
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
                            <span><?php echo number_format((int) $add_current_money,0,',','.' ); ?> VNĐ</span>
                        </p>
                        <p>
                            <strong>Tổng số dư: </strong>
                            <span>0 VNĐ</span>
                        </p>
                    </div>

                    <div class="text-center">
                        <a class="text pay-btn" id="btnContinue" data-i18n="website.continue" onClick='submitDetailsForm()' >Thực hiện thanh toán online</a>
                    </div>

                </div>
            </div>
        </div>
    </div>

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

    <!-- TueNT -->
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






