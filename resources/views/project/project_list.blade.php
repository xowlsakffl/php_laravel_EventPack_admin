@extends('layouts.app')

@section('content')
    @if ($workData)
    <form action="{{route('admin.works.index')}}" method="get" class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <select name="search_option" class="form-control">
                <option value="name">프로젝트명</option>
                <option value="uid">소유자명</option>
                <option value="duration">기간</option>
            </select>
        </div>

        <div class="form-group mx-sm-3 mb-2">
            <input type="text" name="search_text" class="form-control">
        </div>

        <div class="form-group mx-sm-3 mb-2">
            <input type="submit" value="검색" class="btn btn-primary">
        </div>
    </form>
    
    <div class="row">
        <div class="col">
            <a href="{{route('admin.works.index')}}">전체</a>
        </div>

        <div class="col">
            <a href="{{route('admin.works.index', ['state' => 'normal'])}}">정상</a>
        </div>

        <div class="col">
            <a href="{{route('admin.works.index', ['state' => 'waiting'])}}">대기</a>
        </div>

        <div class="col">
            <a href="{{route('admin.works.index', ['state' => 'stop'])}}">정지</a>
        </div>

        <div class="col">
            <a href="{{route('admin.works.index', ['state' => 'expiration'])}}">만료</a>
        </div>

        <div class="col">
            <a href="{{route('admin.works.index', ['state' => 'delete'])}}">삭제</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>번호</th>
                <th>프로젝트</th>
                <th>소유자</th>
                <th>참가자 수</th>
                <th>기간</th>
                <th>상태</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($workData as $w)
                <tr onclick="location.href='{{route('admin.works.show', ['wdx' => $w['wdx']])}}'">
                    <td>{{$workData->firstItem()+$loop->index}}</td>
                    <td>{{$w['name']}}</td>
                    <td>{{$w->user->name}}</td>
                    <td>{{$w['participant']}}</td>
                    <td>{{$w['duration']}}</td>
                    <td>{{$w['state']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$workData->links()}}
    @else
        <p>프로젝트 없음</p>
    @endif
    <a href="{{route('admin.works.create')}}">프로젝트 생성</a>
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