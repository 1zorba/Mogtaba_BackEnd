@extends('layouts.app')

@section('title','Mohammed Hameed | Portfolio')


@section('content')


<style>

/* ================= HERO ================= */


.hero{

min-height:100vh;

background:

radial-gradient(circle at top right,
rgba(99,102,241,.25),
transparent 35%),

radial-gradient(circle at bottom left,
rgba(14,165,233,.20),
transparent 35%),

#020617;


display:flex;

align-items:center;

overflow:hidden;

position:relative;


}



/* BACKGROUND CIRCLES */


.circle{

position:absolute;

border-radius:50%;

filter:blur(1px);

animation:float 8s infinite ease-in-out;


}



.circle.one{

width:300px;

height:300px;

background:
rgba(99,102,241,.15);

top:10%;

left:5%;


}



.circle.two{

width:250px;

height:250px;

background:
rgba(14,165,233,.15);

bottom:10%;

right:10%;

animation-delay:2s;


}



@keyframes float{


0%,100%{

transform:translateY(0);

}


50%{

transform:translateY(-40px);

}


}







.container-hero{


max-width:1200px;

margin:auto;

padding:40px 20px;

width:100%;


}



.hero-grid{


display:grid;

grid-template-columns:
repeat(2,1fr);


gap:80px;

align-items:center;


}





/* LEFT */


.hero-content{


animation:

slideLeft 1s ease;


}



@keyframes slideLeft{


from{

opacity:0;

transform:translateX(-80px);

}


to{

opacity:1;

transform:translateX(0);

}


}




.badge{


display:inline-flex;

align-items:center;

gap:10px;


padding:12px 22px;


border-radius:50px;


background:

rgba(99,102,241,.15);


border:

1px solid rgba(99,102,241,.3);


color:#a5b4fc;


backdrop-filter:blur(15px);


animation:pulse 3s infinite;


}




@keyframes pulse{


0%,100%{

box-shadow:
0 0 0 rgba(99,102,241,0);

}


50%{

box-shadow:
0 0 40px rgba(99,102,241,.4);

}


}






.hero-title{


font-size:70px;

font-weight:900;

line-height:1.1;

color:white;

margin-top:30px;


}



.hero-title span{


background:

linear-gradient(
90deg,
#818cf8,
#38bdf8
);


-webkit-background-clip:text;

color:transparent;


}




.hero-desc{


margin-top:30px;

font-size:20px;

line-height:2;

color:#94a3b8;

max-width:600px;


}




.buttons{


display:flex;

gap:20px;

margin-top:40px;


}




.btn-primary{


padding:15px 35px;


border-radius:15px;


background:

linear-gradient(
135deg,
#6366f1,
#8b5cf6
);


color:white;


transition:.4s;


}



.btn-primary:hover{


transform:
translateY(-8px);


box-shadow:

0 20px 40px
rgba(99,102,241,.4);


}




.btn-secondary{


padding:15px 35px;


border-radius:15px;


border:

1px solid #334155;


color:white;


transition:.4s;


}



.btn-secondary:hover{


background:#1e293b;


transform:
translateY(-8px);


}






/* IMAGE */


/* =========================
   PREMIUM PROFILE IMAGE
========================= */


.hero-image{

    position:relative;

    display:flex;

    justify-content:center;

    align-items:center;

    animation:slideRight 1.2s ease;

}




/* rotating border */

.image-ring{


    width:470px;

    height:470px;

    position:absolute;


    border-radius:50%;


    background:

    conic-gradient(
    #6366f1,
    #06b6d4,
    #8b5cf6,
    #6366f1
    );


    animation:

    rotateRing 8s linear infinite;


    padding:8px;


}




.image-ring::before{


    content:"";

    position:absolute;

    inset:8px;


    border-radius:50%;


    background:#020617;


}





@keyframes rotateRing{


from{

transform:rotate(0deg);

}


to{

transform:rotate(360deg);

}


}





/* Image Container */


.profile-container{


width:420px;

height:420px;


border-radius:50%;


overflow:hidden;


position:relative;


z-index:3;


animation:

floatImage 5s ease-in-out infinite;



border:

6px solid rgba(255,255,255,.15);


box-shadow:


0 0 50px

rgba(99,102,241,.5);


}





.profile{


width:100%;

height:100%;


object-fit:cover;


border-radius:50%;


transition:.5s;



}





.profile-container:hover .profile{


transform:

scale(1.1);


}






@keyframes floatImage{


0%,100%{

transform:

translateY(0px);

}


50%{


transform:

translateY(-25px);


}


}







/* Glow */


.image-glow{


position:absolute;
 

 
inset:-35px;



 


background:

linear-gradient(
45deg,
#6366f1,
#06b6d4
);


border-radius:50%;


filter:

blur(90px);


opacity:.45;


animation:

glowPulse 4s infinite;


}





@keyframes glowPulse{


0%,100%{

opacity:.3;

transform:scale(.9);

}


50%{

opacity:.7;

transform:scale(1.15);

}


}






/* Floating tech circles */


.orbit{


position:absolute;


width:55px;

height:55px;


border-radius:50%;


background:

rgba(255,255,255,.1);


backdrop-filter:blur(15px);


display:flex;


align-items:center;


justify-content:center;


font-size:25px;


z-index:5;



animation:

orbitMove 6s infinite linear;


}




.orbit.one{


top:20px;

right:40px;


}



.orbit.two{


bottom:40px;

left:30px;


animation-delay:2s;


}



.orbit.three{


top:50%;

left:-20px;


animation-delay:4s;


}




@keyframes orbitMove{


0%{

transform:

rotate(0deg)
translateX(20px)
rotate(0deg);


}



100%{

transform:

rotate(360deg)
translateX(20px)
rotate(-360deg);


}


}





@media(max-width:900px){


.image-ring{


width:330px;

height:330px;


}



.profile-container{


width:300px;

height:300px;


}


}



</style>




<style>
/* ==========================================================================
   AWARDS-GRADE HERO SECTION WITH MODERN SOCIAL & CV ACTIONS
   ========================================================================== */

@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap');

:root {
    --bg-base: #02040a;
    --bg-surface: rgba(13, 16, 27, 0.6);
    --brand-cyan: #38bdf8;
    --brand-indigo: #6366f1;
    --brand-violet: #8b5cf6;
    --brand-whatsapp: #25d366;
    --brand-facebook: #1877f2;
    
    --text-primary: #f8fafc;
    --text-secondary: #94a3b8;
    --border-glass: rgba(255, 255, 255, 0.08);
    --radius-full: 9999px;
}

.hero {
    min-height: 100vh;
    padding: 120px 24px;
    background-color: var(--bg-base);
    font-family: 'Plus Jakarta Sans', system-ui, -apple-system, sans-serif;
    position: relative;
    overflow: hidden;
    color: var(--text-primary);
    display: flex;
    align-items: center;
    justify-content: center;
    box-sizing: border-box;
}

.hero * {
    box-sizing: border-box;
}

/* BACKGROUND LIGHTING & ORBITS */
.hero .circle {
    position: absolute;
    border-radius: 50%;
    filter: blur(140px);
    opacity: 0.35;
    pointer-events: none;
    z-index: 0;
}

.hero .circle.one {
    width: 600px;
    height: 600px;
    top: -150px;
    left: -150px;
    background: radial-gradient(circle, var(--brand-indigo) 0%, transparent 70%);
}

.hero .circle.two {
    width: 600px;
    height: 600px;
    bottom: -150px;
    right: -150px;
    background: radial-gradient(circle, var(--brand-cyan) 0%, transparent 70%);
}

/* CONTAINER & GRID */
.container-hero {
    max-width: 1280px;
    width: 100%;
    margin: 0 auto;
    position: relative;
    z-index: 2;
}

.hero-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 60px;
    align-items: center;
}

/* CONTENT AREA */
.hero-content {
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.hero-content .badge {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 8px 18px;
    border-radius: var(--radius-full);
    background: rgba(255, 255, 255, 0.03);
    border: 1px solid rgba(255, 255, 255, 0.12);
    backdrop-filter: blur(16px);
    font-size: 0.85rem;
    font-weight: 600;
    color: #a5b4fc;
    letter-spacing: 0.5px;
    margin-bottom: 24px;
}

.hero-title {
    font-size: 3.8rem;
    font-weight: 900;
    line-height: 1.15;
    margin: 0 0 24px 0;
    color: #ffffff;
    letter-spacing: -1.5px;
}

.hero-title span {
    background: linear-gradient(135deg, #a5b4fc 0%, #6366f1 50%, #38bdf8 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.hero-desc {
    font-size: 1.15rem;
    color: var(--text-secondary);
    line-height: 1.8;
    margin: 0 0 36px 0;
    max-width: 540px;
}

/* MAIN BUTTONS */
.buttons {
    display: flex;
    align-items: center;
    gap: 16px;
    flex-wrap: wrap;
}

.btn-primary {
    padding: 16px 32px;
    border-radius: var(--radius-full);
    background: linear-gradient(135deg, var(--brand-indigo), var(--brand-violet));
    color: #ffffff;
    font-weight: 700;
    text-decoration: none;
    box-shadow: 0 10px 30px -5px rgba(99, 102, 241, 0.5);
    transition: all 0.3s ease;
}

.btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 15px 35px -5px rgba(99, 102, 241, 0.7);
}

.btn-secondary {
    padding: 16px 32px;
    border-radius: var(--radius-full);
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--border-glass);
    color: #ffffff;
    font-weight: 600;
    text-decoration: none;
    backdrop-filter: blur(16px);
    transition: all 0.3s ease;
}

.btn-secondary:hover {
    background: rgba(255, 255, 255, 0.1);
    border-color: rgba(255, 255, 255, 0.25);
    transform: translateY(-3px);
}

/* IMAGE & HERO RIGHT AREA */
.hero-image {
    position: relative;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
}

.profile-container {
    position: relative;
    width: 336px;
    height: 344px;
    border-radius: 50%;
    z-index: 2;
}

.image-glow {
    position: absolute;
    inset: -10px;
    border-radius: 50%;
    background: linear-gradient(135deg, var(--brand-cyan), var(--brand-indigo));
    filter: blur(25px);
    opacity: 0.6;
    z-index: 1;
}
.hero-desc {
    font-size: 1.1rem;
    color: var(--text-secondary);
    line-height: 1.8;
    margin: 0 0 32px 0;
    max-width: 520px;
    min-height: 60px; /* لمنع اهتزاز التصميم أثناء الكتابة */
}

/* مؤشر ينبض في نهاية النص أثناء الكتابة */
.hero-desc::after {
    content: '|';
    animation: blink 0.8s infinite;
    color: var(--brand-cyan);
    margin-left: 4px;
    font-weight: bold;
}

@keyframes blink {
    0%, 100% { opacity: 1; }
    50% { opacity: 0; }
}
.image-ring {
    position: absolute;
    inset: -12px;
    border-radius: 50%;
    border: 2px dashed rgba(255, 255, 255, 0.2);
    animation: rotateRing 30s linear infinite;
    z-index: 1;
}

.profile {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    position: relative;
    z-index: 2;
    border: 4px solid rgba(255, 255, 255, 0.15);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.8);
}

/* ORBITS */
.orbit {
    position: absolute;
    width: 48px;
    height: 48px;
    border-radius: 50%;
    background: rgba(13, 16, 27, 0.8);
    border: 1px solid var(--border-glass);
    backdrop-filter: blur(12px);
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.2rem;
    z-index: 3;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.5);
    animation: floatOrbit 6s ease-in-out infinite alternate;
}

.orbit.one { top: 0px; left: 40px; animation-delay: 0s; }
.orbit.two { bottom: 80px; right: 20px; animation-delay: -2s; }
.orbit.three { top: 40%; right: -10px; animation-delay: -4s; }

/* ==========================================================================
   NEW SOCIALS & CV CONTAINER (UNDER IMAGE)
   ========================================================================== */
.profile-actions-wrapper {
    display: flex;
    align-items: center;
    gap: 14px;
    /* margin-top: 36px; */
    /* z-index: 3; */
    background: rgba(13, 16, 27, 0.65);
    padding: 10px 18px;
    border-radius: var(--radius-full);
    border: 1px solid var(--border-glass);
    backdrop-filter: blur(20px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.5);
  margin-top:40px;

position:relative;

z-index:10;
}

.social-btn {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid var(--border-glass);
}

.social-btn.whatsapp:hover {
    background: var(--brand-whatsapp);
    color: #ffffff;
    box-shadow: 0 0 20px rgba(37, 211, 102, 0.5);
    transform: translateY(-4px);
}

.social-btn.facebook:hover {
    background: var(--brand-facebook);
    color: #ffffff;
    box-shadow: 0 0 20px rgba(24, 119, 242, 0.5);
    transform: translateY(-4px);
}

.cv-download-btn {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 22px;
    border-radius: var(--radius-full);
    background: linear-gradient(135deg, rgba(56, 189, 248, 0.15), rgba(99, 102, 241, 0.15));
    border: 1px solid rgba(56, 189, 248, 0.4);
    color: var(--brand-cyan);
    font-size: 0.9rem;
    font-weight: 700;
    text-decoration: none;
    transition: all 0.3s ease;
}

.cv-download-btn:hover {
    background: linear-gradient(135deg, var(--brand-cyan), var(--brand-indigo));
    color: #ffffff;
    box-shadow: 0 0 25px rgba(56, 189, 248, 0.5);
    transform: translateY(-3px);
}

.cv-download-btn svg, .social-btn svg {
    width: 20px;
    height: 20px;
    fill: currentColor;
}

/* KEYFRAMES */
@keyframes rotateRing {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

@keyframes floatOrbit {
    0% { transform: translateY(0); }
    100% { transform: translateY(-15px); }
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .hero-grid {
        grid-template-columns: 1fr;
        text-align: center;
    }

    .hero-content {
        align-items: center;
    }

    .hero-title {
        font-size: 2.8rem;
    }

    .hero-image {
        margin-top: 40px;
    }
}
</style>

<section class="hero">

    <!-- BACKGROUND AMBIENT GLOWS -->
    <div class="circle one"></div>
    <div class="circle two"></div>

    <div class="container-hero">
        <div class="hero-grid">

            <!-- CONTENT -->
            <div class="hero-content">
                <div class="badge">
                    ✨ Welcome To My Portfolio
                </div>

                <h1 class="hero-title">
                    <span>{{ Str::before($userData->name, ' ') }}</span>
                    {{ Str::after($userData->name, ' ') }}
                    <br>
                    <span>
                        {{ $userData->profile->borrow }}
                    </span>
                </h1>

            <!-- النص مع تأثير الظهور كلمة كلمة -->
<p class="hero-desc" id="typewriter-desc" data-text="{{ $userData->profile->bio }}"></p>

                <div class="buttons">
                   <a href="{{route('projects.show')}}" class="btn-primary">
                        View Projects 🚀
                    </a>

                    <a href="{{route('services.show')}}"  
 class="btn-secondary">
                       الخدمات
                    </a>
                </div>
            </div>

            <!-- IMAGE & SOCIAL/CV ACTIONS -->
           
<div class="hero-image">

    <div class="profile-wrapper">

        <div class="image-glow"></div>

        <div class="image-ring"></div>

        <div class="profile-container">
        <img class="profile" 
            src="{{ $userData->profile?->profile_image ? asset('storage/' . $userData->profile->profile_image) : asset('images/profile.png') }}" 
            alt="profile">
                 

        </div>

 

    </div>

  <style>
    .profile-wrapper{

    position:relative;

    width:420px;

    height:420px;

    display:flex;

    justify-content:center;

    align-items:center;

}
  </style>



            
                <!-- SOCIAL LINKS & CV DOWNLOAD (UNDER IMAGE) -->
                <div class="profile-actions-wrapper">
                    
                    <!-- WHATSAPP -->
                    @if(!empty($userData->profile->social_links2))
                        <a href="{{ $userData->profile->social_links2 }}" target="_blank" class="social-btn whatsapp" title="WhatsApp">
                            <svg viewBox="0 0 24 24">
                                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                            </svg>
                        </a>
                    @endif

                    <!-- FACEBOOK -->
                    @if(!empty($userData->profile->social_links))
                        <a href="{{ $userData->profile->social_links }}" target="_blank" class="social-btn facebook" title="Facebook">
                            <svg viewBox="0 0 24 24">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    @endif

                    <!-- CV DOWNLOAD -->
                    @if(!empty($userData->profile->cv_url))
                        <a href="{{ $userData->profile->cv_url }}" target="_blank" download class="cv-download-btn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="7 10 12 15 17 10"/>
                                <line x1="12" y1="15" x2="12" y2="3"/>
                            </svg>
                            <span>Download CV</span>
                        </a>
                    @endif

                </div>

            </div>

        </div>
    </div>

</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const descElement = document.getElementById('typewriter-desc');
    if (!descElement) return;

    // جلب النص الكامل وتفكيكه إلى كلمات
    const fullText = descElement.getAttribute('data-text') || '';
    const words = fullText.trim().split(/\s+/);
    
    let index = 0;
    const speed = 150; // السرعة بالمللي ثانية بين كل كلمة وأخرى

    function typeWord() {
        if (index < words.length) {
            // إضافة الكلمة مع مسافة
            descElement.innerHTML += (index === 0 ? '' : ' ') + words[index];
            index++;
            setTimeout(typeWord, speed);
        }
    }

    // بدء التأثير
    typeWord();
});
</script>

@endsection