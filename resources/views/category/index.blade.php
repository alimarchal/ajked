@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h4 class="h4 mb-4 text-gray-800">Categories</h4>

    @if($category->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Name</th>
                @canany(['edit','delete'])
                    <th>Actions</th>
                @endcanany
            </tr>
            </thead>
            <tbody>
            @foreach($category as $cat)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td>{{$cat->name}}</td>
                    @canany(['edit','delete'])
                        <td>
                            <a href="{{route('category.edit',$cat->id)}}" class="btn btn-outline-primary btn-sm" title="Edit Division">
                                <i class="fa fa-edit"></i>
                            </a>
                        </td>
                    @endcanany
                </tr>
            @endforeach

            </tbody>
        </table>
    @endif
@endsection
