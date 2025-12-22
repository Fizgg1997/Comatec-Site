@extends('layouts.app-inner')

@section('content')

<div style="margin-top: 130px;" class="layout-padding d-flex justify-content-center row">
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 ">
        <div class="d-flex flex-column mb-5">
            <div class="mb-3">
                <h2 class="b-semibold mb-3" style="font-size: 20pt">ADDRESS:</h2>
                <p class="b-semibold">COMATEC Saudi Arabia Limited </p>
                <p class="b-semibold mb-0">7973 prince Mohammed Ibn Abdulaziz St.  </p>
                <p class="b-semibold">Al Olaya.</p>
                <p class="b-semibold">Riyadh 12222</p>
            </div>
            <div class="mt-2">
                <h4 class="b-semibold  mb-3" style="font-size: 20pt">CONTACT:</h4>
                <p class="mb-1 b-semibold">Tel: +966 11 416 1901 </p>
                <p class="mb-1 b-semibold">Fax: +966 11 416 1908</p>
                <p class="mb-1 b-semibold">Email: <a href="mailto:info@comatec.com.sa"
                        style="color: #0d6efd !important; text-decoration: underline !important;">info@comatec.com.sa</a>
                </p>
            </div>
        </div>
        
    </div>
    <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6">
        <h2 class=" b-semibold  mb-5" style="font-size: 20pt">
            CONTACT US
        </h2>
        @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
        @endif
        <form method="post" action="{{url('store-contact-us')}}" class="mb-3">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control input-bck" id="name" name="name" placeholder="Name"
                    class="@error('name') is-invalid @enderror" value="{{ old('name') }}" require>
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror

            <div class="form-group">
                <input name="mobile_number" type="text" class="form-control input-bck" id="phone"
                    aria-describedby="phonehelp" placeholder="Tel/Mobile"
                    class="@error('mobile_number') is-invalid @enderror" value="{{ old('mobile_number') }}" require>
                <small id="phonehelp" class="form-text text-muted">Add your number with county
                    code.</small>
            </div>
            @error('mobile_number')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror


            <div class="form-group">
                <input name="email" type="email" class="form-control input-bck" id="exampleInputEmail1"
                    aria-describedby="emailHelp" placeholder="Email" class="@error('email') is-invalid @enderror"
                    value="{{ old('email') }}">
                
            </div>
            @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror



            <div class="form-group">
                <textarea name="note" class="form-control  input-bck" id="descs" rows="3"
                    class="@error('note') is-invalid @enderror">{{ old('note') }}</textarea>
            </div>
            @error('note')
            <div class="alert alert-danger">The Description field is required.</div>
            @enderror

            <button type="submit" class="btn btn-secondary">Submit</button>
        </form>
    </div>

</div>
<div class="d-flex flex-column align-items-center mb-4">
    <div class=" my-3">
        <h4 class="b-semibold" style="font-size: 20pt">Get Direction</h4>
    </div>

    <iframe
    src="https://www.google.com/maps/embed/v1/place?q=COMATEC+Saudi+Arabia+Limited,+Riyadh+Saudi+Arabia&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8"        width="100%" height="393" frameborder="0" style="border:0" allowfullscreen=""></iframe>
</div>
@endsection