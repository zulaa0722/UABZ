@extends('layouts.layout_master')
@section('css')
  <style media="screen">
    .aimag{
        fill:black;
        fill-opacity:0.4;
        stroke:white;
        stroke-width:8;
    }

    .aimag1{
        /* fill:transparent; */
        fill:#ff0c00;
        fill-opacity:0.7;
        stroke:white;
        stroke-width:8;
    }

    .aimag:hover{
        fill:transparent;
    }
    path {
      cursor: pointer;
    }
    .selected {
        stroke: white;
        stroke-width: 8;
        fill:transparent;
    }

    .hotuud:hover{
        fill:transparent;
    }
    .hotuud{
        fill:black;
        fill-opacity:0.4;
        stroke:white;
        stroke-width:8;

    }
    .syms:hover{
        stroke:blue;
        stroke-width:2;
    }
    .syms{
        fill:green;
        fill-opacity:1;
        stroke:white;
        stroke-width:1;
    }
    .oneSum{
        stroke-width:2;
        stroke:white;
        fill:green;
    }

    .insideCity{
        fill:black;
        fill-opacity:0.4;
        stroke:white;
        stroke-width:4;
    }

  </style>
@endsection
@section('content')

  <div class="row">
    <div class="col-md-9">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                  <div id="changeBlade" class="card-body">
                    <div class="col-md-6">
                      <div class="form-group row">
                        <div class="col-md-8">
                          <select class="form-control" id="cmbDangerType" name="">
                            <option value="-1">Сонгоно уу</option>
                            <option value="1">Бүсээр</option>
                            <option value="2">Аймгаар</option>
                            <option value="3">Сумаар</option>
                          </select>
                        </div>
                        <div class="col-md-4">
                          <input type="button" id="btnDeclareDangerModal" class="btn btn-danger" name="" value="Онц байдал зарлах">
                        </div>

                      </div>
                      <div class="page-title-box">
                          <ol class="breadcrumb mb-0">
                              <li class="breadcrumb-item"><a href="{{url("/mongolia/maps")}}" id="mongolianMap">Монгол Улс</a></li>
                              <li class="breadcrumb-item active " id="selectedProvName"></li>
                          </ol>
                      </div>
                    </div>
                    <div id="changeProvince">
                        @include('mongolianMap.allMaps')

                        @include('mongolianMap.danger.dangerModal')
                    </div>

                      <style media="screen">
                        .aimagTextName{
                          /* font-weight:bold; */
                          fill:#E4FD0C;
                          stroke:#E4FD0C;
                          font-family:tahoma;
                          font-size:62.3503px;
                          stroke-miterlimit:1px;
                          cursor:pointer;
                        }

                        .symTextName{
                          font-weight:bold;
                          fill:#fff;
                          font-family:tahoma;
                          cursor:pointer;
                          /* stroke: black; stroke-width: 1; */
                        }
                      </style>

                    <div class="col-md-12 float-right">
                      <div class="page-title-box">
                          <ol class="breadcrumb mb-0 float-right">
                              <li class="breadcrumb-item"><a href="javascript:void(0)" id="toSum">Сумаар харах</a></li>
                              <li class="breadcrumb-item"><a href=""></a></li>
                          </ol>
                      </div>
                    </div>
                  </div>

              </div>
          </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="row">
          <div class="col-xl-12">
              <div class="card">
                  <div class="card-body">
                      <h4 class="card-title mb-12" id="changeName">Монгол Улсын хэмжээнд</h4>
                      <div class="form-group row border border-success rounded-left" style="">
                        <div class="col-md-12">
                          Нийт хүн ам:
                        </div>
                        <div class="col-md-3">
                          <img src="{{url('\public\images\icons\population.png')}}" width="35" alt="" style="padding-bottom:4px;">
                        </div>
                        <div id="totalPop" class="col-md-9 text-left" style="font-size:22px;">
                          2237812
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      <div class="form-group row border border-success rounded-left" style="">
                        <div class="col-md-12">
                          Жишсэн хүн ам:
                        </div>
                        <div class="col-md-3">
                          <img src="{{url('\public\images\icons\standard.png')}}" width="35" alt="" style="padding-bottom:4px;">
                        </div>
                        <div id="standardPop" class="col-md-9 text-left" style="font-size:22px;">
                          1737812
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      <div class="form-group row border border-success rounded-left" style="">
                        <div class="col-md-12">
                          Нийт малын тоо толгой:
                        </div>
                        <div class="col-md-3 col-xm-3">
                          <img src="{{url('\public\images\icons\cattleIcon.png')}}" width="35" alt="" style="padding-bottom:4px;">
                        </div>
                        <div id="totalCattle" class="col-md-9 col-xm-9 text-left" style="font-size:22px;">
                          52037812
                        </div>
                      </div>

                      <div class="clearfix"></div>
                      <div class="form-group row border border-success rounded-left" style="">
                        <div class="col-md-12">
                          Нийт хоногийн нөөц
                        </div>
                        <div id="reserveDay" class="col-md-12 text-center text-success border border-success rounded-circle" style="font-size:45px;">
                          56234
                        </div>
                        <div class="col-md-12 text-center">
                          Хоног
                        </div>
                      </div>



                  </div>
              </div>
          </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-12" id="">Тухайн хүнсний бүтээгдэхүүний үлдсэн хоног</h4>
          <div class="form-group row" id="bottom">
            {{-- <div class="form-group row col-md-3">
              <div class="col-md-12" id="productName">Гурил:</div>
              <div class="col-md-12">Үлдсэн хоног: <label id="leftDays">3</label></div>
            </div> --}}
          </div>

        </div>
      </div>

    </div>
  </div>


@endsection

@section('js')

  <script type="text/javascript">
  var csrf = "{{ csrf_token() }}";
  var getAimagInfo = "{{url("/get/getAimagInfo")}}";
  var getSymInfo = "{{url("/get/getSymInfo")}}";
  var allMongolianMap = "{{url("/mongolian/allMaps")}}";
  var changeBladeProvince = "{{url("/mongolian/province")}}";
  var getAlertedProvJson = "{{url("/test/get")}}";
  var aimagName = "";
  var provCode = "";

      $(document).ready(function(){

        $('[data-toggle="tooltip"]').tooltip();

        $("#toSum").click(function(){
          if(aimagName != ""){
            $.ajax({
              type: 'get',
              url: changeBladeProvince,
              data: {
                  _token: csrf,
                  provCode: provCode
              },
              success:function(response){
                $("#changeProvince").html("");
                $("#changeProvince").html(response);
              },
            error: function(jqXhr, json, errorThrown){// this are default for ajax errors
              var errors = jqXhr.responseJSON;
              var errorsHtml = '';
              $.each(errors['errors'], function (index, value) {
                  errorsHtml += '<ul class="list-group"><li class="list-group-item alert alert-danger">' + value + '</li></ul>';
              });
              alert(errorsHtml);
            }
          });
        }else{
          alert("аймаг сонгон уу");
        }

        });


      });
  </script>

  <script src="{{url('public/js/mongolianMap/test.js')}}"></script>
  <script src="{{url('public/js/mongolianMap/RightPanel.js')}}"></script>
@endsection
