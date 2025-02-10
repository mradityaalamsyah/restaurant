<x-layout2>

    <!-- Hero Start -->
    <div class="container-fluid parallax">
        <div id="carouselindikator" class="carousel slide" data-bs-ride="carousel" data-bs-interval="4000"
            style="padding-top: 6rem;">
            <div class="carousel-inner">
                @foreach ($imghomes as $index => $imghome)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <img src="{{ Storage::url($imghome->imghome) }}" class="d-block w-100">
                    </div>
                @endforeach
            </div>

            <!-- Indicators -->
            <ol class="carousel-indicators">
                @foreach ($imghomes as $index => $imghome)
                    <li data-bs-target="#carouselindikator" data-bs-slide-to="{{ $index }}"
                        class="{{ $index === 0 ? 'active' : '' }}" style="border-radius: 50%; width: 8px; height: 8px;">
                    </li>
                @endforeach
            </ol>
        </div>
    </div>

    <!-- Hero End -->


    <!-- Featurs Section Start -->
    <div class="container-fluid featurs pt-3 pb-3">
        <div class="pt-3 pb-3">
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 fe mx-auto">
                            <i class="fas fa-utensils fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>All Menu</h5>
                            <p class="mb-0">Free on order over $300</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 fe mx-auto">
                            <i class="fas fa-shopping-cart fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>30 Day Return</h5>
                            <p class="mb-0">30 day money guarantee</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 fe mx-auto">
                            <i class="fas fa-user-shield fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>Security Payment</h5>
                            <p class="mb-0">100% security payment</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="featurs-item text-center rounded bg-light p-4">
                        <div class="featurs-icon btn-square rounded-circle bg-secondary mb-5 fe mx-auto">
                            <i class="fa fa-phone-alt fa-3x text-white"></i>
                        </div>
                        <div class="featurs-content text-center">
                            <h5>24/7 Support</h5>
                            <p class="mb-0">Support every time fast</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Featurs Section End -->


    <!-- Banner Section Start-->
    <div class="container-fluid banner bg-secondary my-5">
        <div class="container py-5 ba">
            <div class="row g-4 align-items-center">
                <div class="col-lg-6">
                    <div class="py-4">
                        <h1 class="display-3 text-white">Javanese restaurant</h1>
                        <p class="fw-normal display-3 text-dark mb-4 mt-5 j">in Our Store</p>
                        <p class="mb-4 text-dark">The generated Lorem Ipsum is therefore always free from repetition
                            injected humour, or non-characteristic words etc.</p>
                        {{-- <a href="#"
                            class="banner-btn btn border-2 border-white rounded-pill text-dark py-3 px-5">BUY</a> --}}
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="position-relative im">
                        <img src="img/best.png" class="img-fluid w-100 no1 rounded" alt="">
                        <div class="d-flex align-items-center justify-content-center bg-white rounded-circle position-absolute"
                            style="width: 140px; height: 140px; top: 0; left: 0;">
                            <h1 style="font-size: 100px;">1</h1>
                            <div class="d-flex flex-column">
                                <span class="h2">No.</span>
                                <span class="h4 text-muted">St</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner Section End -->
</x-layout2>
