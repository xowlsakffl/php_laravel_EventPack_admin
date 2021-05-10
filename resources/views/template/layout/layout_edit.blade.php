@extends('layouts.app')

@section('content')
    <h2>레이아웃 상단 수정</h2>
    <form action="{{route('admin.layouts.update' ,['lodx' => $layoutData->lodx])}}" method="post">
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
            <label for="">국문 설명</label>
            <textarea name="descript_ko" class="form-control @error('descript_ko') is-invalid @enderror" required>{{$layoutData->descript_ko}}</textarea>
            @error('descript_ko')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">영문 설명</label>
            <textarea name="descript_en" class="form-control @error('descript_en') is-invalid @enderror" required>{{$layoutData->descript_en}}</textarea>
            @error('descript_en')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">상단 레이아웃</label>
            <select name="layout_top" class="form-control">
                @foreach ($layoutTops as $layoutTop)
                    <option value="{{$layoutTop->lotdx}}" @if ($layoutTop->lotdx == $layoutData->lotdx)
                        selected
                    @endif>{{$layoutTop->lotdx}}</option>
                @endforeach
            </select>
            @error('layout_top')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">메뉴 레이아웃</label>
            <select name="layout_navi" class="form-control">
                @foreach ($layoutNavis as $layoutNavi)
                    <option value="{{$layoutNavi->londx}}" @if ($layoutNavi->londx == $layoutData->londx)
                        selected
                    @endif>{{$layoutNavi->londx}}</option>
                @endforeach
            </select>
            @error('layout_navi')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">중단 레이아웃</label>
            <select name="layout_middle" class="form-control">
                @foreach ($layoutMiddles as $layoutMiddle)
                    <option value="{{$layoutMiddle->lomdx}}" @if ($layoutMiddle->lomdx == $layoutData->lomdx)
                        selected
                    @endif>{{$layoutMiddle->lomdx}}</option>
                @endforeach
            </select>
            @error('layout_middle')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">하단 레이아웃</label>
            <select name="layout_bottom" class="form-control">
                @foreach ($layoutBottoms as $layoutBottom)
                    <option value="{{$layoutBottom->lobdx}}" @if ($layoutBottom->lobdx == $layoutData->lobdx)
                        selected
                    @endif>{{$layoutBottom->lobdx}}</option>
                @endforeach
            </select>
            @error('layout_bottom')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">기타 레이아웃</label>
            <select name="layout_etc" class="form-control">
                @foreach ($layoutEtcs as $layoutEtc)
                    <option value="{{$layoutEtc->loedx}}" @if ($layoutEtc->loedx == $layoutData->loedx)
                        selected
                    @endif>{{$layoutEtc->loedx}}</option>
                @endforeach
            </select>
            @error('layout_etc')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">기본 레이아웃</label>
            <select name="default" class="form-control">
                <option value="true" @if($layoutData->default === true) selected @endif>적용</option>
                <option value="false" @if($layoutData->default === false) selected @endif>미적용</option>
            </select>
            @error('default')
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
            <button type="submit" class="btn btn-lg btn-success">하단 레이아웃 수정</button>
        </div>
    </form>
@endsection