@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card" style="box-shadow: 5px 5px 3px black;">
                    <div class="card-header" style="background-color: #bdb76b;">
                        <h5 style="font-family: serif;"><i class="fas fa-user-alt"></i> ログイン</h5>
                    </div>
    
                    <div class="card-body" style="background-color: #fafae0;">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf
    
                            <div class="form-group row" style="font-family: serif;">
                                <label for="email" class="col-md-4 col-form-label text-md-right">
                                    <h5><i class="far fa-arrow-alt-circle-right"></i> メールアドレス</h5>
                                </label>
    
                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
    
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row" style="font-family: serif;">
                                <label for="password" class="col-md-4 col-form-label text-md-right">
                                    <h5><i class="far fa-arrow-alt-circle-right"></i> パスワード</h5>
                                </label>
    
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
    
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="form-group row" style="font-family: serif;">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
    
                                        <label class="form-check-label" for="remember">
                                            {{ __('ログイン情報を保存する') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
    
                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="background-color: #808000; border: none;" onMouseOut="this.style.background='#808000'" onMouseOver="this.style.background='#556b2f'">
                                        {{ __('ログイン') }}
                                    </button>
    
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}" style="font-family: serif; color: #808000;">
                                            {{ __('パスワードを忘れましたか?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </form>
                    </div>
                <a class="btn btn-block btn-social btn-google" href="/login/google" style="background-color: #f0f8ff;">
                    <i class="fas fa-angle-right"></i> 
                    <span style="font-weight: bold; color: #339af0;">G</span><span style="font-weight: bold; color: red;">o</span><span style="font-weight: bold; color: yellow;">o</span><span style="font-weight: bold; color: #339af0;">g</span><span style="font-weight: bold; color: green;">l</span><span style="font-weight: bold; color: red;">e</span><span style="font-family: serif;">アカウントでログイン</span>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
