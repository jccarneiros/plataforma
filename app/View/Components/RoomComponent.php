<?php

declare(strict_types=1);

namespace App\View\Components;

use App\Http\Requests\Administrations\RoomsStoreFormRequest;
use App\Http\Requests\Administrations\RoomsUpdateFormRequest;
use App\Models\Fechamento;
use App\Models\Room;
use App\Models\Serie;
use App\Models\Student;
use App\Models\TipoEnsino;
use App\Models\User;
use App\Repositories\Components\RoomsRepository;
use App\Repositories\Components\SeriesRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use RealRashid\SweetAlert\Facades\Alert;

class RoomComponent extends Component
{
    protected RoomsRepository $repository;

    protected Request $request;

    protected FlashMessage $message;

    /**
     * @param RoomsRepository $repository
     * @param Request $request
     * @param FlashMessage $message
     */
    public function __construct(RoomsRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;

    }

    /**
     * Get the view / view contents that represent the component.
     */
    public function render(): View
    {
        return view('components.rooms.room-component');
    }

    /**
     * @param RoomsStoreFormRequest $storeFormRequest
     * @return RedirectResponse
     */
    public function store(Request $storeFormRequest): RedirectResponse
    {

        if ($this->request->input('name') == '') {
            $store = $this->repository::create([
                'tipo_ensino_id' => $storeFormRequest->input('tipo_ensino_id'),
                'serie_id' => $storeFormRequest->input('serie_id'),
                'name' => $this->request->input('room') . $this->request->input('letter'),
                'type' => nameCase($storeFormRequest['type']),
                'slug' => Str::slug($storeFormRequest['name']),
            ]);
        } else {
            $store = $this->repository::create([
                'tipo_ensino_id' => $storeFormRequest->input('tipo_ensino_id'),
                'serie_id' => $storeFormRequest->input('serie_id'),
                'name' => $storeFormRequest['name'],
                'type' => nameCase($storeFormRequest['type']),
                'slug' => Str::slug($storeFormRequest['name']),
            ]);
        }

        if ($store) {
            $this->message->storeSuccess();
        } else {
            $this->message->storeError();
        }

        return redirect()->back();
    }

    /**
     * @param RoomsUpdateFormRequest $updateFormRequest
     * @param int $id
     * @return RedirectResponse
     */
    public function update(RoomsUpdateFormRequest $updateFormRequest, int $id): RedirectResponse
    {
        $item = $this->repository::find($id);

        $update = $this->repository::update($item->id, [
            'name' => $updateFormRequest['name'],
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
     * @param $room
     * @return View
     */
    public function students($room): View
    {
        $room = Room::find($room);

        $tipoEnsinos = TipoEnsino::orderBy('name', 'asc')->get();
        $series = Serie::orderBy('tipo_ensino_id', 'asc')->orderBy('name', 'asc')->get();
        $rooms = Room::orderBy('tipo_ensino_id', 'asc')->orderBy('serie_id', 'asc')->orderBy('name', 'asc')->get();

        return view('components.students.student-component', compact('room', 'tipoEnsinos', 'series', 'rooms'));
    }

    public function disciplines($room): View
    {
        $room = Room::with('fechamentos')->find($room);

        $teachers = User::where('role', 'Professor(a)')->orderBy('name', 'asc')->get();

        return view('components.disciplines.discipline-component',
            compact('room', 'teachers'));
    }
}
