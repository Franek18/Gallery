<?php	
	if($results != null){
		foreach($results as $result){
		if(isset($_SESSION['checkboxes'][''.$result['_id'].'']) && $_SESSION['checkboxes'][''.$result['_id'].''] == TRUE)
			$check = TRUE;
		else
			$check = FALSE;		
		
		if($result['radio'] == 'public' || (isset($_SESSION['login']) && $result['radio'] == $_SESSION['login'])){
			echo '<tr>';
				$target_small = '/static/img/small_images/small_'.$result['_id'].$result['name'];
				$target_water = '/static/img/watermarks/water_'.$result['_id'].$result['name'];
				echo '<td>'.$result['author'].'</td>';
				echo '<td>'.$result['title'].'</td>';
				echo '<td><a href="'.$target_water.'" target="_blank"><img src="'.$target_small.'"></a>'.'</td>';
				if(isset($check) && $check)
					echo '<td><input type="checkbox" name="'.$result['_id'].'" checked>'.' add</td>';
				else
					echo '<td><input type="checkbox" name="'.$result['_id'].'">'.' add</td>';			
			echo '</tr>';		
		}
		
	}		
	}

		
?>	