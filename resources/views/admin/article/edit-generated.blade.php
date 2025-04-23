<x-admin.article.form head="Edit Article Generated" title="Admin - Edit Article Generated" :form="route('article-generated.update', ['article_generated' => $articleShow->id])">
    @method('PUT')
    <x-admin.component.textinput title="Judul" placeholder="Masukkan Judul" :value="$articleShow->judul" name="judul" />
    <x-admin.component.summernoteinput title="Artikel" :value="$articleShow->article" name="article" />
    <x-slot:additional>
        <div class=" w-full">
            <div class=" w-full flex flex-col max-w-full gap-2 text-sm sm:text-base font-semibold">
                <label>Banner</label>
                <div class="w-full grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2 sm:gap-4">
                    @foreach ($article->articlebanner as $item)
                        <label class="w-full rounded-md bg-white aspect-square overflow-hidden relative">
                            <input type="radio" name="banner" value="{{$item->image}}" class="hidden peer" {{ $articleShow->banner === $item->image ? 'checked' : '' }}>
                            <img src="{{asset('storage/images/article/banner/'.$item->image)}}" class=" w-full h-full object-cover object-top" alt="">
                            <div class=" absolute inset-0 peer-checked:bg-black/50 duration-300">
                            </div>
                        </label>
                    @endforeach
                </div>
            </div>
        </div>
        <div class=" w-full">
            <div class=" w-full flex flex-col max-w-full gap-2 text-sm sm:text-base font-semibold">
                <label class="text-sm sm:text-base font-semibold" for="image_gallery">Galeri (Max 6)</label>
                <div class="w-full grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-2 sm:gap-4" id="gallery-container">
                    @foreach ($article->articlegallery as $item)
                        <label class="w-full rounded-md bg-white aspect-square overflow-hidden relative">
                            <input type="checkbox" name="gallery[]" value="{{$item->id}}" class="hidden gallery-checkbox peer" {{ $articleShow->articleshowgallery->contains('article_gallery_id', $item->id) ? 'checked' : '' }}>
                            <img src="{{asset('storage/images/article/gallery/'.$item->image)}}" class=" w-full h-full object-cover object-top" alt="">
                            <div class=" absolute inset-0 peer-checked:bg-black/50 duration-300">
                            </div>
                        </label>
                    @endforeach
                    <script>
                        document.addEventListener('DOMContentLoaded', function () {
                            const max = 6;
                            const checkboxes = document.querySelectorAll('.gallery-checkbox');
                        
                            checkboxes.forEach(cb => {
                                cb.addEventListener('change', () => {
                                    const checked = document.querySelectorAll('.gallery-checkbox:checked').length;
                                    checkboxes.forEach(box => {
                                        box.disabled = !box.checked && checked >= max;
                                    });
                                });
                            });
                        });
                    </script>
                </div>
            </div>
        </div>
        <x-admin.component.linkinput title="Video (Link Youtube/Tiktok) (Optional)" placeholder="Masukkan link..." value="{{ ($articleShow->articles->video_type === 'youtube') ? $articleShow->articles->youtube : (($articleShow->articles->video_type === 'tiktok') ? $articleShow->articles->tiktok : '') }}" name="link" link="Url" />
    </x-slot:additional>
    <x-slot:template>
        <div class=" space-y-2">
            <label for="template" class=" text-sm sm:text-base font-semibold">Template</label>
            <div class=" w-full grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($template as $item)
                    <label class="w-full rounded-md bg-white aspect-[2/3] overflow-hidden relative">
                        <input type="radio" name="template_id" value="{{$item->id}}" class="hidden peer" {{ $articleShow->template_id === $item->id ? 'checked' : '' }}>
                        <img src="{{asset('/storage/images/template/'.$item->image)}}" class=" w-full h-full object-cover object-top" alt="">
                        <div class=" absolute inset-0 peer-checked:bg-black/50 duration-300">
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
    </x-slot:template>
</x-admin.article.form>