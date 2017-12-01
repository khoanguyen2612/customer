	<div class="banner">
		<!-- <img src="img/banner-home.png"> -->
		<?php echo $this->Html->image('banner-home.png'); ?>

	</div>
	<div class="product-home">
		<div class="container">
			<div class="row">
				<div class="col-md-12 product-table">
					<table >
						<tr class="tr-01">
							<th rowspan="2" class="th-01">THÔNG TIN DỊCH VỤ</th>
							<th colspan="2">Tên miền</th>
							<th rowspan="2" class="th-03">Cloud Server</th>
							<th rowspan="2">Cloud Storage</th>
							<th rowspan="2" class="th-03">SSL</th>
						</tr>
						<tr class="tr-01">
							<th class="th-02 th-04">Việt Nam</th>
							<th class="th-02">Quốc tế</th>
						</tr>
				
						<?php
							for ($i=0; $i <=3 ; $i++) { 
								if($i==0||$i==2){echo '<tr class="tr-02">';}
								if($i==0){echo '<td class="td-01">Dịch vụ đang sử dụng</td>';}
								if($i==1){echo '<td class="td-01">Dịch vụ sắp hết hạn sử dụng</td>';}
								if($i==2){echo '<td class="td-01">Dịch vụ hết hạn sử dụng</td>';}
								if($i==3){echo '<td class="td-01">Dịch vụ ngưng sử dụng</td>';}
								echo '<td>'.$dmvn[$i].'</td>';
								echo '<td>'.$dmqt[$i].'</td>';
								echo '<td>'.$clsv[$i].'</td>';
								echo '<td>'.$countstogate[$i].'</td>';
								echo '<td>'.$countssl[$i].'</td>';
								echo '</tr>';
							}
						?>
					</table>
				</div>
				<div class="col-md-12 product-manage">
					<div class="col-md-2 col-sm-2">
						<h5><b>QUẢN LÝ DỊCH VỤ</b></h5>
					</div>
					<div class="col-md-2 col-sm-2">
						<button class="btn btn-primary">Tên miền</button>
					</div> 
					<div class="col-md-2 col-sm-2">
						<button class="btn btn-primary">Cloud Server</button>
					</div>
					<div class="col-md-2 col-sm-2">
						<button class="btn btn-primary">Cloud</button>
					</div>
					<div class="col-md-2 col-sm-2">
						<button class="btn btn-primary">Storage</button>
					</div>
					<div class="col-md-2 col-sm-2">
						<button class="btn btn-primary">SSL</button>
					</div>
				</div>
			</div>
		</div>
	</div>
