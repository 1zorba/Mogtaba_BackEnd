<style>
/* ==========================================================================
   AWARDS-GRADE LUXURY SERVICES SECTION (Vercel / Apple / Linear Inspired)
   ========================================================================== */

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap');

:root {
    --bg-base: #02040a;
    --bg-surface: rgba(13, 16, 27, 0.55);
    --bg-surface-hover: rgba(22, 27, 46, 0.85);
    
    --brand-indigo: #6366f1;
    --brand-violet: #8b5cf6;
    --brand-cyan: #06b6d4;
    --brand-pink: #ec4899;
    
    --text-primary: #f8fafc;
    --text-secondary: #94a3b8;
    
    --border-glass: rgba(255, 255, 255, 0.08);
    --border-glass-hover: rgba(129, 140, 248, 0.45);
    
    --font-main: 'Plus Jakarta Sans', system-ui, -apple-system, BlinkMacSystemFont, sans-serif;
    --radius-card: 28px;
    --radius-icon: 20px;
}

/* SECTION BASE */
.services-section {
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

.services-section * {
    box-sizing: border-box;
}

/* AMBIENT BACKGROUND LIGHTING */
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
    left: -100px;
    background: radial-gradient(circle, var(--brand-indigo) 0%, rgba(0,0,0,0) 70%);
}

.orb-2 {
    width: 700px;
    height: 700px;
    bottom: -150px;
    right: -150px;
    background: radial-gradient(circle, var(--brand-violet) 0%, rgba(0,0,0,0) 70%);
    animation-delay: -7s;
}

.orb-3 {
    width: 500px;
    height: 500px;
    top: 40%;
    right: 30%;
    background: radial-gradient(circle, var(--brand-cyan) 0%, rgba(0,0,0,0) 70%);
    opacity: 0.25;
    animation-delay: -14s;
}

/* NOISE & MESH OVERLAY */
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
.services-container {
    max-width: 1300px;
    margin: 0 auto;
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

.services-title {
    font-size: 3.8rem;
    font-weight: 900;
    letter-spacing: -1.5px;
    line-height: 1.15;
    margin: 0 0 20px 0;
    color: #ffffff;
    text-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
    animation: titleEntrance 1s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.services-title span {
    background: linear-gradient(135deg, #a5b4fc 0%, #6366f1 50%, #c084fc 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    position: relative;
    display: inline-block;
}

.services-subtitle {
    font-size: 1.15rem;
    color: var(--text-secondary);
    max-width: 650px;
    margin: 0 auto;
    line-height: 1.8;
    font-weight: 400;
    animation: titleEntrance 1s cubic-bezier(0.16, 1, 0.3, 1) 0.15s forwards;
    opacity: 0;
}

/* GRID LAYOUT */
.services-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 32px;
    perspective: 1200px;
}

/* LUXURY SERVICE CARD WITH FOCUS-IN ANIMATION & DYNAMIC SHADOWS */
.service-card {
    background: var(--bg-surface);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border: 1px solid var(--border-glass);
    border-radius: var(--radius-card);
    padding: 40px 32px;
    position: relative;
    display: flex;
    flex-direction: column;
    opacity: 0;
    filter: blur(12px);
    transform: translateY(50px) scale(0.92) rotateX(6deg);
    animation: focusInEntrance 0.9s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    transition: transform 0.5s cubic-bezier(0.16, 1, 0.3, 1), 
                border-color 0.5s ease, 
                box-shadow 0.5s ease, 
                background 0.5s ease,
                filter 0.5s ease;
}

/* GLASS BORDER ACCENT */
.service-card::before {
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
    opacity: 0.5;
}

.service-card:hover {
    transform: translateY(-12px) scale(1.02) rotateX(0deg);
    border-color: var(--border-glass-hover);
    background: var(--bg-surface-hover);
    box-shadow: 
        0 30px 70px -15px rgba(0, 0, 0, 0.8),
        0 0 50px rgba(99, 102, 241, 0.3),
        inset 0 1px 0 rgba(255, 255, 255, 0.25);
    filter: blur(0px);
}

.service-card:hover::before {
    opacity: 1;
}

/* DYNAMIC ICON WRAPPER & GLOW SHADOWS */
.service-icon-wrapper {
    width: 72px;
    height: 72px;
    border-radius: var(--radius-icon);
    background: rgba(99, 102, 241, 0.1);
    border: 1px solid rgba(129, 140, 248, 0.25);
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 32px;
    position: relative;
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
    box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.25);
}

.service-icon-wrapper svg {
    width: 34px;
    height: 34px;
    stroke: #818cf8;
    transition: all 0.5s cubic-bezier(0.16, 1, 0.3, 1);
}

.service-card:hover .service-icon-wrapper {
    transform: scale(1.1) translateY(-4px) rotate(-4deg);
    background: linear-gradient(135deg, rgba(99, 102, 241, 0.25), rgba(139, 92, 246, 0.25));
    border-color: rgba(165, 180, 252, 0.5);
    box-shadow: 
        0 15px 35px -5px rgba(99, 102, 241, 0.5),
        0 0 25px rgba(139, 92, 246, 0.4);
}

.service-card:hover .service-icon-wrapper svg {
    stroke: #ffffff;
    transform: scale(1.08);
}

/* CARD CONTENT */
.service-title {
    color: #ffffff;
    font-size: 1.5rem;
    font-weight: 800;
    margin: 0 0 16px 0;
    line-height: 1.35;
    letter-spacing: -0.3px;
    transition: color 0.3s ease;
}

.service-card:hover .service-title {
    color: #c7d2fe;
}

.service-description {
    color: var(--text-secondary);
    line-height: 1.8;
    font-size: 0.98rem;
    margin: 0;
    font-weight: 400;
    flex-grow: 1;
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

/* FOCUS-IN ENTRANCE ANIMATION */
@keyframes focusInEntrance {
    0% {
        opacity: 0;
        filter: blur(16px);
        transform: translateY(60px) scale(0.88) rotateX(10deg);
    }
    100% {
        opacity: 1;
        filter: blur(0px);
        transform: translateY(0) scale(1) rotateX(0deg);
    }
}

@keyframes badgeGlow {
    0% { border-color: rgba(255, 255, 255, 0.12); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.3); }
    100% { border-color: rgba(129, 140, 248, 0.4); box-shadow: 0 4px 25px rgba(99, 102, 241, 0.3); }
}

/* RESPONSIVE DESIGN */
@media (max-width: 768px) {
    .services-section {
        padding: 80px 16px;
    }
    
    .services-title {
        font-size: 2.6rem;
    }
    
    .services-grid {
        grid-template-columns: 1fr;
        gap: 24px;
    }
}
</style>

<section class="services-section">
    <!-- CINEMATIC LIGHTING BACKGROUND -->
    <div class="bg-ambient-layer">
        <div class="ambient-orb orb-1"></div>
        <div class="ambient-orb orb-2"></div>
        <div class="ambient-orb orb-3"></div>
        <div class="bg-grid-mesh"></div>
    </div>

    <div class="services-container">
        <!-- HEADER SECTION -->
        <div class="header-wrapper">
            <div class="header-badge">
                <span class="badge-dot"></span>
                <span>خدماتي المتخصصة</span>
            </div>
            <h2 class="services-title">
                الخدمات التي <span>أقدمها</span>
            </h2>
            <p class="services-subtitle">
                أساعد العلامات التجارية والشركات في الوصول إلى جمهورها المستهدف
                من خلال حلول تسويقية احترافية ومحتوى إبداعي يحقق نتائج حقيقية.
            </p>
        </div>

        <!-- SERVICES GRID -->
        <div class="services-grid">
            @foreach ($userData->services as $index => $service)
                <div class="service-card" style="animation-delay: {{ ($index + 1) * 0.15 }}s;">
                    
                    <!-- DYNAMIC UNIQUE ICON WRAPPER -->
                    <div class="service-icon-wrapper">
                        @switch($index % 8)
                            @case(0)
                                <!-- Megaphone / Marketing Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M10.34 15.84c-.688-.06-1.386-.09-2.09-.09H5.25A2.25 2.25 0 013 13.5v-3a2.25 2.25 0 012.25-2.25h3c.704 0 1.402-.03 2.09-.09l.19-.017c.567-.05 1.139-.08 1.715-.08h1.222a2.25 2.25 0 012.25 2.25v6.5a2.25 2.25 0 01-2.25 2.25h-1.222c-.576 0-1.148-.03-1.715-.08l-.19-.017z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5a3.75 3.75 0 110 7.5M19.5 8.25a7.5 7.5 0 110 12" />
                                </svg>
                                @break
                            @case(1)
                                <!-- Chart / Growth Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 005.814-5.519l2.74-1.22M21 8.25V12m0-3.75h-3.75" />
                                </svg>
                                @break
                            @case(2)
                                <!-- Sparkles / Creative Content Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456z" />
                                </svg>
                                @break
                            @case(3)
                                <!-- Globe / Strategy Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9 9 0 100-18 9 9 0 000 18z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.6 9h16.8M3.6 15h16.8M12 3a15.3 15.3 0 014 9 15.3 15.3 0 01-4 9 15.3 15.3 0 01-4-9 15.3 15.3 0 014-9z" />
                                </svg>
                                @break
                            @case(4)
                                <!-- Target / Branding Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.042 21.672L13.684 16.6m0 0l-2.51 2.225.569-9.47 5.227 7.917-3.286-.672zm-7.518-.267A8.25 8.25 0 1120.25 10.5M8.288 14.212A5.25 5.25 0 1117.25 10.5" />
                                </svg>
                                @break
                            @case(5)
                                <!-- Layers / UI/UX Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6.429 9.75L2.25 12l4.179 2.25m0-4.5l5.571 3 5.571-3m-11.142 0L12 6.75l5.571 3m0 0l4.179 2.25-4.179 2.25m0 0l-5.571 3-5.571-3" />
                                </svg>
                                @break
                            @case(6)
                                <!-- Code / Tech Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75L22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3l-4.5 16.5" />
                                </svg>
                                @break
                            @default
                                <!-- Rocket / Launch Icon -->
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.8" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.59 14.37a6 6 0 01-5.84 7.38v-4.8m5.84-2.58a14.98 14.98 0 006.16-12.12A14.98 14.98 0 009.63 8.41m5.96 5.96a14.926 14.926 0 01-5.841 2.58m-.119-8.54a6 6 0 00-7.381 5.84h4.8m2.581-5.84a14.927 14.927 0 00-2.58 5.84m2.58-5.84a14.927 14.927 0 015.84 2.58" />
                                </svg>
                        @endswitch
                    </div>

                    <h3 class="service-title">
                        {{ $service->service_title }}
                    </h3>

                    <p class="service-description">
                        {{ $service->description }}
                    </p>

                </div>
            @endforeach
        </div>
    </div>
</section>