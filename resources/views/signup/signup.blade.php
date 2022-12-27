<!DOCTYPE html>
<html>
<head>
	<title>SIGN UP</title>
	<link rel="stylesheet" type="text/css" href="css/style_login.css">
</head>
<body>
     <form action="/signup" method="post">
          @csrf
     	<h2>SIGN UP</h2>
     	@if (session()->has('error'))
               <p class="error">{{ session('error') }}</p>
          @endif
     	@if (session()->has('success'))
               <p class="success">{{ session('success') }}</p>
          @endif

          <label>Nama</label>
          <input type="text" name="name" placeholder="Nama" value="{{ old('name') }}" class="@error('name')
               invalid
          @enderror">
          @error('name')
               <p class="invalid-feedback">{{ $message }}</p>
          @enderror

          <label>Email</label>
          <input type="email" name="email" placeholder="Email" value="{{ old('email') }}" class="@error('email')
               invalid
          @enderror">
          @error('email')
               <p class="invalid-feedback">{{ $message }}</p>
          @enderror

     	<label>Password</label>
     	<input type="password" name="password" placeholder="Password" class="@error('password')
               invalid
          @enderror">
          @error('password')
               <p class="invalid-feedback">{{ $message }}</p>
          @enderror

          <label>Konfirmasi Password</label>
          <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" class="@error('password_confirmation')
               invalid
          @enderror">
          @error('password_confirmation')
               <p class="invalid-feedback">{{ $message }}</p>
          @enderror

     	<button type="submit">Sign Up</button>
          <a href="/login" class="ca">Sudah punya akun?</a>
     </form>
</body>
</html>