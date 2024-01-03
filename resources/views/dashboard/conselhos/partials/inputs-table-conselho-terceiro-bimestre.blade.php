{{--NOTAS 3º BIMESTRE--}}
<td class="text-center">
    @switch($fechamento->n_t_b)
        @case(ctype_alpha($fechamento->n_t_b) == true)
            <input type="text" style="width: 2.0rem" name="n_t_b[]"
                   class="table-target text-secondary text-uppercase" tabindex="9"
                   value="{{$fechamento->n_t_b,old('n_t_b')}}">
            @break
        @case($fechamento->n_t_b >= 5)
            <input type="text" style="width: 2.0rem" name="n_t_b[]"
                   class="table-target text-success" tabindex="9"
                   value="{{$fechamento->n_t_b,old('n_t_b')}}">
            @break

        @case($fechamento->n_t_b < 5)
            <input type="text" style="width: 2.0rem" name="n_t_b[]"
                   class="table-target text-danger"
                   tabindex="9"
                   value="{{$fechamento->n_t_b,old('n_t_b')}}">
            @break
    @endswitch
</td>
{{--FALTAS 3º BIMESTRE--}}
<td class="text-center">
    <input type="text" style="width: 2.0rem" tabindex="10" step='1'
           min="0" max="1000"
           name="f_t_b[]"
           class="table-target text-secondary"
           value="{{$fechamento->f_t_b, old('f_t_b')}}">
</td>
{{--FALTAS COMPENSADAS 3º BIMESTRE--}}
<td class="text-center">
    <input type="text" style="width: 2.0rem" tabindex="11" step='1'
           min="0" max="1000"
           name="f_c_t_b[]"
           class="table-target text-secondary"
           value="{{$fechamento->f_c_t_b, old('f_c_t_b')}}">
</td>
{{--AULAS DADAS 3º BIMESTRE--}}
<td class="text-center">
    <input type="text" style="width: 2.0rem" tabindex="12" step='1'
           min="0" max="1000"
           name="a_d_t_b[]"
           class="table-target text-secondary"
           value="{{$fechamento->a_d_t_b, old('a_d_t_b')}}">
</td>
