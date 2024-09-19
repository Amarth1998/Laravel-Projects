<h1>uploade image</h1>

<form action="/upload" method="post" enctype="multipart/form-data">
    @csrf
    <input type="file" name="file">
    <button>upload</button>
</form>
