<x-admin.article.form head="Edit Article Generated" title="Admin - Edit Article Generated" :form="route('article-generated.update', ['article_generated' => $articleShow->id])">
    @method('PUT')
    <x-admin.component.textinput title="Judul" placeholder="Masukkan Judul" :value="$articleShow->judul" name="judul" />
    <x-admin.component.summernoteinput title="Artikel" :value="$articleShow->article" name="article" />
    <div class=" grid grid-cols-2 gap-4">
        <div class="flex flex-col gap-2 text-sm sm:text-base font-medium">
            <label>Telephone</label>
            <div class=" w-full grid grid-cols-2 gap-4">
                <div class=" w-full">
                    <input type="radio" name="tlp" value="1" id="tlp_on" class="hidden peer" checked>
                    <label for="tlp_on" class=" w-full cursor-pointer flex justify-center p-2 text-sm sm:text-base text-center font-medium rounded-md duration-300 peer-checked:bg-byolink-1 peer-checked:text-white">On</label>
                </div>
                
                <div class=" w-full">
                    <input type="radio" name="tlp" value="0" id="tlp_off" class="hidden peer" {{!$articleShow->telephone ? 'checked' : ''}}>
                    <label for="tlp_off" class=" w-full cursor-pointer flex justify-center p-2 text-sm sm:text-base text-center font-medium rounded-md duration-300 peer-checked:bg-byolink-1 peer-checked:text-white">Off</label>
                </div>
            </div>
        </div>
        <div class="flex flex-col gap-2 text-sm sm:text-base font-medium">
            <label>WhatsApp</label>
            <div class=" w-full grid grid-cols-2 gap-4">
                <div class=" w-full">
                    <input type="radio" name="wa" value="1" id="wa_on" class="hidden peer" checked>
                    <label for="wa_on" class=" w-full cursor-pointer flex justify-center p-2 text-sm sm:text-base text-center font-medium rounded-md duration-300 peer-checked:bg-byolink-1 peer-checked:text-white">On</label>
                </div>
                
                <div class=" w-full">
                    <input type="radio" name="wa" value="0" id="wa_off" class="hidden peer" {{!$articleShow->whatsapp ? 'checked' : ''}}>
                    <label for="wa_off" class=" w-full cursor-pointer flex justify-center p-2 text-sm sm:text-base text-center font-medium rounded-md duration-300 peer-checked:bg-byolink-1 peer-checked:text-white">Off</label>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-2">
        <label class="font-medium text-sm sm:text-base">No. Telephone (optional)</label>
        <select class="js-example-basic-single" name="no_tlp" multiple="multiple">
            @if ($articleShow->phoneNumber)
                <option value="{{$articleShow->phoneNumber->no_tlp}}" selected>{{$articleShow->phoneNumber->no_tlp}}</option>
            @endif
            @foreach($phonenumber as $item)
                <option value="{{ $item->no_tlp }}">{{ $item->no_tlp }}</option>
            @endforeach
        </select>
        <style>
            .select2 {
                width: 100% !important;
            }
    
            .selection .select2-selection {
                width: 100% !important;
                border-color: #3b82f6 !important;
                background-color: #f5f5f5 !important;
                min-height: 40px !important;
                padding: 0.3rem 0.75rem !important;
                border-radius: 0.375rem !important;
            }
    
            .selection .select2-selection:focus,
            .selection .select2-selection:focus-within {
                border: 2px solid;
                border-radius: 0.375rem 0.375rem 0 0 !important;
                border-color: #1e40af !important;
            }
            .selection li {
                margin-top: 0px !important;
                margin-left: 0px !important;
                margin-right: 0.25rem !important;
                font-size: 0.875rem !important;
                line-height: 1.25rem !important;
            }
            .selection textarea {
                margin-top: 0px !important;
                margin-left: 0px !important;
                margin-bottom: 2px !important;
                font-size: 0.875rem !important;
                line-height: 1.25rem !important;
            }
            .select2-dropdown {
                font-size: 0.875rem !important;
                overflow: hidden;
                border-radius: 0 0 0.375rem 0.375rem !important;
                border: 2px solid #1e40af;
            }
        </style>
    </div>
    <script>
        window.addEventListener('load', function select2() {
            var $j = jQuery.noConflict();
            $j(document).ready(function() {
                $j('.js-example-basic-single').select2({
                    tags: true,
                    tokenSeparators: [','],
                    maximumSelectionLength: 1,
                    language: {
                        maximumSelected: function (args) {
                            return "Hanya bisa memilih satu saja";
                        }
                    }
                });
            });
        });
    </script>
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