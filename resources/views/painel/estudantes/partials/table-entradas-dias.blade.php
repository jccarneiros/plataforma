<td class="text-center text-success" style="width: 1rem;">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_1 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_1)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_1)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_1)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_1 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_2 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_2)->format('H:i:s') <= '07:15:59' )
                <span class="text-success" >{{\Carbon\Carbon::parse($entranceStudent->day_2)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_2)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_2 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_3 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_3)->format('H:i:s') <= '07:15:59' )
                <span class="text-success" >{{\Carbon\Carbon::parse($entranceStudent->day_3)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_3)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_3 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_4 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_4)->format('H:i:s') <= '07:15:59' )
                <span class="text-success" >{{\Carbon\Carbon::parse($entranceStudent->day_4)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_4)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_4 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_5 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_5)->format('H:i:s') <= '07:15:59' )
                <span class="text-success" >{{\Carbon\Carbon::parse($entranceStudent->day_5)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_5)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_5 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_6 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_6)->format('H:i:s') <= '07:15:59' )
                <span class="text-success" >{{\Carbon\Carbon::parse($entranceStudent->day_6)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_6)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_6 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_7 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_7)->format('H:i:s') <= '07:15:59' )
                <span class="text-success" >{{\Carbon\Carbon::parse($entranceStudent->day_7)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_7)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_7 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_8 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_8)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_8)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_8)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_8 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_9 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_9)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_9)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_9)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_9 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_10 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_10)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_10)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_10)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_10 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_11 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_11)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_11)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_11)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_11 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_12 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_12)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_12)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_12)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_12 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_13 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_13)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_13)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_13)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_13 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_14 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_14)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_14)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_14)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_14 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_15 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_15)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_15)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_15)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_15 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_16 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_16)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_16)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_16)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_16 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_17 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_17)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_17)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_17)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_17 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_18 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_18)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_18)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_18)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_18 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_19 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_19)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_19)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_19)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_19 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_20 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_20)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_20)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_20)->format('H:i')}}</span>
            @endif
            @break
        @case($entranceStudent->day_20 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_21 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_21)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_21)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_21)->format('H:i')}}</span>
            @endif
        @case($entranceStudent->day_21 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_22 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_22)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_22)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_22)->format('H:i')}}</span>
            @endif
        @case($entranceStudent->day_22 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_23 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_23)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_23)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_23)->format('H:i')}}</span>
            @endif
        @case($entranceStudent->day_23 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_24 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_24)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_24)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_24)->format('H:i')}}</span>
            @endif
        @case($entranceStudent->day_24 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_25 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_25)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_25)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_25)->format('H:i')}}</span>
            @endif
        @case($entranceStudent->day_25 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_26 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_26)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_26)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_26)->format('H:i')}}</span>
            @endif
        @case($entranceStudent->day_26 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_27 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_27)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_27)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_27)->format('H:i')}}</span>
            @endif
        @case($entranceStudent->day_27 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_28 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_28)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_28)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_28)->format('H:i')}}</span>
            @endif
        @case($entranceStudent->day_28 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_29 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_29)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_29)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_29)->format('H:i')}}</span>
            @endif
        @case($entranceStudent->day_29 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_30 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_30)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_30)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_30)->format('H:i')}}</span>
            @endif
        @case($entranceStudent->day_30 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
<td class="text-center text-success" style="width: 1rem">
    @switch($entranceStudent->id)
        @case($entranceStudent->day_31 != null )
            @if(\Carbon\Carbon::parse($entranceStudent->day_31)->format('H:i:s') <= '07:15:59' )
                <span class="text-success">{{\Carbon\Carbon::parse($entranceStudent->day_31)->format('H:i')}}</span>
            @else
                <span class="text-danger">{{\Carbon\Carbon::parse($entranceStudent->day_31)->format('H:i')}}</span>
            @endif
        @case($entranceStudent->day_31 == null )
            <span class="text-danger"> </span>
            @break
    @endswitch
</td>
