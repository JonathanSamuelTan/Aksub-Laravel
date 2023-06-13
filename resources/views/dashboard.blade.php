<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formula 1 Teams</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- F1 Font -->
    
  </head>
  <body>
    <div class="container">
      <h1 class="text-center my-5">Formula 1 Grid 2023</h1>
      @if(Auth::user()->role == 'admin')
      <div class="d-flex justify-content-end mb-3">
        <a href="#" class="btn btn-success" data-toggle="modal" data-target="#addDriverModal" >Create New Data</a>
      </div>
      @endif

      {{-- Add Driver Modal --}}
      <!-- Modal container element -->
    <div class="modal fade" id="addDriverModal" tabindex="-1" role="dialog" aria-labelledby="addDriverModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!-- Modal header -->
            <div class="modal-header">
            <h5 class="modal-title" id="addDriverModalLabel">Add Driver</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
    
            <!-- Modal body with form -->
            <div class="modal-body">
            <form method="post" action="{{route('store')}}" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                <label for="teamInput">Team</label>
                <input type="text" class="form-control" id="teamInput" name="team" required>
                </div>
                <div class="form-group">
                <label for="nameInput">Name</label>
                <input type="text" class="form-control" id="nameInput" name="name" required>
                </div>
                
                {{-- Image upload --}}
                <div class="form-group">
                  <label for="nameInput">Picture</label>
                  <input type="file" class="form-control" id="nameInput" name="picture" required>
                </div>

            </div>
    
            <!-- Modal footer with submit button -->
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Add Driver</button>
            </div>
            </form>
        </div>
        </div>
    </div>


      <table class="table table-striped">
        <thead>
          <tr>
            <th>Team</th>
            <th>Driver</th>
            <th>Picture</th>
            @if(Auth::user()->role == 'admin')
            <th>Action</th>
            @endif
          </tr>
        </thead>
        <tbody>
        @foreach($drivers as $driver)
          <tr>
            <td>{{$driver->team}}</td>
            <td>{{$driver->name}}</td>
            <td><img src="{{ asset('storage/img/'.$driver->picture) }}" alt="image" width="100px" height="100px"></td>
            @if(Auth::user()->role == 'admin')
            <td>
                <form action="{{ route('delete', $driver->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#editDriverModal{{ $driver->id }}">
                        Edit
                    </a>
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>

                <!-- Modal container element -->
                <div class="modal fade" id="editDriverModal{{ $driver->id }}" tabindex="-1" role="dialog" aria-labelledby="editDriverModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <!-- Modal header -->
                            <div class="modal-header">
                                <h5 class="modal-title" id="editDriverModalLabel">Edit Driver</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                
                            <!-- Modal body with form -->
                            <div class="modal-body">
                                <form method="post" action="{{ route('update', $driver->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="teamInput">Team</label>
                                        <input type="text" class="form-control" id="teamInput" name="team" value="{{ $driver->team }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="nameInput">Name</label>
                                        <input type="text" class="form-control" id="nameInput" name="name" value="{{ $driver->name }}">
                                    </div>
                                    {{-- display current img --}}
                                    <img src="{{ asset('storage/img/'.$driver->picture) }}" alt="image" width="100px" height="100px">
                                    {{-- Image upload --}}
                                    <div class="form-group">
                                      <label for="nameInput">Picture</label>
                                      <input type="file" class="form-control" id="nameInput" name="picture">
                                    </div>
                                    
                            </div>
                
                            <!-- Modal footer with submit button -->
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </td>
            @endif
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  </body>
</html>
