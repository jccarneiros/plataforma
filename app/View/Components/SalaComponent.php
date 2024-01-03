<?php

namespace App\View\Components;

use App\Http\Requests\Administrations\SalasStoreFormRequest;
use App\Http\Requests\Administrations\SalasUpdateFormRequest;
use App\Models\Sala;
use App\Repositories\Components\SalasRepository;
use App\Services\FlashMessage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class SalaComponent extends Component
{
    protected SalasRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    /**
     * Create a new component instance.
     */
    public function __construct(SalasRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $salas = Sala::with('tutor')->orderBy('name', 'asc')->latest()->get();

        return view('components.salas.sala-component', compact('salas'));
    }

    public function store(SalasStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = $this->repository::create([
            'name' => mb_strtoupper($storeFormRequest->input('name'), 'utf-8'),
        ]);
        if ($store) {
            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

    /**
     * @param SalasUpdateFormRequest $updateFormRequest
     * @param int $id
     * @return RedirectResponse
     */
    public function update(SalasUpdateFormRequest $updateFormRequest, int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'name' => mb_strtoupper($updateFormRequest->input('name'), 'utf-8'),
        ]);

        if ($update) {
            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }

    /**
     * @param int $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $delete = $this->repository::delete($item->id);

        if ($delete) {
            $this->message->deleteSuccess();

        } else {
            $this->message->deleteError();

        }

        return redirect()->back();
    }
}
