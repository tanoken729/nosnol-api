@extends('layouts.app')

@section('content')
    <div class="card-header">ファイルアップロードテスト</div>
        <form action="/api/musicFileUpload" method="post" enctype="multipart/form-data">
        {{ Form::open(array('url' => '/api/musicFileUpload' , 'files'=> true)) }}
        {{ Form::file('music_file') }}
        <!-- {{ Form::submit(' アップロード ')}} -->
        {{ Form::open(array('url' => '/api/musicFileUpload' , 'files'=> true)) }}
        {{ Form::file('cover_image') }}
        <input type="text" name="title">
        <input type="text" name="genre">
        <input type="text" name="emotions">
        <input type="text" name="user_id">
        {{ Form::submit(' アップロード ')}}
    </form>
@endsection
