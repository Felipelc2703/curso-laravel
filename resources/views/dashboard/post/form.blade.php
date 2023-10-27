
@csrf

<label for="">Titulo</label>
<input class="form-control" type="text" name="title" id="" value="{{ old('title',$post->title) }}">

<label for="">Slug</label>
<input class="form-control" type="text" name="slug" id="" value="{{ old('slug',$post->slug) }}">

<label for="">Categoria</label>
<select class="form-control" name="category_id" >
    <option value=""></option>
    @foreach ($categories as $titulo => $id)
        <option {{ old('category_id',$post->category_id) == $id ? 'selected' : '' }} value="{{ $id}}">{{ $titulo}}</option>
    @endforeach
    
</select>

<label for="">Posteado</label>
<select class="form-control" name="posted" id="">
    <option value=""></option>
    <option {{ old('posted',$post->posted) == 'yes' ? 'selected' : '' }} value="yes">Si</option>
    <option {{ old('posted',$post->posted) == 'not' ? 'selected' : '' }} value="not">No</option>
</select>

<label for="">Contenido</label>
<textarea class="form-control" name="content" id="" cols="30" rows="10" > {{ old('content',$post->content) }} </textarea>

<label for="">Descripcion</label>
<textarea class="form-control" name="description" id="" cols="30" rows="10" > {{ old('description',$post->description) }} </textarea>

@if (isset($task) && $task == 'edit')
    <label for="">Image</label>    
    <input type="file" name="image">
@endif


<button class="btn btn-success mt-3" type="submit">Enviar</button>