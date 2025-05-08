@if ($errors->any())
    <div class="fixed bottom-20 sm:bottom-8 right-4 sm:right-8 z-50 space-y-4">
        @foreach ($errors->all() as $error)
            <div x-data="{ show: true }" x-show="show" x-transition
                class="flex items-center text-sm sm:text-base justify-between gap-3 sm:gap-6 bg-red-100 border border-red-400 text-red-700 px-4 py-2 rounded-md shadow-md">
                <span>{{ $error }}</span>
                <button @click="show = false" type="button" class=" w-4 sm:w-5 aspect-square overflow-hidden text-red-700 hover:text-red-900 transition">
                    <svg viewBox="0 0 16 16" xmlns="http://www.w3.org/2000/svg" class="w-full h-full">
                        <path fill-rule="evenodd"
                            d="m8 9.414-4.293 4.293-1.414-1.414L6.586 8 2.293 3.707l1.414-1.414L8 6.586l4.293-4.293 1.414 1.414L9.414 8l4.293 4.293-1.414 1.414L8 9.414z"
                            fill="currentColor" />
                    </svg>
                </button>
            </div>
        @endforeach
    </div>
@endif
