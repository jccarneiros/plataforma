<form action="{{route('dashboard.disciplines.updateStudentFechamento', $fechamento->id)}}" method="POST">
    @csrf @method('PUT')
    <div>
        <input type="hidden" name="id" value="{{$fechamento->id}}">
    </div>
    {{--    <select name="discipline_id" class="form-select form-control-sm"onchange="this.form.submit()">--}}
    {{--        <option value="">Selecione um disciplina</option>--}}
    @foreach($room->disciplines as $discipline)
        @if($discipline->name == $fechamento->discipline->name)
            <button name="discipline_id" value="{{$discipline->id}}" class="btn btn-sm btn-warning w-100"
                    onchange="this.form.submit()">
                {{$discipline->id}} | {{$discipline->name}}
            </button>
        @endif
        {{--            <option value="{{$discipline->id}}" {{$discipline->name == $fechamento->discipline->name ? "selected" : ''}}>{{$discipline->id}} {{$discipline->name}}</option>--}}

    @endforeach


    {{--   </select>--}}
</form>