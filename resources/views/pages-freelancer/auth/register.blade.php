@extends('layouts.auth')
@section('title', __('register_freelancer'))
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush
@section('content')
    <div class="container mx-auto px-4 lg:px-8 mt-28" style="margin-bottom: 100px">
        <div class="flex justify-center items-center h-screen text-defaultsize text-defaulttextcolor">

            <div class="max-w-2xl mx-auto my-10 p-6 border rounded bg-white">
                <h2 class="text-2xl font-bold mb-6 text-center">{{ __('register_freelancer') }}</h2>

                <form action="{{ route('freelancer.register.submit') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!-- avatar -->
                    <div class="mb-4 text-center">
                        <label class="font-semibold block mb-2">{{ __('avatar') }}</label>
                        <input type="file" name="avatar" class="block w-full">
                        @error('avatar')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- username -->
                    <div class="mb-4">
                        <label class="font-semibold">{{ __('username') }}</label>
                        <input type="text" name="username" value="{{ session('google_name') ?? old('username') }}"
                            class="form-control">
                        @error('username')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- email -->
                    @if (session('google_id'))
                        <input type="hidden" name="google_id" value="{{ session('google_id') ?? old('google_id') }}">
                        <div class="mb-4">
                            <label class="font-semibold">{{ __('email') }}</label>
                            <input type="email" name="email" value="{{ session('google_email') ?? old('email') }}"
                                class="form-control" readonly>
                            @error('email')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    @else
                        <div class="mb-4">
                            <label class="font-semibold">{{ __('email') }}</label>
                            <input type="email" name="email" value="{{ old('email') }}" class="form-control">
                            @error('email')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    @endif

                    @if (session('google_id'))
                        <input type="hidden" name="password" value="{{ session('password') }}">
                        <input type="hidden" name="password_confirmation" value="{{ session('password') }}">
                    @else
                        <!-- password -->
                        <div class="mb-4">
                            <label class="font-semibold">{{ __('password') }}</label>
                            <input type="password" name="password" class="form-control">
                            @error('password')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- confirm password -->
                        <div class="mb-4">
                            <label class="font-semibold">{{ __('confirm_password') }}</label>
                            <input type="password" name="password_confirmation" class="form-control">
                        </div>
                    @endif
                    <!-- prefix & phone -->
                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="font-semibold">{{ __('prefix') }}</label>
                            <select name="prefix" class="js-example-basic-multiple form-control">
                                @foreach ($countries as $country)
                                    <option value="{{ $country->phone_code }}">{{ $country->phone_code }}</option>
                                @endforeach
                            </select>
                            @error('prefix')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror

                        </div>

                        <div>
                            <label class="font-semibold">{{ __('phone') }}</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
                            @error('phone')
                                <p class="text-red-600 text-sm">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- gender -->
                    <div class="mb-4">
                        <label class="font-semibold">{{ __('gender') }}</label>
                        <select name="gender" class="form-control">
                            <option value="male">{{ __('male') }}</option>
                            <option value="female">{{ __('female') }}</option>
                        </select>
                    </div>

                    <!-- profession -->
                    <div class="mb-4">
                        <label class="font-semibold">{{ __('profession') }}</label>
                        <select name="profession_id" class="form-control">
                            @foreach ($professions as $profession)
                                <option value="{{ $profession->id }}">
                                    {{ $profession->translations->firstWhere('language', app()->getLocale())?->title }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- bio -->
                    <div class="mb-4">
                        <label class="font-semibold">{{ __('bio') }}</label>
                        <textarea name="bio" rows="3" class="form-control">{{ old('bio') }}</textarea>
                        @error('bio')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror

                    </div>

                    <!-- country -->
                    <div class="mb-4">
                        <label class="font-semibold">{{ __('country') }}</label>
                        <select name="country_id" class="js-example-basic-multiple form-control">
                            @foreach ($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- languages -->
                    <div class="mb-4">
                        <label class="font-semibold">{{ __('languages') }}</label>
                        <select name="languages[]" class="js-example-basic-multiple form-control" multiple>
                            @foreach ($languages as $language)
                                <option value="{{ $language->id }}">
                                    {{ app()->getLocale() == 'ar' ? $language->title_ar : $language->title_en }}
                                </option>
                            @endforeach
                        </select>
                        @error('languages')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- categories -->
                    <div class="mb-4">
                        <label class="font-semibold">{{ __('categories') }}</label>
                        <select name="category_ids[]" class="js-example-basic-multiple form-control" multiple>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->translation->title }}</option>
                            @endforeach
                        </select>
                        @error('category_ids')
                            <p class="text-red-600 text-sm">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- certificates -->
                    <div class="mb-4">
                        <label class="font-semibold">{{ __('certificates') }}</label>
                        <div id="certificate-wrapper">
                            <div class="flex gap-2 mb-2">
                                <input type="file" name="file[]" class="flex-1 file-input">
                                <input type="text" name="description[]"
                                    placeholder="{{ __('certificate_description') }}" class="flex-1 description-input">
                            </div>
                        </div>


                        <button type="button" id="add-certificate-btn"
                            class="text-primary text-sm">{{ __('add_more_certificates') }}</button>
                    </div>

                    <!-- submit -->
                    <div class="text-center">
                        <button type="submit" class="ti-btn ti-btn-primary w-full">{{ __('register') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {!! JsValidator::formRequest('App\\Http\\Requests\\Admin\\FreelancerRequest') !!}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            // عند تغيير اختيار الملف
            $(document).on('change', '.file-input', function() {
                let descriptionInput = $(this).closest('.flex').find('.description-input');

                if ($(this).val()) {
                    descriptionInput.attr('required', 'required');
                } else {
                    descriptionInput.removeAttr('required');
                }
            });

            // عند إضافة شهادة جديدة (لو في زر لإضافة شهادات)
            $('#add-certificate-btn').on('click', function() {
                const newCert = `
            <div class="flex gap-2 mb-2">
                <input type="file" name="file[]" class="flex-1 file-input">
                <input type="text" name="description[]" placeholder="{{ __('certificate_description') }}" class="flex-1 description-input">
            </div>
        `;
                $('#certificate-wrapper').append(newCert);
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.js-example-basic-multiple').select2({
                placeholder: "{{ __('select_options') }}",
                allowClear: true,
                width: '100%',
                closeOnSelect: false
            });
        });
    </script>
@endpush
