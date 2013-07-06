function toggle(id) {
	var box = document.getElementById(id);
	box.style.display = ( box.style.display == 'none' ) ? 'inline' : 'none';
}
function donotdisturb(id){
	var box = document.getElementById(id);
	box.style.display = 'inline'
	var newtext = document.myform.main_txt.value;
	document.tempform.temp_txt.value=newtext;
}
function exitdonotdisturb(id){
	var box = document.getElementById(id);
	box.style.display = 'none'
	var newtext = document.tempform.temp_txt.value;
	document.myform.main_txt.value=newtext;
}
function fadein(objectID){
	object = document.getElementById(objectID);
	object.style.opacity = '0';
	object.style.display = 'inline'
	scrollTo(0,0)
	var newtext = document.myform.main_txt.value;
	document.tempform.temp_txt.value=newtext;
	animatefadein = function (){
		if(object.style.opacity < 1){	 
			var current = Number(object.style.opacity);	 
			var newopac = current + 0.1;
			object.style.opacity = String(newopac);		
			setTimeout('animatefadein()', 0.01);
		}
	}
	animatefadein();
}
function read_complete(objectID){
	object = document.getElementById(objectID);
	object.style.opacity = '0';
	object.style.display = 'inline'
	scrollTo(0,0)
	var newtext = document.myform.main_txt.value;
	document.tempform.temp_txt.value=newtext;
	animatefadein = function (){
		if(object.style.opacity < 1){	 
			var current = Number(object.style.opacity);	 
			var newopac = current + 0.1;
			object.style.opacity = String(newopac);		
			setTimeout('animatefadein()', 0.01);
		}
	}
	animatefadein();
}
window.onload = function()
{
    var div1 = document.getElementById("contents");
    div1.onmouseover = function()
    {
        div.style.background = "#ff00ff";
    };
}

function submitOnEnter(myfield,e, validate)
{
	if(validate == NaN || validate == undefined || validate!=true){validate = false;}
var keycode;
if (window.event) keycode = window.event.keyCode;
else if (e) keycode = e.which;
else return true;

if (keycode == 13)
   {
   	if(!validate){
   		myfield.submit();
	} else{
		validateAndSubmit(myfield);
	}
   return false;
   }
else
   return true;
}