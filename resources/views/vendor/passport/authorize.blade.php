    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Authorization</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
        <h1>{{ $client->name }} telah masuk sebagai user</h1>
        <p>Anda sedang login sebagai: {{ $user->email }}</p>
    
        <body class="min-h-screen flex items-center justify-center ">
            <form method="POST" action="{{ route('passport.authorizations.deny') }}">
                @csrf
                @method('DELETE')

                <input type="hidden" name="auth_token" value="{{ $authToken}}">

                <button type="submit">Cancel</button>
            </form>

            <form method="POST" action="{{ route(passport.authorizations.approve) }}">
                @csrf 
                <input type="hidden" name="auth_token" value="{{ $authToken }}">

                <button  type="submit">Continue</button>

            </form>
    </body>
    </html>