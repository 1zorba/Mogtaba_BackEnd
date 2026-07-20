 
<style>
    :root {
        --bg-dark: #070a13;
        --card-glass: rgba(15, 22, 38, 0.6);
        --accent-color: #d946ef;
        --primary-gradient: linear-gradient(135deg, #a855f7 0%, #d946ef 100%);
        --text-gray: #94a3b8;
    }

    .contact-wrapper {
        background: var(--card-glass);
        backdrop-filter: blur(20px);
max-width: 1000px;        border-radius: 28px;
        padding: 40px;
        margin: auto;
        border: 1px solid rgba(255, 255, 255, 0.08);
    }

    .form-control {
        width: 100%;
        background: rgba(255, 255, 255, 0.03);
        color: white;
        padding: 14px;
        border: 1px solid rgba(255, 255, 255, 0.08);
        border-radius: 14px;
        margin-bottom: 15px;
    }

    .btn-send {
        width: 100%;
        background: var(--primary-gradient);
        color: white;
        padding: 15px;
        border: none;
        border-radius: 14px;
        cursor: pointer;
    }

    .swal-dark-popup {
        background: #0f172a !important;
        color: #f8fafc !important;
        border-radius: 24px !important;
    }
</style>

<div class="contact-wrapper">
    <form id="contactForm">
        @csrf
        <input type="text" name="name" class="form-control" placeholder="الاسم الكامل" required>
        <input type="email" name="email" class="form-control" placeholder="البريد الإلكتروني" required>
        <input type="text" name="subjects" class="form-control" placeholder="الموضوع">
        <textarea name="contentMessage" class="form-control" rows="5" placeholder="الرسالة" required></textarea>
        
        <button type="submit" class="btn-send" id="submitBtn">
            <span>إرسال الرسالة الآن</span>
        </button>
    </form>
</div>

<script>
document.getElementById('contactForm').addEventListener('submit', function(e) {
    e.preventDefault();

    const form = this;
    const submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.querySelector('span').textContent = 'جاري الإرسال...';

    fetch("{{ route('contact.store') }}", {
        method: "POST",
        body: new FormData(form),
        headers: {
            "X-Requested-With": "XMLHttpRequest",
            "X-CSRF-TOKEN": "{{ csrf_token() }}"
        }
    })
    .then(response => response.json().then(data => ({status: response.ok, body: data})))
    .then(result => {
        submitBtn.disabled = false;
        submitBtn.querySelector('span').textContent = 'إرسال الرسالة الآن';

        if (result.status) {
            Swal.fire({
                icon: 'success',
                title: 'تم الإرسال بنجاح! 🚀',
                text: 'شكراً لتواصلك، سنرد عليك قريباً.',
                background: '#0f172a',
                color: '#fff',
                confirmButtonColor: '#d946ef',
                customClass: { popup: 'swal-dark-popup' }
            });
            form.reset();
        } else {
            throw result.body;
        }
    })
    .catch(error => {
        submitBtn.disabled = false;
        submitBtn.querySelector('span').textContent = 'إرسال الرسالة الآن';
        
        let msg = error.errors ? Object.values(error.errors).flat().join('<br>') : 'حدث خطأ غير متوقع';
        
        Swal.fire({
            icon: 'error',
            title: 'خطأ في الإرسال',
            html: msg,
            background: '#0f172a',
            color: '#fff',
            confirmButtonColor: '#d946ef',
            customClass: { popup: 'swal-dark-popup' }
        });
    });
});
</script>
