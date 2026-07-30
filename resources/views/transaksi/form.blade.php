<div class="row padding-1 p-1">
    <div class="col-md-12">
        
        <div class="form-group mb-2 mb20">
            <label for="kode_transaksi" class="form-label">{{ __('Kode Transaksi') }}</label>
            <input type="text" name="kode_transaksi" class="form-control @error('kode_transaksi') is-invalid @enderror" value="{{ old('kode_transaksi', $transaksi?->kode_transaksi) }}" id="kode_transaksi" placeholder="Kode Transaksi">
            {!! $errors->first('kode_transaksi', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="status_pesanan" class="form-label">{{ __('Status Pesanan') }}</label>
            <input type="text" name="status_pesanan" class="form-control @error('status_pesanan') is-invalid @enderror" value="{{ old('status_pesanan', $transaksi?->status_pesanan) }}" id="status_pesanan" placeholder="Status Pesanan">
            {!! $errors->first('status_pesanan', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="member_id" class="form-label">{{ __('Member Id') }}</label>
            <input type="text" name="member_id" class="form-control @error('member_id') is-invalid @enderror" value="{{ old('member_id', $transaksi?->member_id) }}" id="member_id" placeholder="Member Id">
            {!! $errors->first('member_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="tipe_pelanggan" class="form-label">{{ __('Tipe Pelanggan') }}</label>
            <input type="text" name="tipe_pelanggan" class="form-control @error('tipe_pelanggan') is-invalid @enderror" value="{{ old('tipe_pelanggan', $transaksi?->tipe_pelanggan) }}" id="tipe_pelanggan" placeholder="Tipe Pelanggan">
            {!! $errors->first('tipe_pelanggan', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="nama_pelanggan" class="form-label">{{ __('Nama Pelanggan') }}</label>
            <input type="text" name="nama_pelanggan" class="form-control @error('nama_pelanggan') is-invalid @enderror" value="{{ old('nama_pelanggan', $transaksi?->nama_pelanggan) }}" id="nama_pelanggan" placeholder="Nama Pelanggan">
            {!! $errors->first('nama_pelanggan', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="no_tlp" class="form-label">{{ __('No Tlp') }}</label>
            <input type="text" name="no_tlp" class="form-control @error('no_tlp') is-invalid @enderror" value="{{ old('no_tlp', $transaksi?->no_tlp) }}" id="no_tlp" placeholder="No Tlp">
            {!! $errors->first('no_tlp', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="payment_method_id" class="form-label">{{ __('Payment Method Id') }}</label>
            <input type="text" name="payment_method_id" class="form-control @error('payment_method_id') is-invalid @enderror" value="{{ old('payment_method_id', $transaksi?->payment_method_id) }}" id="payment_method_id" placeholder="Payment Method Id">
            {!! $errors->first('payment_method_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="payment_provider_id" class="form-label">{{ __('Payment Provider Id') }}</label>
            <input type="text" name="payment_provider_id" class="form-control @error('payment_provider_id') is-invalid @enderror" value="{{ old('payment_provider_id', $transaksi?->payment_provider_id) }}" id="payment_provider_id" placeholder="Payment Provider Id">
            {!! $errors->first('payment_provider_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="transfer_bank_id" class="form-label">{{ __('Transfer Bank Id') }}</label>
            <input type="text" name="transfer_bank_id" class="form-control @error('transfer_bank_id') is-invalid @enderror" value="{{ old('transfer_bank_id', $transaksi?->transfer_bank_id) }}" id="transfer_bank_id" placeholder="Transfer Bank Id">
            {!! $errors->first('transfer_bank_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="ppn" class="form-label">{{ __('Ppn') }}</label>
            <input type="text" name="ppn" class="form-control @error('ppn') is-invalid @enderror" value="{{ old('ppn', $transaksi?->ppn) }}" id="ppn" placeholder="Ppn">
            {!! $errors->first('ppn', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="harga_ppn" class="form-label">{{ __('Harga Ppn') }}</label>
            <input type="text" name="harga_ppn" class="form-control @error('harga_ppn') is-invalid @enderror" value="{{ old('harga_ppn', $transaksi?->harga_ppn) }}" id="harga_ppn" placeholder="Harga Ppn">
            {!! $errors->first('harga_ppn', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="service_charge" class="form-label">{{ __('Service Charge') }}</label>
            <input type="text" name="service_charge" class="form-control @error('service_charge') is-invalid @enderror" value="{{ old('service_charge', $transaksi?->service_charge) }}" id="service_charge" placeholder="Service Charge">
            {!! $errors->first('service_charge', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="harga_service_charge" class="form-label">{{ __('Harga Service Charge') }}</label>
            <input type="text" name="harga_service_charge" class="form-control @error('harga_service_charge') is-invalid @enderror" value="{{ old('harga_service_charge', $transaksi?->harga_service_charge) }}" id="harga_service_charge" placeholder="Harga Service Charge">
            {!! $errors->first('harga_service_charge', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="diskon_member" class="form-label">{{ __('Diskon Member') }}</label>
            <input type="text" name="diskon_member" class="form-control @error('diskon_member') is-invalid @enderror" value="{{ old('diskon_member', $transaksi?->diskon_member) }}" id="diskon_member" placeholder="Diskon Member">
            {!! $errors->first('diskon_member', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="harga_diskon_member" class="form-label">{{ __('Harga Diskon Member') }}</label>
            <input type="text" name="harga_diskon_member" class="form-control @error('harga_diskon_member') is-invalid @enderror" value="{{ old('harga_diskon_member', $transaksi?->harga_diskon_member) }}" id="harga_diskon_member" placeholder="Harga Diskon Member">
            {!! $errors->first('harga_diskon_member', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="grand_total" class="form-label">{{ __('Grand Total') }}</label>
            <input type="text" name="grand_total" class="form-control @error('grand_total') is-invalid @enderror" value="{{ old('grand_total', $transaksi?->grand_total) }}" id="grand_total" placeholder="Grand Total">
            {!! $errors->first('grand_total', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="user_id" class="form-label">{{ __('User Id') }}</label>
            <input type="text" name="user_id" class="form-control @error('user_id') is-invalid @enderror" value="{{ old('user_id', $transaksi?->user_id) }}" id="user_id" placeholder="User Id">
            {!! $errors->first('user_id', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>
        <div class="form-group mb-2 mb20">
            <label for="paid_at" class="form-label">{{ __('Paid At') }}</label>
            <input type="text" name="paid_at" class="form-control @error('paid_at') is-invalid @enderror" value="{{ old('paid_at', $transaksi?->paid_at) }}" id="paid_at" placeholder="Paid At">
            {!! $errors->first('paid_at', '<div class="invalid-feedback" role="alert"><strong>:message</strong></div>') !!}
        </div>

    </div>
    <div class="col-md-12 mt20 mt-2">
        <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
    </div>
</div>