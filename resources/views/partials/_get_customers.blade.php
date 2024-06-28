@foreach($data as $customer)
<tr>
    <th scope="row">{{ $loop->iteration }}</th>
    <td>{{$customer->name}}</td>
    <td>{{$customer->phone}}</td>
    <td>{{$customer->email}}</td>

    <td><a href="{{route('customers.edit',encrypt($customer->id))}}" style="margin-right: 10px;"><i
                class="bi bi-pencil-square"></i></a>
      
    </td>


</tr>
@endforeach
