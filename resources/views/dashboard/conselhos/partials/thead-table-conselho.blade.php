<thead>
<tr>
    <th style="width: 20rem !important;" colspan="1" class="text-center fw-bold">
        {{$room->name}}
    </th>
    <th colspan="4" class="text-center"
        style="background-color: #e57373 !important;color: #ffffff !important;">1ºB
    </th>
    <th colspan="4" class="text-center"
        style="background-color: #ba68c8 !important;color: #ffffff !important;">2ºB
    </th>
    <th colspan="4" class="text-center"
        style="background-color: #4db6ac !important;color: #ffffff !important;">3ºB
    </th>
    <th colspan="4" class="text-center"
        style="background-color: #7986cb !important;color: #ffffff !important;">4ºB
    </th>
    <th colspan="1" class="text-center"
        style="background-color: #ff8a65 !important;color: #ffffff !important;">5ºC
    </th>
    @if (isset($result) && $result->resultado_final_student !== null)
        <th colspan="6" class="text-center text-uppercase"
            style="background-color: #607d8b  !important;color: #ffffff !important;">
            {{$result->resultado_final_student}}
        </th>
    @else
        <th colspan="6" class="text-center text-uppercase"
            style="background-color: #607d8b  !important;color: #ffffff !important;">
            Resultado
        </th>
    @endif
</tr>
<tr>
    <th class="text-center">Disciplinas</th>
    <th class="text-center"
        style="background-color: #e57373 !important;color: #ffffff !important;">
        N
    </th>
    <th class="text-center"
        style="background-color: #e57373 !important;color: #ffffff !important;">
        F
    </th>
    <th class="text-center"
        style="background-color: #e57373 !important;color: #ffffff !important;">
        F.C.
    </th>
    <th class="text-center"
        style="background-color: #e57373 !important;color: #ffffff !important;">
        A.D.
    </th>

    <th class="text-center"
        style="background-color: #ba68c8 !important;color: #ffffff !important;">
        N
    </th>
    <th class="text-center"
        style="background-color: #ba68c8 !important;color: #ffffff !important;">
        F
    </th>
    <th class="text-center"
        style="background-color: #ba68c8 !important;color: #ffffff !important;">
        F.C
    </th>
    <th class="text-center"
        style="background-color: #ba68c8 !important;color: #ffffff !important;">
        A.D.
    </th>

    <th class="text-center"
        style="background-color: #4db6ac !important;color: #ffffff !important;">
        N
    </th>
    <th class="text-center"
        style="background-color: #4db6ac !important;color: #ffffff !important;">
        F
    </th>
    <th class="text-center"
        style="background-color: #4db6ac !important;color: #ffffff !important;">
        F.C
    </th>
    <th class="text-center"
        style="background-color: #4db6ac !important;color: #ffffff !important;">
        A.D.
    </th>

    <th class="text-center"
        style="background-color: #7986cb !important;color: #ffffff !important;">
        N
    </th>
    <th class="text-center"
        style="background-color: #7986cb !important;color: #ffffff !important;">
        F
    </th>
    <th class="text-center"
        style="background-color: #7986cb !important;color: #ffffff !important;">
        F.C
    </th>
    <th class="text-center"
        style="background-color: #7986cb !important;color: #ffffff !important;">
        A.D.
    </th>

    <th class="text-center"
        style="background-color: #ff8a65 !important;color: #ffffff !important;">
        N
    </th>

    <th class="text-center"
        style="background-color: #607d8b !important;color: #ffffff !important;">
        T.F.BS.
    </th>
    <th class="text-center"
        style="background-color: #607d8b !important;color: #ffffff !important;">
        T.F.C.
    </th>
    <th class="text-center"
        style="background-color: #607d8b !important;color: #ffffff !important;">
        T.F.A.
    </th>
    <th class="text-center"
        style="background-color: #607d8b !important;color: #ffffff !important;">
        T.A.D.A
    </th>
    <th class="text-center"
        style="background-color: #607d8b !important;color: #ffffff !important;">
        F. %
    </th>
</tr>
</thead>