# 더패스트(THE FAST) 그누보드5 테마

카페24 호스팅 · 그누보드 5.6 · PHP 8.4 · MariaDB 10.x · UTF-8 기준 반응형 테마입니다.
기존 홈페이지(thefast21.com)의 사이트맵, 문구, 이미지, 제품 정보를 옮겨 새 디자인으로 만들었습니다.

보안 적용 내용과 서버·관리자 체크리스트는 [SECURITY.md](SECURITY.md) 를 참고하세요.

## 폴더 구성

```
theme/thefast/            ← 서버의 /theme/thefast/ 에 그대로 업로드
  site.config.php         ← 상호·연락처·메뉴·SEO·게시판 확장필드 (수정은 여기 한 곳에서)
  head.sub.php / head.php / tail.php / tail.sub.php / index.php
  page/                   ← 회사소개, 시공 프로세스, 오시는 길, 제품안내(벽장재·바닥재·천장재)
  inc/products.php        ← 제품 데이터 (제품 추가·수정은 이 파일만)
  inc/board/              ← 게시판 공통 보기/글쓰기/댓글 템플릿
  skin/board/thefast_gallery  ← 시공사례·고객후기 (카드형)
  skin/board/thefast_list     ← 소식·리뷰 이벤트·주요 실적 (목록형)
  skin/board/thefast_form     ← 상담문의·제휴문의 (신청서형, 비밀글)
  skin/faq/thefast            ← 자주하는 질문
  css/theme.css, css/board.css, js/theme.js, img/
_deploy/
  setup_boards.sql        ← 게시판 7개 + 테마 적용 + FAQ 를 한 번에 만드는 SQL
  root/                   ← (선택) 짧은 주소 파일, robots.txt
  htaccess_redirects.txt  ← 기존 .html 주소 → 새 주소 301 이동 규칙
_content/                 ← 기존 사이트의 이용약관·개인정보처리방침 (내용관리에 붙여넣기용)
_reference/               ← 그누보드 5.6.45 원본(기본 테마·코어 일부), 참고용 — 업로드 불필요
```

## 설치 순서

1. **그누보드 5.6 설치** (카페24 웹FTP 또는 FTP로 업로드 후 `/install` 실행)
2. **테마 업로드**: `theme/thefast` 폴더를 서버 `/theme/` 아래에 업로드
3. **게시판 일괄 생성**: 카페24 phpMyAdmin → 그누보드 DB 선택 → `_deploy/setup_boards.sql` 실행
   - 테마 적용, 게시판 7개(portfolio, review, event, news, history, inquiry, partner), FAQ 4개가 만들어집니다.
   - 테이블 접두사가 `g5_` 가 아니면 파일 안의 `g5_` 를 바꿔서 실행하세요.
   - SQL 대신 관리자 화면에서 직접 만들어도 됩니다. 아래 "게시판 설정표"를 따라 주세요.
4. **관리자 > 환경설정 > 테마설정**에서 "더패스트 THE FAST"가 적용됐는지 확인
5. **관리자 > 환경설정 > 내용관리**
   - `privacy`(개인정보처리방침), `provision`(이용약관)에 `_content/` 의 HTML 을 붙여넣기 (내용 검토 후)
6. **메일 알림**: 기본환경설정에서 메일 사용 + 관리자 메일 주소 입력 → 상담문의가 들어오면 메일로 받습니다.
7. **(선택) 짧은 주소**: `_deploy/root/` 의 파일을 사이트 루트에 올리고, `site.config.php` 의
   `TF_ROOT_PAGES` 를 `true` 로 바꾸면 `/about.php`, `/product.php?type=wall` 처럼 주소가 짧아집니다.
8. **(권장) 기존 주소 이전**: `_deploy/htaccess_redirects.txt` 내용을 루트 `.htaccess` 맨 위에 추가
   → 네이버·구글에 등록된 기존 `.html` 주소의 검색 순위가 새 주소로 넘어갑니다.

## 게시판 설정표 (SQL 을 쓰지 않을 때)

| 게시판 ID | 이름 | 스킨 (PC/모바일 동일) | 분류 | 글쓰기 권한 | 비밀글 | 에디터 |
|---|---|---|---|---|---|---|
| portfolio | 시공사례 | (테마) thefast_gallery | 주거공간\|관공서\|상업시설\|기타시공 | 관리자(10) | 미사용 | 사용 |
| review | 고객 후기 | (테마) thefast_gallery | – | 비회원(1) + 자동등록방지 | 미사용 | 미사용 |
| event | 리뷰 이벤트 | (테마) thefast_list | – | 관리자 | 미사용 | 사용 |
| news | 더패스트 소식 | (테마) thefast_list | – | 관리자 | 미사용 | 사용 |
| history | 주요 실적 | (테마) thefast_list | – | 관리자 | 미사용 | 사용 |
| inquiry | 상담 문의 | (테마) thefast_form | – | 비회원(1), 댓글=관리자 | **무조건** | **미사용** |
| partner | 제휴 문의 | (테마) thefast_form | – | 비회원(1), 댓글=관리자 | **무조건** | **미사용** |

- **시공사례 = 갤러리 게시판.** 직접 만드실 때는 아래만 맞춰 주세요.
  - 게시판 ID 를 `site.config.php` 의 `$tf_boards['portfolio']` 에 입력 (기본값 `portfolio`)
  - 스킨은 **(테마) thefast_gallery** 권장 (그누보드 기본 gallery 스킨도 동작은 하지만 디자인이 다릅니다)
  - 메뉴의 하위 분류는 게시판 관리의 **분류** 설정을 자동으로 읽어 만듭니다. 분류를 바꾸면 메뉴·메인·회사소개 링크가 함께 바뀌고, 분류를 쓰지 않으면 "시공사례" 하나로 표시됩니다.
  - 분류명별 메뉴 이름은 `site.config.php` 의 `$tf_portfolio_labels` 에서 정할 수 있습니다 (예: 주거공간 → 주거공간 인테리어).
  - 썸네일: 갤러리 이미지 폭 640 / 높이 480 (4:3). 첫 번째 첨부 이미지(없으면 본문 첫 이미지)가 대표 이미지가 됩니다.
- 상담문의 답변은 관리자가 **댓글**로 남기면 목록에 "답변완료"로 표시됩니다.
- 확장필드(평수, 지역, 연락처 등) 매핑은 `site.config.php` 의 `$tf_board_fields` 와 `NOTES.md` 표를 참고하세요.

## 꼭 확인·입력해 주세요

- [ ] `site.config.php` — 인스타그램/유튜브/카카오톡 채널 주소, 지도 좌표(`lat`, `lng`), 카카오맵 JavaScript 키(넣으면 카카오맵, 비우면 구글 지도)
- [ ] `site.config.php` — 네이버 서치어드바이저 / 구글 서치콘솔 소유확인 코드
- [ ] 리노륨 바닥재 규격 `2(mm) × 31(mm) × 11T` 는 기존 사이트 표기 그대로입니다. 실제 규격(예: 2m × 31m × 2.5T)을 확인해 `inc/products.php` 에서 수정하세요.
- [ ] 리노륨·천장재 특장점 일부는 기존 사이트에서 제목과 설명이 어긋나 있어 문맥에 맞게 짝을 다시 맞췄습니다. 제품 담당자 확인을 권장합니다.
- [ ] 개인정보처리방침은 기존 문서를 옮긴 것입니다. 상담 신청서에서 수집하는 항목(이름, 연락처, 시공 지역 등)이 반영되도록 검토하세요.

## 검색(SEO) — "더패스트" 한글 검색 기준

- 모든 페이지 제목이 `페이지명 | 더패스트` 형식, 메인은 `더패스트 | 빠르고 조용한 인테리어 리모델링 전문`
- 메인 `<h1>` 에 "더패스트 인테리어 리모델링" 포함, 업체 구조화 데이터(JSON-LD, 상호·별칭 THE FAST·주소·전화·영업시간)
- 페이지별 description / canonical / Open Graph(카카오톡 공유 이미지 1200×630) 자동 출력
- 사이트맵: `/theme/thefast/sitemap.php` (짧은 주소 사용 시 `/sitemap.php`) → 서치어드바이저·서치콘솔에 제출
- `_deploy/root/robots.txt` 를 루트에 올리면 사이트맵 위치가 검색엔진에 안내됩니다.

## 검증 결과 (로컬: 그누보드 5.6.45 + PHP 8.4.27 + MariaDB 10.11)

- PHP 8.4 문법 검사 전체 통과, 오류 표시 최대(E_ALL)로 비회원·관리자 화면 전체 경고 0건
- 비회원 상담문의·제휴문의 실제 등록 → 비밀글 강제, 확장필드 저장, 동의/필수항목 서버 검증 확인
- 관리자 글쓰기(첨부 이미지), 답변 댓글, 비밀글 비밀번호 확인 이동 확인
- HTML 표준 검사(html-validate) 13개 화면 오류 0건, 웹접근성 자동 검사(axe, WCAG 2.2 AA) 15개 화면 위반 0건
- 데스크톱(1440px) · 모바일(390px) 화면 확인, 가로 넘침 없음
