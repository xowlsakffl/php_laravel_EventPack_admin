@extends('layouts.app')

@section('content')
<div class="container-sm">
    <div class="col-md-6 col-xxl-3 mb-3 pr-md-2">
        <div class="card h-md-100">
            <p>전체 가입자 {{$data['userAll']}}명</p>
            <p>오늘 {{$data['userToday']}}명</p>
        </div>
    </div>

    <div class="col-md-6 col-xxl-3 mb-3 pl-md-2 pr-xxl-2">
        <div class="card h-md-100">
            <p>전체 프로젝트 {{$data['workAll']}}건</p>
            <p>오늘 {{$data['workToday']}}건</p>
        </div>
    </div>

    <div class="col-md-6 col-xxl-3 mb-3 pl-md-2 pr-xxl-2">
        <div class="card h-md-100">
            <p>전체 파일 개</p>
            <p>오늘 개</p>
        </div> 
    </div>
        
    <div class="col-md-6 col-xxl-3 mb-3 pr-md-2">
        <div class="card h-md-100">
            <p>평균 월 결제 건</p>
            <p>금월 건</p>
        </div>
    </div>
</div>
@endsection
