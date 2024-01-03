<form action="{{route('dashboard.disciplines.createTableFechamento')}}" method="POST">
    @csrf
    @foreach($room->students as $student)
        <input type="hidden" name="tipo_ensino_id[]" value="{{$discipline->tipoEnsino->id}}">
        <input type="hidden" name="serie_id[]" value="{{$discipline->serie->id}}">
        <input type="hidden" name="room_id[]" value="{{$discipline->room->id}}">
        <input type="hidden" name="discipline_id[]" value="{{$discipline->id}}">
        <input type="hidden" name="student_id[]" value="{{$student->id}}">
        <input type="hidden" name="number_ra[]" value="{{$student->number_ra}}">
        <input type="hidden" name="student_number[]" value="{{$student->number}}">
        <input type="hidden" name="student_name[]" value="{{$student->name}}">
        <input type="hidden" name="student_situation[]" value="{{$student->student_situation}}">
    @endforeach
    <button type="submit" class="btn btn-sm btn-success text-uppercase">Tabela [{{$discipline->fechamentos->count()}}] | [{{$room->students->count()}}] </button>
</form>