<?
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가


?>


<div id="header">
    <div class="header_box"> 
    	<h1><a href="../main/main.php"><img src="../images/header/logo.jpg"></a></h1>


     <form name="fsearchbox" method="get" action="<?php echo G5_BBS_URL ?>/search.php" onsubmit="return fsearchbox_submit(this);">
		<input type="hidden" name="sfl" value="wr_subject||wr_content">
		<input type="hidden" name="sop" value="and">
		<label for="sch_stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
        <ul class="searchTop">
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

        
        <ul class="join_box">
        	<div><a href="/02_offer/planup.php" class="ct-btn green">플랜 등록하기</a></div>
			<?php if (!$member['mb_id']) { ?>
        	<li><a class="modalLink" href="#modal2">회원가입</a></li>
			<li><a class="modalLink" href="#modal1">로그인</a></li>	
			<?php } else { ?>
			<li><a href="<?php echo G5_BBS_URL?>/logout.php">로그아웃</a></li>	<?php } ?>
        </ul>      
    </div>
</div>




<!--로그인창-->

<div class="overlay"></div>

<div id="modal1" class="modal">
      <?php echo outlogin('basic'); // 외부 로그인  ?>
</div>




<!--회원가입창-->
<?php 
	$register_action_url = G5_HTTPS_BBS_URL.'/register_form_update.php';
?>

<div id="modal2" class="modal">
    <p class="closeBtn"><img src="../images/sub04/btn_close.png"></p>
    <dl>
        <dt>회원가입</dt>
        <dd>페이스북 또는 이메일주소로 회원가입 할 수 있습니다.</dd>
    </dl>
    
    <ul class="login">
        <li><a href='#' class="ct-btn2 blue"><img src="../images/sub04/icon_facebook.jpg" class="pr10">페이스북으로 가입</a></li>
        <li class="or">또는</li>
       
	   <form id="fregisterform" name="fregisterform" class="form-1" action="<?php echo $register_action_url ?>" onsubmit="return fregisterform_submit(this);" method="post" enctype="multipart/form-data" autocomplete="off">
		<input type="hidden" name="w" value="<?php echo $w ?>">
		<input type="hidden" name="url" value="<?php echo $urlencode ?>">
		<input type="hidden" name="agree" value="<?php echo $agree ?>">
		<input type="hidden" name="agree2" value="<?php echo $agree2 ?>">
		<input type="hidden" name="cert_type" value="<?php echo $member['mb_certify']; ?>">
		<input type="hidden" name="cert_no" value="">
		<?php if (isset($member['mb_sex'])) {  ?><input type="hidden" name="mb_sex" value="<?php echo $member['mb_sex'] ?>"><?php }  ?>
		<?php if (isset($member['mb_nick_date']) && $member['mb_nick_date'] > date("Y-m-d", G5_SERVER_TIME - ($config['cf_nick_modify'] * 86400))) { // 닉네임수정일이 지나지 않았다면  ?>
		<input type="hidden" name="mb_nick_default" value="<?php echo $member['mb_nick'] ?>">
		<input type="hidden" name="mb_nick" value="<?php echo $member['mb_nick'] ?>">
		<?php }  ?>

        <li class="in">
			<input type="text" name="mb_id" value="<?php echo $member['mb_id'] ?>" id="reg_mb_id" <?php echo $required ?> <?php echo $readonly ?> minlength="3" maxlength="20" placeholder="이메일주소">
		</li>
        <li class="in">
			<input type="password" name="mb_password" id="reg_mb_password" <?php echo $required ?>  minlength="3" maxlength="20" placeholder="비밀번호">
		</li>
        <li class="in">
			<input type="password" name="mb_password_re" id="reg_mb_password_re" <?php echo $required ?> minlength="3" maxlength="20"  placeholder="비밀번호 확인">
		</li>
        <li class="in">
			<input type="text" id="reg_mb_name" name="mb_name" value="<?php echo $member['mb_name'] ?>" <?php echo $required ?> <?php echo $readonly; ?> size="10" placeholder="이름">
		</li>
        <li class="btn"><button type="submit" name="submit" class="ct-btn2 green">회원가입</button></li>
        <li class="check"><input type="checkbox" id="divECI_ISDVSAVE2" class="checkbox-style" /><label for="divECI_ISDVSAVE2"><a href="#">이용약관</a>에 동의합니다.</label></li>

	   </form>

    </ul>
    <div class="mo_bottom">
        <ul class="join">
            <li><a class="modalLink" href="#modal1">계정이 있으신가요?</a></li>
        </ul>
    </div>
</div>




<!--비번찾기창-->

<?
	$action_url = G5_HTTPS_BBS_URL."/password_lost2.php";
?>
<div id="modal3" class="modal">
    <p class="closeBtn"><img src="../images/sub04/btn_close.png"></p>
    <dl>
        <dt>비밀번호 찾기</dt>
        <dd>가입시 입력했던 이메일 주소로 비밀번호 재설정 링크를 보내드립니다.</dd>
    </dl>
    
    <ul class="login">
        <form class="form-1" name="fpasswordlost" action="<?php echo $action_url ?>" onsubmit="return fpasswordlost_submit(this);" method="post" autocomplete="off">
        <li class="in">   <input type="text" name="mb_email" id="mb_email" required  size="30"  placeholder="이메일주소"></li>
        <li class="btn"><button type="submit" name="submit" class="ct-btn2 green">비밀번호 재설정</button></li>
        </form>
    </ul>
    <div class="mo_bottom">
        <ul class="join">
            <li><a class="modalLink" href="#modal1">계정이 있으신가요?</a></li>
        </ul>
    </div>
</div>