<?php
declare(strict_types=1);

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Repositories\Components\TutoriasRepository;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

/**
 *TutoriaController
 */
class TutoriaController extends Controller
{
    protected TutoriasRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    /**
     * Create a new component instance.
     */
    public function __construct(TutoriasRepository $repository, Request $request, FlashMessage $message)
    {
        $this->repository = $repository;
        $this->request = $request;
        $this->message = $message;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function index(): View
    {
        return view('dashboard.tutors.tutorados');
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
//            $this->message->deleteSuccess();

        } else {
            $this->message->deleteError();

        }

        return redirect()->back();
    }
}
