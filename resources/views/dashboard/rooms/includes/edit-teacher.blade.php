<form action="{{route('dashboard.disciplines.updateTeacher', $discipline->id)}}" method="POST">
    @csrf @method('PUT')
    <select name="user_id" class="form-select form-control-sm"
            onchange="this.form.submit()">
        <option value="">Selecione</option>
        @foreach($teachers as $teacher)
            <option value="{{$teacher->id}}" {{$teacher->id == $discipline->user_id ? 'SELECTED' : ''}}>{{$teacher->name}}</option>
        @endforeach


    </select>
</form>