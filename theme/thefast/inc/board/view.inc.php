<?php
/**
 * 게시글 보기 공통 템플릿 (thefast_list / thefast_gallery / thefast_form 스킨이 함께 사용)
 * 스킨의 view.skin.php 에서 include 합니다. 그누보드 basic 스킨의 기능을 그대로 유지합니다.
 */
if (!defined('_GNUBOARD_')) exit;
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

global $tf_board_fields;
$tf_fields = isset($tf_board_fields[$bo_table]) ? $tf_board_fields[$bo_table] : array();

add_stylesheet('<link rel="stylesheet" href="'.tf_asset_url(G5_THEME_CSS_URL.'/board.css').'">', 0);
?>
<script src="<?php echo G5_JS_URL; ?>/viewimageresize.js"></script>

<article id="bo_v" class="tf-view">
    <header class="tf-view__head">
        <?php if ($category_name) { ?><div class="tf-view__cate"><span class="tf-chip"><?php echo $view['ca_name']; ?></span></div><?php } ?>
        <h2 class="tf-view__title" id="bo_v_title"><?php echo cut_str(get_text($view['wr_subject']), 120); ?></h2>
        <div class="tf-view__info">
            <span><span class="sound_only">작성자 </span><?php echo $view['name']; ?><?php if ($is_ip_view) { echo '&nbsp;('.$ip.')'; } ?></span>
            <span><span class="sound_only">작성일 </span><time datetime="<?php echo date('Y-m-d\TH:i', strtotime($view['wr_datetime'])); ?>"><?php echo date('Y.m.d', strtotime($view['wr_datetime'])); ?></time></span>
            <span>조회 <?php echo number_format($view['wr_hit']); ?></span>
        </div>

        <?php
        // 확장필드 정보 (평수, 지역 등)
        $tf_meta_rows = array();
        foreach ($tf_fields as $fk => $fd) {
            if (isset($view[$fk]) && trim($view[$fk]) !== '') $tf_meta_rows[] = array($fd['label'], get_text($view[$fk]));
        }
        if ($tf_meta_rows) { ?>
        <dl class="tf-view__meta">
            <?php foreach ($tf_meta_rows as $mr) { ?><div><dt><?php echo $mr[0]; ?></dt><dd><?php echo $mr[1]; ?></dd></div><?php } ?>
        </dl>
        <?php } ?>
    </header>

    <section id="bo_v_atc" class="tf-view__body">
        <h2 class="sound_only">본문</h2>
        <?php
        // 첨부 이미지
        $v_img_count = count($view['file']);
        if ($v_img_count) {
            echo "<div id=\"bo_v_img\">\n";
            $tf_img_no = 0;
            foreach ($view['file'] as $view_file) {
                $tf_html = get_file_thumbnail($view_file);
                if ($tf_html && strpos($tf_html, 'alt=""') !== false) {
                    $tf_img_no++;
                    $tf_html = str_replace('alt=""', 'alt="'.get_text(strip_tags($view['wr_subject'])).' 사진 '.$tf_img_no.'"', $tf_html);
                }
                echo $tf_html;
            }
            echo "</div>\n";
        }
        ?>
        <div id="bo_v_con"><?php echo get_view_thumbnail($view['content']); ?></div>
        <?php if ($is_signature) { ?><p><?php echo $signature; ?></p><?php } ?>

        <?php if ($good_href || $nogood_href) { ?>
        <div id="bo_v_act">
            <?php if ($good_href) { ?><a href="<?php echo $good_href.'&amp;'.$qstr; ?>" id="good_button">추천 <strong><?php echo number_format($view['wr_good']); ?></strong></a><b id="bo_v_act_good"></b><?php } ?>
            <?php if ($nogood_href) { ?><a href="<?php echo $nogood_href.'&amp;'.$qstr; ?>" id="nogood_button">비추천 <strong><?php echo number_format($view['wr_nogood']); ?></strong></a><b id="bo_v_act_nogood"></b><?php } ?>
        </div>
        <?php } ?>
    </section>

    <?php
    $cnt = 0;
    if ($view['file']['count']) {
        for ($i = 0; $i < count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) $cnt++;
        }
    }
    if ($cnt) { ?>
    <section class="tf-view__files" id="bo_v_file">
        <h3>첨부파일</h3>
        <ul>
        <?php for ($i = 0; $i < count($view['file']); $i++) {
            if (isset($view['file'][$i]['source']) && $view['file'][$i]['source'] && !$view['file'][$i]['view']) { ?>
            <li><a href="<?php echo $view['file'][$i]['href']; ?>" class="view_file_download"><?php echo $view['file'][$i]['source']; ?></a> <small><?php echo $view['file'][$i]['content']; ?> (<?php echo $view['file'][$i]['size']; ?>)</small></li>
        <?php } } ?>
        </ul>
    </section>
    <?php } ?>

    <?php if (isset($view['link']) && array_filter($view['link'])) { ?>
    <section class="tf-view__links" id="bo_v_link">
        <h3>관련링크</h3>
        <ul>
        <?php for ($i = 1; $i <= count($view['link']); $i++) { if ($view['link'][$i]) { ?>
            <li><a href="<?php echo $view['link_href'][$i]; ?>" target="_blank" rel="noopener" title="새 창"><?php echo cut_str($view['link'][$i], 70); ?></a></li>
        <?php } } ?>
        </ul>
    </section>
    <?php } ?>

    <?php if ($prev_href || $next_href) { ?>
    <ul class="tf-view__nav">
        <?php if ($prev_href) { ?><li><span>이전글</span><a href="<?php echo $prev_href; ?>"><?php echo $prev_wr_subject; ?></a><time><?php echo str_replace('-', '.', substr($prev_wr_date, 0, 10)); ?></time></li><?php } ?>
        <?php if ($next_href) { ?><li><span>다음글</span><a href="<?php echo $next_href; ?>"><?php echo $next_wr_subject; ?></a><time><?php echo str_replace('-', '.', substr($next_wr_date, 0, 10)); ?></time></li><?php } ?>
    </ul>
    <?php } ?>

    <div class="tf-bd-btns tf-bd-btns--between">
        <a href="<?php echo $list_href; ?>" class="tf-bd-btn">목록</a>
        <div class="tf-bd-btns tf-bd-btns--inline">
            <?php if ($reply_href) { ?><a href="<?php echo $reply_href; ?>" class="tf-bd-btn">답변</a><?php } ?>
            <?php if ($update_href) { ?><a href="<?php echo $update_href; ?>" class="tf-bd-btn">수정</a><?php } ?>
            <?php if ($delete_href) { ?><a href="<?php echo $delete_href; ?>" class="tf-bd-btn" onclick="del(this.href); return false;">삭제</a><?php } ?>
            <?php if ($copy_href || $move_href || $search_href) { ?>
            <div class="tf-more">
                <button type="button" class="tf-bd-btn" aria-expanded="false" aria-controls="tfMoreMenu">더보기</button>
                <div class="tf-more__menu" id="tfMoreMenu" hidden>
                    <?php if ($copy_href) { ?><a href="<?php echo $copy_href; ?>" onclick="board_move(this.href); return false;">복사</a><?php } ?>
                    <?php if ($move_href) { ?><a href="<?php echo $move_href; ?>" onclick="board_move(this.href); return false;">이동</a><?php } ?>
                    <?php if ($search_href) { ?><a href="<?php echo $search_href; ?>">검색</a><?php } ?>
                </div>
            </div>
            <?php } ?>
            <?php if ($write_href) { ?><a href="<?php echo $write_href; ?>" class="tf-bd-btn tf-bd-btn--dark"><?php echo isset($tf_write_label) ? $tf_write_label : '글쓰기'; ?></a><?php } ?>
        </div>
    </div>

    <?php
    // 코멘트 입출력
    include_once(G5_BBS_PATH.'/view_comment.php');
    ?>
</article>

<script>
<?php if ($board['bo_download_point'] < 0) { ?>
$(function() {
    $("a.view_file_download").click(function() {
        if(!g5_is_member) {
            alert("다운로드 권한이 없습니다.\n회원이시라면 로그인 후 이용해 보십시오.");
            return false;
        }
        var msg = "파일을 다운로드 하시면 포인트가 차감(<?php echo number_format($board['bo_download_point']) ?>점)됩니다.\n\n포인트는 게시물당 한번만 차감되며 다음에 다시 다운로드 하셔도 중복하여 차감하지 않습니다.\n\n그래도 다운로드 하시겠습니까?";
        if(confirm(msg)) {
            var href = $(this).attr("href")+"&js=on";
            $(this).attr("href", href);
            return true;
        } else {
            return false;
        }
    });
});
<?php } ?>

function board_move(href)
{
    window.open(href, "boardmove", "left=50, top=50, width=500, height=550, scrollbars=1");
}

$(function() {
    $("a.view_image").click(function() {
        window.open(this.href, "large_image", "location=yes,links=no,toolbar=no,top=10,left=10,width=10,height=10,resizable=yes,scrollbars=no,status=no");
        return false;
    });

    // 추천, 비추천
    $("#good_button, #nogood_button").click(function() {
        var $tx = (this.id == "good_button") ? $("#bo_v_act_good") : $("#bo_v_act_nogood");
        excute_good(this.href, $(this), $tx);
        return false;
    });

    // 더보기 메뉴
    $(".tf-more > button").on("click", function(e) {
        e.stopPropagation();
        var $m = $(this).next(), open = $m.prop("hidden");
        $m.prop("hidden", !open);
        $(this).attr("aria-expanded", open ? "true" : "false");
    });
    $(document).on("click", function() { $(".tf-more__menu").prop("hidden", true); $(".tf-more > button").attr("aria-expanded", "false"); });

    // 이미지 리사이즈
    $("#bo_v_atc").viewimageresize();
});

function excute_good(href, $el, $tx)
{
    $.post(href, { js: "on" }, function(data) {
        if(data.error) { alert(data.error); return false; }
        if(data.count) {
            $el.find("strong").text(number_format(String(data.count)));
            alert($tx.attr("id").search("nogood") > -1 ? "이 글을 비추천하셨습니다." : "이 글을 추천하셨습니다.");
        }
    }, "json");
}
</script>
