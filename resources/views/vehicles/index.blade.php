@extends('../vehicles/layout')

@section('body')

    @if(session()->has('Success'))
    <div class="alert alert-success">
        {{ session()->get('Success') }}
    </div>
    @endif
        <h1 class="text-center">Cars List</h1>

        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Id</th>
                    <th scope="col" class="text-center">Name</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Image</th>
                    <th scope="col" class="text-center">Operations</th>
                </tr>
            </thead>
            <tbody>
                @foreach($cars as $car)
                    <tr>
                        <th class="text-center">{{ $car->id }}</th>
                        <td class="text-center">{{ $car->name }}</td>
                        <td class="text-center">{{ $car->email }}</td>
                        <td class="text-center">
                            <img class="image-size" src={{ asset('/storage/cars/' . $car->image) }} />
                        </td>
                        <td class="center">
                            <a href="{{ route('cars.edit',    $car->id) }}" class="btn btn-link btn-sm" role="button" aria-pressed="true">Edit</a>
                            
                            {{--   Form For delete operations   --}}

                            {!! Form::open ([ 'route' => ['cars.destroy',  $car->id ], 'method' => 'delete']) !!}
                                {!! Form::token() !!}
                                {!! Form::button('Delete', [ 'type' => 'submit','class' => 'btn btn-link btn-sm']) !!}  
                            {!! Form::close() !!}
                            
                        </td>
                    </tr>
                @endforeach    
            </tbody>
        </table>
        {{ $cars->links("pagination::bootstrap-4") }}
@endsection

