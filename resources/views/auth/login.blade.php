@extends('layouts.app')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h1 class="h4 mb-3">Connexion</h1>
                    <form method="post" action="{{ route('login.store') }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{ old('email') }}" required>
                            @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Mot de passe</label>
                            <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" required>
                            @error('password')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                        <button class="btn btn-primary w-100" type="submit">Se connecter</button>
                        <p class="small text-muted mt-3 mb-0">Compte fondateur: anasettai@gmail.com / 123456</p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
