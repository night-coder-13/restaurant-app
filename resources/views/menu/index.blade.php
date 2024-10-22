@extends('layout.master')
@section('title', 'Menu home')


@section('script')
    <script>
        document.addEventListener('alpine:init', () => {
            Alpine.data('filter', () => ({
                search: '',
                currentUrl: '{{ url()->current() }}',
                params: new URLSearchParams(location.search),

                filter(type, value) {
                    this.params.set(type, value);
                    this.params.delete('page');
                    document.location.href = this.currentUrl + '?' + this.params.toString()
                },

                removeFilter(type) {
                    this.params.delete(type);
                    document.location.href = this.currentUrl + '?' + this.params.toString();
                }
            }));

        });
    </script>
@endsection

@section('content')

    <section class="food_section layout_padding">
        <div class="container">
            <div class="row">
                <div x-data="filter" class="col-sm-12 col-lg-3">
                    <div>
                        <label class="form-label">جستجو
                            @if (request()->has('search'))
                                <i @click="removeFilter('search')" class="bi bi-x text-danger fs-5 cursor-pointer"></i>
                            @endif
                        </label>
                        <div class="input-group mb-3">
                            <input type="text" x-model="search" class="form-control" placeholder="نام محصول ..." />
                            <button @click="filter('search' , search)" class="input-group-text">
                                <i class="bi bi-search"></i>
                            </button>
                        </div>
                    </div>
                    <hr />
                    <div class="filter-list">
                        <div class="form-label">
                            دسته بندی
                            @if (request()->has('category'))
                                <i @click="removeFilter('category')" class="bi bi-x text-danger fs-5 cursor-pointer"></i>
                            @endif
                        </div>
                        <ul>
                            @foreach ($categoreis as $cat)
                                <li @click="filter('category' , '{{ $cat->id }}')"
                                    class="my-2 cursor-pointer 
                                    {{ request()->has('category') && request()->category == $cat->id ? 'filter-list-active' : '' }}
                                    ">
                                    {{ $cat->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <hr />
                    <div>
                        <label class="form-label">مرتب سازی
                            @if (request()->has('storBy'))
                                <i @click="removeFilter('storBy')" class="bi bi-x text-danger fs-5 cursor-pointer"></i>
                            @endif
                        </label>
                        <div class="form-check my-2">
                            <input @change="filter('storBy' , 'max')" class="form-check-input" type="radio"
                                name="flexRadioDefault" 
                                {{ request()->has('storBy') && request()->storBy == 'max' ? 'checked' : '' }}
                                />
                            <label class="form-check-label cursor-pointer">
                                بیشترین قیمت
                            </label>
                        </div>
                        <div class="form-check my-2">
                            <input @change="filter('storBy' , 'min')" class="form-check-input" type="radio"
                                name="flexRadioDefault" 
                                {{ request()->has('storBy') && request()->storBy == 'min' ? 'checked' : '' }}
                                />
                            <label class="form-check-label cursor-pointer">
                                کمترین قیمت
                            </label>
                        </div>
                        <div class="form-check my-2">
                            <input @change="filter('storBy' , 'bestseller')" class="form-check-input" type="radio"
                                name="flexRadioDefault" 
                                {{ request()->has('storBy') && request()->storBy == 'bestseller' ? 'checked' : '' }}
                                />
                            <label class="form-check-label cursor-pointer">
                                پرفروش ترین
                            </label>
                        </div>
                        <div class="form-check my-2">
                            <input @change="filter('storBy' , 'sale')" class="form-check-input" type="radio"
                                name="flexRadioDefault" 
                                {{ request()->has('storBy') && request()->storBy == 'sale' ? 'checked' : '' }}
                                />
                            <label class="form-check-label cursor-pointer">
                                با تخفیف
                            </label>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-9">
                    @if ($products->isEmpty())
                        <div class="d-flex justify-content-center align-items-center h-100">
                            @if (request()->has('search'))
                                <h5>محصولی با عنوان "{{ request()->search }}" یافت نشد!</h5>
                            @else
                                <h5>محصولی یافت نشد!</h5>
                            @endif
                        </div>
                    @endif
                    <div class="row gx-3">
                        @foreach ($products as $item)
                            <div class="col-sm-6 col-lg-4">
                                <div class="box">
                                    <div>
                                        <div class="img-box">
                                            <img class="img-fluid" src="{{ ImageUrl($item->primary_image) }}"
                                                alt="" />
                                        </div>
                                        <div class="detail-box">
                                            <h5>
                                                <a
                                                    href="{{ route('product.show', ['product' => $item->slug]) }}">{{ $item->name }}</a>
                                            </h5>
                                            <p>
                                                {{ Str::limit($item->description, 85) }}
                                            </p>
                                            <div class="options">
                                                @if ($item->is_sale)
                                                    <h6>
                                                        <del>{{ number_format($item->price) }}</del>
                                                        <span>
                                                            <span
                                                                class="text-danger">({{ salePercent($item->price, $item->sale_price) }}%)</span>
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
                    <div>
                        {{ $products->withQueryString()->links('layout.paginate') }}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
