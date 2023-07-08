<form action="{{route('post.insert')}}" method="post">
    @csrf
    <input type="text" name="title" placeholder="enter post title" id=""><br><br>
    <input type="text" name="body" placeholder="enter post body" id=""><br><br>
    <button type="submit">insert</button>



</form>
