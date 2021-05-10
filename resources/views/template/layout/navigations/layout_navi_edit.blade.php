@extends('layouts.app')

@section('content')
    <h2>레이아웃 상단 수정</h2>
    <form action="{{route('admin.layout-navigations.update' ,['londx' => $layoutData->londx])}}" method="post">
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
            <label for="">html</label>
            <textarea type="text" name="html" class="form-control @error('html') is-invalid @enderror" required>{{$layoutData->html}}</textarea>
            @error('html')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">css</label>
            <textarea type="text" name="css" class="form-control @error('css') is-invalid @enderror" required>{{$layoutData->css}}</textarea>
            @error('css')
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
            <button type="submit" class="btn btn-lg btn-success">레이아웃 상단 수정</button>
        </div>
    </form>
@endsection