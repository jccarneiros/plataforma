<?php

declare(strict_types=1);

namespace App\Services;

use RealRashid\SweetAlert\Facades\Alert;

class FlashMessage
{
    public function importSuccess(): mixed
    {
        return toast('Registros importados com sucesso!', 'success')->autoClose(1500)->timerProgressBar();
    }

    public function existImageQrcode(): mixed
    {
        return Alert::warning('Atenção!', 'Já existe um qrcode para este aluno!')->timerProgressBar();
    }

    public function importError(): mixed
    {
        return Alert::error('Erro!', 'Não foi possível importar os registros!')->timerProgressBar();
    }
    public function exportSuccess(): mixed
    {
        return toast('Registros baixados com sucesso!', 'success')->autoClose(1500)->timerProgressBar();
    }

    public function exportError(): mixed
    {
        return Alert::error('Erro!', 'Não foi baixados importar os registros!')->timerProgressBar();
    }

    public function storeSuccess(): mixed
    {
        return toast('Registro realizado com sucesso!', 'success')->autoClose(1500)->timerProgressBar();
    }

    public function storeError(): mixed
    {
        return Alert::error('Erro!', 'Não foi possível realizar o registro!')->timerProgressBar();
    }

    public function updateSuccess(): mixed
    {
        return toast('Registro atualizado com sucesso!', 'success')->autoClose(1500)->timerProgressBar();
    }

    public function updateError(): mixed
    {
        return Alert::error('Erro!', 'Não foi possível atualizar o registro!')->timerProgressBar();
    }

    public function inactiveSuccess(): mixed
    {
        return toast('Registro inativado com sucesso!', 'success')->autoClose(1500)->timerProgressBar();
    }

    public function deleteSuccess(): mixed
    {
        return toast('Registro excluido com sucesso!', 'success')->autoClose(1500)->timerProgressBar();
    }

    public function inactiveError(): mixed
    {
        return Alert::error('Erro!', 'Não foi possível inativar o registro!)');
    }

    public function deleteError(): mixed
    {
        return Alert::error('Erro!', 'Não foi possível excluir o registro!)');
    }

    public function restoreSuccess(): mixed
    {
        return toast('Registro ativado com sucesso!', 'success')->autoClose(1500)->timerProgressBar();
    }

    public function restoreError(): mixed
    {
        return Alert::error('Erro!', 'Não foi possível ativar o registro!')->timerProgressBar();
    }

    public function destroySuccess(): mixed
    {
        return toast('Registro excluído com sucesso!', 'success')->autoClose(1500)->timerProgressBar();
    }

    public function destroyError(): mixed
    {
        return Alert::error('Erro!', 'Não foi possível excluído o registro!')->timerProgressBar();
    }

    public function forceDeleteSuccess(): mixed
    {
        return toast('Registro excluído com sucesso!', 'success')->autoClose(1500)->timerProgressBar();
    }

    public function forceDeleteError(): mixed
    {
        return Alert::error('Erro!', 'Não foi possível excluído o registro!')->timerProgressBar();
    }

    public function selectAvatar(): mixed
    {
        return Alert::error('Erro!', 'Selecione a imagem!')->timerProgressBar();
    }

    public function messageSelectRegisterCheckbox()
    {
        return Alert::warning('Alerta!', 'Por favor, selecione um registro!')->timerProgressBar();
        // Verifica se foi selecionado algum registro
//        return Toastr::warning('Por favor, selecione um registro! :)', 'Alerta!');
    }
}
