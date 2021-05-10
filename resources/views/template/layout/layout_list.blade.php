@extends('layouts.app')

@section('content')
    @if ($layoutData)
    <form action="{{route('admin.layouts.index')}}" method="get" class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <select name="search_option" class="form-control">
                <option value="category">테마 분류</option>
                <option value="name">레이아웃명</option>
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
            <a href="{{route('admin.layouts.index')}}">전체</a>
        </div>

        <div class="col">
            <a href="{{route('admin.layouts.index', ['state' => 'normal'])}}">정상</a>
        </div>

        <div class="col">
            <a href="{{route('admin.layouts.index', ['state' => 'unprint'])}}">미출력</a>
        </div>

        <div class="col">
            <a href="{{route('admin.layouts.index', ['state' => 'stop'])}}">정지</a>
        </div>

        <div class="col">
            <a href="{{route('admin.layouts.index', ['state' => 'delete'])}}">삭제</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>번호</th>
                <th>레이아웃명</th>
                <th>테마 분류</th>
                <th>상태</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($layoutData as $l)
                <tr onclick="location.href='{{route('admin.layouts.show', ['lodx' => $l['lodx']])}}'">
                    <td>{{$layoutData->firstItem()+$loop->index}}</td>
                    <td>{{$l['name_ko']}}</td>
                    <td>{{$l['category']}}</td>
                    <td>{{$l['state']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$layoutData->links()}}
    @else
        <p>없음</p>
    @endif
    <a href="{{route('admin.layouts.create')}}">레이아웃 생성</a>
@endsection           <label for="">상단 레이아웃</label>
            <select name="layout_top" class="form-control">
                @foreach ($layoutTops as $layoutTop)
                    <option value="{{$layoutTop->lotdx}}">{{$layoutTop->lotdx}}</option>
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
                    <option value="{{$layoutNavi->londx}}">{{$layoutNavi->londx}}</option>
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
                    <option value="{{$layoutMiddle->lomdx}}">{{$layoutMiddle->lomdx}}</option>
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
                    <option value="{{$layoutBottom->lobdx}}">{{$layoutBottom->lobdx}}</option>
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
                    <option value="{{$layoutEtc->loedx}}">{{$layoutEtc->loedx}}</option>
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
                <option value="true">적용</option>
                <option value="false">미적용</option>
            </select>
            @error('default')
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
            <button type="submit" class="btn btn-lg btn-success">레이아웃 생성</button>
        </div>
    </form>
@endsection