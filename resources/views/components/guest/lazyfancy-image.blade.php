@props(['image'])
<a data-fancybox="gallery" href="{{ $image }}" class="">
    <img class="w-full h-full object-cover object-center absolute inset-0 opacity-0 transition-opacity duration-500"
    alt="" @load="loading = false; $el.classList.add('opacity-100')">
</a>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        Fancybox.bind("[data-fancybox]", {});
    });
</script>
