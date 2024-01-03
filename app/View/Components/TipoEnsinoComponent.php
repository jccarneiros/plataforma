<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Http\Requests\Administrations\TipoEnsinosStoreFormRequest;
use App\Http\Requests\Administrations\TipoEnsinosUpdateFormRequest;
use App\Repositories\Components\TipoEnsinosRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\Component;


/**
 * TipoEnsinoComponent
 */
class TipoEnsinoComponent extends Component
{
    protected TipoEnsinosRepository $repository;

    protected Request $request;

    protected FlashMessage $message;

    /**
     * @param TipoEnsinosRepository $repository
     * @param Request $request
     * @param FlashMessage $message
     */
    public function __construct(TipoEnsinosRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
    }

    /**
     * Get the view / view contents that represent the component.
     *
     * @return View
     */
    public function render(): View
    {
        $data = TipoEnsinosRepository::getTipoEnsinos(['series', 'rooms', 'students'], 'name', 'asc');

        return view('components.tipo-ensinos.tipo-ensino-component', compact('data'));
    }

    /**
     * @param TipoEnsinosStoreFormRequest $storeFormRequest
     * @return RedirectResponse
     */
    public function store(TipoEnsinosStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = $this->repository::create([
            'name' => titleCase($storeFormRequest['name']),
            'type' => titleCase($storeFormRequest['type']),
            'slug' => Str::slug($storeFormRequest['name']),
        ]);
        if ($store) {
            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

    /**
     * @param TipoEnsinosUpdateFormRequest $updateFormRequest
     * @param int $id
     * @return RedirectResponse
     */
    public function update(TipoEnsinosUpdateFormRequest $updateFormRequest, int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'name' => titleCase($updateFormRequest['name']),
            'type' => titleCase($updateFormRequest['type']),
            'slug' => Str::slug($updateFormRequest['name']),
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

        $inactive = $this->repository::delete($item->id);

        if ($inactive) {
            $this->message->deleteSuccess();

        } else {
            $this->message->deleteError();

        }

        return redirect()->back();
    }
}
