<div class="portfolio-us mt-5">
    <div class="container">
        <div class="title-container">
            <h2 class="text-center fw-bold">GALLERY</h2>
        </div>
        <div class="row mt-4">
            <div class="col-md-12 d-flex justify-content-center">
                <ul class="list-unstyled d-flex portfolio-filters">
                    <li data-filter="*" class="py-2 px-4 filter-active text-white">ALL</li>
                    <li data-filter=".filter-web" class="py-2 px-4">Event</li>
                    <li data-filter=".filter-design" class="py-2 px-4">Latihan</li>
                    <li data-filter=".filter-photo" class="py-2 px-4">UKT</li>
                </ul>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-md-12">
                <div class="mansory portfolio-container">
                    <div class="mansory-sizer"></div>
                    @foreach ($gallery as $gallery)
                    <div class="mansory-item m-2 portfolio-item filter-web">
                        <img src="{{asset('storage/images/')}}/{{$gallery->image}}" alt="" class="img-fluid" />
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>