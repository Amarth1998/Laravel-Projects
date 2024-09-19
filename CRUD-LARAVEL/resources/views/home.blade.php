<h1>add new student</h1>
<form action="/add" method="post">
    @csrf

<input type="text" name="name" placeholder="name" > <br>
<input type="text" name="email" placeholder="email " > <br>
<input type="text" name="phone"  placeholder="phone"> <br>

<button>submit</button>
</form>