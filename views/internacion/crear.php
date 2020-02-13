<div class="crear_internacion">
    <h4>Agregar Internacion</h4>

    <form action="save" method="post">

        <div class="form-group">

        <input type="hidden" name="id_paciente" id="id_paciente" class="form-control">

        
            <label for="paciente">Paciente</label>
            <div class="input-group">

                <input type="text" name="nom_paciente" id="nom_paciente" class="form-control" required>

                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="button" data-toggle="modal" data-target="#modalAddPaciente" id="btnSeleccionar">Seleccionar</button>
                </div>
            </div>

        </div>


        <div class="form-group">
            <label for="fechaIng">Fecha ingreso</label>
            <input type="datetime-local" name="fechaIng" id="fechaIng" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="fechaEgr">Fecha Egreso</label>
            <input type="datetime-local" name="fechaEgr" id="fechaEgr" class="form-control" required>
        </div>

        <input type="submit" value="Agregar" class="btn btn-primary">
        <a href="/fuerarango/"><button type="button" class="btn btn-secondary">Cancelar</button></a>
    </form>
</div>