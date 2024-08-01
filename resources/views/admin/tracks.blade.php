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
        <h3>Треки</h3>
        <table class="table table-dark rounded-table table-hover">
            <thead>
              <tr>
                <th scope="col">ID трека</th>
                <th scope="col">Название</th>
                <th scope="col">Никнейм</th>
                <th scope="col">Статус</th>
                <th scope="col">Операции</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach ($tracks as $track)
                    <th scope="row">{{ $track->id }}</th>
                    <td>
                        <img src="{{ asset('/public'.$track->img) }}" alt="" style="width: 55px; height:55px; object-fit:cover;">
                        {{ $track->title }}
                    </td>
                    {{-- <td>{{ $track->tra->phone }}</td> --}}
                    <td>{{ $track->status }} <i class="bi bi-pen"></i></td>
                    {{-- <td class="d-flex gap-4">
                        <a class="btn btn-dark" href="{{ route('confirm_artist', ['application'=> $application->id]) }}" 
                        style="background-color: #950FFF; color: white; font-weight: 500;">Одобрить</a>
                        <a class="btn btn-dark" style="border: 2px solid #950FFF;" href="{{ route('cancel_artist', ['application'=> $application->id]) }}">Отклонить</a>
                    </td> --}}
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
@endsection