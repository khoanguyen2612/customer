
<div class="top_pn">
	<div class="left_area pull-left"> 
		</div>
		<div class="righ_area pull-right">
			<!-- Số bản ghi: 
			<select name="limitValue" onchange="getLimit(this.value);">
				<option value="10" <?php echo ($limit==10)?'selected':''; ?>>10</option>
				<option value="20"  <?php echo ($limit==20)?'selected':''; ?>>20</option>
				<option value="50"  <?php echo ($limit==50)?'selected':''; ?>>50</option>
				<option value="100"  <?php echo ($limit==100)?'selected':''; ?>>100</option>
			</select> -->
		</div>
	</div>
	<div class="clearfix" style="margin-bottom: 20px;"></div>
	<div class="table-responsive">
		<table id="tbl-dm" class="table table-bordered">
			<tr id="panel">
				<td bgcolor="#ebece9" role="th"></td>
				<td bgcolor="#ebece9" role="th">STT</td>
				<td bgcolor="#ebece9" role="th">
					Tên miền
					<span role="sort" field="domain_name"></span>
				</td>
				<td bgcolor="#ebece9" role="th">
					Whois Protect
					<span role="sort" field="domain_status"></span>
				</td>
				<td bgcolor="#ebece9" role="th">
					Ngày đăng ký
					<span role="sort" field="created_date"></span>
				</td>
				<td bgcolor="#ebece9" role="th">
					Ngày hết hạn
					<span  role="sort" field="expiration_date"></span>
				</td>
				<td bgcolor="#ebece9" role="th">Trạng thái</td>
				<td bgcolor="#ebece9" role="th">Bản khai</td>
			</tr>
			
			<?php if(empty($data)): ?>
				<tr>
					<td colspan="8">
						Không tìm thấy kết quả nào
					</td>
				</tr>
			<?php else: ?>
				<?php $stt = 1; ?>
				<?php foreach($data as $row):?>
				<tr>
					<td><input type="radio" name=""></td>
					<td>
						<?php echo $stt;$stt++; ?>
					</td>
					<td><?php echo $row['Domain']['domain_name']; ?></td>
					<td>
						<?php
						if($row['Domain']['whois_type'] == 'Natural'){
							echo 'Đang hiển thị';
						}else if($row['Domain']['whois_type'] == 'legal'){
							echo 'Đã ẩn';
						}
						?>
					</td>
					<td>
						<?php 
						$created_date = strtotime($row['Domain']['created_date']);
						echo date("d-m-Y H:i:s", $created_date);
						?> 
					</td>
					<td>
						<?php 
						$expiration_date = strtotime($row['Domain']['expiration_date']);
						echo date("d-m-Y H:i:s", $expiration_date);
						$today = date("d-m-Y");
						$time_end = ($expiration_date - strtotime($today)) / (60 * 60 * 24);;
						echo (ceil($time_end) > 0) ?'(còn lại '.ceil($time_end).' ngày)' : '';
						?> 
					</td>
					<td>
						<?php
						if($row['Domain']['domain_status'] == '1'){
							echo "Đang sử dụng";
						} else if($row['Domain']['domain_status'] == '0'){
							echo "Đang dừng sử dụng";
						}
						?>
					</td>
					<td><a href="">Download bản khai</a></td>
				</tr>
			<?php endforeach; ?>
			<?php endif; ?>


		</table>
	</div>
	<div class="toppanel" style="margin-bottom: 20px;">					
	<div class="left_area pull-left"> 
			<p>Kết Quả <?php echo count($data);  ?> tên miền</p>
		</div>
		<div class="righ_area pull-right">
			<!-- Số bản ghi:
			<select name="limitValue" onchange="getLimit(this.value);">
				<option value="10" <?php echo ($limit==10)?'selected':''; ?>>10</option>
				<option value="20" <?php echo ($limit==20)?'selected':''; ?>>20</option>
				<option value="50"  <?php echo ($limit==50)?'selected':''; ?>>50</option>
				<option value="100"  <?php echo ($limit==100)?'selected':''; ?>>100</option>
			</select> -->
		</div>
	</div>
	<div class="clearfix" style="margin-bottom: 20px;"></div>
	<button>Kết xuất ra Excels</button>
</div>