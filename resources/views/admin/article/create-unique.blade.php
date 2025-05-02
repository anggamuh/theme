<x-admin.article.form head="Create Article Unique" title="Admin - Create Article Unique" :form="route('article-show.store')" >
    <x-admin.component.textinput title="Judul" placeholder="Masukkan Judul" :value="''" name="judul" />
    <x-admin.component.categoryinput title="Kategori" :tag="$category" :value="null" name="category[]" />
    <x-admin.component.taginput title="Tag" :tag="$tag" :value="null" name="tag[]" />
    <x-admin.component.summernoteinput title="Artikel" value="" name="article" />
    <div class=" grid grid-cols-2 gap-4">
        <div class="flex flex-col gap-2 text-sm sm:text-base font-medium">
            <label>Telephone</label>
            <div class=" w-full grid grid-cols-2 gap-4">
                <div class=" w-full">
                    <input type="radio" name="tlp" value="1" id="tlp_on" class="hidden peer" checked>
                    <label for="tlp_on" class=" w-full cursor-pointer flex justify-center p-2 text-sm sm:text-base text-center font-medium rounded-md duration-300 peer-checked:bg-byolink-1 peer-checked:text-white">On</label>
                </div>
                
                <div class=" w-full">
                    <input type="radio" name="tlp" value="0" id="tlp_off" class="hidden peer">
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
                    <input type="radio" name="wa" value="0" id="wa_off" class="hidden peer">
                    <label for="wa_off" class=" w-full cursor-pointer flex justify-center p-2 text-sm sm:text-base text-center font-medium rounded-md duration-300 peer-checked:bg-byolink-1 peer-checked:text-white">Off</label>
                </div>
            </div>
        </div>
    </div>
    <div class="flex flex-col gap-2">
        <label class="font-medium text-sm sm:text-base">No. Telephone (optional)</label>
        <select class="no-tlp-one" name="no_tlp" multiple="multiple">
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
                $j('.no-tlp-one').select2({
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
    <div class=" w-full relative pt-10 sm:pt-11">
        <div class=" w-full">
            <input type="radio" name="status" value="publish" id="publish" class="hidden peer" checked>
            <label for="publish" class=" absolute w-[calc(33%-8px)] cursor-pointer left-0 top-0 flex justify-center p-2 text-sm sm:text-base text-center font-medium rounded-md duration-300 peer-checked:bg-byolink-1 peer-checked:text-white">Publish</label>
            <div class="peer-checked:block hidden mt-4">
                <p class=" text-sm sm:text-base text-neutral-600">*Artikel akan langsung diterbitkan dan ditampilkan</p>
            </div>
        </div>

        <div class=" w-full">
            <input type="radio" name="status" value="schedule" id="schedule" class="hidden peer">
            <label for="schedule" class=" absolute w-[calc(33%-8px)] cursor-pointer left-1/2 -translate-x-1/2 top-0 flex justify-center p-2 text-sm sm:text-base text-center font-medium rounded-md duration-300 peer-checked:bg-byolink-1 peer-checked:text-white">Schedule</label>
            <div class="peer-checked:block hidden mt-4">
                <input type="date" class=" w-full text-sm sm:text-base font-normal rounded-md border border-byolink-1 focus:ring-byolink-3 focus:border-byolink-3 bg-neutral-100" name="release" min="{{ date('Y-m-d') }}" id="">
            </div>
        </div>
        
        <div class=" w-full">
            <input type="radio" name="status" value="private" id="private" class="hidden peer">
            <label for="private" class=" absolute w-[calc(33%-8px)] cursor-pointer right-0 top-0 flex justify-center p-2 text-sm sm:text-base text-center font-medium rounded-md duration-300 peer-checked:bg-byolink-1 peer-checked:text-white">Private</label>
            <div class="peer-checked:block hidden mt-4">
                <p class=" text-sm sm:text-base text-neutral-600">*Artikel akan langsung diterbitkan akan tetapi tidak langsung ditampilkan</p>
            </div>
        </div>
    </div>
    <x-slot:additional>
        <div class=" w-full">
            <div class=" w-full flex flex-col max-w-full gap-2 text-sm sm:text-base font-medium">
                <label>Banner</label>
                <div class="w-full h-52 sm:h-60 flex items-center justify-center">
                    <div class=" aspect-[3/2] max-h-full max-w-full rounded-md overflow-hidden shadow-md shadow-black/20 ">
                        <x-admin.component.imageinput title="Nama/Tipe" placeholder="Masukkan nama/tipe web..." :value="''" name="image" />
                    </div>
                </div>
            </div>
        </div>
        <div x-data="imageGallery" class="flex flex-col gap-2">
            <label class=" text-sm sm:text-base font-semibold" for="image_gallery">Galeri (Max 6)</label>
            <input type="file" class="hidden" id="image_gallery" name="image_gallery[]" multiple @input="previewImages" accept="image/*">
            
            <!-- Pratinjau Gambar -->
            <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                <!-- Loop Gambar -->
                <template x-for="(image, index) in images" :key="index">
                    <div class="w-full aspect-square flex items-center rounded-md relative overflow-hidden">
                        <img :src="image" class="w-full h-full object-cover" alt="Gallery Image Preview">
                        <!-- Tombol Hapus Gambar -->
                        <button type="button" @click="removeImage(index)" class="absolute inset-0 text-transparent hover:bg-black/60 hover:text-white/50 transition duration-300 p-[35%]">
                            <svg viewBox="0 0 24 24" class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><path d="M19.5 8.99h-15a.5.5 0 0 0-.5.5v12.5a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9.49a.5.5 0 0 0-.5-.5Zm-9.25 11.5a.75.75 0 0 1-1.5 0v-8.625a.75.75 0 0 1 1.5 0Zm5 0a.75.75 0 0 1-1.5 0v-8.625a.75.75 0 0 1 1.5 0ZM20.922 4.851a11.806 11.806 0 0 0-4.12-1.07 4.945 4.945 0 0 0-9.607 0A12.157 12.157 0 0 0 3.18 4.805 1.943 1.943 0 0 0 2 6.476 1 1 0 0 0 3 7.49h18a1 1 0 0 0 1-.985 1.874 1.874 0 0 0-1.078-1.654ZM11.976 2.01A2.886 2.886 0 0 1 14.6 3.579a44.676 44.676 0 0 0-5.2 0 2.834 2.834 0 0 1 2.576-1.569Z" fill="currentColor" class="fill-000000"></path></svg>
                        </button>
                    </div>
                </template>
        
                <!-- Tambahkan Gambar (Placeholder jika kurang dari 8 gambar) -->
                <template x-if="images.length < 6">
                    <div for="image_gallery" class="w-full aspect-square border bg-neutral-100 border-byolink-1 rounded-md relative border-dashed overflow-hidden">
                        <label for="image_gallery" class="w-full text-byolink-1 h-full absolute top-0 left-0 flex justify-center items-center p-[35%] hover:bg-byolink-3 hover:text-white/50 duration-300 cursor-pointer">
                            <svg viewBox="0 0 24 24" class="w-full h-full" xmlns="http://www.w3.org/2000/svg"><path d="m9 13 3-4 3 4.5V12h4V5c0-1.103-.897-2-2-2H4c-1.103 0-2 .897-2 2v12c0 1.103.897 2 2 2h8v-4H5l3-4 1 2z" fill="currentColor" class="fill-000000"></path><path d="M19 14h-2v3h-3v2h3v3h2v-3h3v-2h-3z" fill="currentColor" class="fill-000000"></path></svg>
                        </label>
                    </div>
                </template>
            </div>
        </div>

        <script>
            function imageGallery() {
                return {
                    images: [],
                    
                    previewImages(event) {
                        const files = Array.from(event.target.files).slice(0, 6 - this.images.length);
                        files.forEach(file => {
                            const url = URL.createObjectURL(file);
                            this.images.push(url);
                        });
                    },
                    
                    removeImage(index) {
                        this.images.splice(index, 1);
                    }
                };
            }
        </script>
        <x-admin.component.linkinput title="Video (Link Youtube/Tiktok)" placeholder="Masukkan link..." value="" name="link" link="Url" />
    </x-slot:additional>
    <x-slot:template>
        <div class=" space-y-2">
            <label for="template" class=" text-sm sm:text-base font-semibold">Template</label>
            <div class=" w-full grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4">
                @foreach ($template as $item)
                    <label class="w-full rounded-md bg-white aspect-[2/3] overflow-hidden relative">
                        <input type="radio" name="template_id" value="{{$item->id}}" class="hidden peer" {{ $loop->first ? 'checked' : '' }}>
                        <img src="{{asset('/storage/images/template/'.$item->image)}}" class=" w-full h-full object-cover object-top" alt="">
                        <div class=" absolute inset-0 peer-checked:bg-black/50 duration-300">
                        </div>
                    </label>
                @endforeach
            </div>
        </div>
    </x-slot:template>
</x-admin.article.form>