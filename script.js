//27mai ( début can() et obst())
function obst(x,y,l,h,ca){
	var co = ca.getContext('2d');
	co.fillStyle = "gold";
	var cl=ca.width/48;
	var ch=ca.height/36;
	var li = new Array(x*cl,y*ch,x*cl+l*cl,y*ch+h*ch);
	co.fillRect(x*cl,y*ch,l*cl,h*ch);
	return li;
}

function can() {
	var canvas  = document.querySelector('#canvas');
	var context = canvas.getContext('2d');
	canvas.width=(screen.width/( 16*2.5) )*24;
	canvas.height=(screen.height/( 9*2.5) )*18;
	obst(0,0,48,1,canvas);
	obst(0,0,1,36,canvas);
	obst(47,0,1,45,canvas);
	obst(0,35,48,1,canvas);
	obst(1,3,4,1,canvas);
	obst(1,16,4,1,canvas);
	obst(1,22,3,1,canvas);
	obst(1,25,5,1,canvas);
	obst(1,28,7,1,canvas);
	obst(1,10,5,1,canvas);
	obst(3,6,5,1,canvas);
	obst(3,19,5,1,canvas);
	obst(5,13,3,1,canvas);
	obst(7,28,1,7,canvas);
	obst(8,3,1,21,canvas);
	obst(11,1,1,5,canvas);
	obst(11,27,6,1,canvas);
	obst(11,27,1,8,canvas);
	obst(11,14,5,1,canvas);
	obst(11,17,5,1,canvas);
	obst(11,20,5,1,canvas);
	obst(13,13,1,12,canvas);
	obst(14,3,1,8,canvas);
	obst(14,10,9,1,canvas);
	obst(18,1,1,4,canvas);
	obst(18,11,7,1,canvas);
	obst(18,11,1,5,canvas);
	obst(18,19,10,1,canvas);
	obst(18,22,3,2,canvas);
	obst(19,26,1,5,canvas);
	obst(19,31,22,1,canvas);
	obst(21,3,1,3,canvas);
	obst(21,5,7,1,canvas);
	obst(21,14,7,1,canvas);
	obst(21,32,3,1,canvas);
	obst(22,28,4,1,canvas);
	obst(23,20,1,6,canvas);
	obst(26,3,1,3,canvas);
	obst(26,22,8,1,canvas);
	obst(26,22,1,4,canvas);
	obst(26,25,4,1,canvas);
	obst(26,34,4,1,canvas);
	obst(27,5,1,2,canvas);
	obst(27,9,1,3,canvas);
	obst(27,10,4,2,canvas);
	obst(29,25,1,4,canvas);
	obst(29,29,5,3,canvas);
	obst(30,5,1,15,canvas);
	obst(32,32,5,1,canvas);
	obst(33,5,4,1,canvas);
	obst(33,17,1,6,canvas);
	obst(35,9,1,3,canvas);
	obst(36,1,1,5,canvas);
	obst(36,11,1,11,canvas);
	obst(36,11,11,1,canvas);
	obst(39,1,1,8,canvas);
	obst(39,8,8,1,canvas);
	obst(39,34,2,1,canvas);
	obst(39,14,2,4,canvas);
	obst(39,20,2,4,canvas);
	obst(39,26,2,3,canvas);
	obst(43,15,2,5,canvas);
	obst(43,22,2,9,canvas);
	obst(45,33,2,2,canvas);
	
	
	
	
}