@extends ('Layouts.front')

@section('content2')

    <script>

        function confirmDeleteCat(id){

            var x = confirm ("Are you sure want to delete this category?");

            if (x) return window.location.href='category/delete/' + id;

            else false;

        }

    </script>

    <div class = "cat">

        @foreach ($categories as $category)

            <a href = {{ route('ShowCategory', $category->id_cat) }}><h2 align = "center">{{ $category->category_name  }}</h2></a>

                @if (isset(Auth::user()->name) && Auth::user()->name == 'admin')

                    <input type="button" value="Delete category" onclick = " return confirmDeleteCat({{ $category->id_cat}})"/>

                @endif

            {{ $category->category_desc }}

        @endforeach

    </div>

    @endsection