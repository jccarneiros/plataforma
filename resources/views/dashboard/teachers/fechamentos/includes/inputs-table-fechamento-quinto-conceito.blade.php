{{--NOTAS 5º CONCEITO--}}
<td>
    @if($discipline->status_q_c !== 1)
        @switch($fechamento->n_q_c)
            @case(ctype_alpha($fechamento->n_q_c) == true)
                <input type="text" style="width: 2.5rem"
                       name="n_q_c[]"
                       class="table-target text-secondary text-uppercase" tabindex="13"
                       value="{{$fechamento->n_q_c}}" readonly>
                @break
            @case($fechamento->n_q_c >= 5)
                <input type="text" style="width: 2.5rem"
                       name="n_q_c[]"
                       class="table-target text-primary" tabindex="13"
                       value="{{$fechamento->n_q_c}}" readonly>
                @break

            @case($fechamento->n_q_c < 5)
                <input type="text" style="width: 2.5rem"
                       name="n_q_c[]"
                       class="table-target text-danger" tabindex="13"
                       value="{{$fechamento->n_q_c}}" readonly>
                @break
        @endswitch
    @else
        @switch($fechamento->n_q_c)
            @case(ctype_alpha($fechamento->n_q_c) == true)
                <input type="text" style="width: 2.5rem"
                       name="n_q_c[]"
                       class="table-target text-secondary text-uppercase" tabindex="13"
                       value="{{$fechamento->n_q_c}}" readonly>
                @break
            @case($fechamento->n_q_c >= 5)
                <input type="text" style="width: 2.5rem"
                       name="n_q_c[]"
                       class="table-target text-primary" tabindex="13"
                       value="{{$fechamento->n_q_c}}"
                       readonly>
                @break

            @case($fechamento->n_q_c < 5)
                <input type="text" style="width: 2.5rem"
                       name="n_q_c[]"
                       class="table-target text-danger" tabindex="13"
                       value="{{$fechamento->n_q_c}}"
                       readonly>
                @break
        @endswitch
    @endif
</td>
