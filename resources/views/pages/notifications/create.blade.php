@extends('layouts.master')
@section('title', __('notifications'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('build/assets/datatable/custom.datatable.css') }}">
@endpush

@section('content')
    <div class="content">
        <div class="main-content">
            <!-- Page Header -->
            <div class="block justify-between page-header md:flex mb-6">
                <div>
                    <h3 class="text-xl font-semibold">{{ __('notifications') }}</h3>
                </div>
                <ol class="flex items-center whitespace-nowrap text-sm">
                    <li class="ps-2">
                        <a class="flex items-center text-primary" href="{{ route('home.index') }}">
                            <i class="ti ti-home me-1"></i> {{ __('home') }}
                            <i class="ti ti-chevrons-right px-2 rtl:rotate-180"></i>
                        </a>
                    </li>
                    <li class="font-semibold">{{ __('notifications') }}</li>
                </ol>
            </div>

            <div class="container">
                <div class="grid grid-cols-12 gap-6">
                    <div class="col-span-12">
                        <div class="box p-6">
                            <div class="box-header mb-4">
                                <h5 class="text-lg font-semibold">{{ __('send_notifications') }}</h5>
                            </div>
                            <div class="box-body">
                                <form action="{{ route('notifications.send') }}" method="POST" class="space-y-4">
                                    @csrf

                                    <div class="flex gap-4">
                                        <div class="flex-1">
                                            <label class="block font-medium mb-1">{{ __('target_audience') }}</label>
                                            <select name="audience" required class="form-input w-full">
                                                <option value="all">{{ __('all') }}</option>
                                                <option value="freelancer">{{ __('freelancer') }}</option>
                                                <option value="client">{{ __('client') }}</option>
                                            </select>
                                        </div>

                                        <div class="flex-1">
                                            <label class="block font-medium mb-1">{{ __('platform') }}</label>
                                            <select name="platform" required class="form-input w-full">
                                                <option value="all">{{ __('all') }}</option>
                                                <option value="ios">{{ __('ios') }}</option>
                                                <option value="android">{{ __('android') }}</option>
                                            </select>
                                        </div>
                                    </div>



                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium mb-1">{{ __('title_en') }}</label>
                                            <input type="text" name="title_en" required class="form-input w-full">
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-1">{{ __('title_ar') }}</label>
                                            <input type="text" name="title_ar" required class="form-input w-full">
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label class="block font-medium mb-1">{{ __('body_en') }}</label>
                                            <textarea name="body_en" rows="4" required class="form-input w-full"></textarea>
                                        </div>
                                        <div>
                                            <label class="block font-medium mb-1">{{ __('body_ar') }}</label>
                                            <textarea name="body_ar" rows="4" required class="form-input w-full"></textarea>
                                        </div>
                                    </div>

                                    <div>
                                        <button type="submit"
                                            class="btn bg-primary text-white hover:bg-primary-dark px-6 py-2 rounded">
                                            {{ __('send_notification') }}
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
    @if (app()->getLocale() == 'en')
        <script src="{{ asset('build/assets/datatable/datatables-en.min.js') }}"></script>
    @else
        <script src="{{ asset('build/assets/datatable/datatables-ar.min.js') }}"></script>
    @endif
    <script>
        $(document).ready(function() {
            $('#basic-table').DataTable();
        });
    </script>
@endpush
