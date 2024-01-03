<form action="{{route('dashboard.salas.store')}}" method="POST">
    @csrf
    <div class="row">
        <div class="col-sm-12 col-md-12 col-lg-10 col-xl-10 mb-2">
            <input type="text" name="name" class="form-control form-control-sm">
        </div>
        <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-2">
            <button type="submit" class="btn btn-sm btn-success w-100">Salvar</button>
        </div>
        <div class="col-sm-12 col-md-12 col-lg-1 col-xl-1 mb-2">
            <a href="{{route('dashboard')}}" class="btn btn-sm btn-primary w-100">
                Painel
            </a>
        </div>
    </div>
</form>