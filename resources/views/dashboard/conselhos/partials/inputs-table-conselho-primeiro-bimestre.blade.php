{{--NOTAS 1º BIMESTRE--}}
<td class="text-center">
    @switch($fechamento->n_p_b)
        @case(ctype_alpha($fechamento->n_p_b) == true)
            <input type="text" style="width: 2.0rem" name="n_p_b[]"
                   class="table-target text-secondary text-uppercase" tabindex="1"
                   value="{{$fechamento->n_p_b,old('n_p_b')}}">
            @break
        @case($fechamento->n_p_b >= 5)
            <input type="text" style="width: 2.0rem" name="n_p_b[]"
                   class="table-target text-success" tabindex="1"
                   value="{{$fechamento->n_p_b,old('n_p_b')}}">
            @break

        @case($fechamento->n_p_b < 5)
            <input type="text" style="width: 2.0rem" name="n_p_b[]"
                   class="table-target text-danger"
                   tabindex="1"
                   value="{{$fechamento->n_p_b,old('n_p_b')}}">
            @break
    @endswitch
</td>
{{--FALTAS 1º BIMESTRE--}}
<td class="text-center">
    <input type="text" style="width: 2.0rem" tabindex="2" step='1'
           min="0" max="1000"
           name="f_p_b[]"
           class="table-target text-secondary"
           value="{{$fechamento->f_p_b, old('f_p_b')}}">
</td>
{{--FALTAS COMPENSADAS 1º BIMESTRE--}}
<td class="text-center">
    <input type="text" style="width: 2.0rem" tabindex="3" step='1'
           min="0" max="1000"
           name="f_c_p_b[]"
           class="table-target text-secondary"
           value="{{$fechamento->f_c_p_b, old('f_c_p_b')}}">
</td>
{{--AULAS DADAS 1º BIMESTRE--}}
<td class="text-center">
    <input type="text" style="width: 2.0rem" tabindex="4" step='1'  name="a_d_p_b[]"
           class="table-target text-secondary" value="{{$fechamento->a_d_p_b, old('a_d_p_b')}}">
</td>
