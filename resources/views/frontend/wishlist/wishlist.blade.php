@extends('frontend.layouts.home_master')
@section('frontendContent')
    <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>Wishlist</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="#">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Wishlist Section Start -->
    <section class="wishlist-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-3 g-2">
                @if (count($wishlists) > 0)
                    @foreach ($wishlists as $wishlist)
                        <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain">
                            <div class="product-box-3 h-100">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a href="{{ route('product.details', $wishlist->product->slug) }}">
                                            <img src="{{ asset('public/images/product/' . $wishlist->product->thumbnail) }}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>
                                        <div class="product-header-top">
                                            <button class="btn wishlist-button close_button removeWishList"
                                                data-wishlistid="{{ $wishlist->id }}">
                                                <i data-feather="x"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-footer">
                                    <div class="product-detail">
                                        <span class="span-name">{{ $wishlist->product->name }}</span>
                                        <a href="#">
                                        </a>
                                        <h6 class="unit mt-1">Size: {{ $wishlist->product->size }}</h6>
                                        <h5 class="price">
                                            <span class="theme-color">${{ $wishlist->product->final_sell_price }}</span>
                                            @if ($wishlist->product->discount)
                                                <del>${{ $wishlist->product->sell_price }}</del>
                                            @endif
                                        </h5>
                                        <div class="add-to-cart-box bg-white mt-2">
                                            <div class="add-to-cart-box bg-white">
                                                <a class="btn btn-add-cart addcart-button button-add-to-cart"
                                                    data-product_id="{{ $wishlist->product_id }}" href="#">Add to Cart
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="image" style="display: flex;justify-content: center;">
                        <img style="width:60% !important;height:484px !important;object-fit: contain;"
                            src="{{ asset('public/empty-cart.png') }}" />
                    </div>
                @endif
            </div>
        </div>
    </section>
    <!-- Wishlist Section End -->
    <script>
        $(document).ready(function() {
            $('.removeWishList').on('click', function() {
                var wishlistID = $(this).data('wishlistid');
                $.ajax({
                    url: "{{ route('delete.wishlist') }}",
                    type: "POST",
                    data: {
                        id: wishlistID,
                        _token: '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(result) {
                        if (result) {
                            $('#wishlist-total').text(result.wishlist_total);

                            $.notify({
                                icon: "fa fa-check",
                                title: "Success!",
                                message: "Item Successfully added to Wishlist",
                            }, {
                                element: "body",
                                position: null,
                                type: "info",
                                allow_dismiss: true,
                                newest_on_top: false,
                                showProgressbar: true,
                                placement: {
                                    from: "top",
                                    align: "right",
                                },
                                offset: 20,
                                spacing: 10,
                                z_index: 1031,
                                delay: 5000,
                                animate: {
                                    enter: "animated fadeInDown",
                                    exit: "animated fadeOutUp",
                                },
                                icon_type: "class",
                                template: '<div data-notify="container" class="col-xxl-3 col-lg-5 col-md-6 col-sm-7 col-12 alert alert-{0}" role="alert">' +
                                    '<button type="button" aria-hidden="true" class="btn-close" data-notify="dismiss"></button>' +
                                    '<span data-notify="icon"></span> ' +
                                    '<span data-notify="title">{1}</span> ' +
                                    '<span data-notify="message">{2}</span>' +
                                    '<div class="progress" data-notify="progressbar">' +
                                    '<div class="progress-bar progress-bar-info progress-bar-{0}" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" style="width: 0%;"></div>' +
                                    "</div>" +
                                    '<a href="{3}" target="{4}" data-notify="url"></a>' +
                                    "</div>",
                            });
                            // toastr.success(result.success);
                        }
                    }
                });
            });
        });
    </script>
@endsection
