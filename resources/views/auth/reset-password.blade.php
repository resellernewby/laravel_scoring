<x-app-layout>
    <div class="lg:flex">
        <div class="lg:w-1/2 xl:max-w-screen-sm">
            <div class="py-12 bg-indigo-100 lg:bg-white flex justify-center lg:justify-start lg:px-12 xl:px-24">
                <div class="cursor-pointer flex items-center">
                    <img src="{{ asset('images/brand.svg') }}" class=" h-10 w-auto" alt="logo">
                </div>
            </div>
            <div class="mt-10 px-12 sm:px-24 md:px-48 lg:px-12 lg:mt-16 xl:px-24 xl:max-w-2xl">
                <h2 class="text-center text-4xl text-indigo-900 font-display font-semibold lg:text-left xl:text-5xl
              xl:text-bold">Reset Password</h2>
                @if (session('status'))
                <div class="mt-2 px-4 py-2 bg-green-200 rounded-md" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <div class="mt-12">
                    <form method="POST" action="{{ route('password.new') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">
                        <div>
                            <div class="text-sm font-bold text-gray-700 tracking-wide mb-2">Username</div>
                            <input name="username"
                                class="w-full text-lg py-2 border-b border-gray-300 rounded focus:outline-none focus:border-indigo-500 @error('username') border-red-500 @enderror"
                                type="text" placeholder="Your username"
                                value="{{ $request->username ?? old('username') }}" required>

                            @error('username')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mt-8">
                            <div class="flex justify-between items-center mb-2">
                                <div class="text-sm font-bold text-gray-700 tracking-wide">
                                    Password
                                </div>
                            </div>
                            <input name="password"
                                class="w-full text-lg py-2 border-b border-gray-300 rounded focus:outline-none focus:border-indigo-500 @error('password') border-red-500 @enderror"
                                type="password" placeholder="Password baru">

                            @error('password')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mt-8">
                            <div class="flex justify-between items-center mb-2">
                                <div class="text-sm font-bold text-gray-700 tracking-wide">
                                    Konfirmasi Password
                                </div>
                            </div>
                            <input name="password_confirmation"
                                class="w-full text-lg py-2 border-b border-gray-300 rounded focus:outline-none focus:border-indigo-500 @error('password') border-red-500 @enderror"
                                type="password" placeholder="Ulangi password baru">

                            @error('password_confirmation')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mt-10">
                            <button class="bg-indigo-500 text-gray-100 p-4 w-full rounded-full tracking-wide
                          font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-indigo-600
                          shadow-lg">
                                Login
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="hidden lg:flex items-center justify-center bg-indigo-100 flex-1 h-screen">
            <div class="transform duration-200 hover:scale-110 cursor-pointer">
                <img src="https://source.unsplash.com/VfuJpt81JZo/800x1120" class="object-cover" alt="Login">
            </div>
        </div>
    </div>
</x-app-layout>
