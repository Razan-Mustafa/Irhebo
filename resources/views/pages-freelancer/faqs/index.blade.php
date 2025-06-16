@extends('layouts.master')
@section('title', __('faqs'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('build/assets/datatable/custom.datatable.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        .faq-toggle-icon {
            transition: transform 0.3s ease;
        }

        .faq-toggle-icon.rotate {
            transform: rotate(45deg);
        }
    </style>
@endpush

@section('content')
    <div class="content">
        <div class="main-content">
            <div class="block justify-between page-header md:flex">
                <div>
                    <h3 class="text-[1.125rem] font-semibold">{{ __('faqs') }}</h3>
                </div>
                <ol class="flex items-center whitespace-nowrap">
                    <li class="text-[0.813rem] ps-[0.5rem]">
                        <a class="flex items-center text-primary" href="{{ route('freelancer.home.index') }}">
                            <i class="ti ti-home me-1"></i> {{ __('home') }}
                            <i class="ti ti-chevrons-right px-[0.5rem] rtl:rotate-180"></i>
                        </a>
                    </li>
                    <li class="text-[0.813rem] font-semibold">{{ __('faqs') }}</li>
                </ol>
            </div>
        </div>
        <div class="container">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12">
                    <div class="box">
                        <div class="box-header flex justify-center items-center">
                            <h1 class="font-bold">{{ __('faq') }}</h1>
                        </div>
                        <div class="box-body">

                            {{-- Filter --}}
                            <form method="GET" action="{{ route('freelancer.faqs.index') }}" class="mb-8">
                                <div class="flex items-center space-x-4">
                                    <select name="category_id" onchange="this.form.submit()"
                                        class="select2 border rounded p-2" style="width: 250px;">
                                        <option value="">{{ __('all') }}</option>
                                        <option value="1" {{ request('category_id') == 1 ? 'selected' : '' }}>
                                            {{ __('General') }}
                                        </option>

                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}"
                                                {{ request('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->translation?->title ?? 'No translation' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </form>


                            {{-- FAQs List --}}
                            <div class="space-y-4">
                                @forelse($faqs as $faq)
                                    <div class="border rounded shadow overflow-hidden">
                                        <button
                                            class=" text-xl w-full flex justify-between items-center px-5 py-4 bg-gray-100 font-semibold focus:outline-none hover:bg-gray-200 transition"
                                            onclick="toggleFaq(this)">
                                            <span>{{ $faq->translation?->question ?? 'No translation available' }}</span>
                                            <span class="faq-toggle-icon text-xl">+</span>
                                        </button>
                                        <div class="hidden px-5 py-4 bg-white border-t transition">
                                            {!! $faq->translation?->answer ?? '<p>No translation available</p>' !!}
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-gray-600">{{ __('No FAQs available for this category.') }}</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        function toggleFaq(button) {
            const answer = button.nextElementSibling;
            const icon = button.querySelector('.faq-toggle-icon');
            answer.classList.toggle('hidden');
            // icon.classList.toggle('rotate');
            icon.textContent = answer.classList.contains('hidden') ? '+' : '−';
        }
    </script>

    @if (app()->getLocale() == 'en')
        <script src="{{ asset('build/assets/datatable/datatables-en.min.js') }}"></script>
    @else
        <script src="{{ asset('build/assets/datatable/datatables-ar.min.js') }}"></script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush
