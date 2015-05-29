(function($) {

 var hdamall2eFfect = function(element, options){
   var settings = $.extend({}, $.fn.hdamall2effect.defaults, options); //초반 셋팅값 가져오기
     var vars = {
            currentSlide: 0,
			oldSlide: 0,
			startSlide: 0,
			countImage: 0,
            currentImage: '',
			totaltab: 0,	
			currenttab: 0,	
			arrawidth:0,
			arraheight:0,
			arrawidth2:0,
            totalSlides: 0,
            randAnim: '',
            running: false,
            paused: false,
            stop: false
        };

       var slider = $(element);		
	    //이미지사이즈
		 vars.countImage = $(".wrapper-li", slider).length;
		vars.arrawidth = $(".wrapper-li", slider).find("img").width();
	    vars.arraheight = $(".wrapper-li", slider).find("img").height();
 	    slider.find('.wrapper-li').each(function() {
					$(this).css({'z-index': vars.countImage});
			    if(settings.tailType =="number"){ $(".wrapper-Num", slider).append("<span id='tailbtn' class='num' rel='" + vars.totalSlides + "'>" + ( vars.totalSlides + 1 ) + "</span>"); }
				else{ $(".wrapper-Num" , slider).append("<span  id='tailbtn' class='numimg' rel='" + vars.totalSlides + "' ><img src='" + $(this).attr("out") + "' out='" + $(this).attr("out") + "' over='" + $(this).attr("over") + "' border=0></span>"); }
		        //else{ $(".wrapper-Num").append("<span  id='tailbtn' class='numimg' rel='" + vars.totalSlides + "' style='background-image:url(" + $(this).attr("out") + ")' out='" + $(this).attr("out") + "' over='" + $(this).attr("over") + "'>" + vars.totalSlides + "</span>"); }
			
			vars.countImage--;
			vars.totalSlides++;
		});    
	        
    vars.currentSlide = Math.floor(Math.random() * vars.totalSlides);
    vars.oldSlide = vars.currentSlide;
    
	 
          $('.wrapper-li', slider).css({opacity: 0});     
	      $('.wrapper-li', slider).eq(vars.currentSlide).css({opacity: 1});
	  
   
    

    if(settings.tailType =="number"){	$(".num", slider).eq(vars.currentSlide).addClass("active");  }
	else{ $(".numimg", slider).eq(vars.currentSlide).find("img").attr("src", $(".numimg", slider).eq(vars.currentSlide).find("img").attr("over"))  }

	 var timer = 0;
	timer = setInterval(function(){ imgeffectRun(slider, settings, false); }, settings.pauseTime);




	var imgeffectRun = function(slider, settings, nudge){
       //Trigger the lastSlide callback
	     
            if(vars && (vars.currentSlide == vars.totalSlides - 1)){ 
				settings.lastSlide.call(this);
			}
            if((!vars || vars.stop) && !nudge) return false;
			settings.beforeChange.call(this);
			vars.currentSlide++;		
			
			if(vars.currentSlide == vars.totalSlides){ 
				vars.currentSlide = 0;
				settings.slideshowEnd.call(this);
			}
			if(settings.tailType =="number"){
                $(".num", slider).removeClass("active");
				$(".num", slider).eq(vars.currentSlide).addClass("active");
			}else{
				slider.find('.numimg').each(function() {
                 $(this).find("img").attr("src",$(this).find("img").attr("out"));			
				});

                $(".numimg", slider).eq(vars.currentSlide).find("img").attr("src",$(".numimg", slider).eq(vars.currentSlide).find("img").attr("over"));
			}
            
		
                  
			    $('.wrapper-li', slider).eq(vars.oldSlide).css({'z-index':1, opacity: 1}).animate({opacity: 0}, settings.animSpeed, '',function(){   $(this).css({opacity : 0});	 });
                $('.wrapper-li', slider).eq(vars.currentSlide).find(".part").css({opacity:0});
				
				$('.wrapper-li', slider).eq(vars.currentSlide).css({'z-index':10,opacity: 0}).animate({opacity: 1}, settings.animSpeed,'',function(){ 
				$('.wrapper-li', slider).eq(vars.currentSlide).find(".part[rel=0]").css({opacity:0}).animate({opacity:1}, (settings.animSpeed ));
				$('.wrapper-li', slider).eq(vars.currentSlide).find(".part[rel=1]").css({opacity:0}).animate({opacity:1}, (settings.animSpeed + 600));
				$('.wrapper-li', slider).eq(vars.currentSlide).find(".part[rel=2]").css({opacity:0, left:50+'px'}).animate({opacity:1, left:0+'px'}, (settings.animSpeed + 1000));
$('.wrapper-li', slider).eq(vars.currentSlide).find(".part[rel=3]").css({opacity:0}).animate({opacity:1}, (settings.animSpeed - 500)).animate({opacity:0}, (settings.animSpeed - 500)).animate({opacity:1}, (settings.animSpeed - 500)).animate({opacity:0}, (settings.animSpeed - 500)).animate({opacity:1}, (settings.animSpeed - 500)).animate({opacity:0}, (settings.animSpeed - 500)).animate({opacity:1}, (settings.animSpeed - 500)).animate({opacity:0}, (settings.animSpeed - 500)).animate({opacity:1}, (settings.animSpeed - 500)).animate({opacity:0}, (settings.animSpeed - 500)).animate({opacity:1}, (settings.animSpeed - 500)).animate({opacity:0}, (settings.animSpeed - 500)).animate({opacity:1}, (settings.animSpeed - 500));
				
				});	
				


		

          vars.oldSlide = vars.currentSlide;
	}
   imgeffectRun(slider, settings, false);
   $("#tailbtn", slider).click(function(){
	      vars.currentSlide = $(this).index() -1;
		imgeffectRun(slider,  settings, false);
           
   });
  $(".prev", slider).click(function(){ 
        vars.currentSlide = vars.currentSlide -2;
		imgeffectRun(slider,  settings, false);
  });
    $(".next", slider).click(function(){ 
     
		imgeffectRun(slider,  settings, true);
  });

   //오버설정
    slider.hover(function(){
                vars.paused = true;
                clearInterval(timer);
                timer = '';              

            }, function(){
                vars.paused = false;
				
                //Restart the timer
				if(timer == '' && !settings.manualAdvance){
					timer = setInterval(function(){   imgeffectRun(slider,  settings, false);	}, settings.pauseTime);
				}
      });
	
      

   settings.afterLoad.call(this);
	return this;
	 };


  
 $.fn.hdamall2effect = function(options) {
    //데이터 로딩셋팅
        return this.each(function(key, value){
            var element = $(this);
			
			 hdamall2eFfect($(element), options);
        });

	};

//Default settings
	$.fn.hdamall2effect.defaults = {
		animSpeed: 1500, //이벤트 속도
		pauseTime: 6000, //대기시간
		moveType: "top", //이동방향
		tailType: "number", //버튼타입
		pauseOnHover: true,
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){},
        lastSlide: function(){},
        afterLoad: function(){}
	};
	
	$.fn._reverse = [].reverse;

})(jQuery);

