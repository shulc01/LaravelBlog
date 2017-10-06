@extends ('Layouts.front')

@section('content2')

    {{--{{ dd($tag_name) }}--}}

<h1 class = "cat_title"> {{  strtoupper($articles[0]['category_name']) . ' NEWS' }}</h1>

    @if(isset($tag_name))

        <h4 align = "right">Тэг #{{ $tag_name->tag_name  }}</h4>

    @endif

    @foreach ($articles as $article)

    <a href = {{ route('showArticle', $article->id) }}><h2 align = "center">{{ $article->title  }}</h2></a>
    <h4 align = "center"> {{ $article->description }} </h4>
    {{--<img src = {{ $article->image  }} />--}}
    <h5 align = "right">{{ $article->updated_at }}</h5>

    <hr/>

    @endforeach

@endsection