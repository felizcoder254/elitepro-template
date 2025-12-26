<!DOCTYPE html>
<html>
<head>
    <title>Debug Registration</title>
</head>
<body>
    <h1>Debug Registration Form</h1>
    <p>Session ID: {{ $session_id }}</p>
    <p>CSRF Token: {{ $csrf_token }}</p>
    
    <form method="POST" action="/simulate-registration">
        @csrf
        <input type="hidden" name="_token" value="{{ $csrf_token }}">
        <button type="submit">Test Submit</button>
    </form>
    
    <script>
        // Debug: Check cookies before submit
        document.querySelector('form').addEventListener('submit', function(e) {
            console.log('Cookies before submit:', document.cookie);
            console.log('CSRF Token:', document.querySelector('[name="_token"]').value);
        });
    </script>
</body>
</html>
