<section class="food_section layout_padding-bottom">
    <div class="container" x-data="{ tab: 1 }">
        <div class="heading_container heading_center">
            <h2>
                منو محصولات
            </h2>
        </div>

        <ul class="filters_menu">
            <li :class="tab === 1 ? 'active' : ''" @click="tab = 1">برگر</li>
            <li :class="tab === 2 ? 'active' : ''" @click="tab = 2">ساندویچ</li>
            <li :class="tab === 3 ? 'active' : ''" @click="tab = 3">پیتزا</li>
        </ul>
        @php
            $burgers = App\Models\Product::where('category_id', 2)->where('status', 1)->take(3)->get();
            $sanvich = App\Models\Product::where('category_id', 3)->where('status', 1)->take(3)->get();
            $pizza = App\Models\Product::where('category_id', 4)->where('status', 1)->take(3)->get();
        @endphp
        <div class="filters-content">
            <div x-show="tab === 1">
                <div class="row grid">
                    @foreach ($burgers as $item)
                        <div class="col-sm-6 col-lg-4">
                            <div class="box">
                                <div>
                                    <div class="img-box">
                                        <img class="img-fluid" src="{{ ImageUrl($item->primary_image) }}"
                                            alt="">
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            <a href="{{ route('product.show' , ['product' => $item->slug]) }}">{{ $item->name }}</a>
                                        </h5>
                                        <p>
                                            {{ Str::limit($item->description, 85) }}
                                        </p>
                                        <div class="options">
                                            @if ($item->is_sale)
                                                <h6>
                                                    <del>{{ number_format($item->price) }}</del>
                                                    <span>
                                                        <span class="text-danger">({{ salePercent($item->price , $item->sale_price) }}%)</span>
                                                        {{ number_format($item->sale_price) }}
                                                        <span>تومان</span>
                                                    </span>
                                                </h6>
                                            @else
                                                <h6>
                                                    <span>
                                                        {{ number_format($item->price) }}
                                                        <span>تومان</span>
                                                    </span>
                                                </h6>
                                            @endif
                                            <div class="d-flex">
                                                <a class="me-2" href="">
                                                    <i class="bi bi-cart-fill text-white fs-6"></i>
                                                </a>
                                                <a href="{{ route('wishlist.add' , ['product_id' => $item->id]) }}">
                                                    <i class="bi bi-heart-fill  text-white fs-6"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div x-show="tab === 2">
                <div class="row grid">
                    @foreach ($sanvich as $item)
                        <div class="col-sm-6 col-lg-4">
                            <div class="box">
                                <div>
                                    <div class="img-box">
                                        <img class="img-fluid" src="{{ ImageUrl($item->primary_image) }}"
                                            alt="">
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            <a href="{{ route('product.show' , ['product' => $item->slug]) }}">{{ $item->name }}</a>
                                        </h5>
                                        <p>
                                            {{ Str::limit($item->description, 85) }}
                                        </p>
                                        <div class="options">
                                            @if ($item->is_sale)
                                                <h6>
                                                    <del>{{ number_format($item->price) }}</del>
                                                    <span>
                                                        <span class="text-danger">(16%)</span>
                                                        {{ number_format($item->sale_price) }}
                                                        <span>تومان</span>
                                                    </span>
                                                </h6>
                                            @else
                                                <h6>
                                                    <span>
                                                        {{ number_format($item->price) }}
                                                        <span>تومان</span>
                                                    </span>
                                                </h6>
                                            @endif
                                            <div class="d-flex">
                                                <a class="me-2" href="">
                                                    <i class="bi bi-cart-fill text-white fs-6"></i>
                                                </a>
                                                <a href="">
                                                    <i class="bi bi-heart-fill  text-white fs-6"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <div x-show="tab === 3">
                <div class="row grid">
                    @foreach ($pizza as $item)
                        <div class="col-sm-6 col-lg-4">
                            <div class="box">
                                <div>
                                    <div class="img-box">
                                        <img class="img-fluid" src="{{ ImageUrl($item->primary_image) }}"
                                            alt="">
                                    </div>
                                    <div class="detail-box">
                                        <h5>
                                            <a href="{{ route('product.show' , ['product' => $item->slug]) }}">{{ $item->name }}</a>
                                        </h5>
                                        <p>
                                            {{ Str::limit($item->description, 85) }}
                                        </p>
                                        <div class="options">
                                            @if ($item->is_sale)
                                                <h6>
                                                    <del>{{ number_format($item->price) }}</del>
                                                    <span>
                                                        <span class="text-danger">(16%)</span>
                                                        {{ number_format($item->sale_price) }}
                                                        <span>تومان</span>
                                                    </span>
                                                </h6>
                                            @else
                                                <h6>
                                                    <span>
                                                        {{ number_format($item->price) }}
                                                        <span>تومان</span>
                                                    </span>
                                                </h6>
                                            @endif
                                            <div class="d-flex">
                                                <a class="me-2" href="">
                                                    <i class="bi bi-cart-fill text-white fs-6"></i>
                                                </a>
                                                <a href="">
                                                    <i class="bi bi-heart-fill  text-white fs-6"></i>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

        </div>

        <div class="btn-box">
            <a href="">
                مشاهده بیشتر
            </a>
        </div>
    </div>
</section>
