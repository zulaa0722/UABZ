@extends('layouts.layout_master')
@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="row">
            <div class="col-xl-6">
                <div class="card">
                  <div  class="card-body">
                    <h4 Class="text-center">Зэрэгүүд</h4>
                    <table id="levelDB" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                          <tr>
                            <th>№</th>
                            <th>Зэрэг</th>
                          </tr>
                        </thead>
                        <tbody>
                          <td></td>
                        </tbody>
                      </table>
                      <button class="btn btn-primary" type="button" name="button" id="btnAddModalOpen">Нэмэх</button>
                      <button class="btn btn-warning" type="button" name="button" id="btnEditModalOpen">Засах</button>
                      <button class="btn btn-danger" type="button" name="button" id="btnLevelDelete">Устгах</button>
                    </div>
                  </div>
              </div>
        </div>
      </div>
    </div>

@include('Level.LevelNew')
@include('Level.LevelEdit')
@endsection

@section('css')
  <link rel="stylesheet" href="{{url("public/uaBCssJs/datatableCss/datatables.min.css")}}">
  <style media="screen">
#levelDB tbody tr.selected {
  color: white;
  background-color: #8893f2;
}
#levelDB tbody tr{
cursor: pointer;
}
</style>
@endsection

@section('js')
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/jszip.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/pdfmake.min.js")}}"></script>
  <script type="text/javascript" src="{{url("public/uaBCssJs/datatableJs/datatables.init.js")}}"></script>

  <script type="text/javascript">
  var dataRow = "";
  var table = "";
  var csrf = "{{ csrf_token() }}";
  var getLevel = "{{url("/getLevel")}}";
  var levelNew = "{{url("/level/insert")}}";
  var levelEditUrl = "{{url("/level/edit")}}";
  var levelDeleteUrl = "{{url("/level/delete")}}";

  $(document).ready(function(){
     table = $('#levelDB').DataTable({
      "language": {
              "lengthMenu": "_MENU_ мөрөөр харах",
              "zeroRecords": "Хайлт илэрцгүй байна",
              "info": "Нийт _PAGES_ -аас _PAGE_-р хуудас харж байна ",
              "infoEmpty": "Хайлт илэрцгүй",
              "infoFiltered": "(_MAX_ мөрөөс хайлт хийлээ)",
              "sSearch": "Хайх: ",
              "paginate": {
                "previous": "Өмнөх",
                "next": "Дараахи"
              },
              "select": {
                  rows: ""
              }
          },
          select: {
            style: 'single'
        },
          "processing": true,
          "serverSide": true,
          "stateSave": true,
          "ajax":{
                   "url": getLevel,
                   "dataType": "json",
                   "type": "post",
                   "data":{
                        _token: csrf
                      }
                 },
          "columns": [
            { data: "id", name: "id",  render: function (data, type, row, meta) {
          return meta.row + meta.settings._iDisplayStart + 1;
      }  },
            { data: "levelName", name: "levelName"}
            ]
        });

        $('#levelDB tbody').on( 'click', 'tr', function () {
          if ( $(this).hasClass('selected') ) {
              $(this).removeClass('selected');
              dataRow = "";
          }else {
              table.$('tr.selected').removeClass('selected');
              $(this).addClass('selected');
              var currow = $(this).closest('tr');
              dataRow = $('#levelDB').DataTable().row(currow).data();
          }
          });
  });
  </script>

{{-- <script src="{{url("public/js/Level/LevelNew.js")}}"></script>
<script src="{{url("public/js/Level/LevelEdit.js")}}"></script>
<script src="{{url("public/js/Level/LevelDelete.js")}}"></script> --}}
@endsection
