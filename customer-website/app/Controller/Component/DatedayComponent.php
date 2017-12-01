<?php
App::uses('Component', 'Controller');
// App::uses('AuthComponent', 'Controller/Component');
class DatedayComponent extends Component {

    public function expiration_date($date){
    	$today=date('Y-m-d');
            if($today<$date){
            	// if($date-$today<=20){
            	// 	return 1;
            	// }else return 0;
            	// return $date-$today;
            	$ex = date ("Y-m-d", strtotime("+20 day", strtotime($today)));
            	if($ex>$date){
            		return 1;
            	}
            	else{return 0;}

            }
            else{
            	return 2;
            }

    }
}
?>