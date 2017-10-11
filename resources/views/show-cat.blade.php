@extends ('layouts.front')

@section('content2')

    <div class = "cat">

        @foreach ($categories as $category)

            <a href = {{ route('ShowArticlesFromCategory', $category->id_cat) }}><h2 align = "center">{{ $category->category_name  }}</h2></a>

            @if (isset(Auth::user()->name) && Auth::user()->name == 'admin')

                <form action = "{{ route('DeleteCategory', $category->id_cat) }}" method = "POST"
                      onsubmit = "return confirm('Are you sure want to delete category {{ strtoupper($category->category_name) }}?') ? true : false;">

                <input type="submit" value="Delete category"/>

                {{ method_field('DELETE') }}
                {{ csrf_field() }}

                </form>

            @endif

            {{ $category->category_desc }}

        @endforeach

    </div>

    @endsection