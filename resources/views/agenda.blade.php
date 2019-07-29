@extends('layouts.apps')

@section('css')
<link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
@edsection

@section('title-header', 'Agenda')
@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header" data-background-color="purple">
                        <h4 class="title">Daftar Agenda</h4>
                        <p class="category">Penggunaan Ruang Sekolah Vokasi UGM</p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Kegiatan</th>
                                <th>Ruangan</th>
                                <th>Penanggung Jawab</th>                                
                                <th>Listrik</th>
                                <th>AC</th>
                                <th>Proyektor</th>                                
                                <th>Aksi</th>
                            </thead>
                            <tbody>
                                @foreach($allAgenda as $data)
                                <tr>
                                    <td>{{$data['name']}}</td>
                                    <td>{{$data->room->name}}</td>
                                    <td><a href="#" style="color:black" data-toggle="tooltip" title="{{$data['contact']}}">{{$data['pic']}}</a></td>
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
                                    <td>
                                    <button type="button" class="btn btn-sm btn-danger"><i class="material-icons">delete</i> Hapus</button>
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
                                        <label class="control-label">Kegiatan</label>
                                        <input type="text" class="form-control" name="agendaname" id="agendaname" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating" style="margin-top: 0px;">
                                        <label class="control-label">Nama Penanggung Jawab</label>
                                        <input type="text" class="form-control" name="pic" id="pic" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group label-floating" style="margin-top: 0px;">
                                        <label class="control-label">HP Penanggung Jawab</label>
                                        <input type="text" class="form-control" name="contact" id="contact" required>
                                    </div>
                                </div>
                            </div>                            
                            <div class="row">
                                <div class="col-md-12">
                                    <label for="selroom">Pilih Ruangan:</label>
                                    <div class="form-group label-floating" style="margin-top: 0px;">
                                        <select class="form-control" id="selroom" name="selroom">
                                            @foreach($allRoom as $data)
                                            <option value="{{$data['id']}}">{{$data['name']}}</option>        
                                            @endforeach                                    
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="overflow:hidden;">
                                        <div class="form-group" style="margin-top: 0px;">
                                            <label>Waktu Mulai</label>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div id="datetimepicker-start"></div>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div style="overflow:hidden;">
                                        <div class="form-group" style="margin-top: 0px;">
                                            <label>Waktu Selesai</label>
                                            <div class="row">
                                                <div class="col-md-8">
                                                    <div id="datetimepicker-end"></div>
                                                </div>
                                            </div>
                                        </div>                                    
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
<script type="text/javascript" src="/bower_components/moment/min/moment.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment-with-locales.js"></script>
<script type="text/javascript" src="/bower_components/eonasdan-bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker-start').datetimepicker({
            locale: 'id',
            inline: true,
            sideBySide: true
        });
        $('#datetimepicker-end').datetimepicker({
            locale: 'id',
            inline: true,
            sideBySide: true
        });
    });
</script>
@endsection