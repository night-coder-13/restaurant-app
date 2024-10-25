@extends('profile.layout.master')
@section('title', 'Profile')



@section('main')
    <div class="col-sm-12 col-lg-9">
        <a href="{{ route('address.create') }}" class="btn btn-primary mb-4">
            ایجاد آدرس جدید
        </a>

        <div class="card card-body">
            <div class="row g-4">
                <div class="col col-md-6">
                    <label class="form-label">عنوان</label>
                    <input disabled type="text" value="منزل" class="form-control" />
                </div>
                <div class="col col-md-6">
                    <label class="form-label">شماره تماس</label>
                    <input disabled type="text" value="09111111111" class="form-control" />
                </div>
                <div class="col col-md-6">
                    <label class="form-label">کد پستی</label>
                    <input disabled type="text" value="4586-2115" class="form-control" />
                </div>
                <div class="col col-md-6">
                    <label class="form-label">استان</label>
                    <input disabled type="text" value="تهران" class="form-control" />
                </div>
                <div class="col col-md-6">
                    <label class="form-label">شهر</label>
                    <input disabled type="text" value="تهران" class="form-control" />
                </div>
                <div class="col col-md-12">
                    <label class="form-label">آدرس</label>
                    <textarea disabled type="text" rows="5" class="form-control">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</textarea>
                </div>
            </div>
            <div class="mt-4">
                <a href="./edit-address.html" class="btn btn-primary">ویرایش</a>
            </div>
        </div>
        <hr />
        <div class="card card-body">
            <div class="row g-4">
                <div class="col col-md-6">
                    <label class="form-label">عنوان</label>
                    <input disabled type="text" value="محل کار" class="form-control" />
                </div>
                <div class="col col-md-6">
                    <label class="form-label">شماره تماس</label>
                    <input disabled type="text" value="09000000000" class="form-control" />
                </div>
                <div class="col col-md-6">
                    <label class="form-label">کد پستی</label>
                    <input disabled type="text" value="4586-2115" class="form-control" />
                </div>
                <div class="col col-md-6">
                    <label class="form-label">استان</label>
                    <input disabled type="text" value="تهران" class="form-control" />
                </div>
                <div class="col col-md-6">
                    <label class="form-label">شهر</label>
                    <input disabled type="text" value="تهران" class="form-control" />
                </div>
                <div class="col col-md-12">
                    <label class="form-label">آدرس</label>
                    <textarea disabled type="text" rows="5" class="form-control">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است.</textarea>
                </div>
            </div>
            <div class="mt-4">
                <a href="./edit-address.html" class="btn btn-primary">ویرایش</a>
            </div>
        </div>
    </div>
@endsection
