@extends('layouts.main')

@section('title')
    Админка. Итого
@endsection

@section('admin')
    <div class="container">
        <p>Выберите пункты для подсчета кол-ва на сайте:</p>
        <form method="post" action="{{ route('admin.total.post') }}">

            @csrf

            <div class="list-group">
                <label class="list-group-item pl-5">
                    <input type="checkbox" class="form-check-input me-1" name="news" />
                    Новости
                </label>

                <label class="list-group-item pl-5">
                    <input type="checkbox" class="form-check-input me-1" name="articles" />
                    Статьи
                </label>

                <label class="list-group-item pl-5">
                    <input type="checkbox" class="form-check-input me-1" name="comments" />
                    Комментарии
                </label>

                <label class="list-group-item pl-5">
                    <input type="checkbox" class="form-check-input me-1" name="tags" />
                    Теги
                </label>

                <label class="list-group-item pl-5">
                    <input type="checkbox" class="form-check-input me-1" name="users" />
                    Пользователи
                </label>
            </div>

            <input type="submit" class="btn btn-primary mt-2" value="Сгенерировать отчёт" />
        </form>
    </div>
@endsection
