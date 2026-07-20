@extends('layouts.dashboard')

@section('title', 'صندوق الرسائل الواردة - Dark Mode')
@section('page-title', 'صندوق الرسائل الواردة')

@section('content')

<!-- 🌐 استدعاء المكتبات للأيقونات والتأثيرات البصرية الساحرة -->
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --bg-dark: #070a13;
        --card-dark: #0f1626;
        --card-glass: rgba(15, 22, 38, 0.7);
        --accent-glow: rgba(217, 70, 239, 0.3);
        --primary-gradient: linear-gradient(135deg, #a855f7 0%, #d946ef 100%);
        --accent-color: #d946ef;
        --border-color: rgba(255, 255, 255, 0.06);
        --text-light: #f8fafc;
        --text-gray: #94a3b8;
        --text-gold: #fbbf24;
    }

    body {
        background-color: var(--bg-dark);
        color: var(--text-light);
    }

    /* أنيميشن الدخول الانسيابي */
    @keyframes cubicFadeUp {
        0% { opacity: 0; transform: translateY(30px); filter: blur(3px); }
        100% { opacity: 1; transform: translateY(0); filter: blur(0); }
    }

    .contacts-container {
        font-family: 'Cairo', sans-serif;
        direction: rtl;
        padding: 10px;
    }

    /* الهيدر الفاخر بتأثير الزجاج */
    .contacts-header {
        animation: cubicFadeUp 0.8s cubic-bezier(0.22, 1, 0.36, 1) both;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--card-glass);
        backdrop-filter: blur(14px);
        padding: 22px 30px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.08);
        margin-bottom: 40px;
    }

    .contacts-header h2 {
        font-size: 1.4rem;
        font-weight: 900;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 0;
    }

    .message-count-badge {
        background: rgba(217, 70, 239, 0.15);
        color: var(--accent-color);
        padding: 6px 16px;
        border-radius: 20px;
        font-weight: 800;
        font-size: 0.85rem;
        border: 1px solid rgba(217, 70, 239, 0.25);
    }

    /* شبكة الرسائل المتدفقة */
    .messages-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(340px, 1fr));
        gap: 25px;
    }

    .message-card {
        background: var(--card-dark);
        border-radius: 20px;
        border: 1px solid var(--border-color);
        padding: 25px;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        opacity: 0;
        animation: cubicFadeUp 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
    }

    .message-card:hover {
        transform: translateY(-8px);
        border-color: rgba(217, 70, 239, 0.3);
        box-shadow: 0 15px 35px rgba(217, 70, 239, 0.08), 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    /* هيدر الكرت: اسم المرسل وأيقونة البريد الدائرية */
    .card-sender-info {
        display: flex;
        align-items: center;
        gap: 15px;
        margin-bottom: 20px;
    }

    .sender-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        background: var(--primary-gradient);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.3rem;
        font-weight: 900;
        box-shadow: 0 4px 15px rgba(217, 70, 239, 0.3);
    }

    .sender-details {
        display: flex;
        flex-direction: column;
        gap: 4px;
        max-width: calc(100% - 65px);
    }

    .sender-name {
        font-size: 1.05rem;
        font-weight: 800;
        color: var(--text-light);
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .sender-email {
        font-size: 0.8rem;
        color: var(--text-gray);
        direction: ltr;
        text-align: right;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .sender-contentMessage {
        font-size: 0.8rem;
        color: var(--text-gray);
        direction: ltr;
        text-align: right;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* محتوى الرسالة */
    .message-subjects {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--text-gold);
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .message-body-preview {
        font-size: 0.9rem;
        color: #cbd5e1;
        line-height: 1.7;
        margin: 0 0 20px 0;
        display: -webkit-box;
        -webkit-line-clamp: 3; /* قص الرسالة عند 3 أسطر تلقائياً */
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    /* ذيل بطاقة الرسالة */
    .card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: auto;
        padding-top: 15px;
        border-top: 1px solid rgba(255,255,255,0.05);
    }

    .message-time {
        font-size: 0.75rem;
        color: var(--text-gray);
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .btn-read-msg {
        background: none;
        border: none;
        color: var(--accent-color);
        font-family: 'Cairo', sans-serif;
        font-weight: 800;
        font-size: 0.85rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: all 0.2s ease;
    }

    .btn-read-msg:hover {
        color: white;
        transform: scale(1.05);
    }

    /* مظهر نافذة القراءة المخصصة للرسائل (Modal) */
    .message-view-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(3, 5, 11, 0.92);
        backdrop-filter: blur(15px);
        z-index: 99999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .message-view-card {
        background: #0f172a;
        width: 92%; max-width: 600px;
        border-radius: 24px;
        box-shadow: 0 30px 80px rgba(0,0,0,0.8);
        border: 1px solid rgba(217, 70, 239, 0.2);
        animation: cubicFadeUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        padding: 30px;
    }

    .view-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        padding-bottom: 20px;
        margin-bottom: 20px;
    }

    .view-title-group h3 { font-size: 1.3rem; font-weight: 800; color: var(--text-light); margin: 0 0 5px 0; }
    .view-title-group p { font-size: 0.85rem; color: var(--text-gray); margin: 0; }

    .view-close-btn {
        background: rgba(255,255,255,0.04);
        border: 1px solid rgba(255,255,255,0.06);
        color: var(--text-gray);
        width: 36px; height: 36px;
        border-radius: 50%;
        cursor: pointer;
        display: flex; align-items: center; justify-content: center;
        transition: all 0.2s;
    }
    .view-close-btn:hover { background: rgba(239, 68, 68, 0.1); color: #ef4444; }

    .view-body {
        background: rgba(255,255,255,0.02);
        border: 1px solid rgba(255,255,255,0.04);
        border-radius: 16px;
        padding: 20px;
        color: #e2e8f0;
        font-size: 0.95rem;
        line-height: 1.8;
        max-height: 300px;
        overflow-y: auto;
        white-space: pre-line;
        margin-bottom: 25px;
    }

    .view-footer {
        display: flex;
        gap: 12px;
    }

    .btn-reply {
        background: var(--primary-gradient);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 12px;
        font-weight: 800;
        font-family: 'Cairo';
        text-decoration: none;
        text-align: center;
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s;
    }

    .btn-reply:hover {
        box-shadow: 0 0 20px var(--accent-glow);
        transform: translateY(-2px);
    }

    /* حالة عدم وجود رسائل */
    .empty-state {
        animation: cubicFadeUp 1s ease;
        text-align: center;
        padding: 80px 20px;
        background: var(--card-dark);
        border-radius: 24px;
        border: 2px dashed rgba(255,255,255,0.06);
    }
    .empty-state i { font-size: 4rem; color: var(--accent-color); opacity: 0.6; margin-bottom: 20px; }
    .empty-state h3 { font-size: 1.4rem; font-weight: 800; margin-bottom: 10px; }
    .empty-state p { color: var(--text-gray); }

    /* تخصيص السكرول بار للمظهر الفاخر */
    .view-body::-webkit-scrollbar { width: 6px; }
    .view-body::-webkit-scrollbar-track { background: transparent; }
    .view-body::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 10px; }
    .view-body::-webkit-scrollbar-thumb:hover { background: var(--accent-color); }
</style>

<div class="contacts-container">

    <!-- الهيدر والعداد الرقمي الذكي -->
    <div class="contacts-header">
        <h2>صندوق الرسائل الواردة</h2>
        <div class="message-count-badge">
            <i class="fa-solid fa-envelope-open-text"></i>
            {{ $message->count() }} رسالة إجمالاً
        </div>
    </div>

    @if($message->isEmpty())
        <div class="empty-state">
            <i class="fa-solid fa-mailbox"></i>
            <h3>الصندوق مغلق ولا توجد رسائل جديدة!</h3>
            <p>لا توجد أي رسائل واردة عبر نموذج تواصل معنا في موقعك حالياً.</p>
        </div>
    @else
        <div class="messages-grid">
            @foreach($message as $index => $msg)
                <!-- تأثير تدفق الكروت المتتالي مع التوقيت المخصص -->
                <div class="message-card" style="animation-delay: {{ $index * 0.12 }}s;">
                    
                    <!-- معلومات المرسل -->
                    <div class="card-sender-info">
                        <div class="sender-avatar">
                            <!-- أخذ أول حرف من اسم المرسل بطريقة مميزة 
                            -->
                            <i class="fa fa-star"></i>
                            {{-- {{ mb_substr($msg->name, 0, 1, 'utf-8') }} --}}
                        </div>
                        <div class="sender-details">
                            <span class="sender-name">{{ $msg->name }}</span>
                            <span class="sender-email">{{ $msg->email }}</span>
                            <span class="sender-contentMessage">{{ $msg->contentMessage }}</span>
                        </div>
                    </div>

                    <!-- معاينة الرسالة -->
                    @if(isset($msg->subjects))
                        <div class="message-subjects">
                            <i class="fa-solid fa-asterisk"></i>
                            {{ $msg->subjects }}
                        </div>
                    @endif

                    <p class="message-body-preview">{{ $msg->message }}</p>

                    <!-- ذيل الكرت التفاعلي -->
                    <div class="card-footer">
                        <span class="message-time">
                            <i class="fa-regular fa-clock"></i>
                            {{ $msg->created_at ? $msg->created_at->diffForHumans() : 'منذ فترة' }}
                        </span>

                        <button type="button" class="btn-read-msg" 
                                onclick="openMessageModal('{{ e($msg->name) }}', '{{ e($msg->email) }}', '{{ e($msg->subjects ?? 'بلا عنوان') }}', `{{ e($msg->contentMessage) }}`)">
                            قراءة كاملة
                            <i class="fa-solid fa-arrow-left-long"></i>
                        </button>
                    </div>

                </div>
            @endforeach
        </div>
    @endif

</div>

<!-- منبثقة عرض الرسائل وقراءتها والرد المباشر -->
<div id="viewMessageModal" class="message-view-overlay" style="display: none;">
    <div class="message-view-card">
        <div class="view-header">
            <div class="view-title-group">
                <h3 id="modalSenderName">الاسم للمرسل</h3>
                <p id="modalSenderEmail">البريد الإلكتروني</p>
            </div>
            <button class="view-close-btn" onclick="closeMessageModal()">&times;</button>
        </div>
        
        <div class="form-group" style="margin-bottom: 12px;">
            <label style="color: var(--text-gold); font-weight: 800;" id="modalsubjects">الموضوع</label>
        </div>
        
        <div class="view-body" id="modalMessageContent">
            محتوى الرسالة بالكامل سيوضع هنا برمجياً وسيحافظ على الأسطر والنزول التلقائي...
        </div>

        <div class="view-footer">
            <a href="#" id="replyMailToBtn" class="btn-reply">
                <i class="fa-solid fa-paper-plane"></i>
                رد مباشر عبر البريد الإلكتروني
            </a>
        </div>
    </div>
</div>

<script>
// دالة فتح نافذة قراءة الرسائل التفاعلية
function openMessageModal(name, email, subjects, message) {
    document.getElementById('modalSenderName').textContent = name;
    document.getElementById('modalSenderEmail').textContent = email;
    document.getElementById('modalsubjects').innerHTML = `<i class="fa-solid fa-hashtag"></i> موضوع الرسالة: ${subjects}`;
    document.getElementById('modalMessageContent').textContent = message;

    // تهيئة رابط الرد التلقائي السريع عبر الـ mailto بطريقة ذكية جداً
    const replyBtn = document.getElementById('replyMailToBtn');
    replyBtn.href = `mailto:${email}?subjects=الرد على رسالتك: ${encodeURIComponent(subjects)}`;

    // فتح المودال مع تأثير ناعم
    const modal = document.getElementById('viewMessageModal');
    modal.style.display = 'flex';
}

function closeMessageModal() {
    document.getElementById('viewMessageModal').style.display = 'none';
}

// غلق المودال تلقائياً عند الضغط خارج نافذة العرض
window.addEventListener('click', function(e) {
    const modal = document.getElementById('viewMessageModal');
    if (e.target === modal) {
        closeMessageModal();
    }
});
</script>

@endsection