<!--
    tue.phpmailer@gmail.com
    Cập nhật Ajax giỏ hàng
-->

<td>
    <h4><?php echo $cart['product']['product_name']; ?></h4>
    <p class="vps"><?php echo $cart['product']['type']; ?></p>
</td>
<td>
    <select name="product_year" class="select_opt" id="id_opt_<?=$cart['product']['id'] ?>">
        <option> 1 năm</option>
        <option> 2 năm</option>
        <option> 3 năm</option>
        <option> 4 năm</option>
        <option> 5 năm</option>
    </select>
    <p class="active hidden"><?php echo $cart['product']['quantity']; ?></p>
</td>
<td>
    <p id="id_opt_<?=$cart['product']['id'] ?>">
        <?php echo number_format($cart['product']['price'],0,',','.'); ?> VNĐ
    </p>

    <div class="product-removal">
        <button type="button" class="remove-item" data-toggle="modal"
                data-target="#myModal<?=$cart['product']['id'] ?>">
        </button>
    </div>

    <div id="myModal<?=$cart['product']['id'] ?>" class="modal fade" role="dialog">
        <?php
        echo $this->Form->create(null, array('type' => 'POST',
                //echo $this->Form->create(null, array('type' => 'POST',
                //'url' => '/cart/update',
                'url' => array('controller' => 'carts', 'action' => 'remove'),
                'id' => "modal_form_id_{$cart['product']['id']}",
                'name' => "modal_form_id_{$cart['product']['id']}",
                'class' => '',
                'role' => 'form',
            )
        );

        echo $this->Form->input('', array(
            'id' => "id_odetail_product_{$cart['product']['id']}",
            'type' => 'hidden',
            'name' => 'id_odetail_product',
            'value' => $cart['product']['id'],
        ));

        ?>
        <div class="modal-dialog">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <h4>Bạn muốn xóa dịch vụ này? </h4>
                </div>
                <div class="modal-body">
                    <button type="submit" class="btn btn-success" id="remove-product">Đồng ý </button>
                    <button type="submit" class="btn btn-danger" data-dismiss="modal">Hủy </button>
                </div>
            </div>
        </div>
        <?php echo $this->Form->end(); ?>
    </div>

</td>

<?php //echo $content; ?>