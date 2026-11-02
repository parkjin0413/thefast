# 그누보드5 테마 제작 노트 (thefast — 인테리어 업체 홈페이지)

> 분당연세(bdys) 테마 제작 경험을 바탕으로 정리한 주의사항과 팁입니다.

---

## 1. 폴더 구조 기본

```
theme/{테마명}/
  readme.txt          ← 관리자 테마 목록에 표시될 정보 (Theme Name 등)
  theme.config.php    ← G5_THEME_DEVICE, 기본 스킨, 갤러리 썸네일 크기
  _common.php         ← include_once('../../common.php'); 한 줄
  head.sub.php / head.php / tail.php / tail.sub.php
  index.php           ← 메인
  {서브페이지}.php
  css/ js/ img/
  skin/board/{스킨명}/          ← PC 게시판 스킨
  mobile/skin/board/{스킨명}/   ← 모바일 게시판 스킨
```

- `readme.txt`가 없거나 형식이 틀리면 관리자 테마 목록에 아예 안 나옵니다.
- 폴더명은 영문 소문자로 하세요. URL과 스킨 목록에 그대로 노출됩니다.

## 2. 반응형 단일 테마로 갈 때

- 관리자 → 기본환경설정 → 접속(기기) 설정을 **"반응형"** 으로 두세요. 적응형으로 두면 모바일에서 `mobile/` 템플릿을 찾다가 빈 화면이 나올 수 있습니다.
- `theme.config.php`에서 `G5_THEME_DEVICE`는 비워두고, `head.php`에서 `G5_IS_MOBILE` 분기는 쓰지 마세요.
- **게시판 스킨은 예외입니다.** 반응형이어도 모바일 접속 시 `mobile/skin/board/{스킨명}/`을 먼저 찾습니다(`get_skin_path()`). 폴더가 없으면 기본 스킨으로 빠질 수 있습니다.
  - 그래서 모바일 쪽 PHP는 PC 파일을 부르는 한 줄짜리 프록시로 두세요. 이렇게 하면 PC만 고쳐도 모바일까지 자동으로 반영됩니다.
    ```php
    <?php if (!defined('_GNUBOARD_')) exit;
    include_once(G5_THEME_PATH.'/skin/board/스킨명/list.skin.php');
    ```
  - CSS와 img는 실제 파일로 복사해야 합니다. 스킨 URL 기준으로 불러오기 때문입니다.
- 관리자 → 게시판 편집에서 **PC 스킨과 모바일 스킨을 둘 다** 바꿔야 적용됩니다. 하나만 바꿔서 "모바일이 안 바뀐다"고 착각하기 쉽습니다.

## 3. head.sub / tail.sub 필수 요소

- `head.sub.php`: `$g5['title']` 처리, `$config['cf_add_meta']`, 그누보드 JS 변수(`g5_url`, `g5_bbs_url`, `g5_is_member` 등), jQuery, `common.js` 로드는 **빼면 안 됩니다**. 빼면 게시판 글쓰기, 에디터, 댓글이 깨집니다. 기본 테마 파일을 복사해서 추가만 하는 방식이 안전합니다.
- `tail.sub.php`: `run_event('tail_sub')`와 `html_end()`는 반드시 남겨두세요. `add_stylesheet()`/`add_javascript()`로 추가한 리소스가 이 함수에서 출력됩니다.
- OG 메타(`og:image` 1200×630 등)는 처음부터 넣으세요. 카카오톡 공유 카드는 캐시 때문에 나중에 고치면 반영이 늦습니다.

## 4. 서브페이지 만들기

```php
<?php
include_once('./_common.php');
$g5['title'] = '시공사례';
include_once(G5_THEME_PATH.'/head.php');
?>
... 본문 ...
<?php include_once(G5_THEME_PATH.'/tail.php'); ?>
```

- URL은 `/theme/{테마명}/xxx.php` 형태가 됩니다. 테마명을 나중에 바꾸면 관리자 메뉴 링크까지 전부 다시 고쳐야 하니, **테마명을 먼저 확정**하세요.
- 경로는 `G5_THEME_URL`, `G5_THEME_IMG_URL`, `G5_BBS_URL` 상수로 쓰세요. 하드코딩하면 도메인 이전 때 깨집니다.
- 상호, 전화, 주소, 사업자번호는 `site.config.php` 하나에 두고 `head.sub.php`에서 include하세요. bdys는 이 정보가 11개 파일에 흩어져 있었습니다.
- 같은 레이아웃이 반복되는 페이지(서비스 종류별 페이지 등)는 `inc/service_template.php` 하나에 데이터 배열을 넘기는 방식으로 만드세요. bdys는 13개 페이지를 복붙해서 디자인 수정 비용이 컸습니다.

## 5. 게시판 스킨 팁

- 기본 `basic` 또는 `gallery` 스킨을 복사해서 시작하세요. `list.skin.php`, `view.skin.php`, `write.skin.php`, `view_comment.skin.php`, `style.css`가 기본 세트입니다.
- CSS는 `add_stylesheet('<link ... href="'.$board_skin_url.'/style.css">', 0);`로 넣어야 head로 출력됩니다.
- `write.skin.php`의 hidden 필드, `fwrite_submit()`, 캡차, 에디터 관련 코드는 지우지 마세요. 디자인만 감싸는 방식으로 작업해야 저장 오류가 안 납니다.
- 확장필드 `wr_1~wr_10`(평수, 지역, 예산 등)은 관리자 → 게시판 편집 → "게시판 1~10"에도 설정해야 합니다. **어떤 필드를 몇 번에 쓸지 표로 먼저 정해두세요.**
- 저장 후 처리(메일 발송, 리다이렉트 등)는 스킨의 `write_update.skin.php`에서 합니다.
- 견적문의처럼 비공개여야 하는 게시판은 JS 리다이렉트에만 의존하지 마세요. 관리자 권한 설정(목록·읽기 레벨)이나 비밀글 강제처럼 **서버 쪽에서도 막아두세요.**
- 인테리어 시공사례에서 신경 쓸 부분:
  - `bo_category_list`(아파트|주택|상가 등)
  - 썸네일은 `get_list_thumbnail()`을 쓰고 크기는 `theme.config.php`에서 지정
  - 파일 첨부 개수와 용량 제한, 서버 `upload_max_filesize`도 미리 확인

### 확장필드 매핑표 (thefast 테마 확정본 — 실제 값은 theme/thefast/site.config.php 의 `$tf_board_fields`)

| 게시판 | 필드 | 용도 | 필수 |
|---|---|---|---|
| portfolio | wr_1 | 평수 | |
| portfolio | wr_2 | 지역 | |
| portfolio | wr_3 | 공사기간 | |
| portfolio | wr_4 | 공사범위 | |
| review | wr_1 | 시공 공간 | |
| review | wr_2 | 지역 | |
| inquiry (견적/상담) | wr_1 | 연락처 | ✅ |
| inquiry | wr_2 | 공간유형 (선택형) | ✅ |
| inquiry | wr_3 | 평수 | |
| inquiry | wr_4 | 예산대 (선택형) | |
| inquiry | wr_5 | 희망 시공시기 (선택형) | |
| inquiry | wr_6 | 시공 지역 | |
| partner | wr_1 | 연락처 | ✅ |
| partner | wr_2 | 회사명 | ✅ |
| partner | wr_3 | 제휴 유형 (선택형) | ✅ |

## 6. Tailwind / 모바일 주의점 (bdys에서 실제로 겪은 것)

- Tailwind CDN은 편하지만 운영 단계에서는 정적 빌드로 바꾸는 걸 고려하세요.
- **그누보드 기본 CSS와 충돌할 수 있습니다.** `default.css`의 `#hd`, `#container`, `ul`, `a` 같은 스타일이 섞입니다. 기본 테마 CSS는 최소로만 가져오세요.
- 탭이나 토글에서 `hover:` 클래스는 활성 상태로 바뀔 때 같이 교체하세요. 모바일에서는 터치 후 hover 상태가 남아서 활성 색을 덮어씁니다.
- 영상 위에 `bg-xxx/98` + `backdrop-blur`를 쓰면 일부 모바일 브라우저에서 비쳐 보입니다. 영상 위 오버레이 메뉴는 불투명 단색으로 하세요.
- 고정 헤더를 쓰면 히어로 상단 여백을 헤더 높이만큼 확보하세요.
- 영상에는 `poster` 이미지를 꼭 지정하세요. 모바일에서 재생 아이콘이 크게 뜨는 걸 막아줍니다.

## 7. 작업 방식 팁

- **로컬에 그누보드 실행 환경부터 만드세요** (XAMPP 또는 Docker). bdys의 가장 큰 병목은 실행 테스트 없이 FTP와 스크린샷으로 수정을 반복한 것이었습니다.
- 첫날부터 git을 쓰고, 실제 휴대폰 확인은 메인 + 서브 1개만 만든 시점에 바로 하세요.
- 그누보드 기본 테마와 스킨 원본, 그리고 `common.lib.php`·`board.php` 같은 코어 파일을 `_reference/`에 참고용으로 넣어두세요. 동작 규칙을 소스로 바로 확인할 수 있어서 추측 작업이 줄어듭니다.

## 8. 관리자 설정 체크리스트

- [ ] 환경설정 → 테마 설정에서 테마 적용
- [ ] 기본환경설정 → 접속(기기) 설정 "반응형"
- [ ] 게시판 생성 (시공사례, 견적문의, 후기 등)
- [ ] 게시판별 PC 스킨 / 모바일 스킨 둘 다 선택
- [ ] 게시판별 확장필드(wr_1~) 설정
- [ ] 게시판 권한 (견적문의: 목록·읽기는 관리자만)
- [ ] 파일 첨부 개수 및 용량 설정
- [ ] 메뉴설정에서 1차/2차 메뉴 등록
- [ ] 내용관리: 회사소개(company), 개인정보처리방침(privacy), 이용약관(provision)
- [ ] 관리자 메일 / 게시판 메일 알림 설정

## 9. 시작 순서

1. 사이트맵, 시공사례 카테고리, 견적문의 항목을 확정
2. 로컬 그누보드 설치 + git 초기화
3. 테마 뼈대 생성 + `site.config.php` 정리 + 브랜드 컬러와 폰트 지정
4. 메인 페이지와 시공사례 스킨을 먼저 만들고 PC·실제 휴대폰에서 확인
5. 나머지 서브페이지와 견적문의 스킨 작업
6. 관리자 설정 체크리스트 처리
