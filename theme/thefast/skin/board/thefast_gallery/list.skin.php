<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');
add_stylesheet('<link rel="stylesheet" href="'.get_versioned_asset_url(G5_THEME_CSS_URL.'/board.css').'">', 0);

global $tf_board_fields;
$tf_fields = isset($tf_board_fields[$bo_table]) ? $tf_board_fields[$bo_table] : array();
$tf_tw = $board['bo_gallery_width'] ? (int) $board['bo_gallery_width'] : 640;
$tf_th = $board['bo_gallery_height'] ? (int) $board['bo_gallery_height'] : 480;
?>

<div id="bo_gall" class="tf-bd">

    <?php if ($is_category) { ?>
    <nav id="bo_cate" aria-label="<?php echo $board['bo_subject'] ?> 분류">
        <h2><?php echo $board['bo_subject'] ?> 카테고리</h2>
        <ul id="bo_cate_ul">
            <?php echo $category_option ?>
        </ul>
    </nav>
    <?php } ?>

    <div class="tf-bd-top">
        <p class="tf-bd-total">전체 <b><?php echo number_format($total_count) ?></b>건</p>
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

    <ul class="tf-gal">
        <?php for ($i=0; $i<count($list); $i++) {
            $thumb = strpos($list[$i]['wr_option'], 'secret') === false
                ? get_list_thumbnail($board['bo_table'], $list[$i]['wr_id'], $tf_tw, $tf_th, false, true)
                : array('src' => '', 'alt' => '');
        ?>
        <li class="tf-gal__item">
            <?php if ($is_checkbox) { ?>
            <span class="tf-gal__chk"><input type="checkbox" name="chk_wr_id[]" value="<?php echo $list[$i]['wr_id'] ?>" id="chk_wr_id_<?php echo $i ?>"><label for="chk_wr_id_<?php echo $i ?>" class="sound_only"><?php echo $list[$i]['subject'] ?> 선택</label></span>
            <?php } ?>
            <a href="<?php echo $list[$i]['href'] ?>" class="tf-card">
                <div class="tf-card__img">
                    <?php if ($thumb['src']) {
                        $img_content = '<img src="'.$thumb['src'].'" alt="'.($thumb['alt'] ? $thumb['alt'] : get_text(strip_tags($list[$i]['subject']))).'" width="'.$tf_tw.'" height="'.$tf_th.'" loading="lazy">';
                        echo run_replace('thumb_image_tag', $img_content, $thumb);
                    } else { ?>
                    <span class="tf-card__noimg">이미지 준비중</span>
                    <?php } ?>
                </div>
                <div class="tf-card__body">
                    <div class="tf-card__meta">
                        <?php if ($list[$i]['is_notice']) { ?><span class="tf-badge">공지</span><?php } ?>
                        <?php if ($is_category && $list[$i]['ca_name']) { ?><span class="tf-chip"><?php echo $list[$i]['ca_name'] ?></span><?php } ?>
                        <?php foreach ($tf_fields as $fk => $fd) { if (!empty($fd['list']) && !empty($list[$i][$fk])) { ?><span><span class="sound_only"><?php echo $fd['label']; ?> </span><?php echo get_text($list[$i][$fk]); ?></span><?php } } ?>
                    </div>
                    <h3 class="tf-card__title">
                        <?php if (isset($list[$i]['icon_secret']) && $list[$i]['icon_secret']) { ?><span class="sound_only">비밀글 </span><?php } ?>
                        <?php echo $list[$i]['subject'] ?>
                        <?php if ($list[$i]['icon_new']) { ?><span class="tf-badge tf-badge--new">N<span class="sound_only">새글</span></span><?php } ?>
                    </h3>
                    <?php if (strpos($list[$i]['wr_option'], 'secret') === false) { // 비밀글은 본문 미리보기 숨김 ?>
                    <p class="tf-card__desc"><?php echo get_text(utf8_strcut(strip_tags($list[$i]['wr_content']), 80, '…')); ?></p>
                    <?php } ?>
                </div>
            </a>
        </li>
        <?php } ?>
        <?php if (count($list) == 0) { echo '<li class="tf-bd-empty">등록된 게시물이 없습니다.</li>'; } ?>
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
    if(document.pressed == "선택복사") { select_copy("copy"); return; }
    if(document.pressed == "선택이동") { select_copy("move"); return; }
    if(document.pressed == "선택삭제") {
        if (!confirm("선택한 게시물을 정말 삭제하시겠습니까?\n\n한번 삭제한 자료는 복구할 수 없습니다"))
            return false;
        f.removeAttribute("target");
        f.action = g5_bbs_url+"/board_list_update.php";
    }
    return true;
}

function select_copy(sw) {
    var f = document.fboardlist;
    window.open("", "move", "left=50, top=50, width=500, height=550, scrollbars=1");
    f.sw.value = sw;
    f.target = "move";
    f.action = g5_bbs_url+"/move.php";
    f.submit();
}
</script>
<?php } ?>
