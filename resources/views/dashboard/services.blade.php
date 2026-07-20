@extends('layouts.dashboard')

@section('title', 'إدارة الخدمات - Dark Mode')
@section('page-title', 'خدماتي التقنية')

@section('content')

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    :root {
        --bg-dark: #0b0f19;
        --card-dark: #111827;
        --card-glass: rgba(17, 24, 39, 0.75);
        --accent-color: #6366f1;
        --accent-glow: rgba(99, 102, 241, 0.35);
        --border-color: rgba(255, 255, 255, 0.08);
        --text-light: #f8fafc;
        --text-gray: #94a3b8;
    }

    body {
        background-color: var(--bg-dark);
        color: var(--text-light);
    }

    /* حماية طبقة التنبيهات لتظهر دائماً فوق المودال */
    .swal2-container {
        z-index: 100000 !important;
    }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(25px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .services-container {
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        font-family: 'Cairo', sans-serif;
        direction: rtl;
    }

    .services-header {
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

    .services-header h2 {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-light);
        margin: 0;
    }

    .btn-add-service {
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

    .btn-add-service:hover {
        background: #4f46e5;
        transform: translateY(-2px);
        box-shadow: 0 0 20px var(--accent-glow);
    }

    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 25px;
    }

    .service-card {
        background: var(--card-dark);
        border-radius: 18px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        border: 1px solid var(--border-color);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.15);
        display: flex;
        flex-direction: column;
        height: 100%;
        position: relative;
    }

    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 35px rgba(99, 102, 241, 0.15);
        border-color: var(--accent-color);
    }

    .service-icon-wrapper {
        width: 60px;
        height: 60px;
        background: rgba(99, 102, 241, 0.1);
        border: 1px solid rgba(99, 102, 241, 0.2);
        color: var(--accent-color);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.8rem;
        margin-bottom: 20px;
        transition: all 0.3s ease;
    }

    .service-card:hover .service-icon-wrapper {
        background: var(--accent-color);
        color: white;
        box-shadow: 0 0 15px var(--accent-glow);
    }

    .service-details {
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .service-details h3 {
        font-size: 1.2rem;
        font-weight: 800;
        color: var(--text-light);
        margin: 0 0 12px 0;
    }

    .service-details p {
        font-size: 0.9rem;
        color: var(--text-gray);
        line-height: 1.6;
        margin: 0 0 20px 0;
        flex: 1;
    }

    .service-actions {
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

    .btn-edit-service { color: var(--text-light); }
    .btn-edit-service:hover {
        background: rgba(255, 255, 255, 0.05);
        border-color: var(--accent-color);
        color: var(--accent-color);
    }

    .btn-delete-service { color: #ef4444; }
    .btn-delete-service:hover {
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

    /* مظهر المودال الموحد */
    .service-modal-overlay {
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

    .service-modal-card {
        background: var(--card-dark);
        width: 92%;
        max-width: 500px;
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

    .modal-content {
        padding: 25px;
    }

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

<div class="services-container">

    <div class="services-header">
        <h2>إدارة الخدمات المعروضة بملفك الشخصي</h2>
        
        <a href="#" class="btn-add-service" id="openAddServiceModal">
            <i class="fa-solid fa-plus-circle"></i>
            إضافة خدمة جديدة
        </a>
    </div>

    @if($services->isEmpty())
        <div class="empty-state">
            <i class="fa-solid fa-briefcase"></i>
            <h3>لم تقم بإضافة خدماتك بعد!</h3>
            <p>ابدأ بعرض خبراتك المهنية والخدمات التي تقدمها لعملائك ومتابعيك الآن.</p>
            <a href="#" class="btn-add-service" id="emptyStateAddBtn">
                <i class="fa-solid fa-plus-circle"></i>
                أضف خدمتك الأولى
            </a>
        </div>
    @else
        @php
            $ui_icons = [
                'fa-laptop-code',
                'fa-mobile-screen-button',
                'fa-database',
                'fa-terminal',
                'fa-server',
                'fa-gears',
                'fa-code',
                'fa-network-wired',
                'fa-cubes'
            ];
        @endphp

        <div class="services-grid">
            @foreach($services as $index => $service)
                @php
                    $selected_icon = $ui_icons[$index % count($ui_icons)];
                @endphp
                <div class="service-card">
                    <div class="service-icon-wrapper">
                        <i class="fa-solid {{ $selected_icon }}"></i>
                    </div>

                    <div class="service-details">
                        <h3>{{ $service->service_title }}</h3>
                        <p>{{ $service->description }}</p>

                        <div class="service-actions">
                            {{-- تمرير بيانات الخدمة مباشرة للـ button لتسهيل تعبئة المودال --}}
                            <button class="btn-action-outline btn-edit-service" 
                                    data-id="{{ $service->id }}" 
                                    data-title="{{ $service->service_title }}" 
                                    data-description="{{ $service->description }}">
                                <i class="fa-solid fa-pen-to-square"></i>
                                تعديل
                            </button>

                            <button class="btn-action-outline btn-delete-service" 
                                    data-id="{{ $service->id }}" 
                                    data-title="{{ $service->service_title }}">
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

<!-- مودال إضافة خدمة جديدة -->
<div id="addServiceModal" class="service-modal-overlay" style="display: none;">
    <div class="service-modal-card">
        <div class="modal-header">
            <h3>إضافة خدمة مهنية جديدة</h3>
            <button id="closeServiceModal" class="close-btn">&times;</button>
        </div>
        
        <form id="addServiceForm">
            @csrf
            
            <div class="modal-content">
                <div class="form-group">
                    <label for="service_title">عنوان الخدمة</label>
                    <input type="text" name="service_title" id="service_title" required placeholder="مثال: تطوير تطبيقات الهواتف الذكية">
                </div>
                
                <div class="form-group">
                    <label for="description">وصف الخدمة</label>
                    <textarea name="description" id="description" rows="5" required placeholder="اكتب تفاصيل الخدمة بدقة والمميزات التي ستقدمها للعميل..."></textarea>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn-submit">تأكيد ونشر الخدمة</button>
                <button type="button" id="cancelServiceModal" class="btn-cancel">إلغاء</button>
            </div>
        </form>
    </div>
</div>

<!-- مودال تعديل الخدمة الحالية -->
<div id="editServiceModal" class="service-modal-overlay" style="display: none;">
    <div class="service-modal-card">
        <div class="modal-header">
            <h3>تعديل الخدمة المهنية</h3>
            <button id="closeEditServiceModal" class="close-btn">&times;</button>
        </div>
        
        <form id="editServiceForm">
            @csrf
            @method('PUT') {{-- إرسال التوجيه ليتوافق مع الـ Route PUT المكتوب --}}
            
            <!-- حقل مخفي لتخزين معرف الخدمة المراد تعديلها -->
            <input type="hidden" id="edit_service_id">
            
            <div class="modal-content">
                <div class="form-group">
                    <label for="edit_service_title">عنوان الخدمة</label>
                    <input type="text" name="service_title" id="edit_service_title" required placeholder="عنوان الخدمة">
                </div>
                
                <div class="form-group">
                    <label for="edit_description">وصف الخدمة</label>
                    <textarea name="description" id="edit_description" rows="5" required placeholder="تفاصيل الخدمة..."></textarea>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="submit" class="btn-submit">تحديث ونشر التعديلات</button>
                <button type="button" id="cancelEditServiceModal" class="btn-cancel">إلغاء</button>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // ==========================================
    // أولاً: معالجة مودال الإضافة
    // ==========================================
    const modal = document.getElementById('addServiceModal');
    const openBtn = document.getElementById('openAddServiceModal');
    const emptyAddBtn = document.getElementById('emptyStateAddBtn');
    const closeBtn = document.getElementById('closeServiceModal');
    const cancelBtn = document.getElementById('cancelServiceModal');
    const form = document.getElementById('addServiceForm');

    let isSubmitting = false;

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

    // ==========================================
    // ثانياً: معالجة مودال التعديل والتحديث
    // ==========================================
    const editModal = document.getElementById('editServiceModal');
    const closeEditBtn = document.getElementById('closeEditServiceModal');
    const cancelEditBtn = document.getElementById('cancelEditServiceModal');
    const editForm = document.getElementById('editServiceForm');
    
    let isEditing = false;

    // فتح المودال وتعبئة البيانات الحالية عند الضغط على زر "تعديل"
    document.querySelectorAll('.btn-edit-service').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const id = this.getAttribute('data-id');
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');

            // تعبئة حقول النموذج بالبيانات المستخرجة من الكرت
            document.getElementById('edit_service_id').value = id;
            document.getElementById('edit_service_title').value = title;
            document.getElementById('edit_description').value = description;

            editModal.style.display = 'flex';
        });
    });

    function closeEditModal() {
        editModal.style.display = 'none';
        editForm.reset();
        isEditing = false;
    }

    if(closeEditBtn) closeEditBtn.addEventListener('click', closeEditModal);
    if(cancelEditBtn) cancelEditBtn.addEventListener('click', closeEditModal);

    // إغلاق أي مودال عند الضغط خارجه
    window.addEventListener('click', function(e) {
        if (e.target === modal) closeModal();
        if (e.target === editModal) closeEditModal();
    });

    // إرسال بيانات الإضافة عبر AJAX
    form.addEventListener('submit', function(e) {
        e.preventDefault();
        if (isSubmitting) return;
        isSubmitting = true;

        const submitBtn = form.querySelector('.btn-submit');
        const originalBtnHtml = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> جاري الحفظ...';

        const formData = new FormData(form);

        fetch("{{ route('dashboard.services.store') }}", {
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
                title: 'تمت الإضافة بنجاح!',
                text: data.message || 'تم نشر خدمتك الجديدة بنجاح!',
                background: '#111827', color: '#f8fafc', confirmButtonColor: '#6366f1',
                confirmButtonText: 'رائع جداً',
                customClass: { popup: 'swal-dark-popup' }
            }).then(() => { location.reload(); });
        })
        .catch(async error => {
            isSubmitting = false;
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;
            handleAjaxError(error);
        });
    });

    // إرسال بيانات التعديل والتحديث عبر AJAX (PUT)
    editForm.addEventListener('submit', function(e) {
        e.preventDefault();
        if (isEditing) return;
        isEditing = true;

        const serviceId = document.getElementById('edit_service_id').value;
        const submitBtn = editForm.querySelector('.btn-submit');
        const originalBtnHtml = submitBtn.innerHTML;
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<i class="fa-solid fa-circle-notch fa-spin"></i> جاري التحديث...';

        const formData = new FormData(editForm);

        // إرسال الطلب لراوت التحديث الديناميكي المرفق من قبلك
        fetch(`/services/update/${serviceId}`, {
            method: "POST", // نستخدم POST لأن الـ FormData تحمل توجيه الـ @method('PUT') تلقائياً داخلياً
            body: formData,
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(response => {
            if (!response.ok) throw response;
            return response.json();
        })
        .then(data => {
            closeEditModal();
            Swal.fire({
                icon: 'success',
                title: 'تم التحديث بنجاح!',
                text: 'تم تعديل بيانات خدمتك ونشرها بنجاح.',
                background: '#111827', color: '#f8fafc', confirmButtonColor: '#6366f1',
                confirmButtonText: 'ممتاز',
                customClass: { popup: 'swal-dark-popup' }
            }).then(() => { location.reload(); });
        })
        .catch(async error => {
            isEditing = false;
            submitBtn.disabled = false;
            submitBtn.innerHTML = originalBtnHtml;
            handleAjaxError(error);
        });
    });

    // دالة موحدة لمعالجة أخطاء الـ Validation وعرضها بـ SweetAlert
    async function handleAjaxError(error) {
        if (error instanceof Response) {
            const contentType = error.headers.get("content-type");
            if (contentType && contentType.indexOf("application/json") !== -1) {
                try {
                    const errData = await error.json();
                    if(errData.errors) {
                        let errorsList = Object.values(errData.errors).flat().map(err => `<li>${err}</li>`).join('');
                        Swal.fire({
                            icon: 'warning',
                            title: 'خطأ في المدخلات',
                            html: `<ul style="text-align: right; direction: rtl; color: #94a3b8; font-family: 'Cairo'; list-style-position: inside; line-height: 1.8;">${errorsList}</ul>`,
                            background: '#111827', color: '#f8fafc', confirmButtonColor: '#6366f1', confirmButtonText: 'تعديل البيانات',
                            customClass: { popup: 'swal-dark-popup' }
                        });
                        return;
                    }
                } catch (e) {}
            }
        }
        Swal.fire({
            icon: 'error',
            title: 'فشل تنفيذ الإجراء',
            text: 'حدث خطأ ما أثناء معالجة طلبك، يرجى إعادة المحاولة لاحقاً.',
            background: '#111827', color: '#f8fafc', confirmButtonColor: '#ef4444', confirmButtonText: 'حسناً',
            customClass: { popup: 'swal-dark-popup' }
        });
    }

    // ==========================================
    // ثالثاً: معالجة عملية حذف الخدمة عبر AJAX
    // ==========================================
    document.querySelectorAll('.btn-delete-service').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const serviceId = this.getAttribute('data-id');
            const serviceTitle = this.getAttribute('data-title');
            
            Swal.fire({
                title: 'هل أنت متأكد؟',
                text: `سيتم حذف خدمة "${serviceTitle}" بشكل نهائي من ملفك الشخصي.`,
                icon: 'warning',
                showCancelButton: true,
                background: '#111827', color: '#f8fafc', confirmButtonColor: '#ef4444', cancelButtonColor: '#374151',
                confirmButtonText: 'نعم، احذفها', cancelButtonText: 'إلغاء',
                customClass: { popup: 'swal-dark-popup' }
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'جاري الحذف...', allowOutsideClick: false, background: '#111827', color: '#f8fafc',
                        customClass: { popup: 'swal-dark-popup' },
                        didOpen: () => { Swal.showLoading(); }
                    });

                    fetch(`/services/delete/${serviceId}`, {
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
                            icon: 'success', title: 'تم الحذف!', text: data.message || 'تم إزالة الخدمة بنجاح.',
                            background: '#111827', color: '#f8fafc', confirmButtonColor: '#6366f1', confirmButtonText: 'ممتاز',
                            customClass: { popup: 'swal-dark-popup' }
                        }).then(() => { location.reload(); });
                    })
                    .catch(error => {
                        Swal.fire({
                            icon: 'error', title: 'فشل الإجراء', text: 'حدث خطأ غير متوقع أثناء محاولة حذف الخدمة.',
                            background: '#111827', color: '#f8fafc', confirmButtonColor: '#ef4444', confirmButtonText: 'حسناً',
                            customClass: { popup: 'swal-dark-popup' }
                        });
                    });
                }
            });
        });
    });
});
</script>

@endsection