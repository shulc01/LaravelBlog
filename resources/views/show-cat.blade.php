@extends ('Layouts.front')

@section('content2')

    <div class = "cat">

        @foreach ($categories as $category)

            <a href = {{ route('SingleCat', $category->id_cat) }}><h2 align = "center">{{ $category->category_name  }}</h2></a>
            <img src = {{ $category->image  }} />
            {{ $category->category_desc }}

        @endforeach

    </div>

    @endsection