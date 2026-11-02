<?php
/**
 * 제품 데이터 — page/product.php 템플릿 하나가 이 배열을 읽어 화면을 만듭니다.
 * 제품을 추가/수정할 때는 이 파일만 고치면 됩니다.
 * 이미지 경로는 theme/thefast/img/ 기준입니다.
 */
if (!defined('_GNUBOARD_')) exit;

$tf_laminate_benefits = array(
    array('간편한 시공', '일반 타일과 달리 파손 없이 간편한 재단이 가능하고, 가벼운 소재로 벽면 부착이 쉽습니다.'),
    array('내구성 및 유지보수', '스크래치나 얼룩에 강하고 표면이 매끄러워 먼지나 오염물질이 잘 붙지 않아 관리가 간편합니다.'),
    array('내수성', '방수 처리가 되어 있어 욕실이나 주방처럼 습기가 많은 공간에도 적합합니다.'),
    array('비용 효율성', '다른 고급 마감재보다 비용이 합리적이어서 예산을 지키면서 고급스러운 디자인을 구현할 수 있습니다.'),
    array('환경 친화적', '재활용 가능한 소재와 낮은 탄소 배출 공정으로 생산되어 환경을 생각하는 고객에게 적합합니다.'),
);

$tf_floor_certs = array(
    array('sub/product/certification/antivirus_test_cf.jpg', '항바이러스 시험 성적서'),
    array('sub/product/certification/emission_test_cf.jpg', '오염물질 방출 시험 성적서'),
    array('sub/product/certification/environmental_label_cf.jpg', '친환경표지 인증서'),
    array('sub/product/certification/csr_cf.jpg', '미끄럼성(C.S.R) 테스트 인증서'),
);

$tf_prime_cert = array(
    'img'   => 'sub/product/test_report01.jpg',
    'title' => '한국건설생활환경시험연구원(KCL) 시험성적',
    'items' => array(
        array('KCL 준불연 시험성적', '국토부 고시 제2015-744호 (준불연재료 기준에 적합)'),
        array('KCL 중금속 검출 시험성적', '환경부 고시 제2019-32호 (환경유해인자 공정시험 기준 적합)'),
    ),
);

$tf_products = array(
    /* ------------------------------------------------ 벽장재 */
    'wall' => array(
        'title' => '벽장재',
        'en'    => 'Wall Finish',
        'lead'  => '줄눈 없이 깔끔하게, 기존 벽 위에 빠르게 시공하는 건식 벽 마감재',
        'items' => array(
            'laminate-panel' => array(
                'tab'      => '라미네이트 판넬',
                'sub'      => '아름다운 공간 연출',
                'en'       => 'Laminate Panel',
                'desc'     => '노르웨이산 100% 고품질 자작나무 7겹 합판으로 제작된 벽 마감재입니다. 판넬 결합 방식으로 줄눈 시공 없이 편리하게 설치할 수 있으며, 고강도 라미네이트 코팅으로 스크래치와 변색에 강하고, 습기로 인한 곰팡이와 오염에도 강해 공간에 세련된 디자인을 더합니다.',
                'spec'     => array('600(mm) × 2400(mm) × 10.2T'),
                'use_home' => '아파트, 단독주택, 빌라, 다세대주택',
                'use_biz'  => '매장, 카페, 사무실, 회의실, 관공서 등',
                'gallery'  => array('sub/product/pd_laminate_panel01.jpg', 'sub/product/pd_laminate_panel02.jpg', 'sub/product/pd_laminate_panel03.jpg', 'sub/product/pd_laminate_panel04.jpg'),
                'features' => array(
                    array('sub/product/easy.png', 'EASY & PERFECT', '합판이나 석고보드 없이 판넬 결합 방식으로 설치 시간 최소화'),
                    array('sub/product/liquid-glue.png', '접착제 NO', '시공 시 접착제를 사용하지 않아 유해 물질로부터 안전'),
                    array('sub/product/ecology.png', '우수한 단열', '자작나무 7겹 구성의 천연 단열 효과로 열 손실 최소화'),
                    array('sub/product/waterproof.png', '완벽한 방수', '습기 침투에 대한 높은 차단력'),
                    array('sub/product/cleaning.png', '간편한 유지보수', '틈새가 없어 곰팡이 및 오염에 강함'),
                    array('sub/product/protection.png', 'UV 자외선 차단', '자외선에 의한 변색·변형 방지'),
                ),
                'benefits' => $tf_laminate_benefits,
                'profiles' => array(
                    array('sub/product/panel_start.jpg', 'ㄷ 스타트'),
                    array('sub/product/panel_baseboard.jpg', '걸레받이'),
                    array('sub/product/panel_end.jpg', 'ㄱ 엔드'),
                    array('sub/product/panel_FinCorner.jpg', 'F 인코너'),
                    array('sub/product/panel_RoutCorner.jpg', 'R 아웃코너'),
                    array('sub/product/panel_ShortOutCorner.jpg', '짧은 R 아웃코너'),
                ),
                'swatch'   => 'laminate_panel',
            ),
            'laminate-tile' => array(
                'tab'      => '라미네이트 타일',
                'sub'      => '아름다운 공간 연출',
                'en'       => 'Laminate Tile',
                'desc'     => '다양한 색상, 패턴, 질감으로 목재, 대리석, 벽돌 등 원하는 인테리어 스타일을 구현할 수 있습니다. 일반 타일보다 가벼워 시공이 편하고, 기존 벽면에 쉽게 부착할 수 있어 리모델링 공사를 빠르게 마칠 수 있습니다.',
                'spec'     => array('420 × 700 × 3.6T', '180 × 1200 × 4.2T', '300 × 600 × 4.5T', '375 × 650 × 5T', '900 × 500 × 5T', '900 × 2600 × 5T (단위 mm)'),
                'use_home' => '아파트, 단독주택, 빌라, 다세대주택',
                'use_biz'  => '매장, 카페, 사무실, 회의실, 관공서 등',
                'gallery'  => array('sub/product/pd_laminate_tile01.jpg', 'sub/product/pd_laminate_tile02.jpg', 'sub/product/pd_laminate_tile03.jpg', 'sub/product/pd_laminate_tile04.jpg'),
                'features' => array(
                    array('sub/product/easy.png', 'EASY & PERFECT', '합판이나 석고보드 없이 설치 시간 최소화'),
                    array('sub/product/waterproof.png', '완벽한 방수', '습기 침투에 대한 높은 차단력'),
                    array('sub/product/cleaning.png', '간편한 유지보수', '틈새가 없어 곰팡이 및 오염에 강함'),
                    array('sub/product/protection.png', 'UV 자외선 차단', '자외선에 의한 변색·변형 방지'),
                ),
                'benefits' => $tf_laminate_benefits,
                'profiles' => array(
                    array('sub/product/tile_start.jpg', 'ㄷ 스타트'),
                    array('sub/product/tile_baseboard.jpg', '걸레받이'),
                    array('sub/product/tile_OutCorner1.jpg', '아웃코너 1'),
                    array('sub/product/tile_OutCorner2.jpg', '아웃코너 2'),
                    array('sub/product/tile_InCorner.jpg', '인코너'),
                ),
                'swatch'   => 'laminate_tile',
            ),
            'prime-line' => array(
                'tab'      => '라인 타공보드',
                'sub'      => '라인형 마그네슘 보드',
                'en'       => 'Prime Line Panel',
                'desc'     => '천연 무기질 마그네슘 소재의 친환경 건축자재로, 세균과 곰팡이 번식을 효과적으로 억제하는 항균 성능을 갖췄습니다. 습한 환경에서도 안정적이며, 준불연재 특성으로 화재 저항력이 우수해 건축물의 안전성을 높여 줍니다.',
                'spec'     => array('197(mm) × 2400(mm) × 12T'),
                'use_home' => '음악·영화 감상실, 취미공간, 단독주택 복도, 계단 내벽',
                'use_biz'  => '카페, 공연장, 교육시설, 시청각실·강당, 체육관',
                'gallery'  => array('sub/product/pd_prime_line_panel01.jpg', 'sub/product/pd_prime_line_panel02.jpg', 'sub/product/pd_prime_line_panel03.jpg'),
                'features' => array(
                    array('sub/product/mute.png', '소음 저감', '적절한 잔향률 및 소음 저감 효과'),
                    array('sub/product/fire-resistant.png', '준불연 등급', '화재에 안심할 수 있는 준불연 등급'),
                    array('sub/product/waterproof.png', '방수 · 항균', '습기 침투에 대한 높은 차단력 및 항균성'),
                    array('sub/product/cleaning.png', '간편한 유지보수', '낮은 먼지 흡착률로 쾌적한 공기질 유지'),
                ),
                'cert_kcl' => $tf_prime_cert,
                'swatch'   => 'prime_line_panel',
            ),
            'prime-circular' => array(
                'tab'      => '원형 타공보드',
                'sub'      => '타공형 규산칼슘 보드',
                'en'       => 'Prime Circular Panel',
                'desc'     => '규산칼슘(Calcium silicate)을 주원료로 해 뛰어난 차음 효과와 방수·방습 기능, 탁월한 준불연 성능을 발휘합니다. 무독성 소재로 유해가스를 배출하지 않는 친환경 건축 자재입니다.',
                'spec'     => array('595(mm) × 595(mm) × 9T', '1195(mm) × 595(mm) × 9T'),
                'use_home' => '음악·영화 감상실, 취미공간, 단독주택 복도, 계단 내벽',
                'use_biz'  => '카페, 공연장, 교육시설, 시청각실·강당, 체육관',
                'gallery'  => array('sub/product/prime_circular_panel01.jpg', 'sub/product/prime_circular_panel02.jpg', 'sub/product/prime_circular_panel03.jpg'),
                'features' => array(
                    array('sub/product/mute.png', '소음 저감', '적절한 잔향률 및 소음 저감 효과'),
                    array('sub/product/fire-resistant.png', '준불연 등급', '화재에 안심할 수 있는 준불연 등급'),
                    array('sub/product/waterproof.png', '방수 · 항균', '습기 침투에 대한 높은 차단력 및 항균성'),
                    array('sub/product/cleaning.png', '간편한 유지보수', '낮은 먼지 흡착률로 쾌적한 공기질 유지'),
                ),
                'cert_kcl' => $tf_prime_cert,
                'swatch'   => 'prime_circular_panel',
            ),
        ),
    ),

    /* ------------------------------------------------ 바닥재 */
    'floor' => array(
        'title' => '바닥재',
        'en'    => 'Flooring',
        'lead'  => '학교, 병원, 사무실 등 다중이용시설을 위한 안전한 친환경 바닥재',
        'items' => array(
            'emotion' => array(
                'tab'      => '이모션 시트',
                'sub'      => '다양한 패턴 연출',
                'en'       => 'Emotion Sheet 2.6T',
                'desc'     => '투명 코팅층과 다양한 디자인 패턴, 고밀도 재질로 내구성이 뛰어나며 Protecsol® 표면 처리로 긁힘과 마모에 강하고 청소가 쉽습니다. DOP(가소제), 중금속, 벤젠, 포름알데히드를 포함하지 않은 친환경 제품으로 학교, 사무실, 매장, 병원, 공공시설 등 다중 이용 공간에 적합합니다.',
                'spec'     => array('2000(mm) × 1500(mm) × 2.6T / Roll'),
                'use_home' => '아파트, 단독주택, 빌라, 다세대주택',
                'use_biz'  => '어린이집, 카페, 사무실, 회의실, 관공서 등',
                'gallery'  => array('sub/product/emotion_sheet01.jpg', 'sub/product/emotion_sheet02.jpg', 'sub/product/emotion_sheet03.jpg'),
                'features' => array(
                    array('sub/product/icon/icon-pollution_control.png', '고항균성', 'Protecsol® 코팅으로 오염 방지 및 바이러스 침투 방지'),
                    array('sub/product/icon/icon-nonslip.png', '미끄럼 방지', '젖은 신발 미끄럼 테스트 R9 등급'),
                    array('sub/product/icon/icon-fireproof.png', '화재 예방', '최고 내화 등급 Bfl-s1 난연성 인증'),
                    array('sub/product/icon/icon-clean.png', '쉬운 유지관리', '긁힘에 강하고 손쉬운 세척'),
                    array('sub/product/icon/icon-design.png', '다양한 디자인', '다양한 색상과 패턴을 구현하는 디자인층 구조'),
                    array('sub/product/icon/icon-green.png', '친환경 인증', 'DOP, 중금속, 벤젠, 포름알데히드 미검출'),
                ),
                'certs'    => $tf_floor_certs,
                'swatch'   => 'emotion',
            ),
            'artistic-sheet' => array(
                'tab'      => '아티스틱 시트',
                'sub'      => '고탄력 쿠션층',
                'en'       => 'Artistic Sheet 3.8T / 6.3T',
                'desc'     => '오염 방지 코팅층으로 스크래치와 변색에 강해 유지보수가 쉽고, C.S.R 미끄럼 테스트 인증과 PVC 초고밀도 쿠션층이 충격을 효과적으로 흡수해 안전하고 편안한 보행 환경을 만듭니다. 뛰거나 넘어짐이 잦은 아이들을 위한 돌봄교실, 유치원, 초·중학교 등 교육 환경에 적합한 친환경 바닥재입니다.',
                'spec'     => array('1830(mm) × 1800(mm) × 3.8T / Roll', '1830(mm) × 1400(mm) × 6.3T / Roll'),
                'use_home' => '아파트, 단독주택, 빌라, 다세대주택',
                'use_biz'  => '매장, 카페, 사무실, 회의실, 관공서 등',
                'gallery'  => array('sub/product/artistic_sheet01.jpg', 'sub/product/artistic_sheet02.jpg', 'sub/product/artistic_sheet03.jpg'),
                'features' => array(
                    array('sub/product/icon/icon-walking.png', '편안한 보행감', '고탄력 쿠션층으로 충격 흡수 및 생활 소음 감소'),
                    array('sub/product/icon/icon-coating.png', '특수 섬유층 적층', '온도·습도 변화에 강하고 시공 후 안착성 우수'),
                    array('sub/product/icon/icon-nonslip.png', '미끄럼 방지', '젖은 신발 미끄럼 테스트 R9 등급'),
                    array('sub/product/icon/icon-fireproof.png', '화재 예방', '최고 내화 등급 Bfl-s1 난연성 인증'),
                    array('sub/product/icon/icon-clean.png', '쉬운 유지관리', '긁힘에 강하고 손쉬운 세척'),
                    array('sub/product/icon/icon-green.png', '친환경 인증', 'DOP, 중금속, 벤젠, 포름알데히드 미검출'),
                ),
                'certs'    => $tf_floor_certs,
                'swatch'   => 'artistic_sheet',
            ),
            'artistic-tile' => array(
                'tab'      => '아티스틱 타일',
                'sub'      => '고항균성 바닥재',
                'en'       => 'Artistic Tile 3.2T / 5.2T',
                'desc'     => '미국 EPA 인증을 받은 고항균성 EEPT™ 항균 소재를 사용해 위생적이며, 고강도 디자인 보호층 EPT™ Shield 코팅으로 긁힘·찍힘·변색·오염으로부터 표면을 보호합니다. KSM380 2:2014 인증의 우수한 내화학성으로 기름, 지방, 솔벤트 등 오염물질에도 강해 오랫동안 깔끔하게 유지됩니다.',
                'spec'     => array('457(mm) × 457(mm) × 3.2T / Box', '600(mm) × 600(mm) × 5.2T / Box'),
                'use_home' => '아파트, 단독주택, 빌라, 다세대주택',
                'use_biz'  => '카페, 피트니스센터, 사무실, 병원, 관공서 등',
                'gallery'  => array('sub/product/artistic_tile01.jpg', 'sub/product/artistic_tile02.jpg', 'sub/product/artistic_tile03.jpg'),
                'features' => array(
                    array('sub/product/icon/icon-pollution_control.png', '고항균성', '박테리아 99.9% 제거하는 EEPT™ 항균 소재'),
                    array('sub/product/icon/icon-air.png', '쾌적한 공기질', '낮은 먼지 흡착률로 실내 공기질 유지'),
                    array('sub/product/icon/icon-green.png', '친환경 인증', 'DOP, 중금속, 벤젠, 포름알데히드 미검출'),
                    array('sub/product/icon/icon-nonslip.png', '미끄럼 방지', '젖은 신발 미끄럼 테스트 R9 등급'),
                    array('sub/product/icon/icon-anti_scratch.png', '스크래치 방지', '찍힘과 마모에 강한 고밀도 보호층'),
                    array('sub/product/icon/icon-uv.png', '자외선 변색 방지', 'ISO 105-B02 인증 자외선 변색 방지'),
                ),
                'certs'    => array(
                    array('sub/product/certification/antivirus_test_cf.jpg', '항바이러스 시험 성적서'),
                    array('sub/product/certification/emission_test_cf.jpg', '오염물질 방출 시험 성적서'),
                    array('sub/product/certification/environmental_label2_cf.jpg', '친환경표지 인증서'),
                    array('sub/product/certification/csr_kor_cf.jpg', '미끄럼성(C.S.R) 테스트 인증서'),
                ),
                'swatch'   => 'artistic_tile',
            ),
            'linoleum' => array(
                'tab'      => '리노륨 바닥재',
                'sub'      => '편안한 보행 안전성',
                'en'       => 'Marmoleum 2.5T',
                'desc'     => '98% 천연 성분의 유기 바닥재 솔루션으로 다양한 색상과 디자인 패턴, 네오케어(Neocare) 표면처리로 유지보수가 쉽습니다. 항바이러스·항균 성능이 우수하고 내마모성과 내긁힘성이 높아 이동이 많은 보행로나 경사로 바닥재로 이상적입니다.',
                'spec'     => array('2(mm) × 31(mm) × 11T / Roll'),
                'use_home' => '아파트, 단독주택, 빌라, 다세대주택',
                'use_biz'  => '카페, 사무실, 병원, 관공서 등',
                'gallery'  => array('sub/product/linoleum01.jpg', 'sub/product/linoleum02.jpg', 'sub/product/linoleum03.jpg'),
                'features' => array(
                    array('sub/product/icon/icon-pollution_control.png', '우수한 항균성', '항바이러스·항균 성능이 우수한 천연 유기 바닥재'),
                    array('sub/product/icon/icon-fireproof.png', '높은 내구성', '긁힘에 강하고 손쉬운 세척'),
                    array('sub/product/icon/icon-green.png', '100% 재활용 가능', 'REACH 규정 준수, 중금속·CMR 물질(1·2등급) 무함유'),
                    array('sub/product/icon/icon-nonslip.png', '미끄럼 방지', '젖은 신발 미끄럼 테스트 R9 등급'),
                    array('sub/product/icon/icon-maintenance.png', '쉬운 유지관리', '특별한 관리 없이 간단한 청소로 유지'),
                    array('sub/product/icon/icon-air.png', '쾌적한 공기질', '낮은 먼지 흡착률로 실내 공기질 유지'),
                ),
                'certs'    => array(
                    array('sub/product/certification/antivirus_test_cf.jpg', '항바이러스 시험 성적서'),
                    array('sub/product/certification/emission_test_cf.jpg', '오염물질 방출 시험 성적서'),
                    array('sub/product/certification/environmental_label3_cf.jpg', '친환경표지 인증서'),
                    array('sub/product/certification/csr_cf.jpg', '미끄럼성(C.S.R) 테스트 인증서'),
                ),
                'swatch'   => 'linoleum',
            ),
        ),
    ),

    /* ------------------------------------------------ 천장재 */
    'ceiling' => array(
        'title' => '천장재',
        'en'    => 'Ceiling',
        'lead'  => '소리는 부드럽게, 공기는 쾌적하게. 화재에 안전한 천연 천장재',
        'items' => array(
            'natural-ceiling' => array(
                'tab'      => '천연 석고 천장재',
                'sub'      => '천연석고와 유리섬유를 사용한 불연성 천장재',
                'en'       => 'Natural Ceiling Panel',
                'desc'     => '천공 패널을 통해 소리와 진동을 줄이는 흡음 효과가 있으며, 압착 유리섬유와 천연 보강 석고로 쾌적한 공기질을 유지합니다. 화재에 안전한 불연 천장재로 강당, 강의장, 영화관, 음악실 등 음성과 음향 전달이 중요한 공간에 효과적입니다.',
                'spec'     => array('600(mm) × 600(mm) × 10~12T'),
                'use_home' => '음악·영화 감상실',
                'use_biz'  => '매장, 카페, 사무실, 휴게실, 회의실, 관공서 등',
                'gallery'  => array('sub/product/pd_natural_ceiling_panel01.jpg', 'sub/product/pd_natural_ceiling_panel02.jpg', 'sub/product/pd_natural_ceiling_panel03.jpg'),
                'features' => array(
                    array('sub/product/clean-air.png', '쾌적한 공기질', '습기 흡수·방출 기능으로 실내 공기질 개선'),
                    array('sub/product/fire-resistant.png', '불연 등급', '높은 내화성으로 불길 확산을 늦추는 안심 소재'),
                    array('sub/product/mute.png', '최상의 음향', '소리의 굴절·반사·공진율을 최소화'),
                    array('sub/product/layer.png', '높은 내구성', '특수 압착 기술로 변색·변형에 강함'),
                ),
                'benefits' => array(
                    array('쾌적한 공기질', '습기 흡수 및 방출 기능으로 실내 공기질을 개선하고 습기 문제를 완화합니다.'),
                    array('화재 안전성', '천연 석고는 높은 내화성을 지녀 화재 발생 시 불길의 확산을 늦추고 안전성을 높여 줍니다.'),
                    array('소음 저감', '소리의 굴절, 반사, 공진율을 최소화해 강당, 음악실, 영화감상실에서도 안정적인 음질을 유지합니다.'),
                    array('높은 내구성', '천연 석고와 유리섬유를 특수 압착해 일반 천장재보다 변색과 변형에 강하고 오래도록 견고합니다.'),
                ),
                'swatch'   => 'ceiling',
            ),
        ),
    ),
);

/* 색상·패턴 샘플 (img/swatch/ 기준) */
$tf_swatches = array();
$tf_swatches['laminate_panel'] = array(
    array('White Marble', 'laminate_panel/01.jpg'),
    array('Light Slate', 'laminate_panel/02.jpg'),
    array('Brooklyn Concrete', 'laminate_panel/03.jpg'),
    array('Concrete', 'laminate_panel/04.jpg'),
    array('Concrete Natural', 'laminate_panel/05.jpg'),
    array('Cement', 'laminate_panel/06.jpg'),
    array('Natural Slate', 'laminate_panel/07.jpg'),
    array('Federa', 'laminate_panel/08.jpg'),
    array('Royal Oak', 'laminate_panel/09.jpg'),
    array('Black Slate', 'laminate_panel/10.jpg'),
    array('Sky Blue', 'laminate_panel/11.jpg'),
    array('London', 'laminate_panel/12.jpg'),
);
$tf_swatches['laminate_tile'] = array(
    array('Milk White', 'laminate_tile/01.jpg'),
    array('Botticino', 'laminate_tile/02.jpg'),
    array('Beige', 'laminate_tile/03.jpg'),
    array('Ceppino Beige', 'laminate_tile/04.jpg'),
    array('Larisa', 'laminate_tile/05.jpg'),
    array('Calacatta', 'laminate_tile/06.jpg'),
    array('Terrazzo', 'laminate_tile/07.jpg'),
    array('Travis', 'laminate_tile/08.jpg'),
    array('Marble', 'laminate_tile/09.jpg'),
    array('Night', 'laminate_tile/10.jpg'),
    array('Glow', 'laminate_tile/11.jpg'),
    array('Shine', 'laminate_tile/12.jpg'),
);
$tf_swatches['prime_line_panel'] = array(
    array('라인타공 12T - White', 'prime_line_panel/01.jpg'),
    array('라인타공 12T - Light Grey', 'prime_line_panel/02.jpg'),
    array('라인타공 12T - Dark Grey', 'prime_line_panel/03.jpg'),
    array('라인타공 12T - Maple 2', 'prime_line_panel/04.jpg'),
    array('라인타공 12T - Cherry', 'prime_line_panel/05.jpg'),
    array('라인타공 12T - Yellow', 'prime_line_panel/06.jpg'),
    array('라인타공 12T - Green', 'prime_line_panel/07.jpg'),
    array('라인타공 12T - Sky Blue', 'prime_line_panel/08.jpg'),
    array('라인타공 12T - Blue', 'prime_line_panel/09.jpg'),
);
$tf_swatches['prime_circular_panel'] = array(
    array('원형타공 9T - Maple', 'prime_circular_panel/01.jpg'),
    array('원형타공 9T - Maple2', 'prime_circular_panel/02.jpg'),
    array('원형타공 9T - Cherry', 'prime_circular_panel/03.jpg'),
);
$tf_swatches['emotion'] = array(
    array('이모션 0811', 'emotion/01.jpg'),
    array('이모션 1123', 'emotion/02.jpg'),
    array('이모션 1124', 'emotion/03.jpg'),
    array('이모션 1155', 'emotion/04.jpg'),
    array('이모션 0801', 'emotion/05.jpg'),
    array('이모션 0802', 'emotion/06.jpg'),
    array('이모션 0804', 'emotion/07.jpg'),
    array('이모션 0809', 'emotion/08.jpg'),
    array('이모션 1154', 'emotion/09.jpg'),
    array('이모션 0806', 'emotion/10.jpg'),
    array('이모션 0614', 'emotion/11.jpg'),
    array('이모션 0716', 'emotion/12.jpg'),
);
$tf_swatches['artistic_sheet'] = array(
    array('5143-마(오렌지)', 'artistic_sheet/01.jpg'),
    array('5146-타(노랑)', 'artistic_sheet/02.jpg'),
    array('5147-파(연두)', 'artistic_sheet/03.jpg'),
    array('5145-차(스카이)', 'artistic_sheet/04.jpg'),
    array('5141-가(핑크)', 'artistic_sheet/05.jpg'),
    array('514-오', 'artistic_sheet/06.jpg'),
    array('5142-너(연베이지)', 'artistic_sheet/07.jpg'),
    array('5144-바(베이지)', 'artistic_sheet/08.jpg'),
    array('NZ35503A', 'artistic_sheet/09.jpg'),
    array('NZ35503C', 'artistic_sheet/10.jpg'),
);
$tf_swatches['artistic_tile'] = array(
    array('514-로(연베이지)', 'artistic_tile/01.jpg'),
    array('514-코(진베이지)', 'artistic_tile/02.jpg'),
    array('514-모(진그레이)', 'artistic_tile/03.jpg'),
    array('514-고(주황)', 'artistic_tile/04.jpg'),
    array('514-노(노랑)', 'artistic_tile/05.jpg'),
    array('514-도(연두)', 'artistic_tile/06.jpg'),
    array('514-오(스카이)', 'artistic_tile/07.jpg'),
    array('514-조(네이비)', 'artistic_tile/08.jpg'),
    array('514-보(보라)', 'artistic_tile/09.jpg'),
    array('KSE-112', 'artistic_tile/10.jpg'),
    array('KSE-111', 'artistic_tile/11.jpg'),
    array('KSE-115', 'artistic_tile/12.jpg'),
);
$tf_swatches['linoleum'] = array(
    array('0145 BANANA WHITE', 'linoleum/01.jpg'),
    array('0251 CREAM', 'linoleum/02.jpg'),
    array('0040 LIGHT SAHARA', 'linoleum/03.jpg'),
    array('0042 SHORTCRUST', 'linoleum/04.jpg'),
    array('0045 SAND BEIGE', 'linoleum/05.jpg'),
    array('0092 BEACH', 'linoleum/06.jpg'),
    array('0090 SOAPSTONE', 'linoleum/07.jpg'),
    array('0098 DESERT BEIGE', 'linoleum/08.jpg'),
    array('0146 BEESWAX BEIGE', 'linoleum/09.jpg'),
    array('0243 MARBLE BEIGE', 'linoleum/10.jpg'),
    array('0166 CLAY', 'linoleum/11.jpg'),
    array('0164 MILK COFFEE', 'linoleum/12.jpg'),
);
$tf_swatches['ceiling'] = array(
    array('RF원형타공 White', 'ceiling/01.jpg'),
    array('천연석고(Random)', 'ceiling/02.jpg'),
    array('천연석고(Infinity)', 'ceiling/03.jpg'),
);
