<div>
    <style>
        .divider {
            display: flex;
            align-items: center;
            text-align: center;
            padding-bottom: 20px;
            padding-top: 15px;
        }

        .divider::before {
            content: "";
            border-top: 0.1px solid gray;
            flex: 1;
        }

        .divider:not(:empty)::before {
            margin-right: 10px;
        }

        .divider .divider-mount {
            color: rgb(14, 78, 173);
        }

        .divider-center {
            display: flex;
            align-items: center;
            text-align: center;
            padding-bottom: 20px;
        }

        .divider-center::after,
        .divider-center::before {
            content: "";
            border: 1px solid black;
            flex: 1;
        }

        .divider-center:not(:empty)::before {
            margin-right: 0.25em;
        }

        .divider-center:not(:empty)::after {
            margin-left: 0.25em;
        }

        .justif-between {
            display: flex;
            justify-content: space-between;
        }

        .boardingPenitipanBarang{
            background-image: url('assetc/images/barang.jpeg');
            background-size: cover;
            height: 180px; 
            width: 100%; 
            margin-bottom: 35px;
        }
        .boardingPenitipanBarang h3{
            color: black;
        }
    </style>
    <div class="boardingPenitipanBarang">
        <div class="heading_container heading_center" style="padding-top: 60px;">
            <h3>
                Pemesanan Penitipan Barang
            </h3>
        </div>
    </div>
    <section class="why_section layout_padding_why">
        <div class="container">
            <div class="divider-center"><strong>Informasi Pemilik</strong></div>
            <form wire:submit.prevent = "addDataToDb()">
                <div class="row">
                    <div class="col-md-2 text-center">
                        <img src="{{ asset('assetc/images/client.jpg') }}" alt="profile" class="img-thumbnail">
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label class="form-label">Label Name</label>
                            <input type="text" class="form-control" placeholder="Placeholder Text">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Label Name</label>
                            <select class="form-control">
                                <option value="">Select 1</option>
                                <option value="">Select 1</option>
                                <option value="">Select 1</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="mb-3">
                            <label class="form-label">Label Name</label>
                            <input type="text" class="form-control" placeholder="Placeholder Text">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Default file input example</label>
                            <input class="form-control" type="file" i>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="mb-3">
                            <label class="form-label">Example textarea</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="divider-center"><strong>Informasi Barang</strong></div>
                @php $idx = 1; @endphp
                @foreach ($barangArry as $index => $barang)
                    <div class="justif-between" style="padding-top: {{ $idx > 1 ? '25px' : '' }}">
                        <div>
                            <label class="form-label">Barang-{{ $idx }}</label>
                        </div>
                        @if ($idx > 1)
                            <div>
                                <label wire:click="deleteRowBarang({{ $index }})" class="form-label"
                                    style="color: red; cursor: pointer">Hapus</label>
                            </div>
                        @endif
                    </div>
                    <div class="card" style="background-color: rgb(251, 251, 251)">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nama Barang</label>
                                        <input wire:model="barangArry.{{ $index }}.nama_barang" type="text"
                                            class="form-control" placeholder="Placeholder Text">
                                            @error('barangArry.'.$index.'.nama_barang')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Jenis Barang</label>
                                        <select wire:model="barangArry.{{ $index }}.jenis_barang" class="form-control">
                                            <option value="">Pilih Jenis Barang</option>
                                            <option value="">Barang Kecil</option>
                                            <option value="">Barang Sedang</option>
                                            <option value="">Barang Besar</option>
                                        </select>
                                        @error('barangArry.'.$index.'.jenis_barang')
                                                <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Foto Barang</label>
                                        <input class="form-control" type="file">
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Lokasi Barang</label>
                                        <textarea class="form-control"></textarea>
                                    </div>
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="customCheck1">
                                        <label class="custom-control-label" for="customCheck1">Jemput Barang
                                            Titipan</label>
                                        <i class="fa fa-info-circle" data-toggle="tooltip" data-placement="top"
                                            title="Barang yang dititip akan dijemput dengan penambahan biaya berdasarkan jenis barang"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @php $idx++ @endphp
                @endforeach
                <div class="divider">
                    <button wire:click="addBarangRow()"s type="button" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Tambah barang</button>
                </div>
                <div class="divider-center"><strong>Metode Pembayaran</strong></div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label class="form-label">Metode Pembayaran</label>
                            <select class="form-control">
                                <option value="">Pilih Metode Bayar</option>
                                <option value="">Bayar Cash</option>
                                <option value="">Transfer Bank</option>
                            </select>
                        </div>
                        <div class="mb-3" style="padding-top: 2px">
                            <input type="text" class="form-control" placeholder="Nama Pembayar">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" style="color: transparent">Metode</label>
                        <div class="card">
                            <div class="card-body text-center">
                                <img src="{{ asset('assetc/images/cod.png') }}" width="90px" alt="COD">
                                <span style="padding: 0 25px"></span>
                                <img src="{{ asset('assetc/images/tansfer-bank.png') }}" width="150px" alt="TRS">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12" style="padding-top: 10px">
                        <button type="submit" class="btn btn-primary btn-block">Lanjutkan Penitipan</button>
                    </div>
                </div>
                <div id="konfimasiPesanan" hidden="hidden">
                    <div class="divider-center" style="padding-top: 20px"><strong>Konfirmasi Pesanan</strong></div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">Card title</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                    <p class="card-text">Some quick example text to build on the card title and make up
                                        the
                                        bulk of the card's content.</p>
                                    <a href="#" class="card-link">Card link</a>
                                    <a href="#" class="card-link">Another link</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
</div>
@push('scripts')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush