@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('ログイン成功') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('ログインに成功しました！') }}
                    <a href="{{ url('/order') }}" class="btn btn-light btn-sm">予約一覧を表示する</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
