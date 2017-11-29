<div class="content">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<h4><i class="star"></i>Quản lý tên miền</h4>
				<div class="customer-panel text-center">
					<ul class="list-inline">
						<li><a href="">Đăng ký tên miền</a></li>
						<li><a href="">Cập nhật Whois</a></li>
						<li><a href="">Cài đặt DNS</a></li>
						<li><a href="">Cập nhật NS</a></li>
						<li><a href="">Whois Protect</a></li>
						<li><a href="">Giới hạn tên miền</a></li>
						<li><a href="">Thay đổi mật khẩu</a></li>
						<li><a href="">Domain Lock</a></li>
						<li><a href="">Gửi mail</a></li>
					</ul>
				</div>
				<div class="search_advance">
					<button class="btn btn-info" role="btn-seach" style="display: table;margin: auto;">
						<!-- <img src="img/search_icon.png"> -->
						<?php echo $this->Html->image('search_icon.png') ?>
						TÌM KIẾM NÂNG CAO
					</button>
					<div id="search" style="display: none;">
						<legend class="text-center" style="font-weight: 600;color: #f37636">NHẬP VÀO THÔNG TIN ĐỂ TÌM KIẾM NÂNG CAO</legend>
						<form method="POST" action="">
						<table class="table table-bordered" style="width: 80%;margin: auto;">
							<tbody>
								<tr>
									<td>Tên miền</td>
									<td>
										<textarea placeholder="Nhập tên miền..." name="domain_name"></textarea>
									</td>
								</tr>
								<tr>
									<td>Loại Tên miền:</td>
									<td>
										<select name="domain_type">
											<option selected="selected" value="">Chọn loại tên miền</option>
											<option value="1">Tên miền việt nam</option>
											<option value="0">Tên miền quốc tế</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Trạng thái</td>
									<td>
										<select name="domain_status">
											<option selected="selected" value="">Chọn Trạng Thái Tên Miền</option>
											<option value="1">Đang Sử Dụng</option>
											<option value="0">Hết Hạn Sử Dụng</option>
										</select>
									</td>
								</tr>
								<tr>
									<td>Ngày đăng ký:</td>
									<td><input type="text" name="reg_date" id="reg_date" placeholder="Chọn ngày đăng ký ..."></td>
								</tr>
								<tr>
									<td>Ngày hết hạn:</td>
									<td><input type="text" name="exp_date" id="exp_date" placeholder="Chọn ngày hết hạn ..."></td>
								</tr>
								<tr>
									<td colspan="2">
										<button class="btn btn-success" type="submit" style="display: block;margin: auto;" id="search_btn">Tìm kiếm</button>
									</td>
								</tr>
							</tbody>
						</table>
						</form>
					</div>
				</div>
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
								<?php echo $this->Paginator->prev('Previous ', null, null, array('class' => 'disabled')); ?>
								<?php echo $this->Paginator->numbers(); ?>
								<?php echo $this->Paginator->next('Next',null,null, array('class'=>'disabled')); ?>
							</div>
							<div class="righ_area pull-right">
								Số bản ghi: 
								<select name="limitValue" onchange="getLimit(this.value);">
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
								<tbody>
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
								</tbody>
							</table>
						</div>
						<div class="toppanel" style="margin-bottom: 20px;">					
						<!--<?php
						echo $this->Paginator->prev('Previous ', null, null, array('class' => 'disabled')); //Shows the next and previous links
						echo " | ".$this->Paginator->numbers()." | "; //Shows the page numbers
						echo $this->Paginator->next(' Next', null, null, array('class' => 'disabled')); //Shows the next and previous links
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
								<p style="margin-left: 10px;font-size: 14px;">Tổng số <strong><?php echo $this->Paginator->params()['count'];  ?></strong> tên miền</p>
							</div>
							<div class="righ_area pull-right">
								Số bản ghi:
								<select name="limitValue" onchange="getLimit(this.value);">
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
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$('button[role=btn-seach]').on('click', function(event) {
			$('#search').slideToggle();
		});
		function getLimit(value){
			$.ajax({
				url: "<?php echo $this->Html->url(array('controller'=>'DomainsManager','action'=>'index')); ?>",
				type: 'POST',
				dataType: 'html',
				data: {
					limit: value
				},
			})
			.done(function(result) {
				$('.content').replaceWith(result);
			// console.log(result);
		});		
		}
		$("#reg_date,#exp_date").datepicker({ dateFormat: 'yy-mm-dd' });

		$('#search_btn').on('click',function(e){
			event.preventDefault();
			$.ajax({
				url: "<?php echo $this->Html->url(array('controller'=>'DomainsManager','action'=>'index')); ?>",
				type: 'POST',
				dataType: 'html',
				data: {
					action:'search',
					domain_name: $('textarea[name="domain_name"]').val(),
					domain_type:$('select[name=domain_type]').val(),
					domain_status:$('select[name=domain_status]').val(),
					start:$('input[name=reg_date]').val(),
					end:$('input[name=exp_date]').val(),
				},
			})
			.done(function(result) {
				$('.list_dm').html(result);
				console.log(result);
			});
			
			
		});
		$('span[role=sort]').on('click',function(){
			if(!$(this).hasClass('sort-up')){
				$('span.sort-up').removeClass('sort-up');
			}
			$(this).toggleClass('sort-up');
			var order_by = $(this).attr('class');
			$.ajax({
				url: "<?php echo $this->Html->url(array('controller'=>'DomainsManager','action'=>'index')); ?>",
				type: 'POST',
				dataType: 'html',
				data: {
					action:'sort',
					field:$(this).attr('field'),
					order_by:order_by,
				},
			})
			.done(function(result) {
				$('#panel').nextAll().remove();
				$('#panel').after(result);
				console.log(result);
			});	
		});
	</script>
	<style type="text/css">
	span[role=sort]{
		width: 22px;
		height: 22px;
		display: inline-block;
		float: right;
		cursor: pointer;
		position: absolute;
		right: 2px;
		top:8px;
		background:url("<?php echo $this->Html->url('/img/sort_down.png')?>") no-repeat center;
	}
	td[role=th]{
		position:relative;
		padding-right: 22px !important;
	}
	.sort-up{
		background:url("<?php echo $this->Html->url('/img/sort_up.png')?>") no-repeat center !important;
	}
	.top_pn a {
		text-decoration: none;
	}
	.content{
		background-color: #f3f3f3;
	}
	.content .row{
		margin-top: 10px;
		margin-bottom: 30px;
		padding-bottom: 60px;
		background-color: #fff;
	}
	.star{
		background: url("<?php echo $this->Html->url('/img/star_img.png')?>") no-repeat top;
		display: inline-block;
		width: 27px;
		height: 27px;
		margin-bottom: -6px;
		margin-right: 8px;
	}
	.content h4{
		margin-top: 30px;
		color: #f37636;
		text-transform: uppercase;
		font-weight: 600;
	}
	#search{
		background-color: #dbdbd1;
		margin:20px auto;
		width: 80%;
		text-align: center;
		border:solid 1px #0b01e2;
		border-radius: 7px;
		padding-top: 20px;
	}
	#search tr td:nth-child(1){
		width: 30%;
	}
	#search td textarea, #search td select,#search td input{
		width: 100%;
		padding: 5px 10px;
		border:solid 1px #363636;
	}
	#search td{
		padding-left: 2% !important;
		text-align: left;
	}
	.customer-panel a{
		display: inline-block;
		background-color: #9bed74;
		background: #9bed74; 
		background: -webkit-linear-gradient(#fbf608, #9bed74);
		background: -o-linear-gradient(#fbf608, #9bed74); 
		background: -moz-linear-gradient(#fbf608, #9bed74);
		background: linear-gradient(#fbf608, #9bed74);
		color: #353535;
		padding: 5px 8px;
		border-radius: 4px;
		text-decoration: none;
		font-size: 14px;
		margin: 5px 0px;
		font-weight: 500;
	}
	#tbl-dm td{
		text-align:center;
	}
</style>