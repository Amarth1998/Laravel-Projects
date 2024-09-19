<h1>list of all images</h1>
@foreach($imagedata as $img)
<img src="{{url('storage/'.$img->path)}}"  style="width:200px;margin:10px">
@endforeach