@extends('layouts.auth')

@section('content')
<style>

:root {
  --brand-start: #334155;   /* slate-700 */
  --brand-end:   #22d3ee;   /* cyan-400 */
  --brand-solid: #22d3ee;   /* can also be used for borders or text */
  --brand-soft:  rgba(34, 211, 238, 0.15);
}

body {
    background: linear-gradient(135deg, #dbe9f7 0%, #a9d6fc 50%, #70cfff 100%);
    min-height: 100vh;
    margin: 0;
    font-family: sans-serif;
}

.auth-page {
    min-height: 100vh; /* full viewport */
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 1rem;
} 

  .auth-box {
    width: 100%;
    max-width: 760px;
    background: white;
    border-radius: 24px;
    overflow: hidden;
    display: grid;
    grid-template-columns: 1fr 1fr;
    box-shadow: 0 30px 80px rgba(0,0,0,0.15);
  
  }

/* LEFT SIDE */
.auth-left {
  background: linear-gradient(135deg, var(--brand-start), var(--brand-end));
  color: white;
  padding: 1.2rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
}
  .auth-left h1 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
    padding-left: 2.5rem;
  }

  .auth-left p {
    font-size: 1.05rem;
    opacity: 0.9;
    line-height: 1.3;
     padding-left: 1.5rem;
  }

  /* RIGHT SIDE */
  .auth-right {
    padding: 1.2rem;
  }

  .auth-title {
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--brand-solid);
    margin-bottom: 0.5rem;
  }

  .auth-subtitle {
    font-size: 0.95rem;
     line-height: 1.3;
    color: #6b7280;
    margin-bottom: 1rem;
  }

  .form-control {
    width: 100%;
    padding: 0.65rem 0.9rem;
    border-radius: 12px;
    border: 1px solid #d1d5db;
    margin-bottom: 0.4rem;
    transition: all 0.2s;
  }

  .form-control:focus {
    outline: none;
   border-color: var(--brand-solid);
    box-shadow: 0 0 0 3px rgba(68,0,87,0.15);
  }

.btn-primary {
  display: block;               /* allow centering */
  width: auto;                  /* no longer full width */
  min-width: 180px;             /* reasonable size */
  padding: 0.55rem 1.5rem;      /* smaller padding */
  margin: 0.6rem auto 0;        /* center horizontally */
  background: linear-gradient(135deg, rgba(34, 211, 238, 0.3), rgba(51, 65, 85, 0.3)); /* dull gradient */
  color: var(--brand-solid);    /* still readable text */
  font-weight: 600;
  border-radius: 9999px;
  border: none;
  transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
}

.btn-primary:hover {
  transform: translateY(-1px);
  box-shadow: 0 5px 15px rgba(34, 211, 238, 0.2); /* lighter shadow on hover */
  background: linear-gradient(135deg, rgba(34, 211, 238, 0.4), rgba(51, 65, 85, 0.4)); /* slightly brighter on hover */
}

.google-btn {
  display: flex;
  align-items: center;
  width: 100%;
  border-radius: 16px;
  overflow: hidden;
  font-size: 0.95rem;   /* slightly bigger text */
  font-weight: 700;     /* bolder */
  margin-bottom: 1rem;  /* space below button */
  border: none;
  background: linear-gradient(135deg, var(--brand-start), var(--brand-end)); /* page gradient */
  color: white;
  transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
}

.google-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(34, 211, 238, 0.35); /* subtle shadow */
  background: linear-gradient(135deg, #3b82f6, #06b6d4); /* slightly brighter on hover */
}

.google-icon {
  background: white;
  padding: 0.6rem 0.8rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.google-icon img {
  width: 20px;   /* slightly bigger */
  height: 20px;
}

.google-text {
  flex: 1;
  text-align: center;
  padding: 0.75rem;   /* bigger click area */
}


  .divider {
    display: flex;
    align-items: center;
    margin: 0.8rem 0;
  }

  .divider span {
    margin: 0 0.75rem;
    font-size: 0.8rem;
    color: #9ca3af;
  }

  .divider::before,
  .divider::after {
    content: "";
    flex: 1;
    height: 1px;
    background: #e5e7eb;
  }

  .error-message {
    color: #dc2626;
    font-size: 0.8rem;
    margin-bottom: 0.4rem;
  }

  .auth-footer {
    text-align: center;
    margin-top: 1.8rem;
    font-size: 0.9rem;
  }

  .auth-footer a {
    color: #440057;
    font-weight: 600;
    text-decoration: none;
  }

  .auth-footer a:hover {
    text-decoration: underline;
  }

  /* MOBILE */
  @media (max-width: 768px) {
    .auth-box {
      grid-template-columns: 1fr;
    }
    .auth-left {
      display: none;
    }
  }
</style>

<div class="auth-page">
  <div class="auth-box">

    {{-- LEFT SIDE --}}
    <div class="auth-left">
      <h1>Welcome Back</h1>
      <p>
        Log in to manage your listings, connect with customers,
        and grow your business with confidence.
      </p>
    </div>

    {{-- RIGHT SIDE --}}
    <div class="auth-right">

      @if(session('login_notice'))
        <div class="mb-4 p-3 rounded-lg bg-yellow-100 text-yellow-800 text-sm">
          {{ session('login_notice') }}
        </div>
      @endif

      <h2 class="auth-title">{{ __('Login') }}</h2>
      <p class="auth-subtitle">Enter your credentials to continue</p>

<a href="{{ route('google.login') }}" class="google-btn">
  <span class="google-icon">
    <img src="https://developers.google.com/identity/images/g-logo.png">
  </span>
  <span class="google-text">Continue with Google</span>
</a>


      <div class="divider">
        <span>OR</span>
      </div>

      <form method="POST" action="{{ route('login') }}">
        @csrf

        <input
          type="email"
          name="email"
          class="form-control"
          placeholder="Email address"
          value="{{ old('email') }}"
          required
          autofocus
        >
        @error('email')
          <div class="error-message">{{ $message }}</div>
        @enderror

        <input
          type="password"
          name="password"
          class="form-control"
          placeholder="Password"
          required
        >
        @error('password')
          <div class="error-message">{{ $message }}</div>
        @enderror

        <div class="flex items-center gap-2 text-sm mt-2">
          <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
          <span>{{ __('Remember me') }}</span>
        </div>

        <button type="submit" class="btn-primary">
          {{ __('Login') }}
        </button>
      </form>

      <div class="auth-footer">
        {{ __("Don't have an account?") }}
        <a href="{{ route('register') }}">{{ __('Register') }}</a>
      </div>

    </div>
  </div>
</div>
@endsection
