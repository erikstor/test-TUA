@extends('partials.layout')

@section('content')


    <div class="container">
        <div class="col">
            <table id="userList" class="table table-hover w-100">
                <thead>
                <tr>
                    <th scope="col">Full Name</th>
                    <th scope="col">Phone</th>
                    <th scope="col">Email</th>
                    <th scope="col">Status</th>
                </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>


    <div id="dataDiv"
         data-url-get-user="{{ route('get-user') }}"
    ></div>

@endsection
