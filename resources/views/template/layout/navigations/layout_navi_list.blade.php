@extends('layouts.app')

@section('content')
    @if ($layoutData)
    <form action="{{route('admin.layout-navigations.index')}}" method="get" class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <select name="search_option" class="form-control">
                <option value="category">테마 분류</option>
                <option value="name">레이아웃명</option>
                <option value="code">코드명</option>
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
            <a href="{{route('admin.layout-navigations.index')}}">전체</a>
        </div>

        <div class="col">
            <a href="{{route('admin.layout-navigations.index', ['state' => 'normal'])}}">정상</a>
        </div>

        <div class="col">
            <a href="{{route('admin.layout-navigations.index', ['state' => 'unprint'])}}">미출력</a>
        </div>

        <div class="col">
            <a href="{{route('admin.layout-navigations.index', ['state' => 'stop'])}}">정지</a>
        </div>

        <div class="col">
            <a href="{{route('admin.layout-navigations.index', ['state' => 'delete'])}}">삭제</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>번호</th>
                <th>레이아웃명</th>
                <th>테마 분류</th>
                <th>코드</th>
                <th>상태</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($layoutData as $l)
                <tr onclick="location.href='{{route('admin.layout-navigations.show', ['londx' => $l['londx']])}}'">
                    <td>{{$layoutData->firstItem()+$loop->index}}</td>
                    <td>{{$l['name_ko']}}</td>
                    <td>{{$l['category']}}</td>
                    <td>{{$l['code']}}</td>
                    <td>{{$l['state']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$layoutData->links()}}
    @else
        <p>없음</p>
    @endif
    <a href="{{route('admin.layout-navigations.create')}}">레이아웃 메뉴 생성</a>
@endsection