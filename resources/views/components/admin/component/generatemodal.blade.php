@props(['title', 'route'])
<div x-show="generatemodal"
    class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center z-40">
    <div class="w-full max-w-[720px] bg-white pb-6 rounded-md flex flex-col gap-4 relative overflow-hidden border-2 border-byolink-1">
        <button @click="generatemodal = false"
            class=" absolute top-6 right-6 w-6 h-6 text-white hover:text-red-500 duration-300">
            <svg viewBox="0 0 512 512" xml:space="preserve" xmlns="http://www.w3.org/2000/svg"
                enable-background="new 0 0 512 512">
                <path
                    d="M437.5 386.6 306.9 256l130.6-130.6c14.1-14.1 14.1-36.8 0-50.9-14.1-14.1-36.8-14.1-50.9 0L256 205.1 125.4 74.5c-14.1-14.1-36.8-14.1-50.9 0-14.1 14.1-14.1 36.8 0 50.9L205.1 256 74.5 386.6c-14.1 14.1-14.1 36.8 0 50.9 14.1 14.1 36.8 14.1 50.9 0L256 306.9l130.6 130.6c14.1 14.1 36.8 14.1 50.9 0 14-14.1 14-36.9 0-50.9z"
                    fill="currentColor" class="fill-000000"></path>
            </svg>
        </button>
        <div class=" pt-6 pb-3 bg-byolink-1 text-white">
            <h2 class=" px-6 text-2xl font-bold">Generate Artikel</h2>
        </div>
        <form action="{{ $route }}" method="POST"
            class="inline">
            @csrf
            <div class=" px-6 pb-4 space-y-4">
                <x-admin.component.numberinput title="Jumlah generate artikel" placeholder="Masukkan jumlah generate" :value="''" name="total" />
                <div class=" w-full grid grid-cols-2 gap-4">
                    <div class=" w-full">
                        <input type="radio" name="schedule" value="1" id="1" class="hidden peer" checked>
                        <label for="1" class=" w-full cursor-pointer flex justify-center p-2 text-sm sm:text-base text-center font-medium rounded-md duration-300 peer-checked:bg-byolink-1 peer-checked:text-white">Schedule On</label>
                    </div>
                    
                    <div class=" w-full">
                        <input type="radio" name="schedule" value="0" id="0" class="hidden peer">
                        <label for="0" class=" w-full cursor-pointer flex justify-center p-2 text-sm sm:text-base text-center font-medium rounded-md duration-300 peer-checked:bg-byolink-1 peer-checked:text-white">Schedule Off</label>
                    </div>
                </div>
            </div>
            <div class="flex justify-end space-x-4 px-6">
                <button @click="generatemodal = false" type="button"
                    class="px-4 py-2 text-sm sm:text-base bg-neutral-600 duration-300 hover:bg-byolink-1 text-white rounded-md">Cancel</button>
                <button class=" py-2 px-4 text-sm sm:text-base rounded-md bg-byolink-1 text-white hover:bg-byolink-3 duration-300">Generate</button>
            </div>
        </form>
    </div>
</div>