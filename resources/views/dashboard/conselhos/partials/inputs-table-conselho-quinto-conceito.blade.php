{{--NOTAS 5º CONCEITO--}}
<td class="text-center">
    @switch($fechamento->n_q_c)
        @case(ctype_alpha($fechamento->n_q_c) == true)
            <input type="text" style="width: 2.0rem"
                   name="n_q_c[]"
                   class="table-target text-secondary text-uppercase" tabindex="17"
                   value="{{$fechamento->n_q_c,old('n_q_c')}}">
            @break
        @case($fechamento->n_q_c >= 5)
            <input type="text" style="width: 2.0rem"
                   name="n_q_c[]"
                   class="table-target text-success" tabindex="17"
                   value="{{$fechamento->n_q_c,old('n_q_c')}}">
            @break

        @case($fechamento->n_q_c < 5)
            <input type="text" style="width: 2.0rem"
                   name="n_q_c[]"
                   class="table-target text-danger" tabindex="17"
                   value="{{$fechamento->n_q_c,old('n_q_c')}}">
            @break
    @endswitch
</td>
