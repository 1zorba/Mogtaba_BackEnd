@extends('layouts.dashboard')

@section('title', 'إدارة مشاريعي')
@section('page-title', 'إدارة المشاريع الشخصية')

@section('content')

<!-- الخطوط والتأثيرات البصرية -->
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;800;900&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --bg-dark: #070a13;
        --card-dark: #0f1626;
        --card-glass: rgba(15, 22, 38, 0.7);
        --accent-glow: rgba(217, 70, 239, 0.25);
        --primary-gradient: linear-gradient(135deg, #a855f7 0%, #d946ef 100%);
        --accent-color: #d946ef;
        --border-color: rgba(255, 255, 255, 0.06);
        --text-light: #f8fafc;
        --text-gray: #94a3b8;
    }

    body {
        background-color: var(--bg-dark);
        color: var(--text-light);
        font-family: 'Cairo', sans-serif;
    }

    /* هيدر الصفحة */
    .projects-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: var(--card-glass);
        backdrop-filter: blur(14px);
        padding: 22px 30px;
        border-radius: 20px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        margin-bottom: 40px;
        direction: rtl;
    }

    .projects-header h2 {
        font-size: 1.4rem;
        font-weight: 900;
        background: var(--primary-gradient);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        margin: 0;
    }

    /* شبكة الكروت التفاعلية */
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
        direction: rtl;
    }

    .project-card {
        background: var(--card-dark);
        border-radius: 24px;
        border: 1px solid var(--border-color);
        overflow: hidden;
        display: flex;
        flex-direction: column;
        transition: all 0.4s cubic-bezier(0.25, 1, 0.5, 1);
        position: relative;
    }

    .project-card:hover {
        transform: translateY(-8px);
        border-color: rgba(217, 70, 239, 0.3);
        box-shadow: 0 15px 35px rgba(217, 70, 239, 0.08), 0 20px 40px rgba(0, 0, 0, 0.4);
    }

    /* غلاف صورة المشروع الشخصي مع التغطية */
    .project-image-wrapper {
        width: 100%;
        height: 190px;
        overflow: hidden;
        position: relative;
        background: #090e1a;
    }

    .project-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.25, 1, 0.5, 1);
    }

    .project-card:hover .project-image {
        transform: scale(1.08);
    }

    /* محتويات الكارت */
    .project-info {
        padding: 22px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        flex-grow: 1;
    }

    .project-title {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--text-light);
        margin: 0;
    }

    .project-desc {
        font-size: 0.88rem;
        color: var(--text-gray);
        line-height: 1.6;
        margin: 0;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* أزرار الإجراءات */
    .project-actions {
        display: flex;
        gap: 12px;
        padding: 15px 22px 22px 22px;
        border-top: 1px solid rgba(255, 255, 255, 0.04);
    }

    .btn-action {
        flex: 1;
        padding: 10px;
        border-radius: 12px;
        font-family: 'Cairo';
        font-weight: 800;
        font-size: 0.85rem;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        transition: all 0.3s;
        border: none;
    }

    .btn-edit {
        background: rgba(217, 70, 239, 0.1);
        color: var(--accent-color);
        border: 1px solid rgba(217, 70, 239, 0.2);
    }

    .btn-edit:hover {
        background: var(--primary-gradient);
        color: white;
        box-shadow: 0 0 15px var(--accent-glow);
    }

    .btn-delete {
        background: rgba(239, 68, 68, 0.1);
        color: #ef4444;
        border: 1px solid rgba(239, 68, 68, 0.2);
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
        box-shadow: 0 0 15px rgba(239, 68, 68, 0.3);
    }

    /* نافذة المودال للتعديل (Glassmorphic Modal) */
    .edit-modal-overlay {
        position: fixed;
        top: 0; left: 0; width: 100%; height: 100%;
        background: rgba(3, 5, 11, 0.85);
        backdrop-filter: blur(15px);
        -webkit-backdrop-filter: blur(15px);
        z-index: 9999;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .edit-modal-card {
        background: #0f172a;
        width: 90%; max-width: 520px;
        border-radius: 24px;
        box-shadow: 0 30px 70px rgba(0,0,0,0.8);
        border: 1px solid rgba(217, 70, 239, 0.2);
        padding: 30px;
        direction: rtl;
        animation: modalFadeIn 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    }

    @keyframes modalFadeIn {
        0% { opacity: 0; transform: translateY(30px) scale(0.95); }
        100% { opacity: 1; transform: translateY(0) scale(1); }
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid rgba(255,255,255,0.06);
        padding-bottom: 15px;
        margin-bottom: 25px;
    }

    .modal-header h3 { font-size: 1.2rem; font-weight: 800; margin: 0; color: var(--text-light); }
    
    .modal-close-btn {
        background: none; border: none; color: var(--text-gray); font-size: 1.5rem; cursor: pointer;
    }
    .modal-close-btn:hover { color: #ef4444; }

    /* حقول الإدخال */
    .form-group {
        display: flex;
        flex-direction: column;
        gap: 8px;
        margin-bottom: 20px;
    }

    .form-group label { font-size: 0.85rem; font-weight: 800; color: #cbd5e1; }
    
    .form-control {
        width: 100%;
        background: rgba(255, 255, 255, 0.03);
        color: white;
        padding: 12px 16px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 12px;
        font-family: 'Cairo';
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .form-control:focus {
        outline: none; border-color: var(--accent-color);
        box-shadow: 0 0 0 4px rgba(217, 70, 239, 0.2);
    }

    /* حاوية استعراض الصورة قبل الحفظ */
    .image-preview-container {
        width: 100px; height: 65px; border-radius: 8px; overflow: hidden; border: 1px solid rgba(255,255,255,0.1); margin-top: 8px;
    }

    .image-preview-container img { width: 100%; height: 100%; object-fit: cover; }

    .btn-submit-update {
        width: 100%;
        background: var(--primary-gradient);
        color: white;
        padding: 14px;
        border: none;
        border-radius: 12px;
        font-family: 'Cairo';
        font-weight: 800;
        font-size: 0.95rem;
        cursor: pointer;
        transition: all 0.3s;
        box-shadow: 0 5px 15px var(--accent-glow);
    }

    .btn-submit-update:hover { transform: translateY(-2px); box-shadow: 0 8px 20px rgba(217, 70, 239, 0.4); }

    /* حالة عدم وجود مشاريع */
    .empty-state {
        text-align: center; padding: 70px 20px; background: var(--card-dark); border-radius: 24px; border: 2px dashed rgba(255,255,255,0.06); direction: rtl;
    }
    .empty-state i { font-size: 3.5rem; color: var(--accent-color); opacity: 0.6; margin-bottom: 20px; }
    .empty-state h3 { font-size: 1.3rem; font-weight: 800; margin-bottom: 8px; }
    .empty-state p { color: var(--text-gray); }

    .swal-dark-popup {
        border: 1px solid rgba(217, 70, 239, 0.2) !important;
        font-family: 'Cairo', sans-serif !important;
        border-radius: 24px !important;
    }
</style>

<div class="container-fluid" style="padding: 10px;">
    
    <!-- هيدر الصفحة -->
    <div class="projects-header">
        <h2>إدارة وتحرير مشروعاتي الشخصية</h2>
        <span style="font-weight: 800; color: var(--text-gray); font-size: 0.9rem;">
            إجمالي المشاريع الحالية: {{ $myProjects->count() }}
        </span>
    </div>

    @if($myProjects->isEmpty())
        <div class="empty-state">
            <i class="fa-solid fa-folder-open"></i>
            <h3>لا توجد أي مشاريع بعد!</h3>
            <p>قم بإضافة مشروعك الأول ليظهر هنا وتتمكن من إدارته وتعديله.</p>
        </div>
    @else
        <!-- شبكة المشاريع التفاعلية -->
        <div class="projects-grid">
            @foreach($myProjects as $project)
                <!-- الكارت الفردي للمشروع بـ ID فريد برمجياً -->
                <div class="project-card" id="project-card-{{ $project->id }}">
                    <div class="project-image-wrapper">
                        <!-- مسار استعراض الصورة مع وضع صورة افتراضية عند عدم الوجود -->
                        <img src="{{ $project->image_url ? asset('storage/' . $project->image_url) : 'https://placehold.co/600x400/0f1626/f8fafc?text=Project' }}" 
                             alt="{{ $project->title ?? $project->name }}" 
                             id="img-display-{{ $project->id }}"
                             class="project-image">
                    </div>

                    <div class="project-info">
                        <!-- تلميح: لو كان لديك اسم العمود name بالداتابيس وليس title استبدله أدناه -->
                        <h4 class="project-title" id="title-display-{{ $project->id }}">
                            {{ $project->title ?? $project->name }}
                        </h4>
                        <p class="project-desc" id="desc-display-{{ $project->id }}">
                            {{ $project->description }}
                        </p>
                    </div>

                    <!-- أزرار الإجراءات الفورية للتعديل والحذف -->
                    <div class="project-actions">
                        <button class="btn-action btn-delete" onclick="triggerDelete('{{ $project->id }}')">
                            <i class="fa-regular fa-trash-can"></i>
                            حذف المشروع
                        </button>

                        <button class="btn-action btn-edit" 
                                onclick="openEditModal('{{ $project->id }}', '{{ e($project->title ?? $project->name) }}', '{{ e($project->description) }}', '{{ $project->image_url ? asset('storage/' . $project->image_url) : '' }}')">
                            <i class="fa-regular fa-pen-to-square"></i>
                            تعديل المشروع
                        </button>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>

<!-- مظهر منبثقة التعديل الزجاجية الاحترافية (Hidden by default) -->
<div id="editProjectModal" class="edit-modal-overlay" style="display: none;">
    <div class="edit-modal-card">
        <div class="modal-header">
            <h3>تعديل تفاصيل المشروع</h3>
            <button class="modal-close-btn" onclick="closeEditModal()">&times;</button>
        </div>

        <form id="editProjectForm" enctype="multipart/form-data">
            @csrf
            <!-- حقل مخفي لحفظ الـ ID الحالي قيد التعديل -->
            <input type="hidden" id="editProjectId">

            <!-- عنوان المشروع -->
            <div class="form-group">
                <label for="editTitle">عنوان المشروع</label>
                <!-- يرجى تعديل الـ name إلى "name" إذا كان العمود بقاعدة البيانات باسم name -->
                <input type="text" name="title" id="editTitle" class="form-control" required>
            </div>

            <!-- وصف المشروع -->
            <div class="form-group">
                <label for="editDescription">الوصف</label>
                <textarea name="description" id="editDescription" rows="4" class="form-control" required></textarea>
            </div>

            <!-- الصورة الشخصية للمشروع -->
            <div class="form-group">
                <label for="editImage">تغيير غلاف الصورة (اختياري)</label>
                <input type="file" name="image_url" id="editImage" class="form-control" accept="image/*">
                
                <!-- معاينة الصورة الحالية بشكل فوري -->
                <div class="image-preview-container" id="currentImagePreviewContainer" style="display: none;">
                    <img id="currentImagePreview" src="" alt="المعاينة">
                </div>
            </div>

            <button type="submit" class="btn-submit-update" id="submitUpdateBtn">
                <i class="fa-regular fa-circle-check"></i>
                حفظ التغييرات الجديدة
            </button>
        </form>
    </div>
</div>

<script>
// دالة فتح مودال التعديل وملء الحقول بالبيانات الحالية تلقائياً
function openEditModal(id, title, description, imageUrl) {
    document.getElementById('editProjectId').value = id;
    document.getElementById('editTitle').value = title;
    document.getElementById('editDescription').value = description;

    const previewContainer = document.getElementById('currentImagePreviewContainer');
    const previewImg = document.getElementById('currentImagePreview');

    if (imageUrl) {
        previewImg.src = imageUrl;
        previewContainer.style.display = 'block';
    } else {
        previewContainer.style.display = 'none';
    }

    document.getElementById('editProjectModal').style.display = 'flex';
}

function closeEditModal() {
    document.getElementById('editProjectModal').style.display = 'none';
    document.getElementById('editProjectForm').reset();
}

// 🌐 تفاعل الـ AJAX لتعديل المشروع فوراً وحفظ الصور
document.getElementById('editProjectForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const id = document.getElementById('editProjectId').value;
    const submitBtn = document.getElementById('submitUpdateBtn');
    
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> جاري تحديث بيانات المشروع...';

    // استخدام FormData لدعم رفع الملفات التفاعلي
    const formData = new FormData(this);
    
    // 💡 أهم سطر: نرسل PUT بالخفاء ليتعرف عليها لارافل بروت التحديث بنجاح!
    formData.append('_method', 'PUT');

    // إنشاء رابط المسار ديناميكياً
    const updateUrl = `/dashboard/projects/update/${id}`;

    fetch(updateUrl, {
        method: "POST", // نرسله POST ليعمل الفورم داتا، واللارافل سيفهمه كـ PUT بفضل السطر بالأعلى
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
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fa-regular fa-circle-check"></i> حفظ التغييرات الجديدة';
        closeEditModal();

        // 🌟 تحديث البيانات فورياً بالواجهة دون الحاجة لتحديث الصفحة!
        const project = data.message;
        document.getElementById(`title-display-${id}`).textContent = project.title || project.name;
        document.getElementById(`desc-display-${id}`).textContent = project.description;
        
        if (project.image_url) {
            document.getElementById(`img-display-${id}`).src = `/storage/${project.image_url}`;
        }

        Swal.fire({
            icon: 'success',
            title: 'تم تحديث المشروع بنجاح 🎉',
            text: 'تم الحفظ وتحديث الواجهة تلقائياً.',
            background: '#0f172a',
            color: '#f8fafc',
            confirmButtonColor: '#d946ef',
            customClass: { popup: 'swal-dark-popup' }
        });
    })
    .catch(async error => {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fa-regular fa-circle-check"></i> حفظ التغييرات الجديدة';
        
        Swal.fire({
            icon: 'error',
            title: 'فشل التحديث!',
            text: 'حدث خطأ أثناء الاتصال أو أن الحقول المدخلة غير متطابقة.',
            background: '#0f172a',
            color: '#f8fafc',
            confirmButtonColor: '#ef4444',
            customClass: { popup: 'swal-dark-popup' }
        });
    });
});

// 🗑️ دالة حذف المشروع باستخدام الـ AJAX الفوري وتأكيد الحذف التفاعلي
function triggerDelete(id) {
    Swal.fire({
        title: 'هل أنت متأكد من الحذف؟',
        text: "لا يمكنك التراجع عن هذا الإجراء وسيتم حذف صورة غلاف المشروع بالكامل!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#ef4444',
        cancelButtonColor: '#475569',
        confirmButtonText: 'نعم، احذفه الآن',
        cancelButtonText: 'إلغاء',
        background: '#0f172a',
        color: '#f8fafc',
        customClass: { popup: 'swal-dark-popup' }
    }).then((result) => {
        if (result.isConfirmed) {
            
            // إرسال طلب الحذف الفعلي بالـ AJAX
            fetch(`/dashboard/projects/delete/${id}`, {
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
                // إخفاء كارت المشروع فوراً من الصفحة بتأثير حركي رائع
                const card = document.getElementById(`project-card-${id}`);
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '0';
                card.style.transform = 'scale(0.8)';
                setTimeout(() => card.remove(), 500);

                Swal.fire({
                    icon: 'success',
                    title: 'تم الحذف بنجاح! 🚀',
                    text: data.message,
                    background: '#0f172a',
                    color: '#f8fafc',
                    confirmButtonColor: '#d946ef',
                    customClass: { popup: 'swal-dark-popup' }
                });
            })
            .catch(error => {
                Swal.fire({
                    icon: 'error',
                    title: 'حدث عطل ما!',
                    text: 'لم نتمكن من حذف المشروع، يرجى التحقق والتجربة لاحقاً.',
                    background: '#0f172a',
                    color: '#f8fafc',
                    confirmButtonColor: '#ef4444',
                    customClass: { popup: 'swal-dark-popup' }
                });
            });
        }
    });
}
</script>

@endsection