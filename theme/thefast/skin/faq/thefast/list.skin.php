<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.tf_asset_url(G5_THEME_CSS_URL.'/board.css').'">', 0);
?>

<?php
if ($himg_src)
    echo '<div id="faq_himg" class="faq_img"><img src="'.$himg_src.'" alt=""></div>';

// 상단 HTML
echo '<div id="faq_hhtml">'.conv_content($fm['fm_head_html'], 1).'</div>';
?>

<form name="faq_search_form" method="get" class="tf-faq-sch" role="search">
    <input type="hidden" name="fm_id" value="<?php echo $fm_id;?>">
    <label for="stx" class="sound_only">자주하는 질문 검색어<strong class="sound_only"> 필수</strong></label>
    <input type="text" name="stx" value="<?php echo get_text($stx); ?>" required id="stx" class="frm_input" maxlength="15" placeholder="궁금한 내용을 검색해 보세요">
    <button type="submit" class="tf-bd-btn tf-bd-btn--dark">검색</button>
</form>

<?php if (count($faq_master_list) > 1) { ?>
<nav id="bo_cate" aria-label="자주하는 질문 분류">
    <h2>자주하는 질문 분류</h2>
    <ul id="bo_cate_ul">
        <?php foreach ($faq_master_list as $v) {
            $on = ($v['fm_id'] == $fm_id);
        ?>
        <li><a href="<?php echo $category_href;?>?fm_id=<?php echo $v['fm_id'];?>"<?php echo $on ? ' id="bo_cate_on" aria-current="page"' : ''; ?>><?php echo $v['fm_subject'];?></a></li>
        <?php } ?>
    </ul>
</nav>
<?php } ?>

<div id="faq_wrap" class="faq_<?php echo $fm_id; ?>">
    <?php if (count($faq_list)) { ?>
    <section id="faq_con">
        <h2 class="sound_only"><?php echo $g5['title']; ?> 목록</h2>
        <ul class="tf-faq">
            <?php $n = 0; foreach ($faq_list as $key => $v) { if (empty($v)) continue; $n++; ?>
            <li class="tf-faq__item">
                <h3 class="tf-faq__q">
                    <button type="button" aria-expanded="false" aria-controls="tfFaqA<?php echo $n; ?>" id="tfFaqQ<?php echo $n; ?>">
                        <span class="tf-faq__mark" aria-hidden="true">Q</span>
                        <span><?php echo strip_tags(conv_content($v['fa_subject'], 1), '<b><strong><em>'); ?></span>
                    </button>
                </h3>
                <div class="tf-faq__a" id="tfFaqA<?php echo $n; ?>" role="region" aria-labelledby="tfFaqQ<?php echo $n; ?>" hidden>
                    <?php echo conv_content($v['fa_content'], 1); ?>
                </div>
            </li>
            <?php } ?>
        </ul>
    </section>
    <?php } else { ?>
    <div class="tf-empty">
        <?php if ($stx) { ?>
        <strong>검색 결과가 없습니다.</strong>다른 검색어로 다시 찾아보시거나 상담 문의를 남겨주세요.
        <?php } else { ?>
        <strong>등록된 질문이 없습니다.</strong>
        <?php if ($is_admin) { ?><a href="<?php echo G5_ADMIN_URL; ?>/faqmasterlist.php">관리자 &gt; FAQ관리</a>에서 질문을 등록하세요.<?php } ?>
        <?php } ?>
    </div>
    <?php } ?>
</div>

<?php echo get_paging($page_rows, $page, $total_page, $_SERVER['SCRIPT_NAME'].'?'.$qstr.'&amp;page='); ?>

<?php
// 하단 HTML
echo '<div id="faq_thtml">'.conv_content($fm['fm_tail_html'], 1).'</div>';

if ($timg_src)
    echo '<div id="faq_timg" class="faq_img"><img src="'.$timg_src.'" alt=""></div>';

if ($admin_href)
    echo '<div class="faq_admin"><a href="'.$admin_href.'" class="tf-bd-btn">FAQ 수정</a></div>';
?>

<script>
(function () {
    var btns = document.querySelectorAll('.tf-faq__q button');
    Array.prototype.forEach.call(btns, function (btn) {
        btn.addEventListener('click', function () {
            var open = btn.getAttribute('aria-expanded') === 'true';
            btn.setAttribute('aria-expanded', open ? 'false' : 'true');
            document.getElementById(btn.getAttribute('aria-controls')).hidden = open;
        });
    });
})();
</script>
