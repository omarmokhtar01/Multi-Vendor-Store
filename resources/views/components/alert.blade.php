{{-- php artisan make:component alert --view --}}


{{-- ققيمة مبدأية او بعرفه اني هبعت كذا وممكن اديها قيمة مبدأيه --}}
@props([
'type'=>'success',
'info'=>'success'
])



@if (session()->has($type))
{{-- النقطتين الي قبل الاي دي بتعرفه اني بباصي قيمة ل كمبوننت ف مش لازم اعمل اقواس المتغير --}}
<div class="alert alert-{{$info}} col-12" id="{{$type}}-message">
    {{ session($type) }}

    {{-- لو حاجة انا مباصيها ك بروبس ومش معرفها فالبروبس الي فوق هتظهرها عادي --}}
    {{$attributes}}
    {{-- {{$attributes->class([
        'text-primary'

    ])}} --}}

    </div>



@endif
<script>

    setTimeout(function() {
        var successMessage = document.getElementById("{{$type}}-message");
        if (successMessage) {
            successMessage.style.display = 'none';
        }
    }, 3000);
</script>






{{-- @if (session()->has('delete'))
<div class="alert alert-danger col-12" id="delete-message">
    {{ session('delete') }}
    </div>
@endif
<script>

    setTimeout(function() {
        var deleteMessage = document.getElementById('delete-message');
        if (deleteMessage) {
            deleteMessage.style.display = 'none';
        }
    }, 5000);
</script> --}}
