<form action="{{route('administrators.coordinators.updateRole', $coordinator->id)}}" method="POST">
    @csrf @method('PUT')
    <select name="role" class="form-select form-control-sm"
            onchange="this.form.submit()">
        <option value="{{$coordinator->role}}">{{$coordinator->role}}</option>
        <option value="SuperAdmin">SuperAdmin</option>
        <option value="Supervisão">Supervisão</option>
        <option value="Gestão">Gestão</option>
        <option value="Coordenação">Coordenação</option>
        <option value="Secretaria">Secretaria</option>
        <option value="Professor(a)">Professor(a)</option>
    </select>
</form>
