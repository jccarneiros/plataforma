{{--NOTAS 2º BIMESTRE--}}
<td class="text-center">
    @if($discipline->room->status_s_b !== 1)
        @switch($fechamento->n_s_b)
            @case(ctype_alpha($fechamento->n_s_b) == true)
                <input type="text" style="width: 2.5rem"
                       name="n_s_b[]"
                       class="table-target text-secondary text-uppercase" tabindex="1"
                       value="{{$fechamento->n_s_b}}" readonly>
                @break
            @case($fechamento->n_s_b >= 5)
                <input type="text" style="width: 2.5rem" name="n_s_b[]"
                       class="table-target text-primary" tabindex="1"
                       value="{{$fechamento->n_s_b}}" readonly>
                @break

            @case($fechamento->n_s_b < 5)
                <input type="text" style="width: 2.5rem" name="n_s_b[]" class="table-target text-danger"
                       tabindex="1+"
                       value="{{$fechamento->n_s_b}}" readonly>
                @break
        @endswitch
    @else
        @switch($fechamento->n_s_b)
            @case(ctype_alpha($fechamento->n_s_b) == true)
                <input type="text" style="width: 2.5rem"
                       name="n_s_b[]"
                       class="table-target text-secondary text-uppercase" tabindex="1"
                       value="{{$fechamento->n_s_b}}" readonly>
                @break
            @case($fechamento->n_s_b >= 5)
                <input type="text" style="width: 2.5rem" name="n_s_b[]"
                       class="table-target text-primary"
                       tabindex="1" value="{{$fechamento->n_s_b}}"
                       readonly>
                @break

            @case($fechamento->n_s_b < 5)
                <input type="text" style="width: 2.5rem" name="n_s_b[]" class="table-target text-danger"
                       tabindex="1" value="{{$fechamento->n_s_b}}"
                       readonly>
                @break
        @endswitch
    @endif
</td>
{{--FALTAS 1º BIMESTRE--}}
<td class="text-center">
        <input type="text" style="width: 2.5rem" tabindex="2" step='1'
               min="0" max="1000"
               name="f_s_b[]"
               class="table-target text-secondary"
               value="{{$fechamento->f_s_b}}" readonly>
</td>
{{--FALTAS COMPENSADAS 1º BIMESTRE--}}
<td class="text-center">
        <input type="text" style="width: 2.5rem" tabindex="3" step='1'
               min="0" max="1000"
               name="f_c_s_b[]"
               class="table-target text-secondary"
               value="{{$fechamento->f_c_s_b}}" readonly>
</td>
{{--AULAS PREVISTAS 1º BIMESTRE--}}
<td hidden>
    <input style="width: 2.5rem" type="text" name="a_p_s_b[]" value="{{$discipline->a_p_s_b}}"
           class="form-control form-control-sm text-center text-uppercase">
</td>
{{--AULAS DADAS 1º BIMESTRE--}}
<td hidden>
    @if (!empty($discipline->a_d_s_b))
        <input style="width: 2.5rem" type="text" name="a_d_s_b[]" value="{{$discipline->a_d_s_b}}"
               class="form-control form-control-sm text-center text-uppercase">
    @else
        <input style="width: 2.5rem" type="text" name="a_d_s_b[]" value="0"
               class="form-control form-control-sm text-center text-uppercase">
    @endif
</td>
