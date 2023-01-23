<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <!-- {{ __('Dashboard') }} -->
            Create Invoice
        </h2>
    </x-slot>
    <form action="{{route('invoice.store')}}" method="post">
        @csrf
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <div class="py-12">

        <div class="max-w-10xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
                    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
                    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
                    <!------ Include the above in your HEAD tag ---------->
                    <div class="container">
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <div class="row clearfix">
                                    <div class="col-md-4 offset-4 text-center">
                                        Invoice numbers*:-
                                        <br />
                                        <input types="text" name="invoice[invoice_number]" class="form-control" placeholder="AA001" required />

                                        Invoice Date*:-
                                        </br>
                                        <input type="text" name="invoice[invoice_date]" class="form-control" value="{{date('Y-m-d')}}" required />
                                    </div>
                                </div>
                                <br>

                                <div class="row clearfix" style="margin-top:20px">
                                    <div class="col-md-12">
                                        <div class="float-left col-md-6">
                                            <b>Customer Details</b>
                                            <br /><br />
                                            Name*:<input type="text" name='customer[name]' class="form-control" required />
                                            Address*:<input type="text" name='customer[address]' class="form-control" required />
                                            Postcode/ZIP:<input type="text" name='customer[postcode]' class="form-control" />
                                            City*:<input type="text" name='customer[city]' class="form-control" required />
                                            State:<input type="text" name='customer[state]' class="form-control" />
                                            Country*:<input type="text" name='customer[country]' class="form-control" required />
                                            Phone:<input type="text" name='customer[phone]' class="form-control" />
                                            Email:<input type="text" name='customer[email]' class="form-control" />
                                            <br />
                                            <b>Additional fields</b> (optional):
                                            <br />
                                            <table class="table table-bordered table-hover">
                                                <tbody>
                                                    <tr>
                                                        <th class="text-center" width="50%">Field</th>
                                                        <th class="text-center">Value</th>
                                                    </tr>
                                                    @for ($i = 0; $i <= 2; $i++) <tr>
                                                        <td class="text-center">
                                                            <input type="text" name='customer_fields[{{ $i }}][field_key]' class="form-control" />
                                                        </td>
                                                        <td class="text-center">
                                                            <input type="text" name='customer_fields[{{ $i }}][field_value]' class="form-control" />
                                                        </td>
                                                        </tr>
                                                        @endfor
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="float-right col-md-4">
                                            <b>Seller details</b>:
                                            <br /> <br />
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

                                <table class="table table-bordered table-hover" id="tab_logic">
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
                                        <tr id='addr0'>
                                            <td>1</td>
                                            <td><input type="text" name='product[]' placeholder='Enter Product Name' class="form-control" /></td>
                                            <td><input type="number" name='qty[]' placeholder='Enter Qty' class="form-control qty" step="0" min="0" /></td>
                                            <td><input type="number" name='price[]' placeholder='Enter Unit Price' class="form-control price" step="0.00" min="0" /></td>
                                            <td><input type="number" name='total[]' placeholder='0.00' class="form-control total" readonly /></td>
                                        </tr>
                                        <tr id='addr1'></tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="row clearfix">
                            <div class="col-md-12">
                                <a id="add_row" class="btn btn-primary float-left">Add Row</a>
                                <a id='delete_row' class="float-right btn btn-danger">Delete Row</a>
                            </div>
                        </div>
                    </div>
                    <div class="row clearfix" style="margin-top:20px">
                        <div class="col-md-12">
                            <div class="float-right col-md-4">
                                <table class="table table-bordered table-hover" id="tab_logic_total">
                                    <tbody>
                                        <tr>
                                            <th class="text-center" width="50%">Sub Total</th>
                                            <td class="text-center"><input type="number" name='sub_total' placeholder='0.00' class="form-control" id="sub_total" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Tax</th>
                                            <td class="text-center">
                                                <div class="input-group mb-2 mb-sm-0">
                                                    <input type="number" class="form-control" id="tax" placeholder="0" name="invoice[tax_percent]">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Tax Amount</th>
                                            <td class="text-center"><input type="number" name='tax_amount' id="tax_amount" placeholder='0.00' class="form-control" readonly /></td>
                                        </tr>
                                        <tr>
                                            <th class="text-center">Grand Total</th>
                                            <td class="text-center"><input type="number" name='total_amount' id="total_amount" placeholder='0.00' class="form-control" readonly /></td>
                                        </tr>
                                    </tbody>
                                </table>
                                <input type="submit" class="btn btn-primary" value="Save Invoice" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

    <script>
        $(document).ready(function() {
            var i = 1;
            $("#add_row").click(function() {
                b = i - 1;
                $('#addr' + i).html($('#addr' + b).html()).find('td:first-child').html(i + 1);
                $('#tab_logic').append('<tr id="addr' + (i + 1) + '"></tr>');
                i++;
            });
            $("#delete_row").click(function() {
                if (i > 1) {
                    $("#addr" + (i - 1)).html('');
                    i--;
                }
                calc();
            });

            $('#tab_logic tbody').on('keyup change', function() {
                calc();
            });
            $('#tax').on('keyup change', function() {
                calc_total();
            });


        });

        function calc() {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();
                if (html != '') {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    $(this).find('.total').val(qty * price);

                    calc_total();
                }
            });
        }

        function calc_total() {
            total = 0;
            $('.total').each(function() {
                total += parseInt($(this).val());
            });
            $('#sub_total').val(total.toFixed(2));
            tax_sum = total / 100 * $('#tax').val();
            $('#tax_amount').val(tax_sum.toFixed(2));
            $('#total_amount').val((tax_sum + total).toFixed(2));
        }
    </script>
</x-app-layout>
