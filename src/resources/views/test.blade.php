@extends('layouts.app')

@section('content')
    <div class="card-header">ファイルアップロードテスト</div>
    <!-- <form action="/api/musicFileUpload" method="post" enctype="multipart/form-data"> -->
    {{ Form::open(array('url' => '/api/musicFileUpload' , 'files'=> true)) }}
    {{ Form::file('image') }}
    {{ Form::submit(' アップロード ')}}
    </form>
@endsection
