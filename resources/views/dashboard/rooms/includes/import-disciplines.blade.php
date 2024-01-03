<div class="row">
    <div class="col-sm-12 col-md-12 col-lg-8 col-xl-8">
        <div class="mb-3">
            <input type="file" id="field" name="select_file" class="form-control form-control-sm">
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-3 col-xl-3">
        <div class="mb-3">
            <input type="submit" id="submit" name="upload" class="btn btn-warning btn-sm" value="Importar">
        </div>
    </div>
    <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1">
        <div class="mb-3">
            <a href="{{route('dashboard.rooms.index', [$room->tipoEnsino->id,$room->serie->id])}}" class="btn btn-sm btn-secondary">
                <i class="fa-solid fa-rotate-left"></i>
            </a>
        </div>
    </div>
</div>
{{--@push('scripts')--}}
{{--    <script>--}}
{{--        document.getElementById("submit").disabled = true;--}}
{{--        let roomName = "{{$room->name}}.xlsx";--}}
{{--        const field = document.querySelector('#field');--}}

{{--        field.addEventListener('change', (event) => {--}}
{{--            for (const file of field.files) {--}}
{{--                if (file.name === roomName) {--}}
{{--                    document.getElementById("submit").disabled = false;--}}
{{--                }--}}
{{--                // console.log(file.name);--}}
{{--            }--}}
{{--        });--}}
{{--    </script>--}}
{{--@endpush--}}

