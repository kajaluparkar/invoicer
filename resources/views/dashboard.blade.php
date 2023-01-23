<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <a href="{{route('invoice.create')}}" class="btn btn-primary">Add New Invoice</a>
                    <br /> <br />

                    <table class="table">
                        <tr>
                            <th>Invoice Date</th>
                            <th>Invoice Number</th>
                            <th>Customer</th>
                            <th>Total Amount</th>
                            <th></th>
                         </tr>
                         <tbody>
                         @foreach($invoices as $invoice)
                         <tr>
                            <td>{{$invoice->invoice_date}}</td>
                            <td>{{$invoice->invoice_number}}</td>
                            <td>{{$invoice->customer->name}}</td>
                            <td>{{number_format($invoice->total_amount,2)}}</td>
                            <td>
                                <a href="{{route('invoice.show',$invoice->id)}}" class=" btn btn-sm btn btn-info">View Invoice</a>
                                <a href="{{route('invoice.download',$invoice->id)}}" class=" btn btn-sm btn btn-warning">Download PDF</a>
                            </td>
                         </tr>
                         @endforeach
                       </tbody>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
