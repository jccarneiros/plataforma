<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @method find($id)
 */
class Configuration extends Model
{
    protected $guard = ['auth'];

    protected $table = 'configurations';

    protected $fillable = [
        'app_name',
        'app_email',
        'app_cep',
        'app_endereco',
        'app_numero',
        'app_bairro',
        'app_cidade',
        'app_estado',
        'app_site',
        'app_phone',
        'app_whatsapp',
        'app_author',
        'app_url',
        'app_debug',
        'app_env',
        'app_description',
        'session_lifetime',
        'session_expire_on_close',
        'session_encrypt',
        'app_enable_register',
    ];
}
