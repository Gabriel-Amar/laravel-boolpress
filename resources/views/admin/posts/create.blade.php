@extends('layouts.admin')

@section('content')
<div class="container">
  <form action="{{route('admin.posts.store')}}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" placeholder="Inserisci titolo">
      </div>
      <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea name="content" class="form-control" id="content"  cols="30" rows="10" placeholder="Inserisci il contenuto">{{old('content')}}</textarea>
      </div>
      <div class="mb-3 form-check">
        <input type="checkbox" class="form-check-input" {{old('published') ? 'checked' : ''}} id="published" name="published">
        <label class="form-check-label" for="published" >Pubblicato</label>
      </div>
      <div class="form-group">
        <img id="uploadPreview" width="100" src="https://via.placeholder.com/300x200">
        <label for="image">Aggiungi immagine</label>
        <input type="file" id="image" name="image" onchange="boolpress.previewImage();">
        @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror

  </div>
      <div class="mb-3">
        <label for="category" class="form-label">category</label>
        <select name="category_id" id="category" class="form-control">
            <option disabled selected value value="">Select category</option>
          @foreach ($categories as $category)
            <option value="{{$category->id}}">{{$category->name}}</option>
          @endforeach
        </select>
      </div>
      <div class="mb-3">
        <div class="form-group">
          <h5>Tags</h5>
          @foreach ($tags as $tag)
          <div class="form-check-inline">
            <input type="checkbox" class="form-check-input" {{in_array($tag->id, old("tags", [])) ? 'checked' : ''}} id="{{$tag->slug}}" name="tags[]" value="{{$tag->id}}">
        <label class="form-check-label" for="{{$tag->slug}}">{{$tag->name}}</label>
          </div>
          @endforeach
        </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
    <script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript">
    </script>
    <script type="text/javascript">
      bkLib.onDomLoaded(nicEditors.allTextAreas);
    </script>
  
</div>
@endsection