@extends('layouts.auth')

@section('content')
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto my-20 p-6 border rounded">
            <h2 class="text-2xl font-bold mb-4 text-center">{{ __('verify_your_phone') }}</h2>
            <form method="POST" action="{{ route('freelancer.verify.phone.submit') }}">
                @csrf
                <input type="hidden" name="player_id" id="player_id">
                <input type="hidden" id="platform" name="platform" value="web">

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

@push('scripts')
    <!-- Load the OneSignal SDK -->
    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>

    <script>
        window.OneSignalDeferred = window.OneSignalDeferred || [];
        OneSignalDeferred.push(async function(OneSignal) {
            // Initialize OneSignal
            await OneSignal.init({
                appId: "7ab59a87-79f3-46e8-af69-673331be40cc",
                onesignalId: "7ab59a87-79f3-46e8-af69-673331be40cc",
                // Optional: allow localhost for testing
                allowLocalhostAsSecureOrigin: true,
            });
            // var notificationUrl = "{{ url('/freelancer/notification') }}";
            // OneSignal.Notifications.setDefaultUrl(notificationUrl);

            OneSignal.Notifications.setDefaultTitle("IRHEBO");
            console.log("Notification permission status:", Notification.permission);

            // Request push permission if not already granted
            if (Notification.permission !== 'granted') {
                await OneSignal.Notifications.requestPermission();
            }


            let playerId = await OneSignal.User.PushSubscription.id;
            if (playerId) {
                console.log("User is subscribed, player ID:", playerId);
                document.getElementById("player_id").value = playerId;

            } else {
                console.log("Notifications permission not granted or no player ID yet.");

                OneSignal.User.addEventListener('subscriptionChange', async (event) => {
                    const newPlayerId = await OneSignal.User.PushSubscription.id;
                    console.log("Subscription changed — new Player ID:", newPlayerId);

                    if (newPlayerId) {
                        document.getElementById("player_id").value = newPlayerId;
                    }
                });

            }
            console.log("User's OneSignal Player ID:", playerId);
        });
    </script>
@endpush
