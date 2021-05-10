@extends('layouts.app')

@section('content')
    @if ($packData)
        <div class="row">
            <div class="col-2">템플릿명(국문)</div>
            <div class="col-8">{{$packData->name_ko}}</div>
        </div>

        <div class="row">
            <div class="col-2">템플릿명(영문)</div>
            <div class="col-8">{{$packData->name_en}}</div>
        </div>

        <div class="row">
            <div class="col-2">국문 설명</div>
            <div class="col-8">{{$packData->explain_ko}}</div>
        </div>

        <div class="row">
            <div class="col-2">영문 설명</div>
            <div class="col-8">{{$packData->explain_en}}</div>
        </div>

        <div class="row">
            <div class="col-2">코드명</div>
            <div class="col-8">{{$packData->code}}</div>
        </div>

        <div class="row">
            <div class="col-2">기본 경로</div>
            <div class="col-8">{{$packData->default_path}}</div>
        </div>

        <div class="row">
            <div class="col-2">상태</div>
            <div class="col-8">{{$packData->state}}</div>
        </div>
    @else
        <p>없음</p>
    @endif
    <a href="{{route('admin.packs.edit', ['pdx' => $packData->pdx])}}">수정</a>
    <form action="{{route('admin.packs.destroy', ['pdx' => $packData->pdx])}}" method="post">
        @csrf
        @method('DELETE')
        <input type="submit" class="btn btn-danger" value="삭제">
    </form>
@endsection