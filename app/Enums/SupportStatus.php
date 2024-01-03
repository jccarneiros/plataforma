<?php

namespace App\Enums;

enum SupportStatus: string
{
    case SA = 'SuperAdmin';
    case SU = 'Supervisão';
    case MA = 'Gestão';
    case CO = 'Coordenação';
    case SE = 'Secretaria';
    case TE = 'Professor(a)';
    case ST = 'Aluno(a)';

}
