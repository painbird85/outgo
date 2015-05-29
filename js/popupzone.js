



var popupzone ={

	img_obj:null,num_obj:null,subSeq:0,
	setBans:function(){
		var this_s = this;

		//각 탭에 해당하는 이미지 리스트 객체 및 버튼 객체 지정
		this.img_obj = $("#prcon li");
		this.num_obj = $("#prnum a");
		//this.num_obj = $(".m-rolling-num .pbtns");	 //버튼형식일때
		
		this.isPlay = true;
		$("#prcontrol .btn-play").hide();
		//번호 아이콘
		var numItems = $(this.num_obj);
		//var numItems = $("> button",this.num_obj);
		for (var j=0;j<numItems.length ;j++ )
		{
			$(numItems[j]).attr("seq",j+1);
			//$(numItems[j]).bind("mouseover",function(){	this_s.setBanner($(this).attr("seq"),false);});
			//$(numItems[j]).bind("focus",function(){	this_s.setBanner($(this).attr("seq"),false);});
			//$(numItems[j]).bind("mouseout",function(){	this_s.setNextBanImgs();});
			$(numItems[j]).bind("click",function(){	this_s.setBanner($(this).attr("seq"),false); return false; });
			//$(numItems[j]).bind("blur",function(){	this_s.setNextBanImgs();});
		}
		
		$("#prcontrol .btn-play").bind("click",function(){this_s.isPlay = true; $(this).hide(); $("#prcontrol .btn-stop").show(); this_s.setBanner(this_s.subSeq);});
		$("#prcontrol .btn-stop").bind("click",function(){this_s.isPlay = false; $(this).hide();$("#prcontrol .btn-play").show(); this_s.stopBan();});
		$("#prcontrol .btn-next").bind("click",function(){this_s.goNext();});
		$("#prcontrol .btn-prev").bind("click",function(){this_s.goPrev();});

		this.initBanner(0);
		this.setBanner(1);
		

		//this.getListStr();
	},

	initBanner:function(num){
		var this_s = this;
		if (num==undefined || num<1)	var num = 1;
		
		var subItems = this.img_obj;
		subItems.each(function(i,el){
			$(el).css({"position":"absolute","display":"block","float":"","left":0,"top":0});//"left":0,"top":0,
			$(el).bind("mouseover",function(){ this_s.stopBan(); });

			$(el).bind("mouseout",function(){ this_s.setBanner(this_s.subSeq); });
			$(">a",$(el)).each(function(){
				$(this).attr("subseq",i+1);
			});
			

		});
		

	},
	
	setBanner:function(num,func){
		clearTimeout(this.Timer);		
		var this_s = this;
		
		if (num==undefined)	num = 1 ;

		var obj = this.img_obj;
		obj.subItems =  this.img_obj;

		var numItems= $(this.num_obj);
		//var numItems= $("button",this.num_obj);
		
		if(this.subSeq!=num){
		for (var i=0; i<obj.subItems.length; i++){
			var numImgObj = $("img",$(numItems[i]));
			if ( (i+1)==num ){
				$(numItems[i]).stop().addClass("over");

				$(obj.subItems[i]).stop().show();
				$(obj.subItems[i]).stop().animate({"opacity":"1"});

			}else{
				$(numItems[i]).stop().removeClass("over");

				$(obj.subItems[i]).stop().animate({"opacity":"0"},function(){$(this).hide();});
			}
		}
		this.subSeq = num;
		}


		if(func==undefined && this.isPlay) this_s.setNextBanImgs();//this.Timer = setTimeout(function(){this_s.setBanner(nextTab,nextNum);},3000);
		else if(func==false) {
		}

	}	,
	setNextBanImgs:function(){
		clearTimeout(this.Timer);		
		var this_s = this;
		var nextNum = parseInt(this_s.subSeq) + 1;
		if(nextNum>  this.img_obj.length){
			nextNum = 1;
		}

		this.Timer = setTimeout(function(){this_s.setBanner(nextNum);},6000);

	},
	stopBan:function(){clearTimeout(this.Timer);},
	goNext:function(){
		clearTimeout(this.Timer);		
		var this_s = this;
		var nextNum = parseInt(this_s.subSeq) + 1;
		if(nextNum> this.img_obj.length){
			nextNum = 1;
		}
		this_s.setBanner(nextNum);
	},
	goPrev:function(){
		clearTimeout(this.Timer);		
		var this_s = this;
		var nextNum = parseInt(this_s.subSeq) - 1;
		if(nextNum<1){
			nextNum =  this.img_obj.length;
		}
		this_s.setBanner(nextNum);
	}
}


