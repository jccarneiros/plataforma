<form action="{{route('administrators.coordinators.updateActive', $coordinator->id)}}" method="POST">
    @csrf @method('PUT')
    <select name="active" class="form-select form-control-sm"
            onchange="this.form.submit()">
        @if($coordinator->active !== 1)
            <option value="{{$coordinator->active}}">Inativo</option>
            <option value="1">Ativar</option>
        @else
            <option value="{{$coordinator->active}}">Ativo</option>
            <option value="0">Inativar</option>
        @endif
    </select>
</form>
