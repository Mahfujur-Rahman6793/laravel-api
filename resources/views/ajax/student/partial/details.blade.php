@if ($students->count() >0)
@foreach ($students as $student)
<tr>
    <td>{{$student->name}}</td>
    <td>{{$student->email}}</td>
    <td>{{$student->phone}}</td>
    <td>
        <img src="{{asset('images/'.$student->image)}}" width="100px" height="100px" alt="">
    </td>
    <td>
        <a href="{{ route('student.edit', $student->id) }}" class="btn btn-warning">Edit</a>
        <a href="{{ route('student.delete', $student->id) }}" class="btn btn-danger">delete</a>
    </td>
</tr>

@endforeach

@endif
