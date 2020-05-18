@extends('layouts.main')

@section('title')
    Обращения
@endsection

@section('admin')
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Сообщение</th>
                    <th scope="col">Дата получения</th>
                </tr>
            </thead>
            <tbody>
                @foreach($treatments as $i => $treatment)
                    <tr>
                        <th scope="row">{{ $i + 1 }}</th>
                        <td>{{ $treatment->email }}</td>
                        <td>{{ $treatment->message }}</td>
                        <td>{{ date("d.m.Y H:i:s", strtotime($treatment->created_at)) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
