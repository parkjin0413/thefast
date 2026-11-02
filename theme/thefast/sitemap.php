<?php
/**
 * 검색엔진용 사이트맵 (XML) — 페이지 + 공개 게시판 글을 자동으로 모읍니다.
 * 주소: /theme/thefast/sitemap.php  (루트 연결 파일을 올렸다면 /sitemap.php)
 * 네이버 서치어드바이저·구글 서치콘솔에 이 주소를 제출하세요.
 */
if (!defined('_GNUBOARD_')) include_once('./_common.php');
include_once(G5_THEME_PATH.'/site.config.php');

header('Content-Type: application/xml; charset=utf-8');

$tf_urls = array();
$tf_add = function ($loc, $lastmod = '', $priority = '0.6') use (&$tf_urls) {
    $tf_urls[$loc] = array($loc, $lastmod, $priority);
};

$tf_add(G5_URL.'/', date('Y-m-d'), '1.0');

// 메뉴 페이지
foreach ($tf_menu as $group) {
    foreach ($group['sub'] as $item) {
        // 비밀글 문의 게시판 목록은 검색 노출 불필요
        if (!empty($item['board']) && in_array($item['board'], array($tf_boards['inquiry'], $tf_boards['partner']), true)) continue;
        $tf_add(str_replace('&amp;', '&', $item['href']), '', empty($item['board']) ? '0.8' : '0.7');
    }
}

// 게시판 글 (비회원이 읽을 수 있는 게시판의 공개 글만)
foreach ($tf_boards as $bo) {
    $bo = preg_replace('/[^a-z0-9_]/i', '', $bo);
    $b = sql_fetch(" select bo_table, bo_read_level, bo_use_secret from {$g5['board_table']} where bo_table = '{$bo}' ");
    if (empty($b['bo_table']) || (int) $b['bo_read_level'] > 1 || (int) $b['bo_use_secret'] === 2) continue;

    $res = sql_query(" select wr_id, wr_last from {$g5['write_prefix']}{$bo} where wr_is_comment = 0 and wr_option not like '%secret%' order by wr_num, wr_reply limit 1000 ", false);
    if (!$res) continue;
    while ($row = sql_fetch_array($res)) {
        $tf_add(str_replace('&amp;', '&', get_pretty_url($bo, $row['wr_id'])), substr($row['wr_last'], 0, 10), '0.5');
    }
}

echo '<?xml version="1.0" encoding="UTF-8"?>'."\n";
echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
foreach ($tf_urls as $u) {
    echo "  <url>\n    <loc>".htmlspecialchars($u[0], ENT_XML1 | ENT_QUOTES, 'UTF-8')."</loc>\n";
    if ($u[1] && $u[1] !== '0000-00-00') echo "    <lastmod>{$u[1]}</lastmod>\n";
    echo "    <priority>{$u[2]}</priority>\n  </url>\n";
}
echo '</urlset>';
