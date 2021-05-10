@extends('layouts.app')

@section('content')
    <h2>레이아웃 상단 수정</h2>
    <form action="{{route('admin.packs.update' ,['pdx' => $packData->pdx])}}" method="post">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="">템플릿명(국문)</label>
            <input type="text" name="name_ko" class="form-control @error('name_ko') is-invalid @enderror" value="{{$packData->name_ko}}" required>
            @error('name_ko')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">템플릿명(영문)</label>
            <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{$packData->name_en}}" required>
            @error('name_en')name_en
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">국문 설명</label>
            <textarea name="explain_ko" class="form-control @error('explain_ko') is-invalid @enderror" required>{{$packData->explain_ko}}</textarea>
            @error('explain_ko')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">영문 설명</label>
            <textarea name="explain_en" class="form-control @error('explain_en') is-invalid @enderror" required>{{$packData->explain_en}}</textarea>
            @error('explain_en')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">기본 경로</label>
            <input type="text" name="default_path" class="form-control @error('default_path') is-invalid @enderror" value="{{$packData->default_path}}" required autocomplete="off">
            @error('default_path')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">코드명</label>
            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{$packData->code}}" required autocomplete="off">
            @error('code')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="">상태</label>
            <select name="state" class="form-control form-control-lg">
                <option value="10" @if($packData->state === 10) selected @endif>정상</option>
                <option value="9" @if($packData->state === 9) selected @endif>정지</option>
                <option value="0" @if($packData->state === 0) selected @endif>삭제</option>
            </select>
            @error('state')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-lg btn-success">기능 수정</button>
        </div>
    </form>
@endsection