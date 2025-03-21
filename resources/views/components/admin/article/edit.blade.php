<x-app-layout head="Edit Article Unique" title="Admin - Edit Article Unique">
    <div class="sm:pl-12 sm:pr-12 lg:pr-32 duration-300 pt-8 pb-20 sm:pb-8 px-4 space-y-6">
        <div class=" w-full p-4 sm:p-6 bg-white rounded-md shadow-md shadow-black/20">
            <form action="{{ route('article-show.update', ['article_show' => $articleshow->id]) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div x-data="{tab : 'content'}" class="space-y-4 sm:space-y-6">
                    <div class=" w-full grid grid-cols-2 gap-4">
                        <button @click="tab ='content'" type="button" :class="tab === 'content' ? 'border-byolink-1 text-byolink-1' : 'text-neutral-500 border-neutral-400 hover:text-black hover:border-black'" class=" w-full duration-300 border-b-2 pb-2 sm:pb-4 font-bold">Konten</button>
                        <button @click="tab ='image'" type="button" :class="tab === 'image' ? 'border-byolink-1 text-byolink-1' : 'text-neutral-500 border-neutral-400 hover:text-black hover:border-black'" class=" w-full duration-300 border-b-2 pb-2 sm:pb-4 font-bold">Image</button>
                    </div>
                    <div x-show="tab === 'content'" class=" space-y-4 sm:space-y-6">
                        {{$slot}}
                        <div class=" w-full">
                            <button @click="tab ='image'" type="button" class="w-full py-3 text-sm sm:text-base rounded-md bg-byolink-1 text-white font-semibold hover:bg-byolink-3 duration-300">Next</button>
                        </div>
                    </div>
                    <div x-show="tab === 'image'" class=" space-y-4 sm:space-y-6">
                        {{$additional ?? ''}}
                        <div class=" w-full grid grid-cols-2 gap-4">
                            <button @click="tab ='content'" type="button" class="w-full py-3 text-sm sm:text-base rounded-md bg-byolink-1 text-white font-semibold hover:bg-byolink-3 duration-300">Back</button>
                            <x-admin.component.submitbutton title="Edit" />
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>