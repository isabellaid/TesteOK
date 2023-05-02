@if ($errors->has($campo))
    <div class="campo-erro">
        {{ $errors->first($campo) }} 
    </div>
                                                                                                                    
@endif