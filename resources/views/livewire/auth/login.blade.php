<div class="min-h-screen flex items-center justify-center bg-gray-100">
    <div class="w-full max-w-md p-8 bg-white rounded shadow">
        <h1 class="text-2xl font-bold mb-6 text-center">{{ $title }}</h1>

        @if (session()->has('error'))
            <div class="mb-4 p-2 bg-red-100 text-red-700 rounded">
                {{ session('error') }}
            </div>
        @endif

        <form wire:submit.prevent="login">
            <div class="mb-4">
                <label for="email" class="block mb-1 font-semibold">Email</label>
                <input wire:model="email" type="email" id="email" class="w-full border border-gray-300 p-2 rounded" placeholder="Enter your email">
                @error('email') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <div class="mb-4">
                <label for="password" class="block mb-1 font-semibold">Password</label>
                <input wire:model="password" type="password" id="password" class="w-full border border-gray-300 p-2 rounded" placeholder="Enter your password">
                @error('password') 
                    <span class="text-red-500 text-sm">{{ $message }}</span> 
                @enderror
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-2 rounded hover:bg-blue-700">
                Login
            </button>
        </form>
    </div>
</div>
