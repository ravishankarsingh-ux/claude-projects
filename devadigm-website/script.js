// Devadigm — constellation particle field, in the spirit of the Dala hero visualization.

const PALETTE = ['#8052ff', '#ffb829', '#15846e', '#ff5fa8', '#4f8bff', '#a37bff'];

function rand(min, max) {
  return Math.random() * (max - min) + min;
}

function pickColor() {
  return PALETTE[Math.floor(Math.random() * PALETTE.length)];
}

/**
 * Draws a small outlined triangle particle.
 */
function drawTriangle(ctx, x, y, size, rotation, color, alpha) {
  ctx.save();
  ctx.translate(x, y);
  ctx.rotate(rotation);
  ctx.globalAlpha = alpha;
  ctx.strokeStyle = color;
  ctx.lineWidth = 1.2;
  ctx.beginPath();
  ctx.moveTo(0, -size);
  ctx.lineTo(size * 0.87, size * 0.5);
  ctx.lineTo(-size * 0.87, size * 0.5);
  ctx.closePath();
  ctx.stroke();
  ctx.restore();
}

/**
 * Generates points roughly filling a "brain-ish" blob: two overlapping
 * lobes defined implicitly, sampled via rejection sampling within an ellipse
 * union so the cloud reads as an organic rounded shape rather than a circle.
 */
function brainShapePoints(count, w, h) {
  const points = [];
  const cx = w / 2;
  const cy = h / 2;
  const rx = w * 0.42;
  const ry = h * 0.36;

  while (points.length < count) {
    const angle = rand(0, Math.PI * 2);
    const radius = Math.pow(Math.random(), 0.5);
    let x = Math.cos(angle) * radius * rx;
    let y = Math.sin(angle) * radius * ry;

    // organic wobble so the silhouette isn't a perfect ellipse
    const wobble = 1 + 0.18 * Math.sin(angle * 5) + 0.1 * Math.cos(angle * 3 + 1.3);
    x *= wobble;
    y *= wobble;

    points.push({ x: cx + x, y: cy + y });
  }
  return points;
}

class ParticleField {
  constructor(canvas, opts = {}) {
    this.canvas = canvas;
    this.ctx = canvas.getContext('2d');
    this.mode = opts.mode || 'shape'; // 'shape' = brain cloud, 'ambient' = scattered field
    this.density = opts.density || 260;
    this.particles = [];
    this.resize();
    this.build();
    window.addEventListener('resize', () => {
      this.resize();
      this.build();
    });
    this.animate = this.animate.bind(this);
    requestAnimationFrame(this.animate);
  }

  resize() {
    const rect = this.canvas.getBoundingClientRect();
    const dpr = Math.min(window.devicePixelRatio || 1, 2);
    this.width = rect.width || this.canvas.parentElement.clientWidth;
    this.height = rect.height || this.canvas.parentElement.clientHeight;
    this.canvas.width = this.width * dpr;
    this.canvas.height = this.height * dpr;
    this.ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
  }

  build() {
    this.particles = [];
    const count = this.density;

    let positions;
    if (this.mode === 'shape') {
      positions = brainShapePoints(count, this.width, this.height);
    }

    for (let i = 0; i < count; i++) {
      let x, y;
      if (this.mode === 'shape') {
        x = positions[i].x;
        y = positions[i].y;
      } else {
        x = rand(0, this.width);
        y = rand(0, this.height);
      }

      this.particles.push({
        x, y,
        baseX: x,
        baseY: y,
        size: rand(2, 5),
        rotation: rand(0, Math.PI * 2),
        spin: rand(-0.004, 0.004),
        color: pickColor(),
        alpha: rand(0.25, 0.9),
        phase: rand(0, Math.PI * 2),
        driftSpeed: rand(0.0006, 0.0016),
        driftAmp: rand(4, 14),
      });
    }
  }

  animate(t) {
    const ctx = this.ctx;
    ctx.clearRect(0, 0, this.width, this.height);

    for (const p of this.particles) {
      p.rotation += p.spin;
      const dx = Math.sin(t * p.driftSpeed + p.phase) * p.driftAmp;
      const dy = Math.cos(t * p.driftSpeed * 0.8 + p.phase) * p.driftAmp;
      drawTriangle(ctx, p.baseX + dx, p.baseY + dy, p.size, p.rotation, p.color, p.alpha);
    }

    requestAnimationFrame(this.animate);
  }
}

function initHeroConstellation() {
  const canvas = document.getElementById('brain-constellation');
  if (!canvas) return;
  new ParticleField(canvas, { mode: 'shape', density: 900 });
}

function initMiniConstellations() {
  document.querySelectorAll('.mini-constellation').forEach((canvas) => {
    const density = parseInt(canvas.dataset.density, 10) || 240;
    new ParticleField(canvas, { mode: 'shape', density });
  });
}

function initAmbientField() {
  const canvas = document.getElementById('ambient-field');
  if (!canvas) return;

  const ctx = canvas.getContext('2d');
  let particles = [];

  function resize() {
    const dpr = Math.min(window.devicePixelRatio || 1, 2);
    canvas.width = window.innerWidth * dpr;
    canvas.height = document.body.scrollHeight * dpr;
    canvas.style.width = window.innerWidth + 'px';
    canvas.style.height = document.body.scrollHeight + 'px';
    ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
    build();
  }

  function build() {
    const count = Math.floor((window.innerWidth * document.body.scrollHeight) / 60000);
    particles = [];
    for (let i = 0; i < count; i++) {
      particles.push({
        x: rand(0, window.innerWidth),
        y: rand(0, document.body.scrollHeight),
        size: rand(1.5, 3.5),
        rotation: rand(0, Math.PI * 2),
        spin: rand(-0.002, 0.002),
        color: pickColor(),
        alpha: rand(0.08, 0.28),
      });
    }
  }

  function animate() {
    ctx.clearRect(0, 0, window.innerWidth, document.body.scrollHeight);
    for (const p of particles) {
      p.rotation += p.spin;
      drawTriangle(ctx, p.x, p.y, p.size, p.rotation, p.color, p.alpha);
    }
    requestAnimationFrame(animate);
  }

  resize();
  window.addEventListener('resize', resize);
  requestAnimationFrame(animate);
}

document.addEventListener('DOMContentLoaded', () => {
  initHeroConstellation();
  initMiniConstellations();
  initAmbientField();
});
