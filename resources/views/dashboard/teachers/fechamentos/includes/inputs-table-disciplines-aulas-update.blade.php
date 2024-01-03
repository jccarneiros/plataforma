<form action="{{route('dashboard.fechamentos.updateAulasDiscipline', $discipline->id)}}" method="POST">
    @csrf @method('PUT')
    <tr>
        <th scope="col" class="text-center text-uppercase"
            style="background-color: #e57373 !important;color: #ffffff !important;">A. P. 1ºB
        </th>
        <th scope="col" class="text-center text-uppercase"
            style="background-color: #e57373 !important;color: #ffffff !important;">A. D. 1ºB
        </th>
        <th scope="col" class="text-center text-uppercase"
            style="background-color: #ba68c8 !important;color: #ffffff !important;">A. P. 2ºB
        </th>
        <th scope="col" class="text-center text-uppercase"
            style="background-color: #ba68c8 !important;color: #ffffff !important;">A. D. 2ºB
        </th>
        <th scope="col" class="text-center text-uppercase"
            style="background-color: #4db6ac !important;color: #ffffff !important;">A. P. 3ºB
        </th>
        <th scope="col" class="text-center text-uppercase"
            style="background-color: #4db6ac !important;color: #ffffff !important;">A. D. 3ºB
        </th>
        <th scope="col" class="text-center text-uppercase"
            style="background-color: #7986cb !important;color: #ffffff !important;">A. P. 4ºB
        </th>
        <th scope="col" class="text-center text-uppercase"
            style="background-color: #7986cb !important;color: #ffffff !important;">A. D. 4ºB
        </th>
        <th scope="col" class="text-center text-uppercase"
            style="background-color: #607d8b !important;color: #ffffff !important;">TOTAL A. D. ANO
        </th>
        <th scope="col" class="text-center text-uppercase"
            style="background-color: #607d8b !important;color: #ffffff !important;">Salvar
        </th>
    </tr>
    <tr>
        @if($discipline->room->status_p_b !== 1)
            <th scope="col">
                <input type="text" name="a_p_p_b" value="{{$discipline->a_p_p_b}}"
                       class="form-control form-control-sm text-center text-uppercase" min="1" max="1000" pattern="[0-9]+$">
            </th>
            <th scope="col">
                <input type="text" name="a_d_p_b" value="{{$discipline->a_d_p_b}}"
                       class="form-control form-control-sm text-center text-uppercase" min="1" max="1000" pattern="[0-9]+$">
            </th>
        @else
            <th scope="col">
                <input type="text" name="a_p_p_b" value="{{$discipline->a_p_p_b}}"
                       class="form-control form-control-sm text-center text-uppercase" readonly>
            </th>
            <th scope="col">
                <input type="text" name="a_d_p_b" value="{{$discipline->a_d_p_b}}"
                       class="form-control form-control-sm text-center text-uppercase" readonly>
            </th>
        @endif
        @if($discipline->room->status_s_b !== 1)
            <th scope="col">
                <input type="text" name="a_p_s_b" value="{{$discipline->a_p_s_b}}"
                       class="form-control form-control-sm text-center text-uppercase" min="1" max="1000" pattern="[0-9]+$">
            </th>
            <th scope="col">
                <input type="text" name="a_d_s_b" value="{{$discipline->a_d_s_b}}"
                       class="form-control form-control-sm text-center text-uppercase" min="1" max="1000" pattern="[0-9]+$">
            </th>
        @else
            <th scope="col">
                <input type="text" name="a_p_s_b" value="{{$discipline->a_p_s_b}}"
                       class="form-control form-control-sm text-center text-uppercase" readonly>
            </th>
            <th scope="col">
                <input type="text" name="a_d_s_b" value="{{$discipline->a_d_s_b}}"
                       class="form-control form-control-sm text-center text-uppercase" readonly>
            </th>
        @endif
        @if($discipline->room->status_t_b !== 1)
            <th scope="col">
                <input type="text" name="a_p_t_b" value="{{$discipline->a_p_t_b}}"
                       class="form-control form-control-sm text-center text-uppercase" min="1" max="1000" pattern="[0-9]+$">
            </th>
            <th scope="col">
                <input type="text" name="a_d_t_b" value="{{$discipline->a_d_t_b}}"
                       class="form-control form-control-sm text-center text-uppercase" min="1" max="1000" pattern="[0-9]+$">
            </th>
        @else
            <th scope="col">
                <input type="text" name="a_p_t_b" value="{{$discipline->a_p_t_b}}"
                       class="form-control form-control-sm text-center text-uppercase" readonly>
            </th>
            <th scope="col">
                <input type="text" name="a_d_t_b" value="{{$discipline->a_d_t_b}}"
                       class="form-control form-control-sm text-center text-uppercase" readonly>
            </th>
        @endif
        @if($discipline->room->status_q_b !== 1)
            <th scope="col">
                <input type="text" name="a_p_q_b" value="{{$discipline->a_p_q_b}}"
                       class="form-control form-control-sm text-center text-uppercase" min="1" max="1000" pattern="[0-9]+$">
            </th>
            <th scope="col">
                <input type="text" name="a_d_q_b" value="{{$discipline->a_d_q_b}}"
                       class="form-control form-control-sm text-center text-uppercase" min="1" max="1000" pattern="[0-9]+$">
            </th>
        @else
            <th scope="col">
                <input type="text" name="a_p_q_b" value="{{$discipline->a_p_q_b}}"
                       class="form-control form-control-sm text-center text-uppercase" readonly>
            </th>
            <th scope="col">
                <input type="text" name="a_d_q_b" value="{{$discipline->a_d_q_b}}"
                       class="form-control form-control-sm text-center text-uppercase" readonly>
            </th>
        @endif
        <th scope="col">
            <input type="text" name="t_a_d_ano" value="{{$discipline->t_a_d_ano}}"
                   class="form-control form-control-sm text-center text-uppercase" readonly>
        </th>
        <th scope="col">
            <button type="submit" class="btn btn-sm btn-warning w-100">Salvar</button>
        </th>
    </tr>
</form>

