<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>Laravel</title>
        <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    </head>
    <body>
        <div class="file-upload">
            <input type="file" id="file-upload_input">
            <button id="file-upload_btn">Upload</button>
            <div id="file-upload_progress">
                <div id="progress-bar">0%</div>
            </div>
        </div>
    </body>

    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script src="{{asset('/js/file-upload.js')}}"></script>
</html>

