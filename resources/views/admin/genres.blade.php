@extends('layout/app')

@section('title')
    Жанры
@endsection

@section('content')
<style>
    .rounded-table {
        border-radius: 10px;
        overflow: hidden;
    }

    .rounded-table th,
    .rounded-table td {
        padding: 10px;
    }

    input{
        background-color: white !important;
    }

    h3 {
        color: white;
    }

    form {
        background-color: white !important;
    }
    h1, label {
        color: black !important;
    }
</style>
    <div class="container mb-5"id="genresPage">
        <div class="d-flex justify-content-between mb-3">
           <h3>Все жанры</h3>
        <button type="button" class="btn" style="background-color: #950FFF; color: white; font-weight: 500;" data-bs-toggle="modal" data-bs-target="#addModal">
            Добавить
          </button> 
        </div>
        <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel" style="color: rgb(0, 0, 0) !important;">Добавление жанра</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="add_genre_form" enctype="multipart/form-data" @submit.prevent="addGenre">
                        <div class="mb-3">
                        <label for="title" class="form-label">Название</label>
                        <input type="text" class="form-control" id="title" name="title"
                            :class="errors.title ? 'is-invalid' : ''">
                        <div class="invalid-feedback" v-for="error in errors.title">
                            @{{ error }}
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="img" class="form-label">Фото</label>
                        <input type="file" class="form-control" id="img" name="img" :class="errors.img ? 'is-invalid' : ''">
                        <div class="invalid-feedback" v-for="error in errors.img">
                            @{{ error }}
                        </div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn" style="background-color: #950FFF; color: white; font-weight: 500;">Добавить</button>
                    </div>
                    </form>
                </div>
            </div>
            </div>
        </div>
        <table class="table table-dark rounded-table table-hover">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Название</th>
                <th scope="col">Операции</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                @foreach ($genres as $genre)
                    <th scope="row">{{ $genre->id }}</th>
                    <td>{{ $genre->title }}</td>
                    <td class="d-flex gap-4">
                        <button type="button" class="btn" style="background-color: #950FFF; color: white; font-weight: 500;" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $genre->id }}">
                            Изменить
                          </button>
                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal{{ $genre->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Изменение жанра</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form @submit.prevent="updateGenre({{ $genre->id }})" enctype="multipart/form-data" id="update_genre_form{{ $genre->id }}">
                                        <div class="mb-3">
                                        <label for="title" class="form-label">Название</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            :class="errors.title ? 'is-invalid' : ''" value="{{ $genre->title }}">
                                        <div class="invalid-feedback" v-for="error in errors.title">
                                            @{{ error }}
                                        </div>
                                        </div>
                                        <div class="mb-3">
                                            <label for="img" class="form-label">Фото</label>
                                            <input type="file" class="form-control" id="img" name="img" :class="errors.img ? 'is-invalid' : ''">
                                            <div class="invalid-feedback" v-for="error in errors.img">
                                                @{{ error }}
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn" style="background-color: #950FFF; color: white; font-weight: 500;">Сохранить изменения</button>
                                        </div>
                                    </form>
                                    
                                </div>
                            </div>
                            </div>
                        </div>
                        <a class="btn btn-dark" style="border: 2px solid #950FFF;" href="{{ route('delete_genre', ['genre'=> $genre]) }}">Удалить</a>
                    </td>
              </tr>
              @endforeach
            </tbody>
          </table>
    </div>
    <script>
        const app = {
            data() {
                return {
                    errors: [],
                    message: '',
                }
            },
            methods: {
                async addGenre() {
                    let form = document.getElementById('add_genre_form');
                    let form_data = new FormData(form);
                    const response = await fetch('{{ route('add_genre') }}', {
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: form_data,
                    });
                    if (response.status == 400) {
                        this.errors = await response.json();
                        setTimeout(() => {
                            this.errors = [];
                        }, 10000);
                    }
                    if (response.status == 200) {
                        form.reset();
                        window.location = '{{ route('show_admin_genres') }}';
                    }
                },
                async updateGenre(id) {
                    let form = document.getElementById('update_genre_form'+id);
                    let form_data = new FormData(form);
                    form_data.append('id', id);
                    const response = await fetch('{{ route('update_genre') }}', {
                        method: 'post',
                        headers: {
                            'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        },
                        body: form_data,
                    });
                    if (response.status == 400) {
                        this.errors = await response.json();
                        setTimeout(() => {
                            this.errors = [];
                        }, 10000);
                    }
                    if (response.status == 200) {
                        form.reset();
                        window.location = '{{ route('show_admin_genres') }}';
                    }
                }
            }
        }
    Vue.createApp(app).mount('#genresPage');
    </script>
@endsection