@extends('layouts.app')

@section('content')
    @if ($layoutData)
        <div class="row">
            <div class="col-2">테마 분류</div>
            <div class="col-8">{{$layoutData->category}}</div>
        </div>

        <div class="row">
            <div class="col-2">레이아웃명(국문)</div>
            <div class="col-8">{{$layoutData->name_ko}}</div>
        </div>

        <div class="row">
            <div class="col-2">레이아웃명(영문)</div>
            <div class="col-8">{{$layoutData->name_en}}</div>
        </div>

        <div class="row">
            <div class="col-2">국문 설명</div>
            <div class="col-8">{{$layoutData->descript_ko}}</div>
        </div>

        <div class="row">
            <div class="col-2">영문 설명</div>
            <div class="col-8">{{$layoutData->descript_en}}</div>
        </div>

        <div class="row">
            <div class="col-2">상단 레이아웃 번호</div>
            <div class="col-8">{{$layoutData->lotdx}}</div>
        </div>

        <div class="row">
            <div class="col-2">메뉴 레이아웃 번호</div>
            <div class="col-8">{{$layoutData->londx}}</div>
        </div>

        <div class="row">
            <div class="col-2">중단 레이아웃 번호</div>
            <div class="col-8">{{$layoutData->lomdx}}</div>
        </div>

        <div class="row">
            <div class="col-2">하단 레이아웃 번호</div>
            <div class="col-8">{{$layoutData->lobdx}}</div>
        </div>

        <div class="row">
            <div class="col-2">기타 레이아웃 번호</div>
            <div class="col-8">{{$layoutData->loedx}}</div>
        </div>

        <div class="row">
            <div class="col-2">기본 레이아웃</div>
            <div class="col-8">{{$layoutData->default}}</div>
        </div>

        <div class="row">
            <div class="col-2">상태</div>
            <div class="col-8">{{$layoutData->state}}</div>
        </div>
    @else
        <p>없음</p>
    @endif
    <a href="{{route('admin.layouts.edit', ['lodx' => $layoutData->lodx])}}">수정</a>
    <form action="{{route('admin.layouts.destroy', ['lodx' => $layoutData->lodx])}}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="삭제">
    </form>
@endsection