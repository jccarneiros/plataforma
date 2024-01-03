<form action="{{route('administrators.teachers.updateActive', $teacher->id)}}" method="POST">
    @csrf @method('PUT')
    <select name="active" class="form-select form-control-sm"
            onchange="this.form.submit()">
        @if($teacher->active !== 1)
            <option value="{{$teacher->active}}">Inativo</option>
            <option value="1">Ativar</option>
        @else
            <option value="{{$teacher->active}}">Ativo</option>
            <option value="0">Inativar</option>
        @endif
    </select>
</form>
