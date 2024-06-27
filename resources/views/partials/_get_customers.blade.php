@foreach($data as $customer)
<tr>
    <th scope="row">{{ $loop->iteration }}</th>
    <td>{{$customer->name}}</td>
    <td>{{$customer->phone}}</td>
    <td>{{$customer->email}}</td>

    <td><a href="{{route('customers.edit',encrypt($customer->id))}}" style="margin-right: 10px;"><i
                class="bi bi-pencil-square"></i></a>
        {{-- <a href="javascript:void(0);" onclick="event.preventDefault();
                                                document.getElementById('delete-form-{{ $customer->id }}').submit();"><i
                class="bi bi-x-circle"></i></a> --}}
    </td>

    {{--<form method="post" action="{{route('customers.destroy', encrypt($customer->id))}}" style="display:none"
        id="delete-form-{{$customer->id}}">
        @csrf
        @method('DELETE')
    </form> --}}

</tr>
@endforeach
