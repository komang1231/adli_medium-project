@extends('layouts.app')

@section('template_title')
    Transaksis
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Transaksis') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('transaksis.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success m-4">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body bg-white">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
									<th >Kode Transaksi</th>
									<th >Status Pesanan</th>
									<th >Member Id</th>
									<th >Tipe Pelanggan</th>
									<th >Nama Pelanggan</th>
									<th >No Tlp</th>
									<th >Payment Method Id</th>
									<th >Payment Provider Id</th>
									<th >Transfer Bank Id</th>
									<th >Ppn</th>
									<th >Harga Ppn</th>
									<th >Service Charge</th>
									<th >Harga Service Charge</th>
									<th >Diskon Member</th>
									<th >Harga Diskon Member</th>
									<th >Grand Total</th>
									<th >User Id</th>
									<th >Paid At</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($transaksis as $transaksi)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
										<td >{{ $transaksi->kode_transaksi }}</td>
										<td >{{ $transaksi->status_pesanan }}</td>
										<td >{{ $transaksi->member_id }}</td>
										<td >{{ $transaksi->tipe_pelanggan }}</td>
										<td >{{ $transaksi->nama_pelanggan }}</td>
										<td >{{ $transaksi->no_tlp }}</td>
										<td >{{ $transaksi->payment_method_id }}</td>
										<td >{{ $transaksi->payment_provider_id }}</td>
										<td >{{ $transaksi->transfer_bank_id }}</td>
										<td >{{ $transaksi->ppn }}</td>
										<td >{{ $transaksi->harga_ppn }}</td>
										<td >{{ $transaksi->service_charge }}</td>
										<td >{{ $transaksi->harga_service_charge }}</td>
										<td >{{ $transaksi->diskon_member }}</td>
										<td >{{ $transaksi->harga_diskon_member }}</td>
										<td >{{ $transaksi->grand_total }}</td>
										<td >{{ $transaksi->user_id }}</td>
										<td >{{ $transaksi->paid_at }}</td>

                                            <td>
                                                <form action="{{ route('transaksis.destroy', $transaksi->id) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('transaksis.show', $transaksi->id) }}"><i class="fa fa-fw fa-eye"></i> {{ __('Show') }}</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('transaksis.edit', $transaksi->id) }}"><i class="fa fa-fw fa-edit"></i> {{ __('Edit') }}</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="event.preventDefault(); confirm('Are you sure to delete?') ? this.closest('form').submit() : false;"><i class="fa fa-fw fa-trash"></i> {{ __('Delete') }}</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $transaksis->withQueryString()->links() !!}
            </div>
        </div>
    </div>
@endsection
