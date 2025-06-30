<x-guest-layout>

    {{-- Bagian Login --}}
    <section class="fixed inset-0 overflow-hidden bg-cover bg-center flex items-center justify-center"
        style="background-image: url('https://sindomanado.com/wp-content/uploads/2022/12/kantor-bps-sulut.jpg')">
        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black/70 backdrop-blur-sm"></div>

        {{-- Login Card --}}
        <div class="relative z-10 w-full max-w-md px-6">
            <div class="bg-white/95 backdrop-blur-md border border-white/30 rounded-2xl shadow-2xl p-8">

                {{-- Header with Logo Left, Text Right --}}
                <div class="flex items-center justify-center gap-4 mb-5">
                    {{-- Logo --}}
                    <div class="flex-shrink-0">
                        <img src="{{ asset('img/application-logo.svg') }}" alt="Logo BPS" class="h-12 w-12 object-contain">
                    </div>

                    {{-- Title --}}
                    <div>
                        <h2 class="text-xl font-bold text-gray-800 leading-none">
                            Badan Pusat Statistik
                        </h2>
                        <p class="text-xs text-gray-600 tracking-wide">
                            Provinsi Sulawesi Utara
                        </p>
                    </div>
                </div>

                {{-- Form --}}
                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf

                    {{-- Email --}}
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="relative">
                            <input id="email" name="email" type="email" required autofocus
                                class="mt-1 w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">

                            {{-- Icon di tengah --}}
                            <div class="absolute inset-y-0 left-3 flex items-center text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                                    stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M16 12H8m8 0a4 4 0 100-8 4 4 0 000 8zm0 0v6a4 4 0 01-4 4H8a4 4 0 01-4-4v-6" />
                                </svg>
                            </div>
                        </div>

                        @error('email')
                            <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Password --}}
                    <div x-data="{ show: false }">
                        <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                        <div class="relative">
                            <!-- Input -->
                            <input :type="show ? 'text' : 'password'" id="password" name="password" required
                                class="w-full pl-10 pr-10 py-2 border border-gray-300 rounded-lg shadow-sm focus:ring focus:ring-indigo-200 focus:border-indigo-500 transition">

                            <!-- Icon Kunci (Kiri) -->
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 11c0-1.105.895-2 2-2s2 .895 2 2m4 0v2a4 4 0 01-4 4H8a4 4 0 01-4-4v-2m12 0a4 4 0 00-8 0" />
                                </svg>
                            </div>

                            <!-- Icon Mata (Kanan) -->
                            <div class="absolute inset-y-0 right-0 pr-3 flex items-center cursor-pointer text-gray-500"
                                @click="show = !show">
                                <template x-if="!show">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                                        <path
                                            d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                                    </svg>
                                </template>
                                <template x-if="show">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor"
                                        viewBox="0 0 16 16">
                                        <path
                                            d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7 7 0 0 0-2.79.588l.77.771A6 6 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755q-.247.248-.517.486z" />
                                        <path
                                            d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829" />
                                        <path
                                            d="M3.35 5.47q-.27.24-.518.487A13 13 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7 7 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12z" />
                                    </svg>
                                </template>
                            </div>
                        </div>
                    </div>

                    {{-- Remember --}}
                    <div class="flex justify-between items-center text-sm text-gray-600">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="mr-1">
                            Ingat saya
                        </label>
                        <a href="#" class="text-indigo-600 hover:underline">Lupa password?</a>
                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full py-2 px-4 bg-gradient-to-r from-indigo-600 to-purple-600 text-white font-semibold cursor-pointer rounded-lg shadow hover:opacity-90 transition">
                        Login
                    </button>
                </form>

                {{-- Footer --}}
                <p class="text-xs text-center text-gray-400 mt-4">
                    &copy; {{ date('Y') }} Badan Pusat Statistik. All rights reserved.
                </p>
            </div>
        </div>
    </section>
</x-guest-layout>
