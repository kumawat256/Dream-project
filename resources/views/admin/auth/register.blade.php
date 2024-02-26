
@extends('layout.main');
@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
<body class="img js-fullheight" style="background-image: url({{url('images/bg.jpg')}}); height:100%;">
    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 text-center mb-5">
                    <h2 class="heading-section">Welcome to Register</h2>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">Don't Have an account?</h3>
                        <form action="{{url('admin/register')}}" method="POST" class="signin-form">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Name" name="name"/>
                                @error('name')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="Email" name="email"/>
                                @error('email')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="form-group">
                                <input type="password" class="form-control" placeholder="Password" name="password"/>
                                @error('password')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <input type="text" class="form-control" placeholder="State" name="state"/>
                                @error('state')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                           
                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Sign Up</button>
                            </div>
                           
                        </form>
                        <p class="w-100 text-center"><a href="{{url('admin/login')}}" class="text-white">&mdash; Already an account &mdash;</a></p>
                        <p class="w-100 text-center">&mdash; Or Sign In With &mdash;</p>

                        <div class="social d-flex text-center">
                            <a href="#" class="px-2 py-2 mr-md-1 rounded"><span class="ion-logo-facebook mr-2"></span> Facebook</a>
                            <a href="#" class="px-2 py-2 ml-md-1 rounded"><span class="ion-logo-twitter mr-2"></span> Twitter</a>
                        </div>

                        <p class="w-100 text-center mt-4">Note &mdash; Password will be send on registerd email.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

@endsection

