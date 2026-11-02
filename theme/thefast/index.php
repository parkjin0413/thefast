<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.php');
include_once(G5_THEME_PATH.'/inc/tf.lib.php');

$tf_portfolio = tf_latest_posts($tf_boards['portfolio'], 6, 640, 480);
$tf_reviews   = tf_latest_posts($tf_boards['review'], 5);
$tf_news      = tf_latest_posts($tf_boards['news'], 5);

$tf_slides = array(
    array('src' => 'main/visual_slide/bg01.jpg', 'alt' => '우드 포인트 벽과 화이트 톤으로 시공한 거실 인테리어'),
    array('src' => 'main/visual_slide/bg02.jpg', 'alt' => '밝은 화이트 톤으로 리모델링한 거실과 주방'),
    array('src' => 'main/visual_slide/bg03.jpg', 'alt' => '라미네이트 판넬로 마감한 다이닝 공간'),
    array('src' => 'main/visual_slide/bg04.jpg', 'alt' => '브라운 라미네이트 벽면으로 시공한 다이닝 룸'),
);
?>

<!-- 히어로 -->
<section class="tf-hero" aria-roledescription="carousel" aria-label="더패스트 대표 시공 이미지">
    <div class="tf-hero__slides">
        <?php foreach ($tf_slides as $i => $s) { ?>
        <div class="tf-hero__slide<?php echo $i === 0 ? ' is-active' : ''; ?>" role="group" aria-roledescription="slide" aria-label="<?php echo ($i + 1).' / '.count($tf_slides); ?>"<?php echo $i ? ' aria-hidden="true"' : ''; ?>>
            <?php if ($i === 0) { ?>
            <img src="<?php echo tf_img($s['src']); ?>" alt="<?php echo $s['alt']; ?>" width="1920" height="1080" fetchpriority="high">
            <?php } else { ?>
            <img data-src="<?php echo tf_img($s['src']); ?>" src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" alt="<?php echo $s['alt']; ?>" width="1920" height="1080">
            <?php } ?>
        </div>
        <?php } ?>
    </div>

    <div class="tf-inner tf-hero__body">
        <p class="tf-hero__kicker"><i aria-hidden="true"></i>Dry Wall System · Laminate Panel</p>
        <h1 class="tf-hero__title">
            <span class="tf-hero__ko">더패스트 인테리어 리모델링</span>
            <span>Swifter</span>
            <span><b class="tf-amp">&amp;</b> Quieter</span>
        </h1>
        <p class="tf-hero__desc"><strong>더패스트</strong>는 큰 소음 없는 건식 시공으로<br>보다 빠르고 조용하게 만족스러운 공간을 만들어 드립니다.</p>
        <div class="tf-hero__actions">
            <a href="<?php echo $tf_inquiry_url; ?>" class="tf-btn tf-btn--primary tf-btn--lg">무료 견적 상담 <span aria-hidden="true">→</span></a>
            <a href="<?php echo tf_board_url($tf_boards['portfolio']); ?>" class="tf-btn tf-btn--ghost tf-btn--lg">시공사례 보기</a>
        </div>
    </div>

    <div class="tf-hero__ctrl">
        <span class="tf-hero__count" aria-live="off">01 / <?php printf('%02d', count($tf_slides)); ?></span>
        <span class="tf-hero__bar" aria-hidden="true"><i></i></span>
        <button type="button" class="tf-hero__btn tf-hero__prev" aria-label="이전 슬라이드"><span aria-hidden="true">&#8249;</span></button>
        <button type="button" class="tf-hero__btn tf-hero__toggle" aria-label="슬라이드 자동재생 정지"><span aria-hidden="true">&#10074;&#10074;</span></button>
        <button type="button" class="tf-hero__btn tf-hero__next" aria-label="다음 슬라이드"><span aria-hidden="true">&#8250;</span></button>
    </div>
    <span class="tf-hero__scroll" aria-hidden="true"></span>
</section>

<!-- 마퀴 -->
<div class="tf-marquee" aria-hidden="true">
    <div class="tf-marquee__track">
        <?php for ($k = 0; $k < 2; $k++) { ?>
        <span>THE FAST</span><span>Swifter &amp; Quieter</span><span>더패스트 인테리어</span><span>Dry Wall System</span><span>Laminate Panel</span><span>빠르고 조용한 리모델링</span>
        <?php } ?>
    </div>
</div>

<!-- 소개 -->
<section class="tf-section" aria-labelledby="tfIntroTitle">
    <div class="tf-inner tf-intro">
        <div class="tf-intro__media tf-reveal">
            <img src="<?php echo tf_img('sub/sub_visual/interior-hd.jpg'); ?>" alt="모던한 그레이 톤으로 리모델링한 거실과 다이닝 공간" width="960" height="1200" loading="lazy">
            <div class="tf-intro__badge">
                <b>철거·미장 최소화</b>
                <strong>건식 시공 시스템</strong>
            </div>
        </div>
        <div>
            <p class="tf-eyebrow tf-reveal">Why THE FAST</p>
            <h2 class="tf-h2 tf-reveal" id="tfIntroTitle">공사는 짧고 조용하게,<br>결과는 <em>오래도록</em> 깨끗하게.</h2>
            <p class="tf-lead tf-reveal">더패스트는 빠른 시공을 자랑하며, 큰 소음 없이 완벽하고 만족스러운 인테리어를 제공합니다. 공사 기간이 짧아 인건비 부담을 줄이고, 층간 공사 소음을 최소화해 이웃 간 불편함을 덜어 드립니다.</p>
            <ul class="tf-points">
                <li class="tf-point tf-reveal" data-delay="1">
                    <span class="tf-point__num">01</span>
                    <h3>빠른 시공</h3>
                    <p>판넬 결합 방식으로 합판·석고보드 없이 설치 시간을 최소화합니다.</p>
                </li>
                <li class="tf-point tf-reveal" data-delay="2">
                    <span class="tf-point__num">02</span>
                    <h3>저소음 공사</h3>
                    <p>타일 철거 없이 기존 벽면 위에 시공해 소음과 분진을 줄입니다.</p>
                </li>
                <li class="tf-point tf-reveal" data-delay="1">
                    <span class="tf-point__num">03</span>
                    <h3>친환경 자재</h3>
                    <p>접착제를 쓰지 않는 시공과 유해물질 미검출 자재를 사용합니다.</p>
                </li>
                <li class="tf-point tf-reveal" data-delay="2">
                    <span class="tf-point__num">04</span>
                    <h3>비용 절감</h3>
                    <p>짧은 공기로 인건비를 낮추고, 고급 마감을 합리적인 비용으로 구현합니다.</p>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- 제품 -->
<section class="tf-section tf-section--stone" aria-labelledby="tfProductTitle">
    <div class="tf-inner">
        <div class="tf-head">
            <div class="tf-head__text">
                <p class="tf-eyebrow tf-reveal">Products</p>
                <h2 class="tf-h2 tf-reveal" id="tfProductTitle">어떤 공간이든<br>완성도를 높이는 마감재</h2>
            </div>
            <a href="<?php echo tf_page_url('product', 'type=wall'); ?>" class="tf-link tf-reveal">전체 제품 보기 <span aria-hidden="true">→</span></a>
        </div>
        <div class="tf-bento">
            <a href="<?php echo tf_page_url('product', 'type=wall'); ?>#laminate-panel" class="tf-bento__item tf-reveal">
                <img src="<?php echo tf_img('main/pd-img01.jpg'); ?>" alt="" width="960" height="720" loading="lazy">
                <span class="tf-bento__arrow" aria-hidden="true">→</span>
                <span class="tf-bento__cat">Wall · 벽장재</span>
                <h3>라미네이트 판넬</h3>
                <p>나무, 돌, 세라믹 등 다양한 텍스처와 색상으로 고급스러운 인테리어를 연출합니다.</p>
            </a>
            <a href="<?php echo tf_page_url('product', 'type=wall'); ?>#laminate-tile" class="tf-bento__item tf-reveal" data-delay="1">
                <img src="<?php echo tf_img('main/pd-img02.jpg'); ?>" alt="" width="960" height="720" loading="lazy">
                <span class="tf-bento__arrow" aria-hidden="true">→</span>
                <span class="tf-bento__cat">Wall · 벽장재</span>
                <h3>라미네이트 타일</h3>
                <p>타공 없이 간편하고 빠르게, 충격·마모에 강하고 방수가 뛰어납니다.</p>
            </a>
            <a href="<?php echo tf_page_url('product', 'type=wall'); ?>#prime-line" class="tf-bento__item tf-reveal" data-delay="2">
                <img src="<?php echo tf_img('main/pd-img03.jpg'); ?>" alt="" width="960" height="720" loading="lazy">
                <span class="tf-bento__arrow" aria-hidden="true">→</span>
                <span class="tf-bento__cat">Acoustic · 흡음</span>
                <h3>프라임 타공보드</h3>
                <p>소음 저감과 준불연 성능, 습기·곰팡이에 강한 항균 기능을 갖췄습니다.</p>
            </a>
            <a href="<?php echo tf_page_url('product', 'type=ceiling'); ?>" class="tf-bento__item tf-reveal">
                <img src="<?php echo tf_img('main/pd-img04.jpg'); ?>" alt="" width="1920" height="720" loading="lazy">
                <span class="tf-bento__arrow" aria-hidden="true">→</span>
                <span class="tf-bento__cat">Ceiling · 천장재</span>
                <h3>천연 석고 천장재</h3>
                <p>천공 패널로 소리와 진동을 줄이고, 화재에 안전한 불연 천장재입니다.</p>
            </a>
        </div>
    </div>
</section>

<!-- 시공사례 -->
<section class="tf-section" aria-labelledby="tfPortTitle">
    <div class="tf-inner">
        <div class="tf-head">
            <div class="tf-head__text">
                <p class="tf-eyebrow tf-reveal">Portfolio</p>
                <h2 class="tf-h2 tf-reveal" id="tfPortTitle">더패스트가 완성한 공간</h2>
                <p class="tf-lead tf-reveal">거실, 주방, 욕실부터 관공서와 상업 공간까지 빠른 시공이 가능합니다.</p>
            </div>
            <nav class="tf-space tf-reveal" aria-label="시공사례 분류">
                <?php foreach ($tf_portfolio_cates as $cate => $info) { ?>
                <a href="<?php echo tf_board_url($tf_boards['portfolio'], $cate); ?>"><?php echo $cate; ?></a>
                <?php } ?>
            </nav>
        </div>

        <?php if ($tf_portfolio) { ?>
        <ul class="tf-cards">
            <?php foreach ($tf_portfolio as $i => $p) { ?>
            <li class="tf-reveal" data-delay="<?php echo $i % 3; ?>">
                <a href="<?php echo $p['href']; ?>" class="tf-card">
                    <div class="tf-card__img">
                        <?php if ($p['thumb']) { ?>
                        <img src="<?php echo $p['thumb']; ?>" alt="<?php echo $p['alt']; ?>" width="640" height="480" loading="lazy">
                        <?php } else { ?>
                        <span class="tf-card__noimg">이미지 준비중</span>
                        <?php } ?>
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
        <?php } else { ?>
        <div class="tf-empty"><strong>시공사례를 준비하고 있습니다.</strong>곧 더패스트의 다양한 시공 현장을 소개해 드리겠습니다.</div>
        <?php } ?>
    </div>
</section>

<!-- 시공 프로세스 -->
<section class="tf-section tf-section--navy" aria-labelledby="tfStepTitle">
    <div class="tf-inner">
        <div class="tf-head">
            <div class="tf-head__text">
                <p class="tf-eyebrow tf-eyebrow--light tf-reveal">Process</p>
                <h2 class="tf-h2 tf-reveal" id="tfStepTitle">상담부터 준공까지,<br>투명하게 안내해 드립니다.</h2>
            </div>
            <a href="<?php echo tf_page_url('process'); ?>" class="tf-btn tf-btn--ghost tf-reveal">시공 프로세스 자세히 보기</a>
        </div>
        <ol class="tf-steps">
            <li class="tf-reveal"><b>STEP 01</b><h3>견적 문의</h3><p>상담 접수 후 3일 이내 담당자가 배정되어 대략적인 견적을 안내합니다.</p></li>
            <li class="tf-reveal" data-delay="1"><b>STEP 02</b><h3>상담 안내</h3><p>현장 사진, 도면, 원하시는 사항을 바탕으로 비용과 일정을 상담합니다.</p></li>
            <li class="tf-reveal" data-delay="2"><b>STEP 03</b><h3>현장 방문</h3><p>실측과 전기·설비 구성을 확인하고 공사 방향을 정합니다.</p></li>
            <li class="tf-reveal" data-delay="3"><b>STEP 04</b><h3>견적 &amp; 계약</h3><p>세부 견적을 바탕으로 계약 후 담당 설계 디자이너가 배정됩니다.</p></li>
            <li class="tf-reveal"><b>STEP 05</b><h3>디자인 · 설계</h3><p>평면 또는 3D 모델링으로 마감재, 가구, 조명을 협의합니다.</p></li>
            <li class="tf-reveal" data-delay="1"><b>STEP 06</b><h3>시공</h3><p>공사 담당자가 사전 조율된 내용을 바탕으로 단계별 시공을 진행합니다.</p></li>
            <li class="tf-reveal" data-delay="2"><b>STEP 07</b><h3>현장 공유</h3><p>공사 기간 동안 현장 현황을 사진·영상으로 안내해 드립니다.</p></li>
            <li class="tf-reveal" data-delay="3"><b>STEP 08</b><h3>준공</h3><p>잔손 작업과 베이크아웃을 마친 뒤 깨끗한 공간을 인도합니다.</p></li>
        </ol>
    </div>
</section>

<!-- 후기 / 소식 -->
<section class="tf-section" aria-label="고객후기와 더패스트 소식">
    <div class="tf-inner tf-split">
        <div class="tf-mini tf-reveal">
            <div class="tf-mini__head">
                <h2 class="tf-mini__title">고객 후기</h2>
                <a href="<?php echo tf_board_url($tf_boards['review']); ?>">더보기<span class="sound_only"> 고객 후기</span> +</a>
            </div>
            <?php if ($tf_reviews) { ?>
            <ul class="tf-mini__list">
                <?php foreach ($tf_reviews as $r) { ?>
                <li><a href="<?php echo $r['href']; ?>"><span class="tf-mini__subject"><?php echo $r['subject']; ?></span><time class="tf-mini__date" datetime="<?php echo $r['datetime']; ?>"><?php echo $r['date']; ?></time></a></li>
                <?php } ?>
            </ul>
            <?php } else { ?>
            <p class="tf-mini__empty">등록된 후기가 없습니다.</p>
            <?php } ?>
        </div>
        <div class="tf-mini tf-reveal" data-delay="1">
            <div class="tf-mini__head">
                <h2 class="tf-mini__title">더패스트 소식</h2>
                <a href="<?php echo tf_board_url($tf_boards['news']); ?>">더보기<span class="sound_only"> 더패스트 소식</span> +</a>
            </div>
            <?php if ($tf_news) { ?>
            <ul class="tf-mini__list">
                <?php foreach ($tf_news as $r) { ?>
                <li><a href="<?php echo $r['href']; ?>"><span class="tf-mini__subject"><?php echo $r['subject']; ?></span><time class="tf-mini__date" datetime="<?php echo $r['datetime']; ?>"><?php echo $r['date']; ?></time></a></li>
                <?php } ?>
            </ul>
            <?php } else { ?>
            <p class="tf-mini__empty">등록된 소식이 없습니다.</p>
            <?php } ?>
        </div>
    </div>
</section>

<?php
include_once(G5_THEME_PATH.'/tail.php');
