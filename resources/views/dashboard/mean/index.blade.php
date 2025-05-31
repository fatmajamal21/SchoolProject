
@extends('dashboard.master')
@section('title')
مدرسة خانيونس للبنين | الصفحة الرئيسية
@stop
@section('page-content')
<style>
  /* خلفية متدرجة أنيقة */
  body {
    background: linear-gradient(135deg, #2c3e50, #3498db);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #fff;
    min-height: 100vh;
    margin: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }
  main.page-content {
    background-color: rgba(0, 0, 0, 0.6);
    padding: 40px 60px;
    border-radius: 15px;
    box-shadow: 0 8px 30px rgba(0,0,0,0.3);
    max-width: 700px;
    text-align: center;
  }
  main.page-content h1 {
    font-size: 3.5rem;
    margin-bottom: 15px;
    font-weight: 700;
    letter-spacing: 2px;
  }
  main.page-content p.subtitle {
    font-size: 1.5rem;
    margin-bottom: 30px;
    color: #d0e6f7;
  }
  /* زر دخول */
  main.page-content a.btn-enter {
    text-decoration: none;
    background-color: #2980b9;
    padding: 14px 40px;
    font-size: 1.2rem;
    color: white;
    border-radius: 40px;
    box-shadow: 0 6px 15px rgba(41, 128, 185, 0.6);
    transition: background-color 0.3s ease;
  }
  main.page-content a.btn-enter:hover {
    background-color: #1c5980;
  }
</style>

<main class="page-content">
  <div class="container">
    <h1>مدرسة خانيونس للبنين</h1>
    <p class="subtitle">مرحباً بكم في الصفحة الرئيسية للمدرسة</p>
    {{-- <a href="{{ url('/dashboard') }}" class="btn-enter">ادخل إلى لوحة التحكم</a> --}}
  </div>
</main>
@stop
