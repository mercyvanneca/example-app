<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <style>
        /* Resetting and General Styles */
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f4f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* Container Styles */
        .container {
            width: 100%;
            max-width: 480px;
            padding: 30px;
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            text-align: center;
        }

        /* Header Styles */
        h1 {
            margin-bottom: 20px;
            font-size: 2rem;
            font-weight: 600;
            color: #4CAF50;
        }

        /* Label and Input Field Styles */
        label {
            font-weight: 500;
            color: #555;
            margin-bottom: 8px;
            display: block;
            text-align: left;
            font-size: 1rem;
        }

        input[type="text"], input[type="email"], input[type="password"] {
            width: 100%;
            padding: 12px;
            margin: 12px 0;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: border 0.3s ease;
        }

        input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        /* Button Styles */
        button {
            width: 100%;
            padding: 12px;
            margin-top: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            color: #fff;
            background-color: #4CAF50;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Alert Message Styles */
        .alert {
            margin-bottom: 20px;
            padding: 10px;
            font-weight: 500;
            text-align: center;
        }

        .alert.alert-danger {
            color: red;
        }

        .alert.alert-success {
            color: green;
        }

        /* Footer Styles */
        .form-footer {
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .form-footer a {
            color: #4CAF50;
            font-weight: 500;
            text-decoration: none;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        /* Responsive Design */
        @media screen and (max-width: 480px) {
            .container {
                padding: 20px;
                margin: 10px;
            }

            h1 {
                font-size: 1.6rem;
            }

            button, input {
                font-size: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Signup</h1>

        <!-- Error Message -->
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Signup Form -->
        <form method="POST" action="{{ route('signup') }}">
            @csrf
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name') }}" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>

            <button type="submit">Sign Up</button>
        </form>

        <div class="form-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
        </div>
    </div>
</body>
</html>
