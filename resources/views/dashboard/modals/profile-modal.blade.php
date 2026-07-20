<div id="profileModal" class="modal-overlay">
    <div class="modal-card">
        <!-- زينة إضاءة علوية خلفية للمودال -->
        <div class="modal-glow"></div>
        
        <div class="modal-header">
            <h3><i class="fas fa-user-edit"></i> تعديل الملف الشخصي</h3>
 <button type="button" id="closeModal" class="close-btn">&times;</button>        </div>
        
        <!-- الحاوية القابلة للتمرير الداخلي في حال صغر الشاشة -->
        <div class="modal-body">
            <form id="editProfileForm" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="form-grid">
                    <div class="form-group">
                        <label><i class="fas fa-briefcase"></i> المسمى الوظيفي</label>
                        <input type="text" name="job_title" value="{{ $user->profile?->job_title }}" required placeholder="مثال: مطور ويب">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-phone"></i> رقم الهاتف</label>
                        <input type="text" name="phone" value="{{ $user->profile?->phone }}" placeholder="+966 50 000 0000">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-file-pdf"></i> رابط الـ CV</label>
                        <input type="url" name="cv_url" value="{{ $user->profile?->cv_url }}" placeholder="https://example.com/cv.pdf">
                    </div>
                    <div class="form-group">
                        <label><i class="fas fa-star"></i> التخصص/المهارة</label>
                        <input type="text" name="borrow" value="{{ $user->profile?->borrow }}" placeholder="مثال: Laravel, Vue.js">
                    </div>
                    <div class="form-group">
                        <label><i class="fab fa-linkedin"></i>رابط حساب فيسبوك</label>
                        <input type="url" name="social_links" value="{{ $user->profile?->social_links }}" placeholder="https://linkedin.com/in/username">
                    </div>
                    <div class="form-group">
                        <label><i class="fab fa-github"></i>رابط حساب واتساب</label>
                        <input type="url" name="social_links2" value="{{ $user->profile?->social_links2 }}" placeholder="https://github.com/username">
                    </div>
                </div>

                <div class="form-group full-width" style="margin-bottom: 15px;">
                    <label><i class="fas fa-pen"></i> السيرة الذاتية (Bio)</label>
                    <input  value="{{ $user->profile?->bio }}" name="bio" rows="2" placeholder="اكتب نبذة مختصرة عنك..."></input>
                </div>
                
                <div class="form-group full-width" style="margin-bottom: 20px;">
                    <label><i class="fas fa-image"></i> الصورة الشخصية</label>
                    <div class="file-upload-wrapper">
                        <input type="file" id="profile_image" name="profile_image" accept="image/*">
                        <div class="file-upload-trigger">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <span>انقر للتصفح أو اسحب الصورة</span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="submit-btn" id="saveBtn">
                    <span class="btn-text">حفظ التغييرات</span>
                    <div class="spinner"></div>
                </button>
            </form>
        </div>
    </div>
</div>

<style>
@import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css');

:root {
    --card-bg: rgba(15, 23, 42, 0.9); /* زيادة التعتيم للوضوح */
    --border-color: rgba(51, 65, 85, 0.6);
    --primary-glow: linear-gradient(135deg, #a855f7, #d946ef);
    --input-focus: #d946ef;
    --text-muted: #94a3b8;
}

/* تم خفض الـ z-index ليكون تحت الـ SweetAlert (الذي يبدأ عادة من 1050 فما فوق) */
.modal-overlay {
    position: fixed; 
    inset: 0; 
    background: rgba(4, 6, 14, 0.75); 
    backdrop-filter: blur(15px);
    -webkit-backdrop-filter: blur(15px);
    display: none; 
    justify-content: center; 
    align-items: center; 
    z-index: 999; /* تم تعديله هنا ليكون أقل من تنبيهات SweetAlert */
    opacity: 0; 
    transition: opacity 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    padding: 20px; /* لضمان وجود مسافة على الشاشات الصغيرة جداً */
}
.modal-overlay.show { 
    display: flex; 
    opacity: 1; 
}

/* التحكم بحجم الكارد وثباته على كافة الشاشات */
.modal-card {
    position: relative;
    background: var(--card-bg); 
    border: 1px solid var(--border-color); 
    border-radius: 20px;
    padding: 24px; 
    width: 100%; 
    max-width: 650px; /* تقليص العرض قليلاً */
    max-height: 90vh; /* يمنع الكارد من الخروج عن نطاق الشاشة الرأسية */
    display: flex;
    flex-direction: column;
    box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.6), 0 0 30px rgba(168, 85, 247, 0.1);
    transform: translateY(30px) scale(0.96);
    transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    direction: rtl;
}
.modal-overlay.show .modal-card { 
    transform: translateY(0) scale(1); 
}

/* جسم المودال القابل للتمرير والتدفق */
.modal-body {
    overflow-y: auto;
    padding-right: 4px;
    padding-left: 4px;
    margin-top: 10px;
}

/* تخصيص شكل شريط التمرير ليناسب التصميم الخيالي */
.modal-body::-webkit-scrollbar {
    width: 6px;
}
.modal-body::-webkit-scrollbar-track {
    background: rgba(255, 255, 255, 0.02);
    border-radius: 10px;
}
.modal-body::-webkit-scrollbar-thumb {
    background: rgba(168, 85, 247, 0.3);
    border-radius: 10px;
}
.modal-body::-webkit-scrollbar-thumb:hover {
    background: rgba(217, 70, 239, 0.5);
}

.modal-glow {
    position: absolute;
    top: -40px;
    left: -40px;
    width: 150px;
    height: 150px;
    background: var(--primary-glow);
    filter: blur(80px);
    opacity: 0.2;
    pointer-events: none;
    z-index: 0;
}

.modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    border-bottom: 1px solid rgba(255, 255, 255, 0.08);
    padding-bottom: 12px;
    position: relative;
    z-index: 1;
}
.modal-header h3 {
    color: #fff;
    font-size: 1.25rem;
    font-weight: 700;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 8px;
    background: linear-gradient(to right, #fff, #cbd5e1);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}
.close-btn {
    background: rgba(255, 255, 255, 0.05);
    border: 1px solid rgba(255, 255, 255, 0.1);
    color: var(--text-muted);
    width: 32px;
    height: 32px;
    border-radius: 50%;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    transition: all 0.3s ease;
}
.close-btn:hover {
    background: #ef4444;
    color: white;
    transform: rotate(90deg);
}

.form-grid { 
    display: grid; 
    grid-template-columns: 1fr 1fr; 
    gap: 15px; 
    margin-bottom: 15px;
}
@media (max-width: 550px) {
    .form-grid { grid-template-columns: 1fr; gap: 12px; }
}

.form-group {
    display: flex;
    flex-direction: column;
    gap: 6px;
}
.form-group label {
    color: #cbd5e1;
    font-size: 0.85rem;
    font-weight: 600;
    display: flex;
    align-items: center;
    gap: 6px;
}
.form-group label i { color: #a855f7; }

.form-group input, .form-group textarea { 
    width: 100%; 
    background: rgba(30, 41, 59, 0.6); 
    border: 1px solid var(--border-color);
    padding: 11px 14px; 
    border-radius: 10px; 
    color: white; 
    font-size: 0.9rem;
    transition: all 0.25s;
}
.form-group input:focus, .form-group textarea:focus {
    outline: none;
    border-color: var(--input-focus);
    box-shadow: 0 0 0 3px rgba(217, 70, 239, 0.15);
}

.file-upload-wrapper {
    position: relative;
    width: 100%;
    height: 50px;
    border: 2px dashed rgba(168, 85, 247, 0.3);
    border-radius: 10px;
    background: rgba(30, 41, 59, 0.3);
    display: flex;
    align-items: center;
    justify-content: center;
    cursor: pointer;
}
.file-upload-wrapper input[type="file"] {
    position: absolute;
    width: 100%; height: 100%; opacity: 0; cursor: pointer;
}
.file-upload-trigger {
    display: flex;
    align-items: center;
    gap: 8px;
    color: #94a3b8;
    font-size: 0.85rem;
}

.submit-btn {
    position: relative;
    width: 100%; 
    padding: 14px; 
    background: linear-gradient(135deg, #8b5cf6, #d946ef);
    border: none; 
    border-radius: 10px; 
    color: white; 
    font-weight: 700; 
    font-size: 1rem;
    cursor: pointer;
    box-shadow: 0 5px 15px rgba(217, 70, 239, 0.25);
    transition: all 0.3s;
}
.submit-btn:hover { 
    transform: translateY(-2px); 
    box-shadow: 0 8px 20px rgba(217, 70, 239, 0.4);
}

.spinner {
    display: none;
    width: 18px;
    height: 18px;
    border: 2.5px solid rgba(255,255,255,0.3);
    border-radius: 50%;
    border-top-color: white;
    animation: spin 0.8s ease-in-out infinite;
    position: absolute;
    left: 50%; top: 50%;
    margin-left: -9px; margin-top: -9px;
}
@keyframes spin { to { transform: rotate(360deg); } }

.submit-btn.loading .btn-text { opacity: 0; }
.submit-btn.loading .spinner { display: block; }
.submit-btn:disabled { opacity: 0.7; cursor: not-allowed; transform: none; }
</style>

<script>
 document.getElementById('editProfileForm').addEventListener('submit', async function(e) {
    e.preventDefault();
    
    const btn = document.getElementById('saveBtn');
    btn.classList.add('loading');
    btn.disabled = true;

    const formData = new FormData(this);
    formData.append('_method', 'PUT'); 

    try {
        const response = await fetch("{{ route('profiles.update') }}", {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }
        });

        const textData = await response.text();
        let result;
        
        try {
            result = JSON.parse(textData);
        } catch(e) {
            throw new Error('السيرفر لم يقم بإرجاع استجابة JSON صالحة.');
        }

        if (response.ok) {
            Swal.fire({
                icon: 'success',
                title: 'تم التحديث بنجاح!',
                text: result.message || 'تم حفظ بيانات ملفك الشخصي بنجاح',
                background: '#0f172a',
                color: '#fff',
                confirmButtonColor: '#d946ef'
            }).then(() => {
                document.getElementById('profileModal').classList.remove('show');
            });
        } else {
            let errorMsg = 'تأكد من صحة البيانات المدخلة';
            if (result.errors) {
                errorMsg = Object.values(result.errors).flat().join('\n');
            } else if (result.message) {
                errorMsg = result.message;
            }
            throw new Error(errorMsg);
        }
    } catch (err) {
        Swal.fire({
            icon: 'error',
            title: 'خطأ في التحديث',
            text: err.message || 'حدث خطأ غير متوقع، يرجى المحاولة لاحقاً',
            background: '#0f172a',
            color: '#fff',
            confirmButtonColor: '#ef4444'
        });
    } finally {
        btn.classList.remove('loading');
        btn.disabled = false;
    }
});

document.getElementById('profile_image').addEventListener('change', function(e) {
    const filename = e.target.files[0]?.name || 'انقر للتصفح أو اسحب الصورة';
    this.nextElementSibling.querySelector('span').textContent = filename;
});

// إغلاق المودال عند الضغط على الـ X
const closeModalBtn = document.getElementById('closeModal');
const modal = document.getElementById('profileModal');

// إضافة حدث الضغط
closeModalBtn.addEventListener('click', function() {
    modal.classList.remove('show');
    // إضافة تأخير بسيط لإخفاء المودال بعد انتهاء الأنيميشن
    setTimeout(() => {
    }, 400); 
});
</script>
