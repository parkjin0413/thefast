<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.get_versioned_asset_url(G5_THEME_CSS_URL.'/board.css').'">', 0);

global $tf_site, $tf_boards;
$tf_is_partner = ($bo_table === $tf_boards['partner']);

// 이름 가운데 글자 가리기 (홍길동 → 홍*동)
if (!function_exists('tf_mask_name')) {
    function tf_mask_name($name)
    {
        $name = trim(strip_tags($name));
        $len = mb_strlen($name, 'UTF-8');
        if ($len <= 1) return $name;
        if ($len == 2) return mb_substr($name, 0, 1, 'UTF-8').'*';
        return mb_substr($name, 0, 1, 'UTF-8').str_repeat('*', $len - 2).mb_substr($name, -1, 1, 'UTF-8');
    }
}
?>

<div id="bo_list" class="tf-bd">

    <div class="tf-inq-hero">
        <div class="tf-inq-hero__main">
            <?php if ($tf_is_partner) { ?>
            <h2>더패스트와 함께 성장할 파트너를 찾습니다.</h2>
            <p>자재 공급, 시공 협력, 유통 등 다양한 제휴 제안을 기다립니다. 남겨주신 내용은 담당자가 검토 후 연락드립니다.</p>
            <?php } else { ?>
            <h2>무료 견적 상담을 신청하세요.</h2>
            <p>상담 문의를 남겨주시면 3일 이내에 담당자가 배정되어 시공 가능 여부와 대략적인 견적을 안내해 드립니다. 모든 문의는 비밀글로 안전하게 보관됩니다.</p>
            <?php } ?>
            <?php if ($write_href) { ?><a href="<?php echo $write_href; ?>" class="tf-btn tf-btn--primary tf-btn--lg"><?php echo $tf_is_partner ? '제휴 문의하기' : '상담 신청하기'; ?> <span aria-hidden="true">→</span></a><?php } ?>
        </div>
        <div class="tf-inq-hero__side">
            <a href="<?php echo tf_tel_href($tf_site['tel']); ?>">
                <small>CALL</small>
                <strong><?php echo $tf_site['tel_label']; ?></strong>
                <span>전화로 바로 상담받기</span>
            </a>
            <div>
                <small>OPEN</small>
                <strong><?php echo $tf_site['hours']; ?></strong>
                <span><?php echo $tf_site['hours_note']; ?></span>
            </div>
        </div>
    </div>

    <div class="tf-bd-top">
        <h2 class="tf-mini__title"><?php echo $tf_is_partner ? '제휴 문의' : '상담 신청'; ?> 현황 <span class="tf-bd-total">(<?php echo number_format($total_count) ?>건)</span></h2>
        <form name="fsearch" method="get" class="tf-bd-sch" role="search">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sop" value="and">
            <input type="hidden" name="sfl" value="wr_name,1">
            <label for="stx" class="sound_only">작성자 이름 검색</label>
            <input type="text" name="stx" value="<?php echo get_text(stripslashes($stx)); ?>" required id="stx" maxlength="20" placeholder="작성자 이름으로 찾기">
            <button type="submit">검색</button>
        </form>
    </div>

    <?php if ($is_checkbox) { ?>

    <form name="fboardlist" id="fboardlist" action="<?php echo G5_BBS_URL; ?>/board_list_update.php" onsubmit="return fboardlist_submit(this);" method="post">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <input type="hidden" name="sw" value="">
    <?php } ?>

    <ul class="tf-bd-list">
        <?php for ($i=0; $i<count($list); $i++) {
            $tf_done = $list[$i]['wr_comment'] > 0 || $list[$i]['reply'];
        ?>
        <li class="<?php echo $list[$i]['is_notice'] ? 'is-notice' : ''; ?><?php echo $is_checkbox ? ' has-chk' : ''; ?>">
            <?php if ($is_checkbox) { ?>
            <span><input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>"><label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?> 선택</label></span>
            <?php } ?>
            <span class="tf-bd-list__num">
                <?php if ($list[$i]['is_notice']) { ?><span class="tf-badge">공지</span>
                <?php } else if ($tf_done) { ?><span class="tf-badge">답변완료</span>
                <?php } else { ?><span class="tf-chip">접수</span><?php } ?>
            </span>
            <div class="tf-bd-list__subject">
                <?php if ($list[$i]['reply']) { ?><span class="tf-bd-reply" aria-hidden="true">└</span><span class="sound_only">답변글</span><?php } ?>
                <a href="<?php echo $list[$i]['href'] ?>">
                    <?php if (isset($list[$i]['icon_secret']) && $list[$i]['icon_secret']) { ?><svg class="tf-lock" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M17 9V7A5 5 0 0 0 7 7v2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-9a2 2 0 0 0-2-2zM9 7a3 3 0 0 1 6 0v2H9z"/></svg><span class="sound_only">비밀글</span><?php } ?>
                    <?php echo $list[$i]['subject'] ?>
                </a>
                <?php if ($list[$i]['icon_new']) { ?><span class="tf-badge tf-badge--new">N<span class="sound_only">새글</span></span><?php } ?>
            </div>
            <span class="tf-bd-list__name"><span class="sound_only">작성자 </span><?php echo $is_admin ? get_text($list[$i]['wr_name']) : get_text(tf_mask_name($list[$i]['wr_name'])); ?></span>
            <span class="tf-bd-list__date"><span class="sound_only">작성일 </span><?php echo $list[$i]['datetime2'] ?></span>
        </li>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<li class="tf-bd-empty">접수된 문의가 없습니다.</li>'; } ?>
    </ul>

    <div class="tf-bd-btns tf-bd-btns--between">
        <div class="tf-bd-admin">
            <?php if ($admin_href) { ?><a href="<?php echo $admin_href ?>" class="tf-bd-btn">관리</a><?php } ?>
            <?php if ($is_checkbox) { ?>
            <button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value">선택삭제</button>
            <?php } ?>
        </div>
        <?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="tf-bd-btn tf-bd-btn--primary"><?php echo $tf_is_partner ? '제휴 문의하기' : '상담 신청하기'; ?></a><?php } ?>
    </div>
    <?php if ($is_checkbox) { ?></form><?php } ?>

    <?php echo $write_pages; ?>
</div>

<?php if ($is_checkbox) { ?>
<script>
function fboardlist_submit(f) {
    var chk_count = 0;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked) chk_count++;
    }
    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
    if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다"))
        return false;
    f.removeAttribute("target");
    f.action = g5_bbs_url+"/board_list_update.php";
    return true;
}
</script>
<?php } ?>
