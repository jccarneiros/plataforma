<?php

namespace App\View\Components;

use App\Repositories\Components\EletivasRepository;
use App\Services\FlashMessage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\Component;

class EletivaComponent extends Component
{
    protected EletivasRepository $repository;
    protected Request $request;
    protected FlashMessage $message;

    /**
     * Create a new component instance.
     */
    public function __construct(EletivasRepository $repository, Request $request, FlashMessage $message)
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
        return view('components.eletiva-component');
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
