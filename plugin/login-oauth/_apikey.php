<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 페이스북 설정 - 키발급은 https://developers.facebook.com
$facebook_APPid = '1662773010619485';
$facebook_APPsecret = '7f7b6a8391c01d2ff710fccdc3f7b651';

// 트위터 설정 - 키발급은 https://dev.twitter.com
$twitter_APIkey = ''; 
$twitter_APIsecret = '';

// 구글 설정 - 키발급은 https://code.google.com/apis/console/
$google_ClientID = ''; 
$google_ClientSecret = '';

// 네이버 설정
// 네이버 로그인 이용신청 - https://developer.naver.com/openapi/register/login.nhn 
// 로그인 이용신청시 Callback URL에 http://그누보드주소/plugin/login-oauth/login_with_naver.php 입력
// 로그인 이용신청 후 https://developer.naver.com/openapi/register.nhn 에서 키발급
$naver_ClientID = ''; 
$naver_ClientSecret = '';

// 카카오 설정 
// https://developers.kakao.com/apps/new 에서 키발급 후 발급된 키값 중 REST API키값 입력
// 카카오 사이트 설정에서 플랫폼 > Redirect Path에 /plugin/login-oauth/login_with_kakao.php 라고 입력
$kakao_REST_APIkey = '';

?>