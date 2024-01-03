@extends('administrators::layouts.master')

@section('content')
    <div class="container mt-3">
        <div class="row">
            <h4 style="border-left: 5px solid #aa00ff;background-color: #f5f5f5;width: 100%;padding: 2px 0px 5px 10px;">
                Dados de Configuração da
                plataforma</h4>
            <hr>
            <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12">
                <form action="{{route('administrators.configurations.update', $item->id)}}" method="POST">
                    @csrf @method('PUT')
                    <input type="hidden" value="{{$item->id}}">
                    <div class="table-responsive">
                        <table class="table table-sm table-bordered table-hover">
                            <tr>
                                <td colspan="5">
                                    <label for="" class="label-custom">Nome:</label>
                                    <input type="text" name="app_name" value="{{$item->app_name}}"
                                           class="form-control form-control-sm">
                                    @error('app_name') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="6">
                                    <label for="" class="label-custom">E-mail:</label>
                                    <input type="text" name="app_email" value="{{$item->app_email}}"
                                           class="form-control form-control-sm">
                                    @error('app_email') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <label for="" class="label-custom">Endereço:</label>
                                    <input type="text" name="app_endereco" value="{{$item->app_endereco}}"
                                           class="form-control form-control-sm">
                                    @error('app_endereco') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="5">
                                    <label for="" class="label-custom">CEP:</label>
                                    <input type="text" name="app_cep" value="{{$item->app_cep}}"
                                           class="form-control form-control-sm">
                                    @error('app_cep') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="1">
                                    <label for="" class="label-custom">Nº:</label>
                                    <input type="text" name="app_numero" value="{{$item->app_numero}}"
                                           class="form-control form-control-sm">
                                    @error('app_numero') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                            </tr>

                            <tr>
                                <td colspan="5">
                                    <label for="" class="label-custom">Bairro:</label>
                                    <input type="text" name="app_bairro" value="{{$item->app_bairro}}"
                                           class="form-control form-control-sm">
                                    @error('app_bairro') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="6">
                                    <label for="" class="label-custom">Cidade:</label>
                                    <input type="text" name="app_cidade" value="{{$item->app_cidade}}"
                                           class="form-control form-control-sm">
                                    @error('app_cidade') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                            </tr>

                            <tr>
                                <td colspan="5">
                                    <label for="" class="label-custom">Estado:</label>
                                    <input type="text" name="app_estado" value="{{$item->app_estado}}"
                                           class="form-control form-control-sm">
                                    @error('app_estado') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="3">
                                    <label for="" class="label-custom">Telefone:</label>
                                    <input type="text" name="app_phone" value="{{$item->app_phone}}"
                                           class="form-control form-control-sm">
                                    @error('app_phone') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="3">
                                    <label for="" class="label-custom">WhatsApp:</label>
                                    <input type="text" name="app_whatsapp" value="{{$item->app_whatsapp}}"
                                           class="form-control form-control-sm">
                                    @error('app_whatsapp') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                            </tr>
                            <tr>
                                <td colspan="5">
                                    <label for="" class="label-custom">Link do Site / Blog:</label>
                                    <input type="text" name="app_site" value="{{$item->app_site}}"
                                           class="form-control form-control-sm">
                                    @error('app_site') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="6">
                                    <label for="" class="label-custom">Link da Plataforma:</label>
                                    <input type="text" name="app_url" value="{{$item->app_url}}"
                                           class="form-control form-control-sm">
                                    @error('app_url') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                            </tr>

                            <tr>
                                <td colspan="5">
                                    <label for="" class="label-custom">Autor:</label>
                                    <input type="text" name="app_author" value="{{$item->app_author}}"
                                           class="form-control form-control-sm">
                                    @error('app_author') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="6">
                                    <label for="" class="label-custom">Descrição:</label>
                                    <input type="text" name="app_description" value="{{$item->app_description}}"
                                           class="form-control form-control-sm">
                                    @error('app_description') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                            </tr>

                            <tr>
                                <td colspan="2">
                                    <label for="" class="label-custom">Debug:</label>
                                    <select name="app_debug" class="form-select form-select-sm">
                                        <option value="true">Sim</option>
                                        <option value="false">Não</option>
                                    </select>
                                    @error('app_debug') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="2">
                                    <label for="" class="label-custom">Tipo:</label>
                                    <select name="app_env" class="form-select form-select-sm">
                                        <option value="production ">Publicado</option>
                                        <option value="local">Local</option>
                                    </select>
                                    @error('app_env') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="1">
                                    <label for="" class="label-custom">Tempo de sessão:</label>
                                    <select name="session_lifetime" class="form-select form-select-sm">
                                        <option value="60">1 horas</option>
                                        <option value="120">2 horas</option>
                                        <option value="180">6 horas</option>
                                        <option value="1440">24 horas</option>
                                    </select>
                                    @error('session_lifetime') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="1">
                                    <label for="" class="label-custom">Expirar sessão:</label>
                                    <select name="session_expire_on_close" class="form-select form-select-sm">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                    @error('session_expire_on_close') <span
                                        class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="2">
                                    <label for="" class="label-custom">Criptografar sessão?:</label>
                                    <select name="session_encrypt" class="form-select form-select-sm">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                    @error('session_encrypt') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="1">
                                    <label for="" class="label-custom">Habilitar registro?:</label>
                                    <select name="app_enable_register" class="form-select form-select-sm">
                                        <option value="1">Sim</option>
                                        <option value="0">Não</option>
                                    </select>
                                    @error('app_enable_register') <span class="text-danger">{{$message}}</span>@enderror
                                </td>
                                <td colspan="1">
                                    <button type="submit" class="btn btn-sm btn-warning w-100">Editar</button>
                                </td>
                                <td colspan="1">
                                    <a href="{{route('administrators')}}" class="btn btn-sm btn-primary w-100">Painel</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
