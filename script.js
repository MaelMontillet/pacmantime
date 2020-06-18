
//27mai ( début can() et obst())
function obst(x,y,l,h,ca){
	var co = ca.getContext('2d');
	co.fillStyle = "gold";
	var cl=ca.width/48;
	var ch=ca.height/36;
	var li = new Array(x*cl,x*cl+l*cl,y*ch,y*ch+h*ch);
	co.fillRect(x*cl,y*ch,l*cl,h*ch);
	return li;
}

function refresh(ca){
	var co = ca.getContext('2d');
	co.clearRect(0,0,ca.width,ca.height);
}
function deplacement(x,y,ca,k,l){
	var cx=ca.width/48;
	var cy=ca.height/36;
	var a = 0
	
	switch (k){
		case "q":
			for (var i = 0; i < l.length ; i+=4) {
				for (var vy = 0; vy<2*cy ; vy+=cy/10){
					if ((l[i] < x-2) && (x-2<l[i+1]) && (l[i+2] < y+vy) && (y+vy < l[i+3] )){
						a=1;
						
					}
				}
			}
			if (a==0) {
				x-=cx/8;
			}
			
			break;
			
		case "z":
			for (var i = 0; i < l.length ; i+=4) {
				for (var vx = 0; vx<2*cx ; vx+=cx/10){
					if ((l[i] < x+vx) && (x+vx<l[i+1]) && (l[i+2] < y-2) && (y-2 < l[i+3] )){
						a=1;
					}
					
				}
			}
			if (a==0) {
				y-=cy/8;
			}
			break;
		
		case "d":
			for (var i = 0; i < l.length ; i+=4) {
				for (var vy = 0; vy<2*cy ; vy+=cy/10){
					if ((l[i] < x+2*cx) && (x+2*cx<l[i+1]) && (l[i+2] < y+vy) && (y+vy < l[i+3] )){
						a=1;						
					}
				}
			}
			if (a==0) {
				x+=cx/8;
			}
			break;
		case "s":
			for (var i = 0; i < l.length ; i+=4) {
				for (var vx = 0; vx<2*cx ; vx+=cx/10){
					if ((l[i] < x+vx) && (x+vx<l[i+1]) && (l[i+2] < y+2*cy) && (y+2*cy < l[i+3] )){
						a=1;
					}
				}
			}
			if (a==0) {
				y+=cy/8;
			}
			break;
			}
	return [x,y]
}
function map(canvas){
	var liste_obst=new Array();
	liste_obst=liste_obst.concat(obst(0,0,37,1,canvas));
	liste_obst=liste_obst.concat(obst(39,0,8,1,canvas));
	liste_obst=liste_obst.concat(obst(0,0,1,26,canvas));
	liste_obst=liste_obst.concat(obst(0,28,1,7,canvas));
	liste_obst=liste_obst.concat(obst(47,0,1,9,canvas));
	liste_obst=liste_obst.concat(obst(47,11,1,25,canvas));
	liste_obst=liste_obst.concat(obst(0,35,8,1,canvas));
	liste_obst=liste_obst.concat(obst(11,35,37,1,canvas));
	liste_obst=liste_obst.concat(obst(1,3,4,1,canvas));
	liste_obst=liste_obst.concat(obst(1,16,4,1,canvas));
	liste_obst=liste_obst.concat(obst(1,22,3,1,canvas));
	liste_obst=liste_obst.concat(obst(1,25,5,1,canvas));
	liste_obst=liste_obst.concat(obst(1,28,7,1,canvas));
	liste_obst=liste_obst.concat(obst(1,10,5,1,canvas));
	liste_obst=liste_obst.concat(obst(3,6,5,1,canvas));
	liste_obst=liste_obst.concat(obst(3,19,5,1,canvas));
	liste_obst=liste_obst.concat(obst(5,13,3,1,canvas));
	liste_obst=liste_obst.concat(obst(7,28,1,7,canvas));
	liste_obst=liste_obst.concat(obst(8,3,1,21,canvas));
	liste_obst=liste_obst.concat(obst(11,1,1,5,canvas));
	liste_obst=liste_obst.concat(obst(11,27,6,1,canvas));
	liste_obst=liste_obst.concat(obst(11,27,1,8,canvas));
	liste_obst=liste_obst.concat(obst(11,14,5,1,canvas));
	liste_obst=liste_obst.concat(obst(11,17,5,1,canvas));
	liste_obst=liste_obst.concat(obst(11,20,5,1,canvas));
	liste_obst=liste_obst.concat(obst(13,13,1,12,canvas));
	liste_obst=liste_obst.concat(obst(14,3,1,8,canvas));
	liste_obst=liste_obst.concat(obst(14,10,9,1,canvas));
	liste_obst=liste_obst.concat(obst(18,1,1,4,canvas));
	liste_obst=liste_obst.concat(obst(18,11,7,1,canvas));
	liste_obst=liste_obst.concat(obst(18,11,1,5,canvas));
	liste_obst=liste_obst.concat(obst(18,19,10,1,canvas));
	liste_obst=liste_obst.concat(obst(18,22,3,2,canvas));
	liste_obst=liste_obst.concat(obst(19,26,1,5,canvas));
	liste_obst=liste_obst.concat(obst(19,31,22,1,canvas));
	liste_obst=liste_obst.concat(obst(21,3,1,3,canvas));
	liste_obst=liste_obst.concat(obst(21,5,7,1,canvas));
	liste_obst=liste_obst.concat(obst(21,14,7,1,canvas));
	liste_obst=liste_obst.concat(obst(21,32,3,1,canvas));
	liste_obst=liste_obst.concat(obst(22,28,4,1,canvas));
	liste_obst=liste_obst.concat(obst(23,20,1,6,canvas));
	liste_obst=liste_obst.concat(obst(26,3,1,3,canvas));
	liste_obst=liste_obst.concat(obst(26,22,8,1,canvas));
	liste_obst=liste_obst.concat(obst(26,22,1,4,canvas));
	liste_obst=liste_obst.concat(obst(26,25,4,1,canvas));
	liste_obst=liste_obst.concat(obst(26,34,4,1,canvas));
	liste_obst=liste_obst.concat(obst(27,5,1,2,canvas));
	liste_obst=liste_obst.concat(obst(27,9,1,3,canvas));
	liste_obst=liste_obst.concat(obst(27,10,4,2,canvas));
	liste_obst=liste_obst.concat(obst(29,25,1,4,canvas));
	liste_obst=liste_obst.concat(obst(29,29,5,3,canvas));
	liste_obst=liste_obst.concat(obst(30,5,1,15,canvas));
	liste_obst=liste_obst.concat(obst(32,32,5,1,canvas));
	liste_obst=liste_obst.concat(obst(33,5,4,1,canvas));
	liste_obst=liste_obst.concat(obst(33,17,1,6,canvas));
	liste_obst=liste_obst.concat(obst(35,9,1,3,canvas));
	liste_obst=liste_obst.concat(obst(36,1,1,5,canvas));
	liste_obst=liste_obst.concat(obst(36,11,1,11,canvas));
	liste_obst=liste_obst.concat(obst(36,11,11,1,canvas));
	liste_obst=liste_obst.concat(obst(39,1,1,8,canvas));
	liste_obst=liste_obst.concat(obst(39,8,8,1,canvas));
	liste_obst=liste_obst.concat(obst(39,34,2,1,canvas));
	liste_obst=liste_obst.concat(obst(39,14,2,4,canvas));
	liste_obst=liste_obst.concat(obst(39,20,2,4,canvas));
	liste_obst=liste_obst.concat(obst(39,26,2,3,canvas));
	liste_obst=liste_obst.concat(obst(43,15,2,5,canvas));
	liste_obst=liste_obst.concat(obst(43,22,2,9,canvas));
	liste_obst=liste_obst.concat(obst(45,33,2,2,canvas));
	return liste_obst
}
function can() {
	var k="s";
	var fk="s"
	var canvas  = document.querySelector('#canvas');
	var context = canvas.getContext('2d');
	canvas.width=(screen.width/( 16*2.5) )*24;
	canvas.height=(screen.height/( 9*2.5) )*18;
	var cx=canvas.width/48;
	var cy=canvas.height/36;
	x=cx+1;
	y=cy+1;
	var l = map(canvas);
	
	function draw(x,y,canvas,k,l){
		var co = canvas.getContext('2d');
		var cx=canvas.width/48;
		var cy=canvas.height/36;
		refresh(canvas);
		map(canvas);
		document.addEventListener('keydown', function(e) {
			switch (e.keyCode){
				case 37:
					fk="q";
					break;
				case 38:
					fk="z";
					break;
				case 39:
					fk="d";
					break;
				case 40:
					fk="s";
					break;
				case 81:
					fk="q";
					break;
				case 90:
					fk="z";
					break;
				case 68:
					fk="d";
					break;
				case 83:
					fk="s";
					break;
			
			}
					
			
		});
		switch (fk){
			case "q":
				if (((x-1)%cx==0) && ((y-1)%cy==0)){
					k="q";
				}
				break;
			case "z":
				if (((x-1)%cx==0) && ((y-1)%cy==0)){
					k="z";
				}
				break;
			case "d":
				if (((x-1)%cx==0) && ((y-1)%cy==0)){
					k="d";
				}
				break;
			case "s":
				if (((x-1)%cx==0) && ((y-1)%cy==0)){
					k="s";
				}
				break;
		}
		x=deplacement(x,y,canvas,k,l)[0];
		y=deplacement(x,y,canvas,k,l)[1];
		if (x>canvas.width){
			x=-cx+1;
			y=26*cy+1;
		}
		else if (x<-cx){
			x=47*cx+1;
			y=9*cy+1;
		}
		else if (y>canvas.height){
			x=37*cx+1;
			y=-cy+1;
		}
		else if (y<-cy){
			x=9*cx+1;
			y=35*cy+1;
		}
			
		co.fillStyle = "blue";
		co.fillRect(x,y,cx*2,cy*2);
		jQuery(document).ready(function(){
			$.post(
			'positions.php', 
			{
				pseudo : document.getElementById("pseudo").textContent,
				positionx: (x-1)/cx,
				positiony: (y-1)/cy
			},
			affichage, 
			'text' 
			);

			

		});
		function affichage(retour){
			otherusers= new Array();
			otherusers=retour.split(' ');
			otherusers[0]=otherusers[0][2];
			otherusers=otherusers.splice(0,otherusers.length-1);
		}
		console.log(otherusers);
		for (var ii=0 ; ii < otherusers.length; ii+=4){
			if (otherusers[ii+1] != document.getElementById("pseudo").textContent){
				co.fillStyle = "blue";
				co.fillRect(otherusers[ii+2]*cx,otherusers[ii+3]*cy,cx*2,cy*2);
				co.fillStyle = "black";
				co.font = 'bold 12px Verdana, Arial, serif';
				co.fillText(otherusers[ii+1],otherusers[ii+2]*cx,otherusers[ii+3]*cy)
			}
		}
		window.requestAnimationFrame(function() { draw(x,y,canvas,k,l) });

	}
	draw(x,y,canvas,k,l)
	
	}
var otherusers=new Array();
can()
