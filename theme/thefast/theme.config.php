<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// 반응형 단일 테마: 'pc' 로 고정하면 휴대폰에서도 같은 화면(반응형 CSS)을 사용하고,
// 게시판 스킨도 mobile/ 폴더를 찾지 않습니다. (그누보드 common.php 의 G5_THEME_DEVICE 처리 참고)
if (!defined('G5_THEME_DEVICE')) define('G5_THEME_DEVICE', 'pc');

// 커뮤니티 사용 (게시판 head/tail 을 테마 것으로 사용)
if (!defined('G5_COMMUNITY_USE')) define('G5_COMMUNITY_USE', true);

/*
 * 관리자 > 테마설정에서 "기본 스킨 적용"을 선택하면 아래 값이 적용됩니다.
 * 값이 비어 있으면 기존 설정을 유지합니다. (값은 자동으로 theme/ 접두어가 붙어 테마 스킨으로 지정됨)
 * 게시판별 스킨은 관리자 > 게시판관리에서 직접 선택하세요.
 *   - thefast_gallery : 시공사례(portfolio), 고객후기(review)
 *   - thefast_list    : 더패스트 소식(news), 리뷰 이벤트(event), 주요 실적(history)
 *   - thefast_form    : 상담문의(inquiry), 제휴문의(partner)
 */
$theme_config = array(
    'set_default_skin'          => true,
    'preview_board_skin'        => 'thefast_list',
    'preview_mobile_board_skin' => 'thefast_list',
    'cf_member_skin'            => '',
    'cf_mobile_member_skin'     => '',
    'cf_new_skin'               => '',
    'cf_mobile_new_skin'        => '',
    'cf_search_skin'            => '',
    'cf_mobile_search_skin'     => '',
    'cf_connect_skin'           => '',
    'cf_mobile_connect_skin'    => '',
    'cf_faq_skin'               => 'thefast',
    'cf_mobile_faq_skin'        => 'thefast',
    'bo_gallery_cols'           => 3,
    'bo_gallery_width'          => 640,   // 목록 썸네일 (4:3)
    'bo_gallery_height'         => 480,
    'bo_mobile_gallery_width'   => 640,
    'bo_mobile_gallery_height'  => 480,
    'bo_image_width'            => 1040,  // 본문 이미지 최대 폭
    'qa_skin'                   => '',
    'qa_mobile_skin'            => '',
);
