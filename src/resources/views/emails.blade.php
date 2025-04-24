<!-- filepath: c:\Users\Acer\Downloads\APPDEVfinals-main\src\resources\views\emails\reset-password.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Password Reset Request</title>
</head>
<body>
    <h1>Password Reset Request</h1>
    <p>Hello,</p>
    <p>You are receiving this email because we received a password reset request for your account.</p>
    <p>Click the button below to reset your password:</p>
    <a href="{{ url('/password/reset/' . $token) }}" style="display: inline-block; padding: 10px 20px; color: #fff; background-color: #007bff; text-decoration: none; border-radius: 5px;">Reset Password</a>
    <p>If you did not request a password reset, no further action is required.</p>
    <p>Thank you!</p>
</body>
</html>