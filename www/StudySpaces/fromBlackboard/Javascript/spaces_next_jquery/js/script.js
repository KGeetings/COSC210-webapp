function O(i) {
	return document.getElementById(i)
}
function S(i) {
	return O(i).style
	}
function C(i){
	return document.getElementsByClassName(i)
	}

function invisible(obj){
	myarray = C(obj)
	for (i = 0; i < myarray.length; ++i ){
		myarray[i].style.display = "none"
		}
	}
	
function visible(obj){
	myarray = C(obj)
	for (i = 0; i < myarray.length; ++i ){
		myarray[i].style.display = "block"
		}
	}
	