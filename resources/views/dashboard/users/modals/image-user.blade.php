<div class="modal fade" id="imageUser{{$item->id}}" tabindex="-1" aria-labelledby="userModalLabel"
     aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: rgb(52, 73, 94) !important;color: #cccccc!important;">
            <div class="modal-header"></div>
            <div class="modal-body text-center">
                <div class="mb-3">
                    <span>{{$item->name}}</span>
                </div>
                <div class="mb-3">
                    @if($item->avatar != null)
                        <img src="{{url('/assets/uploads/images/users/'.$item->avatar)}}"
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
                    <span>{{$item->email}}</span>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-sm btn-default" data-bs-dismiss="modal">Fechar</button>
            </div>
        </div>
    </div>
</div>
