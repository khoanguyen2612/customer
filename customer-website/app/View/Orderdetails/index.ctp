  
<div class="his_trans">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <a href="" class="pull-right"><img src="img/excel_icon.png"></a>
          <div class="clearfix"></div>
          <h4><i></i>Lịch sử giao dịch </h4>
          <div class="history_panel">
            <ul class="list-inline"  id="date_filter">
              <li>
                 <span id="date-label-from" class="date-label">Từ ngày</span><input class="date_range_filter1 date" type="text" id="datepicker_from" />
              </li>
              <li>
                <span id="date-label-to" class="date-label">Đến ngày<input class="date_range_filter2 date" type="text" id="datepicker_to" />
              </li>
              <li>
                Loại giao dịch
                <select name="category" id="category">
                  <option value="">Tất cả</option>
                  <?php 
                   foreach($data['Orderdetail'] as $item){
                      echo '<option value="'.$item['Orderdetail']['request_flg'].'">'.$item['Orderdetail']['request_flg'].'</option>';
                   }
                  ?>
                </select>
              </li>
              <li>
                Nội dung <input type="text" name="query" class="content">              
              </li>
              <li>
                <a href="" type="submit" class="btn btn-info" name="searchbtn" id="searchbtn"><img src="img/search_icon.png">Tìm kiếm</a>
              </li>
            </ul>
          </div>
          <?php
          if($data==NULL){
             echo "<h2>Dada Empty</h2>";
          }else{
          ?>
          <div class="table-responsive">
            <table id="" class="table table-bordered">
              <thead>
                <tr>
                  <th>STT</th>
                  <th>Tên dịch vụ</th>
                  <th>Loại giao dịch</th>
                  <th>Chi tiết giao dịch</th>
                  <th>Ngày giao dịch</th>
                  <th>Số tiền giao dịch</th>
                  <th>Còn lại</th>
                </tr>
              </thead>
              <tbody>
              <?php
                foreach($data['Orderdetail'] as $item){
              ?>
                <tr>
                  <td><?php echo ($data['Account']['Account.id'])?></td>
                  <td><?php echo ($item['Orderdetail']['domain_name'])?></td>
                  <td><?php echo ($item['Orderdetail']['request_flg'])?></td>
                  <td><?php echo ($item['Orderdetail']['domain_name'])?></td>
                  <td><?php $date = date_create($item['Orderdetail']['created_date']);
                            echo date_format($date,"d/m/Y");?></td>
                  <td><?php echo ($item['Orderdetail']['price'])?></td>
                  <td><?php echo ($data['Account']['Account.credit'])?></td>
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
  <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
  <link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
<script type="text/javascript">
  // $(document).ready(function(){
  //     $.datepicker.setDefaults({
  //       dateFormat:'d/m/yy'
  //     })
      $(function(){
        $(".date_range_filter1").datepicker();
        $(".date_range_filter2").datepicker();
      });
  //     $('.date_range_filter2').change(function() {
  //       var date_range_filter1 = $('.date_range_filter1').val();
  //       var date_range_filter2 = $('.date_range_filter2').val();
  //       if (date_range_filter1 != '' && date_range_filter2 != '') {
  //         $.ajax({
  //           url: 'OrderDetails/ajax',
  //           type: 'POST',
  //           data: {date_range_filter1: 'date_range_filter1',
  //                 date_range_filter2: 'date_range_filter2'
  //               },
  //           success:function(data){
  //             $('.table-bordered').html(data);
  //           }
  //         });
  //       }else{
  //         alert("Làm phiền nhập ngày");
  //       }
  //     });
  // });

</script>