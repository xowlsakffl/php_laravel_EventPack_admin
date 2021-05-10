@extends('layouts.app')

@section('content')
    <h2>레이아웃 메뉴 생성</h2>
    <form action="{{route('admin.layout-navigations.store')}}" method="post">
        @csrf
        <div class="form-group">
            <label for="">테마 분류</label>
            <input type="text" name="category" id="category" class="form-control @error('category') is-invalid @enderror" value="{{old('category')}}" required autocomplete="off">
            @error('category')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">레이아웃명(국문)</label>
            <input type="text" name="name_ko" class="form-control @error('name_ko') is-invalid @enderror" value="{{old('name_ko')}}" required>
            @error('name_ko')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">레이아웃명(영문)</label>
            <input type="text" name="name_en" class="form-control @error('name_en') is-invalid @enderror" value="{{old('name_en')}}" required>
            @error('name_en')name_en
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">코드명</label>
            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{old('code')}}" required>
            @error('code')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">html</label>
            <textarea type="text" name="html" class="form-control @error('html') is-invalid @enderror" value="{{old('html')}}" required></textarea>
            @error('html')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">css</label>
            <textarea type="text" name="css" class="form-control @error('css') is-invalid @enderror" value="{{old('css')}}" required></textarea>
            @error('css')
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
            <button type="submit" class="btn btn-lg btn-success">레이아웃 메뉴 생성</button>
        </div>
    </form>
@endsection