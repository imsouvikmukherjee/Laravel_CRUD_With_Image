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
<marquee class="bg-primary text-white" >It's a simple laravel project of CRUD operation, where used some functionality like form validation, change status, multiple delete options, paginations, edit records with a preview of specific image, and so on.</marquee>

    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-4"></div>
            <div class="col-sm-4">
                <h2 class="text-center text-info my-4">{{$heading}}</h2>


                {{-- Start register form --}}

                <form action="{{$url}}" method="POST" enctype="multipart/form-data">
                    @csrf


                    @if ($errors->any())
                    <div class="alert alert-danger" role="alert">
                        @foreach ($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </div>
                @endif

                    <div class="form-floating mb-3">
                        <input type="text" class="form-control @error('name') is-invalid

                        @enderror" id="floatingPassword" value="{{old('name')}}"" name="name" placeholder="Name here">
                        <label for="floatingPassword">Fullname</label>
                      </div>

                     <div class="form-floating mb-3">

                        <input type="email" class="form-control @error('email') is-invalid

                        @enderror" id="floatingInput" name="email" value="{{old('email')}}" placeholder="name@example.com">
                        <label for="floatingInput">Email address</label>
                      </div>

                      <div class="form-floating mb-3">
                        <input type="file" class="form-control @error('image') is-invalid

                        @enderror" id="floatingInput" name="image"  placeholder="name@example.com">

                      </div>

                      <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('password') is-invalid

                        @enderror" id="floatingInput" name="password" placeholder="name@example.com">
                        <label for="floatingInput">Password</label>
                      </div>

                      <div class="form-floating mb-3">
                        <input type="password" class="form-control @error('confirm_password') is-invalid

                        @enderror" id="floatingInput" name="confirm_password" placeholder="name@example.com">
                        <label for="floatingInput">Confirm Password</label>
                      </div>

                      <button class="btn btn-primary d-block mx-auto px-3">{{$btn}}</button>

                </form>

                {{-- End register form --}}

            </div>
            <div class="col-sm-4">
                <a href="{{route('employee.view')}}" class="btn btn-info mt-5"><i class="bi bi-view-stacked"></i> View User</a>
            </div>
        </div>
    </div>



    <!-- Footer -->
    <footer class="page-footer font-small blue pt-4">
<!-- Copyright -->
        <div class="footer-copyright text-center py-3">?? Created By:
        <a href="https://www.facebook.com/ImSouvikMukherjee" style="text-decoration: none" class="text-muted"> Souvik Mukherjee</a>
        </div>
    <!-- Copyright -->
    </footer>
  <!-- Footer -->

    <!-- Bootstrap JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
  </body>
</html>
