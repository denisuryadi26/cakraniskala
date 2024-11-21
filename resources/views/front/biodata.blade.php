<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="shortcut icon" href="favicon/favicon.ico">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('portfolio_company/assets/vendor/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- fontawesome -->
    <link rel="stylesheet" href="{{asset('portfolio_company/assets/vendor/fontawesome/css/all.min.css')}}">
    <!-- aos -->
    <link rel="stylesheet" href="{{asset('portfolio_company/assets/vendor/aos/dist/aos.css')}}">
    <!-- custom css -->
    <link rel="stylesheet" href="{{asset('portfolio_company/assets/css/style.css')}}">

    <style>

    </style>


    <title>Biodata</title>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow shadow-sm fixed-top fy-3">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#"><span class="primary">COM</span>PANY</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link fw-bolder" href="/">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link fw-bolder dropdown-toggle active" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            About
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="about">About Us</a></li>
                            <li><a class="dropdown-item" href="pengurus">Pengurus</a></li>
                            <li>
                                <a class="dropdown-item" href="testimonials">Testimonials</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bolder" href="services">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bolder" href="gallery">Gallery</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bolder" href="contact">Contact</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link fw-bolder" href="login">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- end navbar -->

    <!-- breadcumbs  -->
    <div class="breadcumbs py-2">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center text-white">
                <h2>Biodata</h2>
                <ol class="d-flex list-unstyled">
                    <li>Home</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- end breadcumbs -->

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h3>Informasi Pribadi</h3>

                <div class="row gutters-sm">
                    <div class="col-md-4 mb-3">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-column align-items-center text-center">
                                    <img src="{{ asset('storage/images/'.$user->profile_picture) }}" alt="Admin" width="150">
                                    <div class="mt-3">
                                        <h4>{{ $user->fullname }}</h4>
                                        <p class="text-secondary mb-1">{{ $user->code }}</p>
                                        <hr>
                                        <p class="text-muted font-size-sm">Alamat : {!! nl2br(e($user->alamat)) !!}</p>
                                        <hr>
                                        <p class="text-muted font-size-sm">Sekretariat Pusat : Perum Bukit Waringin, Blok D 13 No 16 Rt 14 Rw 10
                                            Kec. Bojonggede Kab. Bogor, Jawa Barat 16922
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-md-8">
                        <div class="card mb-3">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Nama Lengkap</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->fullname }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">NIK</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->nik }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">No Hp</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->no_hp }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tempat Lahir</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->tempat_lahir }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Tanggal Lahir</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {{ $user->tgl_lahir }}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <h6 class="mb-0">Alamat</h6>
                                    </div>
                                    <div class="col-sm-9 text-secondary">
                                        {!! nl2br(e($user->alamat)) !!}
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <a class="btn btn-info " target="__blank" href="https://www.bootdey.com/snippets/view/profile-edit-data-and-skills">Login</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- footer -->
            <footer class="mt-5">
                <div class="footer-top bg-dark text-white p-5 ">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-3">
                                <h4 class="fw-bold">{{$contact->name}}</h2>
                                    <p>
                                        {{$contact->description}}
                                    </p>
                                    <strong>Phone</strong> : <span>{{$contact->telepon}} </span>
                                    <br />
                                    <strong>Email</strong> : <span>{{$contact->email}} </span>
                            </div>
                            <div class="col-md-2">
                                <h4 class="fw-bold">Our Services</h2>
                                    <ul class="list-group list-unstyled">
                                        @foreach($services as $service)
                                        <li class="list-item">
                                            <a href="" class="text-decoration-none text-white">
                                                <i class="fa fa-chevron-right primary"></i>
                                                {{$service->title}}
                                            </a>
                                        </li>
                                        @endforeach
                                    </ul>
                            </div>
                            <div class="col-md-2">
                                <h4 class="fw-bold">Useful Links</h2>
                                    <ul class="list-group list-unstyled">
                                        <li class="list-item">
                                            <a href="" class="text-decoration-none text-white">
                                                <i class="fa fa-chevron-right primary"></i>
                                                Home
                                            </a>
                                        </li>
                                        <li class="list-item">
                                            <a href="" class="text-decoration-none text-white">
                                                <i class="fa fa-chevron-right primary"></i>
                                                About Us
                                            </a>
                                        </li>
                                        <li class="list-item">
                                            <a href="" class="text-decoration-none text-white">
                                                <i class="fa fa-chevron-right primary"></i>
                                                Services
                                            </a>
                                        </li>
                                        <li class="list-item">
                                            <a href="" class="text-decoration-none text-white">
                                                <i class="fa fa-chevron-right primary"></i>
                                                Gallery
                                            </a>
                                        </li>
                                        <li class="list-item">
                                            <a href="" class="text-decoration-none text-white">
                                                <i class="fa fa-chevron-right primary"></i>
                                                Contact
                                            </a>
                                        </li>
                                    </ul>
                            </div>
                            <div class="col-md-3">
                                <h4 class="fw-bold">Join Our Newsletter</h2>
                                    <p>
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit.
                                    </p>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="yourmail@example.com" />
                                        <button class="btn btn-subscribe" type="button" id="inputGroupFileAddon04">
                                            Subscribe
                                        </button>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer-down bg-darker text-white px-5 py-3">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-1"></div>
                            <div class="col-md-5">
                                <div class="copyright">
                                    &copy; Copyright <strong>Company</strong>. All Right Reserved
                                </div>
                                <div class="credits">
                                    Design by me
                                </div>
                            </div>
                            <div class="col-md-5">
                                <div class="social-links float-end">
                                    <a href="" class="mx-2">
                                        <i class="fab fa-facebook fa-2x"></i>
                                    </a>
                                    <a href="" class="mx-2">
                                        <i class="fab fa-twitter fa-2x"></i>
                                    </a>
                                    <a href="" class="mx-2">
                                        <i class="fab fa-instagram fa-2x"></i>
                                    </a>
                                    <a href="" class="mx-2">
                                        <i class="fab fa-youtube fa-2x"></i>
                                    </a>
                                    <a href="" class="mx-2">
                                        <i class="fab fa-linkedin fa-2x"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            <!-- end footer  -->

            <!-- to top -->
            <a href="#" class="btn-to-top p-3">
                <i class="fa fa-chevron-up"></i>
            </a>
            <!-- end to top -->

            <script src="{{asset('portfolio_company/assets/vendor/jquery/jquery-3.6.0.min.js')}}"></script>
            <script src="{{asset('portfolio_company/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
            <script src="{{asset('portfolio_company/assets/vendor/fontawesome/js/all.min.js')}}"></script>
            <script src="{{asset('portfolio_company/assets/vendor/masonry/masonry.pkgd.min.js')}}"></script>
            <script src="{{asset('portfolio_company/assets/vendor/aos/dist/aos.js')}}"></script>
            <script src="{{asset('portfolio_company/assets/vendor/isotope/isotope.pkgd.min.js')}}"></script>
            <script src="{{asset('portfolio_company/assets/js/app.js')}}"></script>
            </body>

</html>