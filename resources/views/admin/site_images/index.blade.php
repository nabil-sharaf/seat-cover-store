@extends('admin.layouts.app')
@section('content')
    <div class="container">
        <h2 class="mb-4">إدارة صور الموقع</h2>
        <form action="{{ route('admin.settings.update-images') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Logo -->
            <div class="row mb-4">
                <label for="logo" class="col-md-4 col-form-label text-md-right">صورة اللوجو :</label>
                <div class="col-md-6">
                    <img src="{{ asset('storage/'.$siteImages?->logo) }}" alt="Logo" class="img-thumbnail mb-3" id="logo-preview" style="width:100px; max-height: 80px;">
                    <input type="file" name="logo" id="logo" class="form-control @error('logo') is-invalid @enderror" onchange="previewImage(event, 'logo-preview')">
                    @error('logo')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>


            <!-- about_us Image -->
            <div class="row mb-4">
                <label for="about_us_image" class="col-md-4 col-form-label text-md-right">صورة صفحة من نحن  :</label>
                <div class="col-md-6">
                    <img src="{{ asset('storage/'.$siteImages?->about_us_image) }}" alt="about_us_image" class="img-thumbnail mb-3" id="about_us_image-preview" style="width:100px; max-height: 80px;">
                    <input type="file" name="about_us_image" id="about_us_image" class="form-control @error('about_us_image') is-invalid @enderror" onchange="previewImage(event, 'about_us_image-preview')">
                    @error('about_us_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- about_us Image -->
            <div class="row mb-4">
                <label for="about_thumb" class="col-md-4 col-form-label text-md-right">صورةالفيديو التعريفي  :</label>
                <div class="col-md-6">
                    <img src="{{ asset('storage/'.$siteImages?->about_thumb) }}" alt="about_thumb" class="img-thumbnail mb-3" id="about_thumb-preview" style="width:100px; max-height: 80px;">
                    <input type="file" name="about_thumb" id="about_thumb" class="form-control @error('about_thumb') is-invalid @enderror" onchange="previewImage(event, 'about_thumb-preview')">
                    @error('about_thumb')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- page_title Image -->
            <div class="row mb-4">
                <label for="title_image" class="col-md-4 col-form-label text-md-right">صورة عنوان الصفحات  :</label>
                <div class="col-md-6">
                    <img src="{{ asset('storage/'.$siteImages?->title_image) }}" alt="page image" class="img-thumbnail mb-3" id="title_image-preview" style="width:100px; max-height: 80px;">
                    <input type="file" name="title_image" id="title_image" class="form-control @error('title_image') is-invalid @enderror" onchange="previewImage(event, 'title_image-preview')">
                    @error('title_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- sponsors Image -->
            <div class="row mb-4">
                <label for="sponsor_images" class="col-md-4 col-form-label text-md-right">صور الشركات الراعية   :</label>
                <div class="col-md-6">
                    <div id="sponsor-images-preview"></div>
                @if($siteImages && $siteImages?->sponsor_images)
                        @foreach($siteImages?->sponsor_images as $image)
                            <img src="{{ asset('storage/' . $image) }}" alt="Sponsor Image" class="img-thumbnail" style="display: inline; width:90px; height:60px;">
                        @endforeach
                    @else
                        <p>لايوجد.</p>
                    @endif
                        <input type="file" name="sponsor_images[]" id="sponsor_images" class="form-control @error('sponsor_images') is-invalid @enderror" multiple  onchange="previewMultipleImages(event)">
                    @error('sponsor_images')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Footer Image -->
            <div class="row mb-4">
                <label for="footer_image" class="col-md-4 col-form-label text-md-right">صورة الفوتر :</label>
                <div class="col-md-6">
                    <img src="{{ asset('storage/'.$siteImages?->footer_image) }}" alt="Footer" class="img-thumbnail mb-3" id="footer-preview" style="width:100px; max-height: 80px;">
                    <input type="file" name="footer_image" id="footer_image" class="form-control @error('footer_image') is-invalid @enderror" onchange="previewImage(event, 'footer-preview')">
                    @error('footer_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Footer Payment Image -->
            <div class="row mb-4">
                <label for="payment_image" class="col-md-4 col-form-label text-md-right">صورة وسائل الدفع :</label>
                <div class="col-md-6">
                    <img src="{{ asset('storage/'.$siteImages?->payment_image) }}" alt="payment image" class="img-thumbnail mb-3" id="payment_image-preview" style="width:100px; max-height: 80px;">
                    <input type="file" name="payment_image" id="payment_image" class="form-control @error('payment_image') is-invalid @enderror" onchange="previewImage(event, 'payment_image-preview')">
                    @error('payment_image')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Submit Button -->
            <div class="row mb-0">
                <div class="col-md-8 offset-md-4">
                    <button type="submit" class="btn btn-primary">تحديث الصور</button>
                </div>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
    <script>
        function previewImage(event, previewId) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById(previewId);
                output.src = reader.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        }
        function previewMultipleImages(event) {
            var files = event.target.files;
            var previewContainer = document.getElementById('sponsor-images-preview');

            // Clear any existing previews
            previewContainer.innerHTML = '';

            // Loop over each file and create an img element to preview
            Array.from(files).forEach(function(file) {
                var reader = new FileReader();
                reader.onload = function() {
                    var img = document.createElement('img');
                    img.src = reader.result;
                    img.className = 'img-thumbnail';
                    img.style.width = '75px';
                    img.style.height = '50px';
                    img.style.margin = '3px';
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
   </script>
@endpush
