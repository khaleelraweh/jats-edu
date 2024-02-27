{{-- اذا كان عندي ميسج قادمة مع الراوت نفذ التالي --}}
@if (session()->has('message'))
    {{-- لتحديد نوع الاليرت بناء علي نوع الرسالة القادمة من الرابط نستخدم مفاهيم السيشن --}}
    <div class="alert alert-{{ session()->get('alert-type') }} alert-dismissible fade show" role="alert"
        id="alert-message">
        <strong>{{ session()->get('message') }}</strong>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif
