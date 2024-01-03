@can('students.create')
    <form action="{{route('dashboard.students.import')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <input type="hidden" name="tipo_ensino_id" value="{{$room->tipoEnsino->id}}">
            <input type="hidden" name="serie_id" value="{{$room->serie->id}}">
            <input type="hidden" name="room_id" value="{{$room->id}}">
            <input type="hidden" name="room_name" value="{{$room->name}}">
            <input type="hidden" name="type" value="{{$room->type}}">
            <div class="col-sm-12 col-md-12 col-lg-4 col-xl-4">
                <div hidden="" class="form-check">
                    <input name="create_user" class="form-check-input" type="checkbox" value="1" checked
                           id="flexCheckDefault">
                    <label class="form-check-label" for="flexCheckDefault">
                        Criar Usuário
                    </label>
                </div>
            </div>
            <div class="col-sm-12 col-md-12 col-lg-9 col-xl-9">
                <input type="file" name="select_file" id="field" class="form-control form-control-sm">
                @error('select_file') <span class="text-danger">{{$message}}</span>@enderror
            </div>
            <div class="col-sm-12 col-md-12 col-lg-2 col-xl-2">
                <input type="submit" id="submit" name="upload" class="btn btn-sm btn-success btn-submit"
                       value="Importar">
            </div>
            <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
                <a href="{{route('dashboard.rooms.index', [$room->tipoEnsino->id,$room->serie->id])}}" class="btn btn-sm btn-secondary">
                    <i class="fa-solid fa-rotate-left"></i>
                </a>
            </div>
        </div>
    </form>
@endcan
@push('scripts')
    <script>
        document.getElementById("submit").disabled = true;
        let roomName = "{{$room->name}}.xlsx";
        const field = document.querySelector('#field');

        field.addEventListener('change', (event) => {
            for (const file of field.files) {
                if (file.name === roomName) {
                    document.getElementById("submit").disabled = false;
                }
                // console.log(file.name);
            }
        });
    </script>
@endpush