<h1>Update Student Data</h1>
<form action="/update/{{$data->id}}" method="post">
    @csrf
    @method('PUT') <!-- Correct method spoofing -->
    
    <input type="text" name="name" value="{{ $data->name }}" > <br>
    <input type="email" name="email" value="{{ $data->email }}" > <br>
    <input type="text" name="phone" value="{{ $data->phone }}" > <br>
    
    <button type="submit">Submit</button>
    <a href="/list">Cancel Update</a>
</form>
