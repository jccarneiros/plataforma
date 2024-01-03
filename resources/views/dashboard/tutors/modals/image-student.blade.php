<div class="modal fade" id="imageStudentTutoria{{$tutoria->id}}" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgb(52, 73, 94) !important;color: #cccccc!important;">
            <div class="modal-body text-center">
                <div class="mb-3">
                    <span>{{$tutoria->student->name}}</span>
                </div>
                <div class="mb-3">
                    @if($tutoria->student->avatar != null)
                        <img src="{{url('/assets/uploads/images/users/'.$tutoria->student->avatar)}}"
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
                    <span>Turma: {{$tutoria->student->room->name}} | RA: {{$tutoria->student->number_ra}} |
                        Dígito: {{$tutoria->student->number_ra_digit}} |  Idade: {{\Carbon\Carbon::parse($tutoria->student->date_birth)->age}}</span>
                </div>
                <div class="mb-3">
                    <span>{{$tutoria->student->email_microsoft}}</span>
                </div>
                <div class="mb-3">
                    <span>{{$tutoria->student->email_google}}</span>
                </div>
                <div class="mb-3">
                        Sala: {{$tutoria->tutor->sala->name}}
                </div>
                <div class="mb-3">
                        Tutor: {{$tutoria->tutor->user->name}}
                </div>
                <div class="mb-3">

                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
