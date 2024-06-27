@foreach($data as $invoice)
<tr>
    <th scope="row">{{ $loop->iteration }}</th>
    <td>{{$invoice->customer->name}}</td>
    <td>{{$invoice->date!=""?\Carbon\Carbon::parse($invoice->date)->format('d/m/Y'):''}}</td>
    <td>{{number_format($invoice->amount,2)}}</td>
    <td>{{$invoice->status}}</td>

    <td><a href="{{route('invoices.edit',encrypt($invoice->id))}}" style="margin-right: 10px;"><i
                class="bi bi-pencil-square"></i></a>
        {{-- <a href="javascript:void(0);"
            onclick="event.preventDefault();
                                                document.getElementById('delete-form-{{ $invoice->id }}').submit();"><i
                class="bi bi-x-circle"></i></a> --}}
    </td>

    {{--<form method="post" action="{{route('customers.destroy', encrypt($customer->id))}}" style="display:none"
        id="delete-form-{{$customer->id}}">
        @csrf
        @method('DELETE')
    </form> --}}

</tr>
@endforeach
