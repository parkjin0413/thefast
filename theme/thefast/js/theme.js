/* THE FAST theme script — 의존성 없음 (jQuery 불필요) */
(function () {
    'use strict';

    var doc = document;
    var body = doc.body;
    var reduceMotion = window.matchMedia && window.matchMedia('(prefers-reduced-motion: reduce)').matches;

    function $(sel, ctx) { return (ctx || doc).querySelector(sel); }
    function $$(sel, ctx) { return Array.prototype.slice.call((ctx || doc).querySelectorAll(sel)); }

    /* ---------- 헤더: 스크롤하면 흰 배경으로 고정 (숨기지 않음) ---------- */
    var header = $('#tfHeader');
    var topBtn = $('#tfTop');
    var ticking = false;

    function onScroll() {
        var y = window.pageYOffset;
        if (header) header.classList.toggle('is-scrolled', y > 10);
        if (topBtn) topBtn.classList.toggle('is-visible', y > 600);
        ticking = false;
    }
    window.addEventListener('scroll', function () {
        if (!ticking) { window.requestAnimationFrame(onScroll); ticking = true; }
    }, { passive: true });
    onScroll();

    if (topBtn) {
        topBtn.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: reduceMotion ? 'auto' : 'smooth' });
            var skip = $('.tf-logo a');
            if (skip) skip.focus({ preventScroll: true });
        });
    }

    /* ---------- 전체 메뉴 (드로어) ---------- */
    var burger = $('#tfBurger');
    var drawer = $('#tfDrawer');
    var dim = $('#tfDim');
    var closeBtn = $('#tfDrawerClose');
    var lastFocus = null;

    function focusables(el) {
        return $$('a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])', el).filter(function (n) { return n.offsetParent !== null; });
    }
    function openDrawer() {
        if (!drawer) return;
        lastFocus = doc.activeElement;
        drawer.hidden = false;
        dim.hidden = false;
        // 다음 프레임에 트랜지션 시작
        window.requestAnimationFrame(function () {
            drawer.classList.add('is-open');
            dim.classList.add('is-open');
        });
        body.classList.add('tf-lock');
        burger.setAttribute('aria-expanded', 'true');
        setTimeout(function () { closeBtn && closeBtn.focus(); }, 50);
    }
    function closeDrawer() {
        if (!drawer || !drawer.classList.contains('is-open')) return;
        drawer.classList.remove('is-open');
        dim.classList.remove('is-open');
        body.classList.remove('tf-lock');
        burger.setAttribute('aria-expanded', 'false');
        setTimeout(function () { drawer.hidden = true; dim.hidden = true; }, 400);
        if (lastFocus) lastFocus.focus();
    }
    if (burger && drawer) {
        burger.addEventListener('click', openDrawer);
        closeBtn && closeBtn.addEventListener('click', closeDrawer);
        dim && dim.addEventListener('click', closeDrawer);
        doc.addEventListener('keydown', function (e) {
            if (!drawer.classList.contains('is-open')) return;
            if (e.key === 'Escape') { closeDrawer(); return; }
            if (e.key === 'Tab') {
                var f = focusables(drawer);
                if (!f.length) return;
                if (e.shiftKey && doc.activeElement === f[0]) { e.preventDefault(); f[f.length - 1].focus(); }
                else if (!e.shiftKey && doc.activeElement === f[f.length - 1]) { e.preventDefault(); f[0].focus(); }
            }
        });
        $$('.tf-drawer__toggle', drawer).forEach(function (btn) {
            btn.addEventListener('click', function () {
                var li = btn.parentNode;
                var open = !li.classList.contains('is-open');
                li.classList.toggle('is-open', open);
                btn.setAttribute('aria-expanded', open ? 'true' : 'false');
            });
        });
        window.addEventListener('resize', function () { if (window.innerWidth > 1100) closeDrawer(); });
    }

    /* 서브 탭: 현재 탭이 보이도록 가로 스크롤 맞춤 */
    var lnbOn = $('.tf-lnb__link.is-active');
    if (lnbOn) { var lst = lnbOn.closest('.tf-lnb__list'); if (lst.scrollWidth > lst.clientWidth) lst.scrollLeft = Math.max(0, lnbOn.offsetLeft - 20); }

    /* GNB: ESC 로 하위메뉴 닫기 */
    $$('.tf-gnb__item').forEach(function (item) {
        item.addEventListener('keydown', function (e) {
            if (e.key === 'Escape') { var a = $('.tf-gnb__link', item); a && a.focus(); a && a.blur(); }
        });
    });

    /* ---------- 메인 히어로 영상 (1번 → 2번 → 1번 … 이어서 재생) ---------- */
    var hero = $('.tf-hero');
    if (hero) {
        var slides = $$('.tf-hero__slide', hero);
        var vids = slides.map(function (s) { return $('video', s); });
        var cur = 0;
        var paused = false;
        var bar = $('.tf-hero__bar i', hero);
        var counter = $('.tf-hero__count', hero);
        var toggle = $('.tf-hero__toggle', hero);
        var conn = navigator.connection || {};
        // 움직임 줄이기 · 데이터 절약 모드 · 영상 미지원이면 정지 이미지만 표시
        var canVideo = vids.length && vids[0] && typeof vids[0].play === 'function' && !reduceMotion && !conn.saveData;
        var isMobile = window.matchMedia && window.matchMedia('(max-width: 767px)').matches;
        var inView = true;

        function load(i) {
            var v = vids[i];
            if (!v || v.getAttribute('src')) return;
            v.src = v.getAttribute(isMobile ? 'data-src-mobile' : 'data-src-desktop');
            v.preload = 'auto';
            v.load();
        }
        function playCur() {
            if (paused || !inView || doc.hidden) return;
            var p = vids[cur].play();
            if (p && p.catch) p.catch(function () { /* 자동재생이 막히면 첫 장면(포스터)을 그대로 보여줌 */ });
        }
        function setBar() {
            if (!bar) return;
            var v = vids[cur];
            var r = v.duration ? Math.min(1, v.currentTime / v.duration) : 0;
            bar.style.transform = 'scaleX(' + r + ')';
        }
        function show(n) {
            var prev = cur;
            cur = (n + slides.length) % slides.length;
            load(cur);
            if (prev !== cur) {
                slides[prev].classList.remove('is-active');
                slides[cur].classList.add('is-active');
                setTimeout(function () { if (cur !== prev) vids[prev].pause(); }, 1300); // 겹쳐서 넘어간 뒤 이전 영상 정지
            }
            try { vids[cur].currentTime = 0; } catch (e) {}
            if (counter) counter.textContent = ('0' + (cur + 1)).slice(-2) + ' / ' + ('0' + slides.length).slice(-2);
            setBar();
            playCur();
        }
        function setPaused(p) {
            paused = p;
            hero.classList.toggle('is-paused', p);
            if (toggle) {
                toggle.setAttribute('aria-label', p ? '영상 재생' : '영상 정지');
                toggle.innerHTML = p ? '<span aria-hidden="true">&#9654;</span>' : '<span aria-hidden="true">&#10074;&#10074;</span>';
            }
            if (p) vids[cur].pause(); else playCur();
        }

        if (!canVideo) {
            hero.classList.add('is-static');
        } else {
            vids.forEach(function (v, i) {
                v.muted = true; // iOS 자동재생 조건
                v.addEventListener('ended', function () { if (i === cur) show(cur + 1); });
                v.addEventListener('timeupdate', function () {
                    if (i !== cur) return;
                    setBar();
                    // 절반쯤 재생되면 다음 영상을 미리 불러옴
                    if (v.duration && v.currentTime > v.duration / 2) load((cur + 1) % vids.length);
                });
                v.addEventListener('playing', function () { if (i === cur) hero.classList.add('is-playing'); });
            });
            $('.tf-hero__prev', hero) && $('.tf-hero__prev', hero).addEventListener('click', function () { show(cur - 1); });
            $('.tf-hero__next', hero) && $('.tf-hero__next', hero).addEventListener('click', function () { show(cur + 1); });
            toggle && toggle.addEventListener('click', function () { setPaused(!paused); });
            doc.addEventListener('visibilitychange', function () { if (doc.hidden) vids[cur].pause(); else playCur(); });
            // 화면 밖으로 스크롤하면 정지 (배터리·데이터 절약)
            if ('IntersectionObserver' in window) {
                new IntersectionObserver(function (en) {
                    inView = en[0].isIntersecting;
                    if (inView) playCur(); else vids[cur].pause();
                }, { threshold: 0.05 }).observe(hero);
            }
            show(0);
        }
    }

    /* ---------- 스크롤 등장 애니메이션 ---------- */
    var reveals = $$('.tf-reveal');
    if ('IntersectionObserver' in window && !reduceMotion) {
        var io = new IntersectionObserver(function (entries) {
            entries.forEach(function (en) {
                if (en.isIntersecting) { en.target.classList.add('is-in'); io.unobserve(en.target); }
            });
        }, { rootMargin: '0px 0px -10% 0px', threshold: 0.08 });
        reveals.forEach(function (el) { io.observe(el); });
    } else {
        reveals.forEach(function (el) { el.classList.add('is-in'); });
    }

    /* ---------- 탭 (WAI-ARIA tabs) ---------- */
    $$('[role="tablist"]').forEach(function (list) {
        var tabs = $$('[role="tab"]', list);
        function select(tab, focus) {
            tabs.forEach(function (t) {
                var on = t === tab;
                t.setAttribute('aria-selected', on ? 'true' : 'false');
                t.tabIndex = on ? 0 : -1;
                var panel = doc.getElementById(t.getAttribute('aria-controls'));
                if (panel) panel.hidden = !on;
            });
            if (focus) tab.focus();
            if (history.replaceState && tab.dataset.hash) history.replaceState(null, '', '#' + tab.dataset.hash);
        }
        tabs.forEach(function (tab, i) {
            tab.addEventListener('click', function () { select(tab); });
            tab.addEventListener('keydown', function (e) {
                var n = null;
                if (e.key === 'ArrowRight') n = tabs[(i + 1) % tabs.length];
                if (e.key === 'ArrowLeft') n = tabs[(i - 1 + tabs.length) % tabs.length];
                if (e.key === 'Home') n = tabs[0];
                if (e.key === 'End') n = tabs[tabs.length - 1];
                if (n) { e.preventDefault(); select(n, true); }
            });
        });
        // 주소의 #해시로 탭 열기
        var hash = location.hash.replace('#', '');
        var target = hash && tabs.filter(function (t) { return t.dataset.hash === hash; })[0];
        if (target) select(target);
    });

    /* ---------- 제품 이미지 갤러리 ---------- */
    $$('.tf-pgallery').forEach(function (g) {
        var main = $('.tf-pgallery__main img', g);
        $$('.tf-pgallery__thumbs button', g).forEach(function (btn, i, all) {
            btn.addEventListener('click', function () {
                main.src = btn.getAttribute('data-src');
                all.forEach(function (b) { b.setAttribute('aria-pressed', b === btn ? 'true' : 'false'); });
            });
        });
    });

    /* ---------- 이미지 확대 (색상 샘플) ---------- */
    var dialog = $('#tfDialog');
    if (dialog && typeof dialog.showModal === 'function') {
        var dImg = $('img', dialog);
        var dTitle = $('.tf-dialog__title', dialog);
        doc.addEventListener('click', function (e) {
            var btn = e.target.closest('[data-zoom]');
            if (!btn) return;
            e.preventDefault();
            dImg.src = btn.getAttribute('data-zoom');
            dImg.alt = btn.getAttribute('data-title') || '';
            dTitle.textContent = btn.getAttribute('data-title') || '';
            dialog.showModal();
        });
        $('.tf-dialog__close', dialog).addEventListener('click', function () { dialog.close(); });
        dialog.addEventListener('click', function (e) { if (e.target === dialog) dialog.close(); });
    }
})();
