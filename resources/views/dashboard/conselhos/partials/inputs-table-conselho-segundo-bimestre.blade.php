{{--NOTAS 2º BIMESTRE--}}
<td class="text-center">
    @switch($fechamento->n_s_b)
        @case(ctype_alpha($fechamento->n_s_b) == true)
            <input type="text" style="width: 2.0rem" name="n_s_b[]"
                   class="table-target text-secondary text-uppercase" tabindex="5"
                   value="{{$fechamento->n_s_b,old('n_s_b')}}">
            @break
        @case($fechamento->n_s_b >= 5)
            <input type="text" style="width: 2.0rem" name="n_s_b[]"
                   class="table-target text-success" tabindex="5"
                   value="{{$fechamento->n_s_b,old('n_s_b')}}">
            @break

        @case($fechamento->n_s_b < 5)
            <input type="text" style="width: 2.0rem" name="n_s_b[]"
                   class="table-target text-danger"
                   tabindex="5"
                   value="{{$fechamento->n_s_b,old('n_s_b')}}">
            @break
    @endswitch
</td>
{{--FALTAS 2º BIMESTRE--}}
<td class="text-center">
    <input type="text" style="width: 2.0rem" tabindex="6" step='1'
           min="0" max="1000"
           name="f_s_b[]"
           class="table-target text-secondary"
           value="{{$fechamento->f_s_b, old('f_s_b')}}">
</td>
{{--FALTAS COMPENSADAS 2º BIMESTRE--}}
<td class="text-center">
    <input type="text" style="width: 2.0rem" tabindex="7" step='1'
           min="0" max="1000"
           name="f_c_s_b[]"
           class="table-target text-secondary"
           value="{{$fechamento->f_c_s_b, old('f_c_s_b')}}">
</td>
{{--AULAS DADAS 2º BIMESTRE--}}
<td class="text-center">
    <input type="text" style="width: 2.0rem" tabindex="8" step='1'
           min="0" max="1000"
           name="a_d_s_b[]"
           class="table-target text-secondary"
           value="{{$fechamento->a_d_s_b, old('a_d_s_b')}}">
</td>
