<form action="{{route('administrators.secretariats.updateActive', $secretariat->id)}}" method="POST">
    @csrf @method('PUT')
    <select name="active" class="form-select form-control-sm"
            onchange="this.form.submit()">
        @if($secretariat->active !== 1)
            <option value="{{$secretariat->active}}">Inativo</option>
            <option value="1">Ativar</option>
        @else
            <option value="{{$secretariat->active}}">Ativo</option>
            <option value="0">Inativar</option>
        @endif
    </select>
</form>
