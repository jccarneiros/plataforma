{{--NOTAS 4º BIMESTRE--}}
<td class="text-center">
    @switch($fechamento->n_q_b)
        @case(ctype_alpha($fechamento->n_q_b) == true)
            <input type="text" style="width: 2.0rem" name="n_q_b[]"
                   class="table-target text-secondary text-uppercase" tabindex="13"
                   value="{{$fechamento->n_q_b,old('n_q_b')}}">
            @break
        @case($fechamento->n_q_b >= 5)
            <input type="text" style="width: 2.0rem" name="n_q_b[]"
                   class="table-target text-success" tabindex="13"
                   value="{{$fechamento->n_q_b,old('n_q_b')}}">
            @break

        @case($fechamento->n_q_b < 5)
            <input type="text" style="width: 2.0rem" name="n_q_b[]"
                   class="table-target text-danger"
                   tabindex="13"
                   value="{{$fechamento->n_q_b,old('n_q_b')}}">
            @break
    @endswitch
</td>
{{--FALTAS 4º BIMESTRE--}}
<td class="text-center">
    <input type="text" style="width: 2.0rem" tabindex="14" step='1'
           min="0" max="1000"
           name="f_q_b[]"
           class="table-target text-secondary"
           value="{{$fechamento->f_q_b, old('f_q_b')}}">
</td>
{{--FALTAS COMPENSADAS 4º BIMESTRE--}}
<td class="text-center">
    <input type="text" style="width: 2.0rem" tabindex="15" step='1'
           min="0" max="1000"
           name="f_c_q_b[]"
           class="table-target text-secondary"
           value="{{$fechamento->f_c_q_b, old('f_c_q_b')}}">
</td>
{{--AULAS DADAS 4º BIMESTRE--}}
<td class="text-center">
    <input type="text" style="width: 2.0rem" tabindex="16" step='1'
           min="0" max="1000"
           name="a_d_q_b[]"
           class="table-target text-secondary"
           value="{{$fechamento->a_d_q_b, old('a_d_q_b')}}">
</td>
