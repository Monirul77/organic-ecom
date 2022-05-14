@extends('layouts.fontend-master')
@section('content')

<!-- Hero Section Begin -->
<section class="hero hero-normal">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="hero__categories">
                    <div class="hero__categories__all">
                        <i class="fa fa-bars"></i>
                        <span>All Categories</span>
                    </div>
                    @php
                    $categoriess = App\Models\Category::where('status',1)->latest()->get();
                    @endphp
                    <ul>
                        @foreach ($categoriess as $row)
                        <li><a href="#">{{ $row->category_name }}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="hero__search">
                    <div class="hero__search__form">
                        <form action="#">
                            <div class="hero__search__categories">
                                All Categories
                                <span class="arrow_carrot-down"></span>
                            </div>
                            <input type="text" placeholder="What do yo u need?">
                            <button type="submit" class="site-btn">SEARCH</button>
                        </form>
                    </div>
                    <div class="hero__search__phone">
                        <div class="hero__search__phone__icon">
                            <i class="fa fa-phone"></i>
                        </div>
                        <div class="hero__search__phone__text">
                        <h5>+880-1647336747</h5>
                            <span>support 24/7 time</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Hero Section End -->

<!-- Breadcrumb Section Begin -->
<section class="breadcrumb-section set-bg" data-setbg="{{ asset('fontend') }}/img/breadcrumb.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>My Profile</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">Home</a>
                        <span>My Order Details</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End -->
<section class="shoping-cart spad">
    <div class="container">
        

        <div class="row mt-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Shipping First Name.</th>
                                    <th scope="col">Shipping Last Name</th>
                                    <th scope="col">Shipping Email</th>
                                    <th scope="col">Shipping Phone</th>
                                    <th scope="col">Shipping address</th>
                                    <th scope="col">Shipping state</th>
                                    <th scope="col">Shipping post_code</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $shipping->shipping_first_name }}</td>
                                    <td>{{ $shipping->shipping_last_name }}</td>
                                    <td>{{ $shipping->shipping_email }}</td>
                                    <td>{{ $shipping->shipping_phone }}</td>
                                    <td>{{ $shipping->address }}</td>
                                    <td>{{ $shipping->state }}</td>
                                    <td>{{ $shipping->post_code }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">Product Image</th>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product Code</th>
                                <th scope="col">Product Quantity</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orderitems as $item)
                            <tr>
                                <td>
                                    <img src="{{ asset($item->product->image_one) }}" height="60px;" width="60px;" alt="">
                                </td>
                                <td>{{ $item->product->product_name }}</td>
                                <td>{{ $item->product->product_code }}</td>
                                <td>{{ $item->product_qty }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
@endsection