@extends('layouts.auth')

@section('content')
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto my-20 p-6 border rounded">
            <h2 class="text-2xl font-bold mb-4 text-center">{{ __('verify_your_phone') }}</h2>
            <form method="POST" action="{{ route('freelancer.verify.phone.submit') }}">
                @csrf
                <div class="mb-4">
                    <label class="block mb-1">{{ __('verification_code') }}</label>
                    <input type="hidden" name="prefix" value="{{ $prefix }}">
                    <input type="hidden" name="phone" value="{{ $phone }}">
                    <input type="number" name="code" class="form-control" required>

                    @error('code')
                        <div class="text-red-600 mt-1 text-sm">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="ti-btn ti-btn-primary w-full">{{ __('verify') }}</button>
            </form>
            <form method="POST" action="{{ route('freelancer.resend.phone.code') }}" class="text-right">
                @csrf
                <input type="hidden" name="prefix" value="{{ $prefix }}">
                <input type="hidden" name="phone" value="{{ $phone }}">

                <button type="submit" class="text-primary underline mt-4">{{ __('resend_code') }}</button>
            </form>

        </div>
    </div>
@endsection
