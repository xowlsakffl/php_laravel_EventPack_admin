@extends('layouts.app')

@section('content')
    @if ($packData)
    <form action="{{route('admin.packs.index')}}" method="get" class="form-inline">
        <div class="form-group mx-sm-3 mb-2">
            <select name="search_option" class="form-control">
                <option value="code">코드명</option>
                <option value="name">템플릿명</option>
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
            <a href="{{route('admin.packs.index')}}">전체</a>
        </div>

        <div class="col">
            <a href="{{route('admin.packs.index', ['state' => 'normal'])}}">정상</a>
        </div>

        <div class="col">
            <a href="{{route('admin.packs.index', ['state' => 'stop'])}}">정지</a>
        </div>

        <div class="col">
            <a href="{{route('admin.packs.index', ['state' => 'delete'])}}">삭제</a>
        </div>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>번호</th>
                <th>코드명</th>
                <th>템플릿명</th>
                <th>상태</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($packData as $p)
                <tr onclick="location.href='{{route('admin.packs.show', ['pdx' => $p['pdx']])}}'">
                    <td>{{$packData->firstItem()+$loop->index}}</td>
                    <td>{{$p['code']}}</td>
                    <td>{{$p['name_ko']}}</td>
                    <td>{{$p['state']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    {{$packData->links()}}
    @else
        <p>없음</p>
    @endif
    <a href="{{route('admin.packs.create')}}">기능 생성</a>
@endsection       <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>

        <div class="form-group">
            <label for="">코드명</label>
            <input type="text" name="code" class="form-control @error('code') is-invalid @enderror" value="{{old('code')}}" required autocomplete="off">
            @error('code')
                <div class="invalid-feedback">
                    {{$message}}
                </div>
            @enderror
        </div>
        
        <div class="form-group">
            <label for="">상태</label>
            <select name="state" class="form-control lg">
                <option value="10">정상</option>
                <option value="9">정지</option>
                <option value="0">삭제</option>
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