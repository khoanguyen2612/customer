<link rel="stylesheet" type="text/css" href="css/storage_service.css">
<div class="his_trans">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <a href="" class="pull-right"><img src="img/excel_icon.png"></a>
          <div class="clearfix"></div>
          <h4><i></i>Lịch sử giao dịch </h4>
          <div class="history_panel">
            <form>
              <ul class="list-inline"  id="date_filter">
              <li>
                 <span id="date-label-from" class="date-label">Từ ngày</span><input name="min" class="min" id="min" type="text" placeholder="Ngày/Tháng/Năm" required>
              </li>
              <li>
                <span id="date-label-to" class="date-label">Đến ngày<input name="max" class="max" id="max" type="text" placeholder="Ngày/Tháng/Năm" required>
              </li>
              <li>
                Loại giao dịch
                <select id="dropdown2">
                  <option value="">Tất cả</option>
                  <option value="Mua domain">Mua domain</option>
                  <option value="Gia hạn domain">Gia hạn domain</option>
                  <option value="Mua hosting">Mua hosting</option>
                  ?>
                </select>
              </li>
              <li>
                Nội dung <input type="text" id="myInput" class="outsideBorderSearch" placeholder="Nhập tìm " title="Type in a name">        
              </li>
              <li>
                <a href="" type="submit" class="btn btn-info" name="searchbtn" id="search"><img src="img/search_icon.png">Tìm kiếm</a>
              </li>
              </ul>
            </form>
          </div>
          <?php
          if($data==NULL){
             ?>
              <table id="example" class="table table-striped">
              <thead>
                <tr>
                  <th>STT</th>
                  <th class="left">Tên dịch vụ</th>
                  <th class="left">Loại giao dịch</th>
                  <th class="left">Chi tiết giao dịch</th>
                  <th>Ngày giao dịch</th>
                  <th>Số tiền giao dịch</th>
                  <th>Còn lại</th>
                </tr>
              </thead>
               <tbody>
                <tr>
                  <td colspan="9" class="datanull"><h2>Không có dữ liệu</h2></td>
                </tr>
               </tbody>
             <?php
          }else{
          ?>
          <div class="table-responsive">
            <table id="example" class="table table-striped">
              <thead>
                <tr>
                  <th>STT</th>
                  <th class="left">Tên dịch vụ</th>
                  <th class="left">Loại giao dịch</th>
                  <th class="left">Chi tiết giao dịch</th>
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
                  <td><?php echo ($item['Orderdetail']['id'])?></td>
                  <td class="left"><p><?php echo ($item['Orderdetail']['domain_name'])?></p></td>
                  <td class="left"><p><?php echo ($item['Orderdetail']['request_flg'])?></p></td>
                  <td class="left"><p><?php echo ($item['Orderdetail']['domain_name'])?></p></td>
                  <td><?php $date = date_create($item['Orderdetail']['created_date']);
                            echo date_format($date,"d/m/Y");?></td>
                  <td><?php echo number_format($item['Orderdetail']['price'],0,',','.')?></td>
                  <td><?php echo number_format($data['Account']['Account.credit'],0,',','.')?></td>
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
<style type="text/css">
  #example_filter{
    display: none;
  }
  .dataTables_length{
    display: none;
  }
  .left p{
    text-align: left;
</style>
<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="http://code.jquery.com/jquery-2.0.3.min.js" data-semver="2.0.3" data-require="jquery"></script>
  <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.js"></script>
  <link rel="stylesheet" type="text/css" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.13/css/jquery.dataTables.min.css">
    <script type="text/javascript" src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.13/js/jquery.dataTables.min.js"></script>
  <script type="text/javascript">

  $("#min").datepicker({dateFormat: 'dd-mm-yy'});
  $("#max").datepicker({dateFormat: 'dd-mm-yy'});
  $('#max').on('change', function () {
    var cmin = new Date($('#min').val());
    var cmax = new Date($('#max').val());
    if($('#min').val() == ""){
      alert("Xin mời nhập ngày bắt đầu !");
      $('#max').val('');
    }
    if(cmin > cmax){
      alert("Lỗi định dạng ! Mời nhập lại !");
      $('#max').val('');
    }else {
    }
  });  
 var table = $('#example').DataTable({
            'info':false,
            'searching':true,
        });
 $('#search').on('click',function(event){
    event.preventDefault();
    $.fn.dataTable.ext.search.push(
       function (settings, data, dataIndex) {
           var min = document.getElementById("min");
           var min = $('#min').datepicker("getDate");
           var max = $('#max').datepicker("getDate");
           var startDate = new Date(data[4]);
           if (min == null && max == null) { return true; }
           if (min == null && startDate <= max) { return true;}
           if(max == null && startDate >= min) {return true;}
           if (startDate <= max && startDate == min) { return true; }
           return false;
       }
       );

          // Event listener to the two range filtering inputs to redraw on input
           $('#min, #max').change(function () {
               table.draw();
           });
             table.columns(2).search($('#dropdown2').val()).draw();
           $('.table').DataTable().search($('.outsideBorderSearch').val()).draw();
     });
 $(document).ready(function(){
  $('#example').removeClass('dataTable');
 });
  </script>



