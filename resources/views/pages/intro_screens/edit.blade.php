@extends('layouts.master')
@section('title', __('edit_slider'))
@section('content')
    <div class="content">
        <div class="main-content">
            <!-- Page Header -->
            <div class="block justify-between page-header md:flex">
                <div>
                    <h3 class="text-[1.125rem] font-semibold">{{ __('edit_slider') }}</h3>
                </div>
                <ol class="flex items-center whitespace-nowrap">
                    <li class="text-[0.813rem] ps-[0.5rem]">
                        <a class="flex items-center text-primary hover:text-primary" href="{{ route('home.index') }}">
                            <i class="ti ti-home me-1"></i>{{ __('home') }}
                            <i class="ti ti-chevrons-right px-[0.5rem] rtl:rotate-180"></i>
                        </a>
                    </li>
                    <li class="text-[0.813rem] font-semibold">{{ __('edit_slider') }}</li>
                </ol>
            </div>
            <div class="container">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12">
                        <div class="box">
                            <div class="box-header">
                                <h5 class="box-title">{{ __('edit_slider') }}</h5>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('sliders.updateMobileSlider', $slider->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="grid grid-cols-12 gap-4">
                                        <!-- Platform -->
                                        <input type="hidden" name="platform" value="mobile">
                                        <!-- English Content -->
                                        <div class="col-span-12 md:col-span-6 border p-4 rounded-lg">
                                            <h6 class="mb-4">{{ __('english_content') }}</h6>
                                            <div class="space-y-4">
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">{{ __('title_en') }}</label>
                                                    <input type="text" name="title_en"
                                                        value="{{ $slider->translations->where('language', 'en')->first()?->title }}"
                                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">{{ __('description_en') }}</label>
                                                    <textarea name="description_en" rows="3"
                                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">{{ $slider->translations->where('language', 'en')->first()?->description }}</textarea>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">{{ __('media_path_en') }}</label>
                                                    <input type="file" name="media_path_en"
                                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                                                    <p class="mt-1 text-sm text-gray-500">
                                                        {{ __('leave_empty_to_keep_current_media') }}
                                                    </p>
                                                    @if ($slider->translations->where('language', 'en')->first()?->media_path)
                                                        <div class="mt-2">
                                                            <img src="{{ asset($slider->translations->where('language', 'en')->first()?->media_path) }}"
                                                                alt="Current English Media" class="max-h-32">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Arabic Content -->
                                        <div class="col-span-12 md:col-span-6 border p-4 rounded-lg">
                                            <h6 class="mb-4">{{ __('arabic_content') }}</h6>
                                            <div class="space-y-4">
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">{{ __('title_ar') }}</label>
                                                    <input type="text" name="title_ar"
                                                        value="{{ $slider->translations->where('language', 'ar')->first()?->title }}"
                                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">{{ __('description_ar') }}</label>
                                                    <textarea name="description_ar" rows="3"
                                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">{{ $slider->translations->where('language', 'ar')->first()?->description }}</textarea>
                                                </div>
                                                <div>
                                                    <label
                                                        class="block text-sm font-medium text-gray-700">{{ __('media_path_ar') }}</label>
                                                    <input type="file" name="media_path_ar"
                                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                                                    <p class="mt-1 text-sm text-gray-500">
                                                        {{ __('leave_empty_to_keep_current_media') }}
                                                    </p>
                                                    @if ($slider->translations->where('language', 'ar')->first()?->media_path)
                                                        <div class="mt-2">
                                                            <img src="{{ asset($slider->translations->where('language', 'ar')->first()?->media_path) }}"
                                                                alt="Current Arabic Media" class="max-h-32">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="flex justify-center mt-4">
                                        <button type="submit"
                                            class="px-6 py-2 text-white bg-primary hover:bg-primary-700 rounded-md shadow-sm">
                                            <i class="las la-save"></i> {{ __('update') }}
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateSliderRequest') !!}
@endpush
