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
	var varBegin;
	let pacmanmove;
	let ghostmove;
	let first=0;
	let lvl = 1;
	
	$(document).ready(function(){
		var map;
		var GO=0;
		if (first==0){
			if (document.cookie.indexOf("lastlvl")==-1){
				getmap(1)}
			else{
				getmap(parseInt(document.cookie.substring(document.cookie.indexOf("lastlvl")+8,document.cookie.indexOf("lastlvl")+9)));
			}
		};
		
		function getmap(lvl){
			$.get( "lvl"+lvl+".txt", //Загрузка карты
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
					if(first==0){
						$("<div id='lvlpick' style='position:relative;top:"+$("#0-0").position()['top']+";width: 320;'></div>").insertAfter("div#game");
						buildLvlPick(5);
					}
					$(".lvlb").each(function(){
						$(this)[0].removeAttribute("disabled", "");
					});
					$("#lvl"+lvl)[0].previousSibling.setAttribute("disabled", "");
					first=1;
				}
			);
		}
		
		function buildgame(){
			GO=0;
			$("<img id='pacman' src='../../img/pacman.gif' class='rotated' style='position:relative'><img id='ghost' src='../../img/ghost.gif' style='position:relative'><br><span style='display: inline-block;width:115px' id='score'>Счёт: 0</span><input type='button' value='Пауза' id='pause' style='position:relative' class='b'><br>").appendTo("div#game");
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
			$("#pause")[0].style.left= map[0].length * 32-150-115-10;
			maxL = $("div#game img").last().position()['left'];
			maxT = $("div#game img").last().position()['top'];
			
			$("div#game")[0].style.width=maxL+32;
			
			//$("<input type='button' value='STOP' id='stopgame'>").appendTo("div#game"); // Кнопка остановки персонажей
			$("<p id='beginText' class='message' style='top:"+(-maxT/2)+";left:"+((maxL+32-290)/2)+";'>Нажмите 🢁, 🢂, 🢃 или 🢀, чтобы начать</p>").appendTo("div#game");
			$("<div id='GameOver' class='message' style='padding:5;top:"+(-maxT/2)+";left:"+((maxL+32-290)/2)+";'>Игра окончена<br><input class='b again' type='button' value='Заново'><br><input class='b' type='button' id='exit' value='Выход'></div>").appendTo("div#game");
			$("<div id='Win' class='message' style='padding:5;top:"+((-maxT-95)/2)+";left:"+((maxL+32-290)/2)+";'>Уровень завершен<br><input class='b' id='next' type='button' value='Следующий уровень'><br><input class='b again' type='button' value='Заново'></div>").appendTo("div#game");
			$("<div id='pausebox' class='message' style='padding:5;top:"+((-maxT-195)/2)+";left:"+((maxL+32-290)/2)+";'>Пауза<br><input class='b' id='continue' type='button' value='Продолжить'><br><input class='b again' type='button' value='Заново'></div>").appendTo("div#game");
			$("#GameOver").fadeOut(0);
			$("#Win").fadeOut(0);
			$("#pausebox").fadeOut(0);
			/*$("#stopgame").click(function(){ // Остановка персонажей
				stopGame(false);
			});*/
			varBegin = setInterval(funBegin,2000);
		}
		
		$($("div#game")[0].parentElement).on("click",".lvlb",function(){
			document.cookie = "lastlvl="+this.value.substring(8);
			$("div#game").empty();
			$("div#Win").remove();
			$("div#GameOver").remove();
			clearInterval(varBegin);
			clearInterval(pacmanmove);
			clearInterval(ghostmove);
			clearInterval(varcoll);	
			side = 1;
			getmap(this.value.substring(8));
		});
		
		$("div#game").on("click","#Win .again, #GameOver .again, #pausebox .again",function(){
			$("div#game").empty();
			$("div#Win").remove();
			$("div#GameOver").remove();
			clearInterval(varBegin);
			clearInterval(pacmanmove);
			clearInterval(ghostmove);
			clearInterval(varcoll);	
			side = 1;
			buildgame();	
		});
		$("div#game").on("click","#Win #next",function(){
			$("div#game").empty();
			$("div#Win").remove();
			$("div#GameOver").remove();
			clearInterval(varBegin);
			clearInterval(pacmanmove);
			clearInterval(ghostmove);
			clearInterval(varcoll);	
			side = 1;
			getmap(parseInt($('input[disabled]')[0].nextSibling.id.substring(3))+1);	
		});
		$("div#game").on("click","#GameOver input#exit",function(){
			$("#GameOver").fadeOut(0);
		});
		$("div#game").on("click","#pause",function(){
			if(!$("#beginText").is(":visible")&&!$("#Win").is(":visible")&&!$("#GameOver").is(":visible")){
				$("#pausebox").fadeIn(200);
				clearInterval(pacmanmove);
				clearInterval(ghostmove);
				clearInterval(varcoll);	
			}
			
		});
		$("div#game").on("click","#pausebox input#continue",function(){
			$("#pausebox").fadeOut(50);
			varcoll = setInterval(colus,30);
			pacmanmove = setInterval(pacmanm,120);
			ghostmove = setInterval(ghostm,210);
		});
		
		function stopGame(lose){
			queMov.length = 0;
			enemy = 0;
			$("#pacman").stop(true,false);
			$("#ghost").stop(true,false);
			clearInterval(pacmanmove);
			clearInterval(ghostmove);
			clearInterval(varcoll);
			let lvlid = $('#lvlpick input[disabled]')[0].nextSibling.id;
			if (parseInt($("#score").text().substring(5))>parseInt($(("#lvlpick #"+lvlid)).text().substring(8))){
				console.log(parseInt($("#score").text().substring(5)));
				console.log(parseInt($("#"+$('#lvlpick input[disabled]')[0].nextSibling.id).text().substring(8)));
				document.cookie = $('input[disabled]')[0].nextSibling.id+"="+parseInt($("#score").text().substring(6))+";";
				$("#"+$('input[disabled]')[0].nextSibling.id).text("Рекорд: "+(parseInt($("#score").text().substring(6))));
			}
			if (lose){
				$("#GameOver").fadeIn(0);
			}
			else{$("#Win").fadeIn(0);$("#next")[0].removeAttribute("disabled", "");if ($('input[disabled]')[0].nextSibling.id=="lvl5"){$("#next")[0].setAttribute("disabled", "");}}
			
			console.log($("#"+$('input[disabled]')[0].nextSibling.id));
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
					pacmanmove = setInterval(pacmanm,120);
					ghostmove = setInterval(ghostm,210);
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
		
		function funBegin(){
			if (!document.hidden){
				$("#beginText").fadeOut(200);
				$("#beginText").fadeIn(200);
			}
		}
		
		function pacmanm(){
			if (!document.hidden){
				if (GO==0){stopGame(false);}
				else{
					if (!$("#GameOver").is(":visible")){
						posX = Math.round(($("#pacman").position()['left']-$("#0-0").position()['left'])/32);
						posY = Math.round(($("#pacman").position()['top']-$("#0-0").position()['top'])/32);
						
						if (posX<=0){posX++;$("#pacman").animate({right:"-=32"},0);}
						if (posY<=0){posY++;$("#pacman").animate({top:"+=32"},0);}
						if (posX>=((maxL-$("#0-0").position()['left'])/32)){posX--;$("#pacman").animate({right:"+=32"},0);}
						if (posY>=((maxT-$("#0-0").position()['top'])/32)){posY--;$("#pacman").animate({top:"-=32"},0);}
						
						if (map[posY][posX]==3&&$("#"+(posY)+"-"+posX).attr('src')=='../../img/floorPoint.jpg'){$("#"+posY+"-"+posX).attr('src','../../img/floor.jpg');
								$("#score").text("Счёт: "+(parseInt($("#score").text().substring(6))+100)); GO--;}
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
		}

		function ghostm(){
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
		}
		
		function buildLvlPick(n){
			for (let i=1;i<=n;i++){
				let rec = 0;
				if (document.cookie.indexOf("lvl"+i)!=-1){
					let tsz = document.cookie.indexOf(";",document.cookie.indexOf("lvl"+i));
					if (tsz==-1){tsz=document.cookie.length;}
					rec = document.cookie.substring(document.cookie.indexOf("lvl"+i)+5,tsz);
				}
				$("<input type='button' class='lvlb' value='Уровень "+i+"'><span id='lvl"+i+"' class='rec'>Рекорд: "+rec+"</span><br>").appendTo("#lvlpick");
			}
		}
		
		function movE(){
			return (Math.floor(Math.random()*4)+1);
		}
		
		function colus(){
			if (!document.hidden){
				if (Math.abs($("#pacman").position()['top']-$("#ghost").position()['top'])<32&&Math.abs($("#pacman").position()['left']-$("#ghost").position()['left'])<32){
					stopGame(true);
				}
			}
		}
		
	});
	  
 };
})(jQuery); 