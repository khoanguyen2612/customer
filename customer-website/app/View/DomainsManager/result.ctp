<div class="list_dm">
	<div class="top_pn">
		<div class="left_area pull-left"> 
				<!--<a href="">
					<span style="display: inline-block;width: 25px;height: 25px;border:solid 1px #ebece9;">
						<img src="img/prev.png">
					</span>
				</a>
				<a href="">1</a>
				<a href="">
					<span style="display: inline-block;width: 25px;height: 25px;border:solid 1px #ebece9;">
						<img src="img/next.png">
					</span>
				</a>-->
				<?php echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled')); ?>
				<?php echo $this->Paginator->numbers(); ?>
				<?php echo $this->Paginator->next('Next »',null,null, array('class'=>'disabled')); ?>
		</div>
		<div class="righ_area pull-right">
			Số bản ghi: 
			<select name="limitValue" onchange="getOrderBy(this.value);">
				<option value="10" <?php echo ($limit==10)?'selected':''; ?>>10</option>
				<option value="20"  <?php echo ($limit==20)?'selected':''; ?>>20</option>
				<option value="50"  <?php echo ($limit==50)?'selected':''; ?>>50</option>
				<option value="100"  <?php echo ($limit==100)?'selected':''; ?>>100</option>
			</select>
		</div>
	</div>
	<div class="clearfix" style="margin-bottom: 20px;"></div>
	<div class="table-responsive">
		<table id="tbl-dm" class="table table-bordered">
			<tr>
				<td bgcolor="#ebece9"></td>
				<td bgcolor="#ebece9">STT</td>
				<td bgcolor="#ebece9">Tên miền</td>
				<td bgcolor="#ebece9">Whois Protect</td>
				<td bgcolor="#ebece9">Ngày đăng ký</td>
				<td bgcolor="#ebece9">Ngày hết hạn</td>
				<td bgcolor="#ebece9">Trạng thái</td>
				<td bgcolor="#ebece9">Bản khai</td>
			</tr>
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
		</table>
	</div>
	<div class="toppanel" style="margin-bottom: 20px;">					
		<!--<?php
		echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled')); //Shows the next and previous links
		echo " | ".$this->Paginator->numbers()." | "; //Shows the page numbers
		echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled')); //Shows the next and previous links
		echo " Page ".$this->Paginator->counter(); // prints X of Y, where X is current page and Y is number of pages
		?>-->
			<div class="left_area pull-left"> 
				<!--<a href="">
					<span style="display: inline-block;width: 25px;height: 25px;border:solid 1px #ebece9;">
						<img src="img/prev.png">
					</span>
				</a>-->
				<?php echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled')); ?>
				<?php echo $this->Paginator->numbers(); ?>
				<?php echo $this->Paginator->next('Next »',null,null, array('class'=>'disabled')); ?>
				<!--<a href="">
					<span style="display: inline-block;width: 25px;height: 25px;border:solid 1px #ebece9;">
						<img src="img/next.png">
					</span>
				</a>-->
				<p>Tổng số <?php echo $this->Paginator->params()['count'];  ?> tên miền</p>
		</div>
		<div class="righ_area pull-right">
			Số bản ghi:
			<select name="limitValue" onchange="getOrderBy(this.value);">
				<option value="10" <?php echo ($limit==10)?'selected':''; ?>>10</option>
				<option value="20" <?php echo ($limit==20)?'selected':''; ?>>20</option>
				<option value="50"  <?php echo ($limit==50)?'selected':''; ?>>50</option>
				<option value="100"  <?php echo ($limit==100)?'selected':''; ?>>100</option>
			</select>
		</div>
	</div>
	<div class="clearfix" style="margin-bottom: 20px;"></div>
	<button>Kết xuất ra Excels</button>
</div>