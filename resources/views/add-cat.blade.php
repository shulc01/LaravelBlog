@extends ('Layouts.site')

@section('content')

    <form action = "{{route('SaveCategory')}}" method = "POST">

        <b>Title</b><br/>
        <input class = "input-mini " size = "100" type="text" name="category_name" value="@if (isset($editArticle)) {{ $editArticle->title }} @endif" />
        <br/><br/>
        <b>Description</b><br/>
        <textarea name = "category_desc" rows = "4" cols = "100">@if (isset($editArticle)) {{ $editArticle->text }} @endif</textarea>
        <br/><br/>

        <input type="hidden" name = "id" value = "@if (isset($editArticle)) {{ $editArticle->id }} @endif"/>

        <input type = "submit" value = "Save"/>

        {{ csrf_field() }}

    </form>

@endsection