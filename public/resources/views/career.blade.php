@extends('layouts.app-inner')
@section('content')
<div style="margin-top: 130px;" class="layout-padding d-flex justify-content-center row">
    <div class="col-12">
        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <form method="post" action="{{route('apply-job')}}" class="mb-3" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="name" class="b-semibold">Name</label>
                <input type="text" class="form-control input-bck" id="name" name="name" placeholder="Enter your name"
                    class="@error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            </div>
            @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="phone" class="b-semibold">Phone Number</label>
                <input name="mobile_number" type="text" class="form-control input-bck" id="phone"
                    aria-describedby="phonehelp" placeholder="Tel/Mobile"
                    class="@error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number') }}" required>
                <small id="phonehelp" class="form-text text-muted">Add your number with county
                    code.</small>
            </div>
            @error('mobile_number')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="exampleInputEmail1" class="b-semibold">Email</label>
                <input name="email" type="email" class="form-control input-bck" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Email" class="@error('email') is-invalid @enderror"
                    value="{{ old('email') }}" required>
                <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
            </div>
            @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="descs" class="b-semibold">Message</label>
                <textarea name="message" class="form-control input-bck" id="descs" rows="3"
                    class="@error('message') is-invalid @enderror" required>{{ old('message') }}</textarea>
            </div>
            @error('message')
                <div class="alert alert-danger">The Description field is required.</div>
            @enderror
            <div class="form-group">
                <div class="mb-3">
                    <label for="formFile" class="form-label b-semibold">CV</label>
                    <input class="form-control input-bck" placeholder="upload your CV" name="file" type="file" id="formFile"
                    class="@error('file') is-invalid @enderror"
                    value="{{ old('file') }}" required>
                </div>
            </div>
            @error('file')
                <div class="alert alert-danger">The File field is required.</div>
            @enderror
            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>
</div>