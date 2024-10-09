{{--  php artisan make:component form.label --view --}}
@props([
    'slot'=>'Name',
    'id'=>'name'
])

{{--
slot
القيمة المصورة داخل الكمبوننت
--}}
<label for="{{$id}}">{{$slot}}</label>
