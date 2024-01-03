<form action="{{route('administrators.supervisors.updateActive', $supervisor->id)}}" method="POST">
    @csrf @method('PUT')
    <select name="active" class="form-select form-control-sm"
            onchange="this.form.submit()">
        @if($supervisor->active !== 1)
            <option value="{{$supervisor->active}}">Inativo</option>
            <option value="1">Ativar</option>
        @else
            <option value="{{$supervisor->active}}">Ativo</option>
            <option value="0">Inativar</option>
        @endif
    </select>
</form>
