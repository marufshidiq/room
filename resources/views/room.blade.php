@extends('layouts.apps')

@section('title-header', 'Ruangan')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Daftar Ruangan</h4>
                        <p class="category">Sekolah Vokasi UGM</p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Nama Ruangan</th>
                                <th>Listrik</th>
                                <th>AC</th>
                                <th>Proyektor</th>
                                <th>Key</th>
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($allRoom as $data)
                                <tr>
                                    <td>{{$data['name']}}</td>                                    
                                        @if($data['listrik']== '1')
                                        <td class="text-primary"><i class="material-icons">check</i></td>
                                        @else
                                        <td><i class="material-icons">close</i></td>
                                        @endif

                                        @if($data['ac']== '1')
                                        <td class="text-primary"><i class="material-icons">check</i></td>
                                        @else
                                        <td><i class="material-icons">close</i></td>
                                        @endif

                                        @if($data['proyektor']== '1')
                                        <td class="text-primary"><i class="material-icons">check</i></td>
                                        @else
                                        <td><i class="material-icons">close</i></td>
                                        @endif
                                    <td>{{$data['key']}}</td>
                                    <td>
                                    <button onclick="deleteRoom({{$data->id}})" type="button" class="btn btn-sm btn-danger"><i class="material-icons">delete</i> Hapus</button>
                                    </td>
                                </tr>                     
                                @endforeach       
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>            
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Tambah Ruang Baru</h4>                        
                    </div>
                    <div class="card-content">
                        <form action="{{route('post.add.room')}}" method="POST"> 
                            {{ csrf_field()}}                           
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating">
                                        <label class="control-label">Nama Ruangan</label>
                                        <input type="text" class="form-control" name="roomname" id="roomname" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="listrik" id="listrik">
                                        </label>
                                        Listrik
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ac" id="ac">
                                        </label>
                                        AC
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="proyektor" id="proyektor">
                                        </label>
                                        Proyektor
                                    </div>
                                </div>
                            </div>                            
                            <button type="submit" class="btn btn-primary pull-right">Tambahkan</button>
                            <div class="clearfix"></div>
                        </form>
                    </div>
                </div>
            </div>            
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    function deleteRoom(id) {
        var r = confirm("Apakah anda yakin akan menghapus ruangan ini?");
        if (r == true) {
            $.ajax({
                type: 'POST',
                url: '{{route('post.delete.room')}}',
                data: {
                    id: id,                    
                },
                success: function(data) {
                    location.reload();
                },
                error: function(error) {
                    alert("Error")
                }
            });
        }
    }
</script>
@endsection