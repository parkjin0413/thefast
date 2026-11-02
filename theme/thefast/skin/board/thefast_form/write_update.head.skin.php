<?php
/**
 * 상담/제휴 문의 저장 전 서버 검증 (write_update.php 에서 글 저장 직전에 실행)
 * 브라우저 쪽 검사는 우회할 수 있으므로, 실제 차단은 모두 여기서 합니다.
 *  1) 스팸 방지: 숨김 칸(honeypot), 최소 작성 시간, 같은 IP 연속 등록 제한
 *  2) 개인정보 수집 동의 / 필수 항목 / 연락처 형식 / 길이 제한
 *  3) 첨부파일 확장자 제한 (이미지·문서·도면만)
 *  4) 제목을 서버에서 다시 만들어 이름 등 개인정보가 제목에 노출되지 않게 함
 */
if (!defined('_GNUBOARD_')) exit;

include_once(G5_THEME_PATH.'/site.config.php');
global $tf_board_fields, $tf_boards;

/* 설정값 */
$tf_min_seconds   = 3;    // 신청서를 연 뒤 최소 작성 시간(초)
$tf_ip_window     = 600;  // 같은 IP 연속 등록 확인 시간(초) = 10분
$tf_ip_max_posts  = 3;    // 위 시간 안에 허용하는 글 수
$tf_allowed_ext   = array('jpg', 'jpeg', 'png', 'gif', 'webp', 'heic', 'pdf', 'hwp', 'hwpx', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'dwg', 'dxf', 'zip');

if (($w == '' || $w == 'r') && !$is_admin) {

    // 1-1) 숨김 칸이 채워져 있으면 자동 프로그램
    if (isset($_POST['tf_homepage']) && trim($_POST['tf_homepage']) !== '') {
        alert('정상적인 방법으로 작성해 주세요.');
    }

    // 1-2) 신청서를 연 기록이 없거나 너무 빨리 제출
    $tf_opened = (int) get_session('ss_tf_form_'.$bo_table);
    if (!$tf_opened || (time() - $tf_opened) < $tf_min_seconds) {
        alert('잠시 후 다시 시도해 주세요. 신청서 화면을 새로고침한 뒤 작성해 주세요.');
    }

    // 1-3) 같은 IP 에서 짧은 시간에 여러 번 등록
    $tf_ip   = sql_real_escape_string($_SERVER['REMOTE_ADDR']);
    $tf_from = date('Y-m-d H:i:s', G5_SERVER_TIME - $tf_ip_window);
    $tf_cnt  = sql_fetch(" select count(*) as cnt from {$write_table} where wr_is_comment = 0 and wr_ip = '{$tf_ip}' and wr_datetime >= '{$tf_from}' ");
    if ((int) $tf_cnt['cnt'] >= $tf_ip_max_posts) {
        alert('짧은 시간에 여러 번 신청하셨습니다. 잠시 후 다시 시도하시거나 전화로 문의해 주세요.');
    }

    // 2-1) 개인정보 수집 동의
    if (empty($_POST['tf_agree'])) {
        alert('개인정보 수집 및 이용에 동의해 주세요.');
    }

    // 2-2) 이름·내용 길이 제한
    if (mb_strlen(stripslashes((string) $wr_name), 'UTF-8') > 20) alert('이름은 20자 이내로 입력해 주세요.');
    if (mb_strlen(stripslashes((string) $wr_content), 'UTF-8') > 5000) alert('내용은 5,000자 이내로 입력해 주세요.');

    // 상담문의는 일반 텍스트만 받으므로 HTML 태그 제거 (화면 출력 시에도 이스케이프되지만 이중으로 방어)
    $wr_name    = strip_tags($wr_name);
    if (isset($_POST['wr_name'])) $_POST['wr_name'] = strip_tags($_POST['wr_name']); // 그누보드가 이후 $_POST 에서 이름을 다시 읽음
    $wr_content = strip_tags($wr_content);
    if (trim($wr_name) === '' || trim($wr_content) === '') alert('이름과 내용을 올바르게 입력해 주세요.');

    // 2-3) 확장필드: 필수 / 선택지 / 길이 / 태그 제거
    $tf_fields = isset($tf_board_fields[$bo_table]) ? $tf_board_fields[$bo_table] : array();
    foreach ($tf_fields as $tf_k => $tf_d) {
        $tf_raw = stripslashes((string) $$tf_k);
        if (!empty($tf_d['req']) && trim($tf_raw) === '') {
            alert($tf_d['label'].'을(를) 입력해 주세요.');
        }
        if (mb_strlen($tf_raw, 'UTF-8') > 100) {
            alert($tf_d['label'].'은(는) 100자 이내로 입력해 주세요.');
        }
        // 선택형 항목은 정해진 값만 허용
        if (!empty($tf_d['options']) && $tf_raw !== '' && !in_array($tf_raw, $tf_d['options'], true)) {
            $$tf_k = '';
        }
        // 연락처 형식 (숫자, -, +, 공백만 / 9~16자)
        if ($tf_d['type'] === 'tel' && $tf_raw !== '' && !preg_match('/^[0-9\-\s+]{9,16}$/', $tf_raw)) {
            alert('연락처를 정확히 입력해 주세요.');
        }
        $$tf_k = strip_tags($$tf_k); // (입력값은 그누보드가 이미 escape 처리함 — 자르기 금지)
    }

    // 3) 첨부파일 확장자 제한
    if (!empty($_FILES['bf_file']['name']) && is_array($_FILES['bf_file']['name'])) {
        foreach ($_FILES['bf_file']['name'] as $tf_fn) {
            if ($tf_fn === '' || $tf_fn === null) continue;
            $tf_ext = strtolower(pathinfo($tf_fn, PATHINFO_EXTENSION));
            if (!in_array($tf_ext, $tf_allowed_ext, true)) {
                alert('첨부할 수 없는 파일 형식입니다. (사진, PDF, 한글·오피스 문서, 도면 파일만 가능)');
            }
        }
    }

    // 4) 제목은 서버에서 다시 생성 (개인정보 미포함)
    $tf_is_partner = ($bo_table === $tf_boards['partner']);
    $tf_type = $tf_is_partner ? $wr_3 : $wr_2;
    $wr_subject = ($tf_type !== '' ? '['.$tf_type.'] ' : '').($tf_is_partner ? '제휴 문의드립니다' : '상담 신청합니다');
}
