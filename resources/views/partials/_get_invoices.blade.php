@foreach($data as $invoice)
<tr>
    <th scope="row">{{ $loop->iteration }}</th>
    <td>{{$invoice->customer->name}}</td>
    <td>{{$invoice->date!=""?\Carbon\Carbon::parse($invoice->date)->format('d/m/Y'):''}}</td>
    <td>{{number_format($invoice->amount,2)}}</td>
    <td>{{$invoice->status}}</td>

    <td><a href="{{route('invoices.edit',encrypt($invoice->id))}}" style="margin-right: 10px;"><i
                class="bi bi-pencil-square"></i></a>
     
    </td>


</tr>
@endforeach
