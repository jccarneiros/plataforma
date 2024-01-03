<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Http\Requests\Administrations\SeriesStoreFormRequest;
use App\Http\Requests\Administrations\SeriesUpdateFormRequest;
use App\Models\Serie;
use App\Models\TipoEnsino;
use App\Repositories\Components\SeriesRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\Component;

/**
 * SerieComponent
 */
class SerieComponent extends Component
{
    protected SeriesRepository $repository;

    protected Request $request;

    protected FlashMessage $message;

    /**
     * @param SeriesRepository $repository
     * @param Request $request
     * @param FlashMessage $message
     */
    public function __construct(SeriesRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
    }


    /**
     * Get the view / view contents that represent the component.
     *
     * @return View|Htmlable|\Closure|string
     */
    public function render(): View
    {
        $tipoEnsinos = TipoEnsino::with('series', 'rooms', 'students')->orderBy('name', 'asc')->get();

        $data = SeriesRepository::getSeries(['tipoEnsino', 'rooms', 'students'], 'tipo_ensino_id', 'asc', 'name', 'asc');

        return view('components.series.serie-component', compact('tipoEnsinos', 'data'));
    }

    /**
     * @param SeriesStoreFormRequest $storeFormRequest
     * @return RedirectResponse
     */
    public function store(SeriesStoreFormRequest $storeFormRequest): RedirectResponse
    {
        $store = $this->repository::create([
            'tipo_ensino_id' => $storeFormRequest->input('tipo_ensino_id'),
            'name' => mb_strtoupper($storeFormRequest['name'], 'utf-8'),
            'type' => mb_strtoupper($storeFormRequest['type'], 'utf-8'),
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
     * @param SeriesUpdateFormRequest $updateFormRequest
     * @param int $id
     * @return RedirectResponse
     */
    public function update(SeriesUpdateFormRequest $updateFormRequest, int $id): RedirectResponse
    {

        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'tipo_ensino_id' => $updateFormRequest->input('tipo_ensino_id'),
            'name' => mb_strtoupper($updateFormRequest['name'], 'utf-8'),
            'type' => mb_strtoupper($updateFormRequest['type'], 'utf-8'),
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

    /**
     * @param $serie
     * @return View
     */
    public function rooms($serie): View
    {
        $serie = Serie::find($serie);

        $tipoEnsinos = TipoEnsino::with('series', 'rooms', 'students')->orderBy('name', 'asc')->get();

        $arrayRoom = ['6º','7º','8º','9º','1º','2º','3º',];

        return view('components.rooms.room-component', compact('serie', 'tipoEnsinos', 'arrayRoom'));
    }
}
