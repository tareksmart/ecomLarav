

<h1>posts</h1>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>
<body>
<a href="{{route('create')}}">create</a><br><br>

<table class="table">
    <thead>
    <tr>
        <th scope="col">#</th>
        <th scope="col">title</th>
        <th scope="col">body</th>
        <th scope="col">func</th>

    </tr>
    </thead>
    <tbody>
    @foreach($posts as $post)
    <tr>
        <th scope="row">{{$post->id}}</th>
        <td>{{$post->title}}</td>
        <td>{{$post->body}}</td>
        <td>
{{--            <button  type="button" class="btn btn-primary" href="{{route('editePost',[$post->id])}}">Edite</button>--}}
{{--            <button type="button" href="{{url('posts/edite/1',$post->id)}}">edite--}}
{{--                </button>--}}
            <a class="btn btn-primary" href="{{route('posts.edite',$post->id)}}" role="combobox">edite</a>
        </td>
   <td>
    <a href="{{route('del',$post->id)}}" type="button" class="btn btn-warning" role="button">Delete</a>
       <button type="button" class="btn btn-danger">Danger</button>
   </td>
    </tr>
    @endforeach

    </tbody>
</table>



</body>
</html>
