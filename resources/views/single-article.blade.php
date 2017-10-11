@extends ('layouts.front')

@section('content2')

        <h3 align = "right">Category: <a href = "{{ route('ShowArticlesFromCategory', $category->id_cat) }}">{{  $category->category_name }}</a></h3>
        <h2 align = "center"><em>{{  $article->title }}</em></h2>
        <h4 align = "center">{{ $article->description }}</h4>
        <p align = "center"><img src = {{ $article->image  }} /></p>
        <p align = "center">{{ $article->text }}</p>

        @isset ($tags)

            @foreach($tags as $tag)

                <a href = "{{ route('ShowArticleWithTags', $tag->id_tag) }}">#{{ $tag->tag_name }}</a>

            @endforeach

        @endisset

@endsection