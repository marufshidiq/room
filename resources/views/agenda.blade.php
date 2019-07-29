@extends('layouts.apps')

@section('css')
<link rel="stylesheet" href="/bower_components/eonasdan-bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.min.css" />
<style>
    .timepicker-picker {
        margin-top:40px;
        margin-left:50px;
    }
</style>
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
                        <p class="category">Penggunaan Ruangan Departemen TEDI Sekolah Vokasi UGM</p>
                    </div>
                    <div class="card-content table-responsive">
                        <table class="table">
                            <thead class="text-primary">
                                <th>Kegiatan</th>
                                <th>Waktu Mulai</th>
                                <th>Waktu Selesai</th>
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
                                    <td><a href="#" style="color:black" data-toggle="tooltip" title="{{$data['token']}}">{{$data['name']}}</a></td>
                                    <td>
                                        <h6>{{$data['datetime_start']}}</h6>
                                    </td>
                                    <td>
                                        <h6>{{$data['datetime_end']}}</h6>
                                    </td>
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
                                    <button onclick="deleteAgenda({{$data->id}})" type="button" class="btn btn-sm btn-danger"><i class="material-icons">delete</i></button>
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
                        <h4 class="title">Tambah Agenda Baru</h4>                        
                    </div>
                    <div class="card-content">
                        <form action="{{route('post.add.agenda')}}" method="POST"> 
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
                                            <option value="-">-- Ruangan --</option>
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
                                                    <div id="datetimepicker-start">
                                                        <input data-format="yyyy-MM-dd hh:mm:ss" type="hidden" name="datetime_start"></input>
                                                    </div>
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
                                                    <div id="datetimepicker-end">
                                                        <input data-format="yyyy-MM-dd hh:mm:ss" type="hidden" name="datetime_end"></input>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>                                    
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="facilities-list">
                                <div class="col-md-4" id="listrik" style="display: none;">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="listrik" id="listrik">
                                        </label>
                                        Listrik
                                    </div>
                                </div>
                                <div class="col-md-4" id="ac" style="display: none;">
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="ac" id="ac">
                                        </label>
                                        AC
                                    </div>
                                </div>
                                <div class="col-md-4" id="proyektor" style="display: none;">
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

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
</script>
<script type="text/javascript">
    $(function () {
        $('#datetimepicker-start').datetimepicker({
            locale: 'id',
            inline: true,
            sideBySide: true,
            format: 'YYYY-MM-DD HH:mm'
        });
        $('#datetimepicker-end').datetimepicker({
            locale: 'id',
            inline: true,
            sideBySide: true,
            format: 'YYYY-MM-DD HH:mm'
        });
    });
</script>
<script>
    $('#selroom').change(function() {
        var id = $("#selroom option:selected" ).val();
        if(id != '-'){
            changeFacilities(id);
        }
    });

    function changeFacilities(room_id){
        $.ajax({
            type: 'POST',
            url: '/api/facilities',
            data: {
                id: room_id
            },
            success: function(data) {                
                if(data.listrik == "0"){
                    $("#facilities-list #listrik").hide();
                }
                else {
                    $("#facilities-list #listrik").show();
                }

                if(data.ac == "0"){
                    $("#facilities-list #ac").hide();
                }
                else {
                    $("#facilities-list #ac").show();
                }

                if(data.proyektor == "0"){
                    $("#facilities-list #proyektor").hide();
                }
                else {
                    $("#facilities-list #proyektor").show();
                }
            },
            error: function(error) {
                alert("Error")
            }
        });
    }

    function deleteAgenda(id) {
        var r = confirm("Apakah anda yakin akan menghapus agenda ini?");
        if (r == true) {
            $.ajax({
                type: 'POST',
                url: '{{route('post.delete.agenda')}}',
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