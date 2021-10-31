@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="box-shadow: 5px 5px 3px black;">
                <div class="card-header" style="background-color: #bdb76b;">
                    <h5 style="font-family: serif;"><i class="fas fa-user-alt"></i> ユーザー情報編集</h5>
                </div>
        
                <div class="card-body" style="background-color: #fafae0;">
                    <form action="/my_page" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="form-group row" style="font-family: serif;">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                <h5><i class="far fa-arrow-alt-circle-right"></i> ユーザーID</h5>
                            </label>
        
                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}">
        
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row" style="font-family: serif;">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                    <h5><i class="far fa-arrow-alt-circle-right"></i> メールアドレス</h5>
                            </label>
        
                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}">
        
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row" style="font-family: serif;">
                            <label for="email" class="col-md-4 col-form-label text-md-right">
                                    <h5><i class="far fa-arrow-alt-circle-right"></i> プロフィール画像</h5>
                            </label>
                            
                            <label id="image-file" for="image">
                                    ファイルを選択
                                    <input id="image" type="file" name="image" style="display: none;"/>
                            </label>
                            <span class="user_image_path" style="margin-left: 10px;">ファイルが選択されていません</span>
                        </div>
                        
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" style="background-color: #808000; border: none;" onMouseOut="this.style.background='#808000'" onMouseOver="this.style.background='#556b2f'">
                                    {{ __('変更する') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
        
        <script>
        window.addEventListener('DOMContentLoaded', function()   {{--ファイルパス表示用の処理--}}
        {
            $('input').on('change', function ()
            {
                var file = $(this).prop('files')[0];
                $('.user_image_path').text(file.name);
            });
        });
        </script>
        
        <style>
            #image-file {
                padding: 5px 10px;
                color: white;
                background-color: #384878;
                cursor: pointer;
                box-shadow: 3px 3px 3px black;
                cursor: pointer;
                margin-left: 20px;
            }
            
            #image-file:hover {
                box-shadow: 0 0 0;
                opacity: 0.7;
            }
        </style>
@endsection