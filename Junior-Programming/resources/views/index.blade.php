<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport">
    <title>Fahrizal</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main/app.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/pages/fontawesome.css')}}" />
    <link href="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.css" rel="stylesheet"/>
</head>

<body>
    <!-- Membuat Table-->
    <div class="page-heading">
        <div class="page-title">
            <div class="row">
                <div class="col-12 col-md-6 order-md-1 order-last">
                    <h3>Fahrizal Julian Adam</h3>
                    <p>Test Junior Programming</p>
                </div>
            </div> 
        </div>
        <div class="card">
            <div class="box-header with-border">
                <div class="btn-group">
                    <button onclick="addForm('{{ route('produk.store') }}')" class="btn btn-outline-success"><i class="bi bi-pencil-square">Tambah Produk</i></button>
                </div>
                <div class="card-body">
                <form action="" method="post" class="form-produk">
                    @csrf
                    <table class="table table-stiped table-bordered">
                        <thead>
                            <th width="5%">No</th>
                            <th class="text-center" >ID</th>
                            <th class="text-center" >Nama Produk</th>
                            <th class="text-center" >Harga</th>
                            <th class="text-center" >Kategori</th>
                            <th class="text-center" >Status</th>
                            <th class="text-center">Aksi</th>
                        </thead>
                    </table>
                </form>
            </div>
        </div>
    </div>
    @includeIf('form')





    <script src="{{ asset('assets/js/bootstrap.js')}}"></script>
    <script src="{{ asset('assets/js/app.js')}}"></script>
    <script src="{{ asset('assets/jquery/jquery.min.js')}}"></script>
    <script src="https://cdn.datatables.net/v/dt/dt-1.13.4/datatables.min.js"></script>
    <script src="{{ asset('assets/js/validator.min.js')}}"></script>
    <!--membuat script datatable-->
    <script>
        let table;
    $(function () {
        table = $('.table').DataTable({
            responsive: true,
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: {
                url: '{{route('produk.data')}}',
            },
            //membuat kolom
            columns: [
                {data: 'DT_RowIndex', searchable: false, sortable: true},
                {data: 'id_produk'},
                {data: 'nama_produk'},
                {data: 'harga'},
                {data: 'kategori'},
                {data: 'status'},
                {data: 'aksi', searchable: false, sortable: false},
            ]
        });
        //membuat modal form
        $('#modal-form').validator().on('submit', function (e) {
            if (! e.preventDefault()) {
                $.post($('#modal-form form').attr('action'), $('#modal-form form').serialize())
                    .done((response) => {
                        $('#modal-form').modal('hide');
                        table.ajax.reload();
                    })
                    .fail((errors) => {
                        alert('Tidak dapat menyimpan data');
                        return;
                    });
            }
        });
    });
    function addForm(url){
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Tambah Produk');
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action',url);
        $('#modal-form [name=_method]').val('post');
        $('#modal-form [name=nama_produk]').focus();
    }
    //membuat Edit Form
    function editForm(url) {
        $('#modal-form').modal('show');
        $('#modal-form .modal-title').text('Edit Produk');
        $('#modal-form form')[0].reset();
        $('#modal-form form').attr('action', url);
        $('#modal-form [name=_method]').val('put');
        $('#modal-form [name=nama_produk]').focus();
        $.get(url)
            .done((response) => {
                $('#modal-form [name=id_produk]').val(response.id_produk);
                $('#modal-form [name=nama_produk]').val(response.nama_produk);
                $('#modal-form [name=harga]').val(response.harga);
                $('#modal-form [name=kategori]').val(response.kategori);
                $('#modal-form [name=status]').val(response.status);

            })
            .fail((errors) => {
                alert('Tidak dapat menampilkan data');
                return;
            });
    }
    //membuat Delete data
    function deleteData(url){
        if(confirm('Apakah yakin ingin menghapus data ?')){
            $.post(url, {
                '_token': $('[name=csrf-token]').attr('content'),
                '_method': 'delete'
            })
            .done((response)=> {
                table.ajax.reload();
            })
            .fail((erorrs)=> {
                alert('Data tidak dapat dihapus');
                return;
            })
        }
    }

    </script>


    
</body>
</html>