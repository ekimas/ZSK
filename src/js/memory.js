var plansza = [];
var clickX;
var clickY;
var moduleW;

$(document).ready(function(){
	var url = String(window.location.href);

	var id = "";
	for(let i=url.search("=")+1; i<=url.length-1; i++)
	{
		id += url[i];
	}

	id = Number(id);


	$.ajax({
		url: './../../scripts/search_flash_2.php',
		type: 'POST',
		data: ({id: id}),
		dataType: 'JSON',
		success: function(response){
			var len = response.length;
			length = len;
			console.log(response);
			moduleW = JSON.stringify(response);

			if(length>=16)
				length=16;
			else if(length<16)
				length=4;

				console.log(length);
			
			board(length);
			setWords(length);
		}
	});	
});

// Generowanie planszy
function board(size){
	boardHeight = Number(Math.sqrt(size))*122;
	boardWidth = Number(Math.sqrt(size))*222;
	document.getElementById("plansza").style.height = boardHeight+"px";
	document.getElementById("plansza").style.width = boardWidth+"px";
	for(var i = 0; i < (Math.sqrt(size)); i++){
		plansza[i] = [];
		for(var j = 0; j < (Math.sqrt(size)); j++){
			plansza[i][j] = $('<div class="mem"></div>');
			$("#plansza").append(plansza[i][j]);
		}
	}
}

// Ustawianie słówek
function setWords(length)
{
	console.log(moduleW);
	var parsed = JSON.parse(moduleW);

	var i = 0;
	var o = Math.floor((parsed.length)*Math.random());
	var licznik = 0;
	do {
		var x = Math.floor((Math.sqrt(length))*Math.random());
		var y = Math.floor((Math.sqrt(length))*Math.random());
		console.log(i+" X: "+x+" Y: "+y);
		
		if(!plansza[x][y].hasClass("word")){
			plansza[x][y].addClass("word");
			if(licznik%2==0)
				plansza[x][y].addClass("A"+o);
			else
				plansza[x][y].addClass("P"+o);
			i++;
			licznik++;
		}

		if(licznik == 2)
		{
			o++;
			licznik = 0;
		}
	}while(i<length);

	
	var every = 0;
	var fKlik;
	var lKlik = 0;
	var words = document.querySelectorAll(".word");
	for(let j = 0; j<words.length; j++)
	{			
		words[j].addEventListener("click", function(){
			lKlik++;
			var parsed = JSON.parse(moduleW);
			var name = words[j].className;
			var pom = name[name.length-1];
			var lang = name[name.length-2];
			
			if(!isNaN(pom) && !isNaN(lang)){
				pom = 10*Number(lang)+Number(pom);
				lang = name[name.length-3];
			} else {
				lang = name[name.length-2];
			}

			if(pom>=length)
				pom = Math.floor((length)*Math.random());
		
			console.log(pom);
			if(lKlik == 1)
			{
				fKlik = pom;
			}

			$(this).addClass("clicked");
			setTimeout(function(){ 
				if(lang === 'P'){
					words[j].innerHTML = parsed[pom].pl;
				} else words[j].innerHTML = parsed[pom].eng;			
		}, 400);

		words[j].style.transform = "rotateY(360deg)";
			
		if(lKlik == 2)
			{
				var clicked = document.querySelectorAll(".clicked");
				if(fKlik==pom)
				{
					setTimeout(function(){ 
						clicked[0].style.transform = "rotateY(720deg)";
						clicked[1].style.transform = "rotateY(720deg)";						
					}, 1500);
					setTimeout(function(){
						clicked[0].style.visibility = "hidden";
						clicked[1].style.visibility = "hidden"; 
					}, 2000);
					clicked[0].classList.remove("clicked");
					clicked[1].classList.remove("clicked");
					every += 2;	
					
					if(every==words.length)
						setTimeout(function(){ 
							document.getElementById("win").style.visibility = "visible";
							document.getElementsByClassName("button-a")[0].style.visibility = "visible";
							document.getElementsByClassName("button-a")[1].style.visibility = "visible";
						}, 2200)
				} else {
					setTimeout(function(){ 
						clicked[0].style.transform = "rotateY(720deg)";
						clicked[1].style.transform = "rotateY(720deg)";							
					}, 1500);
					setTimeout(function(){
						clicked[0].innerHTML = "";
						clicked[1].innerHTML = "";							
					},2000)
					clicked[0].classList.remove("clicked");
					clicked[1].classList.remove("clicked");
				}
				lKlik = 0;
			}
		});
	}
}