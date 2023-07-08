<form action="{{route('ed',[$post->id])}}" method="post">
    @method('put')
    @csrf
    <input type="text" name="title" value="{{$post->title}}"><br><br>
    <input type="text" name="body" value="{{$post->body}}"><br><br>
    <button type="submit">edite</button>



</form>
