@if (session('success'))
    <div class="fixed bottom-20 sm:bottom-8 right-4 sm:right-8 z-50 space-y-4">
        <div x-data="{ show: true }" x-show="show" x-transition
            class="flex items-center text-sm sm:text-base justify-between gap-3 sm:gap-6 bg-green-100 border border-green-400 text-green-700 px-4 py-2 rounded-md shadow-md">
            <span>{{ session('success') }}</span>
            <button @click="show = false" type="button" class="w-4 sm:w-5 aspect-square overflow-hidden text-green-700 hover:text-green-900 transition">
                <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                    <path fill-rule="evenodd"
                        d="m8 9.414-4.293 4.293-1.414-1.414L6.586 8 2.293 3.707l1.414-1.414L8 6.586l4.293-4.293 1.414 1.414L9.414 8l4.293 4.293-1.414 1.414L8 9.414z"
                        fill="currentColor" />
                </svg>
            </button>
        </div>
    </div>
@endif