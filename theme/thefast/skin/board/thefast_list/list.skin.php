<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.tf_asset_url(G5_THEME_CSS_URL.'/board.css').'">', 0);
?>

<div id="bo_list" class="tf-bd">

    <?php if ($is_category) { ?>
    <nav id="bo_cate" aria-label="<?php echo $board['bo_subject'] ?> 분류">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>

    <div class="tf-bd-top">
        <p class="tf-bd-total">전체 <b><?php echo number_format($total_count) ?></b>건 · <?php echo $page ?> 페이지</p>
        <form name="fsearch" method="get" class="tf-bd-sch" role="search">
            <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
            <input type="hidden" name="sca" value="<?php echo $sca ?>">
            <input type="hidden" name="sop" value="and">
            <label for="sfl" class="sound_only">검색대상</label>
            <select name="sfl" id="sfl">
                <?php echo get_board_sfl_select_options($sfl); ?>
            </select>
            <label for="stx" class="sound_only">검색어<strong class="sound_only"> 필수</strong></label>
            <input type="text" name="stx" value="<?php echo get_text(stripslashes($stx)); ?>" required id="stx" maxlength="20" placeholder="검색어 입력">
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

    <h2 class="sound_only"><?php echo $board['bo_subject'] ?> 목록</h2>
    <?php if ($is_checkbox) { ?>
    <p class="tf-check tf-chkall"><input type="checkbox" id="chkall" onclick="if (this.checked) all_checked(true); else all_checked(false);"><label for="chkall">현재 페이지 게시물 전체선택</label></p>
    <?php } ?>
    <ul class="tf-bd-list">
        <?php for ($i=0; $i<count($list); $i++) { ?>
        <li class="<?php echo $list[$i]['is_notice'] ? 'is-notice' : ''; ?><?php echo $is_checkbox ? ' has-chk' : ''; ?>">
            <?php if ($is_checkbox) { ?>
            <span><input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>"><label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?> 선택</label></span>
            <?php } ?>
            <span class="tf-bd-list__num">
                <?php
                if ($list[$i]['is_notice']) echo '<span class="tf-badge">공지</span>';
                else if ($wr_id == $list[$i]['wr_id']) echo '<span class="tf-badge">열람중</span>';
                else echo $list[$i]['num'];
                ?>
            </span>
            <div class="tf-bd-list__subject">
                <?php if ($is_category && $list[$i]['ca_name']) { ?><a href="<?php echo $list[$i]['ca_name_href'] ?>" class="tf-chip"><?php echo $list[$i]['ca_name'] ?></a><?php } ?>
                <?php if ($list[$i]['reply']) { ?><span class="tf-bd-reply" style="padding-left:<?php echo strlen($list[$i]['wr_reply']) * 8; ?>px" aria-hidden="true">└</span><span class="sound_only">답변글</span><?php } ?>
                <a href="<?php echo $list[$i]['href'] ?>">
                    <?php if (isset($list[$i]['icon_secret']) && $list[$i]['icon_secret']) { ?><svg class="tf-lock" viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M17 9V7A5 5 0 0 0 7 7v2a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-9a2 2 0 0 0-2-2zM9 7a3 3 0 0 1 6 0v2H9z"/></svg><span class="sound_only">비밀글</span><?php } ?>
                    <?php echo $list[$i]['subject'] ?>
                </a>
                <?php if ($list[$i]['icon_new']) { ?><span class="tf-badge tf-badge--new">N<span class="sound_only">새글</span></span><?php } ?>
                <?php if ($list[$i]['comment_cnt']) { ?><span class="tf-bd-cmt"><span class="sound_only">댓글</span>[<?php echo $list[$i]['wr_comment']; ?>]</span><?php } ?>
            </div>
            <span class="tf-bd-list__name"><span class="sound_only">작성자 </span><?php echo $list[$i]['name'] ?></span>
            <span class="tf-bd-list__date"><span class="sound_only">작성일 </span><?php echo $list[$i]['datetime2'] ?></span>
        </li>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<li class="tf-bd-empty">게시물이 없습니다.</li>'; } ?>
    </ul>

    <div class="tf-bd-btns tf-bd-btns--between">
        <div class="tf-bd-admin">
            <?php if ($admin_href) { ?><a href="<?php echo $admin_href ?>" class="tf-bd-btn">관리</a><?php } ?>
            <?php if ($is_checkbox) { ?>
            <button type="submit" name="btn_submit" value="선택삭제" onclick="document.pressed=this.value">선택삭제</button>
            <button type="submit" name="btn_submit" value="선택복사" onclick="document.pressed=this.value">선택복사</button>
            <button type="submit" name="btn_submit" value="선택이동" onclick="document.pressed=this.value">선택이동</button>
            <?php } ?>
        </div>
        <?php if ($write_href) { ?><a href="<?php echo $write_href ?>" class="tf-bd-btn tf-bd-btn--dark">글쓰기</a><?php } ?>
    </div>
    <?php if ($is_checkbox) { ?></form><?php } ?>

    <?php echo $write_pages; ?>
</div>

<?php if ($is_checkbox) { ?>
<noscript>
<p>자바스크립트를 사용하지 않는 경우<br>별도의 확인 절차 없이 바로 선택삭제 처리하므로 주의하시기 바랍니다.</p>
</noscript>
<script>
function all_checked(sw) {
    var f = document.fboardlist;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]")
            f.elements[i].checked = sw;
    }
}

function fboardlist_submit(f) {
    var chk_count = 0;
    for (var i=0; i<f.length; i++) {
        if (f.elements[i].name == "chk_wr_id[]" && f.elements[i].checked)
            chk_count++;
    }
    if (!chk_count) {
        alert(document.pressed + "할 게시물을 하나 이상 선택하세요.");
        return false;
    }
    if(document.pressed == "선택복사") {
        select_copy("copy");
        return;
    }
    if(document.pressed == "선택이동") {
        select_copy("move");
        return;
    }
    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다\n\n답변글이 있는 게시글을 선택하신 경우\n답변글도 선택하셔야 게시글이 삭제됩니다."))
            return false;
        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }
    return true;
}

function select_copy(sw) {
    var f = document.fboardlist;
    var sub_win = window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");
    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}
</script>
<?php } ?>
