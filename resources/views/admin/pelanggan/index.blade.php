@extends('layout.backend.app',[
    'title' => 'Manage Pelanggan',
    'pageTitle' =>'Manage Pelanggan',
])

@push('css')
<link href="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
@endpush

@section('content')
<div class="notify"></div>

<div class="card">
    <div class="card-header">
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#create-modal">
          Tambah Data
        </button>
    </div>
        <div class="card-body">
            <div class="table-responsive">    
                <table class="table table-bordered data-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>ID TIket</th>
                            <th>Nama</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="create-modal" tabindex="-1" status="dialog" aria-labelledby="create-modalLabel" aria-hidden="true">
  <div class="modal-dialog" status="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="create-modalLabel">Create Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="createForm">
        <div class="form-group">
            <label for="n">Name</label>
            <input type="" required="" id="n" id_tiket="id_tiket" class="form-control">
        </div>
        <div class="form-group">
            <label for="e">Email</label>
            <input type="" required="" id="e" id_tiket="nama" class="form-control">
        </div>
        <div class="form-group">
            <label for="p">Password</label>
            <input type="password" required="" id="p" id_tiket="password" class="form-control">
        </div>
        <div class="form-group">
            <label for="r">Role</label>
            <select id_tiket="status" id="r" class="form-control">
                <option disabled="">- PILIH ROLE -</option>
                <option value="admin">Admin</option>
                <option value="pelanggan">Pelanggan</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-store">Simpan</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Create -->

<!-- Modal Edit -->
<div class="modal fade" id="edit-modal" tabindex="-1" status="dialog" aria-labelledby="edit-modalLabel" aria-hidden="true">
  <div class="modal-dialog" status="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="edit-modalLabel">Edit Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="editForm">
        <div class="form-group">
            <label for="id_tiket">Name</label>
            <input type="hidden" required="" id="id" id_tiket="id" class="form-control">
            <input type="" required="" id="id_tiket" id_tiket="id_tiket" class="form-control">
        </div>
        <div class="form-group">
            <label for="nama">Email</label>
            <input type="" required="" id="nama" id_tiket="nama" class="form-control">
        </div>
        <div class="form-group">
            <label for="status">Role</label>
            <select id_tiket="status" id="status" class="form-control">
                <option disabled="">- PILIH ROLE -</option>
                <option value="admin">Admin</option>
                <option value="pelanggan">Pelanggan</option>
            </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary btn-update">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- Modal Edit -->

<!-- Destroy Modal -->
<div class="modal fade" id="destroy-modal" tabindex="-1" status="dialog" aria-labelledby="destroy-modalLabel" aria-hidden="true">
  <div class="modal-dialog" status="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="destroy-modalLabel">Yakin Hapus ?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
        <button type="button" class="btn btn-danger btn-destroy">Hapus</button>
      </div>
    </div>
  </div>
</div>
<!-- Destroy Modal -->

@stop

@push('js')
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('template/backend/sb-admin-2') }}/js/demo/datatables-demo.js"></script>

<script type="text/javascript">

  $(function () {
    
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('pelanggan.index') }}",
        columns: [
            {data: 'DT_RowIndex' , id_tiket: 'id'},
            {data: 'id_tiket', id_tiket: 'id_tiket'},
            {data: 'nama', id_tiket: 'nama'},
            {data: 'status', id_tiket: 'status'},
            {data: 'action', id_tiket: 'action', orderable: false, searchable: true},
        ]
    });
  });


    // Reset Form
        function resetForm(){
            $("[id_tiket='id_tiket']").val("")
            $("[id_tiket='nama']").val("")
            $("[id_tiket='status']").val("")
        }
    //

    // Create 

    $("#createForm").on("submit",function(e){
        e.preventDefault()

        $.ajax({
            url: "/admin/pelanggan",
            method: "POST",
            data: $(this).serialize(),
            success:function(){
                $("#create-modal").modal("hide")
                $('.data-table').DataTable().ajax.reload();
                flash("success","Data berhasil ditambah")
                resetForm()
            }
        })
    })

    // Create

    // Edit & Update
    $('body').on("click",".btn-edit",function(){
        var id = $(this).attr("id")
        
        $.ajax({
            url: "/admin/pelanggan/"+id+"/edit",
            method: "GET",
            success:function(response){
                $("#edit-modal").modal("show")
                $("#id").val(response.id)
                $("#id_tiket").val(response.id_tiket)
                $("#nama").val(response.nama)
                $("#status").val(response.status)
            }
        })
    });

    $("#editForm").on("submit",function(e){
        e.preventDefault()
        var id = $("#id").val()

        $.ajax({
            url: "/admin/pelanggan/"+id,
            method: "PATCH",
            data: $(this).serialize(),
            success:function(){
                $('.data-table').DataTable().ajax.reload();
                $("#edit-modal").modal("hide")
                flash("success","Data berhasil diupdate")
            }
        })
    })
    //Edit & Update

    $('body').on("click",".btn-delete",function(){
        var id = $(this).attr("id")
        $(".btn-destroy").attr("id",id)
        $("#destroy-modal").modal("show")
    });

    $(".btn-destroy").on("click",function(){
        var id = $(this).attr("id")

        $.ajax({
            url: "/admin/pelanggan/"+id,
            method: "DELETE",
            success:function(){
                $("#destroy-modal").modal("hide")
                $('.data-table').DataTable().ajax.reload();
                flash('success','Data berhasil dihapus')
            }
        });
    })

    function flash(type,message){
        $(".notify").html(`<div class="alert alert-`+type+` alert-dismissible fade show" status="alert">
                              `+message+`
                              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>`)
    }

</script>
@endpush