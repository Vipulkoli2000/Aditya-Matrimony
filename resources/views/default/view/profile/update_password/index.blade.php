<x-layout.user_banner>
    <!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <title>Update Password</title>
      <style>
        /* Global Styles */
        body {
          font-family: Arial, sans-serif;
          background-color: #f7f7f7;
          margin: 0;
          padding: 0;
          color: #333;
        }
        /* Container for the reset form */
        .reset-container {
          max-width: 400px;
          margin: 50px auto;
          background-color: #fff;
          border: 1px solid #ddd;
          border-radius: 8px;
          padding: 20px;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .reset-container h2 {
          text-align: center;
          margin-bottom: 20px;
          color: #444;
        }
        /* Form Group */
        .form-group {
          margin-bottom: 15px;
        }
        .form-group label {
          display: block;
          margin-bottom: 5px;
          font-weight: bold;
        }
        .form-group input {
          width: 100%;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
        }
        /* Button styles */
        button.btn {
          width: 100%;
          padding: 10px;
          background-color: #ff0000;
          color: #fff;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          font-weight: bold;
        }
        button.btn:hover {
          background-color: #e60000;
        }
        /* Alert styles */
        .alert {
          padding: 10px;
          background-color: #f8d7da;
          color: #721c24;
          border: 1px solid #f5c6cb;
          border-radius: 4px;
          margin-bottom: 15px;
          text-align: center;
        }
        /* Sidebar styling */
        .sidebar {
          margin-top: 20px;
        }
      </style>
    </head>
    <body>
      <div class="reset-container">
        @if ($errors->any())
            <div class="alert">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if(session('error'))
          <div class="alert">
            <strong>Error:</strong> {{ session('error') }}
          </div>
        @endif
    
        @if(session('status'))
          <div class="alert" style="background-color: #d4edda; color: #155724; border-color: #c3e6cb;">
            {{ session('status') }}
          </div>
        @endif
    
        <h2>Update Password</h2>
        <form method="POST" action="{{ route('profiles.password.update') }}">
          @csrf
          @method('PUT') <!-- Spoofing the PUT method -->
    
          <!-- Old Password Field -->
          <div class="form-group">
            <label for="old_password">Old Password</label>
            <input id="old_password" type="password" name="old_password" required />
          </div>
    
          <!-- New Password Field -->
          <div class="form-group">
            <label for="password">New Password</label>
            <input id="password" type="password" name="password" required />
          </div>
          <!-- Confirm New Password Field -->
          <div class="form-group">
            <label for="password_confirmation">Confirm New Password</label>
            <input id="password_confirmation" type="password" name="password_confirmation" required />
          </div>
    
          <button type="submit" class="btn">Update Password</button>
        </form>
      </div>
      <div class="sidebar">
        <x-common.usersidebar />
      </div>
    </body>
    </html>
</x-layout.user_banner>
