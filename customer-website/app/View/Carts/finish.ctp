
    <div class="cart">
        <div class="process">
            <div class="container">
                 <?php echo $this->Html->image('button_step5.png', array('class'=>'img-responsive')); ?>
            </div>
        </div>

            <div class="content">
                <div class="container">
                    <div class="row text-center">
                        <div class="cart-info">
                            <!--// The above will output fast message for Note!-->
                            <div id="flashMessage" class="message alert">
                                <code><?php echo $this->Session->flash(); ?></code>
                            </div>
                        </div>
                    </div>

                    <?php if (count($this->Session->flash()) == 0) { ?>
                        <form>
                            <div class="row">
                                <h3>HOÀN TẤT</h3>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="row">
                                    <p class="congra "><?php echo $this->Html->image('icon-wonder.png', array('class' => ''));?> Tuyệt vời! Bạn đã đăng ký đặt hàng thành công.</p>
                                </div>
                            </div>
                            <div class="domain-completed">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 custom-info">
                                        <table class="table table-bordered domain-custom-info">
                                            <thead>
                                            <tr>
                                                <th colspan="2"><?php echo $this->Html->image('icon-info.png', array('class' => 'icon-info'));?> THÔNG TIN KHÁCH HÀNG </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Tên khách hàng</td>
                                                <td class="name-customer"><?php echo $u_name; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Số điện thoại:</td>
                                                <td><?php echo $phone; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Email: </td>
                                                <td><?php echo $email; ?></td>
                                            </tr>
                                            <tr>
                                                <td>CMND: </td>
                                                <td><?php echo $cmtnd; ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 cart-info">
                                        <table class="table table-bordered domain-cart-info">
                                            <thead>
                                            <tr>
                                                <th colspan="2"><?php echo $this->Html->image('icon-info.png', array('class' => 'icon-info'));?>  THÔNG TIN ĐƠN HÀNG </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <td>Mã đơn hàng: </td>
                                                <td class="code-cart"> <?php echo $order_code; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Ngày đặt hàng : </td>
                                                <td><?php echo $date_day; ?></td>
                                            </tr>
                                            <tr>
                                                <td>Giờ đặt hàng: </td>
                                                <td> <?php echo $time_h; ?></td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                <p class="info-domain"><?php echo $this->Html->image('icon-info.png', array('class' => 'icon-info'));?>  THÔNG TIN DỊCH VỤ </p>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 service-info">
                                <table class="table table-bordered domain-service-info text-center">
                                    <thead>
                                        <tr>
                                            <th>STT</th>
                                            <th>Dịch vụ</th>
                                            <th>Số lượng</th>
                                            <th>Số tiền</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $stt = 1;
                                    if (count($products) > 0)
                                    foreach ($products as $order_detail): ?>
                                        <tr>
                                            <td><?=$stt ?></td>
                                            <td>
                                                <h4><?php echo $order_detail['domain_name']; ?></h4>
                                                <p class="ten-mien"><?php echo $order_detail['type']; ?></p>
                                            </td>
                                            <td><?php echo $order_detail['quantity']; ?></td>
                                            <td>
                                                <p class="line-through"><?php echo number_format( $order_detail['discount'],0,',','.') ; ?> VNĐ</p>
                                                <h4><?php echo number_format( $order_detail['price'],0,',','.') ; ?> VNĐ</h4>
                                            </td>
                                        </tr>
                                        <?php
                                        $stt++;
                                    endforeach; ?>
                                    </tbody>
                                </table>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6"></div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 service-money">
                                    <table class="table service-total-money">
                                        <tbody>
                                            <tr>
                                                <td>Tổng cộng(Chưa VAT): </td>
                                                <td> <?php echo number_format( $total_money,0,',','.'); ?> VNĐ</td>
                                            </tr>
                                            <tr>
                                                <td>Số tiền giảm giá: </td>
                                                <td> - <?php echo number_format( ($total_money - $total_payment),0,',','.'); ?> VNĐ</td>
                                            </tr>
                                            <tr>
                                                <td> VAT: </td>
                                                <td><?php echo number_format( $total_vat,0,',','.'); ?> VNĐ</td>
                                            </tr>
                                            <tr>
                                                <td> Mã giảm giá: </td>
                                                <td></td>
                                            </tr>
                                            <tr class="into-money">
                                                <td>Thành tiền:</td>
                                                <td class="into-total"> <?php echo number_format( $total_payment,0,',','.'); ?> VNĐ</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8 domain-cart-payments">
                                    <h3><?php echo $this->Html->image('icon-info.png', array('class' => 'icon-info'));?>  HÌNH THỨC THANH TOÁN </h3>
                                    <div class="something">
                                        <h4>Chuyển khoản</h4>
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td class="company-name"> Tên tài khoản:</td>
                                                <td> Công ty TNHH Một Thành Viên Viễn Thông Số VTC</td>
                                            </tr>
                                            <tr>
                                                <td class="company-address"> Địa chỉ: </td>
                                                <td>65 Lạc Trung, Phường Vĩnh Tuy, Quận Hai bà Trưng, TP.Hà Nội</td>
                                            </tr>
                                            <tr>
                                                <td class="code-tax">Mã số thuế: </td>
                                                <td>0105431099</td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 print-cart">
                                    <button type="submit" class="btn btn-print-cart" onclick="return false">In đơn hàng</button>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 save-cart">
                                    <button type="submit" class="btn btn-save-cart" onclick="return false"> Lưu</button>
                                </div>
                            </div>

                        </form>

                    <?php } ?>

                </div>
            </div>




    </div>

    <?php //echo $this->element('sql_dump'); ?>




