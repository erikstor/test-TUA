{{--<form action="{{ route('login') }}" method="post">--}}
{{--    <label for="email">--}}
{{--        <input type="email" name="email" id="email">--}}
{{--        @error('email')--}}
{{--        <div> {{ $message }}</div> @enderror--}}
{{--    </label>--}}
{{--    <label for="password">--}}
{{--        <input type="password" name="password" id="password">--}}
{{--        @error('password')--}}

{{--    </label>--}}
{{--    @csrf()--}}
{{--    <button type="submit">Entrar</button>--}}
{{--</form>--}}

@extends('partials.layout')

@section('content')

    <div class="vh-100 d-flex flex-column justify-content-center align-items-center">
        <div class="col-6">
            <main class="form-signin">
                <form action="{{ route('login') }}" method="post">
                    <h1 class="h3 mb-3 fw-normal">Iniciar sesión</h1>

                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="floatingInput" name="email"
                               placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                        @error('email')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="floatingPassword" name="password"
                               placeholder="Password">
                        <label for="floatingPassword">Password</label>
                        @error('password')
                        <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>
                    @csrf
                    <button class="w-100 btn btn-lg btn-primary" type="submit">Entrar</button>
                </form>
            </main>

        </div>
    </div>

@endsection
