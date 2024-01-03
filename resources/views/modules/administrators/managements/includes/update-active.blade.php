<form action="{{route('administrators.managements.updateActive', $management->id)}}" method="POST">
    @csrf @method('PUT')
    <select name="active" class="form-select form-control-sm"
            onchange="this.form.submit()">
        @if($management->active !== 1)
            <option value="{{$management->active}}">Inativo</option>
            <option value="1">Ativar</option>
        @else
            <option value="{{$management->active}}">Ativo</option>
            <option value="0">Inativar</option>
        @endif
    </select>
</form>
