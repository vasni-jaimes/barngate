<?php



function selectOld($name, $value) 
{
	return old($name) == $value ? "selected" : '';
}


function stepShow($step, $errors) 
{
		if ($step == 1 && $errors->paso1->any() == true) {
			return "style=display:block";
		}
		else if ($step == 2 && $errors->paso2->any() == true) {
			return "style=display:block";
		}
		else if ($step == 3 && $errors->paso3->any() == true) {
			return "style=display:block";
		}
		else if ($step == 1 && !$errors->paso1->any() && !$errors->paso2->any() && !$errors->paso3->any()) {
			return "style=display:block";
		}
		else {
			return "style=display:none";
		}
}

function planSelected($plan) {

	if (old("planSelect") == $plan) {
		return "plan-selected";
	}
}



function homepageReload() {
	if (old("hompage") == true || old("hompage2") == true) {
		return "checked";
	}
}