<div class="content">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="head_panel" style="padding: 20px 4px;">
                    <h4 style="display: inline;"><i class="star"></i>Quản lý Cloud Server</h4>
                    <div class="dm_navi pull-right">
                        <a href="">Tên miền</a> |
                        <a href="">Hosting</a>
                    </div>
                    <div class="clearfix"></div>
                    <div class="reg" style="margin-top: 21px;margin-left:5px;">
                        <ul class="list-inline">
                            <li style="border:solid 1px #000;border-radius:6px;padding: 2px 20px;"><a href="">Đăng ký Cloud Server</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="search_advance">
                    <button class="btn btn-info" role="btn-seach" style="display: table;">
                        TÌM KIẾM NÂNG CAO
                    </button>
                    <div id="search" style="display: none;">

                        <form method="POST" action="">
                            <table class="table" style="width: 98%;margin: auto;">
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <label style="color: #f27636;">Hãy nhập một thông tin bất kì để thực hiện tìm kiếm</label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span>Gói dịch vụ</span>
                                        </td>
                                        <td>
                                            <select name="clsvselect" id="cl_sv_select" style="width: 100%;padding: 5px 10px;border:solid 1px #29363f;">
                                                <option selected="selected" value="">Lựa chọn tất cả</option>
                                                <?php if($data==NULL){ echo "<h2>Dada Empty</h2>"; }else{ $stt=1 ; $sto=1 ; foreach($data as $item){ ?>
                                                <option value="<?php echo $stt;$stt++; ?>">CLOUD SERVER
                                                    <?php echo $sto;$sto++; ?>
                                                </option>
                                                <?php }} ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ngày đăng ký:</td>
                                        <td>
                                            <div class="form_text">
                                                Từ
                                                <img src="img/calendar.png" style="margin-top: -2px;cursor: pointer;" role="reg_from">
                                            </div>
                                            <div class="select_date">
                                                <input type="text" name="reg_from" role="reg_from" id="reg_from">
                                            </div>
                                            <div class="form_text">
                                                Đến
                                                <img src="img/calendar.png" style="margin-top: -2px;cursor: pointer;" role="reg_to">
                                            </div>
                                            <div class="select_date">
                                                <input type="text" name="reg_to" role="reg_to" id="reg_to">
                                            </div>
                                            <button class="btn_clear" id="clear_reg" type="button">Clear</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Ngày hết hạn:</td>
                                        <td>
                                            <div class="form_text">
                                                Từ
                                                <img src="img/calendar.png" style="margin-top: -2px;cursor: pointer;" role="exp_from">
                                            </div>
                                            <div class="select_date">
                                                <input type="text" name="exp_from" role="exp_from" id="exp_from">
                                            </div>
                                            <div class="form_text">
                                                Đến
                                                <img src="img/calendar.png" style="margin-top: -2px;cursor: pointer;" role="exp_to">
                                            </div>
                                            <div class="select_date">
                                                <input type="text" name="exp_to" role="exp_to" id="exp_to">
                                            </div>
                                            <button class="btn_clear" type="button" id="clear_exp">Clear</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <button class="btn btn-success" type="submit" style="display: block;background-color: #f37636" id="search_btn">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
                <?php
          if($data==NULL){
             echo "<h2>Dada Empty</h2>";
          }else{
          ?>
          <div class="table-responsive">
            <table id="example" class="table table-striped">
              <thead>
                <tr>
                  <td bgcolor="#ebece9" role="th"></td>
                  <td bgcolor="#ebece9" role="th">STT</td>
                  <td bgcolor="#ebece9" role="th">Gói dịch vụ</td>
                  <td bgcolor="#ebece9" role="th">Tài khoản</td>
                  <td bgcolor="#ebece9" role="th">Ngày đăng ký</td>
                  <td bgcolor="#ebece9" role="th">Ngày hết hạn</td>
                  <td bgcolor="#ebece9" role="th">Trạng thái</td>
                  <td bgcolor="#ebece9" role="th">IP</td>
                  <td bgcolor="#ebece9" role="th">Thao tác</td>
                </tr>
              </thead>
              <tbody>
              <?php $stt = 1; ?>
              <?php
                foreach($data as $item){
              ?>
                <tr>
                      <td>
                          <input type="radio" name="1" value="1">
                      </td>
                      <td>
                          <?php echo $stt;$stt++; ?>
                      </td>
                      <td>
                          <?php echo ($item[ 'product_price'][ 'product_name'])?>
                      </td>
                      <td>
                          <?php echo ($item[ 'accounts'][ 'nickname'])?>
                          </p>
                      </td>
                      <td>
                          <?php $date= date_create($item[ 'cloudservers'][ 'startday']); echo date_format($date, "d/m/Y")?>
                      </td>
                      <td>
                          <?php $date= date_create($item[ 'cloudservers'][ 'endday']); echo date_format($date, "d/m/Y");?>
                      </td>
                      <td>
                          <?php if($item[ 'cloudservers'][ 'status']=='0' ){ echo "Đang sử dụng"; } else if($item[ 'cloudservers'][ 'status']=='1' ){ echo "Đang dừng sử dụng"; }else if($item[ 'cloudservers'][ 'status']=='2' ){ echo "Đã xóa"; } ?>
                      </td>
                      <td>
                          <?php echo ($item[ 'cloudservers'][ 'ip'])?>
                      </td>
                      <td>

                      </td>
                  </tr>
              <?php
                  }
                }
              ?>
              </tbody>
            </table>
          </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script src="http://code.jquery.com/jquery-2.0.3.min.js" data-semver="2.0.3" data-require="jquery"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.js"></script>
<link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
<script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
<script type="text/javascript">
  var table = $('#example').DataTable({
            'info':false,
            'searching':true,
        });
  $('#search_btn').on('click',function(event){
    event.preventDefault();
    $.ajax({
        url: "<?php echo $this->Html->url(array('controller'=>'ServiceManagements','action'=>'search')); ?>",
        type: 'POST',
        dataType: 'html',
        data: {
          action:'search',
          product_id: $('select[name="clsvselect"]').val(),
          reg_from:$('input[name=reg_from]').val(),
          reg_to:$('input[name=reg_to]').val(),
          exp_from:$('input[name=exp_from]').val(),
          exp_to:$('input[name=exp_to]').val(),
        }
      })
      .done(function(result) {
        $('#example').html(result);
      })
 });
   $('button[role=btn-seach]').on('click', function(event) {
        $('#search').slideToggle();
    });
   $('#reg_to').on('change', function() {
        var cmin = new Date($('#reg_from').val());
        var cmax = new Date($('#reg_to').val());
        if ($('#reg_from').val() == "") {
            alert("Xin mời nhập ngày bắt đầu !");
            $('#reg_to').val('');
        }
        if (cmin > cmax) {
            alert("Lỗi định dạng ! Mời nhập lại !");
            $('#reg_to').val('');
        } else {}
    });
   $('#exp_to').on('change', function() {
        var cmin = new Date($('#exp_from').val());
        var cmax = new Date($('#exp_to').val());
        if ($('#exp_from').val() == "") {
            alert("Xin mời nhập ngày bắt đầu !");
            $('#exp_to').val('');
        }
        if (cmin > cmax) {
            alert("Lỗi định dạng ! Mời nhập lại !");
            $('#exp_to').val('');
        } else {}
    });
   $('input[role="reg_from"],input[role="reg_to"],input[role="exp_to"],input[role="exp_from"]').datepicker({
        dateFormat: 'dd-mm-yy'
    });
    $('img[role="reg_from"]').on('click', function() {
        $('input[role="reg_from"]').datepicker('show');
    });
    $('img[role="reg_to"]').on('click', function() {
        $('input[role="reg_to"]').datepicker('show');
    });
    $('img[role="exp_from"]').on('click', function() {
        $('input[role="exp_from"]').datepicker('show');
    });
    $('img[role="exp_to"]').on('click', function() {
        $('input[role="exp_to"]').datepicker('show');
    });

    $('#clear_reg').on('click', function() {
        $('input[role="reg_from"],input[role="reg_to"]').val('');
    });
    $('#clear_exp').on('click', function() {
        $('input[role="exp_to"],input[role="exp_from"]').val('');
    });
</script>
<style type="text/css">
    td{
      border: 1px solid #bbb;
    }
    #example_filter {
        display: none;
    }
    button[role=btn-seach] {
        margin: 30px auto 20px auto;
        background-color: #f37636;
        border: 0;
        padding: 8px 130px;
    }
    .content a {
        color: #000;
        text-decoration: none;
    }    
    #search_btn {
        padding: 5px 20px;
        border-radius: unset;
        margin: 20px auto;
        border: none;
        font-weight: 600;
    }   
    span[role=sort] {
        width: 22px;
        height: 22px;
        display: inline-block;
        float: right;
        cursor: pointer;
        position: absolute;
        right: 2px;
        top: 8px;
        background: url("(img/sort_down.png')") no-repeat center;
    } 
    td[role=th] {
        position: relative;
        padding-right: 22px !important;
    } 
    .sort-up {
        background: url("img/sort_up.png") no-repeat center !important;
    }
    .top_pn a {
        text-decoration: none;
    }
    .content {
        background-color: #f3f3f3;
    }
    .content .row {
        margin-top: 10px;
        margin-bottom: 30px;
        padding-bottom: 60px;
        background-color: #fff;
    }
    .star {
        background: url("img/star_img.png") no-repeat top;
        display: inline-block;
        width: 27px;
        height: 27px;
        margin-bottom: -6px;
        margin-right: 8px;
    }
    .content h4 {
        margin-top: 30px;
        color: #f37636;
        text-transform: uppercase;
        font-weight: 600;
    }
    #search {
        border-radius: 7px;
        margin: 20px auto;
        width: 80%;
        border: solid 2px #f37636;
        padding-top: 10px;
    }
    #search tr td:nth-child(1) {
        width: 120px;
    }
    #search td {
        border: none;
        padding-left: 2% !important;
        vertical-align: middle;
    }
    #tbl-dm td {
        text-align: center;
    }
    .select_date,
    .form_text {
        vertical-align: middle;
        display: inline-block;
        float: left;
    }
    .select_date input,
    .select_date + button {
        margin-top: 8px;
    }
    .select_date input {
        text-align: center;
        border: solid 1px #29363f;
        width: 120px;
    }
    .form_text {
        margin-left: 6px;
    }
    .btn_clear {
        background-color: inherit;
        border: solid 1px #29363f;
        padding: 2px 18px;
        border-radius: 4px;
        margin-left: 15px;
    }
    #tbl-dm td[role="th"] {
        font-weight: 600;
    }
    #tbl-dm td {
        border: 1px solid #29363f;
    }
    span.nav_link {
        display: inline-block;
        width: 20px;
        height: 20px;
        border: solid 1px #28373e;
        border-radius: 3px;
        margin-bottom: -5px;
    }
    .nav_link img {
        display: block;
        margin: 2px auto 2px auto;
    }
</style>