<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label col-md-4">Primer Nombre</label>
            <div class="col-md-8">
                <input name="first_name" required="required" placeholder="Primer Nombre"
                       class="form-control" type="text" data-parsley-length="[3, 20]"
                       value="">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Primer Apellido</label>
            <div class="col-md-8">
                <input name="first_lastname" required="required" placeholder="Primer Apellido"
                       class="form-control" type="text" data-parsley-length="[3, 20]"
                       value="">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Ci</label>
            <div class="col-md-8">
                <input name="ci" required="required" placeholder="ci"
                       class="form-control" type="text" data-parsley-length="[3, 20]"
                       value="">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="control-label col-md-4">Segundo Nombre</label>
            <div class="col-md-8">
                <input name="second_name" placeholder="Segundo Nombre"
                       class="form-control" type="text" data-parsley-length="[3, 20]"
                       value="">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Segundo Apellido</label>
            <div class="col-md-8">
                <input name="second_lastname" placeholder="Segundo Apellido"
                       class="form-control" type="text" data-parsley-length="[3, 20]"
                       value="">
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label col-md-4">Sexo</label>
            <div class="col-md-8">
                <select name="gender" class="form-control" id="">
                    <option value="Masculino">Masculino</option>
                    <option value="Femenino">Femenino</option>
                </select>
                <span class="glyphicon form-control-feedback" aria-hidden="true"></span>
            </div>
        </div>
    </div>
</div>