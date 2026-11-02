<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
// 상담/제휴 문의 보기: 공통 보기 템플릿 사용, 댓글 영역은 "답변"으로 표시
$tf_cmt_title   = '답변';
$tf_write_label = '새 문의 작성';
include(G5_THEME_PATH.'/inc/board/view.inc.php');
