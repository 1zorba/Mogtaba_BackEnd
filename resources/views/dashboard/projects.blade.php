@extends('layouts.dashboard')

@section('title', 'إدارة المشاريع - Dark Mode')
@section('page-title', 'مشاريعي')

@section('content')

<!-- استدعاء مكتبة SweetAlert2 للتنبيهات الفاخرة -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --bg-dark: #0b0f19;
        --card-dark: #111827;
        --card-glass: rgba(17, 24, 39, 0.75);
        --accent-color: #6366f1;
        --accent-glow: rgba(99, 102, 241, 0.35);
        --success-color: #10b981;
        --success-glow: rgba(16, 185, 129, 0.25);
        --border-color: rgba(255, 255, 255, 0.08);
        --text-light: #f8fafc;
        --text-gray: #94a3b8;
    }

    body {
        background-color: var(--bg-dark);
        color: var(--text-light);
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .projects-container {
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        font-family: 'Cairo', sans-serif;
        direction: rtl;
    }

    .projects-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--card-glass);
        backdrop-filter: blur(10px);
        padding: 20px 25px;
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        border: 1px solid var(--border-color);
        margin-bottom: 30px;
    }

    .projects-header h2 {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-light);
        margin: 0;
    }

    .btn-add-project {
        background: var(--accent-color);
        color: white;
        padding: 10px 20px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.9rem;
        border: none;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
    }

    .btn-add-project:hover {
        background: #4f46e5;
        transform: translateY(-2px);
        box-shadow: 0 0 20px var(--accent-glow);
    }

    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
    }

    .project-card {
        background: var(--card-dark);
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: 1px solid var(--border-color);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.15);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .project-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(99, 102, 241, 0.15);
        border-color: var(--accent-color);
    }

    .project-image-wrapper {
        position: relative;
        height: 180px;
        overflow: hidden;
        background: #1f2937;
    }

    .project-image-wrapper img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.5s ease;
    }

    .project-card:hover .project-image-wrapper img {
        transform: scale(1.08);
    }

    .project-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(15, 23, 42, 0.7);
        opacity: 0;
        transition: opacity 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .project-card:hover .project-overlay {
        opacity: 1;
    }

    .btn-view-link {
        background: var(--accent-color);
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 15px var(--accent-glow);
        transition: all 0.2s;
    }

    .btn-view-link:hover {
        background: white;
        color: var(--bg-dark);
        box-shadow: 0 4px 15px rgba(255, 255, 255, 0.2);
    }

    .project-details {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .project-details h3 {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--text-light);
        margin: 0 0 10px 0;
        line-height: 1.4;
    }

    .project-details p {
        font-size: 0.9rem;
        color: var(--text-gray);
        line-height: 1.6;
        margin: 0 0 20px 0;
        flex: 1;
    }

    .project-actions {
        display: flex;
        gap: 10px;
        border-top: 1px solid var(--border-color);
        padding-top: 15px;
    }

    .btn-action-outline {
        flex: 1;
        padding: 8px 12px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        border: 1px solid var(--border-color);
        background: transparent;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        transition: all 0.2s ease;
        text-decoration: none;
    }

    .btn-edit-project { color: var(--text-light); }
    .btn-edit-project:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: var(--accent-color);
        color: var(--accent-color);
    }

    .btn-delete-project { color: #ef4444; }
    .btn-delete-project:hover {
        background: rgba(239, 68, 68, 0.1);
        border-color: #ef4444;
    }

    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: var(--card-dark);
        border-radius: 18px;
        border: 2px dashed var(--border-color);
    }

    .empty-state i {
        font-size: 3.5rem;
        color: var(--text-gray);
        margin-bottom: 20px;
        opacity: 0.7;
    }

    .empty-state h3 { font-size: 1.3rem; font-weight: 800; color: var(--text-light); margin-bottom: 10px; }
    .empty-state p { font-size: 0.95rem; color: var(--text-gray); margin-bottom: 25px; }

    /* 🛠️ حل مشكلة الـ Modal وتصميمها بالـ Dark Mode المذهل */
    .swal2-container {
        z-index: 100000 !important;
    }

    .project-modal-overlay {
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

    .project-modal-card {
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
</style>

<div class="projects-container">

    <div class="projects-header">
        <h2>معرض ومستودع مشاريعي التقنية</h2>
        
        <a href="#" class="btn-add-project" id="openAddProjectModal">
            <i class="fa-solid fa-plus-circle"></i>
            إضافة مشروع جديد
        </a>
    </div>

    @if($projects->isEmpty())
        <div class="empty-state">
            <i class="fa-solid fa-folder-open"></i>
            <h3>لا توجد مشاريع مضافة حالياً!</h3>
            <p>ابدأ ببناء معرض أعمالك المتميز وقم بإضافة أول مشروع برمجيات لك الآن.</p>
            <a href="#" class="btn-add-project" id="emptyStateAddBtn">
                <i class="fa-solid fa-plus-circle"></i>
                أضف مشروعك الأول
            </a>
        </div>
    @else
        <div class="projects-grid">
            @foreach($projects as $project)
                <!-- 🛠️ تم إضافة معرف الـ ID الفريد لكارت المشروع لمعالجته عبر الجافا سكريبت فورياً -->
                <div class="project-card" id="project-card-{{ $project->id }}">
                    <div class="project-image-wrapper">
                        <img 
                            src="{{ $project->image_url ? asset('storage/' . $project->image_url) : asset('images/project-placeholder.png') }}" 
                            alt="{{ $project->title }}"
                            id="img-display-{{ $project->id }}"
                        >
                        <div class="project-overlay">
                            @if($project->link_location)
                                <a href="{{ $project->link_location }}" target="_blank" class="btn-view-link" id="link-display-{{ $project->id }}">
                                    <i class="fa-solid fa-up-right-from-square"></i>
                                    معاينة حية للموقع
                                </a>
                            @else
                                <span class="btn-view-link" id="link-display-{{ $project->id }}" style="opacity: 0.8; cursor: not-allowed; background: #374151;">
                                    لا يتوفر رابط معاينة
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="project-details">
                        <h3 id="title-display-{{ $project->id }}">{{ $project->title }}</h3>
                        <p id="desc-display-{{ $project->id }}">{{ Str::limit($project->description, 120, '...') }}</p>

                        <div class="project-actions">
                            <!-- 🛠️ زر التعديل مزود بسمات Data Attributes مدمجة لحماية أكواد وعلامات النصوص -->
                            <button class="btn-action-outline btn-edit-project" 
                                    data-id="{{ $project->id }}"
                                    data-title="{{ $project->title }}"
                                    data-description="{{ $project->description }}"
                                    data-link="{{ $project->link_location }}"
                                    data-image="{{ $project->image_url ? asset('storage/' . $project->image_url) : '' }}"
                                    onclick="triggerEdit(this)">
                                <i class="fa-solid fa-pen-to-square"></i>
                                تعديل
                            </button>

                            <!-- 🛠️ زر الحذف التفاعلي الفوري -->
                            <button class="btn-action-outline btn-delete-project" onclick="triggerDelete('{{ $project->id }}')">
                                <i class="fa-solid fa-trash-can"></i>
                                حذف
                            </button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

</div>

<!-- 📦 نافذة الإضافة المتطورة والمثالية لحل مشكلة السكرول ومطابقة ثيم الدارك -->
<div id="addProjectModal" class="project-modal-overlay" style="display: none;">
    <div class="project-modal-card">
        <div class="modal-header">
            <h3>إضافة مشروع جديد للمعرض</h3>
            <button id="closeProjectModal" class="close-btn">&times;</button>
        </div>
        
        <form id="addProjectForm" enctype="multipart/form-data" style="display: flex; flex-direction: column; flex: 1; overflow: hidden;">
            @csrf
            
            <div class="modal-scrollable-content">
                <div class="form-group">
                    <label for="title">عنوان المشروع</label>
                    <input type="text" name="title" id="title" required placeholder="مثال: متجر إلكتروني متكامل">
                </div>
                
                <div class="form-group">
                    <label for="description">وصف المشروع</label>
                    <textarea name="description" id="description" rows="4" required placeholder="اكتب وصفاً تقنياً مختصراً ومميزاً للمشروع..."></textarea>
                </div>
                
                <div class="form-group">
                    <label for="link_location">رابط المشروع (معاينة حية إن وجد)</label>
                    <input type="url" name="link_location" id="link_location" placeholder="https://example.com">
                </div>
                
                <div class="form-group">
                    <label>صورة المشروع التوضيحية</label>
                    <div class="image-preview-container" id="imagePreviewContainer">
                        <input type="file" name="image_url" id="image_url" accept="image/*" style="display: none;">
                        
                        <div class="upload-dropzone" id="uploadDropzone">
                            <i class="fa-regular fa-image"></i>
                            <span>اسحب الصورة هنا أو اضغط للاختيار</span>
                            <p class="file-limits">PNG, JPG, WebP (بحد أقصى 2MB)</p>
                        </div>
                        
                        <div class="preview-box" id="previewBox" style="display: none;">
                            <img id="modalImagePreview" src="" alt="معاينة الصورة المرفقة">
                            <button type="button" class="btn-remove-preview" id="btnRemovePreview">
                                <i class="fa-solid fa-trash-can"></i>
                                إلغاء الصورة
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn-submit">حفظ وإرسال</button>
                <button type="button" id="cancelProjectModal" class="btn-cancel">إلغاء</button>
            </div>
        </form>
    </div>
</div>


<!-- 📦 ⚠️ [جديد] نافذة التعديل المتطورة والمطابقة لثيم الدارك والمشاكل البرمجية -->
<div id="editProjectModal" class="project-modal-overlay" style="display: none;">
    <div class="project-modal-card">
        <div class="modal-header">
            <h3>تعديل تفاصيل المشروع</h3>
            <button id="closeEditProjectModal" class="close-btn">&times;</button>
        </div>
        
        <form id="editProjectForm" enctype="multipart/form-data" style="display: flex; flex-direction: column; flex: 1; overflow: hidden;">
            @csrf
            <!-- حقل مخفي لتخزين الـ ID الخاص بالمشروع قيد التعديل -->
            <input type="hidden" id="edit_project_id">
            
            <div class="modal-scrollable-content">
                <div class="form-group">
                    <label for="edit_title">عنوان المشروع</label>
                    <input type="text" name="title" id="edit_title" required placeholder="عنوان المشروع">
                </div>
                
                <div class="form-group">
                    <label for="edit_description">وصف المشروع</label>
                    <textarea name="description" id="edit_description" rows="4" required placeholder="اكتب وصفاً تفنياً للمشروع..."></textarea>
                </div>
                
                <div class="form-group">
                    <label for="edit_link_location">رابط المشروع (معاينة حية إن وجد)</label>
                    <input type="url" name="link_location" id="edit_link_location" placeholder="https://example.com">
                </div>
                
                <div class="form-group">
                    <label>صورة المشروع التوضيحية</label>
                    <div class="image-preview-container" id="editImagePreviewContainer">
                        <input type="file" name="image_url" id="edit_image_url" accept="image/*" style="display: none;">
                        
                        <div class="upload-dropzone" id="editUploadDropzone">
                            <i class="fa-regular fa-image"></i>
                            <span>اسحب صورة جديدة هنا لتغيير غلاف المشروع أو اضغط</span>
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
                <button type="submit" class="btn-submit">تحديث بيانات المشروع</button>
                <button type="button" id="cancelEditProjectModal" class="btn-cancel">إلغاء</button>
            </div>
        </form>
    </div>
</div>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // ----------------------
    // 1. إدارة مودال الإضافة (الأصلي)
    // ----------------------
    const modal = document.getElementById('addProjectModal');
    const openBtn = document.getElementById('openAddProjectModal');
    const emptyAddBtn = document.getElementById('emptyStateAddBtn');
    const closeBtn = document.getElementById('closeProjectModal');
    const cancelBtn = document.getElementById('cancelProjectModal');
    const form = document.getElementById('addProjectForm');

    const fileInput = document.getElementById('image_url');
    const dropzone = document.getElementById('uploadDropzone');
    const previewBox = document.getElementById('previewBox');
    const previewImg = document.getElementById('modalImagePreview');
    const removeBtn = document.getElementById('btnRemovePreview');

    let isSubmitting = false;

    function openModal(e) {
        if(e) e.preventDefault();
        modal.style.display = 'flex';
    }

    function closeModal() {
        modal.style.display = 'none';
        form.reset();
        previewBox.style.display = 'none';
        dropzone.style.display = 'flex';
        isSubmitting = false;
    }

    if(openBtn) openBtn.addEventListener('click', openModal);
    if(emptyAddBtn) emptyAddBtn.addEventListener('click', openModal);
    if(closeBtn) closeBtn.addEventListener('click', closeModal);
    if(cancelBtn) cancelBtn.addEventListener('click', closeModal);

    window.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
    });

    if (dropzone && fileInput) {
        dropzone.addEventListener('click', () => fileInput.click());
        fileInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    dropzone.style.display = 'none';
                    previewBox.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });

        if (removeBtn) {
            removeBtn.addEventListener('click', function() {
                fileInput.value = '';
                previewBox.style.display = 'none';
                dropzone.style.display = 'flex';
            });
        }
    }

    form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (isSubmitting) return;
        isSubmitting = true;

        const submitBtn = form.querySelector('.btn-submit');
        const originalBtnHtml = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> جاري الحفظ والرفع...';

        Swal.fire({
            title: 'جاري الحفظ والتخزين...',
            text: 'يرجى الانتظار قليلاً أثناء معالجة الصور والبيانات على السيرفر المحلي',
            allowOutsideClick: false,
            allowEscapeKey: false,
            background: '#111827',
            color: '#f8fafc',
            didOpen: () => { Swal.showLoading(); }
        });

        const formData = new FormData(form);

        fetch("{{ route('dashboard.projects.store') }}", {
            method: "POST",
            body: formData,
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => {
            if (!response.ok) throw response;
            return response.json();
        })
        .then(data => {
            closeModal();
            Swal.fire({
                icon: 'success',
                title: 'تم بنجاح!',
                text: data.message || 'تم إدخال وحفظ مشروعك الجديد بنجاح!',
                background: '#111827',
                color: '#f8fafc',
                confirmButtonColor: '#6366f1',
                confirmButtonText: 'رائع جداً',
                customClass: { popup: 'swal-dark-popup' }
            }).then(() => {
                location.reload();
            });
        })
        .catch(async error => {
            isSubmitting = false;
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;

            let errorMessage = 'تأكد من إعدادات الاتصال أو حجم الصورة المرفوعة، وحاول مجدداً.';

            if (error instanceof Response) {
                const contentType = error.headers.get("content-type");
                if (contentType && contentType.indexOf("application/json") !== -1) {
                    try {
                        const errData = await error.json();
                        let errorsList = Object.values(errData.errors).flat().map(err => `<li>${err}</li>`).join('');
                        Swal.fire({
                            icon: 'warning',
                            title: 'خطأ في المدخلات',
                            html: `<ul style="text-align: right; direction: rtl; color: #94a3b8; font-family: 'Cairo'; list-style-position: inside; line-height: 1.8;">${errorsList}</ul>`,
                            background: '#111827',
                            color: '#f8fafc',
                            confirmButtonColor: '#6366f1',
                            confirmButtonText: 'تعديل البيانات',
                            customClass: { popup: 'swal-dark-popup' }
                        });
                        return; 
                    } catch (e) {}
                }
            }

            Swal.fire({
                icon: 'error',
                title: 'فشل في حفظ المشروع',
                text: errorMessage,
                background: '#111827',
                color: '#f8fafc',
                confirmButtonColor: '#ef4444',
                confirmButtonText: 'حسناً',
                customClass: { popup: 'swal-dark-popup' }
            });
        });
    });

    // ------------------------------------------
    // 2. [جديد] إدارة مودال التعديل الفاخر بالتفاعل الفوري
    // ------------------------------------------
    const editModal = document.getElementById('editProjectModal');
    const closeEditBtn = document.getElementById('closeEditProjectModal');
    const cancelEditBtn = document.getElementById('cancelEditProjectModal');
    const editForm = document.getElementById('editProjectForm');

    const editFileInput = document.getElementById('edit_image_url');
    const editDropzone = document.getElementById('editUploadDropzone');
    const editPreviewBox = document.getElementById('editPreviewBox');
    const editPreviewImg = document.getElementById('editModalImagePreview');
    const editRemoveBtn = document.getElementById('btnRemoveEditPreview');

    let isEditingSubmitting = false;

    // استدعاء المودال وملء الحقول باستخدام سمات الـ dataset لحمايتها
    window.triggerEdit = function(btn) {
        const id = btn.getAttribute('data-id');
        const title = btn.getAttribute('data-title');
        const description = btn.getAttribute('data-description');
        const link = btn.getAttribute('data-link');
        const image = btn.getAttribute('data-image');

        document.getElementById('edit_project_id').value = id;
        document.getElementById('edit_title').value = title;
        document.getElementById('edit_description').value = description;
        document.getElementById('edit_link_location').value = link || '';

        // إذا كانت هناك صورة سابقة نعرضها فوراً في المعاينة
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

    window.addEventListener('click', function(e) {
        if (e.target === editModal) closeEditModal();
    });

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

    // 🚀 تفاعل AJAX لتحديث المشروع فورياً
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (isEditingSubmitting) return;
        isEditingSubmitting = true;

        const id = document.getElementById('edit_project_id').value;
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
        // حيلة تجاوز الـ PUT لضمان رفع الصور في لارافل بسلاسة
        formData.append('_method', 'PUT');

        fetch(`/projects/update/${id}`, {
            method: "POST",
            body: formData,
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => {
            if (!response.ok) throw response;
            return response.json();
        })
        .then(data => {
            closeEditModal();
            
            // 🌟 السحر التفاعلي: تحديث الكارت فوراً وبدون تحديث الصفحة!
            const updatedProject = data.message; 
            
            // تحديث العنوان والوصف
            document.getElementById(`title-display-${id}`).textContent = updatedProject.title;
            const shortDesc = updatedProject.description.length > 120 ? updatedProject.description.substring(0, 120) + '...' : updatedProject.description;
            document.getElementById(`desc-display-${id}`).textContent = shortDesc;
            
            // تحديث الصورة إن تم رفعها جديدة
            if(updatedProject.image_url) {
                document.getElementById(`img-display-${id}`).src = `/storage/${updatedProject.image_url}`;
            }

            // تحديث الرابط الخارجي
            const linkBtn = document.getElementById(`link-display-${id}`);
            if(linkBtn) {
                if(updatedProject.link_location) {
                    linkBtn.setAttribute('href', updatedProject.link_location);
                    linkBtn.className = "btn-view-link";
                    linkBtn.innerHTML = `<i class="fa-solid fa-up-right-from-square"></i> معاينة حية للموقع`;
                    linkBtn.style.cssText = "";
                } else {
                    linkBtn.removeAttribute('href');
                    linkBtn.className = "";
                    linkBtn.style.cssText = "opacity: 0.8; cursor: not-allowed; background: #374151;";
                    linkBtn.innerHTML = "لا يتوفر رابط معاينة";
                }
            }

            // تحديث الـ Dataset لزر التعديل ليتسنى فتحه مستقبلاً بالبيانات المعدلة دون تكرار الأخطاء
            const currentEditBtn = document.querySelector(`#project-card-${id} .btn-edit-project`);
            if (currentEditBtn) {
                currentEditBtn.setAttribute('data-title', updatedProject.title);
                currentEditBtn.setAttribute('data-description', updatedProject.description);
                currentEditBtn.setAttribute('data-link', updatedProject.link_location || '');
                currentEditBtn.setAttribute('data-image', updatedProject.image_url ? `/storage/${updatedProject.image_url}` : '');
            }

            Swal.fire({
                icon: 'success',
                title: 'تم التحديث بنجاح! 🎉',
                text: 'تم تعديل تفاصيل المشروع بنجاح وتحديث الكروت فوراً في الخلفية.',
                background: '#111827',
                color: '#f8fafc',
                confirmButtonColor: '#6366f1',
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
                text: 'يرجى مراجعة المدخلات والتأكد من صياغتها، والمحاولة مرة أخرى.',
                background: '#111827',
                color: '#f8fafc',
                confirmButtonColor: '#ef4444',
                customClass: { popup: 'swal-dark-popup' }
            });
        });
    });

    // ------------------------------------------
    // 3. [جديد] حذف المشروع الفوري باستخدام AJAX
    // ------------------------------------------
    window.triggerDelete = function(id) {
        Swal.fire({
            title: 'هل أنت متأكد من الحذف؟',
            text: "لا يمكنك التراجع عن هذا الإجراء وسيتم مسح المشروع من قاعدة البيانات ومجلدات التخزين!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#4b5563',
            confirmButtonText: 'نعم، احذفه فوراً',
            cancelButtonText: 'إلغاء الأمر',
            background: '#111827',
            color: '#f8fafc',
            customClass: { popup: 'swal-dark-popup' }
        }).then((result) => {
            if (result.isConfirmed) {
                
                fetch(`/projects/delete/${id}`, {
                    method: "DELETE",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "X-Requested-With": "XMLHttpRequest"
                    }
                })
                .then(response => {
                    if (!response.ok) throw response;
                    return response.json();
                })
                .then(data => {
                    // إخفاء كارت العنصر المحذوف بتأثير حركي انسيابي خارق
                    const card = document.getElementById(`project-card-${id}`);
                    if(card) {
                        card.style.transition = 'all 0.5s cubic-bezier(0.4, 0, 0.2, 1)';
                        card.style.opacity = '0';
                        card.style.transform = 'scale(0.8) translateY(30px)';
                        setTimeout(() => {
                            card.remove();
                            // إذا أصبحت القائمة فارغة، نحدث الصفحة لإظهار الـ empty-state الجميل
                            if(document.querySelectorAll('.project-card').length === 0) {
                                location.reload();
                            }
                        }, 500);
                    }

                    Swal.fire({
                        icon: 'success',
                        title: 'تم الحذف!',
                        text: data.message || 'تم حذف المشروع بنجاح من الخادم الخاص بك.',
                        background: '#111827',
                        color: '#f8fafc',
                        confirmButtonColor: '#6366f1',
                        customClass: { popup: 'swal-dark-popup' }
                    });
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'فشل الحذف!',
                        text: 'لم نتمكن من إتمام عملية الحذف من الخادم، تيقن من صلاحيات الوصول.',
                        background: '#111827',
                        color: '#f8fafc',
                        confirmButtonColor: '#ef4444',
                        customClass: { popup: 'swal-dark-popup' }
                    });
                });
            }
        });
    }
});
</script>
@endsection