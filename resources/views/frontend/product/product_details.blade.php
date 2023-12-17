@extends('frontend.layouts.home_master')
@section('frontendContent')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend/custom/product/product.css') }}">
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>{{ $data->name }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Details</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Product Left Sidebar Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-2">
                                    <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                        <div class="product-main-2 no-arrow">
                                            @foreach ($data->galleries as $img)
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="{{ asset('public/images/product/' . $img->image) }}"
                                                            id="img-1"
                                                            data-zoom-image="{{ asset('public/images/product/' . $img->image) }}"
                                                            class="img-fluid image_zoom_cls-0 blur-up lazyload"
                                                            alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                        <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                            @foreach ($data->galleries as $img)
                                                <div>
                                                    <div class="sidebar-image">
                                                        <img src="{{ asset('public/images/product/' . $img->image) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="right-box-contain">
                                @if ($data->discount)
                                    <h6 class="offer-top">{{ $data->discount }}% off</h6>
                                @endif
                                <h2 class="name">{{ $data->name }}</h2>
                                <div class="price-rating">
                                    <h3 class="theme-color price">${{ $data->final_sell_price }}
                                        @if ($data->discount)
                                            <del class="text-content">${{ $data->sell_price }}</del>
                                            <span class="offer theme-color">{{ $data->discount }}% off</span>
                                        @endif
                                    </h3>
                                    <div class="product-rating custom-rate">
                                        <ul class="rating">
                                            @for ($i = 0; $i < $data->avg_rating; $i++)
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                            @endfor
                                            @for ($i = 0; $i < 5 - $data->avg_rating; $i++)
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            @endfor
                                        </ul>
                                        <span class="review">{{ $data->total_raters }} Customer Review </span>
                                    </div>
                                </div>
                                <div class="procuct-contain">
                                    <p>
                                        <?php
                                        $description = strip_tags($data->description);
                                        $words = str_word_count($description, 2);
                                        $limit = 20;
                                        $first10Words = implode(' ', array_slice($words, 0, $limit));
                                        echo $first10Words . (count($words) > $limit ? '...' : '');
                                        ?>
                                    </p>
                                </div>
                                @if (!$varient == null)
                                    <div class="product-packege">
                                        <div class="product-title">
                                            <h4>Colors</h4>
                                        </div>
                                        <ul class="select-packege">
                                            @foreach ($varient as $var)
                                                <a href="{{ route('product.details', $var->slug) }}">
                                                    <li>
                                                        <img src="{{ asset('public/images/product/' . $var->color_image) }}"
                                                            width="50px" height="50px" class="rounded-circle lazyload"
                                                            alt="">
                                                    </li>
                                                </a>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <div class="time deal-timer product-deal-timer mx-md-0 mx-auto" id="clockdiv-1"
                                    data-hours="1" data-minutes="2" data-seconds="3">
                                    <div class="product-title">
                                        <h4>Hurry up! Sales Ends In</h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="days d-block">
                                                    <h5>1</h5>
                                                </div>
                                                <h6>Days</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="hours d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Hours</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="minutes d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Min</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="seconds d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Sec</h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="note-box product-packege">
                                    <div class="cart_qty qty-box product-qty">
                                        <div class="input-group">
                                            <button type="button" class="qty-left-minus " data-type="minus" data-field="">
                                                <i class="fa fa-minus" aria-hidden="true"></i>
                                            </button>
                                            <input class="form-control input-number qty-input qty-val" type="text"
                                                readonly name="quantity" value="1">
                                            <button type="button" class="qty-right-plus " data-type="plus" data-field="">
                                                <i class="fa fa-plus" aria-hidden="true"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <button data-product_id="{{ $data->id }}"
                                        class="btn btn-md bg-dark cart-button text-white w-100 button-add-to-cart">Add To
                                        Cart</button>
                                </div>
                                <div class="buy-box">
                                    <a href="#">
                                        <i data-feather="heart"></i>
                                        <span>Add To Wishlist</span>
                                    </a>
                                    <a href="#">
                                        <i data-feather="shuffle"></i>
                                        <span>Add To Compare</span>
                                    </a>
                                </div>
                                <div class="pickup-box">
                                    <div class="product-title">
                                        <h4>Store Information</h4>
                                    </div>
                                    <div class="product-info">
                                        <ul class="product-info-list product-info-list-2">
                                            <li>Size : <a href="javascript:void(0)">{{ $data->size }}</a></li>
                                            <li>Color : <a href="javascript:void(0)">{{ $data->color }}</a></li>
                                            <li>Category : <a
                                                    href="javascript:void(0)">{{ $data->cat_id ? $data->category->name : 'N/A' }}</a>
                                            </li>
                                            <li>Sub-Category : <a
                                                    href="javascript:void(0)">{{ $data->sub_cat_id ? $data->subCategory->name : 'N/A' }}</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="paymnet-option">
                                    <div class="product-title">
                                        <h4>Guaranteed Safe Checkout</h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/1.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/2.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/3.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/4.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">
                                                <img src="https://themes.pixelstrap.com/fastkart/assets/images/product/payment/5.svg"
                                                    class="blur-up lazyload" alt="">
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="product-section-box">
                                <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                            data-bs-target="#description" type="button" role="tab"
                                            aria-controls="description" aria-selected="true">Description</button>
                                    </li>
                                    @if(count($data->review)>0)
                                      <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                            data-bs-target="#review" type="button" role="tab"
                                            aria-controls="review" aria-selected="false">Review</button>
                                    </li>
                                    @endif
                                </ul>
                                <div class="tab-content custom-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="description" role="tabpanel"
                                        aria-labelledby="description-tab">
                                        <div class="product-description">
                                            <div class="nav-desh">
                                                <p>
                                                    @php
                                                        echo $data->description;
                                                    @endphp
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="review" role="tabpanel"
                                        aria-labelledby="review-tab">
                                        <div class="review-box">
                                            <div class="row g-4">
                                                <div class="col-12">
                                                    <div class="review-title">
                                                        <h4 class="fw-500">Customer Reviews</h4>
                                                    </div>
                                                    <div class="review-people">
                                                        <ul class="review-list">
                                                            @foreach ($data->review as $review)
                                                                <li>
                                                                    <div class="people-box">
                                                                        <div>
                                                                            <div class="people-image">
                                                                                <img src="{{ asset('public/images/review/' . $review->image) }}"
                                                                                    class="img-fluid blur-up lazyload"
                                                                                    alt="">
                                                                            </div>
                                                                        </div>
                                                                        <div class="people-comment">
                                                                            <a class="name"
                                                                                href="javascript:void(0)">{{ $review->user->name }}</a>
                                                                            <div class="date-time">
                                                                                <h6 class="text-content">
                                                                                    {{ $review->created_at }}</h6>
                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        @for ($i = 0; $i < $review->rating; $i++)
                                                                                            <li>
                                                                                                <i data-feather="star"
                                                                                                    class="fill"></i>
                                                                                            </li>
                                                                                        @endfor
                                                                                        @for ($i = 0; $i < 5 - $review->rating; $i++)
                                                                                            <li>
                                                                                                <i data-feather="star"></i>
                                                                                            </li>
                                                                                        @endfor
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <div class="reply">
                                                                                <p>
                                                                                    {{ $review->description }}
                                                                                </p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                    <div class="right-sidebar-box">
                        <!-- Trending Product   -->
                        <div class="pt-25">
                            <div class="category-menu">
                                <h3>Trending Products</h3>
                                <ul class="product-list product-right-sidebar border-0 p-0">
                                    @foreach ($trending as $trend)
                                        <li>
                                            <div class="offer-product">
                                                <a href="{{ route('product.details', $trend->slug) }}"
                                                    class="offer-image">
                                                    <img src="{{ asset('public/images/product/' . $trend->thumbnail) }}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <div class="offer-detail">
                                                    <div>
                                                        <a href="{{ route('product.details', $trend->slug) }}">
                                                            <h6 class="name">{{ $trend->name }}</h6>
                                                        </a>
                                                        <h5 class="price"><span
                                                                class="theme-color">${{ $trend->final_sell_price }}</span>
                                                            @if ($trend->discount)
                                                                <del>${{ $trend->sell_price }}</del>
                                                            @endif
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!-- Banner Section -->
                        <div class="ratio_156 pt-25">
                            @if ($productBanner)
                                <div class="home-contain">
                                    <img src="{{ asset('public/images/banner/' . $productBanner->banner) }}"
                                        class="bg-img blur-up lazyload" alt="">
                                    <div class="home-detail p-top-left home-p-medium">
                                        <div>
                                            <h6 class="text-yellow home-banner">{{ $productBanner->special_text }}</h6>
                                            <h3 class="text-uppercase fw-normal"><span
                                                    class="theme-color fw-bold">{{ $productBanner->header_text }}</span>
                                            </h3>
                                            <h3 class="fw-light">{{ $productBanner->short_desc }}</h3>
                                            <button onclick="window.open('{{ $productBanner->link }}', '_blank');"
                                                class="btn btn-animation btn-md fw-bold mend-auto">Shop Now <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="home-contain">
                                    <img src="{{ asset('public/frontend/assets/images/vegetable/banner/8.jpg') }}"
                                        class="bg-img blur-up lazyload" alt="">
                                    <div class="home-detail p-top-left home-p-medium">
                                        <div>
                                            <h6 class="text-yellow home-banner">Seafood</h6>
                                            <h3 class="text-uppercase fw-normal"><span
                                                    class="theme-color fw-bold">Freshes</span> Products</h3>
                                            <h3 class="fw-light">every hour</h3>
                                            <button onclick="location.href = '{{route('home')}}';"
                                                class="btn btn-animation btn-md fw-bold mend-auto">Shop Now <i
                                                    class="fa-solid fa-arrow-right icon"></i></button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Releted Product Section Start -->
    <section class="product-list-section section-b-space">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Related Products</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-6_1 product-wrapper">
                        @foreach ($related_products as $product)
                            <div>
                                <div class="product-box-3 h-100 wow fadeInUp">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="{{ route('product.details', $product->slug) }}">
                                                <img src="{{ asset('public/images/product/' . $product->thumbnail) }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>
                                            <ul class="product-option" style="justify-content:space-evenly;width:126px;">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="{{ route('product.details', $product->slug) }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="javascript:void(0)" data-id="{{ $product->id }}"
                                                        class="notifi-wishlist-custom custom-list wishlist-class">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">
                                                @if ($product->cat_id)
                                                    {{ $product->category->name }}
                                                @endif
                                            </span>
                                            <a href="{{ route('product.details', $product->slug) }}">
                                                <h5 class="name">{{ $product->name }}</h5>
                                            </a>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    @for ($i = 0; $i < $product->avg_rating; $i++)
                                                        <li>
                                                            <i data-feather="star" class="fill"></i>
                                                        </li>
                                                    @endfor
                                                    @for ($i = 0; $i < 5 - $product->avg_rating; $i++)
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                    @endfor
                                                </ul>
                                                <span>({{ $product->total_raters }})</span>
                                                @if ($product->discount)
                                                    <strong
                                                        style="color: green;margin-left:4px;">({{ $product->discount }}%
                                                        off)</strong>
                                                @endif
                                            </div>
                                            <h6 class="unit">Size:{{ $product->size }}</h6>
                                            <h5 class="price"><span
                                                    class="theme-color">${{ $product->final_sell_price }}</span>
                                                @if ($product->discount)
                                                    <del>${{ $product->sell_price }}</del>
                                                @endif
                                            </h5>
                                            <div class="add-to-cart-box bg-white">
                                                <a class="btn btn-add-cart addcart-button"
                                                    href="{{ route('product.details', $product->slug) }}">Details
                                                    <span class="add-icon bg-light-gray">
                                                        <i data-feather="eye"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
