@extends('layouts.auth')
@push('styles')
    <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script>
    <script>
        // window.OneSignalDeferred = window.OneSignalDeferred || [];
        // OneSignalDeferred.push(async function(OneSignal) {
        //     await OneSignal.init({
        //         appId: "7ab59a87-79f3-46e8-af69-673331be40cc",
        //     });
        // });
    </script>
@endpush
@section('content')
    <div class="container mx-auto px-4 lg:px-8">
        <div class="flex justify-center items-center h-screen text-defaultsize text-defaulttextcolor">
            <div class="grid grid-cols-12 w-full">
                <div class="xxl:col-span-4 xl:col-span-3 lg:col-span-2 md:hidden"></div>
                <div class="xxl:col-span-4 xl:col-span-6 lg:col-span-8 md:col-span-12 col-span-12">
                    <!-- Logo -->
                    <div class="my-10 py-10 flex justify-center">
                        <img src="{{ asset($logo) }}" alt="logo"
                            class="desktop-logo w-[520px] sm:w-[150px] md:w-[300px] lg:w-[350px] h-auto mb-5">
                    </div>
                    <!-- Sign In Box -->
                    <div class="box max-w-3xl mx-auto shadow-lg rounded-lg">
                        <div class="box-body p-5">
                            <!-- Title -->
                            <p class="text-2xl font-bold mb-4 text-center">{{ __('sign_in') }}</p>
                            <p class="text-base text-gray-500 dark:text-gray-400 text-center mb-6">{{ __('welcome_back') }}
                            </p>
                            <!-- Form Fields -->
                            <form id="login-form" method="POST" action="{{ route('freelancer.login.submit') }}">
                                @csrf

                                <input type="hidden" id="player_id" name="player_id">
                                <input type="hidden" id="platform" name="platform" value="web">



                                <div class="grid grid-cols-12 gap-4">
                                    <!-- phone -->
                                    <div class="col-span-12">
                                        <label for="prefixLogin" class="form-label">{{ __('phone') }}</label>
                                        <div class="flex">
                                            <select id="prefixLogin" name="prefix"
                                                class="form-select border-2 rounded-md mr-2">
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->phone_code }}">{{ $country->phone_code }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <input type="tel" name="phone"
                                                class="form-control form-control-lg w-full border-2 rounded-md"
                                                id="signin-phone" placeholder="{{ __('phone') }}" required>
                                        </div>
                                    </div>
                                    <!-- Password -->
                                    <div class="col-span-12">
                                        <label for="signin-password" class="form-label flex justify-between">
                                            {{ __('password') }}
                                            <a href="#"
                                                class="text-primary hover:underline">{{ __('forgot_password') }}</a>
                                        </label>
                                        <div class="input-group">
                                            <input type="password" name="password"
                                                class="form-control border-2 rounded-l-md w-full" id="signin-password"
                                                placeholder="Enter your password" required>
                                            <button type="button" class="btn border-2 rounded-r-md px-3"
                                                onclick="createpassword('signin-password', this)">
                                                <i class="ri-eye-off-line"></i>
                                            </button>
                                        </div>
                                        {{-- <div class="form-check mt-2">
                                            <input type="checkbox" id="remember-password" name="remember"
                                                class="form-check-input">
                                            <label for="remember-password" class="form-check-label text-gray-500">
                                                {{ __('remember_password') }}
                                            </label>
                                        </div> --}}
                                    </div>
                                    <!-- Sign In Button -->
                                    <div class="col-span-12">
                                        <button type="submit"
                                            class="ti-btn ti-btn-primary w-full text-white font-medium py-3">
                                            {{ __('sign_in') }}
                                        </button>
                                    </div>
                                    <div class="col-span-12 mt-2">
                                        <a href="{{ route('auth.google') }}"
                                            class="ti-btn ti-btn-danger w-full text-white font-medium py-3 flex items-center justify-center gap-2">
                                            <i class="ri-google-fill text-lg"></i>
                                            {{ __('sign_in_with_google') }}
                                        </a>
                                    </div>
                                    <div class="col-span-12 text-center mt-4">
                                        <p class="text-sm text-gray-600">
                                            {{ __('dont_have_account') }}
                                            <a href="{{ route('freelancer.register') }}"
                                                class="text-primary hover:underline font-medium">
                                                {{ __('sign_up') }}
                                            </a>
                                        </p>
                                    </div>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- Right Spacing for Centering -->
                <div class="xxl:col-span-4 xl:col-span-3 lg:col-span-2 md:hidden"></div>
            </div>
        </div>
    </div>
@endsection


@push('scripts')
    {{-- <script src="https://cdn.onesignal.com/sdks/web/v16/OneSignalSDK.page.js" defer></script> --}}
    <script>
        window.OneSignalDeferred = window.OneSignalDeferred || [];
        OneSignalDeferred.push(async function(OneSignal) {
            await OneSignal.init({
                appId: "7ab59a87-79f3-46e8-af69-673331be40cc",
                onesignalId: "7ab59a87-79f3-46e8-af69-673331be40cc",
            });

            let permission = await OneSignal.Notifications.permission;
            if (permission !== 'granted') {
                permission = await  OneSignal.Notifications.requestPermission();
            }

            // const isSubscribed = await OneSignal.User.PushSubscription.optIn();;
            // if (!isSubscribed) {
            //     await OneSignal.registerForPushNotifications();
            // }


            const userId = await OneSignal.User.PushSubscription.id;
            console.log("player_id = ", userId);

            // خلي player_id في الحقل المخفي
            document.getElementById('player_id').value = userId || '';

            // فعل زر الإرسال فقط إذا player_id جاهز
            const submitBtn = document.getElementById('submit-btn');
            if (userId) {
                submitBtn.disabled = false;
            } else {
                alert("يرجى تفعيل الإشعارات قبل تسجيل الدخول.");
            }
        });

        // لو بدك تتأكد قبل الإرسال كمان
        document.getElementById('login-form').addEventListener('submit', function(e) {
            const playerIdValue = document.getElementById('player_id').value;
            if (!playerIdValue) {
                e.preventDefault();
                alert("يرجى تفعيل الإشعارات قبل تسجيل الدخول.");
            }
        });
    </script>
    {{-- <script>
        window.OneSignalDeferred = window.OneSignalDeferred || [];
        OneSignalDeferred.push(async function(OneSignal) {
            await OneSignal.init({
                appId: "7ab59a87-79f3-46e8-af69-673331be40cc",
            });

            // اطلب صلاحية الإشعارات
            const permission = await OneSignal.Notifications.permission;
            if (permission !== 'granted') {
                await OneSignal.Notifications.requestPermission();
            }

            // اشترك للمستخدم
            const isSubscribed = await OneSignal.User.PushSubscription.isSubscribed();
            if (!isSubscribed) {
                await OneSignal.User.PushSubscription.subscribe();
            }

            // احصل على player_id
            const subscriptionId = await OneSignal.User.PushSubscription.id;
            console.log("player_id = ", subscriptionId);

            // ضيف الـ id داخل input hidden في الفورم
            document.getElementById('player_id').value = subscriptionId;

            // تأكد قبل إرسال الفورم (اختياري)
            document.getElementById('login-form').addEventListener('submit', function(e) {
                if (!subscriptionId) {
                    e.preventDefault();
                    alert("يرجى تفعيل الإشعارات قبل تسجيل الدخول.");
                }
            });
        });
    </script> --}}
@endpush
