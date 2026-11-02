<?php
if (!defined('_GNUBOARD_')) include_once('./_common.php');

$g5['title']  = '더패스트 소개';
$tf_current   = 'about';
$tf_full      = true;
$tf_meta      = array('description' => '더패스트(THE FAST)는 라미네이트 판넬 건식 시공으로 빠르고 조용한 리모델링을 제공하는 인테리어 시공 전문기업입니다. 주거공간, 관공서, 학교, 병원, 상업시설 인테리어.');

include_once(G5_THEME_PATH.'/head.php');
include_once(G5_THEME_PATH.'/inc/tf.lib.php');
?>

<section class="tf-section" aria-labelledby="tfAboutTitle">
    <div class="tf-inner">
        <div class="tf-about-hero">
            <div>
                <p class="tf-eyebrow tf-reveal">About THE FAST</p>
                <h2 class="tf-about-hero__title tf-reveal" id="tfAboutTitle">보다 빠르고 조용하게,<br>만족스러운 <em>공간</em>을<br>만들어 드립니다.</h2>
            </div>
            <div class="tf-reveal" data-delay="1">
                <p>인테리어 리모델링을 계획하고 계신가요? <strong>더패스트</strong>는 빠른 시공을 자랑하며, 큰 소음 없이 완벽하고 만족스러운 인테리어를 제공합니다.</p>
                <p>공사 기간이 짧아 인건비 부담을 현저히 줄일 수 있으며, 층간 공사 소음이 최소화되어 이웃 간 불편함을 덜어 드립니다.</p>
                <p>더욱 깨끗하고 세련된 아름다움을 갖춘 인테리어 솔루션으로 고객님께서 원하시는 완벽한 공간을 실현해 드립니다.</p>
            </div>
        </div>
        <figure class="tf-wide-img tf-reveal">
            <img src="<?php echo tf_img('main/visual_slide/bg02.jpg'); ?>" alt="화이트 톤으로 깔끔하게 리모델링한 거실과 주방" width="1920" height="823" loading="lazy">
        </figure>
    </div>
</section>

<section class="tf-section tf-section--stone" aria-labelledby="tfValueTitle">
    <div class="tf-inner">
        <div class="tf-head">
            <div class="tf-head__text">
                <p class="tf-eyebrow tf-reveal">Our Value</p>
                <h2 class="tf-h2 tf-reveal" id="tfValueTitle">더패스트가 약속하는 네 가지</h2>
            </div>
        </div>
        <ul class="tf-values">
            <li class="tf-value tf-reveal">
                <span class="tf-value__icon"><?php echo tf_icon('speed'); ?></span>
                <h3>빠른 시공</h3>
                <p>합판이나 석고보드 없이 판넬 결합 방식으로 설치해 공사 기간을 크게 줄입니다.</p>
            </li>
            <li class="tf-value tf-reveal" data-delay="1">
                <span class="tf-value__icon"><?php echo tf_icon('quiet'); ?></span>
                <h3>조용한 공사</h3>
                <p>기존 벽면에 바로 부착하는 건식 시공으로 철거 소음과 분진을 최소화합니다.</p>
            </li>
            <li class="tf-value tf-reveal" data-delay="2">
                <span class="tf-value__icon"><?php echo tf_icon('leaf'); ?></span>
                <h3>친환경 자재</h3>
                <p>접착제를 사용하지 않고, 유해물질이 검출되지 않은 인증 자재를 사용합니다.</p>
            </li>
            <li class="tf-value tf-reveal" data-delay="3">
                <span class="tf-value__icon"><?php echo tf_icon('won'); ?></span>
                <h3>합리적인 비용</h3>
                <p>짧은 공기로 인건비를 줄이고, 고급 마감을 경제적인 비용으로 구현합니다.</p>
            </li>
        </ul>
    </div>
</section>

<section class="tf-section" aria-labelledby="tfBizTitle">
    <div class="tf-inner">
        <div class="tf-head">
            <div class="tf-head__text">
                <p class="tf-eyebrow tf-reveal">Business</p>
                <h2 class="tf-h2 tf-reveal" id="tfBizTitle">공간의 목적에 맞춘 시공</h2>
                <p class="tf-lead tf-reveal">주거 공간부터 학교, 병원, 관공서, 상업시설까지 다양한 현장을 시공합니다.</p>
            </div>
            <a href="<?php echo tf_board_url($tf_boards['portfolio']); ?>" class="tf-link tf-reveal">시공사례 보기 <span aria-hidden="true">→</span></a>
        </div>
        <div class="tf-biz">
            <a href="<?php echo tf_portfolio_url('주거공간'); ?>" class="tf-biz__item tf-reveal">
                <img src="<?php echo tf_img('main/visual_slide/bg01.jpg'); ?>" alt="" width="800" height="1000" loading="lazy">
                <div class="tf-biz__body"><h3>주거공간</h3><p>아파트 · 단독주택 · 빌라 · 욕실 · 주방</p></div>
            </a>
            <a href="<?php echo tf_portfolio_url('관공서'); ?>" class="tf-biz__item tf-reveal" data-delay="1">
                <img src="<?php echo tf_img('main/pd-img03.jpg'); ?>" alt="" width="800" height="1000" loading="lazy">
                <div class="tf-biz__body"><h3>관공서 · 교육시설</h3><p>관공서 · 학교 · 어린이집 · 병원 · 강당</p></div>
            </a>
            <a href="<?php echo tf_portfolio_url('상업시설'); ?>" class="tf-biz__item tf-reveal" data-delay="2">
                <img src="<?php echo tf_img('sub/sub_visual/portfolio-hd.jpg'); ?>" alt="" width="800" height="1000" loading="lazy">
                <div class="tf-biz__body"><h3>상업시설</h3><p>카페 · 매장 · 사무실 · 피트니스센터</p></div>
            </a>
        </div>
    </div>
</section>

<section class="tf-section tf-section--stone" aria-labelledby="tfCorpTitle">
    <div class="tf-inner tf-process-intro">
        <div>
            <p class="tf-eyebrow tf-reveal">Company</p>
            <h2 class="tf-h2 tf-reveal" id="tfCorpTitle">회사 정보</h2>
            <table class="tf-spec tf-reveal">
                <caption class="sound_only">더패스트 회사 정보</caption>
                <tbody>
                    <tr><th scope="row">상호</th><td><?php echo $tf_site['corp']; ?> (<?php echo $tf_site['name_en']; ?>)</td></tr>
                    <tr><th scope="row">대표</th><td><?php echo $tf_site['ceo']; ?></td></tr>
                    <tr><th scope="row">사업자번호</th><td><?php echo $tf_site['biz_no']; ?></td></tr>
                    <tr><th scope="row">주소</th><td><?php echo $tf_site['addr']; ?></td></tr>
                    <tr><th scope="row">대표번호</th><td><a href="<?php echo tf_tel_href($tf_site['tel']); ?>"><?php echo $tf_site['tel_label']; ?></a></td></tr>
                    <tr><th scope="row">이메일</th><td><a href="mailto:<?php echo $tf_site['email']; ?>"><?php echo $tf_site['email']; ?></a></td></tr>
                </tbody>
            </table>
        </div>
        <img class="tf-reveal" data-delay="1" src="<?php echo tf_img('sub/section_process.jpg'); ?>" alt="인테리어 설계 도면과 주택 모형" width="1000" height="800" loading="lazy">
    </div>
</section>

<?php
include_once(G5_THEME_PATH.'/tail.php');
