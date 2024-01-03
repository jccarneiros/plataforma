<?php
declare(strict_types=1);

namespace Modules\Administrators\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Administrations\ConfigurationsUpdateFormRequest;
use App\Models\Configuration;
use App\Services\FlashMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

/**
 * SupervisorController
 */
class ConfigurationController extends Controller
{

    protected FlashMessage $message;

    /**
     * @param FlashMessage $message
     */
    public function __construct(FlashMessage $message)
    {
        $this->message = $message;
    }

    /**
     * @return View
     */
    public function index($id): View
    {
        $item = (new Configuration())->find($id);

        return view('administrators::configurations.index', compact('item'));
    }

    /**
     * @param ConfigurationsUpdateFormRequest $formRequest
     * @param $id
     * @return RedirectResponse
     */
    public function update(ConfigurationsUpdateFormRequest $formRequest, $id): RedirectResponse
    {
        $item = (new Configuration())->find($id);

        $update = Configuration::where('id', $item->id)->update([
            'app_name' => $formRequest['app_name'],
            'app_email' => trim($formRequest['app_email']),
            'app_cep' => $formRequest['app_cep'],
            'app_endereco' => $formRequest['app_endereco'],
            'app_numero' => $formRequest['app_numero'],
            'app_bairro' => $formRequest['app_bairro'],
            'app_cidade' => $formRequest['app_cidade'],
            'app_estado' => $formRequest['app_estado'],
            'app_site' => $formRequest['app_site'],
            'app_phone' => $formRequest['app_phone'],
            'app_whatsapp' => $formRequest['app_whatsapp'],
            'app_author' => $formRequest['app_author'],
            'app_url' => $formRequest['app_url'],
            'app_debug' => $formRequest['app_debug'],
            'app_env' => $formRequest['app_env'],
            'app_description' => $formRequest['app_description'],
            'session_lifetime' => $formRequest['session_lifetime'],
            'session_expire_on_close' => $formRequest['session_expire_on_close'],
            'session_encrypt' => $formRequest['session_encrypt'],
            'app_enable_register' => $formRequest['app_enable_register'],
        ]);

        if ($update) {
            $this->message->updateSuccess();

        } else {
            $this->message->updateError();

        }

        return redirect()->back();

    }
}
