@extends('layouts.master')

@section('title', __('finances'))

@push('styles')
    <link rel="stylesheet" href="{{ asset('build/assets/datatable/custom.datatable.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
    <div class="content">
        <div class="main-content">
            <div class="block justify-between page-header md:flex">
                <div>
                    <h3 class="text-[1.125rem] font-semibold">{{ __('finances') }}</h3>
                </div>
                <ol class="flex items-center whitespace-nowrap">
                    <li class="text-[0.813rem] ps-[0.5rem]">
                        <a class="flex items-center text-primary" href="{{ route('home.index') }}">
                            <i class="ti ti-home me-1"></i> {{ __('home') }}
                            <i class="ti ti-chevrons-right px-[0.5rem] rtl:rotate-180"></i>
                        </a>
                    </li>
                    <li class="text-[0.813rem] font-semibold">{{ __('finances') }}</li>
                </ol>
            </div>
        </div>

        <div class="container">
            <div class="grid grid-cols-12 gap-6">
                <div class="col-span-12">
                    <div class="box">
                        <div class="box-header flex justify-between align-center">
                            <h5 class="box-title">{{ __('finances') }}</h5>
                            <button id="mark-paid-btn" type="submit" form="bulk-update-form" class="hidden flex items-center gap-2 px-4 py-2 text-white bg-success hover:bg-blue-600 rounded-lg shadow mt-3">
                                {{ __('mark_selected_as_paid') }}
                            </button>
                        </div>

                        <div class="box-body">
                            <form id="bulk-update-form" method="POST" action="{{ route('finances.bulkUpdate') }}">
                                @csrf

                                <table id="basic-table" class="table text-center">
                                    <thead>
                                        <tr>
                                            <th><input type="checkbox" id="select-all" class="rounded-sm border-gray-800 text-primary focus:ring-primary"></th>
                                            <th>#</th>
                                            <th>{{ __('request_id') }}</th>
                                            <th>{{ __('client') }}</th>
                                            <th>{{ __('freelancer') }}</th>
                                            <th>{{ __('amount') }}</th>
                                            <th>{{ __('payment_status') }}</th>
                                            <th>{{ __('paid_at') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($finances as $finance)
                                            <tr>
                                                <td>
                                                    @if ($finance->payment_status !== \App\Enums\PaymentStatusEnum::PAID->value)
                                                        <input type="checkbox" name="finance_ids[]" value="{{ $finance->id }}" class="rounded-sm border-gray-800 text-primary focus:ring-primary single-checkbox">
                                                    @endif
                                                </td>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <a class="text-primary underline" href="{{ route('requests.show', $finance->request->id) }}">
                                                        {{ $finance->request->order_number }}
                                                    </a>
                                                </td>
                                                <td>{{ $finance->request->user->username }}</td>
                                                <td>{{ $finance->request->service->user->username }}</td>
                                                <td>{{ number_format($finance->total, 0) }}</td>
                                                <td>{!! \App\Enums\PaymentStatusEnum::tryFrom($finance->payment_status)?->badge() !!}</td>
                                                <td>{{ $finance->paid_at ?? '-'}}</td>
                                               
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </form>
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

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function () {
            const $markBtn = $('#mark-paid-btn');

            function toggleButtonVisibility() {
                if ($('.single-checkbox:checked').length > 0) {
                    $markBtn.removeClass('hidden');
                } else {
                    $markBtn.addClass('hidden');
                }
            }

            $('#basic-table').DataTable({
                columnDefs: [
                    { orderable: false, targets: [0, 7] }
                ]
            });

            $('#select-all').on('change', function () {
                const checked = this.checked;
                $('.single-checkbox').prop('checked', checked);
                toggleButtonVisibility();
            });

            $(document).on('change', '.single-checkbox', function () {
                const all = $('.single-checkbox').length;
                const checkedCount = $('.single-checkbox:checked').length;

                $('#select-all').prop('checked', all > 0 && all === checkedCount);
                toggleButtonVisibility();
            });

            toggleButtonVisibility();
        });
    </script>
@endpush
