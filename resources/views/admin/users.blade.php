@extends('layout/app')

@section('title')
    Заявки на исполнителей
@endsection

@section('content')
<style>
    h3 {
        color: white;
    }
</style>
    <div class="container mb-5">
        <h3>Все заявки на исполнителя</h3>
        <table class="table table-dark rounded-table table-hover">
            <thead>
              <tr>
                <th scope="col">ID заявки</th>
                <th scope="col">ID пользователя</th>
                <th scope="col">Никнейм</th>
                <th scope="col">Описание</th>
                <th scope="col">Операции</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach ($applications as $application)
                    <th scope="row">{{ $application->id }}</th>
                    <td>{{ $application->user_id }}</td>
                    <td>{{ $application->title }}</td>
                    <td>{{ $application->text }}</td>
                    <td class="d-flex gap-4">
                        <a class="btn btn-dark" href="{{ route('confirm_artist', ['application'=> $application->id]) }}" 
                        style="background-color: #950FFF; color: white; font-weight: 500;">Одобрить</a>
                        <a class="btn btn-dark" style="border: 2px solid #950FFF;" href="{{ route('cancel_artist', ['application'=> $application->id]) }}">Отклонить</a>
                    </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection