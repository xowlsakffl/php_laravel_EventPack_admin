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
            <div class="col-2">html</div>
            <div class="col-8">{{$layoutData->html}}</div>
        </div>

        <div class="row">
            <div class="col-2">css</div>
            <div class="col-8">{{$layoutData->css}}</div>
        </div>

        <div class="row">
            <div class="col-2">상태</div>
            <div class="col-8">{{$layoutData->state}}</div>
        </div>
    @else
        <p>없음</p>
    @endif
    <a href="{{route('admin.layout-middles.edit', ['lomdx' => $layoutData->lomdx])}}">수정</a>
    <form action="{{route('admin.layout-middles.destroy', ['lomdx' => $layoutData->lomdx])}}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="삭제">
    </form>
@endsection