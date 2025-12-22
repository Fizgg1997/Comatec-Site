@extends('layouts.app-inner')

@section('content')
<div class="position-relative" style="margin-top: 80px;">
        <img src="{{asset('storage').'/'.  $data->image}}" width="100%" height="580px" class="banner-img" />

    </div>
    <div class="layout-padding mx-5 mt-3">
        <h1 class="b-extraBold font-size-2rem m-0" id="title">{{ $data->title }}</h1>
        <p class="b-regular font-size-2rem" id="created_at"> {{ \Carbon\Carbon::parse($data->date)->format('Y-m-d') }}</p>
    </div>
    <div class="layout-padding mx-5 mt-2">
        <p class="b-light font-size-20 text-dark" id="description">{!! $data->description !!}</p>
    </div>
