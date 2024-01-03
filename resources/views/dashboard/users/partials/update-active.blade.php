@can('users.edit')
    <form action="{{route('dashboard.users.updateActive', $item->id)}}" method="POST">
        @csrf @method('PUT')
        <select name="active" class="form-select form-control-sm"
                onchange="this.form.submit()">
            @if($item->active !== 1)
                <option value="{{$item->active}}">Inativo</option>
                <option value="1">Ativar</option>
            @else
                <option value="{{$item->active}}">Ativo</option>
                <option value="0">Inativar</option>
            @endif
        </select>
    </form>
@endcan