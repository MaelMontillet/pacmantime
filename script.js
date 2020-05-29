//27mai ( début can() et obst())
function obst(x,y,l,h,ca){
	var co = ca.getContext('2d');
	co.fillStyle = "gold";
	var cl=ca.width/60;
	var ch=ca.height/45;
	var li = new Array(x*cl,y*ch,x*cl+l*cl,y*ch+h*ch);
	co.fillRect(x*cl,y*ch,l*cl,h*ch);
	return li;
}

function can() {
	var canvas  = document.querySelector('#canvas');
	var context = canvas.getContext('2d');
	canvas.width=(screen.width/( 16*2.5) )*24;
	canvas.height=(screen.height/( 9*2.5) )*18;
	obst(0,0,60,1,canvas);
	obst(0,0,1,45,canvas);
	obst(59,0,1,45,canvas);
	obst(0,44,60,1,canvas);
}