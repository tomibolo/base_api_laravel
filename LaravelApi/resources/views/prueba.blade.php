<form action="{{ Route('session') }}" method="post">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
  First name:<br>
  <input type="email" name="email" value="caca@caca.com">
  <br>
  Password:<br>
  <input type="password" name="password" value="caca">
  <br><br>
  <input type="submit" value="Submit">
</form>
