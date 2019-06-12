<select name="{{ $name or '' }}" id="{{ $name or '' }}" class="form-control" {{ $disabled or '' }}  title="{{ $title or '' }}" {{ $required or '' }}>   
    <option value="">{{ $title or '' }}</option>
    @foreach($dominios as $dominio)
        @if( $codigo!="" && $codigo == $dominio->codigo )
            <option value="{{ $dominio->codigo }}" selected="selected" title="{{ $dominio->descripcion }}">{{ $dominio->codigo.'. '.$dominio->descripcion }}</option>
        @else
            <option value="{{ $dominio->codigo }}" title="{{ $dominio->descripcion }}">{{ $dominio->codigo.'. '.$dominio->descripcion }}</option>
        @endif
    @endforeach
</select>