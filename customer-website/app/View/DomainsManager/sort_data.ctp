<?php $stt = 1; ?>
<?php foreach($data as $row):?>
	<tr>
		<td>
			<input type="radio" name="sl_domain" id="dm_<?php echo $stt; ?>">
			<label for="dm_<?php echo $stt; ?>">
				<span></span>
			</label>
		</td>
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