@extends('layouts.appLayout')
@section('title')
    {{config('app.name')}}
@endsection

@section('content')
    <!-- Page Heading -->
    <h3 class="text-center">
        Azad Jammu & Kashmir Electricity Department<br>
        Store Division Muzaffarabad<br>
        Suppliers List
    </h3>
    <form action="#" method="get" class=" d-print-none">
        <div class="form-row">

            <div class="form-group col-md-12">
                <button class="btn btn-primary float-right mr-4" onclick="window.print()">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-printer" viewBox="0 0 16 16">
                        <path d="M2.5 8a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1z"></path>
                        <path d="M5 1a2 2 0 0 0-2 2v2H2a2 2 0 0 0-2 2v3a2 2 0 0 0 2 2h1v1a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-1h1a2 2 0 0 0 2-2V7a2 2 0 0 0-2-2h-1V3a2 2 0 0 0-2-2H5zM4 3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1v2H4V3zm1 5a2 2 0 0 0-2 2v1H2a1 1 0 0 1-1-1V7a1 1 0 0 1 1-1h12a1 1 0 0 1 1 1v3a1 1 0 0 1-1 1h-1v-1a2 2 0 0 0-2-2H5zm7 2v3a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1v-3a1 1 0 0 1 1-1h6a1 1 0 0 1 1 1z"></path>
                    </svg>  Print
                </button>
            </div>
        </div>
    </form>


    @if($suppliers->isNotEmpty())
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th class="text-center">No</th>
                <th>Name of Firm/Supplier</th>
                <th>AJKED Registration No</th>
                <th>Name of Items</th>
                <th>Stock Code</th>
                <th>Status</th>
                @canany(['edit','delete'])
                    <th class=" d-print-none">Last Update</th>
                    <th class=" d-print-none">Action</th>
                @endcanany
            </tr>
            </thead>
            <tbody>
            @foreach($suppliers as $supplier)
                <tr>
                    <td class="text-center">{{$loop->iteration}}</td>
                    <td>{{$supplier->name_of_supplier_firm}}</td>
                    <td>{{$supplier->ajked_registration_no}}</td>
                    <td>
                        @if($supplier->supplier_items->isNotEmpty())
                            @foreach($supplier->supplier_items as $item)
                                {{\App\Models\Product::find($item->product_id)->name}},
                            @endforeach
                        @endif
                    </td>

                    <td>
                        @if($supplier->supplier_items->isNotEmpty())
                            @foreach($supplier->supplier_items as $item)
                                {{\App\Models\Product::find($item->product_id)->id}},
                            @endforeach
                        @endif
                    </td>


                    <td>
                        {{$supplier->status}}
                    </td>

                    @canany(['edit','delete'])
                        <td class="text-center d-print-none">
                            {{\Carbon\Carbon::parse($supplier->updated_at)->format('d-m-Y')}}
                        </td>
                        <td class=" d-print-none">
                            <a href="{{route('supplier.edit',$supplier->id)}}" class="btn btn-outline-primary btn-sm" title="Edit Supplier">
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
