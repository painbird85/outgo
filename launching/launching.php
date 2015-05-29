<?
//
include_once("_common.php");

$bo_table = "launching";  

?>


<link rel="stylesheet" href="css/launching.css" type="text/css">
<script type="text/javascript" src="js/jquery.banner2.js"></script>
<script type="text/javascript" src="../js/jquery-1.8.3.min.js"></script>
<script type="text/javascript" src="../js/jquery.menu.js"></script>
<script type="text/javascript" src="../js/common.js"></script>

<div id="wrap22">
	<!--상단-->
	<div id="header22">
    	<div class="header_box22">
        	<div class="mtit22"><img src="images/01/top_outgo.png" alt="아웃고에 오신것을 환영합니다!" /></div>
            
            <ul class="top22">
            	<li class="name"><img src="images/01/text1.png"></li>
                <li class="text"><img src="images/01/text2.png"></li>
                <li class="btn">
                	<div class="top22_btn1"><a href="#use"><img src="images/01/btn1.png"></a></div>
                    <div class="top22_btn2"><a href="#offer"><img src="images/01/btn2.png"></a></div>
                </li>
            </ul>
        </div>
    </div>
    
    
    
    <!--콘텐츠-사용자-->
    	<div class="con_box22" id="use">
         	<ul class="prcon" id="prcon">
            	 <li id="prcon_cont1"><img src="images/02/img1.png"></li>
                 <li id="prcon_cont2"><img src="images/02/img2.png"></li>
                 <li id="prcon_cont3"><img src="images/02/img3.png"></li>
                 <li id="prcon_cont4"><img src="images/02/img4.png"></li>
                 <li id="prcon_cont5"><img src="images/02/img5.png"></li>
             </ul>
            
            <ul class="control" id="prcontrol">
                <li class="left"><a class="btn-prev"><img src="images/02/ar1.png" alt="이전"></a></li>
                <li class="right"><a class="btn-next"><img src="images/02/ar2.png" alt="다음"></a></li>
            </ul>
            
            <script type="text/javascript" src="js/popupzone.js"></script>
            <script type="text/javascript" language="javascript">popupzone.setBans();</script> 
        </div>
    </div>
    
    
    
	<!--콘텐츠-제공자-->
    <div id="container22">
        <div class="con_box22" id="offer">
                <ul class="prcon2" id="prcon2">
                     <li id="prcon_cont1"><img src="images/03/img1.png"></li>
                     <li id="prcon_cont2"><img src="images/03/img2.png"></li>
                     <li id="prcon_cont3"><img src="images/03/img3.png"></li>
                     <li id="prcon_cont4"><img src="images/03/img4.png"></li>
                     <li id="prcon_cont5"><img src="images/03/img5.png"></li>
                 </ul>
                
                 <ul class="control" id="prcontrol2">
                    <li class="left"><a class="btn-prev"><img src="images/02/ar1.png" alt="이전"></a></li>
               		<li class="right"><a class="btn-next"><img src="images/02/ar2.png" alt="다음"></a></li>
                 </ul>
                
                <script type="text/javascript" src="js/popupzone2.js"></script>
                <script type="text/javascript" language="javascript">popupzone.setBans();</script> 
            </div>
        </div>
    </div>
    
    
    
    <!--하단-->
    <div id="footer22">
        <dl class="with">
            <dt><img src="images/04/text.png" alt="with outgo" /></dt>
            <dd><img src="images/04/con1.png" /></dd>
            <dd><img src="images/04/con2.png" /></dd>
            <dd><img src="images/04/con3.png" /></dd>
            <dd><img src="images/04/con4.png" /></dd>
            <dd><img src="images/04/con5.png" /></dd>
            <dd><img src="images/04/con6.png" /></dd>
            <dd class="last"><img src="images/04/con7.png" /></dd>
        </dl>
    </div>    
    
    <div id="footer33">
    	<div class="footer33_box">
        	Coptright(c) 2015 <b>OUTGO</b> All right reserved.
        </div>
    </div>
    
    
</div><!--//wrap-->
