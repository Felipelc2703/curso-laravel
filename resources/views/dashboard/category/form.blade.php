
@csrf

<label for="">Titulo</label>
<input class="form-control" type="text" name="title" id="" value="{{ old('title',$category->title) }}">

<label for="">Slug</label>
<input class="form-control" type="text" name="slug" id="" value="{{ old('slug',$category->slug) }}">


<button class="btn btn-success mt-3" type="submit">Enviar</button>