<form action="{{ route('contact.store') }}" method="POST">
    @csrf
    <div>
        @error('name')
            <span class="text-danger fs-6">{{ $message }}</span>
        @enderror
        <input type="text" name="name" value="{{ old('name') }}" class="form-control" placeholder="نام و نام خانوادگی" />
    </div>
    <div>
        @error('email')
            <span class="text-danger fs-6">{{ $message }}</span>
        @enderror
        <input type="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="ایمیل" />
    </div>
    <div>
        @error('subject')
            <span class="text-danger fs-6">{{ $message }}</span>
        @enderror
        <input type="text" name="subject" value="{{ old('subject') }}" class="form-control" placeholder="موضوع پیام" />
    </div>
    <div>
        @error('body')
            <span class="text-danger fs-6">{{ $message }}</span>
        @enderror
        <textarea rows="10" name="body" style="height: 100px" class="form-control" placeholder="متن پیام">{{ old('body') }}</textarea>
    </div>
    <div class="btn_box">
        <button type="submit">
            ارسال پیام
        </button>
    </div>
</form>
