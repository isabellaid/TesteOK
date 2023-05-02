
<div class="form-floating mb-3">
    {{ $slot }}

    <input class="form-control" id="{{$campo}}" name="{{$campo}}" 
                                value="{{ $value }}">
    <label for="$campo">{{$label}}</label>

    @component('_componentes._erros',['campo' => $campo])
    @endcomponent
</div>

