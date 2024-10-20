@extends('admin.layouts.app')

@section('content')
    <div class="container">
        <h2>تحديث الإعدادات</h2>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @php
            $hiddenKeys = [  // اخفاء بعض الحقول عن الموظفين
                'goomla_min_number', // المفاتيح التي تريد التحقق منها
                'goomla_min_prices'
            ];
            $rolesToHide = ['editor', 'supervisor']; // الأدوار التي تريد إخفاء المفاتيح لها
        @endphp

        <form action="{{ route('admin.settings.update') }}" method="POST">
            @csrf

            @foreach($settings as $setting)
                @php
                    $hideInput = false;
                    if (in_array($setting->setting_key, $hiddenKeys)) {
                        if (auth('admin')->user()) {
                            $userRoles = auth('admin')->user()->roles->pluck('name')->toArray();
                            if (array_intersect($userRoles, $rolesToHide)) {
                                $hideInput = true;
                            }
                        }
                    }
                @endphp

                @if (!$hideInput)
                    @if($setting->hide !='hide')
                        <div class="form-group">
                            <label for="{{ $setting->setting_key }}">{{ $setting->description ?? $setting->setting_key }}</label>

                            @if($setting->setting_type == 'text')
                                <!-- تطبيق Summernote على حقول textarea -->
                                <textarea id="summernote-{{ $setting->setting_key }}" name="{{ $setting->setting_key }}" class="form-control">{{ $setting->setting_value }}</textarea>
                            @elseif($setting->setting_type == 'select')
                                @if($setting->setting_key =='Maintenance_mode')
                                    <select class="form-control" name="Maintenance_mode">
                                        <option value="1 {{$setting->setting_value==1 ? 'selected': ''}}">مفعل</option>
                                        <option value="0" {{$setting->setting_value==0 ? 'selected': ''}}>غير مفعل</option>
                                    </select>
                                @endif
                            @else
                                <input type="{{ $setting->setting_type }}" name="{{ $setting->setting_key }}" value="{{ $setting->setting_value }}" class="form-control">
                            @endif
                        </div>
                    @endif
                @endif
            @endforeach

            <button type="submit" class="btn btn-primary">حفظ التعديلات</button>
        </form>
    </div>
@endsection
@push('styles')
    <style>
        .form-group{
            margin-bottom: 30px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        $(document).ready(function() {
            // تفعيل محرر Summernote لكل textarea
            @foreach($settings as $setting)
            @if($setting->setting_type == 'text')
            $('#summernote-{{ $setting->setting_key }}').summernote({
                placeholder: 'أدخل النص هنا...',
                tabsize: 2,
                height: 110, // تعيين ارتفاع المحرر
                fontSizes: ['12', '14', '16', '18', '20', '22', '24','36' ,'48','72'], // إضافة 16 بكسل

                toolbar: [
                    // تقسيم الأدوات إلى مجموعات
                    ['font', ['bold', 'italic', 'underline', 'clear']], // إضافة تنسيق النص
                    ['fontsize', ['fontsize']], // تغيير حجم الخط
                    ['color', ['forecolor']], // تغيير لون النص والخلفية
                    ['para', ['ul', 'ol', 'paragraph']], // خيارات الفقرات والقوائم
                    ['style', ['style']], // إضافة خيارات نمط النص
                    ['height', ['height']], // تغيير ارتفاع السطر
                    ['insert', ['link']], // إدراج روابط وصور وفيديوهات
                    ['view', ['fullscreen']] // عرض كود HTML وخيارات إضافية
                ],
                lang: 'ar-AR', // دعم اللغة العربية
                direction: 'rtl', // دعم الكتابة من اليمين لليسار
                callbacks: {
                    onInit: function() {
                        $('.note-editable p').css('margin-bottom', '12px');
                    }
                }
            });
            @endif
            @endforeach
        });
    </script>
@endpush
