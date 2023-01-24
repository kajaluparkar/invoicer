<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>

</head>

<body>
    <div class="max-w-20xl mx-auto sm:px-14 lg:px-10">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <div class="card-body">
                    <div class="container">
                        <div class="row clearfix">
                            <div>
                                <b>Invoice number {{$invoice->invoice_number}}</b>
                            </div>
                            <div class="col-md-4 text-center">
                                <b>Invoice {{$invoice->invoice_number}}</b>
                                <br />
                                {{ $invoice->invoice_date }}
                            </div>
                        </div>

                        <div class="row clearfix" style="margin-top:20px">
                            <div class="col-md-12">
                                <div class="float-left col-md-5">
                                    <b>To</b>
                                    {{ $invoice->customer->name }}
                                    <br>
                                   <br>
                                    <b>Address</b>:
                                    {{ $invoice->customer->address }}
                                    @if ($invoice->customer->postcode != '')
                                    <br />
                                    {{ $invoice->customer->postcode }}
                                    @endif
                                    <br />
                                    {{ $invoice->customer->city }}
                                    @if ($invoice->customer->state != '')
                                    <br />
                                    {{ $invoice->customer->state }}
                                    @endif
                                    {{ $invoice->customer->country }}
                                    @if($invoice->customer->phone != '')
                                    <br /><br /><b>Phone</b>:{{ $invoice->customer->email }}
                                    @endif
                                    @if($invoice->customer->email != '')
                                    <br><b>Email</b>: {{ $invoice->customer->email }}
                                    @endif
                                    @if($invoice->customer->customer_fields)
                                    @foreach ($invoice->customer->customer_fields as $field)
                                    <br /><br><b>{{ $field->field_key }}</b>:{{ $field->field_value}}
                                    @endforeach
                                    @endif
                                </div>
                                <br>
                                <div class="float-right col-md-4">
                                    <b>Seller details</b>:
                                    Your Company name
                                    <br />
                                    1 Street Name, London, United Kingdom
                                    <br />
                                    Email: xxxxx@company.com
                                    <br />
                                    VAT Number: xx xxxxx xxxx
                                </div>

                            </div>
                        </div>

                        <br>
                        <br>
                        <table class="table table-bordered table-hover" id="tab_logic" border="1">
                            <thead>
                                <tr>
                                    <th class="text-center"> # </th>
                                    <th class="text-center"> Product </th>
                                    <th class="text-center"> Qty </th>
                                    <th class="text-center"> Price </th>
                                    <th class="text-center"> Total </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($invoice->invoice_item as $item)
                                <tr id='addr0'>
                                    <td>{{ $loop->iteration}}</td>
                                    <td>{{ $item->name}}</td>
                                    <td>{{ $item->quantity}}</td>
                                    <td>{{ $item->price}}</td>
                                    <td>{{ number_format($item->quantity * $item->price, 2)}}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="row clearfix" style="margin-top:20px">
                <div class="col-md-12">
                    <div class="float-right col-md-4">
                    <table class="table">
                            <tbody>
                                <tr>
                                    <th class="text-center" width="50%">Sub Total:-</th>
                                    <td class="text-center">{{ number_format($invoice->total_amount,2 )}}</td>
                                </tr>
                                <tr>
                                    <th class="text-center">Tax:-</th>
                                    <td class="text-center"> {{ $invoice->tax_percent }}
                                    </td>
                                </tr>
                                <tr>
                                    <th class="text-center">Tax Amount:-</th>
                                    <td class="text-center">{{ number_format($invoice->total_amount * $invoice->tax_percent / 100, 2) }}</td>
                                </tr>
                                <tr>
                                    <th class="text-center">Grand Total:-</th>
                                    <td class="text-center">{{ number_format($invoice->total_amount + ($invoice->total_amount * $invoice->tax_percent / 100), 2) }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
    </div>
    </div>
    </div>



</body>

</html>
