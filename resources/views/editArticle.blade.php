@extends ('Layouts.site')

@section('content')

@if (isset($editArticle)) <h2>Edit article</h2>

@else <h2>Add article</h2>

@endif

{{--{{ dump($editArticle) }}--}}
{{--{{ dd($editArticle) }}--}}

<form action = "{{route('SaveArticle')}}" method = "POST">

    <b>Title</b><br/>
        <input class = "input-mini " size = "100" type="text" name="title" value="@if (isset($editArticle)) {{ $editArticle->title }} @endif" />
    <br/><br/>
    <b>Description</b><br/>
        <input type="text" size = "100" name="description" value="@if (isset($editArticle)) {{ $editArticle->description }} @endif" />
    <br/><br/>
    <b>Text</b><br/>
        <textarea name = "text" rows = "4" cols = "100">@if (isset($editArticle)) {{ $editArticle->text }} @endif</textarea>
    <br/><br/>
    <b>Image</b><br/>
        <input type="text" size = "100" name="image" value="@if (isset($editArticle)) {{ $editArticle->image }} @endif"/> <br/><br/>

    <b>Category</b><br/>

    <select name = "category_id">

            @foreach ($allcat as $cat)

                    <option value = "{{ $cat->id_cat }}" @if (isset($editArticle) &&  $cat->id_cat == $editArticle->category_id) selected @endif> {{ $cat->category_name }} </option>

            @endforeach

    </select><br/><br/>

    <b>Tags</b><br/>

    <select name = "tags_id[]" multiple size = "10">

        @foreach ($tags as $tag)

            <option value = "{{ $tag->id_tag }}"

                    @if (isset($editArticle->tags_id))

                        @foreach($editArticle->tags_id as $tag1)

                            @if ($tag->id_tag == $tag1)

                                selected

                            @endif

                        @endforeach

                    @endif>

                {{ $tag->tag_name }} </option>

        @endforeach

    </select>

    <br/><br/>
    <b>Add new tags (separated semicolon)</b><br/>
    <input class = "input-mini " size = "100" type="text" name="custom_tags" placeholder = "For example: sport;car;music;" value="@if (isset($editArticle->tags_id)) {{ $editArticle->tags_name }} @endif" /><br/><br/>

    <input type="hidden" name = "id" value = "@if (isset($editArticle)) {{ $editArticle->id }} @endif"/>

    <input type = "submit" value = "Save"/>

    {{ csrf_field() }}

</form>

@endsection