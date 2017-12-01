        <div class="user_pay">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="content">
                            <div class="container">
                                <div class="">
                                    <h3>THANH TOÁN ĐƠN HÀNG</h3>
                                </div>
                                <div class="">
                                    <div class="col-xs-12 col-sm-8 col-md-8 col-lg-8">
                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 domain-domain">
                                            <p class="customer-code">
                                                <?php echo $this->Html->image('icon-madonhang.png', array('class' => 'img'));?> Mã đơn hàng: <span><?php echo strtoupper($order_code); ?></span>
                                            </p>
                                            <?php
                                            $opt_url =  Router::url(array('controller' => 'carts', 'action' => 'ajax_otp_change_year_money'));
                                            ?>
                                            <!-- HERE IS THE SEARCH FILTER -->
                                            <script type="text/javascript">
                                                $(document).ready(function () {
                                                    $('.select_opt').bind("change keyup input", function () {
                                                        $.ajax({
                                                            //async: true,
                                                            //type: "POST",
                                                            //url: <?= $opt_url?>, // This one should sent data to index action of the typology controller for processing
                                                            //data: $this.id().serialize(), // 3 param for money, // get all the select opt id data..
                                                            // You will get all the select data..
                                                            //success: function (data) {
                                                            //    Console.log($this.id());
                                                            //    $(".select_opt").html(data);
                                                            //    $this.id().html(data);
                                                        }
                                                    });
                                                    event.preventDefault();
                                                    return false;
                                                });
                                                });
                                            </script>

                                            <table class="table domain-cart" id="ajax_table_data">
                                                <thead class="thead-cart">
                                                    <tr>
                                                        <th class="name-domain"> Dịch vụ </th>
                                                        <th> Số năm</th>
                                                        <th class="money"> Số tiền </th>
                                                    </tr>
                                                </thead>
                                                <tbody id="add_tr">
                                                    <?php
                                                        $modal = 1;
                                                        if (count($products) > 0)
                                                            foreach ($products as $order_detail): ?>
                                                                <tr id="<?php echo $order_detail['id'] ?>">
                                                                    <td>
                                                                        <h4><?php echo $order_detail['domain_name']; ?></h4>
                                                                        <p class="vps"><?php echo $order_detail['type']; ?></p>
                                                                    </td>
                                                                    <td>
                                                                        <h4></h4>
                                                                        <select name="product_year" class="select_opt" id="id_opt_<?=$order_detail['id'] ?>">
                                                                            <option value="<?php echo $order_detail['expired']; ?> ">
                                                                                <?php echo ($order_detail['expired'] == 0) ? 1 : $order_detail['expired']; ?> <?php echo ($order_detail['flg_expired'] == 1) ? "năm": "tháng"; ?>
                                                                            </option>
                                                                        </select>
                                                                        <p class="active hidden"><?php echo $order_detail['quantity']; ?></p>
                                                                    </td>
                                                                    <td>
                                                                        <h4></h4>
                                                                        <p id="id_opt_<?=$order_detail['id'] ?>"><?php echo number_format( $order_detail['price'],0,',','.' ); ?> VNĐ</p>
                                                                        <div class="product-removal hidden">
                                                                            <button type="button" class="remove-item" data-toggle="modal" data-target="#myModal<?php echo $modal ?>"> </button>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <?php
                                                                $modal++;
                                                            endforeach; ?>
                                                        <tr id="ajax_cart"> </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 domain-domain">

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 sale-code">
                                            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 sale-code hidden">
                                                <h6><span class="alert-info"></span></h6>
                                            </div>
                                            <div class="form-inline" id="ma-giam-gia">
                                                <label class="control-label" for="phone_gifcode"><span class="ma-giam-gia">Mã giảm giá:</span></label>
                                                <input class="form-control hidden" type="text" id="phone_gifcode" name="phone_gifcode" value="" placeholder="" >
                                                <button class="form-controlbtn btn-ok hidden" id="btn_gifcode_id"> Áp dụng </button>
                                            </div>
                                            <!-- AJAX update code status -->
                                            <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 sale-code" id="gifcode_daily_ajax_sum_money_id">
                                                <h6><span class="alert-info"></span></h6>
                                            </div>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 domain-domain payment">
                                            <table class="table total-money">
                                                <tbody>
                                                    <tr>
                                                        <td>Tạm tính (Chưa VAT):</td>
                                                        <td id="total-money"><?php echo number_format($total_money,0,',','.' ); ?> VNĐ</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Giảm giá:</td>
                                                        <td> -0 VNĐ</td>
                                                    </tr>
                                                    <tr>
                                                        <td>VAT (10%)</td>
                                                        <td id="total-money-vat"><?php echo number_format(round($total_money * 10 / 100),0,',','.' ); ?> VNĐ</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Thành tiền:</b></td>
                                                        <td id="total-money-finish">
                                                            <b><?php echo number_format(($total_money - round($total_money * 10 / 100)),0,',','.' ) ; ?> VNĐ</b></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="continue hidden">
                                                            <?php
                                                                echo $this->Html->link('Tiếp tục', array(
                                                                    'controller' => 'cart',
                                                                    'action' => 'checkout',
                                                                ),
                                                                    array('class' => 'btn btn-continue', 'escape' => false)
                                                                );
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="hidden">
                                                        <td colspan="2">Hoặc</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="buy hidden">
                                                            <?php
                                                                echo $this->Html->link('Mua thêm các dịch vụ', array(
                                                                    'controller' => 'cart',
                                                                    'action' => 'continuebuy',
                                                                ),
                                                                    array('class' => 'btn btn-buy', 'escape' => false)
                                                                );
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 support">
                                            <div>
                                                <h4>Nhân viên tư vấn : <?php echo $this->Html->image('icon-chat.png', array('class' => 'img'));?> </h4>
                                                <div class="row col-xs-12 col-sm-12 col-md-12 col-lg-12 sale-code" id="supporters_ajax_id">
                                                    <h6><span class="alert-success"></span></h6>
                                                </div>
                                                <div class="input-group hidden">
                                                    <input type="text" class="form-control" placeholder="" value="" name="phone_support" id="phone_support">
                                                    <button class="btn btn-nhap hidden" id="btn_supporters_ajax_id"> Cập nhật </button>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


        <?php

            //$data = json_encode($data);
            $route_support = Router::url(array('controller' => 'carts', 'action' => 'gif_code_daily_ajax_sum_money'));
            $str = $this->Html->scriptBlock('    
                    $(document).ready(function () {
                           $("#btn_gifcode_id").bind("click", function (event) {
                                var data = { 
                                     phone : $("#phone_gifcode").val(),
                                };
                                $.ajax({
                                     type: "POST",
                                     url: "' . $route_support . '",
                                     data: JSON.stringify(data),
                                     contentType: \'application/json\',
                                     cache: false,
                                }).done(function(data){
                                     console.log("Response", data);
                                });
                                return false;
                     });',
                    array('inline' => true));

            //-----------End Gif code---------//
            //-----------Support--------------//

            $route_support = Router::url(array('controller' => 'carts', 'action' => 'supporters_ajax'));
            $str = $this->Html->scriptBlock('
                   $(document).ready(function () {
                           $("#btn_supporters_ajax_id").bind("click", function (event) {
                                var data = { 
                                     phone : $("#phone_support").val(),
                                };
                                $.ajax({
                                      type: "POST",
                                      url: "' . $route_support . '",
                                      data: JSON.stringify(data),
                                      contentType: \'application/json\',
                                      cache: false,
                                })
                                .done(function(data){
                                     console.log("Response", data);
                                });
                                return false;
                           });
                   });',
                   array('inline' => true)
            );

            echo $this->Js->writeBuffer();

        ?>
        <script type="text/javascript">
            $(document).ready(function () {
                $("#btn_gifcode_id").bind("click", function (event) {
                    var data = {
                        phone : $("#phone_gifcode").val(),
                    };
                    $.ajax({
                        type: "POST",
                        url: "/carts/gif_code_daily_ajax_sum_money",
                        data: JSON.stringify(data),
                        contentType: 'application/json',
                        cache: false,
                    })
                    .done(function (resp) {
                         var data = JSON.parse(resp);
                         $("#gifcode_daily_ajax_sum_money_id").append('<h5><span class="alert-info">' + data.phone_gif + '</span></h5>');
                         console.log("done response", data);
                         console.log("data.phone_support",  data['phone_support']);
                    })
                    .success(function (resp, textStatus){
                         console.log("success response", resp);
                         console.log("success textStatus", textStatus);
                    });

                    return false;
                });

                $("#btn_supporters_ajax_id").bind("click", function (event) {
                    var data = {
                        phone: $("#phone_support").val(),
                    };
                    $.ajax({
                        type: "POST",
                        url: "/carts/supporters_ajax",
                        data: JSON.stringify(data),
                        contentType: 'application/json',
                        cache: false,
                    })
                        .done(function (resp) {
                            var data = JSON.parse(resp);
                            $("#supporters_ajax_id").append('<h5><span class="alert-success">' + data.phone_support + '</span></h5>');
                            console.log("done response", data);
                            console.log("data.phone_support",  data['phone_support']);
                        })
                        .success(function (resp, textStatus){
                            console.log("success response", resp);
                            console.log("success textStatus", textStatus);
                        });
                    return false;
                });
            });
        </script>
        <?php echo $this->Html->css('cart-finish'). "\n"; ?>
        <?php echo $this->Html->css('style_wallet'). "\n"; ?>
        <link href='http://fonts.googleapis.com/css?family=Ruge+Boogie' rel='stylesheet' type='text/css'>
        <!-- [Fix] CSS/HTML hiển thị tiền thanh toán trong Giỏ hàng -->
        <!-- [Fix] CSS/HTML hiển thị Mã giảm giá trong Giỏ hàng -->

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
                background: url(img/star_img.png) no-repeat top;
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

        <style type="text/css">
            .total-money > tbody > tr > td,
            .total-money > thead > tr > th {
                height: 55px;
            }
            .ma-giam-gia {
                font-size: 20px;
                font-weight: bold;
            }
            #ma-giam-gia input {
                width: 125px;
            }
            #phone_gifcode {
                margin-bottom: 0;
            }
            .total-money .btn-continue,
            .total-money .btn-buy,
            .total-money .btn-buy:hover {
                line-height: 40px;
            }
            .customer-code {
                font-size: 20px;
                background-color: #fff;
                height: auto;
                margin-bottom: 0px;
                padding-top: 16px;
                padding-left: 10px;
                padding-bottom: 40px;
            }
            .customer-code span {
                color: blue;
            }
            .domain-cart .thead-cart {
                font-weight: 500;
                font-size: 20px;
            }
            .domain-cart > tbody > tr > td > p {
                text-align: right;
            }
            .domain-cart > tbody > tr > td > p.vps {
                opacity: 0.7;
                text-align: left;
            }
            .domain-cart > tbody > tr > td {
                text-align: left;
                font-size: 18px;
                background-color: #fff;
                color: #2a363f;
            }
            div.cart th, div.cart td {
                background-color: #fff;
                color: #2a363f;
            }

            p {
                margin: 0 0 10px;
            }
            .domain-domain >.table > tbody > tr > td,
            .domain-domain >.table > tbody > tr > th,
            .domain-domain >.table > tfoot > tr > td,
            .domain-domain >.table > tfoot > tr > th,
            .domain-domain >.table > thead > tr > td,
            .domain-domain >.table > thead > tr > th {
                border-bottom: 2px dotted #eee;
            }

            .total-money > tbody > tr > td,
            .total-money > thead > tr > th {
                height: 50px;
                line-height: 50px;
                font-size: 16px;
                font-weight: 700;
            }
            th.money {
                text-align: right;
            }

        </style>








