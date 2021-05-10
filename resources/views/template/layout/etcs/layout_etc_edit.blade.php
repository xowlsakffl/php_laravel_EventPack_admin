@extends('layouts.app')

@section('content')
    <h2>기타 레이아웃 수정</h2>
    <form action="{{route('admin.layout-etcs.update' ,['loedx' => $layoutData->loedx])}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="">테마 분류</label>
            <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{$layoutData->category}}" required autocomplete="off">
            @error('category')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">레이아웃명(국문)</label>
            <input type="text" name="name_ko" class="form-control @error('name_ko') is-invalid @enderror" value="{{$layoutData->name_ko}}" required>
            @error('name_ko')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">레이아웃명(영문)</label>
            <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{$layoutData->name_en}}" required>
            @error('name_en')name_en
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">코드명</label>
            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{$layoutData->code}}" required>
            @error('code')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">화면출력 방식</label>
            <select name="display_type" class="form-control">
                <option value="direct" @if($layoutData->display_type === "display_type") selected @endif>바로 출력</option>
                <option value="fadeIn" @if($layoutData->display_type === "fadeIn") selected @endif>페이드인</option>
                <option value="slideDown" @if($layoutData->display_type === "slideDown") selected @endif>슬라이드</option>
            </select>
            @error('display_type')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">화면출력 시간</label>
            <input type="text" name="display_duration" class="form-control @error('display_duration') is-invalid @enderror" value="{{$layoutData->display_duration}}" required>
            @error('display_duration')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">기본 폰트</label>
            <input type="text" name="font_default" class="form-control @error('font_default') is-invalid @enderror" value="{{$layoutData->font_default}}" required>
            @error('font_default')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">기본 폰트 출처</label>
            <input type="text" name="font_resource" class="form-control @error('font_resource') is-invalid @enderror" value="{{$layoutData->font_resource}}" required>
            @error('font_resource')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="">상태</label>
            <select name="state" class="form-control form-control-lg">
                <option value="10" @if($layoutData->state === 10) selected @endif>정상</option>
                <option value="9" @if($layoutData->state === 9) selected @endif>미출력</option>
                <option value="8" @if($layoutData->state === 8) selected @endif>정지</option>
                <option value="0" @if($layoutData->state === 0) selected @endif>삭제</option>
            </select>
            @error('state')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">기타 레이아웃 수정</button>
        </div>
    </form>
@endsection