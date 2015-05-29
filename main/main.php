<?
//
include_once("_common.php");

$bo_table = "main";  

include "../head.php";
?>


<div id="visual">
    <div class="visual_box">
        <ul class="copy">
            <li class="main">Exciting Everyday</li>
            <li class="sub">매일매일 신나는 이벤트가 당신을 기다리고 있습니다!</li>
        </ul>
        
        
		
     <form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);">
		<input type="hidden" name="sfl" value="wr_subject||wr_content">
		<input type="hidden" name="sop" value="and">
		<label for="sch_stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
        <ul class="search">
        	<li>
				<input type="text"  name="stx" id="sch_stx" maxlength="20" placeholder="어떤 놀이를 찾고 싶으세요?" />
			</li>
            <li><button type="submit" ></button></li>
        </ul>
	</form>
<script>
	function fsearchbox_submit(f)
	{
		if (f.stx.value.length < 2) {
			alert("검색어는 두글자 이상 입력하십시오.");
			f.stx.select();
			f.stx.focus();
			return false;
		}

		// 검색에 많은 부하가 걸리는 경우 이 주석을 제거하세요.
		var cnt = 0;
		for (var i=0; i<f.stx.value.length; i++) {
			if (f.stx.value.charAt(i) == ' ')
				cnt++;
		}

		if (cnt > 1) {
			alert("빠른 검색을 위하여 검색어에 공백은 한개만 입력할 수 있습니다.");
			f.stx.select();
			f.stx.focus();
			return false;
		}

		return true;
	}
</script>



    </div>
</div>



<!--새로운이벤트-->
<div id="Event" class="bg1">
    <div class="Event_box">
        <div class="Event_tit"><b>새로운 플랜</b>을 만나보세요!</div>
        
        <div class="Event_con">
            <div class="Event_con_list mr30">
                <p class="img"><a href="../01_user/plan_detail.php"><img src="../images/main/temp.jpg" /></a></p>                
                <dl>
                    <dt><a href="../01_user/plan_detail.php"><b>[바다체험]</b>성지라고 불리는 바다에서 박력 만점의 고래를 만나자!</a></dt>
                    <dd class="location">부산/경남>해운대구</dd>
                    <dd class="price">30,000원</dd>
                </dl>
            </div>
            
            <div class="Event_con_list mr30">
                <p class="img"><a href="../01_user/plan_detail.php"><img src="../images/main/temp.jpg" /></a></p>                
                <dl>
                    <dt><a href="../01_user/plan_detail.php"><b>[바다체험]</b>성지라고 불리는 바다에서 박력 만점의 고래를 만나자!</a></dt>
                    <dd class="location">부산/경남>해운대구</dd>
                    <dd class="price">30,000원</dd>
                </dl>
            </div>
            
            <div class="Event_con_list mr30">
                <p class="img"><a href="../01_user/plan_detail.php"><img src="../images/main/temp.jpg" /></a></p>                
                <dl>
                    <dt><a href="../01_user/plan_detail.php"><b>[바다체험]</b>성지라고 불리는 바다에서 박력 만점의 고래를 만나자!</a></dt>
                    <dd class="location">부산/경남>해운대구</dd>
                    <dd class="price">30,000원</dd>
                </dl>
            </div>
            
            <div class="Event_con_list">
                <p class="img"><a href="../01_user/plan_detail.php"><img src="../images/main/temp.jpg" /></a></p>                
                <dl>
                    <dt><a href="../01_user/plan_detail.php"><b>[바다체험]</b>성지라고 불리는 바다에서 박력 만점의 고래를 만나자!</a></dt>
                    <dd class="location">부산/경남>해운대구</dd>
                    <dd class="price">30,000원</dd>
                </dl>
            </div>
        </div><!--//Event_con-->
        <div class="Event_btn"><a href="../01_user/plan_list.php" class="ct-btn2 green">더 많은 플랜보기</a></div>
    </div><!--//Event_box-->
</div>



<!--인기이벤트-->
<div id="Event" class="bg2">
    <div class="Event_box">
        <div class="Event_tit2"><b>인기있는 플랜</b>을 한 눈에!</div>
        
        <div class="Event_con">
            <div class="Event_con_list2 mr30">
            	<div class="Lv"><img src="../images/main/Lv1.png" /></div>
                <p class="img"><a href="../01_user/plan_detail.php"><img src="../images/main/temp.jpg" /></a></p>                
                <dl>
                    <dt><a href="../01_user/plan_detail.php"><b>[바다체험]</b>성지라고 불리는 바다에서 박력 만점의 고래를 만나자!</a></dt>
                    <dd class="location">부산/경남>해운대구</dd>
                    <dd class="price">30,000원</dd>
                </dl>
            </div>
            
            <div class="Event_con_list2 mr30">
            	<div class="Lv"><img src="../images/main/Lv2.png" /></div>
                <p class="img"><a href="../01_user/plan_detail.php"><img src="../images/main/temp.jpg" /></a></p>                
                <dl>
                    <dt><a href="../01_user/plan_detail.php"><b>[바다체험]</b>성지라고 불리는 바다에서 박력 만점의 고래를 만나자!</a></dt>
                    <dd class="location">부산/경남>해운대구</dd>
                    <dd class="price">30,000원</dd>
                </dl>
            </div>
            
            <div class="Event_con_list2 mr30">
            	<div class="Lv"><img src="../images/main/Lv3.png" /></div>
                <p class="img"><a href="../01_user/plan_detail.php"><img src="../images/main/temp.jpg" /></a></p>                
                <dl>
                    <dt><a href="../01_user/plan_detail.php"><b>[바다체험]</b>성지라고 불리는 바다에서 박력 만점의 고래를 만나자!</a></dt>
                    <dd class="location">부산/경남>해운대구</dd>
                    <dd class="price">30,000원</dd>
                </dl>
            </div>
            
            <div class="Event_con_list2">
            	<div class="Lv"><img src="../images/main/Lv4.png" /></div>
                <p class="img"><a href="../01_user/plan_detail.php"><img src="../images/main/temp.jpg" /></a></p>                
                <dl>
                    <dt><a href="../01_user/plan_detail.php"><b>[바다체험]</b>성지라고 불리는 바다에서 박력 만점의 고래를 만나자!</a></dt>
                    <dd class="location">부산/경남>해운대구</dd>
                    <dd class="price">30,000원</dd>
                </dl>
            </div>
        </div><!--//Event_con-->
        <div class="Event_btn"><a href="../01_user/all_ranking.php" class="ct-btn2 green">더 많은 플랜보기</a></div>
    </div><!--//Event_box-->
</div>



<!--함께놀아요-->
<div id="Event" class="bg3">
    <div class="Event_box">
        <div class="Event_tit">우리 <b>함께</b> 놀아요!</div>
        
        <div class="Event_con">
            <div class="Event_con_list mr30">
                <p class="img"><a href="../01_user/plan_detail.php"><img src="../images/main/temp.jpg" /></a></p>                
                <dl>
                    <dt><a href="../01_user/plan_detail.php"><b>[바다체험]</b>성지라고 불리는 바다에서 박력 만점의 고래를 만나자!</a></dt>
                    <dd class="location">부산/경남>해운대구</dd>
                    <dd class="time">2015-06-17</dd>
                    <dd class="person">현재인원 2명(최소 5명)</dd>
                    <dd class="price">30,000원</dd>
                </dl>
            </div>
            
            <div class="Event_con_list mr30">
                <p class="img"><a href="../01_user/plan_detail.php"><img src="../images/main/temp.jpg" /></a></p>                
                <dl>
                    <dt><a href="../01_user/plan_detail.php"><b>[바다체험]</b>성지라고 불리는 바다에서 박력 만점의 고래를 만나자!</a></dt>
                    <dd class="location">부산/경남>해운대구</dd>
                    <dd class="time">2015-06-17</dd>
                    <dd class="person">현재인원 2명(최소 5명)</dd>
                    <dd class="price">30,000원</dd>
                </dl>
            </div>
            
            <div class="Event_con_list mr30">
                <p class="img"><a href="../01_user/plan_detail.php"><img src="../images/main/temp.jpg" /></a></p>                
                <dl>
                    <dt><a href="../01_user/plan_detail.php"><b>[바다체험]</b>성지라고 불리는 바다에서 박력 만점의 고래를 만나자!</a></dt>
                    <dd class="location">부산/경남>해운대구</dd>
                    <dd class="time">2015-06-17</dd>
                    <dd class="person">현재인원 2명(최소 5명)</dd>
                    <dd class="price">30,000원</dd>
                </dl>
            </div>
            
            <div class="Event_con_list">
                <p class="img"><a href="../01_user/plan_detail.php"><img src="../images/main/temp.jpg" /></a></p>                
                <dl>
                    <dt><a href="../01_user/plan_detail.php"><b>[바다체험]</b>성지라고 불리는 바다에서 박력 만점의 고래를 만나자!</a></dt>
                    <dd class="location">부산/경남>해운대구</dd>
                    <dd class="time">2015-06-17</dd>
                    <dd class="person">현재인원 2명(최소 5명)</dd>
                    <dd class="price">30,000원</dd>
                </dl>
            </div>
        </div><!--//Event_con-->
        <div class="Event_btn"><a href="#" class="ct-btn2 green">더 많은 플랜보기</a></div>
    </div><!--//Event_box-->
</div>

<? include "../tail.php"; ?>