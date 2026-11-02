<?php
if (!defined('_GNUBOARD_')) include_once('./_common.php');

$g5['title']  = '시공 프로세스';
$tf_current   = 'process';
$tf_full      = true;
$tf_meta      = array('description' => '더패스트 인테리어 시공 프로세스 — 견적문의, 상담, 현장방문, 계약, 디자인·설계, 시공, 착공, 준공까지 8단계로 투명하게 진행합니다.');

include_once(G5_THEME_PATH.'/head.php');

$tf_steps = array(
    array('견적 문의',     '홈페이지 상담 문의를 통해 접수하시면 3일 이내에 담당자 배정 후 시공 여부와 대략적인 견적 금액을 안내해 드립니다.'),
    array('상담 안내',     '세부적인 공사 비용과 일정을 안내해 드리며, 현장 사진, 도면 또는 원하시는 사항 등을 상담해 드립니다.'),
    array('현장 방문',     '계약 전 실측 및 시공 공간과 구성(전기, 설비)을 확인한 후 공사 방향과 세부 견적을 도와드립니다.'),
    array('견적 & 계약',   '상담을 통해 이루어진 세부 견적을 바탕으로 대면 또는 비대면으로 가계약 후 담당 설계 디자이너가 배정됩니다.'),
    array('디자인 · 설계', '고객님의 니즈에 맞는 디자인 시안을 평면 또는 3D 모델링으로 협의하고, 마감재·가구·조명 등 추가 비용과 예산을 확인해 시공 일정을 조율합니다.'),
    array('시공',          '공사 담당자가 배정되면 설계 디자이너가 고객님과 사전 조율된 공사 내용을 이관하고 단계적인 시공을 진행합니다.'),
    array('착공',          '공사 기간 동안 현장 현황을 사진 또는 영상으로 안내해 드리며, 공사 규모와 공정률에 따라 중도금 지급을 요청드립니다.'),
    array('준공',          '공사 완료 후 입주 전에 세부 잔손 작업 및 베이크아웃을 진행하며, 사전 협의에 따라 가구·가전을 입고·배치할 수 있습니다.'),
);
?>

<section class="tf-section" aria-labelledby="tfProcIntro">
    <div class="tf-inner tf-process-intro">
        <img class="tf-reveal" src="<?php echo tf_img('sub/section_process.jpg'); ?>" alt="인테리어 설계 도면 위에 놓인 주택 모형과 설계 도구" width="1000" height="800" loading="lazy">
        <div>
            <p class="tf-eyebrow tf-reveal">Process</p>
            <h2 class="tf-h2 tf-reveal" id="tfProcIntro">인테리어 리모델링을<br>계획하고 계신가요?</h2>
            <p class="tf-lead tf-reveal">보다 빠르고 조용하게, 만족스러운 인테리어 공간을 만들어 드립니다.</p>
            <p class="tf-reveal">더패스트는 빠른 시공을 자랑하며, 큰 소음 없이 완벽하고 만족스러운 인테리어를 제공합니다. 공사 기간이 짧아 인건비 부담을 현저히 줄일 수 있으며, 층간 공사 소음이 최소화되어 이웃 간 불편함을 덜어 드립니다.</p>
        </div>
    </div>
</section>

<section class="tf-section tf-section--stone" aria-labelledby="tfProcSteps">
    <div class="tf-inner">
        <div class="tf-head tf-head--center">
            <p class="tf-eyebrow tf-reveal">8 Steps</p>
            <h2 class="tf-h2 tf-reveal" id="tfProcSteps">상담부터 준공까지 8단계</h2>
            <p class="tf-lead tf-reveal">모든 과정을 담당자가 함께하며 진행 상황을 투명하게 공유합니다.</p>
        </div>
        <ol class="tf-timeline">
            <?php foreach ($tf_steps as $i => $s) { ?>
            <li class="tf-reveal" data-delay="<?php echo $i % 4; ?>">
                <div class="tf-timeline__no"><b>STEP <?php printf('%02d', $i + 1); ?></b><span class="tf-timeline__big" data-no="<?php printf('%02d', $i + 1); ?>" aria-hidden="true"></span></div>
                <h3><?php echo $s[0]; ?></h3>
                <p><?php echo $s[1]; ?></p>
            </li>
            <?php } ?>
        </ol>
    </div>
</section>

<?php
include_once(G5_THEME_PATH.'/tail.php');
