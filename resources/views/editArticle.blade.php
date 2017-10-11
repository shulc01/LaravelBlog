@extends ('layouts.site')

@section('content')

    <h2>{{ isset($editArticle) ? "Edit Article" : "Create Article" }}</h2>


<form action = "{{route('SaveArticle')}}" method = "POST">

    <b>Title</b><br/>
        <input class = "input-mini " size = "100" type="text" name="title" value="{{ $editArticle->title ?? ''}}" />
    <br/><br/>
    <b>Description</b><br/>
        <input type="text" size = "100" name="description" value="{{ $editArticle->description ?? ''}}" />
    <br/><br/>
    <b>Text</b><br/>
        <textarea name = "text" rows = "4" cols = "100">{{ $editArticle->text ?? ''}}</textarea>
    <br/><br/>
    <b>Image</b><br/>
        <input type="text" size = "100" name="image" value="{{ $editArticle->image ?? ''}}"/> <br/><br/>

    <b>Category</b><br/>

    <select name = "category_id">

        @foreach ($allСategories as $category)

            <option value = "{{ $category->id_cat }}" @if (isset($editArticle) &&  $category->id_cat == $editArticle->category_id) selected @endif> {{ $category->category_name }} </option>

        @endforeach

    </select><br/><br/>

    <b>Tags</b><br/>

    <select name = "tags_id[]" multiple size = "10">

        @foreach ($allTags as $tag)

            <option value = "{{ $tag->id_tag }}"

                    @isset ($tagsIdArticle)

                        @foreach($tagsIdArticle as $tag1)

                            @if ($tag->id_tag == $tag1)

                                selected

                            @endif

                        @endforeach

                    @endisset>

                {{ $tag->tag_name }}

            </option>

        @endforeach

    </select>

    <br/><br/>
    <b>Add new tags (separated semicolon)</b><br/>
    <input class = "input-mini " size = "100" type="text" name="custom_tags" placeholder = "For example: sport;car;music;" value="{{ $tagsArticle ?? '' }}"/><br/><br/>

    <input type="hidden" name = "id" value = "{{ $editArticle->id ?? ''}}"/>

    <input type = "submit" value = "Save"/>

    {{ csrf_field() }}

</form>

@endsection