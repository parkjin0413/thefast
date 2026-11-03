<?php
/**
 * 공간별 리모델링 데이터 — page/space.php 템플릿 하나가 이 배열을 읽어 4개 페이지를 만듭니다.
 * 공간을 추가·수정할 때는 이 파일만 고치면 메뉴까지 자동으로 바뀝니다.
 * 이미지 경로는 theme/thefast/img/ 기준, 자재 링크는 page/product.php 의 type / #탭 기준입니다.
 * 문구는 기존 홈페이지와 자재 정보에 있는 내용만 사용했습니다. (숫자·실적은 넣지 않음)
 */
if (!defined('_GNUBOARD_')) exit;

$tf_spaces = array(
    'bath' => array(
        'title'    => '욕실 리모델링',
        'short'    => '욕실',
        'en'       => 'Bathroom',
        'image'    => 'sub/sub_visual/product-hd.jpg',
        'thumb'    => 'main/pd-img02.jpg',
        'headline' => '타일 철거 없이,<br>줄눈 없는 깔끔한 욕실로.',
        'lead'     => '기존 벽면 위에 라미네이트 타일·판넬을 결합하는 건식 시공으로 철거 소음과 분진을 줄이고, 공사 기간을 짧게 끝냅니다.',
        'pains'    => array(
            '타일 줄눈에 생기는 곰팡이와 물때',
            '타일 철거 소음과 분진으로 인한 이웃 눈치',
            '공사 기간 동안 욕실을 쓰지 못하는 불편',
        ),
        'points'   => array(
            array('기존 벽 위에 바로 시공', '가벼운 소재로 기존 벽면에 쉽게 부착할 수 있어 철거를 최소화합니다.'),
            array('줄눈 없는 마감', '틈새가 없는 판넬 결합 방식이라 곰팡이와 오염에 강합니다.'),
            array('방수·내수성', '방수 처리된 자재로 물이 스며들지 않아 습기가 많은 욕실에 적합합니다.'),
            array('쉬운 청소', '표면이 매끄러워 물때와 얼룩이 잘 붙지 않고 관리가 간편합니다.'),
        ),
        'materials' => array(
            array('라미네이트 타일', 'wall', 'laminate-tile', 'sub/product/pd_laminate_tile01.jpg', '대리석·테라조 등 다양한 패턴, 가볍고 빠른 시공'),
            array('라미네이트 판넬', 'wall', 'laminate-panel', 'sub/product/pd_laminate_panel02.jpg', '자작나무 7겹 합판, 줄눈 없는 판넬 결합 방식'),
        ),
    ),
    'kitchen' => array(
        'title'    => '주방 리모델링',
        'short'    => '주방',
        'en'       => 'Kitchen',
        'image'    => 'main/visual_slide/bg02.jpg',
        'thumb'    => 'main/visual_slide/bg02.jpg',
        'headline' => '기름때 걱정 없는<br>매끈한 주방 벽면.',
        'lead'     => '스크래치와 얼룩에 강한 라미네이트 마감으로 주방 벽을 새로 입히고, 짧은 공사로 주방을 다시 쓰는 날을 앞당깁니다.',
        'pains'    => array(
            '오래된 주방 벽 타일과 줄눈에 밴 기름때',
            '벽 하나 바꾸는데도 커지는 공사 규모',
            '공사하는 동안 식사를 해결하기 어려운 불편',
        ),
        'points'   => array(
            array('오염에 강한 표면', '스크래치와 얼룩에 강하고 표면이 매끄러워 청소가 쉽습니다.'),
            array('물에 강한 자재', '방수 처리가 되어 있어 물을 많이 쓰는 주방에도 적합합니다.'),
            array('다양한 텍스처', '대리석, 콘크리트, 우드 등 원하는 분위기를 고를 수 있습니다.'),
            array('빠른 시공', '파손 없이 재단이 쉽고 가벼워 공사 기간을 줄입니다.'),
        ),
        'materials' => array(
            array('라미네이트 판넬', 'wall', 'laminate-panel', 'sub/product/pd_laminate_panel01.jpg', '고강도 라미네이트 코팅, 스크래치·변색에 강함'),
            array('라미네이트 타일', 'wall', 'laminate-tile', 'sub/product/pd_laminate_tile02.jpg', '다양한 규격과 패턴, 기존 벽면에 부착'),
        ),
    ),
    'living' => array(
        'title'    => '거실·아트월',
        'short'    => '거실',
        'en'       => 'Living & Art Wall',
        'image'    => 'main/visual_slide/bg01.jpg',
        'thumb'    => 'main/visual_slide/bg04.jpg',
        'headline' => '거실의 분위기를 바꾸는<br>벽 한 면의 힘.',
        'lead'     => '나무·돌·세라믹 텍스처의 판넬로 아트월을 만들고, 원하면 흡음 타공보드로 음악·영화 감상 공간까지 완성합니다.',
        'pains'    => array(
            '밋밋하고 오래된 거실 벽',
            '아트월을 만들려면 합판·석고보드 공사가 부담',
            '접착제 냄새와 유해물질이 걱정',
        ),
        'points'   => array(
            array('고급스러운 텍스처', '나무, 돌, 세라믹 등 다양한 질감과 색상으로 원하는 분위기를 연출합니다.'),
            array('합판·석고보드 없이', '판넬 결합 방식으로 설치해 공사 시간을 줄입니다.'),
            array('접착제 없는 시공', '시공 시 접착제를 쓰지 않아 유해 물질로부터 안전합니다.'),
            array('변색 방지', '자외선에 의한 변색·변형을 막아 오래도록 처음 모습을 유지합니다.'),
        ),
        'materials' => array(
            array('라미네이트 판넬', 'wall', 'laminate-panel', 'sub/product/pd_laminate_panel03.jpg', '아트월에 어울리는 우드·스톤·콘크리트 패턴'),
            array('라인 타공보드', 'wall', 'prime-line', 'sub/product/pd_prime_line_panel01.jpg', '소음 저감·준불연, 음악·영화 감상실에 적합'),
        ),
    ),
    'whole' => array(
        'title'    => '전체 리모델링',
        'short'    => '전체',
        'en'       => 'Whole Home',
        'image'    => 'sub/sub_visual/interior-hd.jpg',
        'thumb'    => 'main/visual_slide/bg03.jpg',
        'headline' => '집 전체를 바꾸는 공사도,<br>짧고 조용하게.',
        'lead'     => '벽·바닥·천장까지 건식 자재로 시공해 공사 기간과 소음을 줄이고, 상담부터 준공까지 담당자가 함께합니다.',
        'pains'    => array(
            '긴 공사 기간 동안의 임시 거처와 이사 부담',
            '오래 이어지는 소음으로 인한 층간 민원',
            '여러 공정을 직접 챙겨야 하는 번거로움',
        ),
        'points'   => array(
            array('짧은 공사 기간', '건식 시공으로 공사 기간이 짧아 인건비 부담을 줄입니다.'),
            array('층간 소음 최소화', '큰 소음 없는 시공으로 이웃 간 불편을 덜어 드립니다.'),
            array('벽·바닥·천장 한 번에', '벽장재, 친환경 바닥재, 천장재까지 공간 전체를 함께 계획합니다.'),
            array('입주 전 마무리까지', '준공 후 잔손 작업과 베이크아웃을 진행한 뒤 공간을 인도합니다.'),
        ),
        'materials' => array(
            array('벽장재', 'wall', '', 'sub/product/pd_laminate_panel04.jpg', '라미네이트 판넬·타일, 타공보드'),
            array('바닥재', 'floor', '', 'sub/product/emotion_sheet01.jpg', '미끄럼 방지·친환경 인증 바닥재'),
            array('천장재', 'ceiling', '', 'sub/product/pd_natural_ceiling_panel01.jpg', '흡음·불연 천연 석고 천장재'),
        ),
    ),
);
