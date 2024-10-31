@extends('profile.layout.master')
@section('title', 'Profile')



@section('main')
    <div class="col-sm-12 col-lg-9">
        <a href="{{ route('address.create') }}" class="btn btn-primary mb-4">
            ایجاد آدرس جدید
        </a>
        @foreach ($addresses as $address)
            <div class="card card-body">
                <div class="row g-4">
                    <div class="col col-md-6">
                        <label class="form-label">عنوان</label>
                        <input disabled type="text" value="{{ $address->title }}" class="form-control" />
                    </div>
                    <div class="col col-md-6">
                        <label class="form-label">شماره تماس</label>
                        <input disabled type="text" value="{{ $address->cellphone }}" class="form-control" />
                    </div>
                    <div class="col col-md-6">
                        <label class="form-label">کد پستی</label>
                        <input disabled type="text" value="{{ substr($address->postal_code, 0, 5) . '-' . substr($address->postal_code, 5) }}" class="form-control" />
                    </div>
                    <div class="col col-md-6">
                        <label class="form-label">استان</label>
                        <input disabled type="text" value="{{ $address->province->name }}" class="form-control" />
                    </div>
                    <div class="col col-md-6">
                        <label class="form-label">شهر</label>
                        <input disabled type="text" value="{{ $address->city->name }}" class="form-control" />
                    </div>
                    <div class="col col-md-12">
                        <label class="form-label">آدرس</label>
                        <textarea disabled type="text" rows="5" class="form-control">{{ $address->address }}</textarea>
                    </div>
                </div>
                <div class="mt-4">
                    <a href="{{ route('address.edit' , ['address' => $address->id]) }}" class="btn btn-primary">ویرایش</a>
                    <a href="{{ route('address.delete' , ['address' => $address->id]) }}" class="btn btn-danger">حذف</a>
                </div>
            </div>
            <hr />
        @endforeach

    </div>
@endsection
