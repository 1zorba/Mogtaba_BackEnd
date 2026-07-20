@extends('layouts.dashboard')

@section('title','البروفايل الشخصي')
@section('page-title','البروفايل')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
        --accent-color: #4f46e5;
        --accent-glow: rgba(79, 70, 229, 0.4);
        --success-color: #10b981;
        --success-glow: rgba(16, 185, 129, 0.4);
        --bg-glass: rgba(255, 255, 255, 0.9);
        --text-dark: #0f172a;
        --text-gray: #ffffff;
        --border-color: #e2e8f0;
    }

    /* أنيميشن دخول الصفحة */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes pulseGlow {
        0%, 100% { box-shadow: 0 0 10px var(--success-glow); }
        50% { box-shadow: 0 0 25px var(--success-color); }
    }

    /* الحاوية الرئيسية مع أنيميشن الدخول */
    .profile-page-container {
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        font-family: 'Cairo', sans-serif;
        direction: rtl;
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    /* 1. رأس الصفحة المطور (HEADER CARD) */
    .profile-header-card {
        background-color: #313276;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        border: 1px solid var(--border-color);
        position: relative;
    }

    .profile-cover {
        height: 180px;
        background: var(--primary-gradient);
        position: relative;
        overflow: hidden;
    }

    /* خلفية الغلاف المتحركة بنبضات ضوئية خفيفة */
    .profile-cover::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 60%);
        animation: spinBg 20s linear infinite;
    }

    @keyframes spinBg {
        100% { transform: rotate(360deg); }
    }

    .profile-main {
        padding: 0 40px 30px;
        display: flex;
        align-items: flex-end;
        gap: 30px;
        margin-top: -80px;
        position: relative;
        z-index: 5;
    }

    /* تأثيرات الأنيميشن على الصورة الشخصية والكاميرا */
    .profile-avatar {
        position: relative;
        width: 150px;
        height: 150px;
    }

    .profile-avatar img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        border: 6px solid #fff;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.12);
        object-fit: cover;
        transition: transform 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    .profile-avatar:hover img {
        transform: scale(1.05) rotate(1deg);
    }

    .change-image {
        position: absolute;
        bottom: 5px;
        right: 5px;
        background: var(--accent-color);
        color: white;
        border: none;
        width: 38px;
        height: 38px;
        border-radius: 50%;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        transition: all 0.3s;
    }

    .profile-avatar:hover .change-image {
        transform: rotate(360deg) scale(1.1);
        background: #312e81;
    }

    .profile-info {
        flex: 1;
        padding-bottom: 10px;
    }

    .profile-info h1 {
        font-size: 1.8rem;
        font-weight: 800;
        color: white;
        margin-bottom: 8px;
    }

    .job_title {
        display: inline-block;
        background: #e0e7ff;
        color: var(--accent-color);
        padding: 4px 14px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 700;
        margin-left: 10px;
    }

    .email {
        font-size: 0.9rem;
        color: var(--text-gray);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .profile-info p {
        margin-top: 15px;
        color: var(--text-gray);
        font-size: 0.95rem;
        line-height: 1.7;
        max-width: 700px;
    }

    /* تنسيق زر التحكم التفاعلي بالشرط الجديد */
    .profile-actions {
        margin-bottom: 15px;
    }

    .action-btn {
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 700;
        font-size: 0.95rem;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .btn-create {
        background: var(--success-color);
        color: white;
        animation: pulseGlow 2s infinite;
    }

    .btn-create:hover {
        background: #059669;
        transform: translateY(-2px);
    }

    .btn-edit {
        background: var(--accent-color);
        color: white;
    }

    .btn-edit:hover {
        background: #312e81;
        box-shadow: 0 6px 20px var(--accent-glow);
        transform: translateY(-2px);
    }

    /* 2. الإحصائيات (STATS SECTION) */
    .profile-stats {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 20px;
    }

    .stat-card {
background: rgba(99, 102, 241, 0.3);        
border-radius: 16px;
        padding: 24px;
        text-align: center;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        border: 1px solid var(--border-color);
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.1);
    }

    /* حركة الارتفاع والظلال الفاخرة عند التمرير */
    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(79, 70, 229, 0.08);
        border-color: var(--accent-color);
    }

    .stat-card i {
        font-size: 2rem;
        margin-bottom: 15px;
        display: inline-block;
        transition: transform 0.3s ease;
    }

    .stat-card:hover i {
        transform: scale(1.2) rotate(5deg);
    }

    /* تلوين أيقونات الإحصائيات بالتناسق */
    .stat-card:nth-child(1) i { color: #3b82f6; }
    .stat-card:nth-child(2) i { color: #ec4899; }
    .stat-card:nth-child(3) i { color: #10b981; }

    .stat-card h3 {
        font-size: 2rem;
        font-weight: 800;
        color: white;
        margin: 5px 0;
    }

    .stat-card span {
        font-size: 0.9rem;
        color: var(--text-gray);
        font-weight: 600;
    }

    /* 3. شبكة تفاصيل العرض الجديدة (DETAILS GRID) */
    .profile-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 25px;
    }

    .info-card {
        background: #313276;;
        border-radius: 18px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        border: 1px solid var(--border-color);
    }

    .info-card h3 {
        font-size: 1.2rem;
        font-weight: 800;
        color: white;
        margin-bottom: 25px;
        position: relative;
        padding-right: 15px;
    }

    .info-card h3::before {
        content: '';
        position: absolute;
        right: 0;
        top: 50%;
        transform: translateY(-50%);
        width: 5px;
        height: 18px;
        background: var(--accent-color);
        border-radius: 4px;
    }

    /* فكرة العرض للمعلومات الشخصية (مستوحاة من كروت التعريف الرقمية) */
    .info-item-modern {
        display: flex;
        align-items: center;
        gap: 15px;
        background: #f8fafc;
        padding: 14px 18px;
        border-radius: 12px;
        margin-bottom: 12px;
        border: 1px solid #f1f5f9;
        transition: all 0.3s;
    }

    .info-item-modern:hover {
        background: #f1f5f9;
        transform: translateX(-5px);
    }

    .info-item-modern .info-icon {
        width: 40px;
        height: 40px;
        background: white;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--accent-color);
        box-shadow: 0 2px 6px rgba(0,0,0,0.05);
    }

    .info-item-modern .info-text {
        display: flex;
        flex-direction: column;
    }

    .info-item-modern .info-label {
        font-size: 0.8rem;
        color:black
    }

    .info-item-modern .info-value {
        font-size: 0.95rem;
        font-weight: 700;
        color:#949292;
    }

    /* فكرة العرض للمهارات (Animated Progress bars) */
    .skill-progress-bar {
        margin-bottom: 20px;
    }

    .skill-info {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }

    .skill-name {
        font-weight: 700;
        font-size: 0.9rem;
        color: white;
    }

    .skill-percent {
        font-size: 0.85rem;
        font-weight: 700;
        color: white;
    }

    .progress-track {
        height: 8px;
        background: #f1f5f9;
        border-radius: 10px;
        overflow: hidden;
        position: relative;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--accent-color) 0%, #818cf8 100%);
        border-radius: 10px;
        transition: width 1.5s cubic-bezier(0.1, 1, 0.1, 1);
        width: 0; /* سنعطيها العرض المطلوب وتتحرك تلقائياً */
    }

    /* شاشات الجوال */
    @media (max-width: 768px) {
        .profile-main {
            flex-direction: column;
            align-items: center;
            text-align: center;
            margin-top: -60px;
            padding: 20px;
        }
        .profile-info {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .profile-stats {
            grid-template-columns: 1fr;
        }
        .profile-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="profile-page-container">

<div class="profile-card">
    <!-- الغلاف -->
    <div class="profile-cover"></div>

    <div class="profile-body">
        <!-- الصورة -->
        <div class="profile-avatar-wrap">
            <div class="avatar-ring"></div>
            <img src="{{ $user->profile?->profile_image ? asset('storage/' . $user->profile->profile_image) : asset('images/profile.png') }}" alt="profile">
            <button class="btn-camera" title="تحديث الصورة">
                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M23 19a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h4l2-3h6l2 3h4a2 2 0 0 1 2 2z"></path><circle cx="12" cy="13" r="4"></circle></svg>
            </button>
        </div>

        <!-- المعلومات -->
        <div class="profile-info">
            <h1>{{ $user->name }}</h1>
            
            <div class="badges">
                <span class="badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="4 17 10 11 4 5"></polyline><line x1="12" y1="19" x2="20" y2="19"></line></svg>
                    {{ $user->profile?->job_title ?? 'Full Stack Developer' }}
                </span>
                <span class="badge">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>
                    {{ $user->email }}
                </span>
            </div>

            @if($user->profile?->borrow)
            <div class="skills-bar">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
                {{ $user->profile->borrow }}
            </div>
            @endif
            @if($user->profile?->bio)
            <div class="skills-bar">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle ></circle><line x1="14.31" y1="8" x2="20.05" y2="17.94"></line><line x1="9.69" y1="8" x2="21.17" y2="8"></line><line x1="7.38" y1="12" x2="13.12" y2="2.06"></line><line x1="9.69" y1="16" x2="3.95" y2="6.06"></line><line x1="14.31" y1="16" x2="2.83" y2="16"></line><line x1="16.62" y1="12" x2="10.88" y2="21.94"></line></svg>
                {{ $user->profile->bio }}
            </div>
            @endif

            <div class="channels">
                @if($user->profile?->phone)
                <span class="phone">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                    {{ $user->profile->phone }}
                </span>
                @endif

                @if($user->profile?->social_links)
                  <i class="fa-solid fa-facebook"></i>

                </a>
                @endif

                @if($user->profile?->social_links2)
                <a href="{{ $user->profile->social_links2 }}" target="_blank" class="channel whatsApp" title="whatsApp">
                    <i class="fa fa-whatsApp"></i>
                   <i class="fa-solid fa-whatsApp"></i>

                </a>
                @endif

                @if($user->profile?->cv_url)
                <a href="{{ $user->profile->cv_url }}" target="_blank" class="cv-btn">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>
                    وثيقة الـ CV
                </a>
                @endif
            </div>
        </div>

        <!-- زر التعديل -->
        <div class="profile-actions">
            @if(is_null($user->profile))
                <button class="btn-action btn-create">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="16"></line><line x1="8" y1="12" x2="16" y2="12"></line></svg>
                    انشاء ملف جديد
                </button>
            @else
                 <button id="openProfileModal" class="action-btn btn-edit">
                        <i class="fa-solid fa-user-gear"></i>
                        تعديل البروفايل
                    </button>
            @endif
        </div>
    </div>
</div>

<style>
.profile-card {
    background: var(--kimi-color-surface-raised);
    border: 1px solid var(--kimi-color-border);
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 4px 16px rgba(0,0,0,0.08);
    font-family: var(--kimi-font-sans);
    direction: rtl;
}

.profile-cover {
    height: 140px;
    background: linear-gradient(135deg, #1e1b4b 0%, #312e81 50%, #1e1b4b 100%);
    position: relative;
    overflow: hidden;
}
.profile-cover::after {
    content: '';
    position: absolute;
    top: -30px; right: -20px;
    width: 200px; height: 200px;
    background: radial-gradient(circle, rgba(139,92,246,0.3) 0%, transparent 70%);
    filter: blur(40px);
}

.profile-body {
    padding: 0 32px 28px;
    display: flex;
    align-items: flex-end;
    gap: 24px;
    margin-top: -50px;
    position: relative;
    z-index: 2;
}

/* الصورة */
.profile-avatar-wrap {
    position: relative;
    width: 120px;
    height: 120px;
    flex-shrink: 0;
}
.avatar-ring {
    position: absolute;
    inset: -3px;
    border-radius: 50%;
    background: linear-gradient(135deg, #8b5cf6, #06b6d4);
}
.profile-avatar-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    border-radius: 50%;
    border: 4px solid var(--kimi-color-surface-raised);
    position: relative;
    z-index: 2;
    background: var(--kimi-color-surface-muted);
}
.btn-camera {
    position: absolute;
    bottom: 4px; left: 4px;
    background: linear-gradient(135deg, #8b5cf6, #d946ef);
    border: none;
    color: white;
    width: 32px; height: 32px;
    border-radius: 50%;
    cursor: pointer;
    z-index: 3;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 2px 8px rgba(139,92,246,0.4);
    transition: transform 0.2s;
}
.btn-camera:hover { transform: scale(1.1); }

/* المعلومات */
.profile-info {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    gap: 10px;
    color: white;
}
.profile-info h1 {
    color: var(--kimi-color-text-primary);
    font-size: 1.6rem;
    font-weight: 700;
    margin: 0;
}

.badges {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
}
.badge {
    background: var(--kimi-color-surface-muted);
    border: 1px solid var(--kimi-color-border);
    padding: 5px 12px;
    border-radius: 20px;
    color: var(--kimi-color-text-secondary);
    font-size: 0.8rem;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}
.badge svg { color: #8b5cf6; }

.skills-bar {
    background: linear-gradient(90deg, rgba(139,92,246,0.08) 0%, transparent 100%);
    border-right: 3px solid #8b5cf6;
    padding: 8px 14px;
    border-radius: 4px 10px 10px 4px;
    color: var(--kimi-color-text-secondary);
    font-size: 0.85rem;
    display: flex;
    align-items: center;
    gap: 8px;
    width: fit-content;
}
.skills-bar svg { color: #d946ef; }

/* القنوات */
.channels {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    gap: 10px;
    margin-top: 4px;
}
.phone {
    font-size: 0.8rem;
    color: var(--kimi-color-text-tertiary);
    display: inline-flex;
    align-items: center;
    gap: 5px;
}
.phone svg { color: #06b6d4; }

.channel {
    width: 32px; height: 32px;
    border-radius: 8px;
    background: var(--kimi-color-surface-muted);
    border: 1px solid var(--kimi-color-border);
    color: var(--kimi-color-text-secondary);
    display: inline-flex;
    align-items: center;
    justify-content: center;
    text-decoration: none;
    transition: all 0.2s;
}
.channel:hover { color: white; transform: translateY(-2px); }
.whatsApp:hover { background: #0077b5; border-color: #0077b5; }
.facebook:hover { background: #24292e; border-color: #24292e; }

.cv-btn {
    padding: 0 14px; height: 32px;
    border-radius: 8px;
    background: linear-gradient(135deg, rgba(6,182,212,0.1), rgba(139,92,246,0.1));
    border: 1px solid rgba(6,182,212,0.3);
    color: #06b6d4;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    text-decoration: none;
    font-size: 0.8rem;
    font-weight: 600;
    transition: all 0.2s;
}
.cv-btn:hover {
    background: linear-gradient(135deg, #06b6d4, #8b5cf6);
    color: white;
}

/* الأزرار */
.profile-actions { flex-shrink: 0; }
.btn-action {
    padding: 10px 20px;
    border-radius: 12px;
    border: none;
    color: white;
    font-weight: 600;
    font-size: 0.9rem;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.2s;
}
.btn-create {
    background: linear-gradient(135deg, #06b6d4, #4f46e5);
    box-shadow: 0 4px 16px rgba(6,182,212,0.3);
}
.btn-edit {
    background: linear-gradient(135deg, #8b5cf6, #d946ef);
    box-shadow: 0 4px 16px rgba(139,92,246,0.3);
}
.btn-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(139,92,246,0.4);
}

/* Responsive */
@media (max-width: 768px) {
    .profile-body {
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin-top: -60px;
        padding: 0 20px 24px;
    }
    .badges, .channels { justify-content: center; }
    .skills-bar { margin: 0 auto; }
    .profile-actions { margin-top: 12px; }
}
</style>
    <div class="profile-stats">
        <div class="stat-card">
            <i class="fa-solid fa-code"></i>
            <h3>{{ $projectsCount }}</h3>
            <span>مشروعاً منجزاً</span>
        </div>

        <div class="stat-card">
            <i class="fa-solid fa-feather"></i>
            <h3>{{ $poemsCount }}</h3>
            <span>قصيدة أدبية</span>
        </div>

        <div class="stat-card">
            <i class="fa-solid fa-layer-group"></i>
            <h3>{{ $servicesCount }}</h3>
            <span>خدمة مفعّلة</span>
        </div>
    </div>

    <div class="profile-grid">

        <div class="info-card">
            <h3>معلومات الحساب والاتصال</h3>

            <div class="info-item-modern">
                <div class="info-icon"><i class="fa-regular fa-envelope"></i></div>
                <div class="info-text">
                    <span class="info-label">البريد الإلكتروني</span>
                    <span class="info-value">{{ $user->email }}</span>
                </div>
            </div>

            <div class="info-item-modern">
                <div class="info-icon"><i class="fa-solid fa-laptop-code"></i></div>
                <div class="info-text">
                    <span class="info-label">التخصص </span>
                    <span class="info-value">{{ $user->profile->borrow }}</span>
                </div>
            </div>

            <div class="info-item-modern">
                <div class="info-icon"><i class="fa-solid fa-user"></i></div>
                <div class="info-text">
                    <span class="info-label"> نبذة</span>
                    <span class="info-value">{{ $user->profile->bio }}</span>
                </div>
            </div>
        </div>

        <div class="info-card">
            <h3>مستوى المهارات </h3>

            <div class="skill-progress-bar">
                <div class="skill-info">
                    <span class="skill-name">اعلانات</span>
                    <span class="skill-percent">90%</span>
                </div>
                <div class="progress-track">
                    <div class="progress-fill" style="width: 90%;"></div>
                </div>
            </div>

            <div class="skill-progress-bar">
                <div class="skill-info">
                    <span class="skill-name">الترويج</span>
                    <span class="skill-percent">80%</span>
                </div>
                <div class="progress-track">
                    <div class="progress-fill" style="width: 80%;"></div>
                </div>
            </div>

          

            
        </div>

    </div>

</div>

@include('dashboard.modals.profile-modal')

@endsection