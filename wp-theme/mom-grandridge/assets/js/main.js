/* ═══════════════════════════════════════════════════════════
   M.O.M GRAND RIDGE SCHOOL — 3D scene + animations
   Three.js particle universe, GSAP ScrollTrigger effects,
   tilt cards, counters, sliders, nav.
   ═══════════════════════════════════════════════════════════ */

(function () {
  "use strict";

  var prefersReducedMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
  var isTouch = window.matchMedia("(hover: none)").matches;

  gsap.registerPlugin(ScrollTrigger);

  /* ══════════════ PRELOADER ══════════════ */
  var preloader = document.getElementById("preloader");
  var preloaderBar = document.getElementById("preloaderBar");
  var preloaderPct = document.getElementById("preloaderPct");
  var loadProgress = 0;

  var fakeLoad = setInterval(function () {
    loadProgress = Math.min(loadProgress + Math.random() * 22, 92);
    updateLoader(loadProgress);
  }, 160);

  function updateLoader(v) {
    preloaderBar.style.width = v + "%";
    preloaderPct.textContent = Math.round(v) + "%";
  }

  var loaderDone = false;
  function finishLoader() {
    if (loaderDone) return;
    loaderDone = true;
    clearInterval(fakeLoad);
    updateLoader(100);
    setTimeout(function () {
      preloader.classList.add("done");
      playHeroIntro();
    }, 350);
  }

  if (document.readyState === "complete") {
    setTimeout(finishLoader, 500);
  } else {
    window.addEventListener("load", function () { setTimeout(finishLoader, 400); });
    // Safety net: never keep users staring at the loader
    setTimeout(finishLoader, 4000);
  }

  /* ══════════════ THREE.JS — 3D PARTICLE UNIVERSE ══════════════ */
  var canvas = document.getElementById("bg3d");
  var scrollRatio = 0;
  var mouseX = 0, mouseY = 0;

  function initThree() {
    if (!window.THREE) return;

    var renderer;
    try {
      renderer = new THREE.WebGLRenderer({ canvas: canvas, alpha: true, antialias: true });
    } catch (e) {
      canvas.style.display = "none";
      return;
    }
    renderer.setPixelRatio(Math.min(window.devicePixelRatio, 2));
    renderer.setSize(window.innerWidth, window.innerHeight);

    var scene = new THREE.Scene();
    scene.fog = new THREE.FogExp2(0x070b1e, 0.055);

    var camera = new THREE.PerspectiveCamera(60, window.innerWidth / window.innerHeight, 0.1, 100);
    camera.position.z = 9;

    /* — Star/particle field (3 layers, brand colors) — */
    var particleGroups = [];
    var palettes = [0xffb324, 0x4fd867, 0x8b7bff];
    for (var l = 0; l < 3; l++) {
      var count = isTouch ? 500 : 900;
      var positions = new Float32Array(count * 3);
      for (var i = 0; i < count; i++) {
        positions[i * 3] = (Math.random() - 0.5) * 42;
        positions[i * 3 + 1] = (Math.random() - 0.5) * 42;
        positions[i * 3 + 2] = (Math.random() - 0.5) * 42;
      }
      var geo = new THREE.BufferGeometry();
      geo.setAttribute("position", new THREE.BufferAttribute(positions, 3));
      var mat = new THREE.PointsMaterial({
        color: palettes[l],
        size: 0.05 + l * 0.025,
        transparent: true,
        opacity: 0.75 - l * 0.15,
        blending: THREE.AdditiveBlending,
        depthWrite: false
      });
      var points = new THREE.Points(geo, mat);
      scene.add(points);
      particleGroups.push(points);
    }

    /* — Floating wireframe shapes — */
    var shapes = [];
    function addShape(geometry, color, x, y, z, speed) {
      var mesh = new THREE.Mesh(
        geometry,
        new THREE.MeshBasicMaterial({ color: color, wireframe: true, transparent: true, opacity: 0.28 })
      );
      mesh.position.set(x, y, z);
      mesh.userData.speed = speed;
      mesh.userData.baseY = y;
      scene.add(mesh);
      shapes.push(mesh);
    }
    addShape(new THREE.TorusKnotGeometry(1.15, 0.32, 90, 12), 0x8b7bff, -5.4, 2.2, -3, 0.5);
    addShape(new THREE.IcosahedronGeometry(1.05, 0), 0x4fd867, 5.2, -1.6, -2, 0.7);
    addShape(new THREE.OctahedronGeometry(0.85, 0), 0xffb324, 4.6, 2.8, -4, 0.9);
    addShape(new THREE.TorusGeometry(0.85, 0.24, 14, 44), 0xff9440, -4.8, -2.6, -3.5, 0.6);
    addShape(new THREE.DodecahedronGeometry(0.6, 0), 0x4da3ff, 0.5, 3.6, -6, 0.8);
    addShape(new THREE.TetrahedronGeometry(0.7, 0), 0xff8cdc, -1.8, -3.4, -5, 1.1);

    window.addEventListener("mousemove", function (e) {
      mouseX = (e.clientX / window.innerWidth) * 2 - 1;
      mouseY = -(e.clientY / window.innerHeight) * 2 + 1;
    }, { passive: true });

    window.addEventListener("resize", function () {
      camera.aspect = window.innerWidth / window.innerHeight;
      camera.updateProjectionMatrix();
      renderer.setSize(window.innerWidth, window.innerHeight);
    });

    var clock = new THREE.Clock();
    var running = true;
    document.addEventListener("visibilitychange", function () {
      running = !document.hidden;
      if (running) animate();
    });

    function animate() {
      if (!running) return;
      requestAnimationFrame(animate);
      var t = clock.getElapsedTime();

      particleGroups.forEach(function (p, idx) {
        p.rotation.y = t * 0.02 * (idx + 1);
        p.rotation.x = Math.sin(t * 0.04) * 0.12 * (idx + 1);
      });

      shapes.forEach(function (s) {
        s.rotation.x = t * 0.22 * s.userData.speed;
        s.rotation.y = t * 0.3 * s.userData.speed;
        s.position.y = s.userData.baseY + Math.sin(t * s.userData.speed) * 0.45;
      });

      // Scroll-driven camera journey + gentle mouse parallax
      var targetZ = 9 - scrollRatio * 5;
      var targetY = -scrollRatio * 3.2;
      camera.position.z += (targetZ - camera.position.z) * 0.05;
      camera.position.y += (targetY - camera.position.y) * 0.05;
      camera.position.x += (mouseX * 0.9 - camera.position.x) * 0.04;
      camera.rotation.x += (mouseY * 0.06 - camera.rotation.x) * 0.04;
      camera.rotation.y += (-mouseX * 0.06 - camera.rotation.y) * 0.04;

      renderer.render(scene, camera);
    }
    animate();
  }

  if (!prefersReducedMotion) initThree();
  else canvas.style.display = "none";

  /* ══════════════ SCROLL PROGRESS + NAV STATE + 3D SCROLL RATIO ══════════════ */
  var nav = document.getElementById("nav");
  var progressBar = document.getElementById("scrollProgress");
  var backTop = document.getElementById("backTop");

  function onScroll() {
    var max = document.documentElement.scrollHeight - window.innerHeight;
    scrollRatio = max > 0 ? window.scrollY / max : 0;
    progressBar.style.width = scrollRatio * 100 + "%";
    nav.classList.toggle("scrolled", window.scrollY > 40);
    backTop.classList.toggle("show", window.scrollY > 700);
  }
  window.addEventListener("scroll", onScroll, { passive: true });
  onScroll();

  backTop.addEventListener("click", function () {
    window.scrollTo({ top: 0, behavior: prefersReducedMotion ? "auto" : "smooth" });
  });

  /* ══════════════ CURSOR GLOW ══════════════ */
  var glow = document.getElementById("cursorGlow");
  if (!isTouch && !prefersReducedMotion) {
    window.addEventListener("mousemove", function (e) {
      gsap.to(glow, { left: e.clientX, top: e.clientY, duration: 0.6, ease: "power2.out" });
    }, { passive: true });
  }

  /* ══════════════ MOBILE NAV ══════════════ */
  var burger = document.getElementById("navBurger");
  var navLinks = document.getElementById("navLinks");
  burger.addEventListener("click", function () {
    burger.classList.toggle("open");
    navLinks.classList.toggle("open");
    document.body.style.overflow = navLinks.classList.contains("open") ? "hidden" : "";
  });
  navLinks.querySelectorAll("a").forEach(function (a) {
    a.addEventListener("click", function () {
      burger.classList.remove("open");
      navLinks.classList.remove("open");
      document.body.style.overflow = "";
    });
  });

  /* Active link highlighting */
  var sections = document.querySelectorAll("section[id]");
  var linkMap = {};
  navLinks.querySelectorAll(".nav-link").forEach(function (a) {
    linkMap[a.getAttribute("href").slice(1)] = a;
  });
  var sectionObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (entry.isIntersecting && linkMap[entry.target.id]) {
        navLinks.querySelectorAll(".nav-link").forEach(function (a) { a.classList.remove("active"); });
        linkMap[entry.target.id].classList.add("active");
      }
    });
  }, { rootMargin: "-45% 0px -45% 0px" });
  sections.forEach(function (s) { sectionObserver.observe(s); });

  /* ══════════════ HERO INTRO TIMELINE ══════════════ */
  function playHeroIntro() {
    if (prefersReducedMotion) {
      gsap.set(".hero-title .line > span, .reveal-hero", { opacity: 1, y: 0 });
      return;
    }
    var tl = gsap.timeline({ defaults: { ease: "power4.out" } });
    tl.from(".hero-title .line > span", {
        yPercent: 115, rotate: 4, duration: 1.1, stagger: 0.14
      })
      .to(".reveal-hero", {
        opacity: 1, y: 0, duration: 0.9, stagger: 0.12,
        startAt: { y: 30 }
      }, "-=0.6")
      .from(".nav", { y: -80, opacity: 0, duration: 0.8, clearProps: "all" }, "-=0.9");
  }
  gsap.set(".reveal-hero", { opacity: 0 });

  /* Gallery cards are server-rendered by template-parts/gallery.php from
     the gallery_photo custom post type — nothing to inject here. */

  /* ══════════════ SCROLL REVEALS ══════════════ */
  /* Driven by IntersectionObserver rather than ScrollTrigger so they are
     immune to layout shifts from late-loading images. */
  var revealEls = document.querySelectorAll(".reveal");
  if (!prefersReducedMotion) {
    gsap.set(revealEls, { opacity: 0, y: 56 });
    var revealObserver = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (!entry.isIntersecting) return;
        revealObserver.unobserve(entry.target);
        gsap.to(entry.target, { opacity: 1, y: 0, duration: 1, ease: "power3.out" });
      });
    }, { rootMargin: "0px 0px -10% 0px" });
    revealEls.forEach(function (el) { revealObserver.observe(el); });
  } else {
    gsap.set(revealEls, { opacity: 1 });
  }

  if (!prefersReducedMotion) {

    /* Parallax on about floating cards */
    gsap.utils.toArray("[data-speed]").forEach(function (el) {
      var speed = parseFloat(el.getAttribute("data-speed")) || 0.3;
      gsap.to(el, {
        y: function () { return -80 * speed; },
        ease: "none",
        scrollTrigger: { trigger: el, start: "top bottom", end: "bottom top", scrub: 1.2 }
      });
    });

    /* Hero content drifts up + fades as you scroll away */
    gsap.to(".hero-content", {
      y: -120, opacity: 0.25, ease: "none",
      scrollTrigger: { trigger: ".hero", start: "top top", end: "bottom 30%", scrub: true }
    });

    /* School Life — horizontal scroll (desktop) */
    var lifeTrack = document.getElementById("lifeTrack");
    if (window.innerWidth > 860 && lifeTrack) {
      var getScroll = function () { return lifeTrack.scrollWidth - window.innerWidth; };
      gsap.to(lifeTrack, {
        x: function () { return -getScroll(); },
        ease: "none",
        scrollTrigger: {
          trigger: ".life",
          start: "top top",
          end: function () { return "+=" + getScroll(); },
          pin: ".life-pin",
          scrub: 1,
          invalidateOnRefresh: true
        }
      });
    }

  }

  /* ══════════════ COUNTERS ══════════════ */
  var counters = document.querySelectorAll(".counter");
  var counterObserver = new IntersectionObserver(function (entries) {
    entries.forEach(function (entry) {
      if (!entry.isIntersecting) return;
      var el = entry.target;
      counterObserver.unobserve(el);
      var target = parseInt(el.getAttribute("data-target"), 10);
      if (prefersReducedMotion) { el.textContent = target; return; }
      var obj = { val: 0 };
      gsap.to(obj, {
        val: target, duration: 2, ease: "power2.out",
        onUpdate: function () { el.textContent = Math.round(obj.val); }
      });
    });
  }, { threshold: 0.5 });
  counters.forEach(function (c) { counterObserver.observe(c); });

  /* ══════════════ 3D TILT CARDS ══════════════ */
  if (!isTouch && !prefersReducedMotion) {
    document.querySelectorAll("[data-tilt]").forEach(function (card) {
      var bounds;
      card.addEventListener("mouseenter", function () { bounds = card.getBoundingClientRect(); });
      card.addEventListener("mousemove", function (e) {
        if (!bounds) bounds = card.getBoundingClientRect();
        var px = (e.clientX - bounds.left) / bounds.width - 0.5;
        var py = (e.clientY - bounds.top) / bounds.height - 0.5;
        gsap.to(card, {
          rotateY: px * 10, rotateX: -py * 10,
          transformPerspective: 900, transformOrigin: "center",
          duration: 0.5, ease: "power2.out"
        });
      });
      card.addEventListener("mouseleave", function () {
        gsap.to(card, { rotateY: 0, rotateX: 0, duration: 0.9, ease: "elastic.out(1, 0.5)" });
      });
    });
  }

  /* ══════════════ TESTIMONIAL SLIDER ══════════════ */
  var slides = document.querySelectorAll(".testi-slide");
  var dotsWrap = document.getElementById("testiDots");
  var current = 0;
  var timer;

  slides.forEach(function (_, i) {
    var b = document.createElement("button");
    b.setAttribute("aria-label", "Show testimonial " + (i + 1));
    if (i === 0) b.classList.add("active");
    b.addEventListener("click", function () { goTo(i); restart(); });
    dotsWrap.appendChild(b);
  });
  var dots = dotsWrap.querySelectorAll("button");

  function goTo(i) {
    slides[current].classList.remove("active");
    dots[current].classList.remove("active");
    current = (i + slides.length) % slides.length;
    slides[current].classList.add("active");
    dots[current].classList.add("active");
  }
  function restart() {
    clearInterval(timer);
    timer = setInterval(function () { goTo(current + 1); }, 5200);
  }
  if (!prefersReducedMotion) restart();

  /* ══════════════ LIGHTBOX (Gallery section photos only) ══════════════ */
  var lightbox = document.getElementById("lightbox");
  var lightboxImg = document.getElementById("lightboxImg");
  var lbItems = Array.prototype.slice.call(
    document.querySelectorAll("#life .life-photo")
  );
  var lbIndex = 0;

  function openLightbox(i) {
    lbIndex = (i + lbItems.length) % lbItems.length;
    lightboxImg.src = lbItems[lbIndex].src;
    lightboxImg.alt = lbItems[lbIndex].alt || "Mom Grandridge School photo";
    lightbox.classList.add("open");
    lightbox.setAttribute("aria-hidden", "false");
    document.body.style.overflow = "hidden";
  }
  function closeLightbox() {
    lightbox.classList.remove("open");
    lightbox.setAttribute("aria-hidden", "true");
    document.body.style.overflow = "";
  }

  lbItems.forEach(function (img, i) {
    img.classList.add("lb-zoom");
    img.addEventListener("click", function () { openLightbox(i); });
  });
  document.getElementById("lightboxClose").addEventListener("click", closeLightbox);
  document.getElementById("lightboxPrev").addEventListener("click", function () { openLightbox(lbIndex - 1); });
  document.getElementById("lightboxNext").addEventListener("click", function () { openLightbox(lbIndex + 1); });
  lightbox.addEventListener("click", function (e) { if (e.target === lightbox) closeLightbox(); });
  document.addEventListener("keydown", function (e) {
    if (!lightbox.classList.contains("open")) return;
    if (e.key === "Escape") closeLightbox();
    else if (e.key === "ArrowLeft") openLightbox(lbIndex - 1);
    else if (e.key === "ArrowRight") openLightbox(lbIndex + 1);
  });

  /* ══════════════ CONTACT FORM ══════════════
     The form posts to admin-post.php and the server redirects back with
     ?mgs_contact=success|error#contact; template-parts/contact.php reads
     that and renders the "Thank You" state server-side, adding a
     .form-success class to the form. JS here is cosmetic polish only —
     it is not what produces the success state. */
  var form = document.querySelector(".contact-form");
  if (form && form.classList.contains("form-success") && !prefersReducedMotion) {
    gsap.fromTo(form, { scale: 1 }, { scale: 1.02, duration: 0.18, yoyo: true, repeat: 1 });
  }

})();
