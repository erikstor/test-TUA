@extends('partials.layout')

@section('content')


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="alert alert-danger d-none alert-dismissible fade show" role="alert" id="error-panel">
                    <div id="error-content"></div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="bodyModal">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <div id="buttonSave"></div>
                </div>
            </div>
        </div>
    </div>


    <div class="container">
        <div class="col d-flex justify-content-start mb-5">
            <button type="button"
                    title="Add new task"
                    class="btn btn-sm btn-primary showButton"
                    data-bs-toggle="modal"
                    data-bs-target="#exampleModal"
                    data-type="add"
                    data-send="{{ route('store-task') }}"
            >
                <i class="fa-solid fa-plus"
                   data-type="add"
                   data-send="{{ route('store-task') }}"
                ></i>
            </button>
        </div>
        <div class="col">
            <table id="taksList" class="table table-hover w-100">
                <thead>
                <tr>
                    <th scope="col">Title</th>
                    <th scope="col">Status</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                @foreach($tasks as $task)
                    <tr>
                        <td>{{$task->title}}</td>
                        <td>
                            @switch($task->status)
                                @case(1) Por iniciar
                                @break
                                @case(2) En curso
                                @break
                                @case(2) Finalizada
                                @break
                            @endswitch
                        </td>
                        <td>
                            <button type="button"
                                    title="Show more..."
                                    data-url="{{route('find-task', $task->id)}}"
                                    class="btn btn-sm btn-primary showButton"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                    data-type="show"
                            >
                                <i class="fa-solid fa-eye"
                                   data-type="show"
                                   data-url="{{route('find-task', $task->id)}}"
                                ></i>
                            </button>
                            <button type="button" title="Edit task"
                                    data-url="{{route('find-task', $task->id)}}"
                                    data-type="edit"
                                    data-bs-toggle="modal"
                                    data-bs-target="#exampleModal"
                                    class="btn btn-sm btn-info text-light showButton">
                                <i class="fa-solid fa-pen-to-square" data-type="edit"
                                   data-url="{{route('find-task', $task->id)}}"
                                ></i>
                            </button>
                            <button type="button" title="Cancel task"
                                    data-url="{{route('find-task', $task->id)}}"
                                    data-type="trash"
                                    class="btn btn-sm btn-danger">
                                <i class="fa-solid fa-trash-can" data-type="trash"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div
        id="dataUrl"

    ></div>

@endsection
