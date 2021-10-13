@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="box-shadow: 5px 5px 3px black;">
                <div class="card-header" style="background-color: #bdb76b;">
                    <h5 style="font-family: serif;">パスワード再設定</h5>
                </div>

                <div class="card-body" style="background-color: #fafae0;">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row" style="font-family: serif;">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                <h5><i class="far fa-arrow-alt-circle-right"></i> メールアドレス</h5>
                            </label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" style="font-family: serif;">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                <h5><i class="far fa-arrow-alt-circle-right"></i> パスワード</h5>
                            </label>
                            
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row" style="font-family: serif;">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                <h5><i class="far fa-arrow-alt-circle-right"></i> パスワード（確認のため再度入力してください）</h5>
                            </label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #808000; border: none;" onMouseOut="this.style.background='#808000'" onMouseOver="this.style.background='#556b2f'">
                                    {{ __('パスワードをリセットする') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
