(function( $ ) {
 $.fn.PacMan = function() {
	 
	var movm = 0; //Куда двигается. 1-вверх, 2-вниз, 3-влево, 4-вправо
	var winh = $(window).height(); //Высота окна
	var winw = $(window).width(); //Ширина окна
	var queMov = [];
	var where = 0;
	$(document).ready(function(){
		var map;
		var GO=0;
		$.get( "map.txt", //Загрузка карты
				{},
				function(data) {
					map = [];
					//let col = data.substr(0,data.indexOf("\n")).length;
					let col = 26;
					for (let i = 0; i < col; i++) {
						map[i] = new Array();
					}
					let str = 1;
					sim=0;
					while ((sim+1)<data.length){
						for (let i = 0;i<col-1;i++){
							let check = true;
							while (check){
								if (data.substring(sim,sim+1)!="\n"&&data.substring(sim,sim+1)!="\r"){
									check=false;
								}
								else{sim++;}
							}
							map[str-1][i] = data.substring(sim,sim+1);
							sim++;
						}
						str++;
					}
					buildgame();
				}
		);
		function buildgame(){
			console.log(map[1][1]);
			$("<img id='cat' src='../../img/pacman.gif' class='rotated' style='position:relative'><span id='score'>Счёт:0</span><br><br><br><br><br><br>").appendTo("div");
			for (let i=0;i<map.length;i++){
				for (let j=0;j<map[0].length;j++){
				console.log(parseInt(map[i][j]));
					switch(parseInt(map[i][j])){
						case 0:$("<img src='../../img/floor.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div");break;
						case 1:$("<img src='../../img/wall.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div");break;
						case 2:$("<img src='../../img/floor.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div");
							$("#cat")[0].style.top=$("#"+i+"-"+j).position()['top'];$("#cat")[0].style.right=-$("#"+i+"-"+j).position()['left'];break; // 32*(i+1)   (-32*j)
						case 3:$("<img src='../../img/floorPoint.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div");GO++;break;
					}
				}
				$("<br>").appendTo("div");
			}
		}
		
		$(document).keyup(function(k){
			if (k.key=="ArrowUp" || k.keyCode==38){
				$("#cat").removeClass();
				$("#cat").addClass('rotU');
				queMov[0]=1;
			}
			if (k.key=="ArrowDown" || k.keyCode==40){
				$("#cat").removeClass();
				$("#cat").addClass('rotD');
				queMov[0]=2;
			}
			if (k.key=="ArrowLeft" || k.keyCode==37){
				$("#cat").removeClass();
				$("#cat").addClass('rotL');
				queMov[0]=3;
			}
			if (k.key=="ArrowRight" || k.keyCode==39){
				$("#cat").removeClass();
				queMov[0]=4;
			}
		});
		
		setInterval(function(){
			if (GO==0){queMov.length = 0;$("div").empty();buildgame();}
			console.log(GO+" GO");
			console.log(queMov.length+" queMov");
			if (queMov.length==1){
				console.log(queMov+" if = 1");
				let posX = Math.round(($("#cat").position()['left']-$("#0-0").position()['left'])/32);
				let posY = Math.round(($("#cat").position()['top']-$("#0-0").position()['top'])/32);
				switch (queMov[0]){
					case 1: if (map[posY-1][posX]==1) {queMov[0]=0;}if (map[posY-1][posX]==3&&$("#"+(posY-1)+"-"+posX).attr('src')=='../../img/floorPoint.jpg') 
						{$("#"+(posY-1)+"-"+posX).attr('src','../../img/floor.jpg');
						$("#score").text("Счёт:"+(parseInt($("#score").text().substring(5))+100)); GO--;} break;
					case 2: if (map[posY+1][posX]==1) {queMov[0]=0;}if (map[posY+1][posX]==3&&$("#"+(posY+1)+"-"+posX).attr('src')=='../../img/floorPoint.jpg') 
						{$("#"+(posY+1)+"-"+posX).attr('src','../../img/floor.jpg');
						$("#score").text("Счёт:"+(parseInt($("#score").text().substring(5))+100)); GO--;} break;
					case 3: if (map[posY][posX-1]==1) {queMov[0]=0;}if (map[posY][posX-1]==3&&$("#"+posY+"-"+(posX-1)).attr('src')=='../../img/floorPoint.jpg') 
						{$("#"+posY+"-"+(posX-1)).attr('src','../../img/floor.jpg');
						$("#score").text("Счёт:"+(parseInt($("#score").text().substring(5))+100)); GO--;} break;
					case 4: if (map[posY][posX+1]==1) {queMov[0]=0;}if (map[posY][posX+1]==3&&$("#"+posY+"-"+(posX+1)).attr('src')=='../../img/floorPoint.jpg') 
						{$("#"+posY+"-"+(posX+1)).attr('src','../../img/floor.jpg');
						$("#score").text("Счёт:"+(parseInt($("#score").text().substring(5))+100)); GO--;} break;
				}
				switch(queMov[0]){
					case 0:$("#cat").animate({top:"+=2"},25);$("#cat").animate({right:"+=2"},25);$("#cat").animate({top:"-=2"},25);$("#cat").animate({right:"-=2"},25);queMov[0]=5;break;
					case 1:$("#cat").animate({top:"-=32"},{duration: 100, easing: "linear" });break;
					case 2:$("#cat").animate({top:"+=32"},{duration: 100, easing: "linear" });break;
					case 3:$("#cat").animate({right:"+=32"},{duration: 100, easing: "linear" });break;
					case 4:$("#cat").animate({right:"-=32"},{duration: 100, easing: "linear" });break;
				}
			}
			if (queMov.length>1){
				while(queMov.length>2){
					queMov.shift();
				}
				
				let posX = Math.round($("#cat").position()['left']/32);
				let posY = Math.round($("#cat").position()['top']/32)-1;
				switch (queMov[0]){
					case 1: if (map[posY-1][posX]==1) {queMov[0]=0;} break;
					case 2: if (map[posY+1][posX]==1) {queMov[0]=0;} break;
					case 3: if (map[posY][posX-1]==1) {queMov[0]=0;} break;
					case 4: if (map[posY][posX+1]==1) {queMov[0]=0;} break;
				}
				switch(queMov[0]){
					case 0:$("#cat").effect( "shake",{distance:1, times:0},60);queMov[0]=5;break;
					case 1:$("#cat").animate({top:"-=32"},100);break;
					case 2:$("#cat").animate({top:"+=32"},100);break;
					case 3:$("#cat").animate({right:"+=32"},100);break;
					case 4:$("#cat").animate({right:"-=32"},100);break;
				}
				queMov.shift();
			}
		
		},110);
		
	});
	  
 };
})(jQuery); 