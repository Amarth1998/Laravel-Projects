<h1>student</h1>
<form action="search" method="get">
    <input type="text" placeholder="search with name" name="search" value="{{@$search}}">
    <button>search</button>
</form>

<form action="delete-multi"  method="post"> 
    @csrf 

<table border="1">
    <tr>
        <td>name</td>
        <td>email</td>
        <td>phone</td>
        <td>created at</td>
        <td>updated at</td>
        
        <td> select delete <br><button>submit</button></td>    
        <td>Delete</td>
        <td>Update</td> 

    </tr>
@foreach($students as $student )
<tr>
    <td>{{$student->name}}</td>
    <td>{{$student->email}}</td>
    <td>{{$student->phone}}</td>
    <td>{{$student->created_at}}</td>
    <td>{{$student->updated_at}}</td>
    <td><input type="checkbox" name="ids[]" value="{{$student->id}}"></td>
    <td><a href="{{'delete/'.$student->id}}">Delete</a></td>
    <td><a href="{{'edit/'.$student->id}}">Update</a></td>
</tr>
@endforeach
</table>

</form>

<br><br>

{{$students->links()}}

<style>
    .w-5.h-5{
        width: 20px;
    }
</style>