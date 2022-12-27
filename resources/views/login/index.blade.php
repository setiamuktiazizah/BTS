<!DOCTYPE html>
<html>
<head>
	<title>LOGIN</title>
	<link rel="stylesheet" type="text/css" href="css/style_login.css">
</head>
<body>
     <form action="/login" method="post">
		@csrf
     	<h2>LOGIN</h2>
     	@if (session()->has('error'))
			<p class="error">{{ session('error') }}</p> 
		@endif
     	@if (session()->has('success'))
			<p class="success">{{ session('success') }}</p> 
		@endif

     	<label>Email</label>
     	<input type="text" name="email" placeholder="Email" class="@error('email')
			invalid
		@enderror">
		@error('email')
			<p class="invalid-feedback">{{ $message }}</p>
		@enderror

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Password" class="@error('password')
			invalid
		@enderror">
		@error('email')
			<p class="invalid-feedback">{{ $message }}</p>
		@enderror

     	<button type="submit">Login</button>
		 <a href="/signup" class="ca">Buat akun baru</a>
     </form>
</body>
</html>