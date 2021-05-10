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
            <div class="col-2">코드명</div>
            <div class="col-8">{{$layoutData->code}}</div>
        </div>

        <div class="row">
            <div class="col-2">화면출력 방식</div>
            <div class="col-8">{{$layoutData->display_type}}</div>
        </div>

        <div class="row">
            <div class="col-2">화면출력 시간</div>
            <div class="col-8">{{$layoutData->display_duration}}</div>
        </div>

        <div class="row">
            <div class="col-2">기본 폰트</div>
            <div class="col-8">{{$layoutData->font_default}}</div>
        </div>

        <div class="row">
            <div class="col-2">기본 폰트 출처</div>
            <div class="col-8">{{$layoutData->font_resource}}</div>
        </div>

        <div class="row">
            <div class="col-2">상태</div>
            <div class="col-8">{{$layoutData->state}}</div>
        </div>
    @else
        <p>없음</p>
    @endif
    <a href="{{route('admin.layout-etcs.edit', ['loedx' => $layoutData->loedx])}}">수정</a>
    <form action="{{route('admin.layout-etcs.destroy', ['loedx' => $layoutData->loedx])}}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="삭제">
    </form>
@endsection