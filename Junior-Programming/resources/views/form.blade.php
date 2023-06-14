<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form">
    <div class="modal-dialog modal-lg" role="document">
        <form action="" method="post" class="form-horizontal">
            @csrf
            @method('post')

            <div class="modal-content">
                <div class="modal-header">
                <h5 class="modal-title" id="modal-form">
                    Tambah Produk
                </h5>
                </div>
                <div class="modal-body">
                    <div class="form-group row">
                        <label for="nama_produk" class="col-lg-2 col-lg-offset-1 control-label">Nama Produk</label>
                        <div class="col-lg-9">
                            <input type="text" name="nama_produk" id="nama_produk" class="form-control" required autofocus>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="harga" class="col-lg-2 col-lg-offset-1 control-label">Harga</label>
                        <div class="col-lg-9">
                            <input type="number" name="harga" id="harga" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kategori" class="col-lg-2 col-lg-offset-1 control-label">Kategori</label>
                        <div class="col-lg-9">
                            <input type="text" name="kategori" id="kategori" class="form-control">
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="status" class="col-lg-2 col-lg-offset-1 form-label">Status</label>
                        <div class="col-lg-9">
                            <select name="status" id="status" class="form-control" required >
                                <option value="bisa dijual" selected="bisa dijual">bisa dijual</option>
                                <option value="tidak bisa dijual" selected="tidak bisa dijual">tidak bisa dijual</option>
                            </select>
                            <span class="help-block with-errors"></span>
                        </div>
                    </div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-flat btn-primary"><i class="bi bi-save"></i> Simpan</button>
                    </div>
            </div>
        </form>
    </div>
</div>