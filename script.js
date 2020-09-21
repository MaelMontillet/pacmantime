
//27mai ( début can() et obst())
function obst(x,y,l,h,ca){
	var co = ca.getContext('2d');
	co.fillStyle = "blue";
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
				for (var vy = cy/8; vy <2*cy ; vy+=cy/8){
					if ((l[i] <= x) && (x <= l[i+1]) && (l[i+2] <= y+vy) && (y+vy <= l[i+3] )){
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
				for (var vx = cx/8; vx<2*cx ; vx+=cx/8){
					if ((l[i] <= x+vx) && (x+vx<=l[i+1]) && (l[i+2] <= y) && (y <= l[i+3] )){
						a=1;
					}
					
				}
			}
			if (a==0) {
				y-=cy/8;
			}
			break;
		
		case "d":
		at=new Array()
			for (var i = 0; i < l.length ; i+=4) {
				for (var vy = cy/8; vy<2*cy ; vy+=cy/8){
					if ((l[i] <= x+2*cx) && (x+2*cx<=l[i+1]) && (l[i+2] <= y+vy) && (y+vy <= l[i+3] )){
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
				for (var vx = cx/8; vx<2*cx ; vx+=cx/8){
					if ((l[i] <= x+vx) && (x+vx<=l[i+1]) && (l[i+2] <= y+2*cy) && (y+2*cy <= l[i+3] )){
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

function def_screen(scx,scy){
	if (scx>scy){
		var max = scx;
	}
	else{
		var max = scy;
	}
	var res1 = scx;
	var res2 = scy;
	var ldiv = new Array();
	for (var i=max; i > 0; i-=1){
		
		if ((res1%i==0) && (res2%i==0)){
			res1/=i;
			res2/=i;
		}
		if ((scx%i==0) && (scy%i==0)){
			ldiv.push(i);
		}
	}
	result=new Array(res1,res2,ldiv);
	return result;
}

function pacman(px,py,cx,cy,co){
	co.fillStyle = "gold";
	co.beginPath();
	co.arc(px,py,cx,0,Math.PI * 2, true); 
	co.fill();
	py-=0.5*cx;
	px-=1.25*cx
	co.fillStyle = "black";
	/*oeil du pacman*/
    co.beginPath();
    co.arc(px+25/15*cx, py+2/15*cy, 2/15*cx,0,Math.PI,true);
    co.fill();
	var d = new Date();
	var t = d.getTime();
	if (t%300>150){
		py+=1.5*cx;
		px+=1.25*cx
		co.beginPath();
		co.moveTo(px+cx,py);
		co.lineTo(px+cx,py-1.25*cy);
		co.lineTo(px,py-cy);
		co.fill();
	}
}

function fantome(px,py,cx,cy,co,couleur){
	py+=2*cy;
	px+=cx/10;
	co.fillStyle = couleur;
	co.beginPath();
	co.moveTo(px,py);
	co.lineTo(px, py-cy);
	co.bezierCurveTo(px, py-22/15*cy, px+6/15*cx, py-28/15*cy, px+14/15*cx, py-28/15*cx);
	co.bezierCurveTo(px+22/15*cx, py-28/15*cy, px+28/15*cx, py-22/15*cy, px+28/15*cx, py-14/15*cy);
	co.lineTo(px+28/15*cx, py);
	co.lineTo(px+24/15*cx, py-5/15*cy);
	co.lineTo(px+18.666/15*cx,py);
	co.lineTo(px+14/15*cx, py-5/15*cy);
	co.lineTo(px+9.3/15*cx, py)
	co.lineTo(px+5/15*cx, py-5/15*cy);
	co.lineTo(px, py);
	co.fill();
	py-=1.25*cy;
	px-=cx
	/*oeil droit du fantôme*/
    co.fillStyle = "black";
    co.beginPath();
    co.arc(px+38/15*cx, py+2/15*cy, 2/15*cx, 0, Math.PI * 2, true);
    co.fill();
	/*oeil gauche du fantôme*/
    co.beginPath();
    co.arc(px+25/15*cx, py+2/15*cy, 2/15*cx, 0, Math.PI * 2, true);
    co.fill();
}

function can() {
	var k="d";
	var fk="d"
	var canvas  = document.querySelector('#canvas');
	var context = canvas.getContext('2d');
	var ds=def_screen(screen.width,screen.height)
	var resx=ds[0];
	var resy=ds[1];
	var i=0;
	var xpac=0
	var ypac=0
	var lxyfant= new Array()
		while (( screen.width/(resx*ds[2][i])*48 < window.innerWidth ) && ( screen.height/(resy*ds[2][i])*36 < window.innerHeight) &&  (ds[2][i]!=length-1)){
			i+=1
		}
	if (resx<resy){
		if (i==0){
			canvas.width=screen.height/(resx*ds[2][i])*36;
			canvas.height=screenwidth/(resy*ds[2][i])*48;
		}
		else{
			canvas.width=screen.height/(resx*ds[2][i-1])*36;
			canvas.height=screen.width/(resy*ds[2][i-1])*48;
		}
	}
	else {
		if (i==0){
			canvas.width=screenwidth/(resx*ds[2][i])*48;
			canvas.height=screenheight/(resy*ds[2][i])*36;
		}
		else{
			canvas.width=screen.width/(resx*ds[2][i-1])*48;
			canvas.height=screen.height/(resy*ds[2][i-1])*36;
		}
	}
	var cx=canvas.width/48;
	var cy=canvas.height/36;
	x*=cx;
	y*=cy;
	var l = map(canvas);
	function draw(x,y,canvas,k,l){
		var co = canvas.getContext('2d');
		var cx=canvas.width/48;
		var cy=canvas.height/36;
		refresh(canvas);
		map(canvas);
		co.fillStyle = "red";
		if (coeurs>2){
			co.beginPath();
			co.moveTo(41.1*cx, 2.56*cy);
			co.bezierCurveTo(40*cx+75/64*cx, 2*cy+37/64*cx, 40*cx+70/64*cx,  2*cy+25/64*cx, 40*cx+50/64*cx,  2*cy+25/64*cx);
			co.bezierCurveTo(40*cx+20/64*cx, 2*cy+25/64*cx, 40*cx+20/64*cx,  2*cy+62.5/64*cx, 40*cx+20/64*cx,  2*cy+62.5/64*cx);
			co.bezierCurveTo(40*cx+20/64*cx,  2*cy+80/64*cx, 40*cx+40/64*cx,  2*cy+102/64*cx, 40*cx+75/64*cx,  2*cy+120/64*cx);
			co.bezierCurveTo(40*cx+110/64*cx,  2*cy+102/64*cx, 40*cx+130/64*cx,  2*cy+80/64*cx, 40*cx+130/64*cx,  2*cy+62.5/64*cx);
			co.bezierCurveTo(40*cx+130/64*cx,  2*cy+62.5/64*cx, 40*cx+130/64*cx,  2*cy+25/64*cx, 40*cx+100/64*cx,  2*cy+25/64*cx);
			co.bezierCurveTo(40*cx+85/64*cx,  2*cy+25/64*cx, 40*cx+75/64*cx,  2*cy+37/64*cx, 40*cx+75/64*cx,  2*cy+40/64*cx);
			co.fill();
		}
		if (coeurs>1){
			co.moveTo(43.1*cx, 2.56*cy);
			co.bezierCurveTo(42*cx+75/64*cx, 2*cy+37/64*cx, 42*cx+70/64*cx,  2*cy+25/64*cx, 42*cx+50/64*cx,  2*cy+25/64*cx);
			co.bezierCurveTo(42*cx+20/64*cx, 2*cy+25/64*cx, 42*cx+20/64*cx,  2*cy+62.5/64*cx, 42*cx+20/64*cx,  2*cy+62.5/64*cx);
			co.bezierCurveTo(42*cx+20/64*cx,  2*cy+80/64*cx, 42*cx+42/64*cx,  2*cy+102/64*cx, 42*cx+75/64*cx,  2*cy+120/64*cx);
			co.bezierCurveTo(42*cx+110/64*cx,  2*cy+102/64*cx, 42*cx+130/64*cx,  2*cy+80/64*cx, 42*cx+130/64*cx,  2*cy+62.5/64*cx);
			co.bezierCurveTo(42*cx+130/64*cx,  2*cy+62.5/64*cx, 42*cx+130/64*cx,  2*cy+25/64*cx, 42*cx+100/64*cx,  2*cy+25/64*cx);
			co.bezierCurveTo(42*cx+85/64*cx,  2*cy+25/64*cx, 42*cx+75/64*cx,  2*cy+37/64*cx, 42*cx+75/64*cx,  2*cy+42/64*cx);
			co.fill();
		}
		if (coeurs>0){
			co.moveTo(45.1*cx, 2.57*cy);
			co.bezierCurveTo(44*cx+75/64*cx, 2*cy+37/64*cx, 44*cx+70/64*cx,  2*cy+25/64*cx, 44*cx+50/64*cx,  2*cy+25/64*cx);
			co.bezierCurveTo(44*cx+20/64*cx, 2*cy+25/64*cx, 44*cx+20/64*cx,  2*cy+62.5/64*cx, 44*cx+20/64*cx,  2*cy+62.5/64*cx);
			co.bezierCurveTo(44*cx+20/64*cx,  2*cy+80/64*cx, 44*cx+44/64*cx,  2*cy+102/64*cx, 44*cx+75/64*cx,  2*cy+120/64*cx);
			co.bezierCurveTo(44*cx+110/64*cx,  2*cy+102/64*cx, 44*cx+130/64*cx,  2*cy+80/64*cx, 44*cx+130/64*cx,  2*cy+62.5/64*cx);
			co.bezierCurveTo(44*cx+130/64*cx,  2*cy+62.5/64*cx, 44*cx+130/64*cx,  2*cy+25/64*cx, 44*cx+100/64*cx,  2*cy+25/64*cx);
			co.bezierCurveTo(44*cx+85/64*cx,  2*cy+25/64*cx, 44*cx+75/64*cx,  2*cy+37/64*cx, 44*cx+75/64*cx,  2*cy+44/64*cx);
			co.fill();
		}
		if (document.getElementById("mobile").checked){
			window.addEventListener("deviceorientation", function handleOrientation(event){
				var axey= event.beta;
				var axex= event.gamma;
			if (axex > -20){
				fk="z";
			}
			else if (axex<-35){
				fk="s";
			}
			else if (axey>10){
				fk="d";
			}
			else if (axey<-10){
				fk="q";
			}
			ay=event.beta;
			ax=event.gamma;
			}, true);
			
		}
		else {
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
		}
		
		switch (fk){
			case "q":
				if (((x)%cx==0) && ((y)%cy==0)){
					k="q";
				}
				break;
			case "z":
				if (((x)%cx==0) && ((y)%cy==0)){
					k="z";
				}
				break;
			case "d":
				if (((x)%cx==0) && ((y)%cy==0)){
					k="d";
				}
				break;
			case "s":
				if (((x)%cx==0) && ((y)%cy==0)){
					k="s";
				}
				break;
		}
		x=deplacement(x,y,canvas,k,l)[0];
		y=deplacement(x,y,canvas,k,l)[1];
		if (x>canvas.width){
			x=-cx;
			y=26*cy;
		}
		else if (x<-cx){
			x=47*cx;
			y=9*cy;
		}
		else if (y>canvas.height){
			x=37*cx;
			y=-cy;
		}
		else if (y<-cy){
			x=9*cx;
			y=35*cy;
		}
		co.fillStyle = "gold";
		if (document.getElementById("perso").textContent == 'P'){
			pacman(x+cx, y+cy,cx, cy,co); 
		}
		else{
			fantome(x,y,cx,cy,co,document.getElementById("couleur").textContent);
		}
		jQuery(document).ready(function(){
			var at=0;
			for (var i=0; i<lxyfant.length; i+=2){
				if ((lxyfant[i]-1.5*cx<=xpac) && (xpac<=lxyfant[i]+1.5*cx) && (lxyfant[i+1]-1.5*cy<=ypac) && (ypac<=lxyfant[i+1]+1.5*cy)){
					at=1
				}
			}
			if (at==1){
				if (document.getElementById("perso").textContent == 'P') {
					x=cx;
					y=cy;
				}
				else{
					x=24*cx;
					y=17*cy;
				}
				var d = new Date();
				var t = d.getTime();
				$.post(
				'positions.php', 
				{
					time: t,
					coeurenmoins:" ",
					clef : document.getElementById("clef").textContent
				},
				delcoeur,
				'text' 
				);
			}
			$.post(
				'positions.php', 
				{
					getcoeur:" ",
					clef : document.getElementById("clef").textContent
				},
				getcoeur, 
				'text' 
				);
			if (coeurs==0){
				$.post(
				'positions.php', 
				{
					gameover: " ",
					clef : document.getElementById("clef").textContent
				},
				gameoverfunc, 
				'text' 
				);
			}
			$.post(
			'positions.php', 
			{
				clef : document.getElementById("clef").textContent,
				pseudo : document.getElementById("pseudo").textContent,
				positionx: x/cx,
				positiony: y/cy
			},
			affichage, 
			'text' 
			);
			
		});
		function getcoeur(retour){
			coeurs=retour;
		}
		function delcoeur(retour){
			alert(retour);
		}
		function gameoverfunc(retour){
			window.location = "index.php";
		}
		document.getElementById('test').textContent=coeurs;
		function coeurenmoins(retour){
		}
		function affichage(retour){
			otherusers= new Array();
			otherusers=retour.split(' ');
			otherusers[0]=otherusers[0][2];
			otherusers=otherusers.splice(0,otherusers.length-1);
		}
		lxyfant=new Array();
		for (var ii=0 ; ii < otherusers.length; ii+=5){
			if (otherusers[ii+1] != document.getElementById("pseudo").textContent){
				if (otherusers[ii]=='P'){
					pacman(otherusers[ii+2]*cx+cx, otherusers[ii+3]*cy+cy,cx,cy,co);
				}
				else{
					fantome(otherusers[ii+2]*cx,otherusers[ii+3]*cy,cx,cy,co,otherusers[ii+4]);
				}
				co.font = 'bold 12px Verdana, Arial, serif';
				co.fillText(otherusers[ii+1],otherusers[ii+2]*cx,otherusers[ii+3]*cy)
			}
			if (otherusers[ii]=='P'){
				xpac=otherusers[ii+2]*cx+cx;
				ypac=otherusers[ii+3]*cy+cy;
			}
			else{
				lxyfant.push(otherusers[ii+2]*cx+cx);
				lxyfant.push(otherusers[ii+3]*cy+cy);
			}
		}
		window.requestAnimationFrame(function() { draw(x,y,canvas,k,l) });

	}
	draw(x,y,canvas,k,l)
	
	}
var otherusers=new Array();
var x=document.getElementById("x").textContent;
var y=document.getElementById("y").textContent;
var coeurs=document.getElementById("y").textContent;

/*
jQuery(document).ready(function(){
			$.post(
			'ajax2.php', 
			{
				ini : " ",
				pseudo : document.getElementById("pseudo").textContent
			},
			ini, 
			'text' 
		);
	});
function ini(retour){
	retour=retour.split(' ');
	alert(retour)
	x=retour[0];
	y=retour[1];
	return x,y;
}*/
can();