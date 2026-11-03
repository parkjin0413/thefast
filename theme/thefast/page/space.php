<?php
if (!defined('_GNUBOARD_')) include_once('./_common.php');
include_once(G5_THEME_PATH.'/site.config.php');
include_once(G5_THEME_PATH.'/inc/spaces.php');

$tf_type = isset($_GET['type']) ? preg_replace('/[^a-z]/', '', $_GET['type']) : '';
if (!isset($tf_spaces[$tf_type])) { reset($tf_spaces); $tf_type = key($tf_spaces); }
$tf_sp = $tf_spaces[$tf_type];

$g5['title']  = $tf_sp['title'];
$tf_current   = 'space-'.$tf_type;
$tf_full      = true;
$tf_visual_page = $tf_sp['thumb'];
$tf_meta      = array(
    'description' => '더패스트 '.$tf_sp['title'].' — '.strip_tags(str_replace('<br>', ' ', $tf_sp['lead'])),
    'canonical'   => tf_page_url('space', 'type='.$tf_type),
);

include_once(G5_THEME_PATH.'/head.php');
include_once(G5_THEME_PATH.'/inc/tf.lib.php');

// 관련 시공사례: 시공사례 게시판에 이 공간 이름이 들어간 분류가 있으면 그 분류, 없으면 최신 글
$tf_rel = array();
$tf_rel_url = '';
if (tf_board_exists($tf_boards['portfolio'])) {
    $tf_rel_cate = '';
    foreach ($tf_portfolio_cates as $c) {
        if (mb_strpos($c, $tf_sp['short']) !== false) { $tf_rel_cate = $c; break; }
    }
    $tf_rel = tf_latest_posts($tf_boards['portfolio'], 3, 640, 480, $tf_rel_cate);
    if (!$tf_rel && $tf_rel_cate) $tf_rel = tf_latest_posts($tf_boards['portfolio'], 3, 640, 480);
    $tf_rel_url = tf_portfolio_url($tf_rel_cate);
}
?>

<section class="tf-section" aria-labelledby="tfSpaceTitle">
    <div class="tf-inner tf-space-intro">
        <div class="tf-space-intro__media tf-reveal">
            <img src="<?php echo tf_img($tf_sp['image']); ?>" alt="더패스트 <?php echo $tf_sp['title']; ?> 시공 예시" width="960" height="720">
        </div>
        <div>
            <p class="tf-eyebrow tf-reveal"><?php echo $tf_sp['en']; ?></p>
            <h2 class="tf-h2 tf-reveal" id="tfSpaceTitle"><?php echo $tf_sp['headline']; ?></h2>
            <p class="tf-lead tf-reveal"><?php echo $tf_sp['lead']; ?></p>
            <div class="tf-loc-btns tf-reveal">
                <a href="<?php echo $tf_inquiry_url; ?>" class="tf-btn tf-btn--primary"><?php echo $tf_sp['short']; ?> 리모델링 상담하기</a>
                <a href="<?php echo tf_tel_href($tf_site['tel']); ?>" class="tf-btn tf-btn--line">전화 <?php echo $tf_site['tel']; ?></a>
            </div>
        </div>
    </div>
</section>

<section class="tf-section tf-section--stone" aria-labelledby="tfSpacePain">
    <div class="tf-inner">
        <div class="tf-space-pain">
            <div>
                <p class="tf-eyebrow tf-reveal">Check</p>
                <h2 class="tf-h2 tf-reveal" id="tfSpacePain">이런 고민,<br>있으셨나요?</h2>
            </div>
            <ul class="tf-space-pain__list">
                <?php foreach ($tf_sp['pains'] as $i => $p) { ?>
                <li class="tf-reveal" data-delay="<?php echo $i; ?>"><span aria-hidden="true">✓</span><?php echo $p; ?></li>
                <?php } ?>
            </ul>
        </div>

        <h3 class="tf-space-sub tf-reveal">더패스트는 이렇게 해결합니다</h3>
        <ol class="tf-space-points">
            <?php foreach ($tf_sp['points'] as $i => $p) { ?>
            <li class="tf-reveal" data-delay="<?php echo $i % 4; ?>">
                <b><?php printf('%02d', $i + 1); ?></b>
                <h4><?php echo $p[0]; ?></h4>
                <p><?php echo $p[1]; ?></p>
            </li>
            <?php } ?>
        </ol>
    </div>
</section>

<section class="tf-section" aria-labelledby="tfSpaceMat">
    <div class="tf-inner">
        <div class="tf-head">
            <div class="tf-head__text">
                <p class="tf-eyebrow tf-reveal">Materials</p>
                <h2 class="tf-h2 tf-reveal" id="tfSpaceMat">이 공간에 쓰는 자재</h2>
            </div>
            <a href="<?php echo tf_page_url('product', 'type=wall'); ?>" class="tf-link tf-reveal">자재·공법 전체 보기 <span aria-hidden="true">→</span></a>
        </div>
        <ul class="tf-space-mats">
            <?php foreach ($tf_sp['materials'] as $i => $m) {
                $tf_mhref = tf_page_url('product', 'type='.$m[1]).($m[2] ? '#'.$m[2] : '');
            ?>
            <li class="tf-reveal" data-delay="<?php echo $i; ?>">
                <a href="<?php echo $tf_mhref; ?>" class="tf-card">
                    <div class="tf-card__img"><img src="<?php echo tf_img($m[3]); ?>" alt="" width="640" height="480" loading="lazy"></div>
                    <div class="tf-card__body">
                        <h3 class="tf-card__title"><?php echo $m[0]; ?></h3>
                        <p class="tf-card__desc"><?php echo $m[4]; ?></p>
                    </div>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</section>

<?php if ($tf_rel) { ?>
<section class="tf-section tf-section--stone" aria-labelledby="tfSpaceRel">
    <div class="tf-inner">
        <div class="tf-head">
            <div class="tf-head__text">
                <p class="tf-eyebrow tf-reveal">Portfolio</p>
                <h2 class="tf-h2 tf-reveal" id="tfSpaceRel">더패스트 시공사례</h2>
            </div>
            <a href="<?php echo $tf_rel_url; ?>" class="tf-link tf-reveal">시공사례 더 보기 <span aria-hidden="true">→</span></a>
        </div>
        <ul class="tf-cards">
            <?php foreach ($tf_rel as $i => $p) { ?>
            <li class="tf-reveal" data-delay="<?php echo $i; ?>">
                <a href="<?php echo $p['href']; ?>" class="tf-card">
                    <div class="tf-card__img">
                        <?php if ($p['thumb']) { ?><img src="<?php echo $p['thumb']; ?>" alt="<?php echo $p['alt']; ?>" width="640" height="480" loading="lazy"><?php } else { ?><span class="tf-card__noimg">이미지 준비중</span><?php } ?>
                    </div>
                    <div class="tf-card__body">
                        <div class="tf-card__meta">
                            <?php if ($p['ca_name']) { ?><span class="tf-chip"><?php echo $p['ca_name']; ?></span><?php } ?>
                            <?php if ($p['wr_2']) { ?><span><?php echo $p['wr_2']; ?></span><?php } ?>
                            <?php if ($p['wr_1']) { ?><span><?php echo $p['wr_1']; ?></span><?php } ?>
                        </div>
                        <h3 class="tf-card__title"><?php echo $p['subject']; ?></h3>
                    </div>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</section>
<?php } ?>

<section class="tf-section" aria-labelledby="tfSpaceOther">
    <div class="tf-inner">
        <h2 class="tf-space-sub tf-reveal" id="tfSpaceOther">다른 공간도 둘러보세요</h2>
        <ul class="tf-space-other">
            <?php foreach ($tf_spaces as $k => $o) { if ($k === $tf_type) continue; ?>
            <li class="tf-reveal">
                <a href="<?php echo tf_page_url('space', 'type='.$k); ?>">
                    <img src="<?php echo tf_img($o['thumb']); ?>" alt="" width="480" height="320" loading="lazy">
                    <span><?php echo $o['title']; ?> <span aria-hidden="true">→</span></span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</section>

<?php
include_once(G5_THEME_PATH.'/tail.php');
