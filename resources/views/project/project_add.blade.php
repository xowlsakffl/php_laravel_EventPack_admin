@extends('layouts.app')

@section('content')
    <h2>프로젝트 생성</h2>
    <form action="{{route('admin.works.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="">아이디</label>
            <input type="text" name="uid" id="uid_search" class="form-control @error('uid') is-invalid @enderror" value="{{old('uid')}}" required autocomplete="off">
            @error('uid')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        <div class="form-group">
            <label for="">프로젝트명</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{old('name')}}" required>
            @error('name')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">참가자 수</label>
            <input type="text" name="participant" class="form-control @error('participant') is-invalid @enderror" value="{{old('participant')}}" required>
            @error('participant')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">기간</label>
            <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{old('duration')}}" required>
            @error('duration')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="">상태</label>
            <select name="state" class="form-control lg">
                <option value="10">정상</option>
                <option value="9">대기</option>
            </select>
            @error('state')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">프로젝트 생성</button>
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