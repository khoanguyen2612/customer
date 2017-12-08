      <?php
          if($data==NULL){ ?>
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
                <tr>
                     <td colspan="9" class="datanull"><h2>Không có dữ liệu</h2></td>
                </tr>
              </tbody>
            </table>
         <?php }else{
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
          <style type="text/css">
            .datanull{
              text-align: center;
            }
          </style>