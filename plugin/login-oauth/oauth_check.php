<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

if(!trim($mb_id) || !trim($token_value)) {
	alert_close("정보가 제대로 넘어오지 않아 오류가 발생했습니다.");
}

// 회원아이디 - 최대 20자
$mb_id = $mb_gubun.substr($mb_id,0,18);

// 회원정보
$mb = get_member($mb_id);

$register_script = '';
if($mb['mb_id']) { // 가입된 회원이면

	// 차단된 아이디인가?
	if ($mb['mb_intercept_date'] && $mb['mb_intercept_date'] <= date("Ymd", G5_SERVER_TIME)) {
		$date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_intercept_date']);
		alert_close('회원님의 아이디는 접근이 금지되어 있습니다.\n처리일 : '.$date);
	}

	// 탈퇴한 아이디인가?
	if ($mb['mb_leave_date'] && $mb['mb_leave_date'] <= date("Ymd", G5_SERVER_TIME)) {
		$date = preg_replace("/([0-9]{4})([0-9]{2})([0-9]{2})/", "\\1년 \\2월 \\3일", $mb['mb_leave_date']);
		alert_close('탈퇴한 아이디이므로 접근하실 수 없습니다.\n탈퇴일 : '.$date);
	}

	@include_once($member_skin_path.'/login_check.skin.php');

	// 회원아이디 세션 생성
	set_session('ss_mb_id', $mb['mb_id']);

	// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
	set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

	// 포인트 체크
	if($config['cf_use_point']) {
		$sum_point = get_point_sum($mb['mb_id']);

		$sql= " update {$g5['member_table']} set mb_point = '$sum_point' where mb_id = '{$mb['mb_id']}' ";
		sql_query($sql);
	}

	set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);

} else {
	include_once(G5_LIB_PATH.'/register.lib.php');
	include_once(G5_LIB_PATH.'/mailer.lib.php');

	// 동일닉네임이 존재하면 임시닉네임 발급
	$is_nick = false;
	if (exist_mb_nick($mb_nick, $mb_id)) {
		$is_nick = true;
		$mb_nick = $mb_nick.rand(000,999);
	}

	$mb_name = clean_xss_tags($mb_name);

	$is_email = false;
	if ($mb_email) {
		$is_email = true;
		if (valid_mb_email($mb_email)) $is_email = false;
		if ($is_email) {
			if (prohibit_mb_email($mb_email)) $is_email = false;
		}
		if ($is_email) {
			if (exist_mb_email($mb_email, $mb_id)) $is_email = false;
		}
		if ($is_email) {
			$mb_email = get_email_address($mb_email);
			if(!$mb_email) $is_email = false;
		}
	}

	// 스크립트 알림
	$msg_alert = '회원가입을 축하드립니다.\n\n쪽지로 아이디와 임시비밀번호가 발송되었습니다.';
	$is_email_certify = false;
	if(!$is_email) {
		$mb_email = '';
		$msg_alert .= '\n\n쪽지 확인후 이메일을 등록해 주세요.';
		if($config['cf_use_email_certify']) $is_email_certify = true;
	}

	//이메일인증
	$mb_email_certify = ($config['cf_use_email_certify'] && !$mb_email) ? '' : G5_TIME_YMDHIS;

	//임시비밀번호 생성 - 10자리
	$arr_pw = str_split('abcdefghijklmnopqrstuvwxyz012345678901234567890123456789');
	shuffle($arr_pw); 
	$tmp_pw = implode('',array_slice($arr_pw,0,10));

	// 사용자 코드 실행
	@include_once($member_skin_path.'/register_form_update.head.skin.php');

    $sql = " insert into {$g5['member_table']}
                set mb_id = '{$mb_id}',
                     mb_password = '".sql_password($tmp_pw)."',
                     mb_name = '{$mb_name}',
                     mb_nick = '{$mb_nick}',
                     mb_nick_date = '".G5_TIME_YMD."',
                     mb_email = '{$mb_email}',
                     mb_today_login = '".G5_TIME_YMDHIS."',
                     mb_datetime = '".G5_TIME_YMDHIS."',
                     mb_ip = '{$_SERVER['REMOTE_ADDR']}',
                     mb_level = '{$config['cf_register_level']}',
                     mb_login_ip = '{$_SERVER['REMOTE_ADDR']}',
					 mb_email_certify = '{$mb_email_certify}' ";
	sql_query($sql);

    // 회원가입 포인트 부여
    insert_point($mb_id, $config['cf_register_point'], '회원가입 축하', '@member', $mb_id, '회원가입');

    // 회원님께 메일 발송
	$config['cf_use_email_certify'] = ''; //메일인증 url 출력안함
    if ($config['cf_email_mb_member'] && $mb_email) {
        $subject = '['.$config['cf_title'].'] 회원가입을 축하드립니다.';

        $mb_md5 = md5($mb_id.$mb_email.G5_TIME_YMDHIS);
        $certify_href = G5_BBS_URL.'/email_certify.php?mb_id='.$mb_id.'&amp;mb_md5='.$mb_md5;

        ob_start();
        include_once (G5_BBS_PATH.'/register_form_update_mail1.php');
        $content = ob_get_contents();
        ob_end_clean();

        mailer($config['cf_admin_email_name'], $config['cf_admin_email'], $mb_email, $subject, $content, 1);

        // 메일인증을 사용하는 경우 가입메일에 인증 url이 있으므로 인증메일을 다시 발송되지 않도록 함
        if($config['cf_use_email_certify'])
            $old_email = $mb_email;
    }

    // 최고관리자님께 메일 발송
    if ($config['cf_email_mb_super_admin']) {
        $subject = '['.$config['cf_title'].'] '.$mb_nick .' 님께서 회원으로 가입하셨습니다.';

        ob_start();
        include_once ('./register_form_update_mail2.php');
        $content = ob_get_contents();
        ob_end_clean();

        mailer($mb_nick, $mb_email, $config['cf_admin_email'], $subject, $content, 1);
    }

	// 신규회원 쿠폰발생
	$is_coupon = false;
	if($default['de_member_reg_coupon_use'] && $default['de_member_reg_coupon_term'] > 0 && $default['de_member_reg_coupon_price'] > 0) {
		$j = 0;
		$create_coupon = false;

		do {
			$cp_id = get_coupon_id();

			$sql3 = " select count(*) as cnt from {$g5['g5_shop_coupon_table']} where cp_id = '$cp_id' ";
			$row3 = sql_fetch($sql3);

			if(!$row3['cnt']) {
				$create_coupon = true;
				break;
			} else {
				if($j > 20)
					break;
			}
		} while(1);

		if($create_coupon) {
			$cp_subject = '신규 회원가입 축하 쿠폰';
			$cp_method = 2;
			$cp_target = '';
			$cp_start = G5_TIME_YMD;
			$cp_end = date("Y-m-d", (G5_SERVER_TIME + (86400 * ((int)$default['de_member_reg_coupon_term'] - 1))));
			$cp_type = 0;
			$cp_price = $default['de_member_reg_coupon_price'];
			$cp_trunc = 1;
			$cp_minimum = $default['de_member_reg_coupon_minimum'];
			$cp_maximum = 0;

			$sql = " INSERT INTO {$g5['g5_shop_coupon_table']}
						( cp_id, cp_subject, cp_method, cp_target, mb_id, cp_start, cp_end, cp_type, cp_price, cp_trunc, cp_minimum, cp_maximum, cp_datetime )
					VALUES
						( '$cp_id', '$cp_subject', '$cp_method', '$cp_target', '$mb_id', '$cp_start', '$cp_end', '$cp_type', '$cp_price', '$cp_trunc', '$cp_minimum', '$cp_maximum', '".G5_TIME_YMDHIS."' ) ";

			$res = sql_query($sql, false);

			if($res)
				$is_coupon = true;
		}
	}

	// 회원님께 쪽지 발송
	$tmp_row = sql_fetch(" select max(me_id) as max_me_id from {$g5['memo_table']} ");
	$me_id = $tmp_row['max_me_id'] + 1;  //'max_me_id 증가하기
	$send_mb_id = $config['cf_admin'];  //보낸사람 아이디 적기
	$recv_mb_id = $mb_id;  //가입자 쪽지함으로 이동

	$me_memo = '회원가입을 진심으로 축하합니다.\n\n';
	$me_memo .= '회원님께 발급된 아이디는 '.$mb_id.' 이며, 임시비밀번호는 '.$tmp_pw.' 입니다.\n\n';
	$me_memo .= '회원님의 비밀번호는 아무도 알 수 없는 암호화 코드로 저장되므로 안심하셔도 좋습니다.\n\n';
	if($is_nick) {
		$me_memo .= '닉네임은 동일 닉네임이 있어 '.$mb_nick.' 으로 변경되었습니다.\n\n';
	}
	if(!$is_email) {
		$me_memo .= '현재 회원님은 등록과정에서 이메일 주소가 등록되지 않았습니다.\n\n';
		$me_memo .= ($is_email_certify) ? '하단의 회원정보 수정을 클릭하셔서 이메일 등록 후 이메일 인증을 하셔야 합니다.\n\n' : '하단의 회원정보 수정을 클릭하셔서 이메일을 등록해 주세요.\n\n';
	}
	$me_memo .= '발급된 아이디와 임시비밀번호로 닉네임, 비밀번호, 이메일 등 회원님의 정보를 수정할 수 있습니다.\n\n';
	$me_memo .= '아이디, 비밀번호 분실시에는 등록하신 이메일 주소를 이용하여 찾을 수 있습니다.\n\n';
	$me_memo .= '회원 탈퇴는 언제든지 가능하며 일정기간이 지난 후, 회원님의 정보는 삭제하고 있습니다.\n\n';
	if($default['de_member_reg_coupon_use'] && $is_coupon) {
		$msg_coupon = ($default['de_member_reg_coupon_minimum']) ? '(주문금액 '.display_price($default['de_member_reg_coupon_minimum']).'이상)' : '';
		$me_memo .= '회원가입 축하선물로 주문시 사용하실 수 있는 '.display_price($default['de_member_reg_coupon_price']).' 할인'.$msg_coupon.' 쿠폰이 발행됐습니다.\n\n';
		$me_memo .= '발행된 할인 쿠폰 내역은 마이페이지에서 확인하실 수 있습니다.\n\n';
	}
	$me_memo .= '감사합니다.\n\n';
	$me_memo .= '※ 회원정보 수정 : '.G5_BBS_URL.'/member_confirm.php?url=register_form.php';

	// 쪽지 INSERT
	$sql = " insert into {$g5['memo_table']} ( me_id, me_recv_mb_id, me_send_mb_id, me_send_datetime, me_memo ) values ( '$me_id', '$recv_mb_id', '$send_mb_id', '".G5_TIME_YMDHIS."', '$me_memo' ) ";
	sql_query($sql);

	// 실시간 쪽지 알림 기능
	$sql = " update {$g5['member_table']} set mb_memo_call = '$recv_mb_id' where mb_id = '$recv_mb_id' ";
	sql_query($sql);

	// 사용자 코드 실행
	@include_once ($member_skin_path.'/register_form_update.tail.skin.php');

	// 가입완료 알림
	$register_script = "alert('{$msg_alert}');".PHP_EOL;

	// 정보불러오기
	$mb = get_member($mb_id);

	// 회원아이디 세션 생성
	set_session('ss_mb_id', $mb['mb_id']);

	// FLASH XSS 공격에 대응하기 위하여 회원의 고유키를 생성해 놓는다. 관리자에서 검사함 - 110106
	set_session('ss_mb_key', md5($mb['mb_datetime'] . $_SERVER['REMOTE_ADDR'] . $_SERVER['HTTP_USER_AGENT']));

	// 포인트 체크
	if($config['cf_use_point']) {
		$sum_point = get_point_sum($mb['mb_id']);

		$sql= " update {$g5['member_table']} set mb_point = '$sum_point' where mb_id = '{$mb['mb_id']}' ";
		sql_query($sql);
	}

	set_cookie('ck_mb_id', '', 0);
    set_cookie('ck_auto', '', 0);
}

?>
<script>
<?php echo $register_script;?>
opener.location.reload();
window.close();
</script>
