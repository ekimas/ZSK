var plansza = [];
var clickX;
var clickY;

$(document).ready(function(){
	
	// Generowanie planszy
	for(var i = 0; i < 2; i++){
		plansza[i] = [];
		for(var j = 0; j < 2; j++){
			plansza[i][j] = $('<div class="mem"></div>');
			$("#plansza").append(plansza[i][j]);
		}
	}



	setImage();

	// Ustawianie obrazków
	function setImage()
	{
		var o = 1;
		var licznik = 0;

		var i = 0;
		do {
			var x = Math.floor(2*Math.random());
			var y = Math.floor(2*Math.random());
			
			if(!plansza[x][y].hasClass("image")){
				plansza[x][y].addClass("image");
				plansza[x][y].addClass("image"+o);

				i++;
				licznik++;
			}
			if(licznik == 2)
			{
				o++;
				licznik = 0;
			}


		}while(i<4);
	}

	var every = 0;
	var fKlik;
	var lKlik = 0;
	var imgs = document.querySelectorAll(".image");
	for(let j = 0; j<imgs.length; j++)
	{
		imgs[j].addEventListener("click", function(){
			lKlik++;
			var name = imgs[j].className;
			var pom = name[name.length-1];
			if(lKlik == 1)
			{
				fKlik = pom;
			}
			imgs[j].style.transform = "rotateY(180deg)";
			$(this).addClass("clicked");
			setTimeout(function(){ imgs[j].style.backgroundImage = "url('./assets/k"+pom+".jpg')"; }, 400);
			
			if(lKlik == 2)
			{
				var clicked = document.querySelectorAll(".clicked");
				if(fKlik==pom)
				{
					setTimeout(function(){ 
						clicked[0].style.transform = "rotateY(360deg)";
						clicked[1].style.transform = "rotateY(360deg)";						
					}, 1500);
					setTimeout(function(){
						clicked[0].style.backgroundImage = "";
						clicked[1].style.backgroundImage = "";
					},2000)
					setTimeout(function(){
						clicked[0].style.visibility = "hidden";
						clicked[1].style.visibility = "hidden"; 
					}, 2100);
					clicked[0].classList.remove("clicked");
					clicked[1].classList.remove("clicked");
					every += 2;	
					
					if(every==imgs.length)
						setTimeout(function(){ alert("YOU WIN!!"); }, 2200)
				} else {
					setTimeout(function(){ 
						clicked[0].style.transform = "rotateY(360deg)";
						clicked[1].style.transform = "rotateY(360deg)";
						
					}, 1500);
					setTimeout(function(){
						clicked[0].style.backgroundImage = "";
						clicked[1].style.backgroundImage = "";
						
					},2000)
					clicked[0].classList.remove("clicked");
					clicked[1].classList.remove("clicked");
				}
				lKlik = 0;
			}
		});
	}	
});