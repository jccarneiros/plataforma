<div class="row">
    <h4 style="border-left: 5px solid #aa00ff;background-color: #f5f5f5;width: 100%;padding: 2px 0px 5px 10px;" class="text-uppercase">Permissões para {{$role->name}}</h4>
    <div class="col-sm" style="border: 1px solid #ccc">
        <h4 style="font-size: 100%;padding-top: 10px">TIPO DE ENSINO</h4>
        <hr>
        @foreach($permissions->slice(0, 4) as $permission)
            <label class="control control--checkbox">{{ $permission->name}}&nbsp;
                <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                @forelse($role->permissions as $rolePermission)
                    {{ $rolePermission->id == $permission->id ? 'checked' : '' }}
                    @empty

                    @endforelse
                />
                <div class="control__indicator"></div>
            </label>
        @endforeach
    </div>
    <div class="col-sm" style="border: 1px solid #ccc">
        <h4 style="font-size: 100%;padding-top: 10px">SÉRIE</h4>
        <hr>
        @foreach($permissions->slice(4, 4) as $permission)
            <label class="control control--checkbox">{{ $permission->name}}&nbsp;
                <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                @forelse($role->permissions as $rolePermission)
                    {{ $rolePermission->id == $permission->id ? 'checked' : '' }}
                    @empty

                    @endforelse
                />
                <div class="control__indicator"></div>
            </label>
        @endforeach
    </div>
    <div class="col-sm" style="border: 1px solid #ccc">
        <h4 style="font-size: 100%;padding-top: 10px">TURMAS</h4>
        <hr>
        @foreach($permissions->slice(8, 4) as $permission)
            <label class="control control--checkbox">{{ $permission->name}}&nbsp;
                <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                @forelse($role->permissions as $rolePermission)
                    {{ $rolePermission->id == $permission->id ? 'checked' : '' }}
                    @empty

                    @endforelse
                />
                <div class="control__indicator"></div>
            </label>
        @endforeach
    </div>
    <div class="col-sm" style="border: 1px solid #ccc">
        <h4 style="font-size: 100%;padding-top: 10px">ALUNOS</h4>
        <hr>
        @foreach($permissions->slice(12, 4) as $permission)
            <label class="control control--checkbox">{{ $permission->name}}&nbsp;
                <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                @forelse($role->permissions as $rolePermission)
                    {{ $rolePermission->id == $permission->id ? 'checked' : '' }}
                    @empty

                    @endforelse
                />
                <div class="control__indicator"></div>
            </label>
        @endforeach
    </div>
    <div class="col-sm" style="border: 1px solid #ccc">
        <h4 style="font-size: 100%;padding-top: 10px">BACKUPS</h4>
        <hr>
        @foreach($permissions->slice(16, 4) as $permission)
            <label class="control control--checkbox">{{ $permission->name}}&nbsp;
                <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                @forelse($role->permissions as $rolePermission)
                    {{ $rolePermission->id == $permission->id ? 'checked' : '' }}
                    @empty

                    @endforelse
                />
                <div class="control__indicator"></div>
            </label>
        @endforeach
    </div>
</div>
<div class="row">
    <div class="col-sm" style="border: 1px solid #ccc">
        <h4 style="font-size: 100%;padding-top: 10px">Conselho</h4>
        <hr>
        @foreach($permissions->slice(26, 1) as $permission)
            <label class="control control--checkbox">{{ $permission->name}}&nbsp;
                <input type="checkbox" name="permissions[]" value="{{$permission->id}}"
                @forelse($role->permissions as $rolePermission)
                    {{ $rolePermission->id == $permission->id ? 'checked' : '' }}
                        @empty

                        @endforelse
                />
                <div class="control__indicator"></div>
            </label>
        @endforeach
    </div>
</div>
<br>
