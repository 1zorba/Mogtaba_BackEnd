@extends('layouts.dashboard')

@section('title', 'إدارة المشاريع')
@section('page-title', 'مشاريعي')

@section('content')

<style>
    :root {
        --primary-gradient: linear-gradient(135deg, #1e1b4b 0%, #312e81 100%);
        --accent-color: #4f46e5;
        --accent-glow: rgba(79, 70, 229, 0.3);
        --text-dark: #0f172a;
        --text-gray: #64748b;
        --border-color: #e2e8f0;
        --success-color: #10b981;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(25px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .projects-container {
        animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) both;
        font-family: 'Cairo', sans-serif;
        direction: rtl;
    }

    /* رأس صفحة المشاريع (التحكم والإضافة) */
    .projects-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #ffffff;
        padding: 20px 25px;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
        border: 1px solid var(--border-color);
        margin-bottom: 30px;
    }

    .projects-header h2 {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-dark);
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
        transition: all 0.3s ease;
        text-decoration: none;
    }

    .btn-add-project:hover {
        background: #312e81;
        transform: translateY(-2px);
        box-shadow: 0 6px 15px var(--accent-glow);
    }

    /* شبكة عرض المشاريع */
    .projects-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
    }

    /* كارت المشروع المطور */
    .project-card {
        background: #ffffff;
        border-radius: 18px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        border: 1px solid var(--border-color);
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.15);
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .project-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 15px 30px rgba(79, 70, 229, 0.08);
        border-color: var(--accent-color);
    }

    /* قسم صورة المشروع */
    .project-image-wrapper {
        position: relative;
        height: 180px;
        overflow: hidden;
        background: #f1f5f9;
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

    /* طبقة زجاجية فوق الصورة عند التمرير */
    .project-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(30, 27, 75, 0.4);
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
        background: white;
        color: var(--text-dark);
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 700;
        font-size: 0.85rem;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        transition: all 0.2s;
    }

    .btn-view-link:hover {
        background: var(--accent-color);
        color: white;
    }

    /* تفاصيل كارت المشروع */
    .project-details {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex: 1;
    }

    .project-details h3 {
        font-size: 1.15rem;
        font-weight: 800;
        color: var(--text-dark);
        margin: 0 0 10px 0;
        line-height: 1.4;
    }

    .project-details p {
        font-size: 0.9rem;
        color: var(--text-gray);
        line-height: 1.6;
        margin: 0 0 20px 0;
        flex: 1; /* يدفع الأزرار للأسفل لتتساوى الكروت بالارتفاع */
    }

    /* أزرار التحكم بالمشروع */
    .project-actions {
        display: flex;
        gap: 10px;
        border-top: 1px solid #f1f5f9;
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

    .btn-edit-project {
        color: var(--accent-color);
    }
    .btn-edit-project:hover {
        background: #e0e7ff;
        border-color: var(--accent-color);
    }

    .btn-delete-project {
        color: #ef4444;
    }
    .btn-delete-project:hover {
        background: #fee2e2;
        border-color: #ef4444;
    }

    /* واجهة فارغة في حال عدم وجود مشاريع (Empty State) */
    .empty-state {
        text-align: center;
        padding: 60px 20px;
        background: #ffffff;
        border-radius: 18px;
        border: 2px dashed var(--border-color);
        box-shadow: 0 4px 20px rgba(0,0,0,0.01);
    }

    .empty-state i {
        font-size: 3.5rem;
        color: var(--text-gray);
        margin-bottom: 20px;
        opacity: 0.7;
    }

    .empty-state h3 {
        font-size: 1.3rem;
        font-weight: 800;
        color: var(--text-dark);
        margin-bottom: 10px;
    }

    .empty-state p {
        font-size: 0.95rem;
        color: var(--text-gray);
        margin-bottom: 25px;
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
            <p>ابدأ ببناء معرض أعمالك المتميز وقم بإضافة أول مشروع برمجيات لك الآن لتظهر للعملاء والمتابعين.</p>
            <a href="#" class="btn-add-project" id="emptyStateAddBtn">
                <i class="fa-solid fa-plus-circle"></i>
                أضف مشروعك الأول
            </a>
        </div>
    @else
        <div class="projects-grid">
            @foreach($projects as $project)
                <div class="project-card">
                    <div class="project-image-wrapper">
                        <img 
                            src="{{ $project->image_url ? asset('storage/' . $project->image_url) : asset('images/project-placeholder.png') }}" 
                            alt="{{ $project->title }}"
                        >
                        <div class="project-overlay">
                            @if($project->link_location)
                                <a href="{{ $project->link_location }}" target="_blank" class="btn-view-link">
                                    <i class="fa-solid fa-up-right-from-square"></i>
                                    معاينة حية للموقع
                                </a>
                            @else
                                <span class="btn-view-link" style="opacity: 0.8; cursor: not-allowed;">
                                    لا يتوفر رابط معاينة
                                </span>
                            @endif
                        </div>
                    </div>

                    <div class="project-details">
                        <h3>{{ $project->title }}</h3>
                        <p>{{ Str::limit($project->description, 120, '...') }}</p>

                        <div class="project-actions">
                            <a href="#" class="btn-action-outline btn-edit-project">
                                <i class="fa-solid fa-pen-to-square"></i>
                                تعديل
                            </a>

                            <button class="btn-action-outline btn-delete-project">
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

@endsection