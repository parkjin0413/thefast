<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.sub.php');
include_once(G5_LIB_PATH.'/latest.lib.php');

global $tf_site, $tf_menu, $tf_boards, $tf_inquiry_url, $tf_has_inquiry, $tf_current, $tf_full, $tf_visual_page;

$tf_is_index = defined('_INDEX_');
$tf_current  = tf_detect_current();
list($tf_gkey, $tf_group, $tf_item) = tf_find_menu($tf_current);
$tf_full = !empty($tf_full) || $tf_is_index;

/* 서브 상단 제목 */
if ($tf_item) {
    $tf_page_title = $tf_item['title'];
    if ($tf_gkey === 'portfolio' && $tf_item['key'] === 'portfolio') $tf_page_title = '시공사례';
} else {
    $tf_page_title = isset($g5['title']) ? preg_replace('/\s*\d+\s*페이지$/u', '', $g5['title']) : '';
    if (strpos($tf_page_title, ' > ') !== false) $tf_page_title = trim(substr(strrchr($tf_page_title, '>'), 1));
}
// 페이지에서 $tf_visual_page 를 지정하면 그 이미지를, 아니면 대메뉴 이미지를 상단 배경으로 사용
$tf_visual = !empty($tf_visual_page) ? $tf_visual_page : ($tf_group ? $tf_group['visual'] : 'sub/sub_visual/interior-hd.jpg');
$tf_en     = $tf_group ? $tf_group['en'] : 'THE FAST';
?>
<a class="tf-skip" href="#tf-main">본문 바로가기</a>

<header class="tf-header<?php echo $tf_is_index ? ' is-overlay' : ''; ?>" id="tfHeader">
    <div class="tf-header__inner">
        <div class="tf-logo">
            <a href="<?php echo G5_URL; ?>/" aria-label="<?php echo $tf_site['name']; ?> <?php echo $tf_site['name_en']; ?> 홈으로">
                <img src="<?php echo tf_img('logo.png'); ?>" alt="<?php echo $tf_site['name']; ?> THE FAST" width="181" height="40" class="tf-logo__dark">
                <img src="<?php echo tf_img('logo_w.png'); ?>" alt="" width="181" height="40" class="tf-logo__light" aria-hidden="true">
            </a>
        </div>

        <nav class="tf-gnb" aria-label="주 메뉴">
            <ul class="tf-gnb__list">
                <?php foreach ($tf_menu as $gkey => $group) { ?>
                <li class="tf-gnb__item<?php echo $gkey === $tf_gkey ? ' is-active' : ''; ?>">
                    <a href="<?php echo $group['sub'][0]['href']; ?>" class="tf-gnb__link"<?php echo $gkey === $tf_gkey ? ' aria-current="true"' : ''; ?>><?php echo get_text($group['title']); ?></a>
                    <div class="tf-gnb__sub">
                        <ul>
                            <?php foreach ($group['sub'] as $item) { ?>
                            <li><a href="<?php echo $item['href']; ?>"<?php echo $item['key'] === $tf_current ? ' aria-current="page"' : ''; ?>><?php echo get_text($item['title']); ?></a></li>
                            <?php } ?>
                        </ul>
                    </div>
                </li>
                <?php } ?>
            </ul>
        </nav>

        <div class="tf-header__util">
            <?php if ($is_member) { // 로그인한 경우에만 노출 ?>
            <ul class="tf-header__member">
                <?php if ($is_admin) { ?><li><a href="<?php echo G5_ADMIN_URL; ?>/">관리자</a></li><?php } ?>
                <li><a href="<?php echo G5_BBS_URL; ?>/logout.php">로그아웃</a></li>
            </ul>
            <?php } ?>
            <a href="<?php echo tf_tel_href($tf_site['tel']); ?>" class="tf-header__tel">
                <svg aria-hidden="true" viewBox="0 0 24 24" width="18" height="18"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.25 11.4 11.4 0 0 0 3.6.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1z"/></svg>
                <span><?php echo $tf_site['tel']; ?></span>
            </a>
            <a href="<?php echo $tf_inquiry_url; ?>" class="tf-btn tf-btn--primary tf-btn--sm tf-header__cta">상담 문의</a>
            <button type="button" class="tf-burger" id="tfBurger" aria-controls="tfDrawer" aria-expanded="false">
                <span class="tf-burger__bar" aria-hidden="true"></span>
                <span class="sound_only">전체 메뉴 열기</span>
            </button>
        </div>
    </div>
</header>

<!-- 모바일 / 전체 메뉴 -->
<div class="tf-drawer" id="tfDrawer" aria-label="전체 메뉴" role="dialog" aria-modal="true" hidden>
    <div class="tf-drawer__head">
        <a href="<?php echo G5_URL; ?>/" class="tf-drawer__logo"><img src="<?php echo tf_img('logo.png'); ?>" alt="<?php echo $tf_site['name']; ?> 홈으로" width="145" height="32"></a>
        <button type="button" class="tf-drawer__close" id="tfDrawerClose"><span class="sound_only">전체 메뉴 닫기</span><span aria-hidden="true">&times;</span></button>
    </div>
    <nav class="tf-drawer__nav" aria-label="전체 메뉴">
        <ul>
            <?php $tf_i = 0; foreach ($tf_menu as $gkey => $group) { $tf_i++; ?>
            <li class="tf-drawer__group<?php echo $gkey === $tf_gkey ? ' is-open' : ''; ?>">
                <button type="button" class="tf-drawer__toggle" aria-expanded="<?php echo $gkey === $tf_gkey ? 'true' : 'false'; ?>" aria-controls="tfDrawerSub<?php echo $tf_i; ?>">
                    <span class="tf-drawer__en"><?php echo $group['en']; ?></span><?php echo get_text($group['title']); ?>
                </button>
                <ul id="tfDrawerSub<?php echo $tf_i; ?>" class="tf-drawer__sub">
                    <?php foreach ($group['sub'] as $item) { ?>
                    <li><a href="<?php echo $item['href']; ?>"<?php echo $item['key'] === $tf_current ? ' aria-current="page"' : ''; ?>><?php echo get_text($item['title']); ?></a></li>
                    <?php } ?>
                </ul>
            </li>
            <?php } ?>
        </ul>
    </nav>
    <div class="tf-drawer__foot">
        <a href="<?php echo $tf_inquiry_url; ?>" class="tf-btn tf-btn--primary tf-btn--block"><?php echo $tf_has_inquiry ? '무료 상담 신청' : '전화 상담 연결'; ?></a>
        <a href="<?php echo tf_tel_href($tf_site['tel']); ?>" class="tf-btn tf-btn--line tf-btn--block">전화 상담 <?php echo $tf_site['tel']; ?></a>
        <p class="tf-drawer__hours"><?php echo $tf_site['hours']; ?> · <?php echo $tf_site['hours_note']; ?></p>
    </div>
</div>
<div class="tf-dim" id="tfDim" hidden></div>

<?php if (!$tf_is_index) { ?>
<section class="tf-subhero" aria-labelledby="tfPageTitle">
    <div class="tf-subhero__bg" style="background-image:url('<?php echo tf_img($tf_visual); ?>')" aria-hidden="true"></div>
    <div class="tf-inner tf-subhero__inner">
        <p class="tf-subhero__en"><?php echo $tf_en; ?></p>
        <h1 class="tf-subhero__title" id="tfPageTitle"><?php echo get_text($tf_page_title); ?></h1>
        <?php if ($tf_group && !empty($tf_group['lead'])) { ?><p class="tf-subhero__lead"><?php echo $tf_group['lead']; ?></p><?php } ?>
        <nav class="tf-breadcrumb" aria-label="현재 위치">
            <ol>
                <li><a href="<?php echo G5_URL; ?>/">홈</a></li>
                <?php if ($tf_group) { ?><li><a href="<?php echo $tf_group['sub'][0]['href']; ?>"><?php echo $tf_group['title']; ?></a></li><?php } ?>
                <li aria-current="page"><?php echo get_text($tf_page_title); ?></li>
            </ol>
        </nav>
    </div>
</section>
<?php if ($tf_group && count($tf_group['sub']) > 1) { ?>
<nav class="tf-lnb" aria-label="<?php echo $tf_group['title']; ?> 하위 메뉴">
    <div class="tf-inner">
        <ul class="tf-lnb__list">
            <?php foreach ($tf_group['sub'] as $item) { ?>
            <li><a href="<?php echo $item['href']; ?>" class="tf-lnb__link<?php echo $item['key'] === $tf_current ? ' is-active' : ''; ?>"<?php echo $item['key'] === $tf_current ? ' aria-current="page"' : ''; ?>><?php echo get_text($item['title']); ?></a></li>
            <?php } ?>
        </ul>
    </div>
</nav>
<?php } ?>
<?php } ?>

<main id="tf-main" class="tf-main<?php echo $tf_is_index ? ' tf-main--index' : ''; ?>">
<?php if (!$tf_full) { ?>
<div class="tf-inner tf-content">
<?php } ?>
