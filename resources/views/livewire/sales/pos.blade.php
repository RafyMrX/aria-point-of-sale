<div>
    <div class="row mt-3">
        <div class="col-md-3">
            <div class="card ">
                <div class="card-header text-white" style="background-color: #5f815e;">
                    <h3 class="card-title">Inofrmasi Nota</h3>
                </div>
                <form>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bold align-middle">Invoice</td>
                                <td><input type="text" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold align-middle">Tanggal</td>
                                <td><input type="text" class="form-control" readonly></td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold align-middle">Admin</td>
                                <td><input type="text" class="form-control" readonly></td>
                            </tr>
                        </table>
                    </div>

                </form>
            </div>

            <div class="card card-secondary">
                <div class="card-header text-white" style="background-color: #5f815e;">
                    <h3 class="card-title">Informasi Retail</h3>
                </div>
                <form>
                    <div class="card-body">
                        <table class="table table-sm">
                            <tr>
                                <td class="font-weight-bold align-middle">Retail</td>
                                <td>
                                    <select name="" class="form-control">
                                        <option value="">-- pilih --</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td class="font-weight-bold align-middle">Status</td>
                                <td>
                                    <select name="" class="form-control">
                                        <option value="">-- pilih --</option>
                                        <option value="1">Pending</option>
                                        <option value="2">Closing</option>
                                    </select>
                                </td>
                            </tr>
                        </table>
                    </div>

                </form>
            </div>
        </div>
        <div class="col-md-9">
            {{-- SEARCH --}}
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" style="background-color: #3b3b3b;color: #fff;">Cari/Scan
                        Barcode</span>
                </div>
                <input type="text" class="form-control" placeholder="kode produk/barcode produk/nama produk">
                <div class="input-group-append">
                    <span class="input-group-text" style="background-color: #5f815e;color: #fff;"><i
                            class="fa fa-barcode" aria-hidden="true"></i></span>
                </div>
            </div>
            {{-- END SEARCH --}}

            <table class="table  table-striped table-sm table-hover rounded-6">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Kode Produk</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th class="text-center">Qty</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="align-middle">1</td>
                        <td class="align-middle">PR0001</td>
                        <td class="align-middle">Logitech L-123</td>
                        <td class="align-middle">15.000</td>
                        <td class="align-middle">
                            <center>
                                <input type="number" class="form-control" min="0" style="width:100px;">
                            </center>
                        </td>
                        <td class="align-middle">30.000</td>
                        <td class="align-middle"><button type="submit" class="btn btn-danger"
                                wire:click="deleteConfirmation()"><i class="fa fa-trash-o"
                                    aria-hidden="true"></i></button></td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col-md-6 ">
                    <div class="alert alert-warning alert-dismissible fade show" role="alert" style="background-color: rgb(231, 231, 165)">
                        Pastikan jumlah produk cukup!.
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                    <textarea rows="4" class="form-control" placeholder="Keterangan"></textarea>
                </div>
                <div class="col-md-6">
                    <table class="table table-striped table-sm">
                        <tr>
                            <td class="font-weight-bold">Subtotal</td>
                            <td>Rp.30.000</td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Diskon</td>
                            <td>
                                <div class="input-group">
                                    <input type="text" class="">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="font-weight-bold">Grand Total</td>
                            <td>Rp.30.000</td>
                        </tr>
                    </table>

                    <div class="float-right mt-2" style="display: inline-grid;
                    grid-template-columns: 1fr 1fr;
                    grid-gap: 2px;">
                    <button class="btn btn-danger btn-lg mr-2"><i class="fa fa-refresh" aria-hidden="true"></i> Reset</button>
                    <button class="btn btn-primary btn-lg "><i class="fa fa-floppy-o" aria-hidden="true"></i> Buat
                        Transaksi</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>