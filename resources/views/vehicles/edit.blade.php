@extends('../vehicles/layout')

@section('body')
        <div class="col-lg-6">
            <div class="">
                <img class="image-size" src={{ asset('/storage/cars/' . $car->image) }} />
            </div>
        </div>
        <div class="col-lg-4 col-xs-pull-6">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            {{--
                Descriptions
                 Forms Starts
                 Controller : Get : 
                              Post : Store
                              File Name : CarController 
             --}}

            {!! Form::open ([ 'route' => ['cars.update',  $car->id ], 'method' => 'put', 'enctype' => 'multipart/form-data' ]) !!}
                
                {{-- Csrf Token for security  --}}

                {!! Form::token() !!}
                <div class = "form-group">
                    {!! Form::label('name', 'Name : ', ['class' => 'awesome']) !!}
                    {!! Form::text('name', $car->name, ['class' => 'form-control', 'placeholder' => 'Enter Name']) !!}
                </div>
                <div class = "form-group">
                    {!! Form::label('email', 'E-Mail Address : ', ['class' => 'awesome']) !!}
                    {!! Form::email('email', $car->email, ['class' => 'form-control', 'placeholder' => 'Enter Email']) !!}
                </div>
                <div class="form-group">
                    {!! Form::label('Image', 'Enter Image : ', ['class' => 'awesome']) !!}
                    {!! Form::file('image') !!}
                </div>
                <div class = "form-group">
                    {!! Form::button('Submit', [ 'type' => 'submit','class' => 'btn btn-primary form-control']) !!}
                </div>
            {!! Form::close() !!}
        </div>

    
@endsection