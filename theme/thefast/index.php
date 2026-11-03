<?php
if (!defined('_INDEX_')) define('_INDEX_', true);
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

include_once(G5_THEME_PATH.'/head.php');
include_once(G5_THEME_PATH.'/inc/tf.lib.php');
include_once(G5_THEME_PATH.'/inc/spaces.php');

// 게시판이 없으면 해당 영역은 출력하지 않음
$tf_has_portfolio = tf_board_exists($tf_boards['portfolio']);
$tf_has_review    = tf_board_exists($tf_boards['review']);
$tf_has_news      = tf_board_exists($tf_boards['news']);

$tf_portfolio = $tf_has_portfolio ? tf_latest_posts($tf_boards['portfolio'], 6, 640, 480) : array();
// 첫 번째(크게 보이는) 사례는 큰 썸네일로 다시 요청 (원본이 작으면 원본 크기까지만)
if (count($tf_portfolio) >= 4) {
    $tf_big = tf_post_thumb($tf_boards['portfolio'], $tf_portfolio[0]['wr_id'], 1280, 960);
    if ($tf_big) $tf_portfolio[0]['thumb'] = $tf_big;
}
$tf_reviews   = $tf_has_review ? tf_latest_posts($tf_boards['review'], 5) : array();
$tf_news      = $tf_has_news ? tf_latest_posts($tf_boards['news'], 5) : array();

/*
 * 메인 영상 (AI 연출 영상) — 파일만 바꾸면 교체됩니다. (theme/thefast/ 기준 경로)
 * desktop: PC용 1080p / mobile: 휴대폰용 720p / poster: 영상이 뜨기 전 첫 장면
 * 소리 없이 자동재생되며, 1번 → 2번 → 1번 순서로 이어서 재생합니다.
 */
$tf_videos = array(
    array('desktop' => 'video/hero1-1080.mp4', 'mobile' => 'video/hero1-720.mp4', 'poster' => 'img/main/hero1-poster.jpg'),
    array('desktop' => 'video/hero2-1080.mp4', 'mobile' => 'video/hero2-720.mp4', 'poster' => 'img/main/hero2-poster.jpg'),
);
// 움직임 줄이기 설정·데이터 절약 모드에서는 영상 대신 이 이미지를 보여줍니다.
$tf_hero_static = 'img/main/hero-static.jpg';
?>

<!-- 히어로 (연출 영상) -->
<section class="tf-hero" aria-label="더패스트 메인 영상" style="--tf-hero-static:url('<?php echo G5_THEME_URL.'/'.$tf_hero_static; ?>')">
    <div class="tf-hero__slides" aria-hidden="true">
        <?php foreach ($tf_videos as $i => $v) { ?>
        <div class="tf-hero__slide<?php echo $i === 0 ? ' is-active' : ''; ?>">
            <video class="tf-hero__video" muted playsinline disablepictureinpicture disableremoteplayback preload="none" tabindex="-1"
                poster="<?php echo G5_THEME_URL.'/'.$v['poster']; ?>"
                data-src-desktop="<?php echo G5_THEME_URL.'/'.$v['desktop']; ?>"
                data-src-mobile="<?php echo G5_THEME_URL.'/'.$v['mobile']; ?>"></video>
        </div>
        <?php } ?>
    </div>
    <p class="tf-hero__note">연출 영상</p>

    <div class="tf-inner tf-hero__body">
        <!-- 문구 2세트: 영상 1·2와 함께 바뀜 (검색엔진용 대표 제목 h1 은 1번 문구) -->
        <div class="tf-hero__msgs">
            <div class="tf-hero__msg is-active">
                <h1 class="tf-hero__h1">
                    <span class="tf-hero__eyebrow tf-hero__in" style="--d:0"><i aria-hidden="true"></i>더패스트 인테리어<span class="tf-hero__en" aria-hidden="true">Swifter &amp; Quieter</span></span>
                    <span class="tf-hero__line"><span class="tf-hero__mask" style="--d:1">거주 중 리모델링도,</span></span>
                    <span class="tf-hero__line"><span class="tf-hero__mask" style="--d:2">빠르고 조용하게<b class="tf-hero__dot" aria-hidden="true">.</b></span></span>
                </h1>
                <p class="tf-hero__lead tf-hero__in" style="--d:3">철거와 소음은 줄이고 공사 기간은 짧게.<br class="tf-br-pc"> 욕실·주방·거실을 새롭게 바꿔 드립니다.</p>
            </div>
            <div class="tf-hero__msg">
                <p class="tf-hero__h1">
                    <span class="tf-hero__eyebrow tf-hero__in" style="--d:0"><i aria-hidden="true"></i>건설업 면허 보유 시공사</span>
                    <span class="tf-hero__line"><span class="tf-hero__mask" style="--d:1">면허 갖춘 시공사,</span></span>
                    <span class="tf-hero__line"><span class="tf-hero__mask" style="--d:2">믿고 맡기는 리모델링<b class="tf-hero__dot" aria-hidden="true">.</b></span></span>
                </p>
                <p class="tf-hero__lead tf-hero__in" style="--d:3">실내건축공사업을 포함한 건설업 면허 <?php echo count($tf_licenses); ?>종을<br class="tf-br-pc"> 등록한 인테리어 시공 회사입니다.</p>
                <ul class="tf-hero__badges tf-hero__in" style="--d:4">
                    <li><?php echo $tf_licenses[0]['name']; ?> 면허</li>
                    <li>건설업 면허 <?php echo count($tf_licenses); ?>종</li>
                    <?php if (tf_active_certs()) { ?><li>여성기업</li><?php } ?>
                </ul>
            </div>
        </div>
        <div class="tf-hero__actions tf-hero__in" style="--d:4">
            <a href="<?php echo $tf_inquiry_url; ?>" class="tf-btn tf-btn--primary tf-btn--lg">무료 견적 상담 <span aria-hidden="true">→</span></a>
            <?php if ($tf_has_portfolio) { ?>
            <a href="<?php echo tf_portfolio_url(); ?>" class="tf-btn tf-btn--glass tf-btn--lg">시공사례 보기</a>
            <?php } else { ?>
            <a href="<?php echo tf_page_url('space', 'type=bath'); ?>" class="tf-btn tf-btn--glass tf-btn--lg">공간별 리모델링 보기</a>
            <?php } ?>
        </div>
    </div>

    <div class="tf-hero__foot">
        <div class="tf-inner tf-hero__foot-inner">
            <span class="tf-hero__cue" aria-hidden="true"><i></i>Scroll</span>
            <div class="tf-hero__ctrl">
                <span class="tf-hero__count" aria-live="off">01 / <?php printf('%02d', count($tf_videos)); ?></span>
                <div class="tf-hero__segs">
                    <?php foreach ($tf_videos as $i => $v) { ?>
                    <button type="button" class="tf-hero__seg<?php echo $i === 0 ? ' is-active' : ''; ?>" aria-label="<?php echo $i + 1; ?>번 영상 보기"<?php echo $i === 0 ? ' aria-current="true"' : ''; ?>><i></i></button>
                    <?php } ?>
                </div>
                <button type="button" class="tf-hero__btn tf-hero__toggle" aria-label="영상 정지"><span aria-hidden="true">&#10074;&#10074;</span></button>
            </div>
        </div>
    </div>
</section>

<!-- 마퀴 -->
<div class="tf-marquee" aria-hidden="true">
    <div class="tf-marquee__track">
        <?php for ($k = 0; $k < 2; $k++) { ?>
        <span>더패스트 인테리어</span><span>욕실 리모델링</span><span>주방 리모델링</span><span>거실 아트월</span><span>전체 리모델링</span><span>Swifter &amp; Quieter</span>
        <?php } ?>
    </div>
</div>

<?php if ($tf_has_portfolio) { ?>
<!-- 시공사례 -->
<section class="tf-section" aria-labelledby="tfPortTitle">
    <div class="tf-inner">
        <div class="tf-head">
            <div class="tf-head__text">
                <p class="tf-eyebrow tf-reveal">Portfolio</p>
                <h2 class="tf-h2 tf-reveal" id="tfPortTitle">더패스트가 완성한 공간</h2>
                <p class="tf-lead tf-reveal">욕실, 주방, 거실까지 더패스트가 직접 시공한 현장을 확인해 보세요.</p>
            </div>
            <?php if ($tf_portfolio_cates) { ?>
            <nav class="tf-space tf-reveal" aria-label="시공사례 분류">
                <?php foreach ($tf_portfolio_cates as $cate) { ?>
                <a href="<?php echo tf_portfolio_url($cate); ?>"><?php echo get_text($cate); ?></a>
                <?php } ?>
            </nav>
            <?php } else { ?>
            <a href="<?php echo tf_portfolio_url(); ?>" class="tf-link tf-reveal">시공사례 전체 보기 <span aria-hidden="true">→</span></a>
            <?php } ?>
        </div>

        <?php if ($tf_portfolio) { ?>
        <ul class="tf-cards<?php echo count($tf_portfolio) >= 4 ? ' tf-cards--feature' : ''; ?>">
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
        <div class="tf-empty"><strong>시공사례를 준비하고 있습니다.</strong>곧 더패스트의 시공 현장을 소개해 드리겠습니다.</div>
        <?php } ?>
    </div>
</section>
<?php } ?>

<!-- 공간별 리모델링 -->
<section class="tf-section<?php echo $tf_has_portfolio ? ' tf-section--stone' : ''; ?>" aria-labelledby="tfSpaceTitle">
    <div class="tf-inner">
        <div class="tf-head">
            <div class="tf-head__text">
                <p class="tf-eyebrow tf-reveal">Spaces</p>
                <h2 class="tf-h2 tf-reveal" id="tfSpaceTitle">어떤 공간을<br>바꾸고 싶으세요?</h2>
            </div>
        </div>
        <ul class="tf-spaces">
            <?php $i = 0; foreach ($tf_spaces as $k => $sp) { ?>
            <li class="tf-reveal" data-delay="<?php echo $i++ % 4; ?>">
                <a href="<?php echo tf_page_url('space', 'type='.$k); ?>" class="tf-spaces__item">
                    <img src="<?php echo tf_img($sp['thumb']); ?>" alt="" width="640" height="800" loading="lazy">
                    <span class="tf-spaces__en"><?php echo $sp['en']; ?></span>
                    <h3><?php echo $sp['title']; ?></h3>
                    <p><?php echo $sp['pains'][0]; ?>, 이제 해결하세요.</p>
                    <span class="tf-bento__arrow" aria-hidden="true">→</span>
                </a>
            </li>
            <?php } ?>
        </ul>
    </div>
</section>

<!-- 면허·인증 신뢰 띠 -->
<section class="tf-trust" aria-label="면허 및 인증">
    <div class="tf-inner tf-trust__inner">
        <p class="tf-trust__lead">면허를 갖춘 인테리어 시공 회사</p>
        <ul class="tf-trust__list">
            <?php foreach ($tf_licenses as $l) { ?>
            <li><svg aria-hidden="true" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/></svg><?php echo $l['name']; ?> 면허</li>
            <?php } ?>
            <?php foreach (tf_active_certs() as $c) { ?>
            <li><svg aria-hidden="true" viewBox="0 0 24 24" width="18" height="18" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="9" r="6"/><path d="m8.5 14.5-1.5 7.5 5-3 5 3-1.5-7.5"/></svg><?php echo $c['name']; ?></li>
            <?php } ?>
        </ul>
        <a href="<?php echo tf_page_url('about'); ?>#license" class="tf-link">면허·인증 보기 <span aria-hidden="true">→</span></a>
    </div>
</section>

<!-- 더패스트 공법 -->
<section class="tf-section" aria-labelledby="tfIntroTitle">
    <div class="tf-inner tf-intro">
        <div class="tf-intro__media tf-reveal">
            <img src="<?php echo tf_img('sub/sub_visual/interior-hd.jpg'); ?>" alt="모던한 그레이 톤으로 리모델링한 거실과 다이닝 공간" width="960" height="1200" loading="lazy">
            <div class="tf-intro__badge">
                <b>철거·미장 최소화</b>
                <strong>건식 시공</strong>
            </div>
        </div>
        <div>
            <p class="tf-eyebrow tf-reveal">Why THE FAST</p>
            <h2 class="tf-h2 tf-reveal" id="tfIntroTitle">공사는 짧고 조용하게,<br>결과는 <em>오래도록</em> 깨끗하게.</h2>
            <p class="tf-lead tf-reveal">더패스트는 큰 소음 없이 빠르게 시공합니다. 공사 기간이 짧아 인건비 부담을 줄이고, 층간 공사 소음을 최소화해 이웃 간 불편함을 덜어 드립니다.</p>
            <ul class="tf-points">
                <li class="tf-point tf-reveal" data-delay="1">
                    <span class="tf-point__num">01</span>
                    <h3>빠른 시공</h3>
                    <p>판넬 결합 방식으로 합판·석고보드 없이 설치 시간을 줄입니다.</p>
                </li>
                <li class="tf-point tf-reveal" data-delay="2">
                    <span class="tf-point__num">02</span>
                    <h3>조용한 공사</h3>
                    <p>기존 벽면 위에 시공해 철거 소음과 분진을 줄입니다.</p>
                </li>
                <li class="tf-point tf-reveal" data-delay="1">
                    <span class="tf-point__num">03</span>
                    <h3>친환경 자재</h3>
                    <p>접착제 없는 시공과 유해물질 미검출 자재를 사용합니다.</p>
                </li>
                <li class="tf-point tf-reveal" data-delay="2">
                    <span class="tf-point__num">04</span>
                    <h3>합리적인 비용</h3>
                    <p>짧은 공사 기간으로 비용을 줄이고 고급 마감을 구현합니다.</p>
                </li>
            </ul>
        </div>
    </div>
</section>

<!-- 시공 프로세스 (4단계 요약) -->
<section class="tf-section tf-section--navy" aria-labelledby="tfStepTitle">
    <div class="tf-inner">
        <div class="tf-head">
            <div class="tf-head__text">
                <p class="tf-eyebrow tf-eyebrow--light tf-reveal">Process</p>
                <h2 class="tf-h2 tf-reveal" id="tfStepTitle">상담부터 입주까지,<br>담당자가 함께합니다.</h2>
            </div>
            <a href="<?php echo tf_page_url('process'); ?>" class="tf-btn tf-btn--ghost tf-reveal">8단계 프로세스 자세히 보기</a>
        </div>
        <ol class="tf-steps">
            <li class="tf-reveal"><b>STEP 01</b><h3>상담 · 견적</h3><p>상담 접수 후 3일 이내 담당자가 배정되어 대략적인 견적을 안내합니다.</p></li>
            <li class="tf-reveal" data-delay="1"><b>STEP 02</b><h3>현장 실측</h3><p>실측과 전기·설비 구성을 확인하고 공사 방향과 세부 견적을 정합니다.</p></li>
            <li class="tf-reveal" data-delay="2"><b>STEP 03</b><h3>디자인 · 계약</h3><p>평면 또는 3D 모델링으로 마감재, 가구, 조명을 함께 정합니다.</p></li>
            <li class="tf-reveal" data-delay="3"><b>STEP 04</b><h3>시공 · 입주</h3><p>현장을 사진·영상으로 공유하고, 잔손 작업과 베이크아웃 후 인도합니다.</p></li>
        </ol>
    </div>
</section>

<?php if ($tf_has_review || $tf_has_news) { ?>
<!-- 후기 / 소식 -->
<section class="tf-section" aria-label="고객후기와 더패스트 소식">
    <div class="tf-inner<?php echo ($tf_has_review && $tf_has_news) ? ' tf-split' : ''; ?>">
        <?php if ($tf_has_review) { ?>
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
        <?php } ?>
        <?php if ($tf_has_news) { ?>
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
        <?php } ?>
    </div>
</section>
<?php } ?>

<!-- 시공 자재 (작게) -->
<section class="tf-section tf-section--stone tf-section--compact" aria-labelledby="tfMatTitle">
    <div class="tf-inner tf-mats">
        <div>
            <p class="tf-eyebrow tf-reveal">Materials</p>
            <h2 class="tf-mats__title tf-reveal" id="tfMatTitle">더패스트 시공에 쓰는 자재</h2>
            <p class="tf-mats__desc tf-reveal">물과 오염에 강하고 유해물질 걱정을 줄인 건식 마감재를 사용합니다.</p>
        </div>
        <ul class="tf-mats__list">
            <li class="tf-reveal"><a href="<?php echo tf_page_url('product', 'type=wall'); ?>"><img src="<?php echo tf_img('main/pd-img01.jpg'); ?>" alt="" width="120" height="120" loading="lazy"><span><b>벽장재</b>라미네이트 판넬·타일, 타공보드</span></a></li>
            <li class="tf-reveal" data-delay="1"><a href="<?php echo tf_page_url('product', 'type=floor'); ?>"><img src="<?php echo tf_img('sub/product/emotion_sheet01.jpg'); ?>" alt="" width="120" height="120" loading="lazy"><span><b>바닥재</b>미끄럼 방지·친환경 바닥재</span></a></li>
            <li class="tf-reveal" data-delay="2"><a href="<?php echo tf_page_url('product', 'type=ceiling'); ?>"><img src="<?php echo tf_img('main/pd-img04.jpg'); ?>" alt="" width="120" height="120" loading="lazy"><span><b>천장재</b>흡음·불연 천연 석고</span></a></li>
        </ul>
    </div>
</section>

<?php
include_once(G5_THEME_PATH.'/tail.php');
