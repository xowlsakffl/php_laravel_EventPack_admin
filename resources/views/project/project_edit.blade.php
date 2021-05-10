@extends('layouts.app')

@section('content')
    <h2>프로젝트 수정</h2>
    <form action="{{route('admin.works.update' ,['wdx' => $data['user_work']->wdx])}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">아이디</label>
            <input type="text" name="uid" id="uid_search" class="form-control @error('uid') is-invalid @enderror" value="{{$data['user_uid']}}" required autocomplete="off">
            @error('uid')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">프로젝트명</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$data['user_work']->name}}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">참가자 수</label>
            <input type="text" name="participant" class="form-control @error('participant') is-invalid @enderror" value="{{$data['user_work']->participant}}" required>
            @error('participant')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">기간</label>
            <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{$data['user_work']->duration}}" required>
            @error('duration')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="">상태</label>
            <select name="state" class="form-control form-control-lg">
                <option value="10" @if($data['user_work']->state === 10) selected @endif>정상</option>
                <option value="9" @if($data['user_work']->state === 9) selected @endif>대기</option>
                <option value="8" @if($data['user_work']->state === 8) selected @endif>정지</option>
                <option value="7" @if($data['user_work']->state === 7) selected @endif>만료</option>
                <option value="0" @if($data['user_work']->state === 0) selected @endif>삭제</option>
            </select>
            @error('state')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">프로젝트 수정</button>
        </div>
    </form>
@endsection

@section('page-script')
    <script type="text/javascript">
    $(function(){
        $("#uid_search").autocomplete({
            source: function(request, response){
                $.ajax({
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    url : "{{route('admin.works.getuid')}}",
                    type : "post",
                    dataType : "json",
                    data : {
                        search: request.term
                    },
                    success: function(data){
                        response(data);
                    }
                });
            },
            minLength: 2,
            select: function(event, ui){
                $('#uid_search').val(ui.item.value);
                return false;
            },
            focus : function(event, ui) {
                return false;
            },
        })
    })
    </script>
@stop