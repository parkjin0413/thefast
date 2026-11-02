<?php
if (!defined('_GNUBOARD_')) include_once('./_common.php');
include_once(G5_THEME_PATH.'/site.config.php');
include_once(G5_THEME_PATH.'/inc/products.php');

$tf_type = isset($_GET['type']) ? preg_replace('/[^a-z]/', '', $_GET['type']) : 'wall';
if (!isset($tf_products[$tf_type])) $tf_type = 'wall';
$tf_cat = $tf_products[$tf_type];

$tf_names = array();
foreach ($tf_cat['items'] as $it) $tf_names[] = $it['tab'];

$g5['title']  = $tf_cat['title'];
$tf_current   = 'product-'.$tf_type;
$tf_meta      = array(
    'description' => '더패스트 '.$tf_cat['title'].' — '.implode(', ', $tf_names).'. '.$tf_cat['lead'].'.',
    'canonical'   => tf_page_url('product', 'type='.$tf_type),
);

include_once(G5_THEME_PATH.'/head.php');

$tf_multi = count($tf_cat['items']) > 1;
?>

<h2 class="sound_only"><?php echo $tf_cat['title']; ?> 제품 목록</h2>
<?php if ($tf_multi) { ?>
<div class="tf-ptabs" role="tablist" aria-label="<?php echo $tf_cat['title']; ?> 제품 선택">
    <?php $n = 0; foreach ($tf_cat['items'] as $key => $it) { ?>
    <button type="button" role="tab" id="tft-<?php echo $key; ?>" aria-controls="tfp-<?php echo $key; ?>" aria-selected="<?php echo $n === 0 ? 'true' : 'false'; ?>" tabindex="<?php echo $n === 0 ? '0' : '-1'; ?>" data-hash="<?php echo $key; ?>"><?php echo $it['tab']; ?></button>
    <?php $n++; } ?>
</div>
<?php } ?>

<?php $n = 0; foreach ($tf_cat['items'] as $key => $it) { ?>
<section class="tf-ppanel" id="tfp-<?php echo $key; ?>"<?php if ($tf_multi) { ?> role="tabpanel" aria-labelledby="tft-<?php echo $key; ?>" tabindex="0"<?php echo $n ? ' hidden' : ''; ?><?php } ?>>
    <div class="tf-pinfo">
        <div class="tf-pgallery">
            <div class="tf-pgallery__main">
                <img src="<?php echo tf_img($it['gallery'][0]); ?>" alt="<?php echo $it['tab']; ?> 시공 예시" width="1200" height="900"<?php echo $n ? ' loading="lazy"' : ''; ?>>
            </div>
            <?php if (count($it['gallery']) > 1) { ?>
            <div class="tf-pgallery__thumbs">
                <?php foreach ($it['gallery'] as $gi => $g) { ?>
                <button type="button" data-src="<?php echo tf_img($g); ?>" aria-pressed="<?php echo $gi === 0 ? 'true' : 'false'; ?>">
                    <img src="<?php echo tf_img($g); ?>" alt="<?php echo $it['tab']; ?> 시공 예시 <?php echo $gi + 1; ?>" width="300" height="225" loading="lazy">
                </button>
                <?php } ?>
            </div>
            <?php } ?>
        </div>

        <div class="tf-pdetail">
            <p class="tf-pdetail__sub"><?php echo $it['sub']; ?></p>
            <h2 class="tf-pdetail__name"><?php echo $it['tab']; ?></h2>
            <p class="tf-pdetail__en"><?php echo $it['en']; ?></p>
            <p class="tf-pdetail__desc"><?php echo $it['desc']; ?></p>
            <table class="tf-spec">
                <caption class="sound_only"><?php echo $it['tab']; ?> 규격 및 용도</caption>
                <tbody>
                    <tr><th scope="row">규격</th><td><?php echo implode('<br>', $it['spec']); ?></td></tr>
                    <tr><th scope="row">주거용</th><td><?php echo $it['use_home']; ?></td></tr>
                    <tr><th scope="row">상업용</th><td><?php echo $it['use_biz']; ?></td></tr>
                </tbody>
            </table>
            <div class="tf-loc-btns">
                <a href="<?php echo $tf_inquiry_url; ?>" class="tf-btn tf-btn--primary">이 제품으로 견적 문의</a>
                <a href="<?php echo tf_board_url($tf_boards['portfolio']); ?>" class="tf-btn tf-btn--line">시공사례 보기</a>
            </div>
        </div>
    </div>

    <div class="tf-subhead"><h3>주요 특장점</h3></div>
    <ul class="tf-feat">
        <?php foreach ($it['features'] as $f) { ?>
        <li>
            <img src="<?php echo tf_img($f[0]); ?>" alt="" width="44" height="44" loading="lazy">
            <h4><?php echo $f[1]; ?></h4>
            <p><?php echo $f[2]; ?></p>
        </li>
        <?php } ?>
    </ul>

    <?php if (!empty($it['benefits'])) { ?>
    <div class="tf-subhead"><h3>이런 점이 좋습니다</h3></div>
    <ol class="tf-benefit">
        <?php foreach ($it['benefits'] as $bi => $b) { ?>
        <li><b><?php printf('%02d', $bi + 1); ?></b><div><h4><?php echo $b[0]; ?></h4><p><?php echo $b[1]; ?></p></div></li>
        <?php } ?>
    </ol>
    <?php } ?>

    <?php if (!empty($tf_swatches[$it['swatch']])) { ?>
    <div class="tf-subhead"><h3>색상 · 패턴</h3><p>이미지를 누르면 크게 볼 수 있습니다. 실제 색상은 모니터에 따라 다를 수 있습니다.</p></div>
    <ul class="tf-swatch">
        <?php foreach ($tf_swatches[$it['swatch']] as $s) { ?>
        <li>
            <button type="button" data-zoom="<?php echo tf_img('swatch/'.$s[1]); ?>" data-title="<?php echo get_text($s[0]); ?>">
                <span class="tf-swatch__img"><img src="<?php echo tf_img('swatch/'.$s[1]); ?>" alt="" width="300" height="300" loading="lazy"></span>
                <span class="tf-swatch__name"><?php echo get_text($s[0]); ?><span class="sound_only"> 크게 보기</span></span>
            </button>
        </li>
        <?php } ?>
    </ul>
    <?php } ?>

    <?php if (!empty($it['profiles'])) { ?>
    <div class="tf-subhead"><h3>마감 프로파일</h3></div>
    <div class="tf-profile">
        <?php foreach ($it['profiles'] as $p) { ?>
        <figure><img src="<?php echo tf_img($p[0]); ?>" alt="<?php echo $p[1]; ?> 프로파일" width="200" height="200" loading="lazy"><figcaption><?php echo $p[1]; ?></figcaption></figure>
        <?php } ?>
    </div>
    <?php } ?>

    <?php if (!empty($it['certs'])) { ?>
    <div class="tf-subhead"><h3>시험 성적서 · 인증</h3></div>
    <div class="tf-cert">
        <?php foreach ($it['certs'] as $c) { ?>
        <figure>
            <button type="button" data-zoom="<?php echo tf_img($c[0]); ?>" data-title="<?php echo $c[1]; ?>" class="tf-zoom">
                <img src="<?php echo tf_img($c[0]); ?>" alt="<?php echo $c[1]; ?>" width="300" height="400" loading="lazy">
            </button>
            <figcaption><?php echo $c[1]; ?></figcaption>
        </figure>
        <?php } ?>
    </div>
    <?php } ?>

    <?php if (!empty($it['cert_kcl'])) { $k = $it['cert_kcl']; ?>
    <div class="tf-subhead"><h3>시험 성적서</h3></div>
    <div class="tf-pinfo">
        <figure class="tf-cert tf-cert--single">
            <button type="button" data-zoom="<?php echo tf_img($k['img']); ?>" data-title="<?php echo $k['title']; ?>" class="tf-zoom">
                <img src="<?php echo tf_img($k['img']); ?>" alt="<?php echo $k['title']; ?>" width="600" height="420" loading="lazy">
            </button>
        </figure>
        <div class="tf-cert__text">
            <h4><?php echo $k['title']; ?></h4>
            <ul>
                <?php foreach ($k['items'] as $ci) { ?><li><b><?php echo $ci[0]; ?></b><br><?php echo $ci[1]; ?></li><?php } ?>
            </ul>
        </div>
    </div>
    <?php } ?>
</section>
<?php $n++; } ?>

<dialog class="tf-dialog" id="tfDialog" aria-labelledby="tfDialogTitle">
    <div class="tf-dialog__bar">
        <span class="tf-dialog__title" id="tfDialogTitle"></span>
        <button type="button" class="tf-dialog__close"><span class="sound_only">닫기</span><span aria-hidden="true">&times;</span></button>
    </div>
    <img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="">
</dialog>

<?php
include_once(G5_THEME_PATH.'/tail.php');
