@extends ('Layouts.front')

@section('content2')

        <h3 align = "right">Category: <a href = "{{ route('SingleCat', $article->category_id) }}">{{  $article->category_name }}</a></h3>
        <em><h2 align = "center">{{  $article->title }}</h2></em>
        <h4 align = "center">{{ $article->description }}</h4>
        <p align = "center"><img src = {{ $article->image  }} /></p>
        <p align = "center">{{ $article->text }}</p>

        @if ($article->tags)

            @foreach($article->tags as $tags)

                <a href = "{{ route('showTags', $tags->id_tag) }}">#{{ $tags->tag_name }}</a>

            @endforeach

        @endif

@endsection