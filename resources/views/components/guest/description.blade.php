@props(['data' => null, 'background' => null])
<div class=" w-full max-w-[600px] mx-auto">
    <div style="background-color: {{$background ?? 'white'}}" class=" w-full rounded-md shadow-md p-4 space-y-2 sm:space-y-4">
        <div class=" w-full flex flex-wrap gap-2">
            @foreach ($data->articles->articletag as $item)
                <a href="{{route('category', ['category' => $item->tag])}}">
                    <button style="background-color: {{$data->color ?? '#1d588d'}}" class=" px-2 sm:px-3 py-1 text-xs sm:text-sm text-white rounded-md">{{$item->tag}}</button>
                </a>
            @endforeach
        </div>
        <p class="text-lg sm:text-3xl font-bold">{{$data->judul}}</p>
        <div class=" flex gap-4 sm:gap-6 items-center text-black/60 text-sm sm:text-base">
            <div class=" flex gap-1.5 sm:gap-2 items-center">
                <div style="color: {{$data->color ?? '#1d588d'}}" class=" w-4 aspect-square">
                    <svg class="feather feather-clock" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><circle cx="12" cy="12" r="10"></circle><path d="M12 6v6l4 2"></path></svg>
                </div>
                <p>{{$data->time}}</p>
            </div>
            <div class=" flex gap-1.5 sm:gap-2 items-center">
                <div style="color: {{$data->color ?? '#1d588d'}}" class=" w-4 aspect-square">
                    <svg class="feather feather-calendar" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><rect height="18" rx="2" ry="2" width="18" x="3" y="4"></rect><path d="M16 2v4M8 2v4M3 10h18"></path></svg>
                </div>
                <p>{{$data->date}}</p>
            </div>
        </div>
        <div class=" article space-y-4 sm:space-y-6">
            {!! nl2br($data->article == '' ? '' : $data->article) !!}
        </div>
        <style>
            .article a {
                font-weight: 700;
                color: {{$data->color ?? '#1d588d'}};
            }
            .article ol {
                padding-left: 16px;
                list-style-type: decimal;
            }

            .article ul {
                padding-left: 16px;
                list-style-type: disc;
            }

            .article p {
                font-size: 0.875rem !important;
                line-height: 1.25rem !important;
            }

            .article li {
                font-size: 0.875rem !important;
                line-height: 1.25rem !important;
            }

            .article h1 {
                font-size: 1.875rem !important;
                line-height: 2.25rem !important;
            }

            .article h2 {
                font-size: 1.5rem !important;
                line-height: 2rem !important;
            }

            .article h3 {
                font-size: 1rem !important;
                line-height: 1.5rem !important;
            }

            .article h4 {
                font-size: 1rem !important;
                line-height: 1.5rem !important;
            }

            .article h5 {
                font-size: 0.75rem !important;
                line-height: 1.25rem !important;
            }

            .article h6 {
                font-size: 0.5rem !important;
                line-height: 0.75rem !important;
            }
            
            @media screen and (min-width: 640px) {
                .article p {
                    font-size: 1rem !important;
                    line-height: 1.5rem !important;
                }
                .article li {
                    font-size: 1rem !important;
                    line-height: 1.5rem !important;
                }
                .article h3 {
                    font-size: 1.25rem !important;
                    line-height: 1.75rem !important;
                }
            }
        </style>
    </div>
</div>