<div class="modal fade" id="imageStudentEletiva{{$eletiva->id}}" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgb(52, 73, 94) !important;color: #cccccc!important;">
            <div class="modal-body text-center">
                <div class="mb-3">
                    <span>{{$eletiva->student->name}}</span>
                </div>
                <div class="mb-3">
                    @if($eletiva->student->avatar != null)
                        <img src="{{url('/assets/uploads/images/users/'.$eletiva->student->avatar)}}"
                             alt=""
                             class="flex-shrink-0 me-2 rounded"
                             width="280" height="200">
                    @else
                        <img src="{{asset('/images/default-user.png')}}" alt=""
                             class="flex-shrink-0 me-2 rounded"
                             width="100" height="100">
                    @endif
                </div>
                <div class="mb-3">
                    <span>Turma: {{$eletiva->student->room->name}} | RA: {{$eletiva->student->number_ra}} |
                        Dígito: {{$eletiva->student->number_ra_digit}} |  Idade: {{\Carbon\Carbon::parse($eletiva->student->date_birth)->age}}</span>
                </div>
                <div class="mb-3">
                    <span>{{$eletiva->student->email_microsoft}}</span>
                </div>
                <div class="mb-3">
                    <span>{{$eletiva->student->email_google}}</span>
                </div>
                <div class="mb-3">
                        Sala: {{$eletiva->professor->sala->name}}
                </div>
                <div class="mb-3">
                        Professor: {{$eletiva->professor->user->name}}
                </div>
                <div class="mb-3">
                    Eletiva: {{$eletiva->professor->name_eletiva}}
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
