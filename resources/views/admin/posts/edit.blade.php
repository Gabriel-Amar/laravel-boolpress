@extends('layouts.admin')

@section('content')
<div class="container">


    <form action="{{route('admin.posts.update', $post->id)}}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" value="{{old('title', $post->title)}}" placeholder="Inserisci titolo">
        </div>
        <div class="mb-3">
          <label for="content" class="form-label">Content</label>
          <textarea name="content" class="form-control" id="content"  cols="30" rows="10" placeholder="Inserisci il contenuto">{{old('content', $post->content)}}</textarea>
        </div>
        <div class="mb-3 form-check">
          <input type="checkbox" class="form-check-input" {{old('published', $post->published) ? 'checked' : ''}} id="published" name="published">
          <label class="form-check-label" for="published" >Pubblicato</label>
        </div>
        <div class="mb-3">
          <label for="category" class="form-label">category</label>
          <select name="category_id" id="category" class="form-control">
              <option value="">Select category</option>
            @foreach ($categories as $category)
              <option value="{{$category->id}}" {{$category->id == old('category_id', $post->category_id) ? 'selected' : ''}}>{{$category->name}}</option>
            @endforeach
          </select>
          @error('category_id')
            <div class="alert alert-danger">{{$message}}</div>
          @enderror
        </div>
        <div class="form-group">
          <img id="uploadPreview" width="100" src="https://via.placeholder.com/300x200">
          <label for="image">Aggiungi immagine</label>
          <input type="file" id="image" name="image" onchange="boolpress.previewImage();">
          
    </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
      <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript">
      </script>
      <script type="text/javascript">
        bkLib.onDomLoaded(nicEditors.allTextAreas);
      </script>
    
  </div>
@endsection