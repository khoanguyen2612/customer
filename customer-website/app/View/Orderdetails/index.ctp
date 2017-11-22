<div class="container-fluid">
<style>
lable{
font-size:16px;
margin:2px;
}
input{
font-size:16px;
margin:2px;
}
</style>
    <form class="form-inline">
    <lable>Từ ngày</lable>
    <input type='date' name='created' class="form-control" required>
    <lable>Đến ngày</lable>
    <input type='date' class="form-control" required>
    <lable>Loại giao dịch</lable>
    <select class="form-control">
         <option>Tất Cả</option>
         <option>Mua Domain</option>
         <option>Gia Hạn Domain</option>
         <option>Mua Hosting</option>
    </select>
    <lable>Nội dung</lable>
    <input type='text' class="form-control" required>
     <button type="submit" name="submit" class="btn btn-success" data-dismiss="modal"><span class="glyphicon glyphicon-search">  </span>Tìm kiếm </button>
    </form>
    <?php
      if($data==NULL){
      echo "<h2>Dada Empty</h2>";
      }
      else{
      ?>
      <div class="table-responsive">
      <table class="table" style="font-size:16px;">
          <tr>
            <td><p>STT</p></td>
            <td><p>Tên dịch vụ</p></td>
            <td><p>Loại giao dịch</p></td>
            <td><p>Chi tiết giao dịch</p></td>
            <td><p>Ngày giao dịch</p></td>
            <td><p>Số tiền giao dịch</p></td>
            <td><p>Còn lại</p></td>
          </tr>
      <?php
          //pr($data);die;
      foreach($data['Orderdetail'] as $item){
      ?>

          <tr>
              <td><?php echo ($data['Account']['Account.id'])?></td>
              <td><?php echo ($item['Orderdetail']['domain_name'])?></td>
              <td><?php echo ($item['Orderdetail']['domain_name'])?></td>
              <td><?php echo ($item['Orderdetail']['request_flg'])?></td>
              <td><?php echo ($item['Orderdetail']['created_date'])?></td>
              <td><?php echo ($item['Orderdetail']['price'])?></td>
              <td><?php echo ($data['Account']['Account.credit'])?></td>
          </tr>

      </div>
       <?php
        }
      }
    ?>
    </table>
</div>
 <script language="javascript">
          $created_date = isset($_POST['created_date']) ? $_POST['created_date'] : false;
          var createddate = $('#created').val();
          if ($created_date > createddate ){
              die ('{error:"bad_request"}');
          }
          $conn = mysqli_connect('localhost', 'root', 'vertrigo', 'test') or die ('{error:"bad_request"}');


          // Khai báo biến lưu lỗi
          $error = array(
              'error' => 'success',
              'username' => '',
              'email' => ''
          );

          // Kiểm tra tên đăng nhập
          if ($username)
          {
              $query = mysqli_query($conn, 'select count(*) as count from member where username = \''.  addslashes($username).'\'');

              if ($query){
                  $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                  if ((int)$row['count'] > 0){
                      $error['username'] = 'Tên đăng nhập đã tồn tại';
                  }
              }
              else{
                  die ('{error:"bad_request"}');
              }
          }

          // Kiểm tra tên email
          if ($email)
          {
              $query = mysqli_query($conn, 'select count(*) as count from member where email = \''.  addslashes($email).'\'');

              if ($query){
                  $row = mysqli_fetch_array($query, MYSQLI_ASSOC);
                  if ((int)$row['count'] > 0){
                      $error['email'] = 'Email đã tồn tại';
                  }
              }
              else{
                  die ('{error:"bad_request"}');
              }
          }
        </script>


