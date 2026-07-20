<style>
/* ==========================================================================
   LITERARY & POETRY SHOWCASE (Classic Elegance & Modern Glow)
   ========================================================================== */

@import url('https://fonts.googleapis.com/css2?family=Amiri:ital,wght@0,400;0,700;1,400&family=Reem+Kufi:wght@500;700&display=swap');

:root {
    --bg-base: #07090e;
    --bg-surface: rgba(18, 15, 23, 0.75);
    --bg-sidebar: rgba(13, 11, 18, 0.85);
    
    /* Literary Gold & Vintage Accents */
    --gold-primary: #d4af37;
    --gold-glow: rgba(212, 175, 55, 0.25);
    --gold-light: #f3e5ab;
    --sepia-text: #e2d7c5;
    --text-muted: #8c8273;
    
    --border-glass: rgba(212, 175, 55, 0.15);
    --border-glass-active: rgba(212, 175, 55, 0.5);
    
    --font-poetry: 'Amiri', serif;
    --font-ui: 'Reem Kufi', sans-serif;
    
    --radius-card: 28px;
    --radius-sidebar-item: 16px;
}

/* SECTION BASE SETUP */
.poems-section {
    min-height: 100vh;
    padding: 80px 24px;
    background-color: var(--bg-base);
    font-family: var(--font-ui);
    direction: rtl;
    position: relative;
    overflow: hidden;
    color: var(--sepia-text);
    box-sizing: border-box;
    display: flex;
    align-items: center;
    justify-content: center;
        margin: -8px;
}

.poems-section * {
    box-sizing: border-box;
}

/* ATMOSPHERIC BACKGROUND */
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
    filter: blur(150px);
    opacity: 0.3;
    animation: orbFloat 25s infinite ease-in-out alternate;
}

.orb-1 {
    width: 600px;
    height: 600px;
    top: -100px;
    right: -100px;
    background: radial-gradient(circle, #8a6d3b 0%, rgba(0,0,0,0) 70%);
}

.orb-2 {
    width: 650px;
    height: 650px;
    bottom: -150px;
    left: -150px;
    background: radial-gradient(circle, #4a1525 0%, rgba(0,0,0,0) 70%);
    animation-delay: -8s;
}

.bg-vintage-mesh {
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(rgba(212, 175, 55, 0.05) 1px, transparent 0);
    background-size: 32px 32px;
    opacity: 0.6;
}

/* CONTAINER (SIDEBAR ON THE RIGHT) */
.poems-container {
    max-width: 1300px;
    width: 100%;
    margin: 0 auto;
    position: relative;
    z-index: 2;
    display: grid;
    grid-template-columns: 340px 1fr; /* Sidebar on Right in RTL */
    gap: 40px;
    align-items: start;
}

/* ==========================================================================
   SIDEBAR STYLES (RIGHT SIDE - RTL FIRST)
   ========================================================================== */
.poems-sidebar {
    grid-column: 1; /* Places Sidebar on the Right in RTL */
    background: var(--bg-sidebar);
    backdrop-filter: blur(24px);
    -webkit-backdrop-filter: blur(24px);
    border: 1px solid var(--border-glass);
    border-radius: 24px;
    padding: 28px 20px;
    position: sticky;
    top: 40px;
    box-shadow: 0 20px 50px rgba(0,0,0,0.6);
}

.sidebar-header {
    display: flex;
    align-items: center;
    gap: 12px;
    margin-bottom: 28px;
    padding-bottom: 16px;
    border-bottom: 1px solid var(--border-glass);
}

.sidebar-header svg {
    width: 24px;
    height: 24px;
    stroke: var(--gold-primary);
}

.sidebar-header h3 {
    font-size: 1.2rem;
    font-weight: 700;
    margin: 0;
    color: var(--gold-light);
    letter-spacing: 0.5px;
}

.poems-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
    list-style: none;
    padding: 0;
    margin: 0;
}

.poem-nav-item {
    padding: 16px 18px;
    border-radius: var(--radius-sidebar-item);
    background: rgba(255, 255, 255, 0.02);
    border: 1px solid transparent;
    color: var(--text-muted);
    font-size: 1.05rem;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    position: relative;
}

.poem-item-content {
    display: flex;
    align-items: center;
    gap: 12px;
}

.poem-item-icon {
    width: 20px;
    height: 20px;
    stroke: var(--text-muted);
    transition: stroke 0.3s ease;
}

.poem-nav-item:hover {
    background: rgba(212, 175, 55, 0.05);
    color: var(--gold-light);
    transform: translateX(-4px);
}

.poem-nav-item:hover .poem-item-icon {
    stroke: var(--gold-primary);
}

.poem-nav-item.active {
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.15), rgba(74, 21, 37, 0.3));
    border-color: var(--border-glass-active);
    color: var(--gold-primary);
    box-shadow: 
        0 10px 25px -5px var(--gold-glow),
        inset 0 1px 0 rgba(255, 255, 255, 0.1);
}

.poem-nav-item.active .poem-item-icon {
    stroke: var(--gold-primary);
}

.poem-nav-item .arrow-icon {
    width: 16px;
    height: 16px;
    stroke: var(--gold-primary);
    opacity: 0;
    transform: translateX(10px);
    transition: all 0.3s ease;
}

.poem-nav-item.active .arrow-icon {
    opacity: 1;
    transform: translateX(0);
}

/* ==========================================================================
   MAIN POEM DISPLAY CARD (LEFT SIDE)
   ========================================================================== */
.poem-display-card {
    grid-column: 2;
    background: var(--bg-surface);
    backdrop-filter: blur(30px);
    -webkit-backdrop-filter: blur(30px);
    border: 1px solid var(--border-glass);
    border-radius: var(--radius-card);
    padding: 60px 40px;
    position: relative;
    min-height: 540px;
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    box-shadow: 
        0 30px 80px -20px rgba(0, 0, 0, 0.9),
        inset 0 1px 0 rgba(212, 175, 55, 0.2);
    overflow: hidden;
}

/* LITERARY WATERMARK (FEATHER PEN SYMBOL) */
.poem-display-card::after {
    content: '';
    position: absolute;
    top: -20px;
    left: -20px;
    width: 220px;
    height: 220px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='rgba(212, 175, 55, 0.03)' stroke-width='1'%3E%3Cpath d='M20.24 12.24a6 6 0 0 0-8.49-8.49L3 13.5V21h7.5l9.74-9.76z'/%3E%3Cpath d='M16 8L2 22'/%3E%3Cpath d='M17.5 15H9'/%3E%3C/svg%3E");
    background-size: contain;
    background-repeat: no-repeat;
    pointer-events: none;
}

.poem-view-wrapper {
    width: 100%;
    display: flex;
    flex-direction: column;
    align-items: center;
}

/* CIRCULAR AUTHOR/POEM IMAGE WITH VINTAGE GOLD GLOW */
.poem-avatar-wrapper {
    position: relative;
    width: 150px;
    height: 150px;
    margin-bottom: 32px;
}

.poem-avatar-wrapper::before {
    content: '';
    position: absolute;
    inset: -6px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--gold-primary), #8a6d3b, #4a1525);
    opacity: 0.85;
    filter: blur(10px);
    transition: opacity 0.5s ease;
}

.poem-avatar-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    position: relative;
    z-index: 2;
    border: 3px solid var(--gold-primary);
    box-shadow: 0 15px 35px rgba(0,0,0,0.7);
}

/* POEM TITLE */
.main-poem-title {
    font-family: var(--font-poetry);
    font-size: 3.2rem;
    font-weight: 700;
    color: var(--gold-light);
    margin: 0 0 32px 0;
    line-height: 1.2;
    text-shadow: 0 4px 20px rgba(0,0,0,0.8);
    background: linear-gradient(180deg, #ffffff 0%, var(--gold-light) 60%, var(--gold-primary) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

/* POEM CONTENT / VERSES */
.main-poem-content {
    font-family: var(--font-poetry);
    font-size: 1.65rem;
    line-height: 2.3;
    color: var(--sepia-text);
    white-space: pre-line;
    max-width: 700px;
    margin: 0 0 40px 0;
    font-weight: 400;
}

/* LITERARY ACTION BUTTON */
.poem-action-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    padding: 14px 36px;
    border-radius: 100px;
    background: linear-gradient(135deg, rgba(212, 175, 55, 0.15), rgba(74, 21, 37, 0.4));
    border: 1px solid var(--border-glass-active);
    color: var(--gold-light);
    font-size: 1.05rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.4s ease;
    box-shadow: 0 10px 25px -5px var(--gold-glow);
}

.poem-action-btn:hover {
    background: linear-gradient(135deg, var(--gold-primary), #8a6d3b);
    color: #000000;
    transform: translateY(-3px);
    box-shadow: 0 15px 35px var(--gold-glow);
}

.poem-action-btn svg {
    width: 20px;
    height: 20px;
    stroke: currentColor;
}

/* ==========================================================================
   ANIMATION CLASSES (SMOOTH FADE & SLIDE)
   ========================================================================== */
.anim-slide-up {
    animation: slideUpFadeIn 0.75s cubic-bezier(0.16, 1, 0.3, 1) forwards;
}

.anim-fade-out {
    animation: fadeOutDown 0.4s cubic-bezier(0.7, 0, 0.84, 0) forwards;
}

@keyframes slideUpFadeIn {
    0% {
        opacity: 0;
        transform: translateY(45px) scale(0.97);
        filter: blur(10px);
    }
    100% {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0px);
    }
}

@keyframes fadeOutDown {
    0% {
        opacity: 1;
        transform: translateY(0) scale(1);
        filter: blur(0px);
    }
    100% {
        opacity: 0;
        transform: translateY(30px) scale(0.97);
        filter: blur(10px);
    }
}

@keyframes orbFloat {
    0% { transform: translate(0, 0) scale(1); }
    50% { transform: translate(60px, 80px) scale(1.15); }
    100% { transform: translate(-40px, -50px) scale(0.95); }
}

/* RESPONSIVE LAYOUT */
@media (max-width: 992px) {
    .poems-container {
        grid-template-columns: 1fr;
    }
    
    .poems-sidebar {
        grid-column: 1;
        position: static;
        order: 1;
    }
    
    .poem-display-card {
        grid-column: 1;
        order: 2;
        padding: 40px 20px;
    }
    
    .main-poem-title {
        font-size: 2.3rem;
    }
    
    .main-poem-content {
        font-size: 1.35rem;
    }
}
</style>

<section class="poems-section">
    <!-- AMBIENT VINTAGE LIGHTING -->
    <div class="bg-ambient-layer">
        <div class="ambient-orb orb-1"></div>
        <div class="ambient-orb orb-2"></div>
        <div class="bg-vintage-mesh"></div>
    </div>

    <div class="poems-container">
        
        <!-- SIDEBAR NAVIGATION (RIGHT SIDE IN RTL) -->
        <aside class="poems-sidebar">
            <div class="sidebar-header">
                <!-- Feather Pen Icon -->
                <svg viewBox="0 0 24 24" fill="none" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L3 13.5V21h7.5l9.74-9.76z"/>
                    <line x1="16" y1="8" x2="2" y2="22"/>
                    <line x1="17.5" y1="15" x2="9" y2="15"/>
                </svg>
                <h3>قائمة القصائد</h3>
            </div>

            <ul class="poems-list">
                @foreach ($poems as $index => $poem)
                    <li 
                        class="poem-nav-item {{ $index === 0 ? 'active' : '' }}"
                        data-title="{{ $poem->poem_title }}"
                        data-content="{{ $poem->poem_content }}"
                        data-image="{{ $poem->image ? asset('storage/' . $poem->image) : asset('images/profile.png') }}"
                        data-link="{{ $poem->poem_link ?? '' }}"
                        onclick="switchPoem(this)"
                    >
                        <div class="poem-item-content">
                            <!-- Unique Literary Icons Rotating Based on Index -->
                            @switch($index % 4)
                                @case(0)
                                    <!-- Quill / Feather -->
                                    <svg class="poem-item-icon" viewBox="0 0 24 24" fill="none" stroke-width="2">
                                        <path d="M20.24 12.24a6 6 0 0 0-8.49-8.49L3 13.5V21h7.5l9.74-9.76z"/>
                                    </svg>
                                    @break
                                @case(1)
                                    <!-- Book Icon -->
                                    <svg class="poem-item-icon" viewBox="0 0 24 24" fill="none" stroke-width="2">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20"/>
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z"/>
                                    </svg>
                                    @break
                                @case(2)
                                    <!-- Scroll / Paper Icon -->
                                    <svg class="poem-item-icon" viewBox="0 0 24 24" fill="none" stroke-width="2">
                                        <path d="M19 17h2c.6 0 1-.4 1-1V4c0-.6-.4-1-1-1H3c-.6 0-1 .4-1 1v12c0 .6.4 1 1 1h2"/>
                                        <path d="M7 17h10M7 21h10"/>
                                    </svg>
                                    @break
                                @default
                                    <!-- Candle / Flame Icon -->
                                    <svg class="poem-item-icon" viewBox="0 0 24 24" fill="none" stroke-width="2">
                                        <path d="M12 2c.8 2.3 2 3.5 2 5a2 2 0 0 1-4 0c0-1.5 1.2-2.7 2-5z"/>
                                        <path d="M7 22h10v-9a1 1 0 0 0-1-1H8a1 1 0 0 0-1 1v9z"/>
                                    </svg>
                            @endswitch

                            <span>{{ $poem->poem_title }}</span>
                        </div>

                        <svg class="arrow-icon" viewBox="0 0 24 24" fill="none" stroke-width="2.5">
                            <path d="M15 18l-6-6 6-6"/>
                        </svg>
                    </li>
                @endforeach
            </ul>
        </aside>

        <!-- MAIN POEM DISPLAY CARD (LEFT SIDE IN RTL) -->
        <div class="poem-display-card">
            
            @if(isset($poems) && count($poems) > 0)
                <div class="poem-view-wrapper anim-slide-up" id="poemDisplayArea">
                    
                    <!-- CIRCULAR POEM IMAGE -->
                    <div class="poem-avatar-wrapper">
                        <img 
                            id="poemImg" 
                            class="poem-avatar-img" 
                            src="{{ $poems[0]->image ? asset('storage/' . $poems[0]->image) : asset('images/profile.png') }}" 
                            alt="{{ $poems[0]->poem_title }}"
                        >
                    </div>

                    <!-- POEM TITLE -->
                    <h2 class="main-poem-title" id="poemTitle">
                        {{ $poems[0]->poem_title }}
                    </h2>

                    <!-- POEM CONTENT -->
                    <p class="main-poem-content" id="poemContent">{{ $poems[0]->poem_content }}</p>

                    <!-- OPTIONAL POEM LINK / AUDIO BUTTON -->
                    @if(!empty($poems[0]->poem_link))
                        <a id="poemLink" href="{{ $poems[0]->poem_link }}" target="_blank" class="poem-action-btn">
                            <!-- Ink & Quill Icon -->
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                                <path d="M12 19l7-7 3 3-7 7-3-3z"/>
                                <path d="M18 13l-1.5-7.5L2 2l3.5 14.5L13 18l5-5z"/>
                            </svg>
                            <span>استمع أو اقرأ المزيد</span>
                        </a>
                    @else
                        <a id="poemLink" href="#" target="_blank" class="poem-action-btn" style="display: none;">
                            <svg viewBox="0 0 24 24" fill="none" stroke-width="2">
                                <path d="M12 19l7-7 3 3-7 7-3-3z"/>
                            </svg>
                            <span>استمع أو اقرأ المزيد</span>
                        </a>
                    @endif

                </div>
            @else
                <div class="poem-view-wrapper">
                    <h2 class="main-poem-title">لا توجد قصائد حالياً</h2>
                </div>
            @endif

        </div>

    </div>
</section>

<!-- JAVASCRIPT ANIMATION ENGINE -->
<script>
function switchPoem(element) {
    if (element.classList.contains('active')) return;

    // 1. Update Active State in Sidebar
    document.querySelectorAll('.poem-nav-item').forEach(item => {
        item.classList.remove('active');
    });
    element.classList.add('active');

    // 2. Read Dataset Attributes
    const newTitle = element.getAttribute('data-title');
    const newContent = element.getAttribute('data-content');
    const newImage = element.getAttribute('data-image');
    const newLink = element.getAttribute('data-link');

    const displayArea = document.getElementById('poemDisplayArea');

    // 3. Trigger Smooth Fade-Out Animation
    displayArea.classList.remove('anim-slide-up');
    displayArea.classList.add('anim-fade-out');

    // 4. Swap Data and Trigger Slide-Up Animation
    setTimeout(() => {
        document.getElementById('poemTitle').textContent = newTitle;
        document.getElementById('poemContent').textContent = newContent;
        document.getElementById('poemImg').src = newImage;
        
        const linkBtn = document.getElementById('poemLink');
        if (newLink && newLink.trim() !== '') {
            linkBtn.href = newLink;
            linkBtn.style.display = 'inline-flex';
        } else {
            linkBtn.style.display = 'none';
        }

        // Remove Fade-Out & Apply Focus Slide-Up
        displayArea.classList.remove('anim-fade-out');
        displayArea.classList.add('anim-slide-up');
    }, 380);
}
</script>