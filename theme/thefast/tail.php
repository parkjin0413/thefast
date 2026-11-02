<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가

global $tf_site, $tf_menu, $tf_boards, $tf_inquiry_url, $tf_current, $tf_full;

// 상담/제휴 문의 화면에서는 하단 CTA 를 숨깁니다.
$tf_hide_cta = in_array($tf_current, array('inquiry', 'partner'), true);
?>
<?php if (empty($tf_full)) { ?>
</div><!-- /.tf-content -->
<?php } ?>
</main>

<?php if (!$tf_hide_cta) { ?>
<section class="tf-cta" aria-labelledby="tfCtaTitle">
    <div class="tf-inner tf-cta__inner">
        <div>
            <p class="tf-eyebrow tf-eyebrow--light">Free Consulting</p>
            <h2 class="tf-cta__title" id="tfCtaTitle">공사 기간은 짧게, 소음은 적게.<br>지금 바로 상담 받아보세요.</h2>
        </div>
        <div class="tf-cta__actions">
            <a href="<?php echo $tf_inquiry_url; ?>" class="tf-btn tf-btn--light tf-btn--lg">온라인 상담 신청 <span aria-hidden="true">→</span></a>
            <a href="<?php echo tf_tel_href($tf_site['tel']); ?>" class="tf-btn tf-btn--ghost tf-btn--lg"><?php echo $tf_site['tel_label']; ?></a>
        </div>
    </div>
</section>
<?php } ?>

<footer class="tf-footer">
    <div class="tf-inner">
        <div class="tf-footer__top">
            <div class="tf-footer__brand">
                <img src="<?php echo tf_img('logo_w.png'); ?>" alt="<?php echo $tf_site['name']; ?> THE FAST" width="180" height="54" loading="lazy">
                <p><?php echo $tf_site['slogan']; ?></p>
                <ul class="tf-sns" aria-label="더패스트 SNS">
                    <?php if ($tf_site['blog']) { ?><li><a href="<?php echo $tf_site['blog']; ?>" target="_blank" rel="noopener" title="새 창">네이버 블로그</a></li><?php } ?>
                    <?php if ($tf_site['instagram']) { ?><li><a href="<?php echo $tf_site['instagram']; ?>" target="_blank" rel="noopener" title="새 창">인스타그램</a></li><?php } ?>
                    <?php if ($tf_site['youtube']) { ?><li><a href="<?php echo $tf_site['youtube']; ?>" target="_blank" rel="noopener" title="새 창">유튜브</a></li><?php } ?>
                    <?php if ($tf_site['kakao']) { ?><li><a href="<?php echo $tf_site['kakao']; ?>" target="_blank" rel="noopener" title="새 창">카카오톡 채널</a></li><?php } ?>
                </ul>
            </div>

            <nav class="tf-footer__nav" aria-label="사이트맵">
                <?php foreach ($tf_menu as $group) { ?>
                <div>
                    <h2><?php echo get_text($group['title']); ?></h2>
                    <ul>
                        <?php foreach ($group['sub'] as $item) { if ($item['title'] === '전체') continue; ?>
                        <li><a href="<?php echo $item['href']; ?>"><?php echo get_text($item['title']); ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <?php } ?>
            </nav>

            <div class="tf-footer__cs">
                <h2>고객센터</h2>
                <a href="<?php echo tf_tel_href($tf_site['tel']); ?>" class="tf-footer__tel"><?php echo $tf_site['tel_label']; ?></a>
                <p><?php echo $tf_site['hours']; ?><br><?php echo $tf_site['hours_note']; ?></p>
            </div>
        </div>

        <div class="tf-footer__bottom">
            <ul class="tf-footer__links">
                <li><a href="<?php echo tf_page_url('about'); ?>">회사소개</a></li>
                <li><a href="<?php echo get_pretty_url('content', 'provision'); ?>">이용약관</a></li>
                <li><a href="<?php echo get_pretty_url('content', 'privacy'); ?>"><strong>개인정보처리방침</strong></a></li>
                <li><a href="<?php echo tf_page_url('location'); ?>">오시는 길</a></li>
                <li><a href="<?php echo tf_board_url($tf_boards['partner']); ?>">제휴 문의</a></li>
            </ul>
            <address class="tf-footer__info">
                <span><?php echo $tf_site['corp']; ?></span>
                <span>대표 <?php echo $tf_site['ceo']; ?></span>
                <span>사업자등록번호 <?php echo $tf_site['biz_no']; ?></span><br class="tf-br-pc">
                <span><?php echo $tf_site['addr']; ?></span>
                <span>대표번호 <?php echo $tf_site['tel_label']; ?></span>
                <span>이메일 <a href="mailto:<?php echo $tf_site['email']; ?>"><?php echo $tf_site['email']; ?></a></span>
            </address>
            <p class="tf-footer__copy">&copy; <?php echo date('Y'); ?> <?php echo $tf_site['name_en']; ?>. All rights reserved.</p>
        </div>
    </div>
</footer>

<!-- 빠른 연락 (모바일 하단 고정 / PC 우측 하단) -->
<nav class="tf-quick" aria-label="빠른 연락">
    <a href="<?php echo tf_tel_href($tf_site['tel']); ?>" class="tf-quick__btn tf-quick__btn--tel">
        <svg aria-hidden="true" viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M6.6 10.8a15.1 15.1 0 0 0 6.6 6.6l2.2-2.2a1 1 0 0 1 1-.25 11.4 11.4 0 0 0 3.6.57 1 1 0 0 1 1 1V20a1 1 0 0 1-1 1A17 17 0 0 1 3 4a1 1 0 0 1 1-1h3.5a1 1 0 0 1 1 1c0 1.25.2 2.45.57 3.57a1 1 0 0 1-.25 1z"/></svg>
        <span>전화 상담</span>
    </a>
    <?php if ($tf_site['kakao']) { ?>
    <a href="<?php echo $tf_site['kakao']; ?>" class="tf-quick__btn tf-quick__btn--kakao" target="_blank" rel="noopener" title="새 창">
        <svg aria-hidden="true" viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M12 3C6.5 3 2 6.5 2 10.8c0 2.8 1.9 5.2 4.7 6.6l-1 3.6c-.1.3.3.6.6.4l4.2-2.8c.5.1 1 .1 1.5.1 5.5 0 10-3.5 10-7.9S17.5 3 12 3z"/></svg>
        <span>카톡 상담</span>
    </a>
    <?php } ?>
    <a href="<?php echo $tf_inquiry_url; ?>" class="tf-quick__btn tf-quick__btn--form">
        <svg aria-hidden="true" viewBox="0 0 24 24" width="20" height="20"><path fill="currentColor" d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2zm0 4.2V18h16V8.2l-8 5-8-5zM4.6 6 12 10.6 19.4 6H4.6z"/></svg>
        <span>견적 문의</span>
    </a>
    <button type="button" class="tf-quick__top" id="tfTop"><span class="sound_only">페이지 맨 위로</span><span aria-hidden="true">↑</span></button>
</nav>

<?php
if ($config['cf_analytics']) {
    echo $config['cf_analytics'];
}
?>

<?php
include_once(G5_THEME_PATH.'/tail.sub.php');
