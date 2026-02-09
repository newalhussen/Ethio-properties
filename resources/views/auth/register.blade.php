@extends('layouts.auth')

@section('content')
<style>
:root {
  --brand-start: #334155;   /* slate-700 */
  --brand-end:   #22d3ee;   /* cyan-400 */
  --brand-solid: #22d3ee;
  --brand-soft:  rgba(34, 211, 238, 0.15);
}

/* Vibrant gradient background for full page */
body {
    min-height: 100vh;
    margin: 0;
    font-family: sans-serif;
background: linear-gradient(135deg, #dbe9f7 0%, #a9d6fc 50%, #70cfff 100%);
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Center container */
.auth-page {
    width: 100%;
    padding: 1rem;
}

.auth-box {
    width: 100%;
    max-width: 760px;
    display: grid;
    grid-template-columns: 1fr 1fr;
    border-radius: 24px;
    overflow: hidden;
    background: white;
    box-shadow: 0 30px 80px rgba(0,0,0,0.2);
    margin: auto; /* center horizontally */
}

/* LEFT SIDE gradient panel */
.auth-left {
  background: linear-gradient(135deg, var(--brand-start), var(--brand-end));
  color: white;
  padding: 1.5rem;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.auth-left h1 {
  font-size: 2rem;
  font-weight: 700;
  margin-bottom: 1rem;
  padding-left: 2rem;
}

.auth-left p {
  font-size: 1.05rem;
  opacity: 0.9;
  line-height: 1.3;
  padding-left: 1.5rem;
}

/* RIGHT SIDE */
.auth-right {
  padding: 1.5rem;
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

/* Form inputs */
.form-control {
  width: 100%;
  padding: 0.65rem 0.9rem;
  border-radius: 12px;
  border: 1px solid #d1d5db;
  margin-bottom: 0.5rem;
  transition: all 0.2s;
  background: #fff;
  color: #111827;
}

.form-control:focus {
  outline: none;
  border-color: var(--brand-solid);
  box-shadow: 0 0 0 3px rgba(34, 211, 238, 0.15);
}

/* Primary register button */
.btn-primary {
  display: block;
  width: auto;
  min-width: 180px;
  padding: 0.55rem 1.5rem;
  margin: 0.6rem auto 0;
  background: linear-gradient(135deg, rgba(34, 211, 238, 0.3), rgba(51, 65, 85, 0.3));
  color: var(--brand-solid);
  font-weight: 600;
  border-radius: 9999px;
  border: none;
  transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
}

.btn-primary:hover {
  transform: translateY(-1px);
  box-shadow: 0 5px 15px rgba(34, 211, 238, 0.2);
  background: linear-gradient(135deg, rgba(34, 211, 238, 0.4), rgba(51, 65, 85, 0.4));
}

/* Google button */
.google-btn {
  display: flex;
  align-items: center;
  width: 100%;
  border-radius: 16px;
  overflow: hidden;
  font-size: 0.95rem;
  font-weight: 700;
  margin-bottom: 1rem;
  border: none;
  background: linear-gradient(135deg, var(--brand-start), var(--brand-end));
  color: white;
  transition: transform 0.2s, box-shadow 0.2s, background 0.2s;
}

.google-btn:hover {
  transform: translateY(-2px);
  box-shadow: 0 8px 20px rgba(34, 211, 238, 0.35);
  background: linear-gradient(135deg, #3b82f6, #06b6d4);
}

.google-icon {
  background: white;
  padding: 0.6rem 0.8rem;
  display: flex;
  align-items: center;
  justify-content: center;
}

.google-icon img {
  width: 20px;
  height: 20px;
}

.google-text {
  flex: 1;
  text-align: center;
  padding: 0.75rem;
}

/* Divider */
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

/* Error messages */
.error-message {
  color: #dc2626;
  font-size: 0.8rem;
  margin-bottom: 0.4rem;
}

/* Footer links */
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

    {{-- LEFT SIDE gradient panel --}}
    <div class="auth-left">
      <h1>Join Us</h1>
      <p>
        Create an account to manage your listings, connect with customers,
        and grow your business with confidence.
      </p>
    </div>

    {{-- RIGHT SIDE --}}
    <div class="auth-right">

      <h2 class="auth-title">{{ __('Register') }}</h2>
      <p class="auth-subtitle">Enter your details to get started</p>

      <a href="{{ route('google.login') }}" class="google-btn">
        <span class="google-icon">
          <img src="https://developers.google.com/identity/images/g-logo.png">
        </span>
        <span class="google-text">Continue with Google</span>
      </a>

      <div class="divider"><span>OR</span></div>

      <form method="POST" action="{{ route('register') }}">
        @csrf

        <input id="name" type="text" name="name" placeholder="{{ __('Full Name') }}" class="form-control" value="{{ old('name') }}" required autofocus>
        @error('name') <div class="error-message">{{ $message }}</div> @enderror

        <input id="email" type="email" name="email" placeholder="{{ __('Email Address') }}" class="form-control" value="{{ old('email') }}" required>
        @error('email') <div class="error-message">{{ $message }}</div> @enderror

        <input id="password" type="password" name="password" placeholder="{{ __('Password') }}" class="form-control" required>
        @error('password') <div class="error-message">{{ $message }}</div> @enderror

        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" class="form-control" required>

        <button type="submit" class="btn-primary">{{ __('Register') }}</button>
      </form>

      <div class="auth-footer">
        {{ __("Already have an account?") }}
        <a href="{{ route('login') }}">{{ __('Login') }}</a>
      </div>

    </div>
  </div>
</div>
@endsection
