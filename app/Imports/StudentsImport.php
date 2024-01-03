<?php

declare(strict_types=1);

namespace App\Imports;

use App\Enums\SupportStatus;
use App\Models\Aluno;
use App\Models\Student;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;

/**
 * StudentsImport
 */
class StudentsImport implements ToModel
{
    /**
     * @param array $row
     * @return void
     */
    public function model(array $row): void
    {
        // Seta o limite de post do php
        set_time_limit(3600);

        $ra = $row[2];
        $email_microsoft = '0000' . $ra . $row[3] . 'sp@aluno.educacao.sp.gov.br';
        $email_google = '0000' . $ra . $row[3] . 'sp@al.educacao.sp.gov.br';
        $check_user = DB::table('users')->where('email', '=', $email_google)->exists();
        if (Student::where('tipo_ensino_id', '=', request()->input('tipo_ensino_id'))
            ->where('serie_id', '=', request()->input('serie_id'))
            ->where('room_id', '=', request()->input('room_id'))
            ->where('number', '=', $row[0])->where('number_ra', '=', $row[2])->exists()) {
            Student::where('tipo_ensino_id', '=', request()->input('tipo_ensino_id'))
                ->where('serie_id', '=', request()->input('serie_id'))
                ->where('room_id', '=', request()->input('room_id'))
                ->where('number', '=', $row[0])->where('number_ra', '=', $row[2])->update(
                    [
                        'tipo_ensino_id' => request()->input('tipo_ensino_id'),
                        'serie_id' => request()->input('serie_id'),
                        'room_id' => request()->input('room_id'),
                        'type' => request()->input('type'),
                        'number' => $row[0],
                        'name' => nameCase($row[1]),
                        'number_ra' => $row[2],
                        'number_ra_digit' => $row[3],
                        'uf_ra' => 'SP',
                        'date_birth' => $this->transformDate($row[4]),
                        'email_microsoft' => $email_microsoft,
                        'email_google' => $email_google,
                        'student_situation' => nameCase($row[5]),
                    ]
                );
            DB::table('alunos')->where('number_ra', '=', $row[2])
                ->update(
                    [
                        'name' => nameCase($row[1]),
                        'number_ra' => $row[2],
                        'number_ra_digit' => $row[3],
                        'uf_ra' => 'SP',
                        'date_birth' => $this->transformDate($row[4]),
                        'email_microsoft' => $email_microsoft,
                        'email_google' => $email_google,
                        'student_situation' => nameCase($row[5]),
                    ]
                );
        } else {
            // Se não exitir será criado um novo registro na tabela students
            Student::create(
                [
                    'tipo_ensino_id' => request()->input('tipo_ensino_id'),
                    'serie_id' => request()->input('serie_id'),
                    'room_id' => request()->input('room_id'),
                    'type' => request()->input('type'),
                    'number' => $row[0],
                    'name' => nameCase($row[1]),
                    'number_ra' => $row[2],
                    'number_ra_digit' => $row[3],
                    'uf_ra' => 'SP',
                    'date_birth' => $this->transformDate($row[4]),
                    'email_microsoft' => $email_microsoft,
                    'email_google' => $email_google,
                    'student_situation' => nameCase($row[5]),
                ]
            );
            $aluno = DB::table('alunos')->select('number_ra')->where('number_ra', '=', $row[2])->exists();
            if ($aluno === false) {
                // Gera o qrcode com a api do google
                $url = "https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=/painel/estudantes/cadastrar/qrcode/$row[2]";

                // Gera o nome do arquivo com o ra do aluno e extensão do arquivo
                $fileName = $row[2] . '.png';

                // Recebe o nome da turma da view dashboard.rooms.students.blade.php
                $roomName = request()->input('room_name');

                // Verifica se existe o diretório da turma no Google Drive
                $pathGoogleDrive = Storage::disk('google')->exists("ArquivosPlataforma/QrCodes/$roomName");

                // Se existir o diretório da turma no Google Drive
                if ($pathGoogleDrive === true) {
                    // Retorna um array com os arquivos na turma no Google Drive
                    $files = Storage::disk('google')->files("ArquivosPlataforma/QrCodes/$roomName");
                    // Verifica se existe o arquivo no array na turma no Google Drive
                    if (in_array("ArquivosPlataforma/QrCodes/$roomName/$fileName", $files)) {
                        // Se existir o arquivo, exclui o arquivo na turma no Google Drive
                        Storage::disk('google')->delete("ArquivosPlataforma/QrCodes/$roomName/$fileName");
                    }
                    // Cria um novo arquivo na turma no Google Drive
                    Storage::disk('google')->putFileAs("ArquivosPlataforma/QrCodes/$roomName", $url, $fileName);
                    // Cria um novo arquivo no diretório storage da aplicação
                    Storage::disk('local')->put('/public/images/qrcodes/' . $row[2] . '.png', file_get_contents($url));
                } else {
                    // Cria um novo arquivo na turma no Google Drive
                    Storage::disk('google')->putFileAs("ArquivosPlataforma/QrCodes/$roomName", $url, $fileName);
                    // Cria um novo arquivo no diretório storage da aplicação
                    Storage::disk('local')->put('/public/images/qrcodes/' . $row[2] . '.png', file_get_contents($url));
                }
                Aluno::create(
                    [
                        'name' => nameCase($row[1]),
                        'number_ra' => $row[2],
                        'number_ra_digit' => $row[3],
                        'uf_ra' => 'SP',
                        'date_birth' => $this->transformDate($row[4]),
                        'email_microsoft' => $email_microsoft,
                        'email_google' => $email_google,
                        'student_situation' => nameCase($row[5]),
                        'qrcode' => $fileName,
                    ]
                );
            }
        }

        if ($check_user) {
            DB::table('users')->where('email', '=', $email_google)
                ->update(
                    [
                        'name' => nameCase($row[1]),
                        'email' => $email_google,
                    ]
                );
        } else {
            (new User())->create([
                'admin' => 0,
                'code' => uniqid('', false),
                'name' => nameCase($row[1]),
                'email' => $email_google,
                'password' => Hash::make($row[2]),
                'role' => SupportStatus::ST,

            ]);
        }
    }

    public function transformDate($value, $format = 'Y-m-d')
    {
        try {
            return \Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($value));
        } catch (\ErrorException $e) {
            return \Carbon\Carbon::createFromFormat($format, $value);
        }
    }
}
