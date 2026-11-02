<?php
/**
 * 더패스트(THE FAST) 사이트 공통 설정
 * 상호·연락처·메뉴·SEO 정보는 이 파일 한 곳에서만 수정하세요.
 */
if (!defined('_GNUBOARD_')) exit;

/* ------------------------------------------------------------------
 * 1. 회사 정보
 * ------------------------------------------------------------------ */
$tf_site = array(
    'name'        => '더패스트',
    'name_en'     => 'THE FAST',
    'corp'        => '(주)더패스트',
    'slogan'      => '보다 빠르고 조용한 인테리어 리모델링',
    'ceo'         => '장윤정',
    'biz_no'      => '501-87-02496',
    'tel'         => '031-868-8878',
    'tel_label'   => '031-868-8878~9',
    'email'       => 'thefast21@daum.net',
    'zip'         => '',
    'addr'        => '경기도 양주시 천보산로71번길 22-17 (회암동)',
    'addr_region' => '경기도',
    'addr_city'   => '양주시',
    'addr_street' => '천보산로71번길 22-17',
    'hours'       => '평일 08:00 ~ 17:00',
    'hours_note'  => '점심 12:00 ~ 13:00 · 주말/공휴일 휴무',
    'transit'     => "마을버스 11번, 75번 '관사앞' 정류장 하차 후 도보 약 250m",
    'lat'         => '37.8113',   // 지도 좌표 (카카오맵에서 정확한 값 확인 후 수정)
    'lng'         => '127.0786',
    // SNS — 비워두면 화면에 노출되지 않습니다.
    'blog'        => 'https://blog.naver.com/thefast-21',
    'instagram'   => '',
    'youtube'     => '',
    'kakao'       => '',          // 카카오톡 채널 URL (예: https://pf.kakao.com/_xxxx)
    // 지도 — 카카오 JavaScript 키를 넣으면 카카오맵, 비우면 구글 지도 임베드
    'kakao_js_key'=> '',
);

/* ------------------------------------------------------------------
 * 2. SEO 기본값 (한글 "더패스트" 검색 기준)
 * ------------------------------------------------------------------ */
$tf_seo = array(
    'title'       => '더패스트 | 빠르고 조용한 인테리어 리모델링 전문',
    'description' => '더패스트(THE FAST)는 라미네이트 판넬·타일 건식 시공으로 아파트, 주택, 상가, 관공서, 학교, 병원 리모델링을 빠르고 조용하게 완성하는 인테리어 시공 전문기업입니다.',
    'keywords'    => '더패스트,THE FAST,더패스트 인테리어,양주 인테리어,리모델링,라미네이트 판넬,라미네이트 타일,건식 벽체,욕실 리모델링,타공보드,친환경 바닥재,천장재,관공서 인테리어,상가 인테리어',
    'og_image'    => '/img/og-image.jpg', // 테마 기준 경로 (1200x630)
    // 검색엔진 소유확인 코드 (네이버 서치어드바이저 / 구글 서치콘솔)
    'naver_verify'  => '',
    'google_verify' => '',
);

/* ------------------------------------------------------------------
 * 3. 독립 페이지 URL
 *    TF_ROOT_PAGES = true 로 바꾸고 _deploy/root/ 의 파일을 사이트 루트에 올리면
 *    /theme/thefast/page/about.php → /about.php 처럼 짧은 주소로 바뀝니다.
 * ------------------------------------------------------------------ */
if (!defined('TF_ROOT_PAGES')) define('TF_ROOT_PAGES', false);

function tf_page_url($name, $query = '')
{
    $base = TF_ROOT_PAGES ? G5_URL.'/'.$name.'.php' : G5_THEME_URL.'/page/'.$name.'.php';
    return $query ? $base.'?'.$query : $base;
}

function tf_board_url($bo_table, $sca = '')
{
    return $sca ? get_pretty_url($bo_table, '', 'sca='.urlencode($sca)) : get_pretty_url($bo_table);
}

/* ------------------------------------------------------------------
 * 4. 게시판 테이블명 (관리자에서 만든 게시판 ID와 같아야 합니다)
 * ------------------------------------------------------------------ */
$tf_boards = array(
    'portfolio' => 'portfolio', // 시공사례 (분류: 주거공간|관공서|상업시설|기타시공)
    'review'    => 'review',    // 고객후기
    'event'     => 'event',     // 리뷰 이벤트
    'news'      => 'news',      // 더패스트 소식
    'history'   => 'history',   // 주요 실적
    'inquiry'   => 'inquiry',   // 상담문의 (비밀글)
    'partner'   => 'partner',   // 제휴문의 (비밀글)
);

/* 시공사례 분류 — 게시판 관리 > 분류 와 똑같이 입력하세요 */
$tf_portfolio_cates = array(
    '주거공간' => array('en' => 'Residential', 'desc' => '아파트 · 단독주택 · 빌라 · 욕실 · 주방'),
    '관공서'   => array('en' => 'Public',      'desc' => '관공서 · 학교 · 어린이집 · 병원'),
    '상업시설' => array('en' => 'Commercial',  'desc' => '카페 · 매장 · 사무실 · 피트니스'),
    '기타시공' => array('en' => 'Others',      'desc' => '흡음 · 천장 · 바닥 등 부분 시공'),
);

/* 게시판 확장필드(wr_1~wr_10) 매핑 — 스킨이 이 표를 보고 입력칸/표시칸을 만듭니다.
 * type: text | select | radio   / req: 필수 여부   / list: 목록·카드에 표시 */
$tf_board_fields = array(
    'portfolio' => array(
        'wr_2' => array('label' => '지역',     'type' => 'text', 'ph' => '예) 경기 양주시', 'list' => true),
        'wr_1' => array('label' => '평수',     'type' => 'text', 'ph' => '예) 32평', 'list' => true),
        'wr_3' => array('label' => '공사기간', 'type' => 'text', 'ph' => '예) 5일'),
        'wr_4' => array('label' => '공사범위', 'type' => 'text', 'ph' => '예) 욕실 벽체, 주방 벽면'),
    ),
    'review' => array(
        'wr_2' => array('label' => '지역',      'type' => 'text', 'ph' => '예) 서울 노원구', 'list' => true),
        'wr_1' => array('label' => '시공 공간', 'type' => 'text', 'ph' => '예) 욕실 리모델링', 'list' => true),
    ),
    'inquiry' => array(
        'wr_1' => array('label' => '연락처',        'type' => 'tel',    'req' => true, 'ph' => '010-0000-0000'),
        'wr_2' => array('label' => '공간 유형',     'type' => 'radio',  'req' => true, 'options' => array('아파트', '단독주택', '빌라·다세대', '상가·매장', '사무실', '관공서·학교', '병원', '기타')),
        'wr_6' => array('label' => '시공 지역',     'type' => 'text',   'ph' => '예) 경기 양주시 회암동'),
        'wr_3' => array('label' => '평수',          'type' => 'text',   'ph' => '예) 32평 / 욕실 1개'),
        'wr_4' => array('label' => '예산',          'type' => 'select', 'options' => array('상담 후 결정', '500만원 미만', '500~1,000만원', '1,000~3,000만원', '3,000~5,000만원', '5,000만원 이상')),
        'wr_5' => array('label' => '희망 시공 시기', 'type' => 'select', 'options' => array('최대한 빨리', '1개월 이내', '1~3개월 이내', '3개월 이후', '미정')),
    ),
    'partner' => array(
        'wr_2' => array('label' => '회사명',    'type' => 'text',  'req' => true, 'ph' => '회사(상호)명'),
        'wr_1' => array('label' => '연락처',    'type' => 'tel',   'req' => true, 'ph' => '010-0000-0000'),
        'wr_3' => array('label' => '제휴 유형', 'type' => 'radio', 'req' => true, 'options' => array('자재 공급', '시공 협력', '대리점·유통', '마케팅·기타')),
    ),
);

/* ------------------------------------------------------------------
 * 5. 메뉴 (GNB / 서브 탭 / 브레드크럼 / 사이트맵이 모두 이 배열을 사용)
 *    key     : 현재 페이지 판별용 고유값
 *    board   : 게시판이면 bo_table
 *    sca     : 게시판 분류 (선택)
 * ------------------------------------------------------------------ */
$tf_menu = array(
    'about' => array(
        'title'  => '회사소개',
        'en'     => 'About',
        'visual' => 'sub/sub_visual/interior-hd.jpg',
        'lead'   => '보다 빠르고 조용하게, 만족스러운 공간을 만듭니다.',
        'sub'    => array(
            array('key' => 'about',    'title' => '더패스트 소개', 'href' => tf_page_url('about')),
            array('key' => 'process',  'title' => '시공 프로세스', 'href' => tf_page_url('process')),
            array('key' => 'history',  'title' => '주요 실적',     'href' => tf_board_url($tf_boards['history']), 'board' => $tf_boards['history']),
            array('key' => 'news',     'title' => '더패스트 소식', 'href' => tf_board_url($tf_boards['news']),    'board' => $tf_boards['news']),
            array('key' => 'location', 'title' => '오시는 길',     'href' => tf_page_url('location')),
        ),
    ),
    'product' => array(
        'title'  => '제품안내',
        'en'     => 'Products',
        'visual' => 'sub/sub_visual/product-hd.jpg',
        'lead'   => '공간의 완성도를 높이는 친환경 건식 마감재',
        'sub'    => array(
            array('key' => 'product-wall',    'title' => '벽장재', 'href' => tf_page_url('product', 'type=wall')),
            array('key' => 'product-floor',   'title' => '바닥재', 'href' => tf_page_url('product', 'type=floor')),
            array('key' => 'product-ceiling', 'title' => '천장재', 'href' => tf_page_url('product', 'type=ceiling')),
        ),
    ),
    'portfolio' => array(
        'title'  => '시공사례',
        'en'     => 'Portfolio',
        'visual' => 'sub/sub_visual/portfolio-hd.jpg',
        'lead'   => '더패스트가 완성한 공간을 소개합니다.',
        'sub'    => array(
            array('key' => 'portfolio',       'title' => '전체',          'href' => tf_board_url($tf_boards['portfolio']), 'board' => $tf_boards['portfolio']),
            array('key' => 'portfolio-home',  'title' => '주거공간 인테리어', 'href' => tf_board_url($tf_boards['portfolio'], '주거공간'), 'board' => $tf_boards['portfolio'], 'sca' => '주거공간'),
            array('key' => 'portfolio-pub',   'title' => '관공서 인테리어',   'href' => tf_board_url($tf_boards['portfolio'], '관공서'),   'board' => $tf_boards['portfolio'], 'sca' => '관공서'),
            array('key' => 'portfolio-biz',   'title' => '상업시설 인테리어', 'href' => tf_board_url($tf_boards['portfolio'], '상업시설'), 'board' => $tf_boards['portfolio'], 'sca' => '상업시설'),
            array('key' => 'portfolio-etc',   'title' => '기타 시공',        'href' => tf_board_url($tf_boards['portfolio'], '기타시공'), 'board' => $tf_boards['portfolio'], 'sca' => '기타시공'),
        ),
    ),
    'review' => array(
        'title'  => '고객후기',
        'en'     => 'Review',
        'visual' => 'sub/sub_visual/membership-hd.jpg',
        'lead'   => '더패스트와 함께한 고객님의 이야기',
        'sub'    => array(
            array('key' => 'review', 'title' => '고객 후기',   'href' => tf_board_url($tf_boards['review']), 'board' => $tf_boards['review']),
            array('key' => 'event',  'title' => '리뷰 이벤트', 'href' => tf_board_url($tf_boards['event']),  'board' => $tf_boards['event']),
        ),
    ),
    'support' => array(
        'title'  => '고객지원',
        'en'     => 'Contact',
        'visual' => 'sub/sub_visual/process-bg.jpg',
        'lead'   => '궁금한 점은 언제든 편하게 문의해 주세요.',
        'sub'    => array(
            array('key' => 'inquiry', 'title' => '상담 문의',     'href' => tf_board_url($tf_boards['inquiry']), 'board' => $tf_boards['inquiry']),
            array('key' => 'partner', 'title' => '제휴 문의',     'href' => tf_board_url($tf_boards['partner']), 'board' => $tf_boards['partner']),
            array('key' => 'faq',     'title' => '자주하는 질문', 'href' => G5_BBS_URL.'/faq.php'),
        ),
    ),
);

/* 상담문의 바로가기 (헤더 버튼 / CTA) */
$tf_inquiry_url = G5_BBS_URL.'/write.php?bo_table='.$tf_boards['inquiry'];

/* ------------------------------------------------------------------
 * 6. 현재 페이지 판별
 *    - 독립 페이지: head.php 를 부르기 전에 $tf_current = 'process'; 처럼 지정
 *    - 게시판/FAQ/내용관리: 자동 판별
 * ------------------------------------------------------------------ */
function tf_detect_current()
{
    global $tf_menu, $bo_table, $sca, $co_id, $tf_current, $wr_id, $write;

    if (!empty($tf_current)) return $tf_current;

    // 글 보기 화면에서는 글의 분류로 하위 메뉴를 표시
    $cur_sca = (string) $sca;
    if ($cur_sca === '' && !empty($wr_id) && isset($write['ca_name'])) $cur_sca = (string) $write['ca_name'];

    $script = basename($_SERVER['SCRIPT_NAME'] ?? '');
    if ($script === 'faq.php') return 'faq';
    if ($script === 'content.php' && !empty($co_id)) return 'content-'.$co_id;

    if (!empty($bo_table)) {
        $fallback = '';
        foreach ($tf_menu as $group) {
            foreach ($group['sub'] as $item) {
                if (empty($item['board']) || $item['board'] !== $bo_table) continue;
                if (!empty($item['sca']) && $cur_sca !== '' && $item['sca'] === $cur_sca) return $item['key'];
                if (empty($item['sca']) && !$fallback) $fallback = $item['key'];
            }
        }
        if ($fallback) return $fallback;
    }
    return '';
}

/* 현재 key 로 [대메뉴key, 대메뉴, 소메뉴] 반환 */
function tf_find_menu($key)
{
    global $tf_menu;
    foreach ($tf_menu as $gkey => $group) {
        foreach ($group['sub'] as $item) {
            if ($item['key'] === $key) return array($gkey, $group, $item);
        }
    }
    return array('', null, null);
}

/* 이미지 URL 헬퍼 */
function tf_img($path)
{
    return G5_THEME_URL.'/img/'.ltrim($path, '/');
}

function tf_tel_href($tel)
{
    return 'tel:'.preg_replace('/[^0-9+]/', '', $tel);
}

/* 업로드 용량 표시 (10485760 → 10MB) */
function tf_filesize($bytes)
{
    $bytes = (int) $bytes;
    if ($bytes >= 1048576) return round($bytes / 1048576, 1).'MB';
    if ($bytes >= 1024) return round($bytes / 1024).'KB';
    return $bytes.'B';
}
