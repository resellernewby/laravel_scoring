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
              xl:text-bold">Lupa password</h2>
                @if (session('status'))
                <div class="mt-2 px-4 py-2 bg-green-200 rounded-md" role="alert">
                    {{ session('status') }}
                </div>
                @endif
                <div class="mt-12">
                    <form method="POST" action="{{ route('user.password.username') }}">
                        @csrf
                        <div>
                            <div class="text-sm font-bold text-gray-700 tracking-wide mb-2">Username</div>
                            <input name="username"
                                class="w-full text-lg py-2 border-b border-gray-300 rounded focus:outline-none focus:border-indigo-500 @error('username') border-red-500 @enderror"
                                type="text" placeholder="Masukan username" value="{{ old('username') }}" required>

                            @error('username')
                            <span class="text-red-500" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                        <div class="mt-10">
                            <button type="submit" class="bg-indigo-500 text-gray-100 p-4 w-full rounded-full tracking-wide
                          font-semibold font-display focus:outline-none focus:shadow-outline hover:bg-indigo-600
                          shadow-lg">
                                Kirim email
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