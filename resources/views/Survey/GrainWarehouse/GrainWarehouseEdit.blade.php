<div id="modalGrainWarehouseEdit" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
      {{-- modal-lg --}}
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title mt-0">ТАРИАЛАНГИЙН АГУУЛАХ, ЭЛЕВАТОР, ЗООРИЙН СУДАЛГАА ЗАСАХ</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form id="frmGrainWarehouseEdit" action="" method="post">
                @csrf
                <input type="hidden" name="rowID" id="rowID" value="">
                  <div class="form-group row">
                    <div class="col-md-6">
                      <label>Аймаг / Нийслэл:</label>
                      <select class="form-control" name="provID" id="eprovName" getSymUrl="{{url("/sym/get/by/provID")}}">
                          <option value="-1">Сонгоно уу</option>
                        @foreach ($provinces as $province)
                          <option value="{{$province->id}}">{{$province->provName}}</option>
                        @endforeach
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Сум/дүүрэг:</label>
                      <select class="form-control" name="symID" id="ecmbSymNew">
                          <option value="-1">Сонгоно уу</option>

                      </select>
                    </div>
                  </div>
                  <div class="clearfix"></div>

                  <div class="form-group row">
                    <div class="col-md-6">
                      <label>Аж ахуйн нэгжийн нэр:</label>
                      <input class="form-control" type="text" name="firmName" id="efirmName">
                    </div>
                    <div class="col-md-6">
                      <label>Ашиглалтад орсон огноо:</label>
                      <input class="form-control" type="date" name="startDate" id="estartDate">
                    </div>
                    </div>

                    <div class="clearfix"></div>
                    <div class="form-group row">
                    <div class="col-md-6">
                      <label>Агуулахын багтаамж, хүчин чадал /тн/:</label>
                      <input class="form-control" type="text" name="capacity" id="ecapacity">
                    </div>
                    <div class="col-md-6">
                      <label>*Төлөв:</label>
                      <input class="form-control" type="text" name="state" id="estate">
                    </div>
                  </div>

                  <div class="clearfix"></div>
                  <div class="form-group row">
                    <div class="col-md-6">
                      <label>Хариуцах хүний нэр:</label>
                      <input class="form-control" type="text" name="resName" id="eresName">
                    </div>
                    <div class="col-md-6">
                      <label>Холбоо барих утас:</label>
                      <input class="form-control" type="text" name="contact" id="econtact">
                    </div>
                  </div>
                  <p class="text-right">*механикжсан агуулах бол (М), уламжлалт ажиллагаатай бол (У) гэж тэмдэглэнэ.</p>

                  </div>
                  <div class="modal-footer">
                      <button type="submit" id="btnGrainWarehouseUpdate" class="btn btn-primary">Хадгалах</button>
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Хаах</button>
                  </div>
            </form>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
