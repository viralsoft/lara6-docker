@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="form-group">
    {!! Form::label('name', __('virals-inventory::labels.vendor.name')) !!}
    {!! Form::text('name', old('name') ?? @$vendor->name, ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.vendor.name')]) !!}
</div>
<div class="form-group">
    {!! Form::label('email', __('virals-inventory::labels.vendor.email')) !!}
    {!! Form::text('email', old('email') ?? @$vendor->email, ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.vendor.email')]) !!}
</div>
<div class="form-group">
    {!! Form::label('phone', __('virals-inventory::labels.vendor.phone')) !!}
    {!! Form::text('phone', old('phone') ?? @$vendor->phone, ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.vendor.phone')]) !!}
</div>
<div class="form-group">
    {!! Form::label('address', __('virals-inventory::labels.vendor.address')) !!}
    {!! Form::textarea('address', old('address') ?? @$vendor->address, ['rows' => 3, 'class' => 'form-control', 'placeholder' => __('virals-inventory::labels.vendor.address')]) !!}
</div>
<div class="form-group">
    {!! Form::label('descriptions', __('virals-inventory::labels.vendor.description')) !!}
    {!! Form::textarea('descriptions', old('description') ?? @$vendor->descriptions, ['rows' => 10, 'class' => 'form-control', 'placeholder' => __('virals-inventory::labels.vendor.description')]) !!}
</div>
<div class="form-group">
    {!! Form::label('city', __('virals-inventory::labels.vendor.city')) !!}
    {!! Form::text('city', old('city') ?? @$vendor->city, ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.vendor.city')]) !!}
</div>
<div class="form-group">
    {!! Form::label('zip', __('virals-inventory::labels.vendor.zip')) !!}
    {!! Form::text('zip', old('zip') ?? @$vendor->zip, ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.vendor.zip')]) !!}
</div>
<div class="form-group">
    {!! Form::label('fax', __('virals-inventory::labels.vendor.fax')) !!}
    {!! Form::text('fax', old('fax') ?? @$vendor->fax, ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.vendor.fax')]) !!}
</div>
<div class="form-group">
    {!! Form::label('poc_email', __('virals-inventory::labels.vendor.poc_email')) !!}
    {!! Form::text('poc_email', old('poc_email') ?? @$vendor->poc_email, ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.vendor.poc_email')]) !!}
</div>
<div class="form-group">
    {!! Form::label('poc_name', __('virals-inventory::labels.vendor.poc_name')) !!}
    {!! Form::text('poc_name', old('poc_name') ?? @$vendor->poc_name, ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.vendor.poc_name')]) !!}
</div>
<div class="form-group">
    {!! Form::label('poc_phone', __('virals-inventory::labels.vendor.poc_phone')) !!}
    {!! Form::text('poc_phone', old('poc_phone') ?? @$vendor->poc_phone, ['class' => 'form-control', 'placeholder' => __('virals-inventory::labels.vendor.poc_phone')]) !!}
</div>

<div class="form-group">
    <button type="submit" class="btn btn-primary">{{ __('virals-inventory::messages.submit') }}</button>
    <a href="{{ route('admin.vendors.index') }}" class="btn btn-default">{{ __('virals-inventory::messages.cancel') }}</a>
</div>
