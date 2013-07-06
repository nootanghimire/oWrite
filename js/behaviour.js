function createAjax(){
	var Ajax;
	try{
		Ajax = new XMLHttpRequest();	
	}
	catch(e){
		Ajax = new ActiveXObject("Microsoft.XMLHTTP");
	}
	return Ajax;
}

function disappear(obj) {
	var NewOpacity = 1;
	core = function() {
		if(NewOpacity < 0.05) { obj.style.display = "none"; NewOpacity = NewOpacity; return;} else{
			NewOpacity = NewOpacity - 0.05;
			obj.style.opacity = String(NewOpacity);
			setTimeout('core()', 1);
		}
	}
	core();
}
function disappearlong(obj) {
	var NewOpacity = 1;
	core = function() {
		if(NewOpacity < 0.005) { obj.style.display = "none"; NewOpacity = NewOpacity; return;} else{
			NewOpacity = NewOpacity - 0.005;
			obj.style.opacity = String(NewOpacity);
			setTimeout('core()', 1);
		}
	}
	core();
}
function loadBox(){
	var Ajax =  createAjax();
	Ajax.onreadystatechange = function(){
		if(Ajax.status==200 && Ajax.readyState==4){
			document.getElementById('loginbox').innerHTML = Ajax.responseText;
		}
	}
	Ajax.open('GET', "/user/boxContents", true);
	Ajax.send();
}

function loadTitle() {
	var Ajax =  createAjax();
	Ajax.onreadystatechange = function(){
		if(Ajax.status==200 && Ajax.readyState==4){
			document.querySelector('#header_login h3').innerHTML = Ajax.responseText;
		}
	}
	Ajax.open('GET', "/user/titleContents", true);
	Ajax.send();
}

//This pseudo-anonymous function executes each time any page loads
(function exec_start(){

	//Added event listeners on each page load. 	
	document.onreadystatechange = function() {
		if(document.readyState == "complete"){
			loadTitle();
			//The seemingly-useless try....catch block is to prevent error, when some divs are not present on the page. 
			try {
				document.querySelector(".info").onclick = function() {
					disappear(this);
					//this.style.display = "none";
				}; 
			} catch(e){}

			try{
				document.querySelector(".error").onclick =  function(){
					disappear(this);
				};
			} catch(e){} 
			
			//Loads either LoginBox or UserInfo Box depending upon login status
			loadBox();
			loadNotice();
			

			
		}
	}	
})();

function validateAndSubmit(FormObj){

	var pattern = /\W/g;

	if(pattern.test(FormObj[0].value)){
 	//do not submite
 	alert('Make it Simple, Sid! Your username contains impure chars :( ')
 	} else {
 		for(i=0; i<=2; i++){
 			that  = FormObj[i];
 			if(that.value == NaN || that.value == "" || that.value == undefined){
 				alert('Skipping, huh? You need to fill in everything mate!');
 				for (j=i; j<=2; j++) {
 					if(FormObj[j].value != "") { FormObj[j].style.border = "1px solid #01a2e8;"; continue; };
 					FormObj[j].style.border="1px solid #dd1414";	
 				}
 				
 				
 				return false;
 			}
 		}
 		FormObj.submit();
 	}
 	//making fields required


}
function loadNotice(){
	var Ajax = createAjax();
	Ajax.onreadystatechange = function(){
		if(Ajax.status==200 && Ajax.readyState==4){
			if(document.getElementById('notification')){
				document.getElementById('notification').innerHTML = Ajax.responseText;
			}
		}
	}
	Ajax.open('GET', '/notifications/getNum', true);
	Ajax.send();
	setTimeout(function() {loadNotice()}, 1000);
}