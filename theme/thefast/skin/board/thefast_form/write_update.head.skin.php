<?php
/**
 * 상담/제휴 문의 저장 전 서버 검증 (write_update.php 에서 글 저장 직전에 실행)
 * - 개인정보 수집 동의 확인
 * - 필수 확장필드 확인
 * - 제목을 서버에서 다시 만들어 이름 등 개인정보가 제목에 노출되지 않게 함
 */
if (!defined('_GNUBOARD_')) exit;

include_once(G5_THEME_PATH.'/site.config.php');
global $tf_board_fields, $tf_boards;

if ($w == '' || $w == 'r') {
    if (!$is_admin && empty($_POST['tf_agree'])) {
        alert('개인정보 수집 및 이용에 동의해 주세요.');
    }

    $tf_fields = isset($tf_board_fields[$bo_table]) ? $tf_board_fields[$bo_table] : array();
    foreach ($tf_fields as $tf_k => $tf_d) {
        if (!empty($tf_d['req']) && !$is_admin && trim((string) $$tf_k) === '') {
            alert($tf_d['label'].'을(를) 입력해 주세요.');
        }
        // 선택형 항목은 정해진 값만 허용
        if (!empty($tf_d['options']) && $$tf_k !== '' && !in_array($$tf_k, $tf_d['options'], true)) {
            $$tf_k = '';
        }
        $$tf_k = strip_tags($$tf_k); // (입력값은 그누보드가 이미 escape 처리함 — 자르기 금지)
    }

    if (!$is_admin) {
        $tf_is_partner = ($bo_table === $tf_boards['partner']);
        $tf_type = $tf_is_partner ? $wr_3 : $wr_2;
        $wr_subject = ($tf_type !== '' ? '['.$tf_type.'] ' : '').($tf_is_partner ? '제휴 문의드립니다' : '상담 신청합니다');
    }
}
