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
@extends('layouts.master')
@section('title', __('notifications'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('build/assets/datatable/custom.datatable.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        /* Container */
        .notifications-container {
            max-width: 900px;
            margin: 0 auto;
            padding: 1.5rem;
        }

        /* Notification card */
        .notification-card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgb(0 0 0 / 0.1);
            padding: 1.25rem 1.5rem;
            transition: box-shadow 0.3s ease, background-color 0.3s ease;
            display: block;
            text-decoration: none;
            color: inherit;
            position: relative;
            border-left: 6px solid transparent;
        }

        /* Hover effect */
        .notification-card:hover {
            box-shadow: 0 4px 15px rgb(0 0 0 / 0.15);
            background-color: #f9fafb;
            border-left-color: #3b82f6; /* Tailwind blue-500 */
        }

        /* Unread notification */
        .notification-unread {
            background-color: #eff6ff; /* Tailwind blue-100 */
            font-weight: 600;
            border-left-color: #2563eb; /* Tailwind blue-600 */
        }

        /* Title */
        .notification-title {
            font-size: 1.125rem; /* 18px */
            margin-bottom: 0.25rem;
            color: #1f2937; /* Gray-800 */
        }

        /* Message */
        .notification-message {
            font-size: 0.95rem;
            color: #4b5563; /* Gray-600 */
            margin-bottom: 0.5rem;
        }

        /* Time */
        .notification-time {
            font-size: 0.85rem;
            color: #9ca3af; /* Gray-400 */
            position: absolute;
            top: 1.25rem;
            right: 1.5rem;
            white-space: nowrap;
        }

        /* New badge */
        .notification-badge {
            display: inline-block;
            background-color: #2563eb; /* Tailwind blue-600 */
            color: white;
            font-size: 0.75rem;
            font-weight: 700;
            padding: 0.125rem 0.5rem;
            border-radius: 9999px;
            position: absolute;
            bottom: 1.25rem;
            right: 1.5rem;
            user-select: none;
        }

        /* Responsive */
        @media (max-width: 640px) {
            .notification-time,
            .notification-badge {
                position: static;
                margin-top: 0.5rem;
            }
            .notification-card {
                padding-right: 1rem;
            }
        }
    </style>
@endpush

@section('content')
<div class="notifications-container">
    <div class="mb-6 flex justify-between items-center border-b border-gray-300 pb-4">
        <h3 class="text-2xl font-bold text-gray-800">{{ __('notifications') }}</h3>
        <nav class="text-sm text-gray-500" aria-label="Breadcrumb">
            <ol class="inline-flex space-x-2 rtl:space-x-reverse">
                <li>
                    <a href="{{ route('freelancer.home.index') }}" class="flex items-center text-blue-600 hover:underline">
                        <i class="ti ti-home me-1"></i> {{ __('home') }}
                        <i class="ti ti-chevrons-right px-1 rtl:rotate-180"></i>
                    </a>
                </li>
                <li class="font-semibold text-gray-700">{{ __('notifications') }}</li>
            </ol>
        </nav>
    </div>

    @if ($notification->isEmpty())
        <div class="text-center text-gray-500 py-20 text-lg italic">
            {{ __('No new notifications.') }}
        </div>
    @else
        <div class="space-y-5">
            @foreach ($notification as $note)
                @php
                    $titleObj = json_decode($note->title);
                    $messageObj = json_decode($note->message);
                    $locale = app()->getLocale();
                    $title = $titleObj->$locale ?? __('Notification');
                    $message = $messageObj->$locale ?? '';
                @endphp

                <a href="{{ $note->link ?? '#' }}"
                   class="notification-card {{ !$note->is_read ? 'notification-unread' : '' }}">
                    <h5 class="notification-title">{{ __($title) }}</h5>
                    <p class="notification-message">{{ __($message) }}</p>
                    <time class="notification-time" title="{{ $note->created_at }}">
                        {{ $note->created_at->diffForHumans() }}
                    </time>

                    @if (!$note->is_read)
                        <span class="notification-badge">{{ __('New') }}</span>
                    @endif
                </a>
            @endforeach
        </div>
    @endif
</div>
@endsection

@push('scripts')
    @if (app()->getLocale() == 'en')
        <script src="{{ asset('build/assets/datatable/datatables-en.min.js') }}"></script>
    @else
        <script src="{{ asset('build/assets/datatable/datatables-ar.min.js') }}"></script>
    @endif

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
@endpush

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
