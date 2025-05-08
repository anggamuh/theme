@props(['phone' => null, 'value' => null , 'title' => null, 'name' => null])
<div class="flex flex-col gap-2">
    <label class="font-medium text-sm sm:text-base">{{$title}}</label>
    <select class="no-tlp-one" name="{{$name}}" multiple="multiple">
        @if ($value)
            <option value="{{$value}}" selected>{{$value}}</option>
        @endif
        @foreach($phone as $item)
            @if ($item->no_tlp != $value)
                <option value="{{ $item->no_tlp }}">{{ $item->no_tlp }}</option>
            @endif
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