<?php
declare(strict_types=1);

namespace Modules\Administrators\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

/**
 * SupervisorController
 */
class BackupDataBaseController extends Controller
{  /**
 * The name and signature of the console command.
 */
    protected string $signature = 'app:database-backup';

    public function __construct(Command $signature)
    {
        $this->middleware('auth');
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $arrayShipping = array_map('pathinfo', File::files(storage_path('/app/backup/')));
        $arrayView = Arr::pluck($arrayShipping, 'dirname');
        return view('administrators::backups.index', compact('arrayShipping', 'arrayView'));
    }

    public function create(): RedirectResponse
    {
        //        $backup = Artisan::call('backup:run --only-db');
        if (! Storage::exists('backup')) {
            Storage::makeDirectory('backup');
        }

        $filename = Carbon::now()->format('Y-m-d-H-i-s').'.gz';

        $command = 'mysqldump --user='.env('DB_USERNAME').' --password='.env('DB_PASSWORD')
            .' --host='.env('DB_HOST').' '.env('DB_DATABASE')
            .'  | gzip > '.storage_path().'/app/backup/'.$filename;

        $returnVar = null;
        $output = null;

        $backup = exec($command, $output, $returnVar);

        if (! $backup) {
            toast('Backup criado com sucesso!', 'success')->autoClose(1500)->timerProgressBar();
        } else {
            Alert::error('Erro!', 'Não foi possível criar o backup!')->timerProgressBar();
        }

        return redirect()->back();

    }

    public function cleanBackup($filename = '')
    {
        $name_file = storage_path('/app/backup/'.$filename.'.gz');
        if (file_exists($name_file)) {

            $backupClean = unlink($name_file);

            if ($backupClean) {
                toast('Backups excluidos com sucesso!', 'success')->autoClose(1500)->timerProgressBar();
            } else {
                Alert::error('Erro!', 'Não foi possível excluir o backup!')->timerProgressBar();
            }
        } else {
            Alert::error('Erro!', 'O arquivo solicitado não existe em nosso servidor!')->timerProgressBar();
//            exit('O arquivo solicitado não existe em nosso servidor!');
        }

        return redirect()->back();
    }

    public function download($filename = '')
    {
        // Check if file exists in app/storage/file folder
        $file_path = storage_path('/app/backup/'.$filename.'.gz');
        $headers = [
            'Content-Type: csv',
            'Content-Disposition: attachment; filename='.$filename,
        ];
        if (file_exists($file_path)) {
            // Send Download
            return Response::download($file_path, $filename.'.gz', $headers);
        } else {
            // Error
            exit('O arquivo solicitado não existe em nosso servidor!');
        }
    }
}
