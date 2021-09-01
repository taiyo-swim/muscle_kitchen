@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('メールアドレス認証を行ってください') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('ユーザー登録の確認メールを送信しました。') }}
                        </div>
                    @endif

                    {{ __('メールに記載されているリンクをクリックして、登録手続きを完了してください。') }}
                    {{ __('メールが届かない場合、') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('こちらをクリックして再送信してください。') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
