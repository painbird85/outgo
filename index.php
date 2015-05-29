<?php
define('_INDEX_', true);
include_once('./_common.php');

// 초기화면 파일 경로 지정 : 이 코드는 가능한 삭제하지 마십시오.
if ($config['cf_include_index'] && is_file(G5_PATH.'/'.$config['cf_include_index'])) {
    include_once(G5_PATH.'/'.$config['cf_include_index']);
    return; // 이 코드의 아래는 실행을 하지 않습니다.
}

include_once('./_head.php');
?>

<?
function fbloginprocess(){  
 

 $strResult = "Y";


 $email = $this->input->get_post("email");
 $fbuserid = $this->input->get_post("userid");
 $fbusername = $this->input->get_post("username");
 $fbaccess = $this->input->get_post("fbaccesstoken");
 $user_pic = "https://graph.facebook.com/".$fbuserid."/picture?type=large";


 $this->load->model("M_member");
 $this->load->model("M_point");  


 //페이스북 프로필 정보로 회원조회


 if(회원이아니라면){
  $strResult = "N";
 }


 echo $strResult;
 

}
?>

<?php if (!$member['mb_id']) { ?>

<script type="text/javascript">document.location.href="launching/launching.php";</script>


<?php } else { ?>


<script type="text/javascript">document.location.href="main/main.php";</script>
<? }?>

<?php
include_once('./_tail.php');
?>
