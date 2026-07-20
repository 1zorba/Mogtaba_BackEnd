<style>
/* ==========================================================================
   AWARDS-GRADE LUXURY DARK ENGINE (Vercel / Apple / Linear Inspired)
   ========================================================================== */

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap');

:root {
    --bg-base: #02040a;
    --bg-surface: rgba(13, 16, 27, 0.55);
    --bg-surface-hover: rgba(22, 27, 46, 0.75);
    
    --brand-indigo: #6366f1;
    --brand-violet: #8b5cf6;
    --brand-cyan: #06b6d4;
    --brand-pink: #ec4899;
    
    --text-primary: #f8fafc;
    --text-secondary: #94a3b8;
    --text-muted: #64748b;
    
    --border-glass: rgba(255, 255, 255, 0.08);
    --border-glass-hover: rgba(129, 140, 248, 0.35);
    
    --glow-primary: rgba(99, 102, 241, 0.25);
    --glow-intense: rgba(139, 92, 246, 0.45);
    
    --font-main: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    --radius-card: 28px;
    --radius-btn: 16px;
    --radius-modal: 32px;
}

/* BASE SETUP */
.projects-section {
    min-height: 100vh;
    padding: 120px 24px;
    background-color: var(--bg-base);
    font-family: var(--font-main);
    direction: rtl;
    position: relative;
    overflow: hidden;
    color: var(--text-primary);
    box-sizing: border-box;
    margin: -8px;
}

.projects-section * {
    box-sizing: border-box;
}

/* CINEMATIC ANIMATED CANVAS BACKGROUND */
.bg-ambient-layer {
    position: absolute;
    inset: 0;
    pointer-events: none;
    z-index: 0;
    overflow: hidden;
}

.ambient-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(140px);
    opacity: 0.45;
    animation: orbFloat 22s infinite ease-in-out alternate;
}

.orb-1 {
    width: 600px;
    height: 600px;
    top: -100px;
    right: -100px;
    background: radial-gradient(circle, var(--brand-indigo) 0%, rgba(0,0,0,0) 70%);
}

.orb-2 {
    width: 700px;
    height: 700px;
    bottom: -150px;
    left: -150px;
    background: radial-gradient(circle, var(--brand-violet) 0%, rgba(0,0,0,0) 70%);
    animation-delay: -7s;
}

.orb-3 {
    width: 500px;
    height: 500px;
    top: 40%;
    left: 30%;
    background: radial-gradient(circle, var(--brand-cyan) 0%, rgba(0,0,0,0) 70%);
    opacity: 0.25;
    animation-delay: -14s;
}

/* NOISE & GRID MESH OVERLAY */
.bg-grid-mesh {
    position: absolute;
    inset: 0;
    background-image: 
        linear-gradient(to right, rgba(255, 255, 255, 0.03) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(255, 255, 255, 0.03) 1px, transparent 1px);
    background-size: 60px 60px;
    mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, #000 30%, transparent 100%);
    -webkit-mask-image: radial-gradient(ellipse 80% 80% at 50% 50%, #000 30%, transparent 100%);
    opacity: 0.8;
}

/* CONTAINER */
.projects-container {
    max-width: 1300px;

    position: relative;
    z-index: 2;
}

/* HEADER TYPOGRAPHY */
.header-wrapper {
    text-align: center;
    margin-bottom: 90px;
    position: relative;
}

.header-badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    border-radius: 100px;
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(20px);
    font-size: 0.85rem;
    font-weight: 600;
    color: #a5b4fc;
    letter-spacing: 0.5px;
    margin-bottom: 24px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
    animation: badgeGlow 4s infinite alternate;
}

.header-badge .badge-dot {
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #818cf8;
    box-shadow: 0 0 10px #818cf8;
}

.projects-title {
    font-size: 4rem;
    font-weight: 900;
    letter-spacing: -1.5px;
    line-height: 1.1;
    margin: 0 0 20px 0;
    color: #ffffff;
    text-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    animation: titleEntrance 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.projects-title span {
    background: linear-gradient(135deg, #a5b4fc 0%, #6366f1 50%, #c084fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    position: relative;
    display: inline-block;
}

.projects-subtitle {
    font-size: 1.15rem;
    color: var(--text-secondary);
    max-width: 600px;
    margin: 0 auto;
    line-height: 1.6;
    font-weight: 400;
    animation: titleEntrance 1s cubic-bezier(0.16, 1, 0.3, 1) 0.15s forwards;
    opacity: 0;
}

/* GRID LAYOUT */
.projects-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(340px, 1fr));
    gap: 36px;
    perspective: 1200px;
}

/* ULTRA PREMIUM CARD */
.project-card {
    background: var(--bg-surface);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border: 1px solid var(--border-glass);
    border-radius: var(--radius-card);
    overflow: hidden;
    position: relative;
    display: flex;
    flex-direction: column;
    opacity: 0;
    transform: translateY(40px) rotateX(4deg);
    animation: cardEntrance 0.9s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), 
                border-color 0.5s ease, 
                box-shadow 0.5s ease, 
                background 0.5s ease;
    cursor: pointer;
}

.project-card:hover {
    transform: translateY(-12px) scale(1.015) rotateX(0deg);
    border-color: var(--border-glass-hover);
    background: var(--bg-surface-hover);
    box-shadow: 
        0 30px 60px -12px rgba(0, 0, 0, 0.75),
        0 0 40px rgba(99, 102, 241, 0.2),
        inset 0 1px 0 rgba(255, 255, 255, 0.2);
}

/* CARD INNER BORDER GLOW ACCENT */
.project-card::before {
    content: '';
    position: absolute;
    inset: 0;
    border-radius: var(--radius-card);
    padding: 1px;
    background: linear-gradient(135deg, rgba(255,255,255,0.2), transparent 40%, rgba(99,102,241,0.3));
    -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
    -webkit-mask-composite: xor;
    mask-composite: exclude;
    pointer-events: none;
    transition: opacity 0.5s ease;
    opacity: 0.6;
}

.project-card:hover::before {
    opacity: 1;
}

/* IMAGE CONTAINER & FX */
.image-wrapper {
    width: 100%;
    height: 250px;
    overflow: hidden;
    position: relative;
    background: #090d16;
}

.image-wrapper::after {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(13, 16, 27, 0.95) 0%, rgba(13, 16, 27, 0.2) 50%, transparent 100%);
    z-index: 1;
    transition: opacity 0.5s ease;
}

.project-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
    transition: transform 0.8s cubic-bezier(0.16, 1, 0.3, 1), filter 0.8s ease;
    filter: brightness(0.9) contrast(1.05);
}

.project-card:hover .project-image {
    transform: scale(1.1) translateY(-4px);
    filter: brightness(1.05) contrast(1.1);
}

/* CARD CONTENT */
.project-content {
    padding: 28px 30px 32px 30px;
    display: flex;
    flex-direction: column;
    flex-grow: 1;
    position: relative;
    z-index: 2;
}

.project-tag {
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    color: #818cf8;
    margin-bottom: 12px;
}

.project-content h2 {
    color: #ffffff;
    font-size: 1.5rem;
    font-weight: 800;
    margin: 0 0 14px 0;
    line-height: 1.3;
    letter-spacing: -0.3px;
    transition: color 0.3s ease;
}

.project-card:hover .project-content h2 {
    color: #c7d2fe;
}

.project-content p {
    color: var(--text-secondary);
    line-height: 1.7;
    font-size: 0.95rem;
    margin: 0 0 28px 0;
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
    font-weight: 400;
}

/* BUTTON SYSTEM */
.more-btn {
    margin-top: auto;
    width: 100%;
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.8), rgba(139, 92, 246, 0.8));
    color: #ffffff;
    border: 1px solid rgba(255, 255, 255, 0.2);
    padding: 14px 28px;
    border-radius: var(--radius-btn);
    font-size: 0.95rem;
    font-weight: 700;
    font-family: var(--font-main);
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.4);
    position: relative;
    overflow: hidden;
}

.more-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
    transition: left 0.6s ease;
}

.more-btn:hover::before {
    left: 100%;
}

.more-btn:hover {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    transform: translateY(-2px);
    box-shadow: 0 15px 35px -5px rgba(99, 102, 241, 0.6);
    border-color: rgba(255, 255, 255, 0.4);
}

.more-btn:active {
    transform: translateY(1px);
}

.btn-icon {
    width: 18px;
    height: 18px;
    transition: transform 0.3s ease;
    fill: currentColor;
}

.more-btn:hover .btn-icon {
    transform: translateX(-4px);
}

/* LUXURY GLASS MODAL */
.modal {
    position: fixed;
    inset: 0;
    background: rgba(2, 4, 10, 0.85);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    display: none;
    align-items: center;
    justify-content: center;
    z-index: 99999;
    padding: 24px;
    direction: rtl;
    opacity: 0;
    transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}

.modal.active {
    display: flex;
    opacity: 1;
}

.modal-box {
    width: 100%;
    max-width: 650px;
    background: rgba(15, 20, 32, 0.95);
    border: 1px solid rgba(255, 255, 255, 0.15);
    border-radius: var(--radius-modal);
    padding: 40px;
    color: #ffffff;
    position: relative;
    box-shadow: 
        0 40px 100px -20px rgba(0, 0, 0, 0.9),
        0 0 50px rgba(99, 102, 241, 0.25);
    transform: scale(0.85) translateY(30px);
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    overflow: hidden;
}

.modal.active .modal-box {
    transform: scale(1) translateY(0);
}

.modal-box::before {
    content: '';
    position: absolute;
    top: 0;
    right: 0;
    left: 0;
    height: 3px;
    background: linear-gradient(90deg, var(--brand-indigo), var(--brand-violet), var(--brand-cyan));
}

.modal-header-badge {
    display: inline-block;
    padding: 4px 12px;
    border-radius: 50px;
    background: rgba(99, 102, 241, 0.15);
    color: #818cf8;
    font-size: 0.8rem;
    font-weight: 700;
    margin-bottom: 16px;
    border: 1px solid rgba(99, 102, 241, 0.3);
}

.modal-box h2 {
    font-size: 2.2rem;
    font-weight: 800;
    margin: 0 0 20px 0;
    color: #ffffff;
    line-height: 1.2;
    letter-spacing: -0.5px;
}

.modal-box p {
    color: #cbd5e1;
    line-height: 1.85;
    font-size: 1.05rem;
    white-space: pre-line;
    margin-bottom: 32px;
    font-weight: 400;
}

.close-btn {
    position: absolute;
    top: 28px;
    left: 28px;
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--text-secondary);
    width: 44px;
    height: 44px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.3s ease;
}

.close-btn:hover {
    background: rgba(239, 68, 68, 0.2);
    border-color: rgba(239, 68, 68, 0.4);
    color: #ef4444;
    transform: rotate(90deg);
}

.close-btn svg {
    width: 20px;
    height: 20px;
    fill: currentColor;
}

/* KEYFRAME ANIMATIONS */
@keyframes orbFloat {
    0% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(60px, 80px) scale(1.15); }
    100% { transform: translate(-40px, -50px) scale(0.95); }
}

@keyframes titleEntrance {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

@keyframes cardEntrance {
    to {
        opacity: 1;
        transform: translateY(0) rotateX(0deg);
    }
}

@keyframes badgeGlow {
    0% { border-color: rgba(255, 255, 255, 0.12); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); }
    100% { border-color: rgba(129, 140, 248, 0.4); box-shadow: 0 4px 25px rgba(99, 102, 241, 0.3); }
}

/* RESPONSIVE DESIGN */
@media (max-width: 768px) {
    .projects-section {
        padding: 80px 16px;
    }
    
    .projects-title {
        font-size: 2.75rem;
    }
    
    .projects-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
    
    .modal-box {
        padding: 28px;
    }
    
    .modal-box h2 {
        font-size: 1.6rem;
    }
}
</style>

<section class="projects-section">
    <!-- CINEMATIC LIGHTING BACKGROUND -->
    <div class="bg-ambient-layer">
        <div class="ambient-orb orb-1"></div>
        <div class="ambient-orb orb-2"></div>
        <div class="ambient-orb orb-3"></div>
        <div class="bg-grid-mesh"></div>
    </div>

    <div class="projects-container">
        <!-- HEADER -->
        <div class="header-wrapper">
            <div class="header-badge">
                <span class="badge-dot"></span>
                <span>معرض الأعمال الفاخر</span>
            </div>
            <h1 class="projects-title">
                مشاريعي <span>الإبداعية</span>
            </h1>
            <p class="projects-subtitle">
                استكشف مجموعة متكاملة من الأعمال والحلول البرمجية المصممة بأعلى معايير الجودة العالمية والتكنولوجيا الحديثة.
            </p>
        </div>

        <!-- GRID -->
        <div class="projects-grid">
            @foreach ($userData->projects as $index => $project)
                <div class="project-card" style="animation-delay: {{ ($index + 1) * 0.15 }}s;">
                    <div class="image-wrapper">
                        <img 
                            class="project-image" 
                            src="{{ $project->image_url ? asset('storage/' . $project->image_url) : asset('images/profile.png') }}" 
                            alt="{{ $project->title }}"
                            loading="lazy"
                        >
                    </div>
                    <div class="project-content">
                        <span class="project-tag">مشروع إبداعي</span>
                        <h2>{{ $project->title }}</h2>
                        <p>{{ $project->description }}</p>
                        <button 
                            class="more-btn"
                            data-title="{{ $project->title }}"
                            data-description="{{ $project->description }}"
                            onclick="openProject(this)"
                        >
                            <span>تفاصيل المشروع</span>
                            <svg class="btn-icon" viewBox="0 0 24 24">
                                <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- MODAL -->
<div class="modal" id="projectModal">
    <div class="modal-box">
        <button class="close-btn" onclick="closeProject()" aria-label="إغلاق">
            <svg viewBox="0 0 24 24">
                <path d="M19 6.41L17.59 5 12 10.59 6.41 5 5 6.41 10.59 12 5 17.59 6.41 19 12 13.41 17.59 19 19 17.59 13.41 12z"/>
            </svg>
        </button>
        <span class="modal-header-badge">نظرة عامة</span>
        <h2 id="modalTitle"></h2>
        <p id="modalDescription"></p>
    </div>
</div>

<script>
function openProject(buttonElement) {
    const title = buttonElement.getAttribute('data-title');
    const description = buttonElement.getAttribute('data-description');
    
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalDescription').textContent = description;
    
    const modal = document.getElementById('projectModal');
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}

function closeProject() {
    const modal = document.getElementById('projectModal');
    modal.classList.remove('active');
    document.body.style.overflow = '';
}

// Close modal when clicking outside the box
window.onclick = function(event) {
    const modal = document.getElementById('projectModal');
    if (event.target === modal) {
        closeProject();
    }
};

// Close on Escape key press
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeProject();
    }
});
</script>