-- =====================================================================
-- 더패스트 테마 초기 설정 SQL  (그누보드 5.6 / MariaDB 10.x)
-- 사용법: 카페24 phpMyAdmin(또는 DB 관리 도구)에서 그누보드 DB를 선택하고 실행
--   * 테이블 접두사가 g5_ 가 아니면 g5_ 를 모두 바꿔서 실행하세요.
--   * 그누보드 설치 시 기본으로 만들어지는 free 게시판 설정을 복사해 새 게시판을 만듭니다.
--   * 이미 같은 이름의 게시판이 있으면 해당 게시판은 건너뜁니다(INSERT IGNORE).
-- =====================================================================

SET NAMES utf8mb4;

-- 1. 테마 적용 + 사이트 제목 + FAQ 스킨
UPDATE g5_config SET
  cf_theme    = 'thefast',
  cf_title    = '더패스트',
  cf_faq_skin = 'theme/thefast',
  cf_mobile_faq_skin = 'theme/thefast';

-- 2. 게시판 생성 (free 게시판 설정을 복사한 뒤 값 변경)
DROP TEMPORARY TABLE IF EXISTS tf_tmp_board;
CREATE TEMPORARY TABLE tf_tmp_board AS SELECT * FROM g5_board WHERE bo_table = 'free' LIMIT 1;

-- 공통값
UPDATE tf_tmp_board SET
  gr_id = 'community', bo_device = 'both', bo_admin = '',
  bo_list_level = 1, bo_read_level = 1, bo_write_level = 10, bo_reply_level = 10, bo_comment_level = 10,
  bo_upload_level = 1, bo_download_level = 1, bo_html_level = 10, bo_link_level = 10,
  bo_use_category = 0, bo_category_list = '', bo_use_secret = 0, bo_use_dhtml_editor = 1,
  bo_use_sideview = 0, bo_use_file_content = 0, bo_use_good = 0, bo_use_nogood = 0,
  bo_use_list_view = 0, bo_use_list_content = 1, bo_use_email = 0, bo_use_sns = 0, bo_use_captcha = 0,
  bo_upload_count = 10, bo_upload_size = 10485760,
  bo_gallery_cols = 3, bo_gallery_width = 640, bo_gallery_height = 480,
  bo_mobile_gallery_width = 640, bo_mobile_gallery_height = 480,
  bo_image_width = 1040, bo_page_rows = 15, bo_mobile_page_rows = 15,
  bo_new = 72, bo_hot = 999999, bo_include_head = '_head.php', bo_include_tail = '_tail.php',
  bo_content_head = '', bo_content_tail = '', bo_mobile_content_head = '', bo_mobile_content_tail = '',
  bo_insert_content = '', bo_notice = '', bo_count_write = 0, bo_count_comment = 0;

-- 2-1. 시공사례
UPDATE tf_tmp_board SET bo_table = 'portfolio', bo_subject = '시공사례', bo_mobile_subject = '시공사례',
  bo_skin = 'theme/thefast_gallery', bo_mobile_skin = 'theme/thefast_gallery',
  bo_use_category = 1, bo_category_list = '주거공간|관공서|상업시설|기타시공',
  bo_upload_count = 20, bo_page_rows = 12, bo_mobile_page_rows = 12, bo_order = 1;
INSERT IGNORE INTO g5_board SELECT * FROM tf_tmp_board;

-- 2-2. 고객후기 (비회원도 작성 가능 · 자동등록방지 사용)
UPDATE tf_tmp_board SET bo_table = 'review', bo_subject = '고객 후기', bo_mobile_subject = '고객 후기',
  bo_skin = 'theme/thefast_gallery', bo_mobile_skin = 'theme/thefast_gallery',
  bo_use_category = 0, bo_category_list = '', bo_write_level = 1, bo_use_captcha = 1, bo_use_dhtml_editor = 0,
  bo_upload_count = 5, bo_page_rows = 12, bo_mobile_page_rows = 12, bo_order = 2;
INSERT IGNORE INTO g5_board SELECT * FROM tf_tmp_board;

-- 2-3. 리뷰 이벤트
UPDATE tf_tmp_board SET bo_table = 'event', bo_subject = '리뷰 이벤트', bo_mobile_subject = '리뷰 이벤트',
  bo_skin = 'theme/thefast_list', bo_mobile_skin = 'theme/thefast_list',
  bo_write_level = 10, bo_use_captcha = 0, bo_use_dhtml_editor = 1, bo_upload_count = 5, bo_page_rows = 15, bo_mobile_page_rows = 15, bo_order = 3;
INSERT IGNORE INTO g5_board SELECT * FROM tf_tmp_board;

-- 2-4. 더패스트 소식
UPDATE tf_tmp_board SET bo_table = 'news', bo_subject = '더패스트 소식', bo_mobile_subject = '더패스트 소식', bo_order = 4;
INSERT IGNORE INTO g5_board SELECT * FROM tf_tmp_board;

-- 2-5. 주요 실적
UPDATE tf_tmp_board SET bo_table = 'history', bo_subject = '주요 실적', bo_mobile_subject = '주요 실적', bo_page_rows = 20, bo_mobile_page_rows = 20, bo_order = 5;
INSERT IGNORE INTO g5_board SELECT * FROM tf_tmp_board;

-- 2-6. 상담문의 (비회원 작성 · 비밀글 무조건 · 답변은 관리자 댓글)
UPDATE tf_tmp_board SET bo_table = 'inquiry', bo_subject = '상담 문의', bo_mobile_subject = '상담 문의',
  bo_skin = 'theme/thefast_form', bo_mobile_skin = 'theme/thefast_form',
  bo_write_level = 1, bo_reply_level = 10, bo_comment_level = 10, bo_upload_level = 1,
  bo_use_secret = 2, bo_use_dhtml_editor = 0, bo_use_email = 1, bo_use_captcha = 1, bo_use_list_content = 0,
  bo_upload_count = 3, bo_upload_size = 10485760, bo_page_rows = 15, bo_mobile_page_rows = 15, bo_order = 6;
INSERT IGNORE INTO g5_board SELECT * FROM tf_tmp_board;

-- 2-7. 제휴문의
UPDATE tf_tmp_board SET bo_table = 'partner', bo_subject = '제휴 문의', bo_mobile_subject = '제휴 문의', bo_order = 7;
INSERT IGNORE INTO g5_board SELECT * FROM tf_tmp_board;

DROP TEMPORARY TABLE IF EXISTS tf_tmp_board;

-- 3. 게시판 글 테이블 생성 (그누보드 adm/sql_write.sql 과 동일 구조를 free 게시판에서 복사)
CREATE TABLE IF NOT EXISTS g5_write_portfolio LIKE g5_write_free;
CREATE TABLE IF NOT EXISTS g5_write_review    LIKE g5_write_free;
CREATE TABLE IF NOT EXISTS g5_write_event     LIKE g5_write_free;
CREATE TABLE IF NOT EXISTS g5_write_news      LIKE g5_write_free;
CREATE TABLE IF NOT EXISTS g5_write_history   LIKE g5_write_free;
CREATE TABLE IF NOT EXISTS g5_write_inquiry   LIKE g5_write_free;
CREATE TABLE IF NOT EXISTS g5_write_partner   LIKE g5_write_free;

-- 4. 자주하는 질문 (기존 홈페이지 내용 기반)
INSERT INTO g5_faq_master (fm_subject, fm_head_html, fm_tail_html, fm_mobile_head_html, fm_mobile_tail_html, fm_order)
SELECT '자주하는 질문', '', '', '', '', 0 FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM g5_faq_master WHERE fm_subject = '자주하는 질문');

SET @fm := (SELECT fm_id FROM g5_faq_master WHERE fm_subject = '자주하는 질문' ORDER BY fm_id LIMIT 1);

INSERT INTO g5_faq (fm_id, fa_subject, fa_content, fa_order)
SELECT @fm, '견적 문의 후 연락은 언제 받을 수 있나요?', '<p>홈페이지 상담 문의로 접수해 주시면 3일 이내에 담당자가 배정되어 시공 가능 여부와 대략적인 견적 금액을 안내해 드립니다. 급한 문의는 대표번호 031-868-8878로 연락 주세요.</p>', 1 FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM g5_faq WHERE fm_id = @fm AND fa_subject = '견적 문의 후 연락은 언제 받을 수 있나요?');

INSERT INTO g5_faq (fm_id, fa_subject, fa_content, fa_order)
SELECT @fm, '공사 중 소음이나 분진이 많이 발생하나요?', '<p>더패스트는 기존 벽면 위에 판넬을 결합하는 건식 시공 방식으로, 타일 철거나 미장 공사를 최소화합니다. 그래서 일반 공사에 비해 소음과 분진이 적고 공사 기간도 짧아 이웃 간 불편을 줄일 수 있습니다.</p>', 2 FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM g5_faq WHERE fm_id = @fm AND fa_subject = '공사 중 소음이나 분진이 많이 발생하나요?');

INSERT INTO g5_faq (fm_id, fa_subject, fa_content, fa_order)
SELECT @fm, '라미네이트 판넬은 욕실이나 주방에도 시공할 수 있나요?', '<p>네. 라미네이트 판넬과 타일은 방수 처리가 되어 있어 물이 스며들지 않고, 줄눈이 없어 곰팡이와 오염에 강합니다. 욕실, 주방처럼 습기가 많은 공간에도 적합합니다.</p>', 3 FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM g5_faq WHERE fm_id = @fm AND fa_subject = '라미네이트 판넬은 욕실이나 주방에도 시공할 수 있나요?');

INSERT INTO g5_faq (fm_id, fa_subject, fa_content, fa_order)
SELECT @fm, '찾아가는 길이 어떻게 되나요?', '<p>영업시간은 평일 08:00~17:00(점심 12:00~13:00)이며, 현장 업무로 부재 중일 수 있으니 방문 전 031-868-8878로 사전 예약을 권장드립니다.</p><p>주소: 경기도 양주시 천보산로71번길 22-17<br>대중교통: 마을버스 11번, 75번 ''관사앞'' 정류장 하차 후 도보 약 250m</p>', 4 FROM DUAL
WHERE NOT EXISTS (SELECT 1 FROM g5_faq WHERE fm_id = @fm AND fa_subject = '찾아가는 길이 어떻게 되나요?');
