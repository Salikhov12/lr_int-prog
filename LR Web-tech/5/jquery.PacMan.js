(function( $ ) {
 $.fn.PacMan = function() {
	 
	jQuery.preloadImages = function(){ // Подгрузка изображений в буфер
		for(var i = 0; i < arguments.length; i++){	
			jQuery("<img>").attr("src", arguments[ i ]);
		}	
	};
	$.preloadImages("../../img/pacman.gif","../../img/floor.jpg","../../img/wall.jpg","../../img/floorPoint.jpg","../../img/ghost.gif");	// Путь к изображениям
	var queMov = [];
	var enemy = 0;
	var maxL = 0;
	var maxT = 0;
	var posX;
	var posY;
	var posXE;
	var posYE;
	var varcoll;
	
	$(document).ready(function(){
		var map;
		var GO=0;
		$.get( "map.txt", //Загрузка карты
				{},
				function(data) {
					map = [];
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
			$("<img id='pacman' src='../../img/pacman.gif' class='rotated' style='position:relative'><img id='ghost' src='../../img/ghost.gif' style='position:relative'><br><span id='score'>Счёт:0</span><br>").appendTo("div#game");
			for (let i=0;i<map.length;i++){
				for (let j=0;j<map[0].length;j++){
					switch(parseInt(map[i][j])){
						case 0:$("<img src='../../img/floor.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div#game");break;
						case 1:$("<img src='../../img/wall.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div#game");break;
						case 2:$("<img src='../../img/floor.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div#game");$("#pacman")[0].style.top=$("#"+i+"-"+j).position()['top'];$("#pacman")[0].style.right=-$("#"+i+"-"+j).position()['left'];break; // 32*(i+1)   (-32*j)
						case 3:$("<img src='../../img/floorPoint.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div#game");GO++;break;
						case 4:$("<img src='../../img/floor.jpg' id='"+i+"-"+j+"' style='position:static'>").appendTo("div#game");$("#ghost")[0].style.top=$("#"+i+"-"+j).position()['top'];$("#ghost")[0].style.right=-$("#"+i+"-"+j).position()['left']+32;break;
					}
				}
				$("<br>").appendTo("div#game");
			}
			maxL = $("div#game img").last().position()['left'];
			maxT = $("div#game img").last().position()['top'];
			
			$("div#game")[0].style.width=maxL+32;
			
			$("<input type='button' value='STOP' id='stopgame'>").appendTo("div#game"); // Кнопка остановки персонажей
			$("<p id='beginText' class='message' style='top:"+(-maxT/2)+";left:"+((maxL+32-290)/2)+";'>Нажмите 🢁, 🢂, 🢃 или 🢀, чтобы начать</p>").appendTo("div#game");
			$("<p id='GameOver' class='message' style='top:"+(-maxT/2)+";left:"+((maxL+32-290)/2)+";'>Игра окончена</p>").appendTo("div#game");
			$("<p id='Win' class='message' style='top:"+(-maxT/2)+";left:"+((maxL+32-290)/2)+";'>Уровень завершен</p>").appendTo("div#game");
			$("#GameOver").fadeOut(0);
			$("#Win").fadeOut(0);
			$("#stopgame").click(function(){ // Остановка персонажей
				stopGame(false);
			});

		}
		
		
		function stopGame(lose){
			queMov.length = 0;
			enemy = 0;
			$("#pacman").stop(true,false);
			$("#ghost").stop(true,false);
			clearInterval(varcoll);
			if (lose){
				$("#GameOver").fadeIn(0);
			}
			else{$("#Win").fadeIn(0);}
		}
		
		function pressKey(num){
			$("#pacman").removeClass();
			queMov[0]=num;
			switch(num){
				case 1: $("#pacman").addClass('rotU');break;
				case 2: $("#pacman").addClass('rotD');break;
				case 3: $("#pacman").addClass('rotL');break;
			}
			if($("#beginText").is(":visible")){
					$("#beginText").hide();
					clearInterval(varBegin);
					enemy=1;
					varcoll = setInterval(colus,30);
			}
			
		}
		
		$(document).keyup(function(k){
			switch(k.key){
				case "ArrowUp": pressKey(1);break;
				case "ArrowDown": pressKey(2);break;
				case "ArrowLeft": pressKey(3);break;
				case "ArrowRight": pressKey(4);break;
			}
		});
		var side = 1;
		var varBegin = setInterval(funBegin,2000);
		
		function funBegin(){
			$("#beginText").fadeOut(200);
			$("#beginText").fadeIn(200);
		}
		
		setInterval(function(){
			if (!document.hidden){
				if (GO==0){stopGame(false);} //$("div").empty();buildgame();
				else{
					if (!$("#GameOver").is(":visible")){
						posX = Math.round(($("#pacman").position()['left']-$("#0-0").position()['left'])/32);
						posY = Math.round(($("#pacman").position()['top']-$("#0-0").position()['top'])/32);
						
						//if (posX==posXE && posY==posYE){stopGame();};
						//console.log(posXE+" "+posYE+" - "+posX+" "+posY);
						if (posX<=0){posX++;$("#pacman").animate({right:"-=32"},0);}
						if (posY<=0){posY++;$("#pacman").animate({top:"+=32"},0);}
						if (posX>=((maxL-$("#0-0").position()['left'])/32)){posX--;$("#pacman").animate({right:"+=32"},0);}
						if (posY>=((maxT-$("#0-0").position()['top'])/32)){posY--;$("#pacman").animate({top:"-=32"},0);}
						
						if (map[posY][posX]==3&&$("#"+(posY)+"-"+posX).attr('src')=='../../img/floorPoint.jpg'){$("#"+posY+"-"+posX).attr('src','../../img/floor.jpg');
								$("#score").text("Счёт:"+(parseInt($("#score").text().substring(5))+100)); GO--;}
						switch (queMov[0]){
							case 1: if (map[posY-1][posX]==1) {queMov[0]=0;}break;
							case 2: if (map[posY+1][posX]==1) {queMov[0]=0;}break;
							case 3: if (map[posY][posX-1]==1) {queMov[0]=0;}break;
							case 4: if (map[posY][posX+1]==1) {queMov[0]=0;}break;
						}
						switch(queMov[0]){
							case 0:$("#pacman").animate({top:"+=2"},25);$("#pacman").animate({right:"+=2"},25);$("#pacman").animate({top:"-=2"},25);$("#pacman").animate({right:"-=2"},25);queMov[0]=5;break;
							case 1:$("#pacman").animate({top:"-=32"},{duration: 100, easing: "linear" });break;
							case 2:$("#pacman").animate({top:"+=32"},{duration: 100, easing: "linear" });break;
							case 3:$("#pacman").animate({right:"+=32"},{duration: 100, easing: "linear" });break;
							case 4:$("#pacman").animate({right:"-=32"},{duration: 100, easing: "linear" });break;
						}
					}
				}
			}
		},120);
		setInterval(function(){
			if (!document.hidden){
				if (enemy == 1){
					posXE = Math.round(($("#ghost").position()['left']-$("#0-0").position()['left'])/32);
					posYE = Math.round(($("#ghost").position()['top']-$("#0-0").position()['top'])/32);
					
					if (posXE<=0){posXE++;$("#ghost").animate({right:"-=32"},0);}
					if (posYE<=0){posYE++;$("#ghost").animate({top:"+=32"},0);}
					if (posXE>=((maxL-$("#0-0").position()['left'])/32)){posXE--;$("#ghost").animate({right:"+=32"},0);}
					if (posYE>=((maxT-$("#0-0").position()['top'])/32)){posYE--;$("#ghost").animate({top:"-=32"},0);}
					
					let posM = [];
					if (map[posYE-1][posXE]!=1) {posM.push(1);}
					if (map[posYE+1][posXE]!=1) {posM.push(2);}
					if (map[posYE][posXE-1]!=1) {posM.push(3);}
					if (map[posYE][posXE+1]!=1) {posM.push(4);}
					if (Math.floor(Math.random()*10)+1<4){side = movE();}
					let have = false;
					for (let i = 0;i<posM.length;i++){
						if (side == posM[i]){
							have = true;
						}
					}
					if (!have){
						side = posM[Math.floor(Math.random()*(posM.length))];
					}
					switch(side){
						case 1:$("#ghost").animate({top:"-=32"},{duration: 190, easing: "linear" });break;
						case 2:$("#ghost").animate({top:"+=32"},{duration: 190, easing: "linear" });break;
						case 3:$("#ghost").animate({right:"+=32"},{duration: 190, easing: "linear" });break;
						case 4:$("#ghost").animate({right:"-=32"},{duration: 190, easing: "linear" });break;
					}
				}
			}
		},210);
		
		function movE(){
			return (Math.floor(Math.random()*4)+1);
		}
		
		function colus(){
			if (Math.abs($("#pacman").position()['top']-$("#ghost").position()['top'])<32&&Math.abs($("#pacman").position()['left']-$("#ghost").position()['left'])<32){
				stopGame(true);
			}
		}
		
	});
	  
 };
})(jQuery); 