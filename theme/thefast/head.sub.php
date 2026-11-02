<?php
// 이 파일은 새로운 파일 생성시 반드시 포함되어야 함
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

// alert() 등 함수 안에서 include 되는 경우를 위해 전역으로 묶어 둡니다.
global $tf_site, $tf_seo, $tf_menu, $tf_boards, $tf_board_fields, $tf_portfolio_cates, $tf_inquiry_url, $tf_current, $tf_meta;
include_once(G5_THEME_PATH.'/site.config.php');

$g5_debug['php']['begin_time'] = $begin_time = get_microtime();

if (!isset($g5['title'])) {
    $g5['title'] = $config['cf_title'];
    $g5_head_title = $g5['title'];
}
else {
    // 상태바에 표시될 제목
    $g5_head_title = implode(' | ', array_filter(array($g5['title'], $config['cf_title'])));
}

$g5['title'] = strip_tags($g5['title']);
$g5_head_title = strip_tags($g5_head_title);

// 현재 접속자
// 게시판 제목에 ' 포함되면 오류 발생
$g5['lo_location'] = addslashes($g5['title']);
if (!$g5['lo_location'])
    $g5['lo_location'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
$g5['lo_url'] = addslashes(clean_xss_tags($_SERVER['REQUEST_URI']));
if (strstr($g5['lo_url'], '/'.G5_ADMIN_DIR.'/') || $is_admin == 'super') $g5['lo_url'] = '';

/* ---------- SEO 메타 ---------- */
$tf_is_index = defined('_INDEX_');
if ($tf_is_index) $g5_head_title = $tf_seo['title'];

$tf_meta = isset($tf_meta) && is_array($tf_meta) ? $tf_meta : array();
$tf_meta_desc = !empty($tf_meta['description']) ? $tf_meta['description'] : $tf_seo['description'];

// 게시글 보기 화면이면 본문 앞부분을 설명으로 사용
if (!$tf_is_index && empty($tf_meta['description']) && !empty($wr_id) && isset($write) && is_array($write) && !empty($write['wr_content']) && strpos($write['wr_option'] ?? '', 'secret') === false) {
    $tf_meta_desc = trim(preg_replace('/\s+/u', ' ', strip_tags($write['wr_content'])));
    $tf_meta_desc = cut_str($tf_meta_desc, 150, '…');
}
$tf_meta_desc = get_text($tf_meta_desc);

$tf_scheme  = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
$tf_canonical = !empty($tf_meta['canonical']) ? $tf_meta['canonical'] : $tf_scheme.($_SERVER['HTTP_HOST'] ?? '').strtok($_SERVER['REQUEST_URI'] ?? '/', '#');
$tf_og_image  = G5_THEME_URL.$tf_seo['og_image'];
$tf_robots    = (defined('G5_IS_ADMIN') || in_array(basename($_SERVER['SCRIPT_NAME'] ?? ''), array('write.php', 'login.php', 'register.php', 'register_form.php', 'password.php', 'member_confirm.php', 'alert.php', 'search.php'))) ? 'noindex,nofollow' : 'index,follow';

/*
// 만료된 페이지로 사용하시는 경우
header("Cache-Control: no-cache"); // HTTP/1.1
header("Expires: 0"); // rfc2616 - Section 14.21
header("Pragma: no-cache"); // HTTP/1.0
*/
?>
<!doctype html>
<html lang="ko">
<head>
<meta charset="utf-8">
<meta name="viewport" id="meta_viewport" content="width=device-width,initial-scale=1.0,viewport-fit=cover">
<meta name="format-detection" content="telephone=no">
<?php
if($config['cf_add_meta'])
    echo $config['cf_add_meta'].PHP_EOL;
?>
<title><?php echo $g5_head_title; ?></title>
<meta name="description" content="<?php echo $tf_meta_desc; ?>">
<meta name="keywords" content="<?php echo get_text($tf_seo['keywords']); ?>">
<meta name="author" content="<?php echo $tf_site['corp']; ?>">
<meta name="robots" content="<?php echo $tf_robots; ?>">
<meta name="theme-color" content="#2b2e5c">
<link rel="canonical" href="<?php echo get_text($tf_canonical); ?>">
<?php if ($tf_seo['naver_verify']) { ?><meta name="naver-site-verification" content="<?php echo get_text($tf_seo['naver_verify']); ?>"><?php echo PHP_EOL; } ?>
<?php if ($tf_seo['google_verify']) { ?><meta name="google-site-verification" content="<?php echo get_text($tf_seo['google_verify']); ?>"><?php echo PHP_EOL; } ?>
<meta property="og:type" content="website">
<meta property="og:site_name" content="<?php echo $tf_site['name']; ?> <?php echo $tf_site['name_en']; ?>">
<meta property="og:locale" content="ko_KR">
<meta property="og:title" content="<?php echo get_text($g5_head_title); ?>">
<meta property="og:description" content="<?php echo $tf_meta_desc; ?>">
<meta property="og:url" content="<?php echo get_text($tf_canonical); ?>">
<meta property="og:image" content="<?php echo $tf_og_image; ?>">
<meta property="og:image:width" content="1200">
<meta property="og:image:height" content="630">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo get_text($g5_head_title); ?>">
<meta name="twitter:description" content="<?php echo $tf_meta_desc; ?>">
<meta name="twitter:image" content="<?php echo $tf_og_image; ?>">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo tf_img('favicon/favicon-32x32.png'); ?>">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo tf_img('favicon/favicon-96x96.png'); ?>">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo tf_img('favicon/apple-icon-180x180.png'); ?>">
<link rel="preconnect" href="https://cdn.jsdelivr.net" crossorigin>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/orioncactus/pretendard@v1.3.9/dist/web/variable/pretendardvariable-dynamic-subset.min.css">
<?php
// 그누보드 시스템 화면용 기본 CSS + 테마 CSS (반응형 단일 테마이므로 기기 구분 없이 동일하게 로드)
echo '<link rel="stylesheet" href="'.get_versioned_asset_url(run_replace('head_css_url', G5_THEME_CSS_URL.'/default.css', G5_THEME_URL)).'">'.PHP_EOL;
echo '<link rel="stylesheet" href="'.get_versioned_asset_url(G5_THEME_CSS_URL.'/theme.css').'">'.PHP_EOL;
?>
<script>
// 자바스크립트에서 사용하는 전역변수 선언
var g5_url       = "<?php echo G5_URL ?>";
var g5_bbs_url   = "<?php echo G5_BBS_URL ?>";
var g5_is_member = "<?php echo isset($is_member)?$is_member:''; ?>";
var g5_is_admin  = "<?php echo isset($is_admin)?$is_admin:''; ?>";
var g5_is_mobile = "<?php echo G5_IS_MOBILE ?>";
var g5_bo_table  = "<?php echo isset($bo_table)?$bo_table:''; ?>";
var g5_sca       = "<?php echo isset($sca)?$sca:''; ?>";
var g5_editor    = "<?php echo ($config['cf_editor'] && isset($board['bo_use_dhtml_editor']) && $board['bo_use_dhtml_editor'])?$config['cf_editor']:''; ?>";
var g5_cookie_domain = "<?php echo G5_COOKIE_DOMAIN ?>";
<?php if (defined('G5_USE_SHOP') && G5_USE_SHOP) { ?>
var g5_theme_shop_url = "<?php echo G5_THEME_SHOP_URL; ?>";
var g5_shop_url = "<?php echo G5_SHOP_URL; ?>";
<?php } ?>
<?php if(defined('G5_IS_ADMIN')) { ?>
var g5_admin_url = "<?php echo G5_ADMIN_URL; ?>";
<?php } ?>
</script>
<?php
add_javascript('<script src="'.G5_JS_URL.'/jquery-1.12.4.min.js"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/jquery-migrate-1.4.1.min.js"></script>', 0);
if (defined('_SHOP_')) {
    if(!G5_IS_MOBILE) {
        add_javascript('<script src="'.G5_JS_URL.'/jquery.shop.menu.js"></script>', 0);
    }
} else {
    add_javascript('<script src="'.G5_JS_URL.'/jquery.menu.js"></script>', 0);
}
add_javascript('<script src="'.G5_JS_URL.'/common.js"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/wrest.js"></script>', 0);
add_javascript('<script src="'.G5_JS_URL.'/placeholders.min.js"></script>', 0);
add_stylesheet('<link rel="stylesheet" href="'.G5_JS_URL.'/font-awesome/css/font-awesome.min.css">', 0);
add_javascript('<script src="'.get_versioned_asset_url(G5_THEME_JS_URL.'/theme.js').'" defer></script>', 10);

if(G5_IS_MOBILE) {
    add_javascript('<script src="'.G5_JS_URL.'/modernizr.custom.70111.js"></script>', 1); // overflow scroll 감지
}
if(!defined('G5_IS_ADMIN'))
    echo $config['cf_add_script'];

// 구조화 데이터 (검색엔진용 업체 정보) — 메인에서만 출력
if ($tf_is_index) {
    $tf_ld = array(
        '@context'      => 'https://schema.org',
        '@type'         => 'HomeAndConstructionBusiness',
        'name'          => $tf_site['name'],
        'alternateName' => array($tf_site['name_en'], $tf_site['corp'], '더패스트 인테리어'),
        'description'   => $tf_seo['description'],
        'url'           => G5_URL.'/',
        'logo'          => tf_img('logo.png'),
        'image'         => $tf_og_image,
        'telephone'     => $tf_site['tel'],
        'email'         => $tf_site['email'],
        'address'       => array(
            '@type'           => 'PostalAddress',
            'addressCountry'  => 'KR',
            'addressRegion'   => $tf_site['addr_region'],
            'addressLocality' => $tf_site['addr_city'],
            'streetAddress'   => $tf_site['addr_street'],
        ),
        'geo'           => array('@type' => 'GeoCoordinates', 'latitude' => $tf_site['lat'], 'longitude' => $tf_site['lng']),
        'openingHoursSpecification' => array(array(
            '@type'     => 'OpeningHoursSpecification',
            'dayOfWeek' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'),
            'opens'     => '08:00',
            'closes'    => '17:00',
        )),
        'areaServed'    => '대한민국',
    );
    $tf_same = array_values(array_filter(array($tf_site['blog'], $tf_site['instagram'], $tf_site['youtube'], $tf_site['kakao'])));
    if ($tf_same) $tf_ld['sameAs'] = $tf_same;
    echo '<script type="application/ld+json">'.json_encode($tf_ld, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES).'</script>'.PHP_EOL;
}
?>
</head>
<body<?php echo isset($g5['body_script']) ? $g5['body_script'] : ''; ?>>
<?php
if ($is_member) { // 회원이라면 로그인 중이라는 메세지를 출력해준다.
    $sr_admin_msg = '';
    if ($is_admin == 'super') $sr_admin_msg = "최고관리자 ";
    else if ($is_admin == 'group') $sr_admin_msg = "그룹관리자 ";
    else if ($is_admin == 'board') $sr_admin_msg = "게시판관리자 ";

    echo '<div id="hd_login_msg">'.$sr_admin_msg.get_text($member['mb_nick']).'님 로그인 중 ';
    echo '<a href="'.G5_BBS_URL.'/logout.php">로그아웃</a></div>';
}
