@extends('layouts.app')

@section('content')
<style>
  /* ======= BASE ======= */
  body {
    background: #f9fafb;
  }

  .choose-container {
    text-align: center;
    padding: 4rem 1rem;
  }

  .choose-heading {
    font-size: 2rem;
    font-weight: 800;
    color: #1f2937; /* gray-800 */
    margin-bottom: 2.5rem;
  }

  /* ======= OPTIONS ======= */
  .icon-options {
    display: flex;
    justify-content: center;
    gap: 3rem;
    margin-bottom: 2rem;
  }

  .icon-box {
    background: white;
    border-radius: 24px;
    padding: 2.5rem 2rem;
    width: 190px;
    cursor: pointer;
    transition: all 0.3s ease;
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.08);
    color: #4F46E5; /* gray-700 */
  }

  .icon-box:hover {
    transform: translateY(-6px);
    box-shadow: 0 15px 45px rgba(68, 0, 87, 0.18);
    color: #4F46E5;
  }

  .icon-box svg {
    width: 72px;
    height: 72px;
    margin-bottom: 1rem;
     color: #4F46E5;
     transition: color 0.3s ease;
  }

  .icon-box p {
    font-weight: 700;
    font-size: 1.1rem;
  }

  .icon-box:hover svg {
  color: #645cfa;
}
  /* ======= FORM ======= */
  .form-section {
    display: none;
    max-width: 650px;
    margin: 0 auto;
    text-align: left;
    background: white;
    padding: 2.5rem;
    border-radius: 24px;
    box-shadow: 0 15px 50px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.4s ease;
  }

  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(15px); }
    to { opacity: 1; transform: translateY(0); }
  }

  .form-control {
    width: 100%;
    padding: 0.9rem 1.2rem;
    margin-bottom: 1rem;
    border-radius: 12px;
    border: 1px solid #d1d5db;
    font-size: 1rem;
  }

  .form-control:focus {
    outline: none;
    border-color: #440057;
    box-shadow: 0 0 0 2px #44005720;
  }

  /* ======= BUTTONS ======= */
  .btn-primary {
    background: #440057;
    color: white;
    padding: 0.8rem 2.2rem;
    border-radius: 9999px;
    border: none;
    font-weight: 600;
    transition: 0.3s;
  }

  .btn-primary:hover {
    background: #5d0077;
  }

  .btn-back {
    background: transparent;
    color: #440057;
    border: none;
    font-weight: 600;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    margin-bottom: 1.5rem;
  }

  .btn-back:hover {
    text-decoration: underline;
  }
</style>


<div class="choose-container">
  <h2 class="choose-heading" id="heading">What do you want to post?</h2>

  <div class="icon-options" id="iconOptions">
<a href="{{ route('owner.cars.create') }}" class="icon-box" id="carOption" style="text-decoration: none;">
  <svg fill="currentColor" viewBox="0 0 24 24">
    <path d="M18.92 6.01C18.72 5.42 18.16 5 17.5 5h-11c-.66 0-1.21.42-1.42 1.01L3 12v8c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-1h12v1c0 .55.45 1 1 1h1c.55 0 1-.45 1-1v-8l-2.08-5.99zM6.85 7h10.29l1.04 3H5.81l1.04-3zM19 16H5v-3h14v3zM7 17.5c.83 0 1.5.67 1.5 1.5S7.83 20.5 7 20.5 5.5 19.83 5.5 19s.67-1.5 1.5-1.5zm10 0c.83 0 1.5.67 1.5 1.5S17.83 20.5 17 20.5 15.5 19.83 15.5 19s.67-1.5 1.5-1.5z"/>
  </svg>
  <p>Car</p>
</a>

<a href="{{ route('owner.house.create') }}" class="icon-box" id="houseOption" style="text-decoration: none;">
  <svg fill="currentColor" viewBox="0 0 24 24">
    <path d="M12 3l9 8h-3v9h-4v-6H10v6H6v-9H3z"/>
  </svg>
  <p>House</p>
</a>

  </div>
</div>
@endsection
