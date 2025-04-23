@props(['title'])
@props(['placeholder'])
@props(['name'])
@props(['value'])
<div class=" w-full">
    <div class="flex flex-col gap-2 text-sm sm:text-base font-medium">
        <label for="{{$name}}">{{$title}}</label>
        <input type="number" id="{{$name}}" name="{{$name}}" placeholder="{{$placeholder}}" value="{{$value}}" min="0" class="text-sm sm:text-base font-normal rounded-md border border-byolink-1 focus:ring-byolink-3 focus:border-byolink-3 bg-neutral-100">
    </div>
</div>