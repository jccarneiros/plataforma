<div class="modal fade" id="imageStudentConselho{{$student->id}}" tabindex="-1" aria-labelledby="userModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgb(52, 73, 94) !important;color: #cccccc!important;">
            <div class="modal-body text-center">
                <div class="mb-3">
                    <span>{{$student->name}}</span>
                </div>
                <div class="mb-3">
                    @if($student->avatar != null)
                        <img src="{{url('/assets/uploads/images/users/'.$student->avatar)}}"
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
                    <span>Turma: {{$student->room->name}} / RA: {{$student->number_ra}} / Dígito: {{$student->number_ra_digit}}
                     /  Idade: {{\Carbon\Carbon::parse($student->date_birth)->age}}</span>
                </div>
                <div class="mb-3">
                    <span>{{$student->email_google}}</span>
                </div>
                <div class="mb-3">
                    @if($student->tutoria)
                        Tutor: {{$student->tutoria->tutor->user->name}}
                    @else
                        Tutor: estudante sem tutor
                    @endif
                </div>
                <div class="mb-3">
                    @if($student->clube)
                        Sala: {{$student->clube->president->sala->name}}
                    @else
                        Presidente do clube: : clube sem presidente
                    @endif
                </div>
                <div class="mb-3">
                    @if($student->clube)
                        Clube: {{$student->clube->president->name_clube}}
                    @else
                        Clube: estudante sem clube
                    @endif
                </div>
                <div class="mb-3">
                    @if($student->clube)
                        Presidente: {{$student->clube->president->user->name}}
                    @else
                        Presidente: clube sem presidente
                    @endif
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
