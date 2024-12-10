<style>
    .carousel-img {
        width: 100%;
        height: auto;
        object-fit: cover;
        /* Memastikan gambar tetap proporsional */
        max-height: 600px;
        /* Batas tinggi slider */
    }

    .carousel-caption h5 {
        font-size: 1.5rem;
        font-weight: bold;
        color: #fff;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
    }

    .carousel-caption p {
        font-size: 1rem;
        color: #ddd;
        text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.7);
    }

    @media (max-width: 768px) {
        .carousel-img {
            max-height: 400px;
            /* Tinggi slider untuk layar tablet */
        }

        .carousel-caption h5 {
            font-size: 1.2rem;
        }

        .carousel-caption p {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 480px) {
        .carousel-img {
            max-height: 300px;
            /* Tinggi slider untuk layar kecil */
        }

        .carousel-caption h5 {
            font-size: 1rem;
        }

        .carousel-caption p {
            font-size: 0.8rem;
        }
    }
</style>
<div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
        @foreach ($sliders as $index => $slider)
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="{{$index}}" class="{{$index === 0 ? 'active' : ''}}" aria-current="true" aria-label="Slide {{$index + 1}}"></button>
        @endforeach
    </div>

    <div class="carousel-inner">
        @foreach ($sliders as $index => $slider)
        <div class="carousel-item {{$index === 0 ? 'active' : ''}}">
            <img src="{{asset('storage/images/')}}/{{$slider->image}}" class="d-block w-100 carousel-img" alt="Slide {{$index + 1}}" />
            <div class="carousel-caption d-none d-md-block">
                <h5>{{$slider->title}}</h5>
                <p>{{$slider->description}}</p>
            </div>
        </div>
        @endforeach
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>