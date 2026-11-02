<?php
/**
 * 상담문의 / 제휴문의 신청서
 * - 확장필드는 site.config.php 의 $tf_board_fields 표를 따릅니다.
 * - 그누보드 저장 처리에 필요한 hidden 필드, 캡차, 토큰(자동) 은 그대로 유지합니다.
 * - 관리자 > 게시판 설정에서 "비밀글 사용: 무조건", "DHTML 에디터 사용: 미사용" 으로 두세요.
 */
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
add_stylesheet('<link rel="stylesheet" href="'.tf_asset_url(G5_THEME_CSS_URL.'/board.css').'">', 0);

global $tf_board_fields, $tf_boards, $tf_site;
$tf_is_partner = ($bo_table === $tf_boards['partner']);
$tf_fields = isset($tf_board_fields[$bo_table]) ? $tf_board_fields[$bo_table] : array();
$tf_write = (isset($write) && is_array($write)) ? $write : array();
$tf_val = function ($k) use ($w, $tf_write) {
    return ($w == 'u' && isset($tf_write[$k])) ? get_text($tf_write[$k]) : '';
};
$tf_subject_default = $tf_is_partner ? '제휴 문의드립니다' : '상담 신청합니다';

// 스팸 방지: 신청서를 연 시각 기록 (너무 빨리 제출되면 자동 프로그램으로 판단)
set_session('ss_tf_form_'.$bo_table, time());
?>

<section id="bo_w" class="tf-form">
    <h2 class="sound_only"><?php echo $g5['title'] ?></h2>

    <div class="tf-form__intro">
        <?php if ($tf_is_partner) { ?>
        <h2>제휴 문의</h2>
        <p>제안 내용을 남겨주시면 담당자가 검토 후 연락드립니다.</p>
        <?php } else { ?>
        <h2>무료 견적 상담 신청</h2>
        <p>아래 내용을 남겨주시면 3일 이내에 담당자가 연락드립니다.</p>
        <ul>
            <li>현장 사진이나 도면을 첨부해 주시면 더 정확한 견적을 받으실 수 있습니다.</li>
            <li>급한 문의는 <a href="<?php echo tf_tel_href($tf_site['tel']); ?>"><strong><?php echo $tf_site['tel_label']; ?></strong></a>로 전화 주세요. (<?php echo $tf_site['hours']; ?>)</li>
        </ul>
        <?php } ?>
        <p class="tf-help"><span class="tf-req" aria-hidden="true">*</span> 표시는 필수 입력 항목입니다.</p>
    </div>

    <form name="fwrite" id="fwrite" action="<?php echo $action_url ?>" onsubmit="return fwrite_submit(this);" method="post" enctype="multipart/form-data" autocomplete="on" novalidate>
    <input type="hidden" name="uid" value="<?php echo get_uniqid(); ?>">
    <!-- 스팸 방지용 숨김 칸: 사람에게는 보이지 않으며, 값이 채워지면 자동 프로그램으로 판단 -->
    <div class="tf-hp" aria-hidden="true"><label for="tf_homepage">홈페이지</label><input type="text" name="tf_homepage" id="tf_homepage" value="" tabindex="-1" autocomplete="off"></div>
    <input type="hidden" name="w" value="<?php echo $w ?>">
    <input type="hidden" name="bo_table" value="<?php echo $bo_table ?>">
    <input type="hidden" name="wr_id" value="<?php echo $wr_id ?>">
    <input type="hidden" name="sca" value="<?php echo $sca ?>">
    <input type="hidden" name="sfl" value="<?php echo $sfl ?>">
    <input type="hidden" name="stx" value="<?php echo $stx ?>">
    <input type="hidden" name="spt" value="<?php echo $spt ?>">
    <input type="hidden" name="sst" value="<?php echo $sst ?>">
    <input type="hidden" name="sod" value="<?php echo $sod ?>">
    <input type="hidden" name="page" value="<?php echo $page ?>">
    <?php if ($is_secret) { ?><input type="hidden" name="secret" value="secret"><?php } ?>
    <input type="hidden" name="wr_subject" id="wr_subject" value="<?php echo $subject ? $subject : $tf_subject_default; ?>">
    <?php if ($is_category) { ?>
    <!-- 분류를 사용하는 경우 -->
    <?php } ?>

    <fieldset class="tf-fieldset">
        <legend>신청자 정보</legend>
        <div class="tf-grid">
            <?php if ($is_name) { ?>
            <div class="tf-field">
                <label for="wr_name"><?php echo $tf_is_partner ? '담당자명' : '이름'; ?><span class="tf-req" aria-hidden="true">*</span><span class="sound_only"> 필수</span></label>
                <input type="text" name="wr_name" value="<?php echo $name ?>" id="wr_name" required class="frm_input required" autocomplete="name" maxlength="20">
            </div>
            <?php } ?>

            <?php foreach ($tf_fields as $fk => $fd) { if ($fd['type'] !== 'tel' && !($tf_is_partner && $fk === 'wr_2')) continue; ?>
            <div class="tf-field">
                <label for="<?php echo $fk; ?>"><?php echo $fd['label']; ?><?php if (!empty($fd['req'])) { ?><span class="tf-req" aria-hidden="true">*</span><span class="sound_only"> 필수</span><?php } ?></label>
                <input type="<?php echo $fd['type'] === 'tel' ? 'tel' : 'text'; ?>" name="<?php echo $fk; ?>" id="<?php echo $fk; ?>" value="<?php echo $tf_val($fk); ?>" class="frm_input<?php echo !empty($fd['req']) ? ' required' : ''; ?>"<?php echo !empty($fd['req']) ? ' required' : ''; ?> placeholder="<?php echo $fd['ph'] ?? ''; ?>" maxlength="50"<?php echo $fd['type'] === 'tel' ? ' autocomplete="tel" inputmode="tel"' : ' autocomplete="organization"'; ?>>
            </div>
            <?php } ?>

            <?php if ($is_email) { ?>
            <div class="tf-field">
                <label for="wr_email">이메일</label>
                <input type="email" name="wr_email" value="<?php echo $email ?>" id="wr_email" class="frm_input email" autocomplete="email">
            </div>
            <?php } ?>

            <?php if ($is_password) { ?>
            <div class="tf-field">
                <label for="wr_password">비밀번호<?php if ($password_required) { ?><span class="tf-req" aria-hidden="true">*</span><span class="sound_only"> 필수</span><?php } ?></label>
                <input type="password" name="wr_password" id="wr_password" <?php echo $password_required ?> class="frm_input <?php echo $password_required ?>" autocomplete="new-password" aria-describedby="tfPwHelp">
                <p class="tf-help" id="tfPwHelp">작성하신 글을 확인하거나 수정할 때 필요합니다.</p>
            </div>
            <?php } ?>
        </div>
    </fieldset>

    <fieldset class="tf-fieldset">
        <legend><?php echo $tf_is_partner ? '제휴 내용' : '공사 정보'; ?></legend>
        <div class="tf-grid">
            <?php foreach ($tf_fields as $fk => $fd) {
                if ($fd['type'] === 'tel' || ($tf_is_partner && $fk === 'wr_2')) continue;
                $fv  = $tf_val($fk);
                $req = !empty($fd['req']);
            ?>
            <?php if ($fd['type'] === 'radio') { ?>
            <div class="tf-field tf-field--full">
                <fieldset class="tf-radio-group" role="radiogroup"<?php echo $req ? ' aria-required="true"' : ''; ?>>
                    <legend><?php echo $fd['label']; ?><?php if ($req) { ?><span class="tf-req" aria-hidden="true">*</span><span class="sound_only"> 필수</span><?php } ?></legend>
                    <div class="tf-radios">
                    <?php foreach ($fd['options'] as $oi => $opt) { ?>
                        <label><input type="radio" name="<?php echo $fk; ?>" value="<?php echo $opt; ?>"<?php echo $fv === $opt ? ' checked' : ''; ?><?php echo $req && $oi === 0 ? ' required' : ''; ?>><span><?php echo $opt; ?></span></label>
                    <?php } ?>
                    </div>
                </fieldset>
            </div>
            <?php } else if ($fd['type'] === 'select') { ?>
            <div class="tf-field">
                <label for="<?php echo $fk; ?>"><?php echo $fd['label']; ?><?php if ($req) { ?><span class="tf-req" aria-hidden="true">*</span><?php } ?></label>
                <select name="<?php echo $fk; ?>" id="<?php echo $fk; ?>" class="tf-select"<?php echo $req ? ' required' : ''; ?>>
                    <option value="">선택해 주세요</option>
                    <?php foreach ($fd['options'] as $opt) { ?><option value="<?php echo $opt; ?>"<?php echo $fv === $opt ? ' selected' : ''; ?>><?php echo $opt; ?></option><?php } ?>
                </select>
            </div>
            <?php } else { ?>
            <div class="tf-field">
                <label for="<?php echo $fk; ?>"><?php echo $fd['label']; ?><?php if ($req) { ?><span class="tf-req" aria-hidden="true">*</span><?php } ?></label>
                <input type="text" name="<?php echo $fk; ?>" id="<?php echo $fk; ?>" value="<?php echo $fv; ?>" class="frm_input" maxlength="100" placeholder="<?php echo $fd['ph'] ?? ''; ?>"<?php echo $req ? ' required' : ''; ?>>
            </div>
            <?php } ?>
            <?php } ?>

            <div class="tf-field tf-field--full">
                <label for="wr_content"><?php echo $tf_is_partner ? '제안 내용' : '상담 내용'; ?><span class="tf-req" aria-hidden="true">*</span><span class="sound_only"> 필수</span></label>
                <textarea name="wr_content" id="wr_content" class="tf-textarea required" required maxlength="5000" placeholder="<?php echo $tf_is_partner ? '회사 소개와 제안하실 내용을 적어주세요.' : '시공을 원하시는 공간과 내용, 현재 상태, 요청사항 등을 자유롭게 적어주세요.'; ?>"><?php echo $content; ?></textarea>
            </div>
        </div>
    </fieldset>

    <?php if ($is_file && $file_count) { ?>
    <fieldset class="tf-fieldset tf-files">
        <legend>사진 · 도면 첨부 <small class="tf-help">(선택 · 파일당 <?php echo tf_filesize($board['bo_upload_size']); ?> 이하)</small></legend>
        <?php for ($i=0; $i<$file_count; $i++) { ?>
        <div class="tf-field">
            <label for="bf_file_<?php echo $i+1 ?>" class="sound_only">첨부파일 <?php echo $i+1 ?></label>
            <input type="file" name="bf_file[]" id="bf_file_<?php echo $i+1 ?>" accept="image/*,.pdf,.dwg,.hwp,.doc,.docx,.xls,.xlsx" class="frm_file">
            <?php if($w == 'u' && $file[$i]['file']) { ?>
            <span class="file_del"><input type="checkbox" id="bf_file_del<?php echo $i ?>" name="bf_file_del[<?php echo $i; ?>]" value="1"> <label for="bf_file_del<?php echo $i ?>"><?php echo $file[$i]['source'].'('.$file[$i]['size'].')'; ?> 파일 삭제</label></span>
            <?php } ?>
        </div>
        <?php } ?>
    </fieldset>
    <?php } ?>

    <?php if ($w == '') { ?>
    <fieldset class="tf-fieldset">
        <legend>개인정보 수집 및 이용 동의</legend>
        <div class="tf-agree">
            <dl class="tf-agree__box" tabindex="0" aria-label="개인정보 수집 및 이용 안내">
                <dt>수집 항목</dt><dd>이름(담당자명), 연락처, 이메일(선택), 시공 지역 등 문의 시 입력한 정보</dd>
                <dt>수집 목적</dt><dd><?php echo $tf_is_partner ? '제휴 제안 검토 및 회신' : '시공 상담, 견적 안내 및 현장 방문 일정 조율'; ?></dd>
                <dt>보유 기간</dt><dd>상담 완료 후 1년 (관계 법령에 따라 보존할 필요가 있는 경우 해당 기간)</dd>
                <dd>동의를 거부할 수 있으며, 거부 시 상담 신청이 제한됩니다. 자세한 내용은 <a href="<?php echo get_pretty_url('content', 'privacy'); ?>" target="_blank" title="새 창">개인정보처리방침</a>을 확인해 주세요.</dd>
            </dl>
            <label class="tf-check" for="tf_agree"><input type="checkbox" name="tf_agree" id="tf_agree" value="1" required> 개인정보 수집 및 이용에 동의합니다. <span class="tf-req" aria-hidden="true">*</span><span class="sound_only">(필수)</span></label>
        </div>
    </fieldset>
    <?php } else { ?>
    <input type="hidden" name="tf_agree" value="1">
    <?php } ?>

    <?php if ($is_use_captcha) { //자동등록방지 ?>
    <div class="tf-field">
        <?php echo $captcha_html ?>
    </div>
    <?php } ?>

    <div class="tf-form__submit">
        <a href="<?php echo get_pretty_url($bo_table); ?>" class="tf-bd-btn">취소</a>
        <button type="submit" id="btn_submit" accesskey="s" class="tf-bd-btn tf-bd-btn--primary"><?php echo $w == 'u' ? '수정하기' : ($tf_is_partner ? '제휴 문의 보내기' : '상담 신청하기'); ?></button>
    </div>
    </form>

    <script>
    function tf_fail(el, msg) {
        alert(msg);
        if (el && el.focus) el.focus();
        return false;
    }

    function fwrite_submit(f)
    {
        var trim = function (v) { return (v || '').replace(/(^\s*)|(\s*$)/g, ''); };

        if (f.wr_name && !trim(f.wr_name.value)) return tf_fail(f.wr_name, '이름을 입력해 주세요.');
        <?php foreach ($tf_fields as $fk => $fd) { if (empty($fd['req'])) continue; ?>
        <?php if ($fd['type'] === 'radio') { ?>
        if (!$(f).find('input[name=<?php echo $fk; ?>]:checked').length) return tf_fail(f.querySelector('input[name=<?php echo $fk; ?>]'), '<?php echo $fd['label']; ?>을(를) 선택해 주세요.');
        <?php } else { ?>
        if (!trim(f.<?php echo $fk; ?>.value)) return tf_fail(f.<?php echo $fk; ?>, '<?php echo $fd['label']; ?>을(를) 입력해 주세요.');
        <?php } ?>
        <?php } ?>
        if (f.wr_1 && f.wr_1.type === 'tel' && trim(f.wr_1.value) && !/^[0-9\-\s+]{9,16}$/.test(trim(f.wr_1.value))) return tf_fail(f.wr_1, '연락처를 정확히 입력해 주세요.');
        if (f.wr_password && f.wr_password.hasAttribute('required') && !f.wr_password.value) return tf_fail(f.wr_password, '비밀번호를 입력해 주세요.');
        if (!trim(f.wr_content.value)) return tf_fail(f.wr_content, '<?php echo $tf_is_partner ? '제안' : '상담'; ?> 내용을 입력해 주세요.');
        if (f.tf_agree && f.tf_agree.type === 'checkbox' && !f.tf_agree.checked) return tf_fail(f.tf_agree, '개인정보 수집 및 이용에 동의해 주세요.');

        // 제목 자동 생성 (이름 등 개인정보는 제목에 넣지 않습니다)
        <?php if ($tf_is_partner) { ?>
        var t = $(f).find('input[name=wr_3]:checked').val();
        f.wr_subject.value = (t ? '[' + t + '] ' : '') + '<?php echo $tf_subject_default; ?>';
        <?php } else { ?>
        var t = $(f).find('input[name=wr_2]:checked').val();
        f.wr_subject.value = (t ? '[' + t + '] ' : '') + '<?php echo $tf_subject_default; ?>';
        <?php } ?>

        var subject = "", content = "";
        $.ajax({
            url: g5_bbs_url+"/ajax.filter.php",
            type: "POST",
            data: { "subject": f.wr_subject.value, "content": f.wr_content.value },
            dataType: "json",
            async: false,
            cache: false,
            success: function(data) { subject = data.subject; content = data.content; }
        });
        if (content) return tf_fail(f.wr_content, "내용에 금지단어('"+content+"')가 포함되어있습니다");

        <?php echo $captcha_js; // 캡챠 사용시 자바스크립트에서 입력된 캡챠를 검사함 ?>

        document.getElementById("btn_submit").disabled = "disabled";
        return true;
    }
    </script>
</section>
