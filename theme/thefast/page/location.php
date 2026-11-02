<?php
if (!defined('_GNUBOARD_')) include_once('./_common.php');

$g5['title']  = '오시는 길';
$tf_current   = 'location';
$tf_meta      = array('description' => '더패스트 오시는 길 — 경기도 양주시 천보산로71번길 22-17. 평일 08:00~17:00, 대표번호 031-868-8878.');

include_once(G5_THEME_PATH.'/head.php');

$tf_q        = urlencode($tf_site['addr']);
$tf_kakao    = 'https://map.kakao.com/link/search/'.rawurlencode($tf_site['addr']);
$tf_naver    = 'https://map.naver.com/p/search/'.rawurlencode($tf_site['addr']);
?>

<h2 class="sound_only">지도</h2>
<div class="tf-map tf-reveal">
    <?php if ($tf_site['kakao_js_key']) { ?>
    <div id="tfKakaoMap" role="img" aria-label="더패스트 위치 지도: <?php echo $tf_site['addr']; ?>"></div>
    <script src="//dapi.kakao.com/v2/maps/sdk.js?appkey=<?php echo urlencode($tf_site['kakao_js_key']); ?>&amp;autoload=false"></script>
    <script>
    kakao.maps.load(function () {
        var pos = new kakao.maps.LatLng(<?php echo (float) $tf_site['lat']; ?>, <?php echo (float) $tf_site['lng']; ?>);
        var map = new kakao.maps.Map(document.getElementById('tfKakaoMap'), { center: pos, level: 3 });
        new kakao.maps.Marker({ position: pos, map: map });
        map.setZoomable(false);
        map.addControl(new kakao.maps.ZoomControl(), kakao.maps.ControlPosition.RIGHT);
    });
    </script>
    <?php } else { ?>
    <iframe src="https://maps.google.com/maps?q=<?php echo $tf_q; ?>&amp;hl=ko&amp;z=16&amp;output=embed" title="더패스트 위치 지도: <?php echo $tf_site['addr']; ?>" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    <?php } ?>
</div>

<div class="tf-loc-info">
    <div class="tf-reveal">
        <h2>ADDRESS</h2>
        <p><?php echo $tf_site['addr']; ?><small><?php echo $tf_site['corp']; ?></small></p>
    </div>
    <div class="tf-reveal" data-delay="1">
        <h2>OPEN HOURS</h2>
        <p><?php echo $tf_site['hours']; ?><small><?php echo $tf_site['hours_note']; ?></small></p>
    </div>
    <div class="tf-reveal" data-delay="2">
        <h2>CONTACT</h2>
        <p><a href="<?php echo tf_tel_href($tf_site['tel']); ?>"><?php echo $tf_site['tel_label']; ?></a><small><a href="mailto:<?php echo $tf_site['email']; ?>"><?php echo $tf_site['email']; ?></a></small></p>
    </div>
</div>

<div class="tf-loc-btns">
    <a href="<?php echo $tf_kakao; ?>" class="tf-btn tf-btn--dark" target="_blank" rel="noopener" title="새 창">카카오맵으로 보기</a>
    <a href="<?php echo $tf_naver; ?>" class="tf-btn tf-btn--line" target="_blank" rel="noopener" title="새 창">네이버 지도로 보기</a>
</div>

<div class="tf-cert__text tf-loc-note tf-reveal">
    <ul>
        <li><b>대중교통</b> &nbsp;<?php echo $tf_site['transit']; ?></li>
        <li><b>방문 안내</b> &nbsp;부재 중일 수 있으니 방문 전 <a href="<?php echo tf_tel_href($tf_site['tel']); ?>"><?php echo $tf_site['tel']; ?></a>로 사전 예약을 권장합니다.</li>
    </ul>
</div>

<?php
include_once(G5_THEME_PATH.'/tail.php');
