@extends('layouts.app-inner')
@section('content')

<div class="position-relative" style="margin-top: 80px;">
    <img src="{{asset('storage').'/'.  $data->inner_image}}" width="100%" height="580px" class="banner-img" />
    <div class="b-banner">
        <h1 class="text-light b-semibold font-size-4rem m-0" id="title">{{$data->title}}</h1>
    </div>
</div>
<div class="row align-items-center justify-content-center layout-padding mt-5">
    @foreach ($projects_details as $key => $project)
        <div class="card p-0 h-100 col-12 col-sm-6 col-md-4 col-lg-3 col-xl-3 m-2">
            <a href="{{ route('show.project_details', ['id' => $project['id']]) }}" class="h-100">
                <div class="position-relative">
                    <img class="card-img-top" src="{{asset('storage').'/'.  $project['image']}}" alt="Card image cap" height="170" width="100%" />
                    <div class="raduis-tr-10px position-abs-bottom-0 bck-white p-2 text-center">
                        <p class="mb-0 b-extraBold font-size-12 px-2">{{ \Carbon\Carbon::parse($project['project_date'])->format('m') }}</p>
                        <p class="mb-0 b-extraBold font-size-12 px-2">{{ \Carbon\Carbon::parse($project['project_date'])->format('y') }}</p>
                    </div>
                </div>
                <div class="card-body px-4 py-3 flex-grow-1 d-flex" style="height: calc(100% - 170px);">
                    <div class="mt-4">
                        <h5 class="b-extraBold font-size-20">
                            {{ $project['title'] }}
                        </h5>
                    </div>
                </div>
            </a>
        </div>
    @endforeach
</div>
@endsection