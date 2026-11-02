<?php
/**
 * 더패스트 테마 공용 함수
 */
if (!defined('_GNUBOARD_')) exit;

include_once(G5_LIB_PATH.'/thumbnail.lib.php');

/**
 * 게시판 최신글 (메인 노출용)
 * - 게시판이 아직 없으면 빈 배열을 돌려줍니다.
 * - 비밀글과 댓글은 제외합니다.
 */
function tf_latest_posts($bo_table, $rows = 6, $thumb_w = 0, $thumb_h = 0, $sca = '')
{
    global $g5;

    $bo_table = preg_replace('/[^a-z0-9_]/i', '', $bo_table);
    if (!$bo_table) return array();

    $board = sql_fetch(" select bo_table, bo_subject, bo_read_level from {$g5['board_table']} where bo_table = '{$bo_table}' ");
    if (empty($board['bo_table'])) return array();
    // 비회원에게 읽기 권한이 없는 게시판은 메인에 노출하지 않음
    if ((int) $board['bo_read_level'] > 1) return array();

    $write_table = $g5['write_prefix'].$bo_table;
    $where = " wr_is_comment = 0 and wr_option not like '%secret%' ";
    if ($sca !== '') $where .= " and ca_name = '".sql_real_escape_string($sca)."' ";

    $rows = (int) $rows;
    $result = sql_query(" select wr_id, wr_subject, wr_content, wr_datetime, ca_name, wr_1, wr_2, wr_3, wr_4, wr_5 from {$write_table} where {$where} order by wr_num, wr_reply limit {$rows} ", false);

    $list = array();
    if (!$result) return $list;
    while ($row = sql_fetch_array($result)) {
        $item = array(
            'wr_id'    => $row['wr_id'],
            'href'     => get_pretty_url($bo_table, $row['wr_id']),
            'subject'  => get_text($row['wr_subject']),
            'summary'  => cut_str(trim(preg_replace('/\s+/u', ' ', strip_tags($row['wr_content']))), 90, '…'),
            'date'     => date('Y.m.d', strtotime($row['wr_datetime'])),
            'datetime' => date('Y-m-d', strtotime($row['wr_datetime'])),
            'ca_name'  => get_text($row['ca_name']),
            'wr_1'     => get_text($row['wr_1']),
            'wr_2'     => get_text($row['wr_2']),
            'thumb'    => '',
            'alt'      => '',
        );
        if ($thumb_w) {
            $thumb = get_list_thumbnail($bo_table, $row['wr_id'], $thumb_w, $thumb_h, false, true);
            $item['thumb'] = $thumb['src'] ?? '';
            $item['alt']   = !empty($thumb['alt']) ? $thumb['alt'] : $item['subject'];
        }
        $list[] = $item;
    }
    return $list;
}

/** 아이콘 SVG (장식용) */
function tf_icon($name, $size = 26)
{
    $paths = array(
        'speed'  => '<path d="M13 2 4 14h6l-1 8 9-12h-6l1-8z"/>',
        'quiet'  => '<path d="M11 5 6 9H2v6h4l5 4V5z"/><path d="m22 9-6 6M16 9l6 6"/>',
        'leaf'   => '<path d="M11 20A7 7 0 0 1 9.8 6.1C15.5 5 17 4.5 19 2c1 2 2 4.2 2 8 0 5.5-4.8 10-10 10z"/><path d="M2 21c0-3 1.9-5.4 5.1-6"/>',
        'won'    => '<path d="M4 6l3 12 5-10 5 10 3-12"/><path d="M2 11h20M2 14h20"/>',
        'shield' => '<path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/><path d="m9 12 2 2 4-4"/>',
        'drop'   => '<path d="M12 2.7 6.3 8.4a8 8 0 1 0 11.4 0z"/>',
    );
    if (!isset($paths[$name])) return '';
    return '<svg aria-hidden="true" width="'.$size.'" height="'.$size.'" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">'.$paths[$name].'</svg>';
}
