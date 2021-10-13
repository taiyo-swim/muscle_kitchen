@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="box-shadow: 5px 5px 3px black;">
                <div class="card-header" style="background-color: #bdb76b;">
                    <h5 style="font-family: serif;">パスワード（確認用）</h5>
                </div>

                <div class="card-body" style="background-color: #fafae0;">
                    <p style="font-family: serif;">続行するにはパスワードを入力してください</p>

                    <form method="POST" action="{{ route('password.confirm') }}">
                        @csrf

                        <div class="form-group row" style="font-family: serif;">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
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

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #808000; border: none;" onMouseOut="this.style.background='#808000'" onMouseOver="this.style.background='#556b2f'">
                                    {{ __('パスワード（確認用）') }}
                                </button>

                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}" style="font-family: serif; color: #808000;">
                                        {{ __('パスワードを忘れましたか？') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
