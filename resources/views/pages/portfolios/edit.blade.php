@extends('layouts.master')
@section('title', __('edit_portfolio'))
@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endpush

@section('content')
<div class="content">
    <div class="main-content">
        <!-- Page Header -->
        <div class="block justify-between page-header md:flex">
            <div>
                <h3 class="text-[1.125rem] font-semibold">{{ __('edit_portfolio') }}</h3>
            </div>
            <ol class="flex items-center whitespace-nowrap">
                <li class="text-[0.813rem] ps-[0.5rem]">
                    <a class="flex items-center text-primary" href="{{ route('portfolios.index') }}">
                        {{ __('portfolios') }}
                        <i class="ti ti-chevrons-right px-[0.5rem] rtl:rotate-180"></i>
                    </a>
                </li>
                <li class="text-[0.813rem] font-semibold">{{ __('edit_portfolio') }}</li>
            </ol>
        </div>
    </div>

    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
        @endif

        <div class="grid grid-cols-12 gap-6">
            <div class="col-span-12">
                <div class="box">
                    <div class="box-header">
                        <h5 class="box-title">{{ __('edit_portfolio') }}</h5>
                    </div>
                    <div class="box-body">
                        <form action="{{ route('portfolios.update', $portfolio->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="grid grid-cols-12 gap-4 my-3">
                                <div class="col-span-12">
                                    <label class="block text-sm font-medium text-gray-700">{{ __('title') }}</label>
                                    <input type="text" name="title" value="{{ old('title', $portfolio->title) }}"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                                </div>

                                <div class="col-span-12">
                                    <label class="block text-sm font-medium text-gray-700">{{ __('description') }}</label>
                                    <textarea name="description" rows="5"
                                        class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">{{ old('description', $portfolio->description) }}</textarea>
                                </div>

                                <div class="col-span-12">
                                    <label class="block text-sm font-medium text-gray-700">{{ __('cover') }}</label>
                                    <input type="file" name="cover" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                                    @if($portfolio->cover)
                                        <img src="{{ asset($portfolio->cover) }}" alt="Cover" class="mt-2 h-24">
                                    @endif
                                </div>

                                <div class="col-span-12">
                                    <label class="block text-sm font-medium text-gray-700">{{ __('media') }}</label>
                                    <input type="file" name="media[]" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-primary focus:border-primary" multiple>
                                    {{-- Optionally show existing media --}}
                                </div>

                                <div class="col-span-12 md:col-span-6">
                                    <label for="freelancer_id"
                                        class="block text-sm font-medium text-gray-700">{{ __('freelancers') }}</label>
                                    <select name="user_id" id="freelancer_id"
                                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-primary focus:border-primary">
                                        <option value="">{{ __('freelancers') }}</option>
                                        @foreach ($freelancers as $freelancer)
                                            <option value="{{ $freelancer->id }}" {{ old('user_id', $portfolio->user_id) == $freelancer->id ? 'selected' : '' }}>
                                                {{ $freelancer->username }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-span-12 md:col-span-6">
                                    <label for="service_ids"
                                        class="block text-sm font-medium text-gray-700">{{ __('services') }}</label>
                                    <select name="service_ids[]" id="service_ids"
                                        class="js-example-basic-multiple mt-1 block w-full rounded-lg border-gray-300"
                                        multiple></select>
                                </div>
                            </div>

                            <div class="mt-6 text-center">
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

@endsection

@push('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdatePortfolioRequest') !!}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
 <script>
    $(document).ready(function () {
        let oldSelectedServices = {!! json_encode(old('service_ids', $portfolio->services->pluck('id')->toArray())) !!};

        function loadServices(freelancerId) {
            $.ajax({
                url: '{{ url('api/v1/services/get-by-user') }}',
                type: 'GET',
                data: {
                    user_id: freelancerId
                },
                success: function (response) {
                    if (response.status) {
                        let options = '';
                        response.data.services.forEach(service => {
                            let selected = oldSelectedServices.includes(service.id) || oldSelectedServices.includes(service.id.toString()) ? 'selected' : '';
                            options += `<option value="${service.id}" ${selected}>${service.title}</option>`;
                        });

                        $('#service_ids')
                            .html(options)
                            .val(oldSelectedServices)
                            .select2({
                                placeholder: "اختر الخيارات",
                                allowClear: true,
                                width: '100%',
                                closeOnSelect: false
                            })
                            .trigger('change');
                    }
                }
            });
        }

        // Initial load if editing an existing portfolio with user_id
        let initialFreelancer = '{{ old('user_id', $portfolio->user_id) }}';
        if (initialFreelancer) {
            $('#freelancer_id').val(initialFreelancer);
            loadServices(initialFreelancer);
        }

        // On freelancer change
        $('#freelancer_id').on('change', function () {
            let freelancerId = $(this).val();
            if (freelancerId) {
                loadServices(freelancerId);
            } else {
                $('#service_ids').html('').trigger('change');
            }
        });
    });
</script>

@endpush
