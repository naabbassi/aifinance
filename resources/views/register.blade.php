<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>AIF :: Registeration</title>
  <!-- General CSS Files -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- Template CSS -->
  <link rel="stylesheet" href="/css/style.css">
  <link rel="stylesheet" href="/css/components.css">
</head>
<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-8 offset-lg-2 col-xl-8 offset-xl-2">
            <div class="login-brand">
              <h3>AI Finance</h3>
            </div>

            <div class="card card-primary">
              <div class="card-header"><h4>Register</h4></div>

              <div class="card-body">
                <form method="POST" action="/newmember">
                  @csrf
                  <input type="hidden" name="owner" value="{{ $email}}">
                  <div class="row">
                    <div class="form-group col-6">
                      <label for="name">First Name</label>
                      <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" autofocus>
                      @error('name')
                        <small class="form-text text-danger ">{{ $message }}</small>
                       @enderror
                    </div>
                    <div class="form-group col-6">
                      <label for="family">Last Name</label>
                      <input id="family" type="text" class="form-control" name="family" value="{{ old('family') }}">
                      @error('family')
                        <small class="form-text text-danger ">{{ $message }}</small>
                       @enderror
                    </div>
                  </div>
                  <div class="row">
                      <div class="form-group col-6">
                          <label >Birthday</label>
                          <input type="date" name="birthday" class="form-control" value="{{ old('birthday') }}">
                          @error('birthday')
                        <small class="form-text text-danger ">{{ $message }}</small>
                       @enderror
                        </div>
                    <div class="form-group col-6">
                        <label >Gender</label>
                        <select class="form-control selectric" name="sex">
                            <option value="m">Man</option>
                            <option value="w">Woman</option>
                          </select>
                          @error('sex')
                            <small class="form-text text-danger ">{{ $message }}</small>
                          @enderror
                      </div>
                    </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">
                        @error('email')
                        <small class="form-text text-danger">{{ $message }}</small>
                       @enderror
                  </div>

                  <div class="row">
                    <div class="form-group col-6">
                      <label for="password" class="d-block">Password</label>
                      <input  type="password" class="form-control " autocomplete="off"  name="password">
                      @error('password')
                        <small class="form-text text-danger ">{{ $message }}</small>
                       @enderror
                    </div>
                    <div class="form-group col-6">
                      <label class="d-block">Password Confirmation</label>
                      <input type="password" class="form-control" name="password_confirmation">
                      @error('password_confirmation')
                        <small class="form-text text-danger ">{{ $message }}</small>
                      @enderror
                    </div>
                  </div>
                  <div class="row">
                    <div class="form-group col-6">
                      <label>Country</label>
                      <select class="form-control selectric" name="country">
                        @foreach ($countries as $item)
                        <option @if($item->id == old('country')) selected @endif value={{$item->id}}>{{$item->name}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="form-group col-6">
                        <label>Phone</label>
                        <input type="text" name="phone" class="form-control" value="{{ old('phone') }}">
                        @error('phone')
                        <small class="form-text text-danger ">{{ $message }}</small>
                       @enderror
                      </div>
                  </div>

                  <div class="form-group">
                    <div class="custom-control custom-checkbox">
                      <input type="checkbox" name="agree" class="custom-control-input" id="agree">
                    <label class="custom-control-label" for="agree">I agree with the  <a href="{{ route('home')}}/conditions">terms and conditions </a></label>
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                      Register
                    </button>
                  </div>
                </form>
              </div>
            </div>
            <div class="simple-footer">
                Copyright © {{ date("Y") }}<div class="bullet"></div> AI Finance</a>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
  @if ($errors->any())
@endif
  <!-- General JS Scripts -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
  <script src="/js/stisla.js"></script>

  <!-- Template JS File -->
  <script src="/js/scripts.js"></script>
  <script src="/js/custom.js"></script>

  <!-- Page Specific JS File -->
</body>
</html>
