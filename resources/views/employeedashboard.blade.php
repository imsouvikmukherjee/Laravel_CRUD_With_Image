<!doctype html>
<html lang="en">
  <head>
    <title>{{$title}}</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS v5.2.0-beta1 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css"  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
  </head>
  <body>

        <div class="container">
            <div class="row">
                <div class="col-sm-12">

<h2 class="text-center text-info mt-3">Manage Records</h2>
{{-- start success message --}}

@if (Session::get('success'))
<div class="alert alert-success text-center" style="font-weight: bold" role="alert">
    {{ Session::get('success')}}
  </div>
@endif


    <form action="{{route('multiple.delete')}}" method="post">
        @csrf
    <table class="table table-hover text-center mt-3" style="overflow-x: auto; width:100%">

        <a href="{{route('view.form')}}" class="btn btn-dark m-2 btn-sm"><i class="bi bi-plus-circle"></i> Add User</a>
        <button type="submit" class="btn btn-danger m-1 btn-sm"><i class="bi bi-trash3-fill"></i> Trash </button>
        <thead class="table-secondary">
          <tr>
            <th scope="col">Select</th>
            <th scope="col" >Sr.</th>
            <th scope="col" >Fullname</th>
            <th scope="col" >Email</th>
            <th scope="col" >Image</th>
            <th scope="col" >Status</th>
            <th scope="col" >Action</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($records as $key => $record)
            <tr>
                <td><input type="checkbox" class="form-check-input" id="checkone" value="{{encrypt($record['id'])}}" name="id[]"></td>
                <td scope="row">{{$key+1}}</td>
                <td>{{$record['name']}}</td>
                <td>{{$record['email']}}</td>
                <td><img src="{{url('public/uploads/'.$record['image'])}}" class="rounded-circle" width="100px" height="80px"></td>

                <td>
                    @if ($record['status'] == 1)
                        <span class="text-muted  px-2  rounded" style="text-decoration: none; "> <i class="bi bi-circle-fill" style="color: #4cd137"></i> Active</span>
                    @else
                    <span class=" text-muted px-2  rounded " style="text-decoration: none;"> <i class="bi bi-circle-fill text-warning"></i> Inative</span>

                    @endif
                </td>


                <td><a href="{{route('employee.status',['id' => encrypt($record['id'])])}}" class="btn btn-primary btn-sm"><i class="bi bi-toggles"></i> Status</a>
                <button type="button" value="{{encrypt($record['id'])}}" class="btn btn-danger btn-sm deletebutton"><i class="bi bi-trash3-fill"></i> Trash</button>
                <a href="{{route('employee.edit',['id' => encrypt($record['id'])])}}" class="btn btn-primary btn-sm"><i class="bi bi-pencil-square"></i> Edit</a>  </td>
              </tr>
            @endforeach




        </tbody>
      </table>

    </form>

      {{$records->links('pagination::bootstrap-5')}}


    <!--Normal delete Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header bg-warning">
          <h5 class="modal-title " id="exampleModalLabel"> </h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
            <form action=" {{route('employee.delete')}}" action="post">
                <div class="modal-body">
                    <h1 class="text-center" style="font-size: 60px"><i class="bi bi-exclamation-diamond-fill text-warning"></i></h1>
                    <h5 class="text-center">Are you sure you want to delete this record?</h5>
                    <input type="hidden" name="user_delete_id" id="user_delete_id">
                  <p class="text-muted text-center">Once a record is deleted you can never get it back</p>
                </div>

        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-danger">Confirm</button>
        </div>
    </form>
      </div>
    </div>
  </div>

  {{-- End Normal Delete Modal --}}
                </div>
            </div>
        </div>


         <!-- Footer -->
    <footer class="page-footer font-small blue pt-4">
    <!-- Copyright -->
        <div class="footer-copyright text-center py-3">© Created By:
          <a href="https://www.facebook.com/ImSouvikMukherjee" style="text-decoration: none" class="text-muted"> Souvik Mukherjee</a>
        </div>
        <!-- Copyright -->
    </footer>
      <!-- Footer -->


    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

    <script>
        $(document).ready(function(){

            $(document).on('click', '.deletebutton', function(){

                var user_id = $(this).val();
                $('#deleteModal').modal('show');
                $('#user_delete_id').val(user_id);
            })
        })
    </script>

</body>
</html>
