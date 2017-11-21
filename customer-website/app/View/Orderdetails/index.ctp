
<?php
 if($data==NULL){
 echo "<h2>Dada Empty</h2>";
 }
 else{
 echo "  <input type='date' style = 'width:200px;'>
         <input type='date' style = 'width:200px;'>
                <select>
         			<option>Tất Cả</option> ";
         foreach($data as $item){
         			echo "<option>".$item['Orderdetail']['request_flg']."</option>";
         			}
      echo "</select>";
   echo "<input type='text' style = 'width:200px;'>
   <input type='submit' style = 'width:200px;'>";

 echo "<table>
   <tr>
     <td>STT</td>
     <td>Tên dịch vụ</td>
     <td>Loại giao dịch</td>
     <td>Chi tiết giao dịch</td>
     <td>Ngày giao dịch</td>
     <td>Số tiền giao dịch</td>
     <td>Còn lại</td>
   </tr>";
 foreach($data as $item){
   echo "<tr>";
   echo "<td>".$item['Orderdetail']['id']."</td>";
    echo "<td>".$item['Orderdetail']['domain_name']."</td>";
    echo "<td>".$item['Orderdetail']['domain_name']."</td>";
    echo "<td>".$item['Orderdetail']['request_flg']."</td>";
    echo "<td>".$item['Orderdetail']['created_date']."</td>";
    echo "<td>".$item['Orderdetail']['price']."</td>";
    echo "<td>".$item['Account']['credit']."</td>";
   echo "</tr>";
  }
 }?>
 <?php
    echo $this->Paginator->prev('« Previous ', null, null, array('class' => 'disabled'));
    echo " | ".$this->Paginator->numbers()." | ";
    echo $this->Paginator->next(' Next »', null, null, array('class' => 'disabled'));
    echo " Page ".$this->Paginator->counter();
?>

