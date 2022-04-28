(function( $ ) {
 $.fn.PacMan = function() {
	 
	 
	jQuery.preloadImages = function(){ // Подгрузка изображений в буфер
		for(var i = 0; i < arguments.length; i++){	
			jQuery("<img>").attr("src", arguments[ i ]);
		}	
	};
	$.preloadImages("../../img/pacman.gif","../../img/floor.jpg","../../img/wall.jpg","../../img/floorPoint.jpg","../../img/ghost.gif");	// Путь к изображениям
	//var winh = $(window).height(); //Высота окна
	//var winw = $(window).width(); //Ширина окна
	//var where = 0;
	var queMov = [];
	var enemy = 0;
	
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
			$("<img id='pacman' src='../../img/pacman.gif' class='rotated' style='position:relative'><img id='ghost' src='../../img/ghost.gif' style='position:relative'><br><span id='score'>Счёт:0</span><br>").appendTo("div");
			for (let i=0;i<map.length;i++){
				for (let j=0;j<map[0].length;j++){
					switch(parseInt(map[i][j])){
						case 0:$("<img src='../../img/floor.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div");break;
						case 1:$("<img src='../../img/wall.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div");break;
						case 2:$("<img src='../../img/floor.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div");$("#pacman")[0].style.top=$("#"+i+"-"+j).position()['top'];$("#pacman")[0].style.right=-$("#"+i+"-"+j).position()['left'];break; // 32*(i+1)   (-32*j)
						case 3:$("<img src='../../img/floorPoint.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div");GO++;break;
						case 4:$("<img src='../../img/floor.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div");$("#ghost")[0].style.top=$("#"+i+"-"+j).position()['top'];$("#ghost")[0].style.right=-$("#"+i+"-"+j).position()['left']+32;break;
					}
				}
				$("<br>").appendTo("div");
			}
		}
		
		$(document).keyup(function(k){
			if (k.key=="ArrowUp" || k.keyCode==38){
				$("#pacman").removeClass();
				$("#pacman").addClass('rotU');
				queMov[0]=1;
				enemy=1;
			}
			if (k.key=="ArrowDown" || k.keyCode==40){
				$("#pacman").removeClass();
				$("#pacman").addClass('rotD');
				queMov[0]=2;
				enemy=1;
			}
			if (k.key=="ArrowLeft" || k.keyCode==37){
				$("#pacman").removeClass();
				$("#pacman").addClass('rotL');
				queMov[0]=3;
				enemy=1;
			}
			if (k.key=="ArrowRight" || k.keyCode==39){
				$("#pacman").removeClass();
				queMov[0]=4;
				enemy=1;
			}
		});
		
		setInterval(function(){
			if (GO==0){queMov.length = 0;enemy=0;} //$("div").empty();buildgame();
			if (queMov.length==1){
				let posX = Math.round(($("#pacman").position()['left']-$("#0-0").position()['left'])/32);
				let posY = Math.round(($("#pacman").position()['top']-$("#0-0").position()['top'])/32);
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
					case 0:$("#pacman").animate({top:"+=2"},25);$("#pacman").animate({right:"+=2"},25);$("#pacman").animate({top:"-=2"},25);$("#pacman").animate({right:"-=2"},25);queMov[0]=5;break;
					case 1:$("#pacman").animate({top:"-=32"},{duration: 100, easing: "linear" });break;
					case 2:$("#pacman").animate({top:"+=32"},{duration: 100, easing: "linear" });break;
					case 3:$("#pacman").animate({right:"+=32"},{duration: 100, easing: "linear" });break;
					case 4:$("#pacman").animate({right:"-=32"},{duration: 100, easing: "linear" });break;
				}
			}
			if (enemy == 1){
				let posXE = Math.round(($("#ghost").position()['left']-$("#0-0").position()['left'])/32);
				let posYE = Math.round(($("#ghost").position()['top']-$("#0-0").position()['top'])/32);
				let poss = true;
				let side = 0;
				while (poss){
					side = movE();
					switch (side){
						case 1:if (map[posYE-1][posXE]!=1) {poss=false;} break;
						case 2:if (map[posYE+1][posXE]!=1) {poss=false;} break;
						case 3:if (map[posYE][posXE-1]!=1) {poss=false;} break;
						case 4:if (map[posYE][posXE+1]!=1) {poss=false;} break;
					}
				}
				switch(side){
					case 1:$("#ghost").animate({top:"-=32"},{duration: 100, easing: "linear" });break;
					case 2:$("#ghost").animate({top:"+=32"},{duration: 100, easing: "linear" });break;
					case 3:$("#ghost").animate({right:"+=32"},{duration: 100, easing: "linear" });break;
					case 4:$("#ghost").animate({right:"-=32"},{duration: 100, easing: "linear" });break;
				}
			}
			
		},110);
		
		function movE(){
			return (Math.floor(Math.random()*4)+1);
		}
	});
	  
 };
})(jQuery); 