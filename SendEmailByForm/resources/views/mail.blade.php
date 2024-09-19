<h1>Add Details for SEnd email</h1>

<form action="sendmail" method="post">
    @csrf

<input type="text" name="to" placeholder="Enter email address">
<br>
<input type="text" name="subject" placeholder="Enter subject">
<br>
<textarea name="message" placeholder="enter message"></textarea>
<button>send</button>

</form>

