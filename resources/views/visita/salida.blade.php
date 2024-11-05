<div class="modal-dialog modal-dialog-centered" role="document" data-keyboard="false" data-backdrop="static">
    <div class="modal-content">
        <div class="modal-header head-modal">
            <h5 class="modal-title text-white">Registrar Salida</h5>
            <button type="button" class="close" data-dismiss="modal"><span>x</span>
            </button>
        </div>
        <form id="frmsalida" class="frmsalida" method="put">
            <div class="modal-body">
                @csrf
                @if(isset($item))
                    @method('PUT')
                @endif
                <input type="hidden" id="idregvisita" name="idregvisita" value="{{ $item->idregvisita }}">
                <div id="mensaje"></div>
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="form-group">
                            <label class="form-label" for="observaciones">Observaciones : </label>
                            <textarea name="observaciones" id="observaciones" class="form-control" cols="30" rows="3"></textarea>
                            <div id="observaciones_error" class="invalid-feedback animated fadeInUp"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><i class="la la-times-circle-o"></i> Cancelar</button>
                <button type="submit" class="btn btn-info"><i class="fa fa-download"></i> Registrar Salida</button>
            </div>
        </form>
    </div>
</div>
