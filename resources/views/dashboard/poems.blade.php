@extends('layouts.dashboard')

@section('title', 'ديواني الشعري - الفخامة المظلمة')
@section('page-title', 'روائع القصائد')

@section('content')

<!-- 🌐 استدعاء الخطوط والأيقونات والمكتبات التفاعلية -->
<link href="https://fonts.googleapis.com/css2?family=Amiri:ital,wght@1,400;1,700&family=Cairo:wght@400;600;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --bg-dark: #070a13;
        --card-dark: #0f1626;
        --card-glass: rgba(15, 22, 38, 0.7);
        --accent-glow: rgba(217, 70, 239, 0.3);
        
        /* تدرج الألوان الأدبي الفاخر (بنفسجي إمبراطوري إلى وردي ساحر) */
        --primary-gradient: linear-gradient(135deg, #000000 0%, #980000 100%);
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

    .swal2-container { z-index: 100000 !important; }

    /* أنيميشن دخول الصفحة الرئيسي */
    @keyframes cubicFadeUp {
        0% { opacity: 0; transform: translateY(40px) scale(0.98); filter: blur(5px); }
        100% { opacity: 1; transform: translateY(0) scale(1); filter: blur(0); }
    }

  .poems-container {
    font-family: 'Cairo', sans-serif;
    direction: rtl;
    padding: 10px;
    
    /* أضف هذا السطر: افترضنا هنا أن عرض السايد بار 260px، قم بتعديله بحسب العرض الحقيقي للسايد بار لديك */
    margin-right: 280px; 
}

    /* هيدر الصفحة بتأثير الزجاج العاكس */
    .poems-header {
        animation: cubicFadeUp 1s cubic-bezier(0.22, 1, 0.36, 1) both;
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--card-glass);
        backdrop-filter: blur(14px);
        padding: 22px 30px;
        border-radius: 20px;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.08);
        margin-bottom: 50px;
    }

    .poems-header h2 {
        font-size: 1.4rem;
        font-weight: 900;
        background: white;
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 0;
    }

    .btn-add-poem {
        background: var(--primary-gradient);
        color: white;
        padding: 12px 24px;
        border-radius: 12px;
        font-weight: 800;
        font-size: 0.9rem;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 10px;
        transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
        text-decoration: none;
        box-shadow: 0 4px 15px var(--accent-glow);
    }

    .btn-add-poem:hover {
        transform: translateY(-3px) scale(1.03);
        box-shadow: 0 8px 25px rgba(217, 70, 239, 0.5);
    }

    /* شبكة الكروت التفاعلية */
.poems-grid {
          display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 50px;
}

    /* الكرت وتأثيرات التدفق الحركي المفصلة */
    .poem-card {
        background: var(--card-dark);
        border-radius: 24px;
        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.3);
        border: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        position: relative;
        padding-top: 65px; /* مساحة لنصف الصورة العائمة */
        transition: all 0.5s cubic-bezier(0.25, 1, 0.5, 1);
        opacity: 0; /* يبدأ مخفي لتفعيل أنيميشن التدفق المتتالي */
        animation: cubicFadeUp 0.8s cubic-bezier(0.25, 1, 0.5, 1) forwards;
    }

    .poem-card:hover {
        transform: translateY(-10px);
        border-color: rgba(239, 171, 70, 0.4);
        box-shadow: 0 20px 40px rgba(217, 70, 239, 0.12), 0 30px 60px rgba(0, 0, 0, 0.5);
    }

    /* تصميم الصورة الدائرية الإبداعية */
    .poem-avatar-container {
        position: absolute;
        top: -45px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 2;
    }

    .poem-circle-frame {
        width: 95px;
        height: 95px;
        border-radius: 50%;
        padding: 4px; /* مسافة الهالة الضوئية */
        background: var(--primary-gradient);
        box-shadow: 0 8px 25px var(--accent-glow);
        transition: all 0.5s ease;
    }

    .poem-circle-frame img, .poem-avatar-placeholder {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 50%;
        border: 4px solid var(--card-dark); /* خط عازل ذكي */
        transition: all 0.5s ease;
    }

    .poem-avatar-placeholder {
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #1a102f 0%, #0f172a 100%);
        color: var(--accent-color);
        font-size: 2.2rem;
    }

    /* تفاعل مرئي خارق للصورة عند حوم الفأرة فوق الكرت */
    .poem-card:hover .poem-circle-frame {
        transform: scale(1.08) rotate(5deg);
        box-shadow: 0 0 30px rgba(217, 70, 239, 0.7);
    }

    /* محتويات الكرت الفاخرة */
    .poem-body {
        padding: 25px;
        display: flex;
        flex-direction: column;
        flex: 1;
        text-align: center;
    }
/* 🛠️ حل مشكلة الـ Modal وتصميمها بالـ Dark Mode المذهل */
     .swal2-container {
        z-index: 100000 !important;
    }

    .poem-modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(5, 8, 16, 0.85);
        backdrop-filter: blur(8px);
        z-index: 999;
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease;
    }

    .poem-modal-card {
        background: var(--card-dark);
        width: 92%;
        max-width: 550px;
        max-height: 90vh;
        border-radius: 18px;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.5);
        border: 1px solid var(--border-color);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        animation: slideUp 0.3s cubic-bezier(0.16, 1, 0.3, 1);
    }

    @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    @keyframes slideUp { from { transform: translateY(30px); opacity: 0; } to { transform: translateY(0); opacity: 1; } }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid var(--border-color);
        padding: 20px 25px;
        background: rgba(17, 24, 39, 0.95);
    }

    .modal-header h3 { font-size: 1.2rem; font-weight: 800; color: var(--text-light); margin: 0; }
    
    .close-btn {
        background: none;
        border: none;
        font-size: 1.8rem;
        color: var(--text-gray);
        cursor: pointer;
        transition: color 0.2s;
    }
    .close-btn:hover { color: #ef4444; }

    .modal-scrollable-content {
        padding: 25px;
        overflow-y: auto;
        flex: 1;
    }

    .modal-scrollable-content::-webkit-scrollbar { width: 6px; }
    .modal-scrollable-content::-webkit-scrollbar-track { background: rgba(255,255,255,0.01); }
    .modal-scrollable-content::-webkit-scrollbar-thumb { background: rgba(255, 255, 255, 0.15); border-radius: 10px; }

    .form-group {
        margin-bottom: 20px;
        display: flex;
        flex-direction: column;
        gap: 8px;
    }

    .form-group label { font-size: 0.9rem; font-weight: 700; color: var(--text-light); }
    
    .form-group input, .form-group textarea {
        background: rgba(255, 255, 255, 0.03);
        color: var(--text-light);
        padding: 12px 16px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        font-family: 'Cairo', sans-serif;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .form-group input:focus, .form-group textarea:focus {
        outline: none;
        border-color: var(--accent-color);
        background: rgba(255, 255, 255, 0.05);
        box-shadow: 0 0 0 3px var(--accent-glow);
    }

    .image-preview-container { position: relative; width: 100%; }

    .upload-dropzone {
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 25px 15px;
        text-align: center;
        cursor: pointer;
        background: rgba(255, 255, 255, 0.02);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    .upload-dropzone:hover {
        border-color: var(--accent-color);
        background: rgba(99, 102, 241, 0.05);
    }

    .upload-dropzone i { font-size: 2.2rem; color: var(--text-gray); transition: color 0.3s; }
    .upload-dropzone:hover i { color: var(--accent-color); }
    .upload-dropzone span { font-weight: 700; font-size: 0.85rem; color: var(--text-light); }
    .file-limits { font-size: 0.75rem; color: var(--text-gray); margin: 0; }

    .preview-box { position: relative; border-radius: 12px; overflow: hidden; border: 1px solid var(--border-color); }
    .preview-box img { width: 100%; max-height: 180px; object-fit: cover; display: block; }

    .btn-remove-preview {
        position: absolute;
        bottom: 10px;
        left: 10px;
        background: rgba(239, 68, 68, 0.9);
        color: white;
        border: none;
        padding: 8px 12px;
        border-radius: 8px;
        font-family: 'Cairo', sans-serif;
        font-size: 0.8rem;
        font-weight: 700;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 6px;
        transition: background 0.2s;
    }
    .btn-remove-preview:hover { background: #dc2626; }

    .modal-footer {
        padding: 15px 25px 20px;
        border-top: 1px solid var(--border-color);
        background: rgba(17, 24, 39, 0.95);
        display: flex;
        gap: 12px;
    }
    
    .btn-submit {
        background: var(--accent-color);
        color: white;
        padding: 12px 24px;
        border: none;
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        flex: 2;
        font-family: 'Cairo', sans-serif;
        transition: all 0.3s;
    }
    .btn-submit:hover {
        background: #4f46e5;
        box-shadow: 0 0 15px var(--accent-glow);
    }

    .btn-cancel {
        background: rgba(255, 255, 255, 0.05);
        color: var(--text-light);
        padding: 12px 24px;
        border: 1px solid var(--border-color);
        border-radius: 10px;
        font-weight: 700;
        cursor: pointer;
        flex: 1;
        font-family: 'Cairo', sans-serif;
        transition: background 0.2s;
    }
    .btn-cancel:hover { background: rgba(255, 255, 255, 0.1); }

    .swal-dark-popup {
        border: 1px solid var(--border-color) !important;
        font-family: 'Cairo', sans-serif !important;
        border-radius: 16px !important;
    }
    .poem-body h3 {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-light);
        margin: 0 0 5px 0;
        transition: color 0.3s;
    }

    .poem-card:hover .poem-body h3 {
        color: var(--accent-color);
    }

    /* زخرفة أدبية كلاسيكية فاخرة تحت العنوان */
    .poem-divider {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        color: rgba(217, 70, 239, 0.4);
        margin-bottom: 20px;
        font-size: 0.7rem;
    }
    .poem-divider::before, .poem-divider::after {
        content: '';
        width: 30px;
        height: 1px;
        background: rgba(255,255,255,0.1);
    }

    /* حاوية القص التفاعلية وسهولة التدفق الجمالي */
    .poem-text-wrapper {
        position: relative;
        max-height: 145px; /* حصر العرض الأولي بأناقة الأدب */
        overflow: hidden;
        transition: max-height 0.6s cubic-bezier(0.25, 1, 0.5, 1);
        margin-bottom: 10px;
    }

    .poem-text-wrapper.expanded {
        max-height: 2000px; /* تمدد انسيابي حر لا نهائي */
    }

    /* قلب القصيدة: استخدام خط أميري الفاخر المائل لعرض الشعر العربي */
    .poem-content {
        font-family: 'Amiri', serif;
        font-size: 1rem;
         font-weight: 700;
        color: #e2e8f0;
        line-height: 1;
        margin: 0;
        white-space: pre-line;
        padding: 0 10px;
    }

    /* قناع الخفوت/التلاشي في أسفل النص */
    .poem-text-fade {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 60px;
        background: linear-gradient(to top, var(--card-dark) 15%, transparent);
        pointer-events: none;
        transition: all 0.4s ease;
    }

    .poem-text-wrapper.expanded .poem-text-fade {
        opacity: 0;
        transform: translateY(20px);
    }

    /* زر اقرأ المزيد الفاخر بتأثير السهم النابض */
    .btn-read-more {
        background: none;
        border: none;
        color: var(--text-gold);
        font-family: 'Cairo', sans-serif;
        font-weight: 700;
        font-size: 0.85rem;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        margin: 10px auto 20px auto;
        padding: 5px 15px;
        border-radius: 20px;
        background: rgba(251, 191, 36, 0.04);
        border: 1px solid rgba(251, 191, 36, 0.15);
        transition: all 0.3s ease;
    }

    .btn-read-more:hover {
        background: rgba(251, 191, 36, 0.12);
        border-color: var(--text-gold);
        box-shadow: 0 0 12px rgba(251, 191, 36, 0.2);
    }

    .btn-read-more i {
        transition: transform 0.3s ease;
    }

    /* أزرار التحكم في أسفل الكرت */
    .poem-actions {
        display: flex;
        gap: 12px;
        border-top: 1px solid rgba(255,255,255,0.05);
        padding-top: 18px;
        margin-top: auto;
    }

    .btn-action-glow {
        flex: 1;
        padding: 10px 14px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.85rem;
        border: 1px solid var(--border-color);
        background: rgba(255,255,255,0.02);
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-listen { color: var(--text-light); }
    .btn-listen:hover {
        background: rgba(217, 70, 239, 0.08);
        border-color: var(--accent-color);
        color: var(--accent-color);
        box-shadow: 0 0 15px rgba(217, 70, 239, 0.15);
    }

    .btn-delete-poem{ color: #f87171; }
    .btn-delete-poem:hover {
        background: rgba(248, 113, 113, 0.1);
        border-color: #f87171;
        box-shadow: 0 0 15px rgba(248, 113, 113, 0.15);
    }

    /* حالة الفراغ الصوفي */
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
    .empty-state p { color: var(--text-gray); margin-bottom: 30px; }

    /* مظهر مودال الإضافة السينمائي */
    .poem-modal-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(3, 5, 11, 0.9);
        backdrop-filter: blur(12px);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .poem-modal-card {
        background: #0f172a;
        width: 92%; max-width: 580px;
        border-radius: 24px;
        box-shadow: 0 30px 70px rgba(0,0,0,0.8);
        border: 1px solid rgba(217, 70, 239, 0.2);
        display: flex;
        flex-direction: column;
        overflow: hidden;
        animation: cubicFadeUp 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    .modal-header {
        display: flex; justify-content: space-between; align-items: center;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        padding: 20px 25px; background: rgba(15, 23, 42, 0.95);
    }
    .modal-header h3 { font-size: 1.25rem; font-weight: 800; color: var(--text-light); margin: 0; }
    .close-btn { background: none; border: none; font-size: 2rem; color: var(--text-gray); cursor: pointer; }
    .close-btn:hover { color: #f87171; }

    .modal-content { padding: 25px; max-height: 65vh; overflow-y: auto; }
    .form-group { margin-bottom: 22px; display: flex; flex-direction: column; gap: 8px; }
    .form-group label { font-size: 0.9rem; font-weight: 700; color: #cbd5e1; }
    
    .form-group input, .form-group textarea {
        background: rgba(255, 255, 255, 0.03); color: white;
        padding: 14px 18px; border: 1px solid rgba(255,255,255,0.08); border-radius: 12px;
        font-family: 'Cairo', sans-serif; font-size: 0.9rem; transition: all 0.3s;
    }
    .form-group input:focus, .form-group textarea:focus {
        outline: none; border-color: var(--accent-color); background: rgba(255,255,255,0.05);
        box-shadow: 0 0 0 3px rgba(217, 70, 239, 0.25);
    }

    .modal-footer { padding: 15px 25px 25px; border-top: 1px solid rgba(255,255,255,0.06); display: flex; gap: 15px; }
    .btn-submit { background: var(--primary-gradient); color: white; padding: 14px; border: none; border-radius: 12px; font-weight: 800; cursor: pointer; flex: 2; font-family: 'Cairo'; transition: all 0.3s; }
    .btn-submit:hover { box-shadow: 0 0 20px var(--accent-glow); }
    .btn-cancel { background: rgba(255,255,255,0.05); color: white; padding: 14px; border: 1px solid rgba(255,255,255,0.08); border-radius: 12px; font-weight: 700; cursor: pointer; flex: 1; font-family: 'Cairo'; }

    .swal-dark-popup { border: 1px solid rgba(217, 70, 239, 0.2) !important; font-family: 'Cairo', sans-serif !important; border-radius: 20px !important; }
</style>

<div class="poems-container">

    <!-- هيدر اللوحة الشعري -->
    <div class="poems-header">
        <h2>ديواني الشعري وإدارة روائع المخطوطات</h2>
        <a href="#" class="btn-add-poem" id="openAddPoemModal">
            <i class="fa-solid fa-feather-pointed"></i>
            خطّ قصيدة جديدة
        </a>
    </div>

    @if($poems->isEmpty())
        <div class="empty-state">
            <i class="fa-solid fa-scroll"></i>
            <h3>الديوان لا يزال أبيضاً وينتظر وحيك!</h3>
            <p>ابدأ بنشر أولى روائعك الأدبية وأبياتك لتعانق ذائقة متابعيك الحسيّة.</p>
            <a href="#" class="btn-add-poem" id="emptyStateAddBtn">
                <i class="fa-solid fa-feather-pointed"></i>
                خطّ أول قصيدة
            </a>
        </div>
    @else
        <div class="poems-grid">
            @foreach($poems as $index =>$poem)
                <div class="poem-card" id="poem-card-{{ $poem->id }}" style="animation-delay: {{ $index * 0.12 }}s;">
                    
                    <div class="poem-avatar-container">
                        <div class="poem-circle-frame">
                            @if($poem->image)
                                <img id="img-display-{{ $poem->id }}" src="{{ asset('storage/' . $poem->image) }}" alt="{{ $poem->poem_title }}">
                            @else
                                <div class="poem-avatar-placeholder">
                                    <i class="fa-solid fa-feather"></i>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="poem-body">
                        <h3 id="title-display-{{ $poem->id }}">{{ $poem->poem_title }}</h3>
                        
                        <div class="poem-divider">✧ ❖ ✧</div>
                        
                        <div class="poem-text-wrapper">
                            <div class="poem-content" id="desc-display-{{ $poem->id }}">{!! nl2br(e($poem->poem_content)) !!}</div>
                            <div class="poem-text-fade"></div>
                        </div>

                        <button type="button" class="btn-read-more" onclick="togglePoemFluid(this)">
                            <span>اقرأ المزيد</span>
                            <i class="fa-solid fa-chevron-down"></i>
                        </button>

                        <div class="poem-actions">
                            @if($poem->poem_link)
                                <a href="{{ $poem->poem_link }}" target="_blank" class="btn-action-glow btn-listen" id="link-display-{{ $poem->id }}">
                                    <i class="fa-solid fa-link"></i>
 Link                                </a>
                            @else
                                <a id="link-display-{{ $poem->id }}" style="display: none;" target="_blank" class="btn-action-glow btn-listen">
                                    <i class="fa-solid fa-headphones-simple"></i>
                                    استماع صوتي
                                </a>
                            @endif

                            <button class="btn-action-glow btn-delete-poem" data-id="{{ $poem->id }}" data-title="{{ $poem->poem_title }}">
                                <i class="fa-solid fa-trash-can"></i>
                                حذف القصيدة
                            </button>
                            
                            <button class="btn-action-outline btn-edit-poem" 
                                    data-id="{{ $poem->id }}"
                                    data-title="{{ $poem->poem_title }}"
                                    data-content="{{ $poem->poem_content }}"
                                    data-link="{{ $poem->poem_link }}"
                                    data-image="{{ $poem->image ? asset('storage/' . $poem->image) : '' }}"
                                    onclick="triggerEdit(this)">
                                <i class="fa-solid fa-pen-to-square"></i>
                                تعديل
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- مودال الإضافة السينمائي التفاعلي المدعوم لرفع الملفات -->
<div id="addPoemModal" class="poem-modal-overlay" style="display: none;">
    <div class="poem-modal-card">
        <div class="modal-header">
            <h3>مخطوطة قصيدة جديدة</h3>
            <button id="closePoemModal" class="close-btn">&times;</button>
        </div>
        
        <form id="addPoemForm" enctype="multipart/form-data">
            @csrf
            
            <div class="modal-content">
                <div class="form-group">
                    <label for="poem_title">عنوان المخطوطة / القصيدة</label>
                    <input type="text" name="poem_title" id="poem_title" required placeholder="مثال: ترانيم الفجر البعيد...">
                </div>
                
                <div class="form-group">
                    <label for="edit_imagepoem_content">أبيات القصيدة الشعرية</label>
                    <textarea name="poem_content" id="edit_imagepoem_content" rows="6" required></textarea>
                </div>

                <div class="form-group">
                    <label for="image">غلاف تعبيري دائري (اختياري)</label>
                    <input type="file" name="image" id="image" accept="image/*">
                </div>

                <div class="form-group">
                    <label for="poem_link">رابط الإلقاء الصوتي أو المرئي (اختياري)</label>
                    <input type="url" name="poem_link" id="poem_link" placeholder="يوتيوب، ساوند كلاود، إلخ...">
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn-submit">تثبيت ونشر في الديوان</button>
                <button type="button" id="cancelPoemModal" class="btn-cancel">تراجع</button>
            </div>
        </form>
    </div>
</div>


<!-- 📦 النافذة المتطورة للتعديل الفوري -->
<div id="editpoemModal" class="poem-modal-overlay" style="display: none;">
    <div class="poem-modal-card">
        <div class="modal-header">
            <h3>تعديل تفاصيل المخطوطة الشعرية</h3>
            <button id="closeEditpoemModal" class="close-btn">&times;</button>
        </div>
        
        <form id="editpoemForm" enctype="multipart/form-data" style="display: flex; flex-direction: column; flex: 1; overflow: hidden;">
            @csrf
            <!-- حقل مخفي لتخزين الـ ID الخاص بالقصيدة قيد التعديل -->
            <input type="hidden" id="edit_poem_id">
            
            <div class="modal-scrollable-content">
                <div class="form-group">
                    <label for="edit_title">عنوان القصيدة</label>
                    <!-- تم تعديل الـ name ليتوافق مع الـ Controller والـ Request -->
                    <input type="text" name="poem_title" id="edit_title" required placeholder="عنوان القصيدة">
                </div>
                
                <div class="form-group">
                    <label for="poem_content">أبيات القصيدة</label>
                    <!-- تم تعديل الـ name ليتوافق مع الـ Controller والـ Request -->
                    <textarea name="poem_content" id="poem_content" rows="6" required placeholder="اكتب أبيات القصيدة هنا..."></textarea>
                </div>
                
                <div class="form-group">
                    <label for="edit_poem_link">رابط الاستماع الصوتي (إن وجد)</label>
                    <input type="url" name="poem_link" id="edit_poem_link" placeholder="https://example.com">
                </div>
                
                <div class="form-group">
                    <label>صورة القصيدة</label>
                    <div class="image-preview-container" id="editImagePreviewContainer">
                        <input type="file" name="image" id="edit_image" accept="image/*" style="display: none;">
                        
                        <div class="upload-dropzone" id="editUploadDropzone">
                            <i class="fa-regular fa-image"></i>
                            <span>اسحب صورة جديدة هنا لتغيير غلاف الصورة أو اضغط</span>
                            <p class="file-limits">اتركه فارغاً للاحتفاظ بالصورة الحالية</p>
                        </div>
                        
                        <div class="preview-box" id="editPreviewBox" style="display: none;">
                            <img id="editModalImagePreview" src="" alt="معاينة الصورة المرفقة">
                            <button type="button" class="btn-remove-preview" id="btnRemoveEditPreview">
                                <i class="fa-solid fa-trash-can"></i>
                                إلغاء الصورة المختارة
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn-submit">تحديث المخطوطة الشعرية</button>
                <button type="button" id="cancelEditpoemModal" class="btn-cancel">إلغاء</button>
            </div>
        </form>
    </div>
</div>


<script>
// دالة التدفق البصري الذكية لقص وتمدد النص مع حركة مرنة للأسهم والتمرير التلقائي
function togglePoemFluid(btn) {
    const wrapper = btn.previousElementSibling;
    const textSpan = btn.querySelector('span');
    const icon = btn.querySelector('i');
    
    wrapper.classList.toggle('expanded');
    
    if (wrapper.classList.contains('expanded')) {
        textSpan.textContent = 'عرض أقل';
        icon.style.transform = 'rotate(180deg)';
    } else {
        textSpan.textContent = 'اقرأ المزيد';
        icon.style.transform = 'rotate(0deg)';
        
        btn.closest('.poem-card').scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }
}

document.addEventListener('DOMContentLoaded', function() {
    // عناصر مودال الإضافة
    const modal = document.getElementById('addPoemModal');
    const openBtn = document.getElementById('openAddPoemModal');
    const emptyAddBtn = document.getElementById('emptyStateAddBtn');
    const closeBtn = document.getElementById('closePoemModal');
    const cancelBtn = document.getElementById('cancelPoemModal');
    const form = document.getElementById('addPoemForm');

    // عناصر مودال التعديل
    const editModal = document.getElementById('editpoemModal');
    const closeEditBtn = document.getElementById('closeEditpoemModal');
    const cancelEditBtn = document.getElementById('cancelEditpoemModal');
    const editForm = document.getElementById('editpoemForm');

    const editFileInput = document.getElementById('edit_image');
    const editDropzone = document.getElementById('editUploadDropzone');
    const editPreviewBox = document.getElementById('editPreviewBox');
    const editPreviewImg = document.getElementById('editModalImagePreview');
    const editRemoveBtn = document.getElementById('btnRemoveEditPreview');

    let isSubmitting = false;
    let isEditingSubmitting = false;

    // ==========================================
    // إدارة عمليات مودال الإضافة
    // ==========================================
    function openModal(e) {
        if(e) e.preventDefault();
        modal.style.display = 'flex';
    }

    function closeModal() {
        modal.style.display = 'none';
        form.reset();
        isSubmitting = false; 
    }

    if(openBtn) openBtn.addEventListener('click', openModal);
    if(emptyAddBtn) emptyAddBtn.addEventListener('click', openModal);
    if(closeBtn) closeBtn.addEventListener('click', closeModal);
    if(cancelBtn) cancelBtn.addEventListener('click', closeModal);

    window.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
        if (e.target === editModal) closeEditModal();
    });

    // إرسال نموذج إضافة قصيدة عبر AJAX
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        
        if (isSubmitting) return;
        isSubmitting = true;

        const submitBtn = form.querySelector('.btn-submit');
        const originalBtnHtml = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-wand-magic-sparkles fa-spin"></i> جاري صياغة المخطوطة...';

        const formData = new FormData(form);

        fetch("{{ route('dashboard.poems.store') }}", {
            method: "POST",
            body: formData,
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(response => {
            if (!response.ok) throw response;
            return response.json();
        })
        .then(data => {
            closeModal();

            Swal.fire({
                icon: 'success',
                title: 'تم النشر والتوثيق الأدبي!',
                text: data.message || 'أُضيفت القصيدة لقصائد ديوانك الشخصي العريق!',
                background: '#0f172a',
                color: '#f8fafc',
                confirmButtonColor: '#d946ef',
                confirmButtonText: 'أثق بذلك والحمد لله',
                customClass: { popup: 'swal-dark-popup' }
            }).then(() => {
                location.reload(); 
            });
        })
        .catch(async error => {
            isSubmitting = false;
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;

            if (error instanceof Response) {
                const contentType = error.headers.get("content-type");
                if (contentType && contentType.indexOf("application/json") !== -1) {
                    try {
                        const errData = await error.json();
                        let errorsList = Object.values(errData.errors).flat().map(err => `<li>${err}</li>`).join('');
                        Swal.fire({
                            icon: 'warning',
                            title: 'مراجعة أوزان القافية والمدخلات',
                            html: `<ul style="text-align: right; direction: rtl; color: #94a3b8; font-family: 'Cairo'; list-style-position: inside; line-height: 1.8;">${errorsList}</ul>`,
                            background: '#0f172a',
                            color: '#f8fafc',
                            confirmButtonColor: '#d946ef',
                            confirmButtonText: 'تصحيح المخطوطة',
                            customClass: { popup: 'swal-dark-popup' }
                        });
                        return;
                    } catch (e) {}
                }
            }

            Swal.fire({
                icon: 'error',
                title: 'فشل حياكة ونشر القصيدة',
                text: 'يرجى مراجعة صياغة البيانات وحجم الملف المرفق (حد أقصى 2 ميجابايت).',
                background: '#0f172a',
                color: '#f8fafc',
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'حسنًا',
                customClass: { popup: 'swal-dark-popup' }
            });
        });
    });

    // ==========================================
    // إدارة وعمليات مودال التعديل
    // ==========================================
    window.triggerEdit = function(btn) {
        const id = btn.getAttribute('data-id');
        const title = btn.getAttribute('data-title');
        const content = btn.getAttribute('data-content'); 
        const link = btn.getAttribute('data-link');
        const image = btn.getAttribute('data-image');

        document.getElementById('edit_poem_id').value = id;
        document.getElementById('edit_title').value = title;
        document.getElementById('poem_content').value = content;
        document.getElementById('edit_poem_link').value = link || '';

        if (image) {
            editPreviewImg.src = image;
            editDropzone.style.display = 'none';
            editPreviewBox.style.display = 'block';
        } else {
            editPreviewBox.style.display = 'none';
            editDropzone.style.display = 'flex';
        }

        editModal.style.display = 'flex';
    }

    function closeEditModal() {
        editModal.style.display = 'none';
        editForm.reset();
        editPreviewBox.style.display = 'none';
        editDropzone.style.display = 'flex';
        isEditingSubmitting = false;
    }

    if(closeEditBtn) closeEditBtn.addEventListener('click', closeEditModal);
    if(cancelEditBtn) cancelEditBtn.addEventListener('click', closeEditModal);

    if (editDropzone && editFileInput) {
        editDropzone.addEventListener('click', () => editFileInput.click());
        editFileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    editPreviewImg.src = e.target.result;
                    editDropzone.style.display = 'none';
                    editPreviewBox.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        if (editRemoveBtn) {
            editRemoveBtn.addEventListener('click', function() {
                editFileInput.value = '';
                editPreviewBox.style.display = 'none';
                editDropzone.style.display = 'flex';
            });
        }
    }

    // تفاعل AJAX لتعديل القصيدة فورياً وحل خطأ 405
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (isEditingSubmitting) return;
        isEditingSubmitting = true;

        const id = document.getElementById('edit_poem_id').value;
        const submitBtn = editForm.querySelector('.btn-submit');
        const originalBtnHtml = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> جاري تحديث البيانات...';

        Swal.fire({
            title: 'جاري تعديل وحفظ البيانات...',
            text: 'يرجى الانتظار لحين معالجة البيانات وتحديث السيرفر',
            allowOutsideClick: false,
            allowEscapeKey: false,
            background: '#111827',
            color: '#f8fafc',
            didOpen: () => { Swal.showLoading(); }
        });

        const formData = new FormData(editForm);
        // حيلة تجاوز الـ PUT لضمان رفع الصور في لارافل بنجاح وتطابق الـ Router
        formData.append('_method', 'PUT');

        fetch(`/poems/update/${id}`, {
            method: "POST",
            body: formData,
            headers: { 
                "X-Requested-With": "XMLHttpRequest" 
            }
        })
        .then(response => {
            if (!response.ok) throw response;
            return response.json();
        })
        .then(data => {
            closeEditModal();
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;
            
            // قراءة كائن القصيدة بناءً على استجابة السيرفر المباشرة (حيث تعود في كائن message)
            const updatedpoem = data.message || data.poem || data.data; 
            
            // تحديث نصوص الكرت فوراً
            if(document.getElementById(`title-display-${id}`)) {
                document.getElementById(`title-display-${id}`).textContent = updatedpoem.poem_title;
            }
            
            if(document.getElementById(`desc-display-${id}`)) {
                document.getElementById(`desc-display-${id}`).innerHTML = updatedpoem.poem_content.replace(/\n/g, "<br />");
            }
            
            // تحديث صورة غلاف القصيدة فوراً
            if(updatedpoem.image && document.getElementById(`img-display-${id}`)) {
                document.getElementById(`img-display-${id}`).src = `/storage/${updatedpoem.image}`;
            }

            // تحديث وإظهار/إخفاء زر الاستماع الصوتي
            const linkBtn = document.getElementById(`link-display-${id}`);
            if(linkBtn) {
                if(updatedpoem.poem_link) {
                    linkBtn.setAttribute('href', updatedpoem.poem_link);
                    linkBtn.style.display = "inline-flex";
                } else {
                    linkBtn.style.display = "none";
                }
            }

            // تحديث الـ Dataset لزر التعديل ليبقى متزامناً بالبيانات المحدثة دون الحاجة لريفريش
            const currentEditBtn = document.querySelector(`#poem-card-${id} .btn-edit-poem`);
            if (currentEditBtn) {
                currentEditBtn.setAttribute('data-title', updatedpoem.poem_title);
                currentEditBtn.setAttribute('data-content', updatedpoem.poem_content);
                currentEditBtn.setAttribute('data-link', updatedpoem.poem_link || '');
                currentEditBtn.setAttribute('data-image', updatedpoem.image ? `/storage/${updatedpoem.image}` : '');
            }

            Swal.fire({
                icon: 'success',
                title: 'تم التحديث بنجاح! 🎉',
                text: 'تم تعديل تفاصيل المخطوطة الشعرية بنجاح وتحديث الديوان فوراً.',
                background: '#111827',
                color: '#f8fafc',
                confirmButtonColor: '#d946ef',
                confirmButtonText: 'رائع جداً',
                customClass: { popup: 'swal-dark-popup' }
            });
        })
        .catch(async error => {
            isEditingSubmitting = false;
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;

            Swal.fire({
                icon: 'error',
                title: 'عذراً، فشل التعديل',
                text: 'يرجى مراجعة المدخلات والتأكد من صياغتها وحجم المرفقات، ثم المحاولة مرة أخرى.',
                background: '#111827',
                color: '#f8fafc',
                confirmButtonColor: '#ef4444',
                customClass: { popup: 'swal-dark-popup' }
            });
        });
    });

    // ==========================================
    // معالجة عملية حذف القصيدة (DELETE)
    // ==========================================
    document.querySelectorAll('.btn-delete-poem').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const poemId = this.getAttribute('data-id');
            const poemTitle = this.getAttribute('data-title');
            
            Swal.fire({
                title: 'هل تود حذف هذه القصيدة؟',
                text: `سيتم مسح "${poemTitle}" نهائياً ولن تتمكن من استعادتها.`,
                icon: 'warning',
                showCancelButton: true,
                background: '#111827', color: '#f8fafc', confirmButtonColor: '#ef4444', cancelButtonColor: '#374151',
                confirmButtonText: 'نعم، احذفها', cancelButtonText: 'إلغاء',
                customClass: { popup: 'swal-dark-popup' }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'جاري مسح الأبيات...', allowOutsideClick: false, background: '#111827', color: '#f8fafc',
                        customClass: { popup: 'swal-dark-popup' },
                        didOpen: () => { Swal.showLoading(); }
                    });

                    fetch(`/poems/delete/${poemId}`, {
                        method: 'DELETE',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json'
                        }
                    })
                    .then(response => {
                        if (!response.ok) throw response;
                        return response.json();
                    })
                    .then(data => {
                        Swal.fire({
                            icon: 'success', title: 'تم الحذف!', text: data.message || 'تم حذف القصيدة بنجاح.',
                            background: '#111827', color: '#f8fafc', confirmButtonColor: '#818cf8', confirmButtonText: 'حسناً',
                            customClass: { popup: 'swal-dark-popup' }
                        }).then(() => { 
                            location.reload(); 
                        });
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error', title: 'خطأ في العملية', text: 'فشلت عملية حذف القصيدة، يرجى المحاولة لاحقاً.',
                            background: '#111827', color: '#f8fafc', confirmButtonColor: '#ef4444', confirmButtonText: 'مفهوم',
                            customClass: { popup: 'swal-dark-popup' }
                        });
                    });
                }
            });
        });
    });
});
</script>