@extends('layouts.main')

@section('title')
    Контакты
@endsection

@section('content')
    <div class="container">
        <p>Телефон: +7(916)123-11-11</p>
        <p>Почта: shevchukvitalik@bk.ru</p>
        <p>vk: vk.com</p>

        @include('layouts.errors')

        <h2>Оставьте отзыв</h2>
        <form method="post" action="/contacts" style="width: 200px;">

            @csrf

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Сообщение</label>
                <textarea name="message" id="message" cols="50" rows="10" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Отправить</button>
        </form>
    </div>
@endsection