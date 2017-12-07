<style>
	#flashMessage{
		display: block !important;
	}
</style>
<div class="container">
	<?php
	echo $this->Session->flash(); 
	echo $this->Form->create('CreateInstance', array("url" => array('controller' => 'Test','action' => 'create_instance')));
	echo $this->Form->input('Name',array(
      'type' => 'text',
      'class' => 'form-control room-name',
      'label' => 'Tên máy ảo',
      'div' => array('class' => 'col-md-4'),
      'value' => ''
      ));
	?>
	<div class="clearfix"></div>
	<h4>HDD</h4>
	<div class="radio">
  		<label>
  			<input type="radio" name="hdd_id" value=<?php echo $data['hdd_id']?> checked>HDD
  		</label>
	</div>
	<h4>CPU & RAM</h4>
	<div class="radio">
  		<label>
  			<input type="radio" name="ram_cpu_id" value=<?php echo $data['ram_cpu_id_1']?> checked>1CPU 1GB RAM
  		</label>
	</div>
	<div class="radio">
  		<label>
  			<input type="radio" name="ram_cpu_id" value=<?php echo $data['ram_cpu_id_2']?>>1CPU 2GB RAM
  		</label>
	</div>
<?php 
echo $this->Form->input('group',array(
      'type' => 'text',
      'class' => 'form-control room-name',
      'label' => 'Tên Group',
      'div' => array('class' => 'col-md-4'),
      'value' => ''
      ));;
?>
<div class="clearfix" style="margin-bottom: 10px"></div>
<?php
echo $this->Form->button('submit',array(
		'class' => 'btn btn-primary',
	));
echo $this->Form->end();
?>
</div>