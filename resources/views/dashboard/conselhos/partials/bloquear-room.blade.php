<th style="width: 20rem !important;" class="text-center text-white fw-bold">
    <form action="{{route('dashboard.students.conselho.escola.room', $room->id)}}"
          method="GET">
        <select name="search" class="form-select form-control-sm" onchange="this.form.submit()">
            <option value="">Selecione</option>
            @if($room->type == 'Regular')
                @foreach($room->students as $student)
                    <option value="{{$student->number_ra}}"{{$student->number_ra == $search ? 'selected': ''}}>
                        {{$student->name}}
                    </option>
                @endforeach
            @endif
        </select>
    </form>
</th>
<th colspan="4" class="text-center"
    style="background-color: #e57373 !important;color: #ffffff !important;">
    <form action="{{route('dashboard.students.conselho.escola.updateStatusPrimeiroBimestreRoom', $room->id)}}"
          method="POST">
        @csrf @method('PUT')
        <select name="status_p_b" class="form-select form-control-sm"
                style="font-size: 100%!important;padding-top: 0!important;padding-bottom: 0!important;"
                onchange="this.form.submit()">
            @if($room->status_p_b !== 1)
                <option value="{{$room->status_p_b}}">Desbloqueado</option>
                <option value="1">Bloquear</option>
            @else
                <option value="{{$room->status_p_b}}">Bloqueado</option>
                <option value="0">Desbloqueado</option>
            @endif
        </select>
    </form>
</th>
<th colspan="4" class="text-center"
    style="background-color: #ba68c8 !important;color: #ffffff !important;">
    <form action="{{route('dashboard.students.conselho.escola.updateStatusSegundoBimestreRoom', $room->id)}}"
          method="POST">
        @csrf @method('PUT')
        <select name="status_s_b" class="form-select form-control-sm"
                style="font-size: 100%!important;padding-top: 0!important;padding-bottom: 0!important;"
                onchange="this.form.submit()">
            @if($room->status_s_b !== 1)
                <option value="{{$room->status_s_b}}">Desbloqueado</option>
                <option value="1">Bloquear</option>
            @else
                <option value="{{$room->status_s_b}}">Bloqueado</option>
                <option value="0">Desbloqueado</option>
            @endif
        </select>
    </form>
</th>
<th colspan="4" class="text-center"
    style="background-color: #4db6ac !important;color: #ffffff !important;">
    <form action="{{route('dashboard.students.conselho.escola.updateStatusTerceiroBimestreRoom', $room->id)}}"
          method="POST">
        @csrf @method('PUT')
        <select name="status_t_b" class="form-select form-control-sm"
                style="font-size: 100%!important;padding-top: 0!important;padding-bottom: 0!important;"
                onchange="this.form.submit()">
            @if($room->status_t_b !== 1)
                <option value="{{$room->status_t_b}}">Desbloqueado</option>
                <option value="1">Bloquear</option>
            @else
                <option value="{{$room->status_t_b}}">Bloqueado</option>
                <option value="0">Desbloqueado</option>
            @endif
        </select>
    </form>
</th>
<th colspan="4" class="text-center"
    style="background-color: #7986cb !important;color: #ffffff !important;">
    <form action="{{route('dashboard.students.conselho.escola.updateStatusQuartoBimestreRoom', $room->id)}}"
          method="POST">
        @csrf @method('PUT')
        <select name="status_q_b" class="form-select form-control-sm"
                style="font-size: 100%!important;padding-top: 0!important;padding-bottom: 0!important;"
                onchange="this.form.submit()">
            @if($room->status_q_b !== 1)
                <option value="{{$room->status_q_b}}">Desbloqueado</option>
                <option value="1">Bloquear</option>
            @else
                <option value="{{$room->status_q_b}}">Bloqueado</option>
                <option value="0">Desbloqueado</option>
            @endif
        </select>
    </form>
</th>
<th colspan="4" class="text-center"
    style="background-color: #ff8a65 !important;color: #ffffff !important;">
    <form action="{{route('dashboard.students.conselho.escola.updateStatusQuintoConceitoRoom', $room->id)}}"
          method="POST">
        @csrf @method('PUT')
        <select name="status_q_c" class="form-select form-control-sm"
                style="font-size: 100%!important;padding-top: 0!important;padding-bottom: 0!important;"
                onchange="this.form.submit()">
            @if($room->status_q_c !== 1)
                <option value="{{$room->status_q_c}}">Desbloqueado</option>
                <option value="1">Bloquear</option>
            @else
                <option value="{{$room->status_q_c}}">Bloqueado</option>
                <option value="0">Desbloqueado</option>
            @endif
        </select>
    </form>
</th>
<th colspan="2" class="text-center text-white fw-bold">
    <a href="{{route('dashboard.students.conselho.escola.index')}}"
       class="btn btn-sm w-100 btn-secondary">
        Turmas
    </a>
</th>