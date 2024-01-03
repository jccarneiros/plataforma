<div class="row">
    <div class="col-sm" style="border: 1px solid #ccc">
        <h4 style="font-size: 100%;padding-top: 10px">Grupos</h4>
        <hr>
        @foreach($roles as $role)
            <div class="form-check form-check">
                <label class="control control--checkbox checkbox-inline">{{ $role->name}}&nbsp;
                    <input type="checkbox" name="roles[]" value="{{$role->id}}"
                    @forelse($supervisor->roles as $supervisorRole)
                        {{ $supervisorRole->id == $role->id ? 'checked' : '' }}
                        @empty

                        @endforelse
                    />
                    <div class="control__indicator"></div>
                </label>
            </div>
        @endforeach
    </div>
</div>
<br>
