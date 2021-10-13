@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="box-shadow: 5px 5px 3px black;">
                <div class="card-header" style="background-color: #bdb76b;">
                    <h5 style="font-family: serif;">メールアドレス認証を行ってください</h5>
                </div>

                <div class="card-body" style="background-color: #fafae0;">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('ユーザー登録の確認メールを送信しました。') }}
                        </div>
                    @endif

                    <p style="font-family: serif;">メールに記載されているリンクをクリックして、登録手続きを完了してください。</p>
                    <p style="font-family: serif;">メールが届かない場合、</p>
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline" style="background-color: #808000; border: none;" onMouseOut="this.style.background='#808000'" onMouseOver="this.style.background='#556b2f'">{{ __('こちらをクリックして再送信してください。') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
