<div id="header">
    <div class="header_box"> 
    	<h1><a href="../main/main.php"><img src="../images/header/logo.jpg"></a></h1>
        
        <ul class="searchTop">
        	<li><input type="text" name="search" placeholder="어떤 놀이를 찾고 싶으세요?" /></li>
            <li><button type="submit"></button></li>
        </ul>
        
        <ul class="join_box">
        	<div><a href="/02_offer/planup.php" class="ct-btn green">플랜 등록하기</a></div>
        	<li><a class="modalLink" href="#modal2">회원가입</a></li>
            <li><a class="modalLink" href="#modal1">로그인</a></li>
        </ul>      
    </div>
</div>



<!--로그인창-->
<div class="overlay"></div>

<div id="modal1" class="modal">
    <p class="closeBtn"><img src="../images/sub04/btn_close.png"></p>
    <dl>
        <dt>로그인</dt>
        <dd>페이스북 또는 이메일주소로 로그인 할 수 있습니다.</dd>
    </dl>
    
    <ul class="login">
        <li><a href="#" class="ct-btn2 blue"><img src="../images/sub04/icon_facebook.jpg" class="pr10">페이스북 로그인</a></li>
        <li class="or">또는</li>
        <form class="form-1">
        <li class="in"><input type="text" name="login" placeholder="이메일주소"></li>
        <li class="in"><input type="password" name="password" placeholder="비밀번호"></li>
        <li class="btn"><button type="submit" name="submit" class="ct-btn2 green">로그인</button></li>
        <li class="check"><input type="checkbox" id="divECI_ISDVSAVE" class="checkbox-style" /><label for="divECI_ISDVSAVE">로그인 상태 유지</label></li>
        </form>
    </ul>
    <div class="mo_bottom">
        <ul class="join">
            <li class="pw"><a class="modalLink" href="#modal3">비밀번호를 잊으셨나요?</a></li>
            <li class="member"><a class="modalLink" href="#modal2">아직 회원이 아니신가요?</a></li>
        </ul>
    </div>
</div>



<!--회원가입창-->
<div id="modal2" class="modal">
    <p class="closeBtn"><img src="../images/sub04/btn_close.png"></p>
    <dl>
        <dt>회원가입</dt>
        <dd>페이스북 또는 이메일주소로 회원가입 할 수 있습니다.</dd>
    </dl>
    
    <ul class="login">
        <li><a href="#" class="ct-btn2 blue"><img src="../images/sub04/icon_facebook.jpg" class="pr10">페이스북으로 가입</a></li>
        <li class="or">또는</li>
        <form class="form-1">
        <li class="in"><input type="text" name="" placeholder="이메일주소"></li>
        <li class="in"><input type="text" name="" placeholder="비밀번호"></li>
        <li class="in"><input type="text" name="" placeholder="비밀번호 확인"></li>
        <li class="in"><input type="text" name="" placeholder="이름"></li>
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
<div id="modal3" class="modal">
    <p class="closeBtn"><img src="../images/sub04/btn_close.png"></p>
    <dl>
        <dt>비밀번호 찾기</dt>
        <dd>가입시 입력했던 이메일 주소로 비밀번호 재설정 링크를 보내드립니다.</dd>
    </dl>
    
    <ul class="login">
        <form class="form-1">
        <li class="in"><input type="text" name="" placeholder="이메일주소"></li>
        <li class="btn"><button type="submit" name="submit" class="ct-btn2 green">비밀번호 재설정</button></li>
        </form>
    </ul>
    <div class="mo_bottom">
        <ul class="join">
            <li><a class="modalLink" href="#modal1">계정이 있으신가요?</a></li>
        </ul>
    </div>
</div>